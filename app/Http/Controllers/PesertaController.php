<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Peserta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    //logbook
    public function index(){
        $peserta = Peserta::all();
        return view('admin.pages.logbook.index', compact('peserta'));
    }
    //logbook create
    public function create(){
        $peserta = new Peserta;
        return view('admin.pages.logbook.create', compact('peserta'));
    }
    //logbook methode post
    public function store(Request $request){
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'required|string|in:Dalam Proses,Selesai',
            'dokumentasi' =>'nullable|file|mimes:jpg,png,jpeg|max:2048',
        ]);
        $dokumentasiPath = $request->file('dokumentasi') ? $request->file('dokumentasi')->store('dokumentasi', 'public') : null;
        
        $peserta = new Peserta();
        $peserta->judul = $request->judul;
        $peserta->deskripsi = $request->deskripsi;
        $peserta->tanggal = Carbon::now()->format('Y-m-d'); // Set tanggal ke tanggal sekarang
        $peserta->status = $request->status;
        $peserta->dokumentasi = $dokumentasiPath;
        $peserta->save();
        return redirect('dashboard-logbook')->with('success', 'Logbook Berhasil Ditambahkan');;

    }
    //dashboard data peserta sekolah
    public function identitas(){
      // Mengambil data pengajuan di mana user_id adalah id dari pengguna yang sedang login
      $userId = auth()->user()->id;
      $peserta = Pengajuan::all();
        return view('sekolah.pages.psurat.tambah', compact('peserta'));
    }

    public function pengajuan(Request $request){
    // dd($request->all());
    // Validasi data
    $request->validate([
        'nama' => 'required|string|max:255',
        'nim' => 'required|string|max:255',
        'jurusan' => 'required|string|max:255',
        'tgl_awal' => 'required|date',
        'tgl_akhir' => 'required|date',
        'surat' => 'nullable|mimes:pdf|max:5120',
    ]);

    // Simpan data ke database
    $suratPath = $request->file('surat') ? $request->file('surat')->store('surats', 'public') : null;
    Pengajuan::create([
        'nama' => $request->nama,
        'nim' => $request->nim,
        'jurusan' => $request->jurusan,
        'tgl_awal' => $request->tgl_awal,
        'tgl_akhir' => $request->tgl_akhir,
        'surat' => $suratPath,
    ]);
    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('success', 'Data Peserta berhasil ditambahkan.');
}
    public function hapusData($id){
        $peserta = Pengajuan::findOrFail($id);
        $peserta->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
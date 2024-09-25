<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Peserta;
use App\Models\pesertamagang;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PesertaController extends Controller
{
    //logbook
    public function index(){
        // Mengambil data peserta yang hanya terkait dengan pengguna yang sedang login
        $peserta = Peserta::where('user_id', Auth::id())->get();
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();
        $currentDate = \Carbon\Carbon::now()->format('Y-m-d');
         $logbookHariIni = Peserta::where('tanggal', $currentDate)
                             ->where('user_id', auth()->id())
                             ->first();
        return view('admin.pages.logbook.index', compact('peserta', 'user','logbookHariIni'));
    }
    //logbook create
    public function create(){
        $peserta = new peserta();
        $user = User::findOrFail(Auth::id());
        return view('admin.pages.logbook.create', compact('peserta','user'));
    }
    //logbook methode post
    

    public function store(Request $request)
    {
     //   $currentDate = Carbon::now()->format('Y-m-d'); // Tanggal hari ini
    
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'dokumentasi' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
        ]);
    
        // Simpan file dokumentasi jika ada
        $dokumentasiPath        = $request->file('dokumentasi') ? $request->file('dokumentasi')->store('dokumentasi', 'public') : null;
    
        $peserta                = new peserta();
        $peserta->nim           = $request->nim; 
        $peserta->judul         = $request->judul;
        $peserta->deskripsi     = $request->deskripsi;
        $peserta->tanggal       = now(); 
        $peserta->user_id       = auth()->user()->id; 
        $peserta->is_reopened   = $request->has('is_reopened') ? 1 : 0;
        $peserta->dokumentasi   = $dokumentasiPath;
        $peserta->save(); 

        return redirect('dashboard-logbook')->with('success', 'Logbook Berhasil Ditambahkan');
}
    
    
    public function update(Request $request)
    {
      //  dd($request->all());
        // Validasi input
        $request->validate([
            'judul'          => 'required|string|max:255',
            'deskripsi'      => 'required|string',
            'dokumentasi'    => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
        ]);
        
        // Ambil entri logbook terakhir peserta berdasarkan user_id
        $peserta = peserta::where('id',$request->id)
                        ->first();
        // Jika ada file dokumentasi yang di-upload, simpan file tersebut
        if ($request->hasFile('dokumentasi')) {
            // Simpan file dokumentasi dan dapatkan path-nya
            $dokumentasiPath = $request->file('dokumentasi')->store('dokumentasi', 'public');
            $peserta->dokumentasi = $dokumentasiPath;
        } 
        $peserta->judul          = $request->judul;
        $peserta->deskripsi      = $request->deskripsi;
        $peserta->is_reopened    = false;
        $peserta->update();
        
        // Redirect ke halaman logbook dengan pesan sukses
        return redirect()->route('dashboard.logbook')->with('success', 'Logbook berhasil diperbarui.');
    }
public function edit()
{
    $user = Auth::user();
        $peserta = Peserta::where('user_id', auth()->id())
        ->latest('tanggal') 
        ->first();

        if (!$peserta) {
        return redirect()->back()->with('error', 'Tidak ada data logbook untuk diedit.');
        }
    return view('admin.pages.logbook.edit', compact('peserta','user'));
}
    //dashboard data peserta sekolah
    public function identitas(){
      $userId = auth()->user()->id;
      $peserta = Pengajuan::all();
        return view('sekolah.pages.psurat.tambah', compact('peserta'));
    }

    public function pengajuan(Request $request){
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
        'nama'          => $request->nama,
        'nim'           => $request->nim,
        'jurusan'       => $request->jurusan,
        'tgl_awal'      => $request->tgl_awal,
        'tgl_akhir'     => $request->tgl_akhir,
        'surat'         => $suratPath,
    ]);
    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('success', 'Data Peserta berhasil ditambahkan.');
}
    public function hapusData($id){
        $peserta = Pengajuan::findOrFail($id);
        $peserta->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
    public function peserta(){
        $user = User::findOrFail(Auth::id());
        return view('peserta.layouts.main',compact('user'));
    }

    public function dashboard(){
        $user = User::findOrFail(Auth::id());
        return view("peserta.index",compact('user'));
     }

     public function updatelogbook(Request $request){
        $id         = $request->input('id');
        $pembimbing = peserta::where('nim',$id)->first();
        $dataupdate = [
            'is_reopened' => 1
        ];
        $pembimbing->update($dataupdate);
        return redirect('dashboard-data-view?id='. $id)->with('success', 'Form Berhasil Dibuka');
     }
}
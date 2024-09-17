<?php

namespace App\Http\Controllers;

use App\Models\Balasan;
use App\Models\jurusan;
use App\Models\Pengajuan;
use App\Models\PengajuanSekolah;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PSekolahController extends Controller
{
    public function index() {
        // Mendapatkan ID user yang sedang login
        $userId = auth()->user()->id;
        
        // Mengambil data pengajuan sekolah yang terkait dengan user yang sedang login
        $peserta = PengajuanSekolah::with('balasan') // Menambahkan eager loading untuk balasan
        ->where('user_id', $userId)
        ->latest()
        ->simplePaginate(5);
        // $peserta =  DB::table('pengajuansekolah')
        // ->where('user_id', $userId)  // Memfilter berdasarkan user_id
        // ->get();
       // Mengambil semua id_jurusan dari data Pengajuan yang terkait dengan PengajuanSekolah

       // Mengambil data Pengajuan yang terkait dengan id_pengajuan dari PengajuanSekolah
         $data = Pengajuan::with('jurusan')
         ->where('id_jurusan') // Menggunakan whereIn untuk mencari id yang sesuai
        ->latest()
        ->get();
       // $pengajuan = Pengajuan::findOrFail($peserta->pengajuan_id);
        // Menggabungkan data Pengajuan dan PengajuanSekolah berdasarkan pengajuan_id
        // Mengirim data ke view
        return view('sekolah.pages.psurat.index', compact('data','peserta'));
    }

    public function pengajuanSurat(Request $request){
    //dd(auth()->user()); 
        // dd($request->all());
        // Validasi data
        $request->validate([
            'no_surat' => 'required|string|max:250',
            'tgl_surat' => 'required|date',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'surat'          => 'required|mimes:pdf|max:5120',
            
        ],[
            'surat.required' => 'File surat harus diisi.',
            'surat.mimes' => 'File surat harus berupa PDF.',
            'surat.max' => 'File surat tidak boleh lebih dari 5MB.',
        ]);
    
        // Simpan data ke database
        $suratPath = $request->file('surat') ? $request->file('surat')->store('surats', 'public') : null;
      
      DB::table('pengajuansekolah')->insert([
            'no_surat'          => $request->no_surat,
            'tgl_surat'         => $request->tgl_surat,
            'tgl_mulai'         => $request->tgl_mulai,
            'tgl_selesai'       => $request->tgl_selesai,
            'surat'             => $suratPath,
            'user_id'          => Auth::id(),
            ]);
        // Redirect kembali dengan pesan sukses
          // Panggil function pengajuanPeserta dengan $pengajuan_id
        return redirect()->back()->with('success', 'Surat Berhasil ditambahkan');
    }
    
    //hapus pengajuan
    public function destroy($id)
    {
        $pengajuan = Pengajuan::find($id);
        
        if ($pengajuan) {
            $pengajuan->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }
   //hapus surat
    public function hapusPengajuan($id){
        $peserta = PengajuanSekolah::findOrFail($id);
        $peserta->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
    // public function view($id)
    // {
    //     $userId = auth()->user()->id;

    //     // Mengambil data PengajuanSekolah berdasarkan user_id dan id
    //     $peserta = PengajuanSekolah::where('user_id', $userId)
    //                                ->where('id', $id)
    //                                ->firstOrFail();
    
    //     // Mengambil data Pengajuan terkait dengan pengajuan_id dari PengajuanSekolah
    //     $data = Pengajuan::with('jurusan')
    //                      ->where('id', $peserta->pengajuan_id)
    //                      ->get(); // Gunakan get() jika ada beberapa data yang perlu ditampilkan
    // //dd($data);
    //     return view('sekolah.pages.psurat.index', compact('peserta', 'data'));
    // }
//     public function view($id)
// {
//     // Ambil data PengajuanSekolah berdasarkan ID
//     $pengajuanSekolah = PengajuanSekolah::with('pengajuan') // jika ada relasi lain, tambahkan di sini
//         ->findOrFail($id);

//     // Ambil data Pengajuan yang terkait
//     $pengajuan = $pengajuanSekolah->pengajuan;

//     // Kirim data ke view melalui JSON
//     return response()->json([
//         'pengajuan' => $pengajuan,
//         'pengajuan_sekolah' => $pengajuanSekolah,
//     ]);
// }

       // return view('sekolah.pages.psurat.index', compact('pengajuan','data'));
    
       public function pengajuanPeserta(Request $request) {
        // Validasi input
        $request->validate([
            'nama'          => 'required|string|max:255',
            'jk'            => 'required|in:Laki-laki,Perempuan',
            'nim'           => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'no_hp'         => 'required|string|max:255',
            'alamat'        => 'required|string',
            'jurusan'       => 'required|string|max:255',
        ]);
    
        // Simpan jurusan ke dalam tabel jurusan jika belum ada
        $jurusan = jurusan::firstOrCreate([
            'nama_jurusan' => $request->jurusan
        ]);
    
        // Langkah 1: Cari data di tabel PengajuanSekolah berdasarkan field id
        $pengajuanSekolah = PengajuanSekolah::find($request->pengajuan_id);
    
        if ($pengajuanSekolah) {
            // Langkah 2: Simpan data ke tabel Pengajuan
            $pengajuan = new Pengajuan();
            $pengajuan->nama = $request->nama;
            $pengajuan->nim = $request->nim;
            $pengajuan->alamat = $request->alamat;
            $pengajuan->jk = $request->jk;
            $pengajuan->no_hp = $request->no_hp;
            $pengajuan->id_jurusan = $jurusan->id;
            $pengajuan->email = $request->email;
    
            // Isi pengajuan_id di tabel Pengajuan sesuai dengan id dari PengajuanSekolah
            $pengajuan->pengajuan_id = $pengajuanSekolah->id;
            $pengajuan->save();
    
        } else {
            // Handle jika data di tabel PengajuanSekolah tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    
        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }
    
   
  
    public function ajukan(Request $request)
{
    // Validasi data yang dikirim
    $validated = $request->validate([
        'no_surat' => 'required|string',
        'tgl_surat' => 'required|date',
        'tgl_mulai' => 'required|date',
        'tgl_selesai' => 'required|date',
        'surat' => 'required|string', // Jika 'surat' sudah berupa string/path
    ]);

    // Simpan data pengajuan ke tabel PengajuanSekolah
    $pengajuan = new PengajuanSekolah();
    $pengajuan->user_id = Auth::id(); // Mendapatkan user ID yang sedang login
    $pengajuan->no_surat = $validated['no_surat'];
    $pengajuan->tgl_surat = $validated['tgl_surat'];
    $pengajuan->tgl_mulai = $validated['tgl_mulai'];
    $pengajuan->tgl_selesai = $validated['tgl_selesai'];
    $pengajuan->surat = $validated['surat']; // Menyimpan data surat yang dikirim dari view
    $pengajuan->save();

    return response()->json(['message' => 'Pengajuan berhasil'], 200);
}

    
}
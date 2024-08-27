<?php

namespace App\Http\Controllers;

use App\Models\Balasan;
use App\Models\jurusan;
use App\Models\Pengajuan;
use App\Models\PengajuanSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PSekolahController extends Controller
{
    public function index(){
   // Mendapatkan ID user yang sedang login
   $userId = auth()->user()->id;

   // Mengambil data pengajuan sekolah yang terkait dengan user yang sedang login
   $peserta = PengajuanSekolah::where('user_id', $userId)->get();
    $peserta =  DB::table('pengajuansekolah')->get();

// // Mengambil data Pengajuan yang terkait dengan user yang login, dan memuat relasi ke Jurusan
// $data = Pengajuan::with('jurusan')
            //         ->where('user_id', $userId)
            //         ->latest()
            //         ->paginate(5);

    // Mengirim data ke view
    return view('sekolah.pages.psurat.index', compact('peserta'));
}

    
    public function pengajuanSurat(Request $request){
        //dd($request->all());
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
      
         $pengajuan_id = DB::table('pengajuansekolah')->insertGetId([
            'no_surat'          => $request->no_surat,
            'tgl_surat'         => $request->tgl_surat,
            'tgl_mulai'         => $request->tgl_mulai,
            'tgl_selesai'       => $request->tgl_selesai,
            'surat'             => $suratPath,
            ]);
         // dd($pengajuan_id);
        // Redirect kembali dengan pesan sukses
          // Panggil function pengajuanPeserta dengan $pengajuan_id
        return $this->pengajuanPeserta($request, $pengajuan_id);
        return redirect()->back()->with('success', 'Data Peserta berhasil ditambahkan');
    }
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
    public function view($id)
    {
        $userId = auth()->user()->id;

        // Mengambil data PengajuanSekolah berdasarkan user_id dan id
        $peserta = PengajuanSekolah::where('user_id', $userId)
                                   ->where('id', $id)
                                   ->firstOrFail();
    
        // Mengambil data Pengajuan terkait dengan pengajuan_id dari PengajuanSekolah
        // $data = Pengajuan::with('jurusan')
        //                  ->where('id', $peserta->pengajuan_id)
        //                  ->get(); // Gunakan get() jika ada beberapa data yang perlu ditampilkan
    //dd($data);
        return view('sekolah.pages.psurat.index', compact('peserta'));
    }
    public function pengajuanPeserta(Request $request, $pengajuan_id) {
      // dd($request->all());
     
        $request->validate([
            'nama'          => 'required|string|max:255',
            'jk'            => 'required|in:Laki-laki,Perempuan',
            'nim'           => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'no_hp'         => 'required|string|max:255',
            'alamat'        => 'required|string',
            'jurusan'       => 'required|string|max:255',
                'no_surat'      => 'nullable|string|max:250',
                'tgl_surat'     => 'nullable|date',
                'tgl_mulai'     => 'nullable|date',
                'tgl_selesai'   => 'nullable|date',
                'surat'         => 'nullable|mimes:pdf|max:5120',
        ]);
        // Simpan jurusan ke dalam tabel jurusan jika belum ada
         $jurusan = jurusan::firstOrCreate([
            'nama_jurusan' => $request->jurusan], // Kondisi untuk mencari apakah jurusan sudah ada
    );
        DB::table('pengajuan')->insert([
            'nama'            => $request->nama,
            'nim'             => $request->nim,
            'alamat'          => $request->alamat,
            'jk'              => $request->jk,  
            'no_hp'           => $request->no_hp,
            'email'           => $request->email,
            'id_jurusan'      => $jurusan->id,
            'pengajuan_id'    => $pengajuan_id,
        ]);
    //  $pengajuan = Pengajuan::create([
    //         'nama'            => $request->nama,
    //         'nim'             => $request->nim,
    //         'alamat'          => $request->alamat,
    //         'jk'              => $request->jk,  
    //         'no_hp'           => $request->no_hp,
    //         'email'           => $request->email,
    //         'id_jurusan'     => $jurusan->id,
    //         'user_id'         => Auth::id(),
    //     ]);
        return redirect()->back()->with('success', 'Pengajuan Berhasil Tersimpan');;
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
<?php
namespace App\Http\Controllers;

use App\Models\Balasan;
use App\Models\jurusan;
use App\Models\Pembimbing;
use App\Models\Pengajuan;
use App\Models\PengajuanSekolah;
use App\Models\pesertamagang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\Cast\String_;

class DashboardController extends Controller
{
    public function dataPeserta(){
        // Mendapatkan ID user yang sedang login
        $userId = auth()->user()->id;
    
        // Mengambil semua data dari tabel PengajuanSekolah
        $peserta = PengajuanSekolah::with('balasan')
        ->select(
            'pengajuansekolah.id', 
            'pengajuansekolah.no_surat', 
            'pengajuansekolah.tgl_surat', 
            'pengajuansekolah.tgl_mulai', 
            'pengajuansekolah.tgl_selesai', 
            'pengajuansekolah.surat', 
            'sekolah.name as name', 
            'sekolah.email as email', 
            'sekolah.alamat as alamat', 
            'sekolah.no_telp as no_hp'
        )
        ->join('sekolah', 'pengajuansekolah.user_id', '=', 'sekolah.user_id')
        ->get();
    
        // Pisahkan peserta yang belum diisi statusnya
        $belumDiisi = $peserta->filter(function($p) {
            return is_null($p->balasan);
        });
    
        // Pisahkan peserta yang sudah diisi statusnya
        $sudahDiisi = $peserta->filter(function($p) {
            return !is_null($p->balasan);
        });
    
        // Gabungkan peserta dengan yang belum diisi statusnya di atas
        $pesertaSorted = $belumDiisi->merge($sudahDiisi);
    
        // Ambil data Pengajuan dari semua user, dengan relasi jurusan
        $data = Pengajuan::where('user_id', $userId)->with('jurusan')->get(); 
        $balasan = DB::table('balasan')->get();
    
        $user = User::findOrFail(Auth::id());
    
        // Fetch both nama_pembimbing and bagian
        $pembimbingList = DB::table('pembimbing')
            ->join('users', 'pembimbing.user_id', '=', 'users.id')
            ->select('pembimbing.id', 'users.name as nama_pembimbing', 'pembimbing.bagian')
            ->get();
    
        return view("admin.pages.peserta.index", compact('peserta', 'data', 'balasan', 'user', 'pembimbingList'));
    }
    
    public function savePembimbing(Request $request)
    {
        foreach ($request->pembimbing as $pengajuan_id => $pembimbing_id) {
            // Update data pembimbing_id pada tabel pengajuan
         //   dd($pengajuan_id);
            DB::table('pengajuan')
                ->where('id', $pengajuan_id)
                ->update(['pembimbing_id' => $pembimbing_id]);
    
            // Ambil data semua peserta magang yang terkait dengan pengajuan ini
            $pesertaMagangList = DB::table('pesertamagang')
                ->where('id', $pengajuan_id)
                ->get();
            // Update data pembimbing_id untuk setiap peserta magang
            foreach ($pesertaMagangList as $peserta) {
                DB::table('pesertamagang')
                    ->where('id', $peserta->id)
                    ->update(['pembimbing_id' => $pembimbing_id]);
            }
        }
    
    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('success', 'Pembimbing berhasil disimpan.');
}
// public function savePembimbing(Request $request)
// {
//     // Ambil semua pengajuan yang terkait dengan user saat ini (atau semua pengajuan jika tidak spesifik)
//     $pengajuanList = Pengajuan::whereIn('id', array_keys($request->pembimbing))->get();

//     foreach ($pengajuanList as $pengajuan) {
//         $pengajuan_id = $pengajuan->id; // Ambil pengajuan_id dari tabel pengajuan
//         $pembimbing_id = $request->pembimbing[$pengajuan_id]; // Ambil pembimbing_id yang dikirim dari form

//         // Update pembimbing_id di tabel pengajuan
//         $pengajuan->pembimbing_id = $pembimbing_id;
//         $pengajuan->save();

//         // Ambil semua peserta magang terkait pengajuan ini dari tabel pesertamagang
//         $pesertaMagangList = pesertamagang::where('pengajuan_id', $pengajuan_id)->get();

//         // Cek apakah data peserta magang terkait ditemukan
//         if ($pesertaMagangList->isEmpty()) {
//             return redirect()->back()->with('error', 'Tidak ada data peserta magang terkait untuk pengajuan ID ' . $pengajuan_id);
//         }

//         // Update pembimbing_id untuk setiap peserta magang
//         foreach ($pesertaMagangList as $peserta) {
//             $peserta->pembimbing_id = $pembimbing_id;
//             $peserta->save();
//         }
//     }

//     return redirect()->back()->with('success', 'Data pembimbing berhasil disimpan ke pengajuan dan peserta magang.');
// }


    public function cariPeserta(Request $request)
{
    // Mendapatkan ID user yang sedang login
    $userId = auth()->user()->id;

    // Ambil semua data dari tabel PengajuanSekolah beserta relasi balasan
    $query = PengajuanSekolah::with('balasan');

    // Cek apakah ada input tanggal dari form
    if ($request->has('date')) {
        $date = $request->input('date');

        // Filter data berdasarkan tanggal surat
        $query->whereDate('tgl_surat', $date);
    }

    // Dapatkan data peserta setelah filter
    $peserta = $query->get();

    // Ambil data Pengajuan dari semua user, dengan relasi jurusan
    $data = Pengajuan::where('user_id', $userId)->with('jurusan')->get();

    return view("admin.pages.peserta.index", compact('peserta','data'));
}
public function getPembimbingByBagian(Request $request) {
    // Validasi input bagian
    $request->validate([
        'bagian' => 'required|exists:pembimbing,bagian',
    ]);

    $bagianId = $request->input('bagian');
    $pembimbingList = DB::table('pembimbing')
        ->join('users', 'pembimbing.user_id', '=', 'users.id')
        ->where('pembimbing.bagian', $bagianId)
        ->pluck('users.name', 'users.id');
    
    // Log data untuk debugging
    Log::info('Data Pembimbing:', $pembimbingList->toArray());

    return response()->json($pembimbingList);
}

    public function pengajuan(){
        $datas = new Pengajuan;
        return view("dashboard/pages/pengajuan", compact('datas'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'nim' => 'required|string|max:255',
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:255',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'surat' => 'nullable|mimes:pdf|max:5120',
        ]);
        // Handle file uploads
        $fotoPath = $request->file('foto') ? $request->file('foto')->store('fotos', 'public') : null;
        $suratPath = $request->file('surat') ? $request->file('surat')->store('surats', 'public') : null;
        
        $pengajuan = new Pengajuan;
        $pengajuan->nama = $request->nama;
        $pengajuan->jurusan = $request->jurusan;
        $pengajuan->alamat = $request->alamat;
        $pengajuan->asal_sekolah = $request->asal_sekolah;
        $pengajuan->nim = $request->nim;
        $pengajuan->tgl_awal = $request->tgl_awal;
        $pengajuan->tgl_akhir = $request->tgl_akhir;
        $pengajuan->email = $request->email;
        $pengajuan->user_id = auth()->id();
        $pengajuan->no_hp = $request->no_hp;
        $pengajuan->surat = $suratPath;
        $pengajuan->foto = $fotoPath;
        $pengajuan->save();

        return redirect('status-pengajuan')->with('success', 'Pengajuan Berhasil Tersimpan');;
    }

    public function statusPengajuan() {
        $datas = Pengajuan::where('id', auth()->user()->id)->get();
        return view("dashboard.pages.status", compact('datas'));
    }
     public function index(){
        return view("admin.layouts.main");
     }
     
     public function dashboard(){
        if (!auth()->user()->role === 'admin') {
            return redirect("dashboard-utama");
        }
        $jumlahPeserta = DB::table('pengajuansekolah')
            ->join('pengajuan', 'pengajuansekolah.id', '=', 'pengajuan.pengajuan_id')
            ->select('pengajuansekolah.id', 'pengajuan.nama')
            ->count();

        $jumlahSurat = DB::table('pengajuansekolah')->count();

        $jumlahPembimbing = DB::table('users')
        ->where('role', 'pembimbing')
        ->count();
        
        $jumlahBagian = DB::table('pembimbing')
        ->select('id', 'bagian')
        ->count();

        $user = User::findOrFail(Auth::id());
        return view("admin.pages.dashboard",compact('user','jumlahPeserta','jumlahSurat','jumlahPembimbing','jumlahBagian'));
     }

    //liat dashboard peserta
    public function view($userId)
    {
       // $userId = auth()->user()->id;
      // Mendapatkan ID user yang sedang login
      $peserta = PengajuanSekolah::where('user_id', $userId)->first();
      $data = Pengajuan::with('jurusan')
                 ->where('user_id', $userId)
                 ->latest()
                 ->paginate(5);
               //  $balasan = Balasan::with('balasan')->find($id);
        return view('admin.pages.peserta.index', compact('peserta', 'data'));
    }
    

//liat data
     public function statusPeserta($id){
        $status = Balasan::where('id', $id)->first();
        return view("admin.pages.peserta.index", compact('status'));
     }
//tambah data status
     public function create($id)
     {
         $status = Balasan::where('id', $id)->first();
         $peserta = Pengajuan::where('id', $id)->first();
         return view('admin.pages.peserta.index', compact('peserta','status'));
     }
     
     public function pengajuanStore(Request $request, $id)
     {
        // dd($request->all());
         // Validasi data
         $request->validate([
             'status' => 'required|in:diterima,ditolak',
            'alasan' => 'nullable|nullable_if:status,ditolak|string|max:250',
             'surat_balasan' => 'required_if:status,diterima|mimes:pdf|max:5120',
         ], [
             'status.required' => 'Status harus diisi.',
             'alasan.required_if' => 'Alasan penolakan harus diisi jika status ditolak.',
             'surat_balasan.required_if' => 'Surat balasan harus diupload jika status diterima.',
             'surat_balasan.mimes' => 'File surat harus berupa PDF.',
             'surat_balasan.max' => 'File surat tidak boleh lebih dari 5MB.',
         ]);
     
         $suratPath = $request->file('surat_balasan') ? $request->file('surat_balasan')->store('surat_balasan', 'public') : null;
     
         Balasan::create([
             'status' => $request->status,
             'alasan' => $request->status === 'ditolak' ? $request->alasan : null,
             'surat_balasan' => $request->status === 'diterima' ? $suratPath : null,
         ]);
     
         $id = $request->id;
         $status = $request->status;
         // Periksa jika status tidak diisi, setel ke "menunggu"
         if (empty($status)) {
             $status = 'belum diisi';
         }
 
         $dataBaru = [
             "status" =>  $status
         ];
         $konfirmasi = Balasan::where("id", $id)->update($dataBaru);
 
         return redirect()->back()->with('success', 'Status Berhasil Disimpan');
     }
    public function pengajuanStatus(Request $request)
    {
    // Validasi data
    $validated = $request->validate([
        'balasan_id' => 'required|exists:pengajuansekolah,id',
        'status' => 'required|in:diterima,ditolak',
        'alasan' => 'nullable|required_if:status,ditolak|string|max:250',
        'surat_balasan' => 'nullable|required_if:status,diterima|mimes:pdf|max:5120',
    ], [
        'status.required' => 'Status harus diisi.',
        'alasan.required_if' => 'Alasan penolakan harus diisi jika status ditolak.',
        'surat_balasan.required_if' => 'Surat balasan harus diupload jika status diterima.',
        'surat_balasan.mimes' => 'File surat harus berupa PDF.',
        'surat_balasan.max' => 'File surat tidak boleh lebih dari 5MB.',
    ]);

    // Cari pengajuan berdasarkan balasan_id
    $pengajuan = PengajuanSekolah::find($request->balasan_id);
   // dd($pengajuan->balasan);
    if ($pengajuan) {
        // Cek apakah balasan sudah ada untuk pengajuan ini
        $balasan = Balasan::where('balasan_id', $pengajuan->id)->first();
        
        if (!$balasan) {
            // Jika belum ada balasan, buat balasan baru
            $balasan = new Balasan();
            $balasan->balasan_id = $pengajuan->id;
        }

        // Update data balasan
        $balasan->status = $request->status;
        $balasan->alasan = $request->alasan;

        // Proses upload file jika ada
        if ($request->hasFile('surat_balasan')) {
            // Hapus file yang lama jika ada
            if ($balasan->surat_balasan) {
                Storage::delete($balasan->surat_balasan);
            }

            $file = $request->file('surat_balasan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('surat_balasan', $filename, 'public');
            $balasan->surat_balasan = $filePath;
        }

        // Simpan data balasan ke database
        $balasan->save();

          // Cek jika status diterima
        if ($validated['status'] === 'diterima') {
            // Ambil semua peserta terkait pengajuan ini
            $pesertaList = list_peserta($pengajuan->id);

            foreach ($pesertaList as $peserta) {
                // Cek apakah email sudah ada di tabel users
                $existingEmailUser = User::where('email', $peserta->email)->first();

                // Cek apakah NIM (username) sudah ada di tabel users
                $existingNimUser = User::where('username', $peserta->nim)->first();

                if ($existingEmailUser || $existingNimUser) {
                    // Jika email atau NIM sudah ada, ubah status menjadi "diproses" dan kembali dengan pesan kesalahan
                    $balasan->status = 'active';
                    $balasan->save();

                    return redirect()->back()->with('error', "Email atau NIM sudah digunakan oleh peserta lain. Status pengajuan tetap 'diproses'.");
                }
                $pengajuan = Pengajuan::where('user_id',auth()->user()->id)->first();
                // Buat akun pengguna baru
                $user = new User();
                $user->name = $peserta->nama; // Ambil dari nama di pengajuan
                $user->email = $peserta->email; // Gunakan email yang dimasukkan
                $user->username = $peserta->nim; // Gunakan nim sebagai username
                $user->password = bcrypt($peserta->nim); // Gunakan nim sebagai password
                $user->role = 'peserta'; // Tetapkan role 'peserta'
                $user->save();
             
                //    // Simpan data ke tabel pesertamagang
                // $pesertaMagang = new pesertamagang();
                // $pesertaMagang->nama = $peserta->nama; // Ambil nama dari data peserta
                // $pesertaMagang->nim = $peserta->nim; // Ambil nomor HP dari data peserta
                // $pesertaMagang->id_jurusan = $peserta->id_jurusan; // Ambil id jurusan dari data peserta
                // $pesertaMagang->pengajuan_id = $peserta->pengajuan_id; // Simpan id pengajuan
                // $pesertaMagang->save();
            }
        }

        return redirect()->back()->with('success', 'Status Berhasil Disimpan');
    }

    return redirect()->back()->with('error', 'Pengajuan tidak ditemukan');
}

     

    public function konfirmasiPeserta(Request $request, $id){
        $request->validate([
            'status' => 'required|string|in:diterima,ditolak,active'
       ]);
    
        $id = $request->id;
        $status = $request->status;
        // Periksa jika status tidak diisi, setel ke "menunggu"
        if (empty($status)) {
            $status = 'belum diisi';
        }

        $dataBaru = [
            "status" =>  $status
        ];
        $konfirmasi = Balasan::where("id", $id)->update($dataBaru);

        return redirect('dashboard-data-peserta')->with('success', 'Status Berhasil Tersimpan');;
    }
    public function show($id)
    {
        $pengajuan = Pengajuan::where('id', $id)->first();
        return view('admin.pages.peserta.show', compact('pengajuan'));
    }
   
    public function hapusPeserta($id)
    {
        $datas = Pengajuan::findOrFail($id);
        $datas->delete();
        return redirect('dashboard-data-peserta')->with(['success' => 'Berhasil hapus']);
    }

    public function bantuan(){
        return view('dashboard.bantuan');
    }

    public function profile(){
        $user = Pengajuan:: all();
        return view('admin.pages.peserta.profile', compact('user'));
    }

    public function showProfile()
    {
        $user = User::findOrFail(Auth::id());
        $peserta = Pengajuan::where('pengajuan_id', Auth::user()->pengajuan_id)->first(); // Mengambil data pengajuan dari user yang login
          // Ambil data jurusan berdasarkan id_jurusan dari pengajuan
       //$jurusan = jurusan::find($peserta->id_jurusan);
        // Panggil helper untuk mendapatkan data pengajuan beserta jurusan
        // Ambil data pengajuan untuk user yang sedang login dan sertakan data jurusan
    //   $pengajuan = Pengajuan::where('user_id', $user->id)->with('jurusan')->first(); 
        return view('admin.pages.peserta.profile', compact('user','peserta'));
    }
    public function update(Request $request, $id)
    {
        // Validasi
        $request->validate([
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'username' => 'required|string|min:2|max:100|unique:users,username,' . $id,
            'password' => 'nullable|string|confirmed|min:6',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa string.',
            'name.min' => 'Nama harus memiliki panjang minimal 2 karakter.',
            'name.max' => 'Nama harus memiliki panjang maksimal 100 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa string.',
            'username.min' => 'Username harus memiliki panjang minimal 2 karakter.',
            'username.max' => 'Username harus memiliki panjang maksimal 100 karakter.',
            'username.unique' => 'Username sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'password.min' => 'Password harus memiliki panjang minimal 6 karakter.',
        ]);
    
     
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username; // Update username
    
        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        // Update foto jika ada file yang diupload
        if ($request->hasFile('foto')) {
            if ($user->foto && file_exists(storage_path('app/public/fotos/' . $user->foto))) {
                Storage::delete('public/fotos/' . $user->foto);
            }
    
            $file = $request->file('foto');
            $fileName = 'foto-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/fotos/'), $fileName);
            $user->foto = $fileName;
        }
    
        $user->save();
    
        return back()->with('success', 'Profile Terupdate');
    }
    
    
}
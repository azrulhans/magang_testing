<?php
namespace App\Http\Controllers;

use App\Models\Balasan;
use App\Models\jurusan;
use App\Models\Pengajuan;
use App\Models\PengajuanSekolah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\Cast\String_;

class DashboardController extends Controller
{
    public function dataPeserta(){
      // Mendapatkan ID user yang sedang login
      $userId = auth()->user()->id;

      // Mengambil semua data dari tabel PengajuanSekolah
      $peserta = PengajuanSekolah::with('balasan')->get();

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
       return view("admin.pages.peserta.index", compact('peserta','data','balasan'));
    }
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
        return view("admin.pages.dashboard");
     }

    //liat dashboard peserta
    public function view($userId,$id)
    {
      // Mendapatkan ID user yang sedang login
      $pengajuanSekolah = PengajuanSekolah::where('user_id', $userId)->first();
      $data = Pengajuan::with('jurusan')
                 ->where('user_id', $userId)
                 ->latest()
                 ->paginate(5);
                 $balasan = Balasan::with('balasan')->find($id);
        return view('admin.pages.peserta.index', compact('peserta', 'data','balasan'));
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
    $request->validate([
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
        return view('admin.pages.peserta.profile', compact('user'));
    }
    public function update(Request $request, $id)
    {
        //validate 
        request()->validate([
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email|unique:users,email, ' . $id . ',id',
            'old_password' => 'nullable|string',
            'password' => 'nullable|required_with:old_password|string|confirmed|min:6'
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('old_password')) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            } else {
                return back()
                    ->withErrors(['old_password' => __('Tolong periksa passwordnya lagi')])
                    ->withInput();
            }
        }
        if (request()->hasFile('foto')) {
            //kodingan dibawah ini untuk pengecekan apakah foto sudah ada atau belum
            if ($user->foto && file_exists(storage_path('app/public/fotos/' . $user->foto))) {
                Storage::delete('public/fotos' . $user->foto);
            }
            //proses requst foto setelah dicek
            $file = $request->file('foto');
            $fileName = 'foto-' . uniqid() . $file->getClientOriginalName();
            //pengecekan ekstension, dia sebagai .png .jpg. jpeg dan seterusnya 
            // $fileName = '.'. $file->getClientOriginalExtension();
            //dimasukan ke file storagenya 
            $request->foto->move(storage_path('app/public/fotos/'), $fileName);
            //request menggunakan eloquent
            $user->foto = $fileName;
        }
        $user->role = $request->role ?? 'peserta';
        $user->save();
        return back()->with('success', 'Profile Terupdate');
    }
}
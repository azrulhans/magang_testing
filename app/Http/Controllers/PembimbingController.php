<?php

namespace App\Http\Controllers;

use App\Models\Pembimbing;
use App\Models\Pengajuan;
use App\Models\Peserta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PembimbingController extends Controller
{
    public function index(){
         // Mendapatkan id pengguna yang sedang login
         $userId = auth()->user()->id;
        $peserta = DB::table('pengajuan')
        ->join('pembimbing', 'pengajuan.pembimbing_id', '=', 'pembimbing.id')
        ->join('peserta', 'pengajuan.pembimbing_id', '=', 'peserta.pembimbing_id')
        ->select('pengajuan.id', 'pengajuan.nama','peserta.is_reopened', 'peserta.judul', 'peserta.deskripsi', 'peserta.tanggal', 'peserta.dokumentasi')
        ->where('pembimbing.user_id', $userId)
        ->get();
    
                                                                                                        
    return view('pembimbing.pages.v_logbook',compact('peserta'));
    }
    public function peserta(){
        $userId = auth()->user()->id;
    $pembimbing = DB::table('pengajuan')
    ->join('jurusan', 'pengajuan.id_jurusan', '=', 'jurusan.id')
    ->join('pembimbing', 'pengajuan.pembimbing_id', '=', 'pembimbing.id')
    ->select('pengajuan.id', 'pengajuan.nama', 'pengajuan.nim', 'pengajuan.jk', 'pengajuan.no_hp', 'pengajuan.alamat', 'jurusan.nama_jurusan', 'pembimbing.bagian')
    ->where('pembimbing.user_id', $userId)
    ->get();

    $peserta = [];

    foreach($pembimbing as $member){
        $peserta[] = $member;
    }

    foreach($peserta as $key => $memberPeserta){
        $dataPeserta = Peserta::where("nim", $memberPeserta->nim)->count();
        $peserta[$key]->kehadiran = $dataPeserta;
    }
    
    $data = [
        'pengajuan'      => $peserta,
    ];
    return view('pembimbing.pages.v_peserta',compact('pembimbing','data'));
    }

    public function dashboard(){
        return view('pembimbing.index');
    }
    public function reopenForm($id)
    {
        // Temukan entri berdasarkan ID
        $logbookHariIni = Peserta::find($id);
        if (!$logbookHariIni) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    
        // Pastikan hanya pembimbing yang dapat membuka form, dan pembimbing_id harus cocok
        if (auth()->user()->role === 'pembimbing') {
            $pembimbingId = auth()->id(); // Ambil ID pembimbing dari user yang sedang login
    
            dd($pembimbingId);
            // Cari pengajuan atau entri yang terkait dengan peserta dan pastikan pembimbing_id sesuai
            $pengajuan = Pengajuan::where('user_id', $logbookHariIni->user_id)
                                  ->where('pembimbing_id', $pembimbingId)
                                  ->first();
    
            if (!$pengajuan) {
                return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk membuka form ini.');
            }
    
            // Tandai sebagai form yang dibuka kembali
            $logbookHariIni->is_reopened = true;
            $logbookHariIni->save();
            return redirect()->back()->with('success', 'Form berhasil dibuka kembali.');
        }
    
        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan tindakan ini.');
    }

    public function dataPembimbing(){
         // Ambil data pembimbing beserta data pengguna yang terkait
        $pembimbing = Pembimbing::with('user')->get();
        // Ambil data 'bagian' dari tabel pembimbing
        $bagianList = Pembimbing::select('bagian')->distinct()->get();
        return view('admin.pages.pembimbing.index',compact('pembimbing','bagianList'));
    }
    public function storePembimbing(Request $request) {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',  // Validasi untuk tabel users
            'password' => 'required|string|min:3',
            'email' => 'required|email|max:255|unique:users', 
            'bagian' => 'required|string|max:255',
        ],[
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username tidak boleh lebih dari 255 karakter.',
            'username.unique' => 'Username ini sudah digunakan, silakan pilih yang lain.',
            
            'password.required' => 'Password wajib diisi.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password harus terdiri dari minimal 8 karakter.',
            
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'email.unique' => 'Email ini sudah digunakan, silakan pilih yang lain.',
            
            'bagian.required' => 'Bagian wajib diisi.',
            'bagian.string' => 'Bagian harus berupa teks.',
            'bagian.max' => 'Bagian tidak boleh lebih dari 255 karakter.',
        ]);
        
    
        // Simpan data ke tabel users
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->password = bcrypt($request->password);  // Hash password
        $user->role = 'pembimbing';  // Set role pembimbing
        $user->save();
    
        // Simpan data ke tabel pembimbing
        $pembimbing = new Pembimbing();
        $pembimbing->user_id = $user->id;  // Ambil user_id dari tabel users
        $pembimbing->bagian = $request->bagian;
        $pembimbing->save();
    
        // Kirim respons sukses
        return redirect()->back()->with('success', 'Akun pembimbing berhasil dibuat');
    }
    public function hapusPembimbing($id)
    {
        // Cari data pembimbing berdasarkan user_id
        $pembimbing = Pembimbing::where('user_id', $id)->firstOrFail();
    
        // Hapus data dari tabel pembimbing
        $pembimbing->delete();
    
        // Hapus data dari tabel users jika diperlukan
        $user = User::findOrFail($id);
        $user->delete();
    
        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
    public function update(Request $request, $id)
    {
        // Ambil data pembimbing berdasarkan ID
        $pembimbing = Pembimbing::findOrFail($id);
    
        // Ambil user yang terkait dengan pembimbing
        $user = User::findOrFail($pembimbing->user_id);
    
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                // Ignore unique rule untuk user yang sedang diupdate
                Rule::unique('users')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                // Ignore unique rule untuk user yang sedang diupdate
                Rule::unique('users')->ignore($user->id),
            ],
            'bagian' => 'required|string|max:255',
            'password' => 'nullable|min:8|', // Password harus dikonfirmasi
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username tidak boleh lebih dari 255 karakter.',
            'username.unique' => 'Username sudah digunakan, silakan pilih username lain.',
    
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'email.unique' => 'Email sudah digunakan, silakan pilih email lain.',
    
            'bagian.required' => 'Bagian wajib diisi.',
            'bagian.string' => 'Bagian harus berupa teks.',
            'bagian.max' => 'Bagian tidak boleh lebih dari 255 karakter.',
            'password.min' => 'Password harus minimal 8 karakter.',
        ]);
    
        // Update tabel users
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
    
        // Jika password diisi, maka update password
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();  // Simpan perubahan di tabel users
    
        // Update tabel pembimbing
        $pembimbing->bagian = $request->input('bagian');
        $pembimbing->save();  // Simpan perubahan di tabel pembimbing
    
        return redirect()->back()->with('success', 'Data pembimbing berhasil diupdate.');
    }
    

public function viewLogbook(Request $request){
    $id = $request->input('id');
    $pembimbing = DB::table('peserta')
    ->join('pengajuan', 'peserta.nim', '=', 'pengajuan.nim')
    ->where('peserta.nim', $id)
    ->select('peserta.*', 'pengajuan.nama')
    ->get();

    // $pembimbing = peserta::where('nim',$id)->get();
    
    return view('pembimbing.pages.v_view', compact('pembimbing'));
 }
}
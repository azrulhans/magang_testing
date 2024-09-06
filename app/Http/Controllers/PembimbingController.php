<?php

namespace App\Http\Controllers;

use App\Models\Pembimbing;
use App\Models\Peserta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembimbingController extends Controller
{
    public function index(){
  //  dd($userId);      
    // Mengambil data pengajuan sekolah yang terkait dengan user yang sedang login
    $peserta = Peserta::with('user')->get();
    
    return view('pembimbing.pages.v_logbook',compact('peserta'));
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
    
    // Pastikan hanya pembimbing yang dapat membuka form
    if (auth()->user()->role === 'pembimbing') {
        $logbookHariIni->is_reopened = true; // Tandai sebagai form yang dibuka kembali
        $logbookHariIni->save();
       return redirect()->back()->with('success', 'Form berhasil dibuka kembali.');
    }

    return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan tindakan ini.');
}
    public function dataPembimbing(){
         // Ambil data pembimbing beserta data pengguna yang terkait
        $pembimbing = Pembimbing::with('user')->get();
        return view('admin.pages.pembimbing.index',compact('pembimbing'));
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
    
    // public function view(){
    //  // Contoh untuk membuka kembali form
    // $peserta = Peserta::where('tanggal', $currentDate)->where('user_id', Auth::id())->first();
    // if ($peserta) {
    // $peserta->is_reopened = true;
    // $peserta->save();
    // }

    //     return view('pembimbing.pages.v_logbook',compact('peserta'));
    // }
}
<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SekolahController extends Controller
{
    //dashboard sekolah
    public function index(){
        if (!auth()->user()->role === 'admin') {
            return redirect("dashboard-utama");
        }
         // Ambil user yang sedang login
        $user = User::findOrFail(Auth::id());
        $userId = auth()->user()->id;


        // Ambil data berdasarkan pengguna yang sedang login
        $jumlahPeserta = DB::table('pengajuansekolah')
            ->join('pengajuan', 'pengajuansekolah.id', '=', 'pengajuan.pengajuan_id')
            ->select('pengajuansekolah.id', 'pengajuan.nama')
            ->where('pengajuansekolah.user_id', $userId) // Filter berdasarkan ID pengguna
            ->count();

        // Hitung jumlah surat yang terkait dengan user yang login
        $jumlahSurat = DB::table('pengajuansekolah')
                        ->where('user_id', $userId) // Sesuaikan field user_id sesuai dengan struktur database
                        ->count();

        return view('sekolah.index',compact('user','jumlahSurat','jumlahPeserta'));
    }
    //dashboard create biodata sekolah
    public function biodata()
    {
        return view("sekolah/pages/biodata");
    }
   // Controller Method
public function jumlah()
{
   
    // Kirim data ke view
    return view('sekolah.index', compact('jumlahSurat'));
}



}
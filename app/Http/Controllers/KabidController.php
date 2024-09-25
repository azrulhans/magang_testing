<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KabidController extends Controller
{
    public function index(){
        return view('kabid.index');
    }
    public function absensi(Request $request){
         // Ambil input pencarian dari request
         $search = $request->input('search');
        // Query dasar untuk mendapatkan data pengajuan
    $pengajuanQuery = DB::table('pengajuan')
    ->join('pengajuansekolah', 'pengajuan.pengajuan_id', '=', 'pengajuansekolah.id')
    ->join('jurusan', 'pengajuan.id_jurusan', '=', 'jurusan.id')
    ->join('pembimbing', 'pengajuan.pembimbing_id', '=', 'pembimbing.id')
    ->select('pengajuan.nama', 'pengajuan.nim', 'pengajuansekolah.tgl_mulai', 'pengajuansekolah.tgl_selesai', 'jurusan.nama_jurusan', 'pembimbing.bagian');
    
        // Tambahkan kondisi pencarian jika ada input search
        if (!empty($search)) {
            $pengajuanQuery->where(function ($query) use ($search) {
                $query->where('pengajuan.nama', 'LIKE', "%{$search}%")
                    ->orWhere('pengajuan.nim', 'LIKE', "%{$search}%")
                    ->orWhere('jurusan.nama_jurusan', 'LIKE', "%{$search}%")
                    ->orWhere('pembimbing.bagian', 'LIKE', "%{$search}%");
            });
        }
        // Dapatkan data pengajuan
         $pengajuan = $pengajuanQuery->get();
        
        $peserta = [];

        foreach($pengajuan as $member){
            $peserta[] = $member;
        }

        foreach($peserta as $key => $memberPeserta){
            $dataPeserta = Peserta::where("nim", $memberPeserta->nim)->count();
            $peserta[$key]->kehadiran = $dataPeserta;
        }
        
        $data = [
            'pengajuan'      => $peserta,
        ];
        
        return view('kabid.pages.absensi',  $data);
    }

    public function viewLogbook(Request $request){
        $id = $request->input('id');
        $pembimbing = DB::table('peserta')
        ->join('pengajuan', 'peserta.nim', '=', 'pengajuan.nim')
        ->where('peserta.nim', $id)
        ->select('peserta.*', 'pengajuan.nama')
        ->get();
        return view('kabid.pages.view', compact('pembimbing'));
     }
  
}
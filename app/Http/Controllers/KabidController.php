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
    public function absensi(){
        $pengajuan = DB::table('pengajuan')
        ->join('pengajuansekolah', 'pengajuan.pengajuan_id', '=', 'pengajuansekolah.id')
        ->join('jurusan', 'pengajuan.id_jurusan', '=', 'jurusan.id')
        ->join('pembimbing', 'pengajuan.pembimbing_id', '=', 'pembimbing.id')
        ->select('pengajuan.nama', 'pengajuan.nim','pengajuansekolah.tgl_mulai','pengajuansekolah.tgl_selesai','jurusan.nama_jurusan','pembimbing.bagian')
        ->get();
        
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
}
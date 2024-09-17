<?php 
use Illuminate\Support\Facades\DB;

// function list_peserta($pengajuan_id){
//   $data =  DB::table('pengajuan')
//   ->where('pengajuan_id',$pengajuan_id)
//   ->get();
//   return $data;
// }
function list_peserta($pengajuan_id) {
  return DB::table('pengajuan')
      ->join('jurusan', 'pengajuan.id_jurusan', '=', 'jurusan.id')
      ->where('pengajuan.pengajuan_id', $pengajuan_id)
      ->select('pengajuan.*', 'jurusan.nama_jurusan')
      ->get();
      return $data;
}
function list_pesertah($pengajuan_id) {

  return DB::table('pengajuan')
      ->join('jurusan', 'pengajuan.id_jurusan', '=', 'jurusan.id')
      ->leftJoin('pembimbing', 'pengajuan.pembimbing_id', '=', 'pembimbing.id')
      ->leftJoin('users', 'pembimbing.user_id', '=', 'users.id')
      ->where('pengajuan.pengajuan_id', $pengajuan_id)
      ->select(
          'pengajuan.*', 
          'jurusan.nama_jurusan',
          'pembimbing.bagian', 
          'users.name as nama_pembimbing'
      )
      ->get();
}



function list_jurusan($pengajuan_id) {
  return DB::table('pengajuan')
      ->join('jurusan', 'pengajuan.id_jurusan', '=', 'jurusan.id')
      ->where('pengajuan.id', $pengajuan_id)  // Ganti 'pengajuan.pengajuan_id' dengan 'pengajuan.id'
      ->select('pengajuan.*', 'jurusan.nama_jurusan')
      ->first();  // Ambil satu hasil pertama
      return $data;
}
function list_data($balasan_id){
  $data =  DB::table('balasan')
  ->where('balasan_id',$balasan_id)
  ->get();
  return $data;
}
  //  return "pengajuan_id adalah " . $pengajuan_id;


  function list_peserta_hapus($pengajuan_id){
  DB::table('pengajuan')->where('id', $pengajuan_id)->delete();
  }
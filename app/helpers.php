<?php 
use Illuminate\Support\Facades\DB;

function list_peserta($pengajuan_id){
  $data =  DB::table('pengajuan')
  ->where('pengajuan_id',$pengajuan_id)
  ->get();
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
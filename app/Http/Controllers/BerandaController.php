<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function depan(){
        return view("beranda/pages/depan");
    }

    public function mahasiswa(){
        $datas = Pengajuan::all();
    
        return view("mahasiswa/main", compact('datas'));
    }

    
    public function detail(Request $request) {
        $id_mahasiswa = $request->input('id_mahasiswa');
        $data = Pengajuan::find($id_mahasiswa);
        return view('mahasiswa/detail', compact('data'));
    }

    public function destroy($id)
{
    $mahasiswa = Pengajuan::findOrFail($id);
    $mahasiswa->delete();
    return response()->json(['success' => 'Data mahasiswa berhasil dihapus']);
}
public function datamahasiswa(){
    $info = Pengajuan::where("status", "menunggu")->get();
    return view('dashboard.pages.index1', compact('info'));
}



}
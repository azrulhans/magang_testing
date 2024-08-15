<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        return view("landingpages/pages/welcome");
    }
    public function daftar()
    {
        return view("landingpages/pages/pengajuan");
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
      
        return redirect('LandingPages-Status')->with('success', 'Pengajuan Berhasil Tersimpan');;
    }
    
    public function landingPengajuan() {
        $datas = Pengajuan::where('id', auth()->user()->id)->get();
        return view("landingpages/pages/status", compact('datas'));
    }
}
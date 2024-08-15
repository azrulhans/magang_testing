<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index(){
        $peserta = Peserta::all();
        return view('admin.pages.logbook.index', compact('peserta'));
    }

    public function create(){
        $peserta = new Peserta;
        return view('admin.pages.logbook.create', compact('peserta'));
    }
    
    public function store(Request $request){
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'required|string|in:Dalam Proses,Selesai',
            'dokumentasi' =>'nullable|file|mimes:jpg,png,jpeg|max:2048',
        ]);
        $dokumentasiPath = $request->file('dokumentasi') ? $request->file('dokumentasi')->store('dokumentasi', 'public') : null;
        
        $peserta = new Peserta();
        $peserta->judul = $request->judul;
        $peserta->deskripsi = $request->deskripsi;
        $peserta->tanggal = Carbon::now()->format('Y-m-d'); // Set tanggal ke tanggal sekarang
        $peserta->status = $request->status;
        $peserta->dokumentasi = $dokumentasiPath;
        $peserta->save();
        return redirect('dashboard-logbook')->with('success', 'Logbook Berhasil Ditambahkan');;

    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $datas =  auth()->user();
        return view("landingpages/pages/welcome", compact('datas'));
    }
    public function daftar()
    {
        return view("landingpages/pages/pengajuan");
    }

    
    
    public function landingPengajuan($id) {
        $datas = Pengajuan::where('id',$id)->first();
        return view("landingpages/pages/status", compact('datas'));
    }
}
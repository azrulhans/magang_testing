<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index1()
    {
        $data = [
            "title"       => "School Dashboard",
            "description" => "Selamat Datang Di Home",
        ];
        return view("dashboard/pages/index1", $data);
    }

    public function pengajuan(){
        return view("dashboard/pages/pengajuan");
    }
    
}
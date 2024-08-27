<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use App\Models\User;
class SekolahController extends Controller
{
    //dashboard sekolah
    public function index(){
        if (!auth()->user()->role === 'admin') {
            return redirect("dashboard-utama");
        }
        return view('sekolah.index');
    }
    //dashboard create biodata sekolah
    public function biodata()
    {
        return view("sekolah/pages/biodata");
    }
   

}
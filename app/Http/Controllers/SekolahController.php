<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SekolahController extends Controller
{
    //dashboard sekolah
    public function index(){
        if (!auth()->user()->role === 'admin') {
            return redirect("dashboard-utama");
        }
        $user = User::findOrFail(Auth::id());
        return view('sekolah.index',compact('user'));
    }
    //dashboard create biodata sekolah
    public function biodata()
    {
        return view("sekolah/pages/biodata");
    }
   

}
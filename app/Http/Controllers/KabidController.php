<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KabidController extends Controller
{
    public function index(){
        return view('kabid.index');
    }
    public function absensi(){
        return view('kabid.pages.absensi');
    }
}
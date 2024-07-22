<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;


Route::get('/', [LandingPageController::class, 'index']);
// Route::get('login', [LoginController::class, 'halaman']);
// Route::post('login', [LoginController::class, 'login']);
//Route::post('login', [LoginController::class, 'login']);



// Route::prefix('admin')->middleware(["auth"])->controller(DashboardController::class)->group(function () {
    Route::get("index1", [DashboardController::class, 'index1'])->name("index1");
    Route::get("pengajuan",[DashboardController::class, 'pengajuan'] );
    //Route::get('pengguna', 'pengguna')->name("pengguna");
//});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
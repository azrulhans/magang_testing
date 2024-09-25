<?php

use App\Http\Controllers\BerandaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KabidController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\PSekolahController;
use App\Http\Controllers\SekolahController;
use App\Models\Peserta;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;


Route::get('/', [LandingPageController::class, 'index']);
// Route::get('login', [LoginController::class, 'halaman']);
//Route::post('login', [LoginController::class, 'login']);
Route::post('login', [LoginController::class, 'login']);
Route::get('/dashboard', [DashboardController::class , 'index']);
Route::get('/dashboard-bantuan', [DashboardController::class , 'bantuan']);

Route::get('/dashboard-data-status/{id}', [DashboardController::class, 'statusPeserta'])->name('pengajuan.status-data');
Route::post('/dashboard-data-status/{id}', [DashboardController::class, 'konfirmasiPeserta'])->name('pengajuan.status');
Route::get('/dashboard-data-view/{id}', [DashboardController::class, 'show'])->name('pengajuan.view');
Route::delete('/dashboard-data-hapus/{id}', [DashboardController::class, 'hapusPeserta'])->name('dashboard-data-hapus');


//midleware berguna sebagai pembatas atau validasi antara sudah memiliki hak akses dan yg belum
//prefix adalah pengelompokkan routing  ke satu jenis route
Route::group(['middleware' => ['auth', 'role:admin|sekolah|tu|peserta|pembimbing|kabid']], function () {
    //sekolah
    Route::get('dashboard-sekolah',         [SekolahController::class, 'index'])->name("dashboard-sekolah");
    Route::get('biodata-sekolah',           [SekolahController::class, 'biodata'])->name("biodata-sekolah");
    Route::get('/dashboard/{pengajuan_id}', [SekolahController::class, 'show']);
   // Route::get('biodata-peserta',           [PesertaController::class, 'identitas'])->name("identitas-sekolah");
   //Route::post('biodata-peserta-store',    [PesertaController::class, 'pengajuan'])->name("campus.store");
  // Route::delete('/hapus-data/{id}',        [PesertaController::class, 'hapusData'])->name('hapus-data');
   Route::get('pengajuan-surat-magang',           [PSekolahController::class, 'index'])->name("pengajuan.index")->middleware('role:sekolah');
   Route::get('status-surat-magang',           [PSekolahController::class, 'statusPeserta']);
   Route::post('/pengajuan-surat-ajukan',       [PSekolahController::class, 'ajukan'])->name("ajukan");
   Route::get('/pengajuan-surat-view/{id}',     [PSekolahController::class, 'view'])->name("pengajuan-view");
   Route::delete('/pengajuan-hapus/{id}',     [PSekolahController::class, 'destroy'])->name('pengajuan-hapus-peserta');
   Route::post('/pengajuan-surat-store',     [PSekolahController::class, 'pengajuanSurat'])->name("pengajuanSuratstore");
   Route::delete('/pengajuan-surat-delete/{id}',    [PSekolahController::class, 'hapusPengajuan'])->name("pengajuanSuratdelete");
   Route::post('/pengajuan-peserta-storee',    [PSekolahController::class, 'pengajuanPeserta']);
   

    //Route::get('dashboard-peserta',         [DashboardController::class, 'index1'])->name("dashboard-peserta");
    Route::get('/landingpage',              [LandingPageController::class, 'index'])->name("landing-page");
    Route::get('landingpage-peserta',       [LandingPageController::class, 'daftar'])->name('daftar');
    Route::post('landingpage-peserta',      [LandingPageController::class, 'store']);
    Route::get('LandingPages-Status/{id}',  [LandingPageController::class, 'landingPengajuan'])->name('LandingPages-Status');
    Route::post('/logout',                  [LoginController::class, 'logout'])->name('logout');
    
    //routing dashboard admin
    Route::get('/dashboard-utama',                [DashboardController::class , 'dashboard'])->name("dashboard-utama")->middleware('role:admin');
    Route::get('/dashboard-data-peserta-magang',         [DashboardController::class , 'dataPeserta']);
    Route::get('/dashboard-cari-peserta',         [DashboardController::class , 'cariPeserta'])->name("cariPeserta");
    Route::post('/save-pembimbing',              [DashboardController::class, 'savePembimbing'])->name('savePembimbing');
    Route::post('/getPembimbingByBagian',           [DashboardController::class, 'getPembimbingByBagian'])->name('getPembimbingByBagian');
    Route::get('/dashboard-surat-view/{id}',     [DashboardController::class, 'view'])->name("dashboard-view");
    Route::get('/pengajuan-surat-create/{id}',  [DashboardController::class, 'create'])->name("pengajuan-sekolah-create");
    Route::post('/pengajuan-status-store',  [DashboardController::class, 'pengajuanStore'])->name("status.store");
    Route::post('/pengajuan-status',  [DashboardController::class, 'pengajuanStatus'])->name("status.pengajuan.store");

    //routing dashboard peserta
    Route::get('/dashboard-peserta',         [PesertaController::class , 'peserta']);
    Route::get('/dashboard-peserta',         [PesertaController::class , 'dashboard']);
    Route::get('/update-logbook',         [PesertaController::class , 'updatelogbook'])->name('update.logbook.peserta');

    Route::get('/dashboard-data-profile',         [DashboardController::class , 'showProfile']);
    //put dan patch adalah 2 sintak yang sama untuk pengubahan data
    Route::patch('/dashboard-data-profile/{id}',  [DashboardController::class , 'update']);
    
    Route::get('/dashboard-logbook', [PesertaController::class , 'index'])->name('dashboard.logbook');
    Route::post('/logbook-store',  [PesertaController::class , 'store'])->name('logbook.store');
    Route::get('/logbook.edit',  [PesertaController::class , 'edit'])->name('logbook.edit');
    Route::put('/logbook-update',  [PesertaController::class , 'update'])->name('logbook.update');
    Route::get('/dashboard-logbook-tambah', [PesertaController::class , 'create'])->name('logbook.tambah');
    
    //routing dashboard pembimbing
    Route::get('/dashboard-pembimbing',         [PembimbingController::class , 'dashboard']);
    Route::get('/data-pembimbing',         [PembimbingController::class , 'dataPembimbing']);
    Route::get('/dashboard-pembimbing-peserta',         [PembimbingController::class , 'index']);
    Route::get('/dashboard-data-peserta',         [PembimbingController::class , 'peserta']);
    Route::get('/dashboard-data-view',     [PembimbingController::class , 'viewLogbook'])->name('pembimbing.view');
    Route::post('/reopen-form/{id}',            [PembimbingController::class, 'reopenForm'])->name('reopen.form')->middleware('auth', 'role:pembimbing');
    Route::post('/pembimbing-store',            [PembimbingController::class, 'storePembimbing'])->name('pembimbing.store');
     Route::delete('/pembimbing-delete/{id}',    [PembimbingController::class, 'hapusPembimbing'])->name("pembimbing.delete");
     Route::put('/pembimbing/{id}',              [PembimbingController::class, 'update'])->name('pembimbing.update');


     //routing kabid
     Route::get('/dashboard-kabid',         [KabidController::class, 'index'])->middleware('role:kabid');
     Route::get('/dashboard-absensi-peserta',         [KabidController::class, 'absensi'])->name('kabid.absensi');
     Route::get('/dashboarh-peserta-pkl',     [KabidController::class , 'viewLogbook'])->name('kabid.view');
     
    //yang lama
    Route::get("status-pengajuan", [DashboardController::class, 'statusPengajuan'])->name("status.pengajuan");

    Route::get("pengajuan",[DashboardController::class, 'pengajuan'] );
    Route::post("pengajuan" ,[DashboardController::class, 'store']);
    Route::get("bantuan" ,[DashboardController::class, 'bantuan']);

    Route::get("beranda", [BerandaController::class, 'depan']);
    Route::get("mahasiswa", [BerandaController::class, 'mahasiswa']);
    Route::post("mahasiswa-detail", [BerandaController::class, 'detail']);
    Route::delete('/mahasiswa/{id}', [BerandaController::class, 'destroy']);
//batas yg lama
   
    //Route::get('pengguna', 'pengguna')->name("pengguna");
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
@extends('beranda/main')

@section("content")
<div class="row">
    <ol class="breadcrumb">
        <li><a href="index.php?page=beranda">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">Beranda</li>
    </ol>
</div>
<!--/.row-->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Beranda</div>
            <div class="panel-body">

         
            <!-- Menhambil data table tbl_site -->

            <!-- Info Aplikasi -->
            <p>Selamat Datang di Aplikasi Absensi dan Kegiatan Harian Mahasiswa 
            berbasis Web. Sebuah sistem yang memungkinkan para Mahasiswa PKL di KOMINFO untuk melalukan absensi dan mencatat kegiatan harian dari website. Sistem ini diharapkan dapat memberi kemudahan setiap Mahasiswa PKL
             untuk melakukan absensi dan mencatat kegiatan harian.</p>
            <!-- Info Aplikasi -->
            
            </div>
        </div>
    </div>
</div>

@endsection
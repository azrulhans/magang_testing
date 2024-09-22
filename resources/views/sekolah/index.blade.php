@extends('sekolah.layouts.main')
@section("content")

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark text-center">Selamat Datang di Dashboard Sekolah/Kampus</h1>
                    <p class="text-center" style="font-size: 18px; color: #6c757d;">
                        Berikut adalah ringkasan informasi data yang telah Anda input.
                    </p>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Row for Stat boxes -->
            <div class="row">
                <!-- Box 1: Data Surat -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="small-box bg-info" style="
                        border-radius: 10px; 
                        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                        overflow: hidden;">
                        <div class="inner" style="
                            padding: 30px; 
                            text-align: center;">
                            <h3 style="font-size: 36px; margin-bottom: 10px;">{{ $jumlahSurat }}</h3>
                            <p style="font-size: 18px;">Data Surat</p>
                        </div>
                        <div class="icon" style="
                            position: absolute; 
                            top: 20px; 
                            right: 20px; 
                            font-size: 60px;">
                            <i class="ion ion-document-text"></i>
                        </div>
                    </div>
                </div>

                <!-- Box 2: Data Peserta Magang -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="small-box bg-success" style="
                        border-radius: 10px; 
                        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                        overflow: hidden;">
                        <div class="inner" style="
                            padding: 30px; 
                            text-align: center;">
                            <h3 style="font-size: 36px; margin-bottom: 10px;">{{ $jumlahPeserta }}</h3>
                            <p style="font-size: 18px;">Data Peserta Magang</p>
                        </div>
                        <div class="icon" style="
                            position: absolute; 
                            top: 20px; 
                            right: 20px; 
                            font-size: 60px;">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

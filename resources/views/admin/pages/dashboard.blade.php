@extends("admin.layouts.main")
@section('content')
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Selamat Datang di Dashboard Admin!</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

 <!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Pesan Selamat Datang -->
    <div class="row mb-4">
      <div class="col-12">
        <div class="alert" >
          {{-- <h4 class="alert-heading">Selamat Datang di Dashboard Admin!</h4> --}}
          <p>Halo <strong>{{ auth()->user()->name }}</strong>, selamat datang di dashboard admin. Di sini, Anda dapat mengelola data peserta, surat pengajuan, pembimbing, dan bagian dengan mudah. Selamat bekerja!</p>
        </div>
      </div>
    </div>
    
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$jumlahPeserta}}</h3>
            <p>Data Peserta</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$jumlahSurat}} <sup style="font-size: 20px"></sup></h3>
            <p>Data Surat Pengajuan</p>
          </div>
          <div class="icon">
            <i class="fas fa-file-alt"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$jumlahPembimbing}}</h3>
            <p>Data Pembimbing</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{$jumlahBagian}}</h3>
            <p>Data Bagian</p>
          </div>
          <div class="icon">
            <i class="fas fa-map-signs"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
    </div>
  </div><!-- /.container-fluid -->
</section>

    <!-- /.content -->
  </div>
  @endsection
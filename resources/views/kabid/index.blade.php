@extends("kabid.layouts.main")
@section('content')
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
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
          <!-- Small boxes (Stat box) -->
          <div class="row">
              <div class="col-12">
                  <!-- Alert Selamat Datang -->
                  <div class="alert alert-success">
                      <h4 class="alert-heading">Selamat Datang!</h4>
                      <p>Halo <strong>{{ auth()->user()->name }}</strong>, selamat datang di dashboard pak kabid. Di sini, Anda dapat memantau perkembangan dan aktivitas dari peserta magang.</p>
                  </div>
                  <!-- End of Alert -->
              </div>
          </div>
          <!-- ./row -->
      </div><!-- /.container-fluid -->
  </section>
  
    <!-- /.content -->
  </div>
  @endsection
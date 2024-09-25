@extends("pembimbing.layouts.main")
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
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success">
                    <p class="alert-heading">Selamat Datang! </p>
                    <p>Halo <strong>{{ auth()->user()->name }}</strong>,selamat datang di dashboard pembimbing magang, 
                      Anda dapat memantau perkembangan peserta dan memberikan bimbingan. Peran Anda sangat penting untuk menciptakan pengalaman magang yang positif.</p>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- /.content -->
  </div>
  @endsection
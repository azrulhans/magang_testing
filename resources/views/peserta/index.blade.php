@extends("peserta.layouts.main")
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
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
                        <h4 class="alert-heading">Selamat Datang!</h4>
                        <p>Halo <strong>{{ auth()->user()->name }}</strong>, selamat datang di dashboard peserta magang. Semoga pengalaman magang Anda berjalan lancar dan sukses!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection

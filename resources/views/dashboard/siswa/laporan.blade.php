@extends('dashboard/main')
@section("content")

<div class="container">
    <div class="row align-items-center border-bottom py-3">
        <div class="col-3">
            <center>
                <img style="width: 100px; height: 100px;" src="resources/assets/images/unidum.jpeg"
                    alt="Logo" class="img-fluid">
            </center>
        </div>
        <div class="col-6 text-center">
            <h3 class="mb-0">
                Laporan Sekolah SMKN 2 DUMAI
            </h3>
        </div>
        <div class="col-3">
            <center>
                <img style="width: 100px; height: 100px;" src="resources/assets/images/unidum.jpeg"
                    alt="Logo" class="img-fluid">
            </center>
        </div>
    </div>
</div>
<section class="konten mt-2">
<div class="container-fluid">
    <div class="card border-primary">
        <div class="card-header d-flex justify-content-end">
            <a href="" class="btn btn-primary btn-sm float-right">Tambah Petugas</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</section>

@endsection
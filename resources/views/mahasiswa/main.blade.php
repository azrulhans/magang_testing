@extends('beranda/main')

@section("content")

<div class="row">
    <ol class="breadcrumb">
        <li><a href="index.php?page=beranda">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">Data Mahasiswa</li>
    </ol>
</div><!--/.row-->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            Data Mahasiswa
                <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
            <div class="panel-body">
                <div class="row">
                <form action="#" method="GET">
                    <input type="hidden" name="page" value="mahasiswa"/>
                        <div class="col-sm-3">
                            <div class="form-group">
                            <input type="text" name="cari" id="cari" class="form-control"  value="" placeholder="Pencarian">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div><!--/.row-->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">

            <?php
                // Validasi untuk menampilkan pesan pemberitahuan saat user menambah admin
                if (isset($_GET['add'])) {
                    if ($_GET['add']=='berhasil'){
                        echo"<div class='alert alert-success'><strong>Berhasil!</strong> Data Mahasiswa Telah Disimpan</div>";
                    }else if ($_GET['add']=='gagal'){
                        echo"<div class='alert alert-danger'><strong>Gagal!</strong> Data Mahasiswa Gagal Disimpan</div>";
                    }    
                }

                // Validasi untuk menampilkan pesan pemberitahuan saat user mengedit admin
                if (isset($_GET['edit'])) {
                    if ($_GET['edit']=='berhasil'){
                        echo"<div class='alert alert-success'><strong>Berhasil!</strong> Data Mahasiswa Telah Diupdate</div>";
                    }else if ($_GET['edit']=='gagal'){
                        echo"<div class='alert alert-danger'><strong>Gagal!</strong> Data Mahasiswa Gagal Diupdate</div>";
                    }    
                }

                // Validasi untuk menampilkan pesan pemberitahuan saat user menghapus admin
                if (isset($_GET['pengguna'])) {
                    if ($_GET['pengguna']=='berhasil'){
                        echo"<div class='alert alert-success'><strong>Berhasil!</strong> Setting Data Mahasiswa Berhasil</div>";
                    }else if ($_GET['pengguna']=='gagal'){
                        echo"<div class='alert alert-danger'><strong>Gagal!</strong> Setting Data Mahasiswa Gagal</div>";
                    }    
                }

                // Validasi untuk menampilkan pesan pemberitahuan saat user menghapus admin
                if (isset($_GET['hapus'])) {
                    if ($_GET['hapus']=='berhasil'){
                        echo"<div class='alert alert-success'><strong>Berhasil!</strong> Data Mahasiswa Telah Dihapus</div>";
                    }else if ($_GET['hapus']=='gagal'){
                        echo"<div class='alert alert-danger'><strong>Gagal!</strong> Data Mahasiswa Gagal Dihapus</div>";
                    }    
                }
            ?>
                <div class="form-group">
                    <button type="button" class="btn btn-success" id="tombol_tambah"><i class="fa fa-plus"></i> Tambah</button>
                </div>
                <div class="table-responsive">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Nim</th>
                                <th>Asal Sekolah</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>No.Telp</th>
                                <th>Mulai Magang</th>
                                <th>Ahir Magang</th>
                                <th>Foto</th>
                                <th>Surat Pengajuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
    
                        <tbody>
                            @foreach($datas as $m)
                        <tr>
                            <td>{{$loop->iteration}} </td>
                            <td> {{$m -> nama}} </td>
                            <td> {{$m -> jurusan}} </td>
                            <td> {{$m -> nim}} </td>
                            <td> {{$m -> asal_sekolah}} </td>
                            <td> {{$m -> email}} </td>
                            <td> {{$m -> alamat}} </td>
                            <td> {{$m -> no_hp}} </td>
                            <td> {{$m -> tgl_awal}} </td>
                            <td> {{$m -> tgl_akhir}} </td>
                            <td> 
                                @if($m->foto)
                                <img src="{{ asset('storage/' . $m->foto) }}" alt="Foto {{ $m->nama }}" width="80" height="80">
                            @else
                                Tidak ada foto
                            @endif    
                            </td>
                            <td> 
                                @if($m->surat)
                                <a href="{{ asset('storage/' . $m->surat) }}" target="_blank">Lihat Surat</a>
                            @else
                                Tidak ada surat
                            @endif
                            </td>
                            {{-- <td> --}}
                                {{-- <button id_mahasiswa=" {{$m->id_mahasiswa}} " class="tombol_detail btn btn-success btn-circle" ><i class="fa fa-mouse-pointer"></i></button> --}}
                                {{-- <button kode_mahasiswa="" class="tombol_setting btn btn-primary btn-circle" ><i class="fa fa-user"></i></button> --}}
                                {{-- <button id_mahasiswa="" class="tombol_edit btn btn-warning btn-circle" ><i class="fa fa-edit"></i></button>
                                <a href="#" data-id="{{ $m->id }}" class="btn-hapus-mahasiswa btn btn-danger btn-circle">
                                    <i class="fa fa-trash"></i>
                                </a>
                                
                            </td> --}}
                            <td>
                                <form action="{{ route('beranda.approve', ['id' => $m->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Terima</button>
                                </form>
                                <form action="{{ route('beranda.reject', ['id' => $m->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <!-- bagian akhir (penutup) while -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><!--/.row-->

<!-- Modal -->
<div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <div class="modal-header">
            <h4 class="modal-title" id="judul"></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
            <div id="tampil_data">                   
            </div>  
        </div>
  
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>

        </div>
    </div>
</div>

<!-- Data akan di load menggunakan AJAX -->
<script>
    // Tambah admin
    $('#tombol_tambah').on('click',function(){
        $.ajax({
            url: 'mahasiswa-detail',
            method: 'post',
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Tambah Mahasiswa';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
    // Detail Mahasiswa
    $('.tombol_detail').on('click',function(){
        var id_mahasiswa = $(this).attr("id_mahasiswa");
        $.ajax({
            url: '/mahasiswa-detail',
            method: 'get',
            data: {id_mahasiswa:id_mahasiswa},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Detail Mahasiswa';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>


<script>
    // Setting Mahasiswa
    $('.tombol_setting').on('click',function(){
        var kode_mahasiswa = $(this).attr("kode_mahasiswa");
        $.ajax({
            url: 'apps/mahasiswa/pengguna.php',
            method: 'post',
            data: {kode_mahasiswa:kode_mahasiswa},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Setting Mahasiswa';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>


<script>
    // Edit Mahasiswa
    $('.tombol_edit').on('click',function(){
        var id_mahasiswa = $(this).attr("id_mahasiswa");
        $.ajax({
            url: 'apps/mahasiswa/edit.php',
            method: 'post',
            data: {id_mahasiswa:id_mahasiswa},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Edit Mahasiswa';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
    //hapus data mahasiswa
    $(document).ready(function() {
        $('.btn-hapus-mahasiswa').on('click', function(e) {
            e.preventDefault();
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                var id_mahasiswa = $(this).data('id'); // Ambil id_mahasiswa dari atribut data-id

                $.ajax({
                    url: '/mahasiswa/' + id_mahasiswa,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.success);
                        location.reload(); // Refresh halaman setelah data berhasil dihapus
                    },
                    error: function(xhr) {
                        alert('Gagal menghapus data');
                    }
                });
            }
        });
    });
</script>

<!-- Data akan di load menggunakan AJAX -->
@endsection
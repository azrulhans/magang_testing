@extends("sekolah.layouts.main")
@section('content')
@include('sweetalert::alert')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Peserta Magang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a class="breadcrumb-item active" href="#peserta" data-toggle="tab">Pengisian Identitas Kampus</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content" id="peserta">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{asset('biodata-peserta')}}" class="btn btn-md btn-primary" data-toggle="modal" data-target="#addCampusModal">
                            <i class="fas fa-plus-square"></i>
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="overflow: auto">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nim</th>
                                    <th>Alamat</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peserta as $p)
                                <tr>
                                    <td>{{$loop->iteration}} </td>
                                    <td> {{$p ->nama}} </td>
                                    <td> {{$p ->nim}} </td>
                                    <td> {{$p ->jurusan}} </td>
                                    <td> {{$p ->tgl_awal}} </td>
                                    <td> {{$p ->tgl_akhir}} </td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-success">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="" class="btn btn-sm btn-warning">
                                            <i class="fas fa-pen-square"></i>
                                        </a>
                                        <!-- Button trigger modal -->
                                            <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{ $p->id }}">
                                                <i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    
                </div>
            </div>
        </div>
    </section>
</div>
@foreach($peserta as $p)
<!-- Modal Hapus -->
      <div class="modal fade" id="exampleModal{{ $p->id }}" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel{{ $p->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel{{ $p->id }}">Hapus Peserta</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin akan menghapus data {{ $p->nama }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{ route('hapus-data' , $p->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $p->id }}">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
{{-- batas modal hapus --}}

<!-- Modal for Adding Campus -->
<div class="modal fade" id="addCampusModal" tabindex="-1" role="dialog" aria-labelledby="addCampusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCampusModalLabel">Tambah Peserta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('campus.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kampus">Nama</label>
                        <input type="text" class="form-control" id="nama_kampus" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat_kampus">Nim / Nis</label>
                        <input type="text" class="form-control" id="alamat_kampus" name="nim" required>
                    </div>
                    <div class="form-group">
                        <label for="akreditasi_kampus">Jurusan</label>
                        <input type="text" class="form-control" id="akreditasi_kampus" name="jurusan" required>
                    </div>
                    <div class="form-group">
                        <label for="no_lldikti">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="no_lldikti" name="tgl_awal" required>
                    </div>
                    <div class="form-group">
                        <label for="no_lldikt">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="no_lldikt" name="tgl_akhir" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- batas modal tambah --}}
@endsection
@extends("admin.layouts.main")
@section('content')
@include('sweetalert::alert')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pembimbing</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a class="breadcrumb-item active" href="#peserta" data-toggle="tab">Pengisian Data Pembimbing</a>
                      
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
    <div class="row align-items-center">
        <!-- Tombol Tambah -->
        <div class="col-md-6">
            <a href="#" class="btn btn-md btn-primary" data-toggle="modal" data-target="#addCampusModal">
                <i class="fas fa-plus-square"></i>
            </a>
        </div>
        
        <!-- Form Pencarian -->
        <div class="col-md-6 text-right">
            <form method="GET" action="#" class="d-inline-block">
                <div class="form-group mb-0 d-inline-block mr-2">
                    <input type="date" name="date" class="form-control" placeholder="Tanggal Surat" value="{{ request('date') }}">
                </div>
                <div class="d-inline-block">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /.card-body -->

           <!-- /.card-header -->
           <div class="card-body" style="overflow: auto">
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pembimbing</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Bagian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembimbing as $index => $p)
                    <tr>
                        <td>{{ $loop->iteration }} </td>
                        <td>{{ $p->user->name }}</td>
                        <td>{{ $p->user->username }}</td>
                        <td>{{ $p->user->email }}</td>
                        <td>{{ $p->bagian }}</td>
                        <td>
                        <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#createModal">
                            <i class="fas fa-edit">edit</i> 
                            </a>
                            <!-- Button trigger modal -->
                                <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{ $p->id }}">
                                    <i class="fas fa-trash"></i>hapus</a>
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

<!-- Modal for add pembimbing -->
<div class="modal fade" id="addCampusModal" tabindex="-1" role="dialog" aria-labelledby="addCampusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCampusModalLabel">Tambah Pembimbing</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('pembimbing.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kampus">Nama</label>
                        <input type="text" class="form-control" id="nama_kampus" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat_kampus">Username</label>
                        <input type="text" class="form-control" id="alamat_kampus" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat_kampus">Email</label>
                        <input type="email" class="form-control" id="alamat_kampus" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="no_lldikti">Password</label>
                        <input type="password" class="form-control" id="no_lldikti" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="no_lldikt">Bagian</label>
                        <input type="text" class="form-control" id="no_lldikt" name="bagian" required>
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

<!-- Modal Hapus -->
@foreach($pembimbing as $p)
<div class="modal fade" id="exampleModal{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $p->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel{{ $p->id }}">Hapus Pembimbing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin akan menghapus data {{ $p->user->name }}?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <form action="{{ route('pembimbing.delete', $p->user_id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- batas modal hapus --}}
@endsection
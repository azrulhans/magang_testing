@extends("admin.layouts.main")
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Peserta Magang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a class="breadcrumb-item active" href="#peserta" data-toggle="tab">Data Peserta </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" id="peserta">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Peserta</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="overflow: auto">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Mulai Magang</th>
                                    <th>Akhir Magang</th>
                                    <th>Foto</th>
                                    <th>Surat Pengajuan</th>
                                    <th>Aksi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datas as $m)
                                <tr>
                                    <td>{{ ($datas->currentpage()-1) * $datas->perpage() + $loop->index + 1 }}</td>
                                    <td>{{ $m->nama }}</td>
                                    <td>{{ $m->tgl_awal }}</td>
                                    <td>{{ $m->tgl_akhir }}</td>
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
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn " href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                                </svg>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ asset('dashboard-data-status/' . $m->id) }}">Status</a>
                                                <a class="dropdown-item" href="{{ asset('dashboard-data-view/' . $m->id) }}">Lihat</a>
                                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#exampleModal{{ $m->id }}">Hapus</a>
                                            </div>
                                        </div>
                                 <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $m->id }}" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel{{ $m->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel{{ $m->id }}">Hapus Peserta</h1>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin akan menghapus data {{ $m->nama }}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="{{ route('dashboard-data-hapus' , $m->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $m->id }}">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                                    </td>
                                    <td>
                                        @if($m->status == 'active')
                                        <span class="badge bg-warning">Belum Diisi</span>
                                        @elseif($m->status == 'diterima')
                                        <span class="badge bg-success">Diterima</span>
                                        @elseif($m->status == 'ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $datas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->
@endsection
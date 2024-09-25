@extends("kabid.layouts.main")
@section('content')
@include('sweetalert::alert')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Peserta</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a class="breadcrumb-item active" href="#peserta" data-toggle="tab">Detail Peserta</a>
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
                    <!-- Form Pencarian di atas tabel -->
                    <div class="card-header">
                      <!-- Form Pencarian -->
                        <form action="{{ route('kabid.absensi') }}" method="GET">
                            <div class="row mb-1">
                                <div class="col-md-3">
                                    <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request()->input('search') }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="overflow: auto">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nim</th>
                                    <th>Jurusan</th>
                                    <th>Bagian</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Kehadiran</th>
                                    <th>Logbook</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach($pengajuan as $p)
                                <tr>
                                    <td>{{$loop->iteration}} </td>
                                    <td> {{ $p->nama ?? 'Nama tidak ditemukan' }}</td>
                                    <td> {{$p->nim}}  </td>
                                    <td>
                                        {{$p->nama_jurusan}}
                                    </td>
                                    <td>
                                        {{$p->bagian}}
                                    </td>
                                    <td> {{$p ->tgl_mulai}} </td>
                                    <td> 
                                        {{$p ->tgl_selesai}} 
                                    </td>
                                    <td>{{$p->kehadiran}} </td>
                                    <td>
                                        <a href="{{route('kabid.view') . '?id=' . $p->nim}}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye">Lihat</i> 
                                            </a>
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

</div>
@endsection
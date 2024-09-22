@extends("kabid.layouts.main")
@section('content')
@include('sweetalert::alert')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Absensi Peserta</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a class="breadcrumb-item active" href="#peserta" data-toggle="tab">Pengisian Logbook</a>
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
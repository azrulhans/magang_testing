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
                                    <th>Bagian</th>
                                    <th>Pembimbing</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach($peserta as $p)
                                <tr>
                                    <td>{{$loop->iteration}} </td>
                                    <td> {{ $p->user->name ?? 'Nama tidak ditemukan' }}</td>
                                    <td> {{$p->judul}}  </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($p->tanggal)->format('d-m-Y') }}
                                    </td>
                                    <td> {{$p ->deskripsi}} </td>
                                    <td> 
                                        @if($p->dokumentasi)
                                        <img src="{{ asset('storage/' . $p->dokumentasi) }}" alt="Dokumentasi    {{ $p->judul }}" width="80" height="80">
                                    @else
                                        Tidak ada dokumentasi
                                    @endif    
                                    </td>
                                    <td>
                                        @if(!$p->is_reopened)
                             <form action="{{ route('reopen.form', $p->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                 <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fas fa-check"></i> Buka Kembali
                    </button>
                </form>
            @else
                <button class="btn btn-sm btn-secondary" disabled>
                    <i class="fas fa-check"></i> Sudah Dibuka
                </button>
            @endif
                                        <a href="#" class="btn btn-sm btn-success">
                                            <i class="fas fa-eye"></i> 
                                            </a>
                                    </td> --}}
                                {{-- </tr>
                                @endforeach --}}
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
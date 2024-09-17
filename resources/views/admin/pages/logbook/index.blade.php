@extends("admin.layouts.main")
@section('content')
@include('sweetalert::alert')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Logbook Harian</h1>
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
                    <div class="card-header">
                        @php
                        // Ambil logbook hari ini untuk peserta yang login, pertimbangkan juga jika form dibuka kembali
                        $logbookHariIni = \App\Models\Peserta::where('tanggal', \Carbon\Carbon::now()->format('Y-m-d'))
                                                             ->where('user_id', auth()->user()->id) // Pastikan user_id sama dengan peserta login
                                                            ->latest('tanggal')
                                                            ->first();
                        @endphp
                    

                        @if(!$logbookHariIni)
                        <!-- Tombol Tambah Logbook hanya muncul jika belum ada logbook hari ini atau form telah dibuka kembali -->
                        <a href="{{ route('logbook.tambah') }}" class="btn btn-md btn-primary">
                            <i class="fas fa-plus-square"></i> Tambah Logbook
                        </a>

                        @elseif($logbookHariIni && $logbookHariIni->is_reopened)
                            <!-- Tombol Edit Logbook hanya muncul jika form dibuka kembali -->
                            <a href="{{ route('logbook.edit') }}" class="btn btn-md btn-warning">
                                <i class="fas fa-edit"></i> Edit Logbook
                            </a>
                        
                    @else
                        <!-- Pesan yang ditampilkan ketika logbook sudah diisi dan form tidak terbuka -->
                        <div class="alert alert-success" role="alert">
                            Anda sudah mengisi logbook hari ini.
                        </div>
                    @endif

                
                    </div>
                    

                    <!-- /.card-header -->
                    <div class="card-body" style="overflow: auto">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th>Deskripsi</th>
                                    <th>Dokumentasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peserta as $p)
                                <tr>
                                    <td>{{$loop->iteration}} </td>
                                    <td> {{$p ->judul}} </td>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus item ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
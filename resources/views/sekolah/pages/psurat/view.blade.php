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
                        <a href="{{asset('pengajuan-surat')}}" class="btn btn-md btn-primary" data-toggle="modal" data-target="#addCampusModal">
                            <i class="fas fa-plus-square"></i>
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="overflow: auto">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Surat</th>
                                    <th>Tanggal Surat</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Surat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peserta as $p)
                                <tr>
                                    <td>{{$loop->iteration}} </td>
                                    <td> {{$p ->no_surat}} </td>
                                    <td> {{$p ->tgl_surat}} </td>
                                    <td> {{$p ->tgl_mulai}} </td>
                                    <td> {{$p ->tgl_selesai}} </td>
                                    <td> 
                                        @if($p->surat)
                                        <a href="{{ asset('storage/' . $p->surat) }}" target="_blank">Lihat Surat</a>
                                    @else
                                        Tidak ada surat
                                    @endif    
                                    </td>
                                    <td>
                                        <a href="{{ asset('pengajuan-surat-view/' . $p->id) }}"  class="btn btn-sm btn-success" data-toggle="modal" data-target="#viewModal{{ $p->id }}"
                                            data-no-surat="{{ $p->no_surat }}"
                                            data-tgl-surat="{{ $p->tgl_surat }}"
                                            data-tgl-mulai="{{ $p->tgl_mulai }}"
                                            data-tgl-selesai="{{ $p->tgl_selesai }}"
                                            data-surat="{{ asset('storage/' . $p->surat) }}">
                                            <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addDataModal{{ $p->id }}">
                                        <i class="fas fa-plus-square"></i> 
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
<!-- Modal View -->
<style>
    .modal-body .row {
    display: flex;
    flex-wrap: wrap;
}

.modal-body .col-md-6 {
    flex: 1;
    padding: 10px;
}

</style>
@foreach($pengajuan as $p)
<div class="modal fade" id="viewModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel{{ $p->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel{{ $p->id }}">Detail Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nomor Surat:</strong> <span id="modal-no-surat{{ $p->id }}">{{ $p->no_surat }}</span></p>
                        <p><strong>Tanggal Surat:</strong> <span id="modal-tgl-surat{{ $p->id }}">{{ $p->tgl_surat }}</span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Tanggal Mulai:</strong> <span id="modal-tgl-mulai{{ $p->id }}">{{ $p->tgl_mulai }}</span></p>
                        <p><strong>Tanggal Akhir:</strong> <span id="modal-tgl-selesai{{ $p->id }}">{{ $p->tgl_selesai }}</span></p>
                        <p><strong>Surat:</strong> 
                            @if($p->surat)
                                <a href="{{ asset('storage/' . $p->surat) }}" target="_blank">Lihat Surat</a>
                            @else
                                Tidak ada surat
                            @endif
                        </p>
                    </div>
                </div>
                <hr>
                <h5 class="modal-title">Detail Peserta</h5>
                <div class="card-body" style="overflow: auto;">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nim</th>
                                <th>Jurusan</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>No Hp</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->nama }}</td>
                                <td>{{ $d->nim }}</td>
                                <td>{{ $d->jurusan->nama_jurusan ?? 'Jurusan tidak ditemukan' }}</td>
                                <td>{{ $d->alamat }}</td>
                                <td>{{ $d->jk }}</td>
                                <td>{{ $d->no_hp }}</td>
                                <td>{{ $d->email }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" data-id="{{ $p->id }}" class="btn btn-primary btn-ajukan">Ajukan</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

@endforeach
<script>
    $(document).ready(function() {
        $('.btn-view').on('click', function() {
            var id = $(this).data('id');
            var modal = $('#viewModal' + id);
    
            $.ajax({
                url: '{{ url("pengajuan/view") }}/' + id,
                type: 'GET',
                success: function(response) {
                    // Isi modal dengan data yang didapat dari response
                    modal.find('#modal-no-surat' + id).text(response.pengajuan.no_surat);
                    modal.find('#modal-tgl-surat' + id).text(response.pengajuan.tgl_surat);
                    modal.find('#modal-tgl-mulai' + id).text(response.pengajuan.tgl_mulai);
                    modal.find('#modal-tgl-selesai' + id).text(response.pengajuan.tgl_selesai);
    
                    var pesertaTable = modal.find('tbody');
                    pesertaTable.empty();
                    $.each(response.data, function(index, peserta) {
                        pesertaTable.append(
                            '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + peserta.nama + '</td>' +
                            '<td>' + peserta.nim + '</td>' +
                            '<td>' + (peserta.jurusan ? peserta.jurusan.nama_jurusan : 'Jurusan tidak ditemukan') + '</td>' +
                            '<td>' + peserta.alamat + '</td>' +
                            '<td>' + peserta.jk + '</td>' +
                            '<td>' + peserta.no_hp + '</td>' +
                            '<td>' + peserta.email + '</td>' +
                            '</tr>'
                        );
                    });
    
                    modal.modal('show');
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat mengambil data.');
                }
            });
        });
    });
    </script>
{{-- Batas view --}}


@endsection
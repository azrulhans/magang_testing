@extends("sekolah.layouts.main")
@section('content')
@include('sweetalert::alert')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Status Magang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a class="breadcrumb-item active" href="#peserta" data-toggle="tab">Status Peserta Magang</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
<section class="content">
    <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body" style="overflow: auto">
              <table  class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Surat</th>
                    <th>Tanggal Surat</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Surat Balasan</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($peserta as $p)
                  <tr>
                    <td>{{$loop->iteration}} </td>
                    <td> {{$p ->no_surat}} </td>
                    <td> {{$p ->tgl_surat}} </td>
                    <td> 
                        @if($p->balasan)
                        @switch($p->balasan->status)
                            @case('diterima')
                                <span class="badge bg-success">Diterima</span>
                                @break
                
                            @case('ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                                @break
                
                            @default
                                <span class="badge bg-secondary">Status Tidak Diketahui</span>
                        @endswitch
                    @else
                        <span class="badge bg-primary">Proses</span>
                    @endif
                    </td>
                    <td>
                        @if($p->balasan)
                            @if($p->balasan->status == 'ditolak')
                                {{ $p->balasan->alasan }} {{-- Menampilkan alasan penolakan --}}
                            @elseif($p->balasan->status == 'diterima')
                                Selamat, kamu diterima! {{-- Menampilkan pesan diterima --}}
                            @endif
                        @else
                            <span class="badge bg-primary">Proses</span>
                        @endif
                    </td>
                
                    <!-- Kolom untuk menampilkan surat balasan -->
                    <td>
                        @if($p->balasan)
                            @if($p->balasan->status == 'diterima')
                                <a href="{{ asset('storage/surat_balasan/' . basename($p->balasan->surat_balasan)) }}" target="_blank">
                                    Lihat Surat Balasan
                                </a> {{-- Link untuk melihat surat balasan jika diterima --}}
                            @elseif($p->balasan->status == 'ditolak')
                                Tidak ada surat balasan {{-- Menampilkan pesan "tidak ada surat balasan" jika ditolak --}}
                            @endif
                        @else
                            <span class="badge bg-primary">Proses</span>
                        @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
</section>
</div>
@endsection
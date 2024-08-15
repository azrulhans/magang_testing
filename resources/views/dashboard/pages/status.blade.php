@extends('dashboard/main')

@section("content")
@include('sweetalert::alert')

<div class="content-wrapper">
          <div class="card">
            <div class="card-header">
              <h2 class="card-title">Data Diri</h2>
              <P>Data Anda Berhasil Disimpan</P>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="overflow: auto">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Mulai Magang</th>
                    <th>Ahir Magang</th>
                    <th>Foto</th>
                    <th>Surat Pengajuan</th>
                    <th>Status</th></th>
                 
                </tr>
                </thead>
                <tbody>
                    @foreach($datas as $m)
                    <tr>
                        <td>{{$loop->iteration}} </td>
                        <td> {{$m -> nama}} </td>
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
                        <td>
                          @if($m->status == 'active')
                          <span class="badge bg-warning">Menunggu</span>
                          @elseif($m->status == 'diterima')
                          <span class="badge bg-success ">Diterima</span>
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
          </div>
          <div class="card card-primary card-outline mt-3">
            @foreach($datas as $m)
            <div class="card-header text-center">
                @if($m->status == 'active')
                    <h2 class="card-title m-0">Menunggu</h2>
                @elseif($m->status == 'diterima')
                    <h2 class="card-title m-0">Diterima</h2>
                @elseif($m->status == 'ditolak')
                    <h2 class="card-title m-0">Ditolak</h2>
                @endif
            </div>
            <div class="card-body text-center">
                @if($m->status == 'active')
                    <h6 class="card-title">Harap Menunggu Persetujuan</h6>
                @elseif($m->status == 'diterima')
                    <h6 class="card-title">Selamat Anda Diterima Magang Di KOMINFO Kota Dumai</h6>
                @elseif($m->status == 'ditolak')
                    <h6 class="card-title">Pengajuan Anda Ditolak</h6>
                @endif
            </div>
        @endforeach

        </div>
</div>
@endsection

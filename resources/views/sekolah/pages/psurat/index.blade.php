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
                            <a class="breadcrumb-item active" href="#peserta" data-toggle="tab">Pengisian Data Magang</a>
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
                        <a href="{{ asset('pengajuan-surat') }}" class="btn btn-md btn-primary" data-toggle="modal" data-target="#addCampusModal">
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
                                    <td>{{ ($peserta->currentPage() - 1) * $peserta->perPage() + $loop->iteration }}</td>
                                    <td>{{ $p->no_surat }}</td>
                                    <td>{{ $p->tgl_surat }}</td>
                                    <td>{{ $p->tgl_mulai }}</td>
                                    <td>{{ $p->tgl_selesai }}</td>
                                    <td>
                                        @if($p->surat)
                                            <a href="{{ asset('storage/' . $p->surat) }}" target="_blank">Lihat Surat</a>
                                        @else
                                            Tidak ada surat
                                        @endif    
                                    </td>
                                    <td>
                                        <a href="{{ asset('pengajuan-surat-view/' . $p->id) }}" class="btn btn-sm btn-success" data-toggle="modal" data-target="#viewModal{{ $p->id }}"
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
                                        <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{ $p->id }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
    
                        <!-- Pagination Links -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                              <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                              <li class="page-item"><a class="page-link" href="#">1</a></li>
                              <li class="page-item"><a class="page-link" href="#">2</a></li>
                              <li class="page-item"><a class="page-link" href="#">3</a></li>
                              <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                            </ul>
                          </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
    
    
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Status Peserta Magang</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data status pengajuan magang</h3>
  
                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
  
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
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
                    Apakah anda yakin akan menghapus data {{ $p->no_surat }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{ asset('pengajuan-surat-delete/' . $p->id) }}" method="POST" style="display:inline;">
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
@foreach($peserta as $p)
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
                <h5 class="modal-title">Detail Peserta </h5>
                <div class="card-body" style="overflow: auto;">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
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
                            @foreach(list_peserta($p->id) as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td> 
                                    <form action="{{ route('pengajuan-hapus-peserta', $d->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>{{ $d->nama }}</td>
                                <td>{{ $d->nim }}</td>
                                <td>{{ $d->nama_jurusan ?? 'Jurusan tidak ditemukan' }}</td>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>

@endforeach
{{-- Batas view --}}


<!-- Modal Add peserta -->
@foreach($peserta as $p)
<div class="modal fade" id="addDataModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="addDataModalLabel{{ $p->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDataModalLabel{{ $p->id }}">Tambah Data Peserta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pengajuan-peserta-storee" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="pengajuan_id" value="{{$p->id}}" >
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama"  required>
                    </div>
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim"  required>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <input type="text" class="form-control" id="jurusan" name="jurusan"  required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat"  required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" id="jenis_kelamin" name="jk" required>
                            <option value="Laki-laki" >Laki-laki</option>
                            <option value="Perempuan" >Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"  required>
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
@endforeach
{{-- batas add peserta --}}

<!-- Modal for Adding surat -->
<div class="modal fade" id="addCampusModal" tabindex="-1" role="dialog" aria-labelledby="addCampusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCampusModalLabel">Tambah Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('pengajuanSuratstore') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    @foreach($peserta as $p)
                    <input type="hidden" class="form-control" name="user_id" value="{{$p->id}}"  >
                   @endforeach
                    <div class="form-group">
                        <label for="nama_kampus">Nomor Surat</label>
                        <input type="text" class="form-control" id="nama_kampus" name="no_surat" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat_kampus">Tanggal Surat</label>
                        <input type="date" class="form-control" id="alamat_kampus" name="tgl_surat" required>
                    </div>
                    <div class="form-group">
                        <label for="no_lldikti">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="no_lldikti" name="tgl_mulai" required>
                    </div>
                    <div class="form-group">
                        <label for="no_lldikt">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="no_lldikt" name="tgl_selesai" required>
                    </div>
                    <div class="form-group">
                        <div id="msg"></div>
                        <label>Surat Pengajuan Magang :</label>
                        <input type="file" name="surat" class="file surat" accept="application/pdf" style="display: none;">
                        <div class="input-group my-3">
                            <input type="text" class="form-control" disabled placeholder="Upload Surat" id="file_surat">
                            <div class="input-group-append">
                                <button type="button" id="pilih_surat" class="browse btn btn-info"><i class="fa fa-search"></i> Pilih</button>
                            </div>
                        </div>
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

<script>
document.querySelector('#pilih_surat').addEventListener('click', function() {
    document.querySelector('.file.surat').click();
});

document.querySelector('.file.surat').addEventListener('change', function(e) {
    var file = e.target.files[0];
    if (file) {
        // Check file type
        if (file.type !== 'application/pdf') {
            alert('Silakan unggah file dalam format PDF.');
            e.target.value = ''; // Clear the input
            return;
        }
        
        // Check file size (5 MB = 5 * 1024 * 1024 bytes)
        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran file maksimal adalah 5 MB.');
            e.target.value = ''; // Clear the input
            return;
        }
        
        // Set file name to the input text
        document.querySelector('#file_surat').value = file.name;
    }
});
</script>

@endsection
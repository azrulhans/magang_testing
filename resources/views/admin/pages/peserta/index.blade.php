@extends("admin.layouts.main")
@section('content')
@include('sweetalert::alert')


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pengajuan Magang</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content" id="peserta">
        <div class="row">
            <div class="col-12">
                <div class="card">
                 {{-- <div class="card-header"> --}}
        <!-- Form Pencarian -->
        {{-- <div class="col-md-6"> --}}
            {{-- <div class="d-flex justify-content-start">
                <form method="GET" action="{{ route('cariPeserta') }}" class="d-inline-block">
                    <div class="form-group mb-0 d-inline-block mr-2">
                        <input type="date" name="date" class="form-control" placeholder="Tanggal Surat" value="{{ request('date') }}">
                    </div>
                    <div class="d-inline-block">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div> --}}
        {{-- </div> --}}
{{-- </div> --}}

                    
                    <!-- /.card-header -->
                    <div class="card-body" style="overflow: auto">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Sekolah</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th width="200">Alamat</th>
                                    <th>Surat</th>
                                    <th>Aksi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peserta->sortBy(function($p) {
                                    return is_null($p->balasan) ? 0 : 1;
                                }) as $p)
                                <tr>
                                    <td>{{$loop->iteration}} </td>
                                    <td>{{$p->name}} </td>
                                    <td> {{$p ->email}} </td>
                                    <td> {{$p ->no_hp}} </td>
                                    <td> {{$p ->alamat}} </td>
                                    <td> 
                                        @if($p->surat)
                                        <a href="{{ asset('storage/' . $p->surat) }}" target="_blank">Lihat Surat</a>
                                    @else
                                        Tidak ada surat
                                    @endif    
                                    </td>
                                    <td>
                                        <a href="{{ asset('dashboard-surat-view/' . $p->id ) }}"  class="btn btn-sm btn-success" data-toggle="modal" data-target="#viewModal{{ $p->id }}"
                                            data-no-surat="{{ $p->no_surat }}"
                                            data-tgl-surat="{{ $p->tgl_surat }}"
                                            data-tgl-mulai="{{ $p->tgl_mulai }}"
                                            data-tgl-selesai="{{ $p->tgl_selesai }}"
                                            data-surat="{{ asset('storage/' . $p->surat) }}">
                                            <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ asset('pengajuan-surat-create/' . $p->id) }}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createModal{{ $p->id }}">
                                        <i class="fas fa-plus-square"></i> 
                                        </a>
                                        <!-- Button trigger modal -->
                                            <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal{{ $p->id }}">
                                                <i class="fas fa-trash"></i></a>
                                    </td>
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
                                            <span class="badge bg-secondary">Belum Diisi</span>
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
                        <p><strong>Nama Sekolah / Kampus:</strong> <span id="modal-no-surat{{ $p->id }}">{{ $p->name }}</span></p>
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
                            @foreach(list_peserta($p->id) as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
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
                    <br>
                    <form action="{{ route('status.pengajuan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="balasan_id" value="{{ $p->id }}">
                            <label for="status{{ $p->id }}">Status:</label>
                            <select class="form-control" id="status{{ $p->id }}" name="status" onchange="toggleFormFields({{ $p->id }})">
                                <option disabled selected>Pilih Status</option>
                                <option value="diterima"{{ old('status', $p->balasan->status ?? '') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="ditolak" {{ old('status', $p->balasan->status ?? '') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                        
                        <!-- Text Area Alasan Ditolak -->
                        <div class="form-group" id="alasanDitolak{{ $p->id }}" style="display: {{ old('status', $p->balasan->status ?? $p->status) == 'ditolak' ? 'block' : 'none' }};">
                            <label for="alasan{{ $p->id }}">Alasan Penolakan:</label>
                            <textarea class="form-control" id="alasan{{ $p->id }}" name="alasan" rows="3">{{ old('alasan', $p->balasan->alasan ?? '') }}</textarea>
                        </div>
                    
                        <!-- Form Input File Surat Balasan -->
                        <div class="form-group" id="suratBalasan{{ $p->id }}" style="display: {{ old('status', $p->balasan->status ?? $p->status) == 'diterima' ? 'block' : 'none' }};">
                            <label for="surat{{ $p->id }}">Upload Surat Balasan:</label>
                            <input type="file" class="form-control" id="surat{{ $p->id }}" name="surat_balasan" accept="application/pdf">
                                @if($p->balasan && $p->balasan->surat_balasan)
                                    <small>File yang diupload: <a href="{{ asset('storage/surat_balasan/' . basename($p->balasan->surat_balasan)) }}" target="_blank">Lihat Surat Balasan</a></small>
                                @endif
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>

@endforeach
<script>
function toggleFormFields(id) {
    var status = document.getElementById('status' + id).value;
    document.getElementById('alasanDitolak' + id).style.display = status === 'ditolak' ? 'block' : 'none';
    document.getElementById('suratBalasan' + id).style.display = status === 'diterima' ? 'block' : 'none';
}
</script>
{{-- Batas view --}}

<!-- Modal Add peserta to pembimbing -->
@foreach($peserta as $p)
<div class="modal fade" id="createModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="createModalLabel{{ $p->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel{{ $p->id }}">Detail Peserta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body" style="overflow: auto;">
                    <table class="table table-bordered table-hover">
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
                                <th>Nama Pembimbing</th>
                                <th>Status</th> <!-- Tambah kolom status -->
                            </tr>
                        </thead>
                        <form action="{{ route('savePembimbing') }}" method="POST">
                            @csrf
                            <tbody>
                                @foreach(list_pesertah($p->id) as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->nama }}</td>
                                    <td>{{ $d->nim }}</td>
                                    <td>{{ $d->nama_jurusan ?? 'Jurusan tidak ditemukan' }}</td>
                                    <td class="wide-columna">{{ $d->alamat }}</td>
                                    <td>{{ $d->jk }}</td>
                                    <td>{{ $d->no_hp }}</td>
                                    <td>{{ $d->email }}</td>
                    
                                    <!-- Kolom pembimbing -->
                                    <td class="wide-column">
                                        <div class="form-group">
                                            <select class="form-control select-bagian" name="pembimbing[{{ $d->id }}]" required>
                                                <option value="" disabled {{ !$d->pembimbing_id ? 'selected' : '' }}>Pilih</option>
                                                @foreach($pembimbingList as $pembimbing)
                                                    <option value="{{ $pembimbing->id }}" {{ $d->pembimbing_id == $pembimbing->id ? 'selected' : '' }}>
                                                        {{ $pembimbing->nama_pembimbing }} ({{ $pembimbing->bagian }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                    
                                    <!-- Kolom status -->
                                    <td>
                                        @if($d->pembimbing_id)
                                            <span class="badge badge-success">Sudah Diisi</span>
                                        @else
                                            <span class="badge badge-warning">Belum Diisi</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="10">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </form>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
{{-- <script>
    $(document).ready(function() {
        $('.select-bagian').on('change', function() {
            var bagian = $(this).val(); // Ambil nilai bagian
            var pesertaId = $(this).data('id'); // Ambil ID peserta dari data attribute
            
            if (bagian) {
                $.ajax({
                    url: "{{ route('getPembimbingByBagian') }}", // Route yang sesuai
                    type: "POST", 
                    data: {
                        bagian: bagian, 
                        _token: '{{ csrf_token() }}' // Token CSRF Laravel
                    },
                    success: function(data) {
                        console.log(data); // Debugging untuk melihat data yang diterima
                        var pembimbingSelect = $('#select_pembimbing_' + pesertaId);
                        pembimbingSelect.empty().append('<option value="" disabled selected>Pilih Pembimbing</option>'); 
                        pembimbingSelect.prop('disabled', false);
                        
                        $.each(data, function(key, value) {
                            pembimbingSelect.append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                    error: function() {
                        alert('Pembimbing tidak ditemukan');
                    }
                });
            } else {
                $('#select_pembimbing_' + pesertaId).prop('disabled', true).empty().append('<option value="" disabled selected>Pilih Pembimbing</option>');
            }
        });
    });
</script> --}}

{{-- 
<!-- Modal for add surat -->
<div class="modal fade" id="addCampusModal" tabindex="-1" role="dialog" aria-labelledby="addCampusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCampusModalLabel">Tambah Peserta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('pengajuanSuratstore') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
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

{{-- ajax untuk view --}}
{{-- <script>
$(document).ready(function() {
    // Ketika modal view dibuka
    $('.btn-view').on('click', function() {
        var id = $(this).data('id');

        // AJAX request untuk mendapatkan data peserta
        $.ajax({
            url: '/peserta/' + id,
            method: 'GET',
            success: function(data) {
                // Isi modal dengan data
                $('#modal-no-surat' + id).text(data.no_surat);
                $('#modal-tgl-surat' + id).text(data.tgl_surat);
                $('#modal-tgl-mulai' + id).text(data.tgl_mulai);
                $('#modal-tgl-selesai' + id).text(data.tgl_selesai);
                $('#modal-nama' + id).text(data.nama);
                $('#modal-nim' + id).text(data.nim);
                $('#modal-jurusan' + id).text(data.jurusan);
                $('#modal-alamat' + id).text(data.alamat);
                $('#modal-jenis-kelamin' + id).text(data.jk);
                $('#modal-no-hp' + id).text(data.no_hp);
                $('#modal-email' + id).text(data.email);
            }
        });
    });
});
</script> --}}
{{-- batas ajax --}}


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

<style>
    .wide-column {
    width: 300px; /* Atur sesuai kebutuhan */
}
    .wide-columna {
    width: 500px; /* Atur sesuai kebutuhan */
}

th[colspan="2"] {
    width: 300px; /* Atur lebar kolom pada header */
}

</style>
@endsection
{{-- 
@push('kode_js')
    <script>
        function tampilPembimbing(id) {
            var id_bagian = $('#select_bagian_'+id).val();
            alert(id_bagian);
        }
    </script> --}}

{{-- 
@endpush --}}

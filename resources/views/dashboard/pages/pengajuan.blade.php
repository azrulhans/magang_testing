@extends('dashboard/main')

@section("content")
<div class="container form-container">
  <form action="{{ asset('pengajuan', $datas->id) }}" method="post" enctype="multipart/form-data">
    @csrf
      <div class="row">
        <h1>Lengkapi Data</h1> <br> <hr>
          <div class="col-sm-6">
              <div class="form-group">
                  <label>Nama Lengkap :</label>
                  <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Mahasiswa" required>
              </div>
          </div>
          <div class="col-sm-6">
              <div class="form-group">
                  <label>Universitas/Sekolah :</label>
                  <input type="text" name="asal_sekolah" class="form-control" placeholder="Masukan Nama Universitas" required>
              </div>
          </div>
          <div class="col-sm-6">
              <div class="form-group">
                  <label>Jurusan :</label>
                  <input type="text" name="jurusan" class="form-control" placeholder="Masukan Nama Jurusan" required>
              </div>
          </div>
          <div class="col-sm-6">
              <div class="form-group">
                  <label>Nomor Induk Mahasiswa :</label>
                  <input type="text" name="nim" class="form-control" placeholder="Masukan Nomor Induk Mahasiswa" required>
              </div>
          </div>
          <div class="col-sm-6">
              <div class="form-group">
                  <label>Mulai Magang :</label>
                  <input type="date" name="tgl_awal" class="form-control" required>
              </div>
          </div>
          <div class="col-sm-6">
              <div class="form-group">
                  <label>Akhir Magang :</label>
                  <input type="date" name="tgl_akhir" class="form-control" required>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-6">
              <div class="form-group">
                  <label>Email :</label>
                  <input type="email" name="email" class="form-control" placeholder="Masukan Email" required>
              </div>
          </div>
          <div class="col-sm-6">
              <div class="form-group">
                  <label>No Telp :</label>
                  <input type="text" name="no_hp" class="form-control" placeholder="Masukan No Telp" required>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-6">
              <div class="form-group">
                  <label>Alamat :</label>
                  <textarea class="form-control" name="alamat" rows="3" id="alamat"></textarea>
              </div>
          </div>
          <div class="col-sm-5">
            <div class="form-group">
                <div id="msg"></div>
                <label>Foto :</label>
                <input type="file" name="foto" class="file foto" style="display: none;">
                <div class="input-group my-3">
                    <input type="text" class="form-control" disabled placeholder="Upload Foto" id="file_foto">
                    <div class="input-group-append">
                        <button type="button" id="pilih_foto" class="browse btn btn-info"><i class="fa fa-search"></i> Pilih</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-sm-5">
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
        
      </div>
      <div class="row">
          <div class="col-sm-6">
              <button type="submit" name="tambah_mahasiswa" width="100px" id="Submit" class="btn btn-success"><i class="fa fa-plus"></i> Daftar</button>
              <button type="reset" class="btn btn-warning"><i class="fa fa-trash"></i> Reset</button>
          </div>
      </div>
  </form>
</div>



<style>
    .file {
    visibility: hidden;
    position: absolute;
    }
    .form-container {
            margin-top: 20px;
            margin-left: 30px;
        }
</style>

<script>
  document.querySelector('#pilih_foto').addEventListener('click', function() {
    document.querySelector('.file.foto').click();
});

document.querySelector('.file.foto').addEventListener('change', function(e) {
    var file = e.target.files[0];
    if (file) {
        // Set file name to the input text
        document.querySelector('#file_foto').value = file.name;
    }
});

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
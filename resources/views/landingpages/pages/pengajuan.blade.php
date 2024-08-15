@extends('landingpages/main')

@section("content")

<div class="card card-primary" style="width: 65%; margin: 0 auto;">
    <div class="card-header" style="background-color: #007bff;">
      <h3 class="card-title" style=" color: #fff; font-family: inherit;" >
        Form Pengajuan
    </h3>
      <p class="card-title" style=" color: #fff; font-family: inherit;" >
        Lengkapi data dengan sebenarnya ,isilah dengan teliti tanpa ada kesalahan.
      </p>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form  action="{{ asset('pengajuan/' . auth()->user()->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label style="font-weight: 700; color:black;  display: inline-block; margin-bottom: .5rem;" for="exampleInputEmail1">Nama Lengkap :</label>
                <input type="text"  class="form-control" name="nama" id="exampleInputEmail1" placeholder="Masukin Nama Anda" required><br>
            </div>
            <div class="form-group">
                <label style="font-weight: 700; color:black;  display: inline-block; margin-bottom: .5rem;" for="exampleUniversitas">Universitas/Sekolah :</label>
                <input type="text" name="asal_sekolah" id="exampleUniversitas" class="form-control" placeholder="Masukan Nama Universitas" required><br>
            </div>
              <div class="form-group">
                <label style="font-weight: 700; color:black;  display: inline-block; margin-bottom: .5rem;" for="examplejurusan">Jurusan :</label>
                <input type="text" name="jurusan" id="examplejurusan" class="form-control" placeholder="Masukan Jurusan" required><br>
            </div>
            <div class="form-group">
                <label style="font-weight: 700; color:black;  display: inline-block; margin-bottom: .5rem;" for="examplenim">Nim/Nis :</label>
                <input type="text" name="nim" id="examplenim" class="form-control" placeholder="Masukan Nim/Nis" required><br>
            </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label style="font-weight: 700; color:black;  display: inline-block; margin-bottom: .5rem;" for="exampletgl">Mulai Magang :</label>
                <input type="date" name="tgl_awal" id="exampletgl" class="form-control" required><br>
            </div>
            <div class="form-group">
                <label style="font-weight: 700; color:black;  display: inline-block; margin-bottom: .5rem;" for="exampletglAkhir">Akhir Magang :</label>
                <input type="date" name="tgl_akhir" id="exampletglAkhir" class="form-control" required><br>
            </div>
        </div>
            <div class="form-group">
                <label style="font-weight: 700; color:black;  display: inline-block; margin-bottom: .5rem;" for="exampletemail">Email :</label>
                <input type="email" name="email" id="exampletemail" class="form-control" placeholder="Masukan Email" required><br>
            </div>
            <div class="form-group">
                <label style="font-weight: 700; color:black;  display: inline-block; margin-bottom: .5rem;" for="examplehp">No Telp :</label>
                <input type="text" name="no_hp" id="examplehp" class="form-control" placeholder="Masukan No Telp" required><br>
            </div>
            <div class="form-group">
                <label style="font-weight: 700; color:black;  display: inline-block; margin-bottom: .5rem;" for="examplehp">Alamat :</label>
                <textarea  name="alamat" id="examplearea" rows="3" class="form-control" placeholder="Masukan Alamat" required></textarea><br>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
                <label style="font-weight: 700; color:black;  display: inline-block; margin-bottom: .5rem;">Foto :</label>
                <input type="file" name="foto" class="file foto" style="display: none;" required><br>
                <div class="input-group my-3">
                    <input type="text" class="form-control" disabled placeholder="Upload Foto" id="file_foto">
                    <div class="input-group-append">
                        <button type="button" id="pilih_foto" class="browse btn btn-info"><i class="fa fa-search"></i> Pilih</button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label style="font-weight: 700; color:black;  display: inline-block; margin-bottom: .5rem;">Surat Pengajuan Magang :</label>
                <small class="text-muted">*Format file harus PDF</small>
                <input type="file" name="foto" class="file surat" style="display: none;" required><br>
                <div class="input-group my-3">
                    <input type="text" class="form-control" disabled placeholder="Upload Surat" id="file_surat"><br>
                    <div class="input-group-append">
                        <button type="button" id="pilih_surat" class="browse btn btn-info"><i class="fa fa-search"></i> Pilih</button>
                    </div>
                </div>
            </div>
            </div>
            <div class="card-footer">
                <button type="submit" name="tambah_mahasiswa" id="Submit" class="btn btn-primary"><i class="fa fa-plus"></i> Daftar</button>
                <button type="reset" class="btn btn-warning"><i class="fa fa-trash"></i> Reset</button>
            </div>       
            {{-- batas --}}
        </div>
      </form>
  </div>

  
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
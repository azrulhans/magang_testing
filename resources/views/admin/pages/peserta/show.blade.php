<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | General Form Elements</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<html>
    <div class="container mt-2">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Detail Peserta</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="nama">Nama Siswa</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $pengajuan->nama }}" readonly>
            </div>
            <div class="form-group">
                <label for="asal_sekolah">Asal Sekolah</label>
                <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="{{ $pengajuan->asal_sekolah }}" readonly>
            </div>
            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input type="text" class="form-control" id="jurusan" name="jurusan" value="{{ $pengajuan->jurusan }}" readonly>
            </div>
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" value="{{ $pengajuan->nim }}" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $pengajuan->email }}" readonly>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $pengajuan->alamat }}" readonly>
            </div>
            <div class="form-group">
                <label for="no_hp">No. Telp</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $pengajuan->no_hp }}" readonly>
            </div>
            <div class="form-group">
                <label for="tgl_awal">Mulai Magang</label>
                <input type="date" class="form-control" id="tgl_awal" name="tgl_awal" value="{{ $pengajuan->tgl_awal }}" readonly>
            </div>
            <div class="form-group">
                <label for="tgl_akhir">Akhir Magang</label>
                <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" value="{{ $pengajuan->tgl_akhir }}" readonly>
            </div>
            <div class="form-group">
                <label for="foto">Foto</label><br>
                @if($pengajuan->foto)
                    <img src="{{ asset('storage/' . $pengajuan->foto) }}" alt="Foto {{ $pengajuan->nama }}" width="100" height="100">
                @else
                    Tidak ada foto
                @endif
            </div>
            <div class="form-group">
                <label for="surat">Surat Pengajuan</label><br>
                @if($pengajuan->surat)
                    <a href="{{ asset('storage/' . $pengajuan->surat) }}" target="_blank">Lihat Surat</a>
                @else
                    Tidak ada surat
                @endif
            </div>
            <a href="{{ url('dashboard-data-peserta') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
</html>
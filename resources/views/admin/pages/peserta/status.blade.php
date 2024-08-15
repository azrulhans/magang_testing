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
    <style>
        body, html {
    height: 100%;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}

.card {
    width: 400px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

    </style>
  </head>
  <body>
    
 
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Status Pengajuan</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" method="post" action="">
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Nama Siswa</label>
          <input readonly type="text" class="form-control" id="exampleInputEmail1" name="nama" value="{{ $pengajuan["nama"] }}" >
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Asal Sekolah</label>
          <input readonly type="text" class="form-control" id="exampleInputPassword1" name="asal_sekolah" value="{{ $pengajuan->asal_sekolah }}">
        </div>
        <div class="form-group">
            <label>Status</label>
            <select class="form-control select2" name="status" style="width: 100%;">
              <option selected="selected" value="diterima">Diterima</option>
              <option value="ditolak">Ditolak</option>
            </select>
          </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{asset("dashboard-data-peserta")}}" class="btn btn-secondary">Kembali</a>
      </div>
    </form>
  </div>
</body>
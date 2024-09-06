@extends("admin.layouts.main")
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Edit Logbook</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Edit Projek Harian</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
 <!-- Main content -->
 <section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Edit Logbook</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <form action="{{ route('logbook.update', $peserta->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="inputName">Judul Kegiatan</label>
                    <input type="text" name="judul" id="inputName" class="form-control" value="{{ old('judul', $peserta->judul) }}">
                </div>
                <div class="form-group">
                    <label for="inputDescription">Deskripsi Kegiatan</label>
                    <textarea id="inputDescription" name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $peserta->deskripsi) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="inputTanggal">Tanggal Kegiatan</label>
                    <input type="text" id="inputTanggal" name="tanggal" value="{{ $peserta->tanggal }}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="inputDokumentasi">Dokumentasi Kegiatan</label>
                    <input type="file" id="inputDokumentasi" name="dokumentasi" class="form-control">
                    @if($peserta->dokumentasi)
                        <small>Dokumentasi saat ini: <a href="{{ asset('storage/' . $peserta->dokumentasi) }}" target="_blank">Lihat</a></small>
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ asset('dashboard-logbook') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Update Logbook</button>
            </div>
        </form>
        

</section>    

  <!-- /.content -->

</div>
@endsection
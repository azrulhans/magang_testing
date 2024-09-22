@extends("admin.layouts.main")
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Project Add</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Tambah Projek Harian</li>
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
          <h3 class="card-title">Logbook</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <form action= "{{route('logbook.store')}}"  method='post' enctype="multipart/form-data">
          @csrf
          @if(isset($logbook)) @method('post') @endif
        <div class="card-body">
          <div class="form-group">
            {{-- nim peserta --}}
            <input type="hidden" name="nim" id="inputName" class="form-control" value="{{ auth()->user()->username }}">
          </div>
          <div class="form-group">
            <label for="inputName">Judul Kegiatan</label>
            <input type="text" name="judul" id="inputName" class="form-control" value="{{ $logbook->judul ?? '' }}">
          </div>
          <div class="form-group">
            <label for="inputDescription">Deskripsi Kegiatan</label>
            <textarea id="inputDescription" name="deskripsi" class="form-control" rows="4">{{ $logbook->deskripsi ?? '' }}</textarea>
          </div>
          <div class="form-group">
            <label for="inputTanggal">Tanggal Kegiatan</label>
            <input type="text" id="inputTanggal" name="tanggal"  value="{{ $logbook->tanggal ?? now()->format('d-m-Y') }}" class="form-control" readonly>
          </div>
          <div class="form-group">
              <label for="inputClientCompany">Dokumentasi Kegiatan</label>
              <input type="file" id="inputClientCompany" name="dokumentasi" class="form-control">
            </div>
        </div>
      </div>
    </div>    
  </div>  
  <div class="row mb-3">
      <div class="col-12 d-flex justify-content-center">
          <a href="{{ asset('dashboard-logbook') }}" class="btn btn-secondary mr-2">Kembali</a>
          <input type="submit" value="{{ isset($logbook) ? 'Update Logbook' : 'Tambah Logbook' }}" class="btn btn-success">
      </div>
  </div>
</form>

</section>    

  <!-- /.content -->

</div>
@endsection
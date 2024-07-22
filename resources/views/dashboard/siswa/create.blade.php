@extends('dashboard/main')
@section("content")
<section class="konten mt-2">
    <div class="container-fluid">
        <div class="card border-primary">
            <div class="card-header d-flex justify-content-end">
                <a href=" class="btn btn-primary btn-sm float-right">Kembali</a>
            </div>

            <div class="card-body ">
                <div class="table-responsive">
                    <form action="{{ asset('admin/siswa') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="nama" class="form-control" id="" placeholder="">
                        </div>
                        <div class="form-group mt-3">
                            <label for="">NIS</label>
                            <input type="number" name="nis" class="form-control" id="" placeholder="">
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" id="" placeholder="">
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Jenis Kelamin</label>
                            @foreach ($gender as $g)
                            @php
                            $cek =(old('g')== $g) ? 'checked': '';@endphp
                        <div class="custom-control custom-radio custom-control-inline">
                            <input name="jenis_kelamin" id="radio_0{{$g}}" type="radio" 
                            class="custom-control-input" value="{{$g}}"{{$cek}}> 
                            <label for="radio_0{{$g}}" class="custom-control-label">{{$g}}</label>
                          </div>
                          @endforeach
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Kelas</label>
                            <input type="text" name="kelas" class="form-control" id="" placeholder="">
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Alamat</label>
                            <input type="text" name="alamat" class="form-control" id="" placeholder="">
                        </div>
                        <div class="form-group mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
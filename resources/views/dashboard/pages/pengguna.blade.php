@extends('dashboard/main')

@section("content")

<section class="konten mt-2">
    <div class="container-fluid">
        <div class="card border-primary">
            <div class="card-header d-flex justify-content-end">
                <a href="{{asset('admin/tambah')}}" class="btn btn-primary btn-sm float-right">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">NIS</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $s)
                            <tr>
                                <td>{{$loop->iteration}} </td>
                                <td>{{$s -> nama}} </td>
                                <td>{{$s -> nis}} </td>
                                <td>{{$s -> tanggal_lahir}} </td>
                                <td>{{$s -> jenis_kelamin}} </td>
                                <td>{{$s -> kelas}} </td>
                                <td>{{$s -> alamat}} </td>
                                <td>{{$s -> email}} </td>
                                <td>
                                    <a href="#"
                                        class="btn btn-sm btn-success">lihat
                                        <i class="fa-solid fa-eye"></i></a>
                                    <a href="#"
                                        class="btn btn-sm btn-warning">edit    
                                         <i class="fa-solid fa-pen-to-square"></i></a>
                                     <button type="button" 
                                     class="btn btn-sm btn-danger"
                                     data-bs-toggle="modal" data-bs-target="#exampleModal{{$s->id}}">hapus
                                         <i class="fa-solid fa-pen-to-square"></i>
                                           </button>
                            {{-- modal --}}
                            <div class="modal fade" id="exampleModal{{$s->id}}" tabindex="-1" aria-labelledby="Hapus Produk" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      Apakah anda yakin akan menghapus data {{$s->nama}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form action="{{asset('admin/hapus')}}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $s->id }}">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                                </td>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
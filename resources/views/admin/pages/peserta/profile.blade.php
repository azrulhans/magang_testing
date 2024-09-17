@extends("admin.layouts.main")
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img src="{{asset('storage/fotos/'.$user->foto)}}" alt="Foto" class="rounded-circle p-1 bg-primary" width="110">
              </div>

              <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
              <p class="text-muted text-center">{{ Auth::user()->role }} </p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Nim</b> <a class="float-right">{{ $user->username ?? 'N/A' }}</a>
                </li>
                {{-- <li class="list-group-item">
                  <b>No HP</b> <a class="float-right">{{ $peserta->id ?? 'N/A' }}</a>
                </li> --}}
              </ul>
            </div>
            <!-- /.card-body -->
          </div>    
        </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
                </div>
                  <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="settings">
                        <form  method="POST" action="{{url('dashboard-data-profile/'.$user->id)}}"
                          enctype="multipart/form-data">
                          @method('PATCH')
                          @csrf
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                              <input type="text"  class="form-control  @error('name') is-invalid @enderror" 
                              name="name" value="{{$user->name}}" require_autocomplete="name">
                              @error('name')
                              <span class="invalid-feedback" role="alert">
                               <strong>{{$message}}</strong>
                              </span>
                              @enderror
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control  @error('email') is-invalid @enderror" 
                              name="email" value="{{$user->email}}" require_autocomplete="name">
                              @error('email')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                              </span>
                              @enderror
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('username') is-invalid @enderror" 
                                    name="username" value="{{ old('username', $user->username) }}" required>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                          <div class="form-group row">
                            <label for="inputExperience" class="col-sm-2 col-form-label">New Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control @error('password') is-invalid @enderror" 
                              name="password">
                              @error('password')
                               <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                               </span>
                               @enderror
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputExperience" class="col-sm-2 col-form-label">Confirm Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" 
									              name="password_confirmation">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputFotos" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-4">
                              <input type="file" class="form-control" id="inputFotos"
                              name="foto" value="{{$user->foto}}" >
                            </div>
                          </div>
                          
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <input type="submit" class="btn btn-primary px-4" value="Update Profile">
                            </div>
                          </div>
                        </form>
                    </div>      {{-- .id-setting --}}
                </div> <!-- /.tab-content -->
                  </div><!-- /.card-body -->
                </div> <!-- /.card-->
              </div>  <!-- /.col -->
              
            </div>
            <!-- /.row -->
      </div>                    
        <!-- /.content -->
  </section>
</div>
@endsection
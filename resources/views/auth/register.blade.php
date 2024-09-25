@extends('layouts.app')

@section('content')
<div class="blur-background">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-white text-center">
                        <img src="{{ asset('assets/images/logo/kominfo-panjang.png') }}" alt="Kominfo Logo" style="height: 100px;" class="mr-2">
                    </div>

                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row mb-4">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Sekolah / Kampus') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           name="name" value="{{ old('name') }}" 
                                           required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email Sekolah / Kampus') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           name="email" value="{{ old('email') }}" 
                                           required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="alamat_kampus" class="col-md-4 col-form-label text-md-right">{{ __('Alamat Sekolah / Kampus') }}</label>
                                <div class="col-md-6">
                                    <input id="alamat_kampus" type="text" 
                                           class="form-control @error('alamat_kampus') is-invalid @enderror" 
                                           name="alamat" value="{{ old('alamat') }}" 
                                           required autocomplete="alamat_kampus">

                                    @error('alamat_kampus')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="no_telp_kampus" class="col-md-4 col-form-label text-md-right">{{ __('No Telepon Sekolah / Kampus') }}</label>
                                <div class="col-md-6">
                                    <input id="no_telp_kampus" type="text" 
                                           class="form-control @error('no_telp_kampus') is-invalid @enderror" 
                                           name="no_telp" value="{{ old('no_telp') }}" 
                                           required autocomplete="no_telp_kampus">

                                    @error('no_telp_kampus')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Konfirmasi Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" 
                                           class="form-control" name="password_confirmation" 
                                           required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-5">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Daftar') }}
                                    </button>
                                    <a href="{{asset('/')}}" class="btn btn-secondary">kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .blur-background {
        background: rgba(0, 0, 0, 0.6); /* Background hitam dengan transparansi */
        backdrop-filter: blur(10px); /* Efek blur */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.85); /* Warna putih dengan transparansi */
    }
</style>

@extends('layouts.app')

@section('content')

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
<div class="blur-background">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm border-0">
                <div class="card-header text-white text-center">
                    <img src="{{ asset('assets/images/logo/kominfo-panjang.png') }}" alt="Kominfo Logo" style="height: 100px;" class="mr-2">
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                         <!-- Username or Email Input -->
                         <div class="form-group row mb-4">
                            <label for="login" class="col-md-4 col-form-label text-md-right">{{ __('Username atau Email') }}</label>
                            <div class="col-md-6">
                                <input id="login" type="text" 
                                       class="form-control @error('login') is-invalid @enderror" 
                                       name="login" value="{{ old('login') }}" 
                                       required autofocus>

                                @error('login')
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
                                       name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           name="remember" id="remember" 
                                           {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Ingat Saya') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Masuk') }}
                                </button>
                                <a class="btn btn-secondary" href="{{ route('register') }}">
                                    {{ __('Daftar') }}
                                </a>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-primary" href="{{ route('password.request') }}">
                                        {{ __('Lupa Password?') }}
                                    </a>
                                @endif
                                
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

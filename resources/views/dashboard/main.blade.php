<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Pengajuan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary rounded" aria-label="Eleventh navbar example">
      <div class="container">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09"
              aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarsExample09">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                      <a class="nav-link {{ request()->is('dashboard-peserta') ? 'active' : '' }} "aria-current="page" href="{{ asset('dashboard-peserta')}}">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link {{ request()->is('pengajuan') ? 'active' : '' }}" href="{{ asset('pengajuan')}}">Pengajuan Magang</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link {{ request()->is('status-pengajuan') ? 'active' : '' }}" href="{{ asset('status-pengajuan')}}">Status Magang</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link {{ request()->is('bantuan') ? 'active' : '' }}" href="{{ asset('bantuan')}}">Bantuan</a>
                  </li>
              </ul>
              <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
               {{ __('Logout') }}
           </a>

           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
               @csrf
           </form>
                     
          </div>
      </div>
  </nav>
    @yield('content')
    <div class="card text-center mt-3">
      <div class="card-footer text-muted">
          Copyright &copy; 2024 - Kominfo Kota Dumai
      </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        @if(Auth::user()->role == 'peserta')
        <div class="image">
          <img src="{{ asset('storage/fotos/' . $user->foto) }}" alt="Foto" class="rounded-circle p-9" style="width: 50px; height: 50px; object-fit: cover;">
        </div>
        <div class="info">
          <a href="#" class="d-block">Haii, {{ auth()->user()->name }}</a>
        </div>
      </div>
      @endif

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        @if(Auth::user()->role == 'admin')
          <li class="nav-item has-treeview ">
            <a href="{{asset('dashboard-utama')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @endif
        @if(Auth::user()->role == 'peserta')
          <li class="nav-item has-treeview ">
            <a href="{{asset('dashboard-peserta')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @endif
          @if(Auth::user()->role == 'admin')
              <li class="nav-item has-treeview">
                <a href="{{asset('dashboard-data-peserta-magang')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Peserta Magang</p>
                </a>
              </li>
              @endif
          @if(Auth::user()->role == 'admin')
              <li class="nav-item has-treeview">
                <a href="{{asset('data-pembimbing')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pembimbing</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->role == 'peserta')
              <li class="nav-item has-treeview">
                <a href="{{asset('dashboard-logbook')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Logbook</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->role == 'peserta')
              <li class="nav-item has-treeview">
                <a href="{{asset('dashboard-data-profile')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              @endif
          <li class="nav-item has-treeview">
              <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
               {{ __('Logout') }}
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
                <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
              </svg>
           </a>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
               @csrf
           </form>
          </li>
          
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
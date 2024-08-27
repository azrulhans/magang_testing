@extends('landingpages/main')

@section("content")

<!--====== PRELOADER PART START ======-->
<div class="preloader">
    <div class="loader">
    <div class="spinner">
        <div class="spinner-container">
        <div class="spinner-rotator">
            <div class="spinner-left">
            <div class="spinner-circle"></div>
            </div>
            <div class="spinner-right">
            <div class="spinner-circle"></div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
<!--====== PRELOADER PART ENDS ======-->

<!--====== HEADER PART START ======-->
<header class="header-area">
    <div class="navbar-area">
    <div class="container">
        <div class="row">
        <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="index.html">
                <img src="assets/images/logo/kominfo.png" style="width: 50px; height: 50px;" alt="Logo" />
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="toggler-icon"> </span>
                <span class="toggler-icon"> </span>
                <span class="toggler-icon"> </span>
            </button>

            <div
                class="collapse navbar-collapse sub-menu-bar"
                id="navbarSupportedContent"
            >
                <ul id="nav" class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="page-scroll active" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="page-scroll " href="#tentang">Tentang</a>
                </li>
                </li>
                <li class="nav-item">
                    <a class="page-scroll" href="#faq">FAQ</a>
                </li>
                @auth
                <li class="nav-item">
                    <a href="{{route('LandingPages-Status', ['id' => $datas->id]) }}">Status Pengajuan</a>
                </li>
                @endauth
                {{-- <li class="nav-item">
                    <a class="page-scroll" href="#kontak">Kontak</a>
                </li> --}}
                  <!-- logic login Daftar Akun -->
                  @guest
                  @if (Route::has('login'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('login') }}</a>
                  </li>
                   @endif
                  @if (Route::has('register'))
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">{{ __('Daftar') }}</a>
                      </li>
                  @endif
              @else
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }}
                      </a>

                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
                      </div>
                  </li>
              @endguest
          </ul>
            </div>
            <!-- navbar collapse -->

            </nav>
            <!-- navbar -->
        </div>
        </div>
        <!-- row -->
    </div>
    <!-- container -->
    </div>
    <!-- navbar area -->

    <div
    id="home"
    class="header-hero bg_cover"
    style="background-image: url(assets/images/header/banner-bg.svg)"
    >
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="header-hero-content text-center">
            <h3
                class="header-title wow fadeInUp"
                data-wow-duration="1.3s"
                data-wow-delay="0.2s"
            >
            @if (Auth::check())
            Selamat Datang, {{ Auth::user()->name }}!
        @else
            Selamat Datang di Website Kami! <br>
            Magang Kominfo Dumai
        @endif
            </h3>
            </div>
            <!-- header hero content -->
        </div>
        </div>
        <!-- row -->
        <div class="row">
        <div class="col-lg-12">
            <div
            class="header-hero-image text-center wow fadeIn"
            data-wow-duration="1.3s"
            data-wow-delay="1.4s"
            >
            <img  src="assets/images/foto/d_komin.png" alt="hero" />
            </div >
            <!-- header hero image -->
        </div>
        </div>
        <div class="row" mt-5>
        <div class="col-lg-12" style="text-align: center">
            <p 
                class="p-title"
                data-wow-duration="1.3s"
                data-wow-delay="0.5s"
            >
            <br>
               Belajar bersama kami, kami membuka penerimaan Mahasiswa dan siswa Magang
               yang sedang melaksanakan kegiatan Magang atau PKL
            </p>
            <a href="{{route('daftar')}}" class="btn-daftar mt-5">Daftar Pengajuan</a>
        </div>
        </div>
        <!-- row -->
    </div>
    <!-- container -->
    <div id="particles-1" class="particles"></div>
    </div>
    <!-- header hero -->
</header>
<!--====== HEADER PART ENDS ======-->

<!--====== PROFILE PART START ======-->
<section id="tentang">
    <!--====== ABOUT PART START ======-->
    <div class="about-area pt-70">
    <div class="about-shape-2">
        <img src="assets/images/about/about-shape-2.svg" alt="shape" />
    </div>
    <div class="container">
        <div class="row align-items-center">
        <div class="col-lg-6 order-lg-last">
            <div
            class="about-content ms-lg-auto mt-50 wow fadeInLeftBig"
            data-wow-duration="1s"
            data-wow-delay="0.5s"
            >
            <div class="section-title">
                <div class="line"></div>
                <h3 class="title">
                Belajar bersama kami
                </h3>
            </div>
            <!-- section title -->
            <p class="text">
               <p style="font-style: italic"> Kominfo adalah Kementerian Komunikasi dan Informatika mempunyai tugas menyelenggarakan
                urusan pemerintahan di bidang komunikasi dan informatika untuk membantu Presiden 
                dalam menyelenggarakan pemerintahan negara.</p>
                <ul class="mt-2">
                    <li>Ruang kerja yang nyaman</li>
                    <li>Staff pekerja yang ramah</li>
                    <li>Lingkungan yang positif</li>
                </ul>
                <p class="mt-2">Kami menjamin Mahasiswa atau siswa akan belajar banyak hal tentang  Kementerian Komunikasi dan Informatika ini </p>
            </p>
            </div>
            <!-- about content -->
        </div>
        <div class="col-lg-6 order-lg-first">
            <div
            class="about-image text-center mt-50 wow fadeInRightBig"
            data-wow-duration="1s"
            data-wow-delay="0.5s"
            >
            <img src="assets/images/about/about2.svg" alt="about" />
            </div>
            <!-- about image -->
        </div>
        </div>
        <!-- row -->
    </div>
    <!-- container -->
    </div>
</section>
<!--====== PROFILE PART ENDS ======-->


<section id="faq">
    <!--====== ABOUT PART START ======-->
    <div class="about-area pt-70">
    <div class="container">
        <div class="row ">
        <div class="col-lg-4 ">
            <div
            class="about-content ms-lg-auto mt-50 wow fadeInLeftBig"
            data-wow-duration="1s"
            data-wow-delay="0.5s"
            >
            <div class="section-title ">
                <div class="line"></div>
                <h3 class="title">
                FAQ
                </h3>
            </div>
            <!-- section title -->
            <div class="faq-container mt-4" >
                <h5 class="mb-4">Frequently Asked Questions (FAQ)</h5>
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Bagaimana cara mendaftarnya?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Masuk ke halaman Daftar kemudian isi pada form registrasi masukan nama lengkap, username, dan password.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Bagaimana untuk memulai pengajuan magang atau PKL?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Pilih tombol Daftar Pengajuan kemudian isi data-data yang tertera beserta foto surat pengantar dari masing-masing kampus / sekolah.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Berapa lama proses vertifikasi pengajuan Magang / PKL?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Proses pengajuan akan dilakukan oleh tata usaha paling lambat 1 minggu.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Bagaimana saya mengetahui, pengajuan bahwa saya diterima atau tidak?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Silahkan login ke halaman Panel mahasiswa / siswa dan lihat di Panel Status Pengajuan jika anda diterima silahkan datang ke kantor KOMINFO Kota Dumai.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- about content -->
        </div>
       
        </div>
        <!-- row -->
    </div>
    <!-- container -->
    </div>
</section>
<!--====== ABOUT PART END ======-->


<!--====== FOOTER PART START ======-->
<footer id="footer" class="footer-area pt-120">
    <div class="container">
    <!-- subscribe area -->
    <div class="footer-widget pb-100">
        <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-8">
            <div
            class="footer-about mt-50 wow fadeIn"
            data-wow-duration="1s"
            data-wow-delay="0.2s"
            >
            <a class="logo" href="javascript:void(0)">
                <img src="assets/images/logo/kominfo.png" style="width: 50px; height: 50px;"  />
            </a>
            <p class="text">
                Website Magang Kominfo Kota Dumai
            </p>
            </div>
            <!-- footer about -->
        </div>
        <div class="col-lg-5 col-md-7 col-sm-12">
            <div class="footer-link d-flex mt-50 justify-content-sm-between">
            <div
                class="link-wrapper wow fadeIn"
                data-wow-duration="1s"
                data-wow-delay="0.4s"
            >
            </div>
            </div>
            <!-- footer link -->
        </div>
        </div>
        <!-- row -->
    </div>
    <!-- footer widget -->
    <div class="footer-copyright">
        <div class="row">
        <div class="col-lg-12">
            <div class="copyright d-sm-flex justify-content-between">
            <div class="copyright-content">
                <p class="text">
                Copyright &copy; 2024
                <a href="#" rel="nofollow">Diskominfotiksan Kota Dumai</a>
                </p>
            </div>
            <!-- copyright content -->
            </div>
            <!-- copyright -->
        </div>
        </div>
        <!-- row -->
    </div>
    <!-- footer copyright -->
    </div>
    <!-- container -->
    <div id="particles-2"></div>
</footer>
<!--====== FOOTER PART ENDS ======-->

<!--====== BACK TOP TOP PART START ======-->
<a href="#" class="back-to-top"> <i class="lni lni-chevron-up"> </i> </a>
<!--====== BACK TOP TOP PART ENDS ======-->


@endsection
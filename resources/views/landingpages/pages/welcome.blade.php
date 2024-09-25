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
                <img src="assets/images/logo/kominfo-panjang.png" style="width: 70px; height: 70px;" alt="Logo" />
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
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
            Selamat Datang di Website Magang <br>
            Diskominfotiksan Kota Dumai
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
            <img src="assets/images/logo/kominfo-panjang.png" alt="hero" />
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
            Bergabunglah dengan kami! Kami menerima mahasiswa dan siswa yang sedang menjalani magang atau PKL.
            </p>
            <a href="{{route('dashboard-sekolah')}}" class="btn-daftar mt-5">Daftar Pengajuan</a>
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
                Bergabung Bersama Kami
                </h3>
            </div><br>
            <!-- section title -->
            <p class="text">
               <p style="font-weight: bold">Ingin belajar dan berkembang di bidang teknologi informasi? </p>
               <p class="mt-2">Gabung bersama kami di Diskominfotiksan Kota Dumai! Kamu akan mendapatkan kesempatan untuk belajar langsung dari para ahli dan terlibat dalam proyek-proyek menarik.</br> 
                Temukan kami di Mal Pelayanan Publik, Teluk Binjai.Kota Dumai</p>
            </div>
            <!-- about content -->
        </div>
        <div class="col-lg-6 order-lg-first">
            <div
            class="about-image text-center mt-50 wow fadeInRightBig"
            data-wow-duration="1s"
            data-wow-delay="0.5s"
            >
            <img src="foto/foto.jpg" alt="about" style="border-radius: 5px " />
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
                <h5 class="mb-4">Pertanyaan</h5>
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Bagaimana cara mendaftarnya?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Pihak kampus/sekolah melakukan Daftar kemudian isi form data kampus/sekolahnya
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
                                Setelah melakukan Daftar,Pihak kampus/sekolah melakukan Login lalu mengisi surat pengajuan dan data mahasiswa/siswa yang ingin PKL
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
                                Proses pengajuan akan dilakukan oleh TU Diskominfotiksan Kota Dumai paling lambat 2 minggu
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
                                Silahkan login ke dashboard kampus/sekolah dan lihat di menu Status Magang jika sudah menginput data maka status otomatis akan nampil
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
                <img src="assets/images/logo/kominfo-panjang.png" style="width: 80px; height: 80px;"  />
            </a><br>
            <p class="text" style="font-size: 15px;"> 
                DINAS KOMUNIKASI, INFORMATIKA, STATISTIK, DAN PERSANDIAN <br>
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
                    <a href="#" rel="nofollow">DINAS KOMUNIKASI, INFORMATIKA, STATISTIK, DAN PERSANDIAN</a><br>
                    KOTA DUMAI&copy; 2024
                </p>
                <div class="contact-info">
                    <div class="item">
                        <i class="fas fa-globe fa-lg"></i>
                        <span>diskominfo.dumaikota.go.id</span>
                    </div>
                    <div class="item">
                        <i class="fas fa-envelope fa-lg"></i>
                        <span>diskominfotiksan@dumaikota.go.id</span>
                    </div>
                    <div class="item">
                        <i class="fab fa-facebook fa-lg"></i>
                        <span>diskominfo.dumai</span>
                    </div>
                    <div class="item">
                        <i class="fab fa-youtube fa-lg"></i>
                        <span>diskominfokotadumai</span>
                    </div>
                    <div class="item">
                        <i class="fab fa-twitter fa-lg"></i>
                        <span>diskominfodumai</span>
                    </div>
                    <div class="item">
                        <i class="fab fa-instagram fa-lg"></i>
                        <span>kominfo.dumai</span>
                    </div>
                </div>
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
<style>
    .contact-info {
        font-size: 15px;
        color: white;
        display: flex;
        flex-wrap: wrap;
        gap: 10px; /* Jarak antara elemen */
        align-items: center;
    }

    .contact-info .item {
        display: flex;
        align-items: center;
        gap: 5px; /* Jarak antara ikon dan teks */
    }
</style>

<script>
    // Ambil semua link dengan class 'page-scroll'
    const navLinks = document.querySelectorAll('.nav-item a.page-scroll');

    // Loop semua link dan tambahkan event listener
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Hapus class 'active' dari semua link
            navLinks.forEach(link => link.classList.remove('active'));
            
            // Tambahkan class 'active' ke link yang diklik
            this.classList.add('active');
        });
    });
</script>

@endsection
@extends('layouts.adward')

@section('title', 'TK Harapan Bunda - Beranda')

@section('top_container')
  <div class="top_container home_wallpaper_hero">
    <!-- header section starts -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <!-- Nama Sekolah di Tampilan Mobile -->
          <a class="navbar-brand text-white font-weight-bold d-lg-none" href="{{ route('home') }}">
            TK Harapan Bunda
          </a>

          <!-- Tombol Toggler Hamburger -->
          <button class="navbar-toggler text-white ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <!-- Menu Navbar -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex mx-auto flex-column flex-lg-row align-items-center w-100">
              <ul class="navbar-nav w-100 justify-content-center">
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                  <a class="nav-link text-white font-weight-bold" href="{{ route('home') }}"> Beranda </a>
                </li>
                <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                  <a class="nav-link text-white font-weight-bold" href="{{ route('about') }}"> Tentang Kami </a>
                </li>
                <li class="nav-item {{ request()->routeIs('teacher') ? 'active' : '' }}">
                  <a class="nav-link text-white font-weight-bold" href="{{ route('teacher') }}"> Pengajar </a>
                </li>
                <li class="nav-item {{ request()->routeIs('vehicle') ? 'active' : '' }}">
                  <a class="nav-link text-white font-weight-bold" href="{{ route('vehicle') }}"> Fasilitas </a>
                </li>
                <li class="nav-item {{ request()->routeIs('kalender') ? 'active' : '' }}">
                  <a class="nav-link text-white font-weight-bold" href="{{ route('kalender') }}"> Kalender </a>
                </li>
                <li class="nav-item {{ request()->routeIs('galeri') ? 'active' : '' }}">
                  <a class="nav-link text-white font-weight-bold" href="{{ route('galeri') }}"> Galeri </a>
                </li>
                <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                  <a class="nav-link text-white font-weight-bold" href="{{ route('contact') }}"> Hubungi Kami </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->

    <!-- hero section with full wallpaper background -->
    <section class="hero_section">
      <div class="container py-4 py-md-5">
        <div class="row align-items-center" style="min-height: 50vh;">
          <div class="col-lg-8 col-md-10">
            <div class="hero_detail-box text-white">
              <h3 class="text-warning font-weight-bold mb-2 hero-sub-title" style="font-size: 1.5rem; text-shadow: 0 2px 6px rgba(0,0,0,0.5);">
                Selamat Datang di
              </h3>
              <h1 class="display-4 font-weight-bold text-white mb-3 hero-main-title" style="text-shadow: 0 4px 12px rgba(0,0,0,0.6);">
                TK Harapan Bunda
              </h1>
              <p class="lead text-white mb-4 hero-desc-p" style="font-size: 1.25rem; text-shadow: 0 2px 8px rgba(0,0,0,0.6); max-width: 600px;">
                Pendidikan anak usia dini yang berkualitas, menyenangkan, dan membangun karakter buah hati Anda.
              </p>
              <div class="hero_btn-continer">
                <a href="{{ route('contact') }}" class="btn btn-warning btn-lg font-weight-bold px-4 py-3 shadow-lg rounded-pill call-btn-style">
                  <span>Hubungi Kami</span>
                  <i class="fa fa-arrow-right ml-2"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- end header section -->
@endsection

@section('content')

  <!-- about section -->
  <section class="about_section layout_padding">
    <div class="container">
      <h2 class="main-heading">
        Tentang TK Harapan Bunda
      </h2>
      <p class="text-center">
        TK Harapan Bunda adalah lembaga pendidikan anak usia dini yang berfokus pada pengembangan kecerdasan, karakter, dan kreativitas anak.
      </p>
      <div class="d-flex justify-content-center mt-4">
        <a href="{{ route('about') }}" class="call_to-btn">
          <span>
            Selengkapnya
          </span>
          <img src="{{ asset('adward/images/right-arrow.png') }}" alt="">
        </a>
      </div>
    </div>
  </section>

  <!-- visi misi section -->
  <section class="visi_misi_section layout_padding bg-light">
    <div class="container">
      <h2 class="main-heading">
        Visi & Misi
      </h2>
      <p class="text-center mb-5">
        TK Harapan Bunda bertekad memberikan pendidikan anak usia dini yang berkualitas dan berkarakter.
      </p>
      <div class="row">
        <div class="col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 15px; background-color: #f0fdf4 !important; border: 1px solid #bbf7d0 !important; border-top: 5px solid #25d366 !important;">
            <div class="card-body">
              <h3 class="card-title text-success font-weight-bold mb-3">
                <i class="fa fa-eye mr-2"></i> Visi
              </h3>
              <p class="card-text text-dark font-weight-medium">
                Terwujudnya murid yang membentuk anak yang berahlak mulia, cerdas, kreatif, mandiri, sehat dan kuat.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 15px; background-color: #f0fdf4 !important; border: 1px solid #bbf7d0 !important; border-top: 5px solid #25d366 !important;">
            <div class="card-body">
              <h3 class="card-title text-success font-weight-bold mb-3">
                <i class="fa fa-bullseye mr-2"></i> Misi
              </h3>
              <ol class="pl-3 text-dark font-weight-medium" style="line-height: 1.8;">
                <li>Menanamkan nilai-nilai keimanan dan ketaqwaan sejak dini.</li>
                <li>Mengembangkan kreatifitas dalam setiap kegiatan pembelajaran dan mengembangkan bakat dan minat anak.</li>
                <li>Membiasakan sikap mandiri pada anak.</li>
                <li>Membiasakan hidup sehat.</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- teacher section -->
  <section class="teacher_section layout_padding-bottom">
    <div class="container">
      <h2 class="main-heading">
        Pengajar Kami
      </h2>
      <p class="text-center">
        Guru-guru berpengalaman dan penuh kasih sayang yang siap membimbing tumbuh kembang anak Anda.
      </p>
      <div class="teacher_container layout_padding2">
        <div class="card-deck">
          <div class="card">
            <img class="card-img-top teacher-img-placeholder" src="" alt="Foto Pengajar">
            <div class="card-body">
              <h5 class="card-title">Denise Hale</h5>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top teacher-img-placeholder" src="" alt="Foto Pengajar">
            <div class="card-body">
              <h5 class="card-title">Nancy Cruz</h5>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top teacher-img-placeholder" src="" alt="Foto Pengajar">
            <div class="card-body">
              <h5 class="card-title">Ina Hayes</h5>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top teacher-img-placeholder" src="" alt="Foto Pengajar">
            <div class="card-body">
              <h5 class="card-title">Salley Stone</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-center">
        <a href="{{ route('teacher') }}" class="call_to-btn">
          <span>
            Lihat Semua Pengajar
          </span>
          <img src="{{ asset('adward/images/right-arrow.png') }}" alt="">
        </a>
      </div>
    </div>
  </section>


  <!-- fasilitas section -->
  <section class="fasilitas_section layout_padding">
    <div class="container">
      <h2 class="main-heading">
        Fasilitas Sekolah
      </h2>
      <p class="text-center mb-4">
        Berbagai fasilitas lengkap untuk mendukung tumbuh kembang dan kenyamanan belajar anak.
      </p>
      <div class="fasilitas-grid">
        <div class="fasilitas-item">
          <img src="" alt="Ruang Kelas" class="img-fluid fasilitas-img-placeholder">
          <div class="fasilitas-overlay"><span>Ruang Kelas</span></div>
        </div>
        <div class="fasilitas-item">
          <img src="" alt="Area Bermain" class="img-fluid fasilitas-img-placeholder">
          <div class="fasilitas-overlay"><span>Area Bermain</span></div>
        </div>
        <div class="fasilitas-item">
          <img src="" alt="Halaman Sekolah" class="img-fluid fasilitas-img-placeholder">
          <div class="fasilitas-overlay"><span>Halaman Sekolah</span></div>
        </div>
        <div class="fasilitas-item">
          <img src="" alt="Ruang Seni" class="img-fluid fasilitas-img-placeholder">
          <div class="fasilitas-overlay"><span>Ruang Seni</span></div>
        </div>
        <div class="fasilitas-item">
          <img src="" alt="Perpustakaan" class="img-fluid fasilitas-img-placeholder">
          <div class="fasilitas-overlay"><span>Perpustakaan</span></div>
        </div>
        <div class="fasilitas-item">
          <img src="" alt="Aula Sekolah" class="img-fluid fasilitas-img-placeholder">
          <div class="fasilitas-overlay"><span>Aula Sekolah</span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- map section (ukuran semula) -->
  <section class="map_section layout_padding-top">
    <div class="container text-center mb-4">
      <h2 class="main-heading">
        Lokasi TK Harapan Bunda
      </h2>
      <p class="text-center">
        Jl. Babakan Ciparay No.251, Sukahaji, Kec. Babakan Ciparay, Kota Bandung, Jawa Barat 40242
      </p>
    </div>
    <div class="container-fluid p-0">
      <iframe
        src="https://maps.google.com/maps?q=Jl.+Babakan+Ciparay+No.251,+Sukahaji,+Kec.+Babakan+Ciparay,+Kota+Bandung,+Jawa+Barat+40242&output=embed"
        width="100%"
        height="450"
        style="border:0;"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </section>

@endsection

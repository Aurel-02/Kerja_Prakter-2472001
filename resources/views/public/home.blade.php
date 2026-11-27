@extends('layouts.public')

@section('title', 'TK Harapan Bunda - Beranda')

@section('top_container')
  <div class="top_container home_wallpaper_hero">
    <!-- header section starts -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <!-- Nama Sekolah / Brand -->
          <a class="navbar-brand text-white font-weight-bold" href="{{ route('home') }}">
            TK Harapan Bunda
          </a>

          <!-- Tombol Toggler Hamburger (Mobile) -->
          <button class="navbar-toggler text-white ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <!-- Menu Navbar Horizontal -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto align-items-lg-center">
              <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                <a class="nav-link font-weight-bold" href="{{ route('home') }}">Beranda</a>
              </li>
              <li class="nav-item dropdown {{ request()->routeIs('about', 'kurikulum', 'teacher', 'vehicle') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="profilDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Profil Kami
                </a>
                <div class="dropdown-menu" aria-labelledby="profilDropdown">
                  <a class="dropdown-item {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Profil Sekolah</a>
                  <a class="dropdown-item {{ request()->routeIs('kurikulum') ? 'active' : '' }}" href="{{ route('kurikulum') }}">Kurikulum</a>
                  <a class="dropdown-item {{ request()->routeIs('teacher') ? 'active' : '' }}" href="{{ route('teacher') }}">Struktur</a>
                  <a class="dropdown-item {{ request()->routeIs('vehicle') ? 'active' : '' }}" href="{{ route('vehicle') }}">Fasilitas</a>
                </div>
              </li>
              <li class="nav-item {{ request()->routeIs('kalender') ? 'active' : '' }}">
                <a class="nav-link font-weight-bold" href="{{ route('kalender') }}">Kalender Akademik</a>
              </li>
              <li class="nav-item {{ request()->routeIs('galeri') ? 'active' : '' }}">
                <a class="nav-link font-weight-bold" href="{{ route('galeri') }}">Galeri</a>
              </li>
            </ul>

            <!-- Tombol Login -->
            <div class="mt-2 mt-lg-0">
              <a href="{{ route('login') }}" class="btn btn-warning btn-sm font-weight-bold rounded-pill px-3 py-1 text-dark shadow-sm">
                <i class="fa fa-sign-in mr-1"></i> Portal Staf
              </a>
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
          <div class="col-lg-9 col-md-10">
            <div class="hero_detail-box text-white">
              <h3 class="text-warning font-weight-bold mb-2 hero-sub-title" style="font-size: 1.5rem; text-shadow: 0 2px 6px rgba(0,0,0,0.5);">
                Selamat Datang di
              </h3>
              <h1 class="font-weight-bold text-white mb-3 hero-main-title" style="font-size: clamp(2.5rem, 5.5vw, 4.2rem); line-height: 1.15; text-shadow: 0 4px 14px rgba(0,0,0,0.6);">
                TK Harapan Bunda
              </h1>
              <p class="lead text-white mb-0 hero-desc-p" style="font-size: 1.12rem; line-height: 1.65; text-shadow: 0 2px 8px rgba(0,0,0,0.65); max-width: 720px;">
                @php
                  $ringkasanProfil = 'Sekolah taman kanak-kanak di Babakan Ciparay, Kota Bandung di bawah naungan Yayasan Pendidikan Cahaya Pelita yang melayani anak usia 4–6 tahun dengan lingkungan belajar aman, inklusif, dan berbasis bermain.';
                  if (!empty($sekolah?->deskripsi_profil)) {
                    $paragraf = preg_split('/\r\n|\r|\n/', trim($sekolah->deskripsi_profil));
                    if (!empty($paragraf[0])) {
                      $ringkasanProfil = $paragraf[0];
                    }
                  }
                @endphp
                {{ $ringkasanProfil }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- end header section -->
@endsection

@section('content')

  <!-- teacher section -->
  <section class="teacher_section layout_padding">
    <div class="container">
      <h2 class="main-heading">
        Pengajar Kami
      </h2>
      <p class="text-center">
        Guru-guru berpengalaman dan penuh kasih sayang yang siap membimbing tumbuh kembang anak Anda.
      </p>
      <div class="teacher_container layout_padding2">
        <div class="teacher-card-grid">
          @foreach($guruList as $guru)
          <div class="card teacher-card">
            <img class="card-img-top teacher-img-placeholder" src="{{ asset($guru->foto ?? 'adward/images/guru-1.jpeg') }}" alt="Foto {{ $guru->nama }}" style="object-position: top;">
            <div class="card-body text-center">
              <h5 class="card-title mb-1">{{ $guru->nama }}</h5>
              <small class="text-muted">{{ $guru->jabatan }}</small>
            </div>
          </div>
          @endforeach
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
        @foreach($fasilitas as $item)
        <div class="fasilitas-item">
          <img src="{{ asset($item->link_foto) }}" alt="{{ $item->judul }}" class="img-fluid fasilitas-img-placeholder">
          <div class="fasilitas-overlay"><span>{{ $item->judul }}</span></div>
        </div>
        @endforeach
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
        src="{{ (!empty($sekolah?->link_maps) && str_contains($sekolah->link_maps, 'output=embed')) ? $sekolah->link_maps : 'https://maps.google.com/maps?q=Jl.+Babakan+Ciparay+No.251,+Sukahaji,+Kec.+Babakan+Ciparay,+Kota+Bandung,+Jawa+Barat+40242&output=embed' }}"
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

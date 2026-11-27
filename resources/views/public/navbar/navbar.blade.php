{{-- Partial: Navbar untuk sub pages --}}
<div class="top_container sub_pages">
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
              <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="profilDropdownSub" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Profil Kami
              </a>
              <div class="dropdown-menu" aria-labelledby="profilDropdownSub">
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
</div>

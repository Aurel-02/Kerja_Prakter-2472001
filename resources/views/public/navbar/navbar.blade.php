{{-- Partial: Navbar untuk sub pages --}}
<div class="top_container sub_pages">
  <!-- header section starts -->
  <header class="header_section">
    <div class="container">
      <nav class="navbar custom_nav-container">

        <!-- Nama Sekolah / Brand -->
        <a class="navbar-brand text-white font-weight-bold" href="{{ route('home') }}">
          TK Harapan Bunda
        </a>

        <!-- Tombol Login & Hamburger -->
        <div class="ml-auto d-flex align-items-center">
          <a href="{{ route('login') }}" class="btn btn-warning btn-sm font-weight-bold rounded-pill px-3 py-1 mr-2 text-dark shadow-sm">
            <i class="fa fa-sign-in mr-1"></i> Login
          </a>

          <!-- Tombol Toggler Hamburger -->
          <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>

        <!-- Menu Navbar (Dropdown Vertikal) -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="d-flex mx-auto flex-column align-items-center w-100">
            <ul class="navbar-nav w-100 justify-content-center">
              <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                <a class="nav-link font-weight-bold" href="{{ route('home') }}"> Beranda </a>
              </li>
              <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                <a class="nav-link font-weight-bold" href="{{ route('about') }}"> Tentang Kami </a>
              </li>
              <li class="nav-item {{ request()->routeIs('kurikulum') ? 'active' : '' }}">
                <a class="nav-link font-weight-bold" href="{{ route('kurikulum') }}"> Kurikulum </a>
              </li>
              <li class="nav-item {{ request()->routeIs('teacher') ? 'active' : '' }}">
                <a class="nav-link font-weight-bold" href="{{ route('teacher') }}"> Struktur </a>
              </li>
              <li class="nav-item {{ request()->routeIs('vehicle') ? 'active' : '' }}">
                <a class="nav-link font-weight-bold" href="{{ route('vehicle') }}"> Fasilitas </a>
              </li>
              <li class="nav-item {{ request()->routeIs('kalender') ? 'active' : '' }}">
                <a class="nav-link font-weight-bold" href="{{ route('kalender') }}"> Kalender Akademik </a>
              </li>
              <li class="nav-item {{ request()->routeIs('galeri') ? 'active' : '' }}">
                <a class="nav-link font-weight-bold" href="{{ route('galeri') }}"> Galeri </a>
              </li>
              <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                <a class="nav-link font-weight-bold" href="{{ route('contact') }}"> Hubungi Kami </a>
              </li>
              <li class="nav-item d-md-none mt-2">
                <a class="nav-link font-weight-bold text-warning" href="{{ route('login') }}">
                  <i class="fa fa-sign-in mr-1"></i> Login
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
</div>

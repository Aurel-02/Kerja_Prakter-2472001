{{-- Partial: Navbar untuk sub pages --}}
<div class="top_container sub_pages">
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
</div>

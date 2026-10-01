{{-- Partial: Navbar untuk sub pages --}}
<div class="top_container sub_pages">
  <!-- header section strats -->
  <header class="header_section">
    <div class="container">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="{{ route('home') }}">
          <img src="{{ asset('adward/images/logo.png') }}" alt="">
          <span>
            Adward
          </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
            <ul class="navbar-nav  ">
              <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}"> Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('about') }}"> About </a>
              </li>
              <li class="nav-item {{ request()->routeIs('teacher') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('teacher') }}"> Teacher </a>
              </li>
              <li class="nav-item {{ request()->routeIs('vehicle') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('vehicle') }}"> Vehicle </a>
              </li>
              <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
              </li>
            </ul>
            <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
              <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
            </form>
          </div>
      </nav>
    </div>
  </header>
</div>

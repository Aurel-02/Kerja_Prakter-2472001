<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Admin - TK Harapan Bunda')</title>

  <!-- Google Font: Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('adward/css/bootstrap.css') }}" />

  <!-- Font Awesome 6 Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="{{ asset('adward/css/datatables/datatables.min.css') }}" />

  <!-- Portal Admin Stylesheet -->
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />

  @yield('styles')
</head>

<body>

  <!-- Backdrop for mobile sidebar -->
  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

  <!-- ================= SIDEBAR ================= -->
  <aside class="app-sidebar" id="appSidebar">
    <!-- Brand Title -->
    <div class="sidebar-brand">
      <span class="sidebar-brand-title" style="font-size: 17px; font-weight: 800; color: #16a34a; letter-spacing: -0.3px;">Portal Admin</span>
    </div>

    <!-- Navigation Menu (Menyesuaikan warna dan isi navbar yang ada) -->
    <div class="sidebar-nav">
      <div class="nav-group-label">Menu Utama</div>

      <!-- Dashboard -->
      <a href="{{ route('admin.dashboard') }}" class="nav-item-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fa-solid fa-house"></i>
        <span>Dashboard</span>
      </a>

      <!-- Scan QR Penjemputan -->
      <a href="{{ route('admin.scan-qr') }}" class="nav-item-link {{ request()->routeIs('admin.scan-qr*') ? 'active' : '' }}">
        <i class="fa-solid fa-qrcode"></i>
        <span>Scan QR Penjemputan</span>
      </a>

      <div class="nav-group-label" style="margin-top: 10px;">Data Sekolah</div>

      <!-- Data Struktur Sekolah (Guru) -->
      <a href="{{ route('admin.guru') }}" class="nav-item-link {{ request()->routeIs('admin.guru') ? 'active' : '' }}">
        <i class="fa-solid fa-chalkboard-user"></i>
        <span>Struktur Sekolah</span>
      </a>

      <!-- Data Siswa -->
      <a href="{{ route('admin.siswa') }}" class="nav-item-link {{ request()->routeIs('admin.siswa') ? 'active' : '' }}">
        <i class="fa-solid fa-graduation-cap"></i>
        <span>Data Siswa</span>
      </a>

      <!-- Data Orang Tua / Wali -->
      <a href="{{ route('admin.orang-tua') }}" class="nav-item-link {{ request()->routeIs('admin.orang-tua') ? 'active' : '' }}">
        <i class="fa-solid fa-people-roof"></i>
        <span>Data Orang Tua</span>
      </a>

      <div class="nav-group-label" style="margin-top: 10px;">Akademik</div>

      <!-- Kalender Akademik -->
      <a href="{{ route('admin.kalender') }}" class="nav-item-link {{ request()->routeIs('admin.kalender') ? 'active' : '' }}">
        <i class="fa-solid fa-calendar-days"></i>
        <span>Kalender Akademik</span>
      </a>

      <!-- Kurikulum -->
      <a href="{{ route('admin.kurikulum') }}" class="nav-item-link {{ request()->routeIs('admin.kurikulum') ? 'active' : '' }}">
        <i class="fa-solid fa-book-open"></i>
        <span>Kurikulum</span>
      </a>

      <div class="nav-group-label" style="margin-top: 10px;">Media & Konten</div>

      <!-- Galeri Foto -->
      <a href="{{ route('admin.galeri') }}" class="nav-item-link {{ request()->routeIs('admin.galeri') ? 'active' : '' }}">
        <i class="fa-solid fa-images"></i>
        <span>Galeri Foto</span>
      </a>

      <div class="nav-group-label" style="margin-top: 10px;">Sistem</div>

      <!-- Kelola Akun Pengguna -->
      <a href="{{ route('admin.users') }}" class="nav-item-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
        <i class="fa-solid fa-users-gear"></i>
        <span>Kelola Pengguna</span>
      </a>

      <!-- Website Utama -->
      <a href="{{ route('home') }}" target="_blank" class="nav-item-link">
        <i class="fa-solid fa-arrow-up-right-from-square"></i>
        <span>Lihat Website</span>
      </a>
    </div>

    <!-- Bottom Footer Sign Out -->
    <div class="sidebar-footer">
      <form action="{{ route('logout') }}" method="POST" id="logoutFormSidebar" style="display: none;">
        @csrf
      </form>
      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logoutFormSidebar').submit();" class="sidebar-footer-link text-danger">
        <i class="fa-solid fa-right-from-bracket"></i>
        <span>Logout</span>
      </a>
    </div>
  </aside>

  <!-- ================= TOPBAR ================= -->
  <header class="app-topbar">
    <div class="topbar-left-wrap">
      <button class="btn-mobile-toggle" id="mobileNavToggle" title="Buka Menu">
        <i class="fa-solid fa-bars"></i>
      </button>
    </div>

    <!-- Right Controls -->
    <div class="topbar-actions">
      <!-- Notification Icon -->
      <a href="#" class="action-btn-circle" title="Notifikasi">
        <i class="fa-regular fa-bell"></i>
        <span class="badge-dot"></span>
      </a>

      <!-- User Profile Info -->
      <div class="topbar-user-pill" style="cursor: default;">
        <div class="user-info-text">
          <span class="user-name">{{ Auth::user()->nama ?? 'Administrator' }}</span>
          <span class="user-role">Admin</span>
        </div>
      </div>
    </div>
  </header>

  <!-- ================= MAIN CONTENT ================= -->
  <main class="app-main">
    <div class="content-container">
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px; font-weight: 600; display: flex; align-items: center; gap: 8px; margin-bottom: 20px;">
          <i class="fa-solid fa-circle-check"></i>
          <div>{{ session('success') }}</div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-left: auto; background: none; border: none; font-size: 20px; line-height: 1; cursor: pointer;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 10px; font-weight: 500; margin-bottom: 20px;">
          <div style="font-weight: 700; margin-bottom: 4px;"><i class="fa-solid fa-triangle-exclamation"></i> Terdapat kesalahan:</div>
          <ul class="mb-0 pl-3">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-left: auto; float: right; background: none; border: none; font-size: 20px; line-height: 1; cursor: pointer;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      @yield('content')
    </div>
  </main>

  <!-- Scripts -->
  <script src="{{ asset('adward/js/jquery-3.4.1.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Chart.js for beautiful charts -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- DataTables JS -->
  <script src="{{ asset('adward/js/datatables/datatables.min.js') }}"></script>

  <script>
    // Mobile sidebar toggle handler
    const mobileBtn = document.getElementById('mobileNavToggle');
    const sidebar = document.getElementById('appSidebar');
    const backdrop = document.getElementById('sidebarBackdrop');

    if (mobileBtn && sidebar && backdrop) {
      mobileBtn.addEventListener('click', function () {
        sidebar.classList.toggle('show');
        backdrop.classList.toggle('show');
      });
      backdrop.addEventListener('click', function () {
        sidebar.classList.remove('show');
        backdrop.classList.remove('show');
      });
    }
  </script>

  @yield('scripts')

</body>
</html>

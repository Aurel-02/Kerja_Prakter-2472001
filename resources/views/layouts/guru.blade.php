<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Portal Guru - TK Harapan Bunda')</title>

  <!-- Google Font: Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('adward/css/bootstrap.css') }}" />

  <!-- Font Awesome 6 Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

  <style>
    :root {
      --primary: #16a34a;
      --primary-dark: #15803d;
      --primary-light: #eaf8f0;
      --primary-border: #bbf7d0;
      --accent-orange: #f59e0b;
      --accent-blue: #0ea5e9;
      --accent-rose: #f43f5e;
      --accent-purple: #8b5cf6;
      --bg-body: #f5f7fb;
      --card-bg: #ffffff;
      --text-main: #1e293b;
      --text-muted: #64748b;
      --text-light: #94a3b8;
      --border-color: #edf2f7;
      --sidebar-width: 240px;
      --topbar-height: 68px;
    }

    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      font-size: 13.5px;
      background: var(--bg-body);
      color: var(--text-main);
      margin: 0;
      padding: 0;
      -webkit-font-smoothing: antialiased;
    }

    /* ====================================================
       SIDEBAR
    ==================================================== */
    .app-sidebar {
      width: var(--sidebar-width);
      min-height: 100vh;
      background: #ffffff;
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      border-right: 1px solid var(--border-color);
      display: flex;
      flex-direction: column;
      z-index: 1020;
      overflow-y: auto;
      transition: transform 0.25s ease;
    }

    .sidebar-brand {
      height: var(--topbar-height);
      display: flex;
      align-items: center;
      padding: 0 20px;
      gap: 10px;
      border-bottom: 1px solid var(--border-color);
    }

    .sidebar-brand img {
      width: 34px;
      height: 34px;
      object-fit: contain;
    }

    .sidebar-brand-text {
      display: flex;
      flex-direction: column;
    }

    .sidebar-brand-title {
      font-size: 14.5px;
      font-weight: 700;
      color: var(--text-main);
      line-height: 1.2;
      letter-spacing: -0.2px;
    }

    .sidebar-brand-sub {
      font-size: 11px;
      font-weight: 600;
      color: #10b981;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .sidebar-nav {
      padding: 16px 12px;
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 3px;
    }

    .nav-group-label {
      font-size: 10.5px;
      font-weight: 700;
      color: var(--text-light);
      text-transform: uppercase;
      letter-spacing: 0.7px;
      padding: 12px 10px 4px 10px;
    }

    .nav-item-link {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 9px 12px;
      color: var(--text-muted);
      border-radius: 8px;
      font-weight: 600;
      font-size: 13px;
      text-decoration: none !important;
      transition: all 0.15s ease-in-out;
    }

    .nav-item-link i {
      font-size: 15px;
      width: 20px;
      text-align: center;
      color: var(--text-light);
      transition: color 0.15s ease-in-out;
    }

    .nav-item-link:hover {
      background: #f8fafc;
      color: var(--primary);
    }

    .nav-item-link:hover i {
      color: var(--primary);
    }

    .nav-item-link.active {
      background: var(--primary-light);
      color: var(--primary-dark);
      font-weight: 700;
    }

    .nav-item-link.active i {
      color: var(--primary);
    }

    .sidebar-footer {
      padding: 14px 12px;
      border-top: 1px solid var(--border-color);
      background: #ffffff;
    }

    .sidebar-footer-link {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 9px 12px;
      color: var(--accent-rose);
      border-radius: 8px;
      font-weight: 600;
      font-size: 13px;
      text-decoration: none !important;
      transition: background 0.15s ease;
      cursor: pointer;
    }

    .sidebar-footer-link:hover {
      background: #fff1f2;
      color: #e11d48;
    }

    /* ====================================================
       TOPBAR
    ==================================================== */
    .app-topbar {
      position: fixed;
      top: 0;
      left: var(--sidebar-width);
      right: 0;
      height: var(--topbar-height);
      background: #ffffff;
      border-bottom: 1px solid var(--border-color);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 28px;
      z-index: 1010;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
    }

    .topbar-left-wrap {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .btn-mobile-toggle {
      display: none;
      background: none;
      border: none;
      font-size: 20px;
      color: var(--text-muted);
      cursor: pointer;
      padding: 4px;
    }

    .topbar-badge-role {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: #eaf8f0;
      color: #15803d;
      font-size: 12px;
      font-weight: 700;
      padding: 5px 12px;
      border-radius: 9999px;
      border: 1px solid #bbf7d0;
    }

    .topbar-actions {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .topbar-user-pill {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 6px 12px;
      border-radius: 9999px;
      background: #f8fafc;
      border: 1px solid var(--border-color);
      cursor: pointer;
      user-select: none;
      transition: background 0.15s;
    }

    .topbar-user-pill:hover {
      background: #f1f5f9;
    }

    .user-info-text {
      display: flex;
      flex-direction: column;
      text-align: left;
    }

    .user-name {
      font-size: 12.5px;
      font-weight: 700;
      color: var(--text-main);
      line-height: 1.2;
    }

    .user-role {
      font-size: 11px;
      font-weight: 500;
      color: var(--text-muted);
    }

    .user-chevron {
      color: var(--text-light);
      font-size: 10px;
      margin-left: 2px;
    }

    /* ====================================================
       MAIN CONTENT
    ==================================================== */
    .app-main {
      margin-left: var(--sidebar-width);
      padding-top: var(--topbar-height);
      min-height: 100vh;
    }

    .content-container {
      padding: 26px 30px 50px 30px;
    }

    .page-header-title {
      font-size: 22px;
      font-weight: 800;
      color: var(--text-main);
      margin-bottom: 4px;
      letter-spacing: -0.4px;
    }

    .page-header-sub {
      color: var(--text-muted);
      font-size: 13px;
      margin: 0;
    }

    /* Cards */
    .admin-card {
      background: var(--card-bg);
      border-radius: 14px;
      border: 1px solid var(--border-color);
      padding: 20px 22px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
      margin-bottom: 20px;
    }

    .card-header-flex {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 16px;
    }

    .card-title-main {
      font-size: 15px;
      font-weight: 700;
      color: var(--text-main);
      margin: 0;
    }

    .card-subtitle-small {
      font-size: 12px;
      color: var(--text-muted);
      margin-top: 2px;
    }

    /* Mobile Backdrop */
    .sidebar-backdrop {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(15, 23, 42, 0.4);
      z-index: 1019;
    }

    @media (max-width: 991px) {
      .app-sidebar {
        transform: translateX(-100%);
      }
      .app-sidebar.show {
        transform: translateX(0);
      }
      .sidebar-backdrop.show {
        display: block;
      }
      .app-topbar {
        left: 0;
        padding: 0 16px;
      }
      .app-main {
        margin-left: 0;
      }
      .btn-mobile-toggle {
        display: block;
      }
      .content-container {
        padding: 18px 16px 40px 16px;
      }
    }
  </style>

  @yield('styles')
</head>

<body>

  <!-- Backdrop for mobile sidebar -->
  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

  <!-- ================= SIDEBAR ================= -->
  <aside class="app-sidebar" id="appSidebar">
    <div class="sidebar-brand">
      <span class="sidebar-brand-title" style="font-size: 17px; font-weight: 800; color: #16a34a; letter-spacing: -0.3px;">Portal Guru</span>
    </div>

    <!-- Navigation Menu Guru -->
    <div class="sidebar-nav">
      <div class="nav-group-label">Menu Guru</div>

      <!-- Dashboard -->
      <a href="{{ route('guru.dashboard') }}" class="nav-item-link {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
        <i class="fa-solid fa-house"></i>
        <span>Dashboard</span>
      </a>

      <!-- Scan QR Penjemputan -->
      <a href="{{ route('guru.scan-qr') }}" class="nav-item-link {{ request()->routeIs('guru.scan-qr') ? 'active' : '' }}">
        <i class="fa-solid fa-qrcode"></i>
        <span>Scan QR Penjemputan</span>
      </a>

      <div class="nav-group-label" style="margin-top: 10px;">Kegiatan & Akademik</div>

      <!-- Informasi Siswa -->
      <a href="{{ route('home') }}" class="nav-item-link" title="Data Siswa Aktif">
        <i class="fa-solid fa-graduation-cap"></i>
        <span>Data Siswa</span>
      </a>

      <!-- Kalender Akademik -->
      <a href="{{ route('kalender') }}" target="_blank" class="nav-item-link">
        <i class="fa-solid fa-calendar-days"></i>
        <span>Kalender Akademik</span>
      </a>

      <!-- Kurikulum -->
      <a href="{{ route('kurikulum') }}" target="_blank" class="nav-item-link">
        <i class="fa-solid fa-book-open"></i>
        <span>Kurikulum Belajar</span>
      </a>

      <div class="nav-group-label" style="margin-top: 10px;">Sistem</div>

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
        <span>Keluar Sistem</span>
      </a>
    </div>
  </aside>

  <!-- ================= TOPBAR ================= -->
  <header class="app-topbar">
    <div class="topbar-left-wrap">
      <button class="btn-mobile-toggle" id="mobileNavToggle" title="Buka Menu">
        <i class="fa-solid fa-bars"></i>
      </button>

      <span class="topbar-badge-role">
        <i class="fa-solid fa-id-badge"></i> Guru / Pendidik
      </span>
    </div>

    <!-- Right Controls -->
    <div class="topbar-actions">
      <!-- User Profile Pill -->
      <div class="dropdown">
        <div class="topbar-user-pill" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
          <div class="user-info-text">
            <span class="user-name">{{ Auth::user()->nama ?? 'Guru Pengajar' }}</span>
            <span class="user-role">Guru ({{ Auth::user()->username ?? 'guru1' }})</span>
          </div>
          <i class="fa-solid fa-chevron-down user-chevron"></i>
        </div>
        <div class="dropdown-menu dropdown-menu-right shadow-sm mt-2" style="border-radius: 12px; border: 1px solid var(--border-color); min-width: 180px; padding: 6px;">
          <a class="dropdown-item" href="{{ route('home') }}" target="_blank" style="font-size: 13px; padding: 8px 12px; border-radius: 8px;">
            <i class="fa-solid fa-globe mr-2 text-success"></i> Lihat Website
          </a>
          <div class="dropdown-divider"></div>
          <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="dropdown-item text-danger" style="font-size: 13px; padding: 8px 12px; border-radius: 8px; cursor: pointer; border: none; background: none;">
              <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
            </button>
          </form>
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
  <script src="{{ asset('adward/js/bootstrap.js') }}"></script>
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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


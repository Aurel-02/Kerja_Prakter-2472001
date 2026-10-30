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
      font-weight: 500;
      color: var(--text-muted);
    }

    .sidebar-nav {
      padding: 14px 12px;
      flex: 1;
    }

    .nav-group-label {
      font-size: 10.5px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      color: var(--text-light);
      padding: 10px 12px 4px;
    }

    .nav-item-link {
      display: flex;
      align-items: center;
      gap: 11px;
      padding: 9px 12px;
      color: #475569;
      text-decoration: none;
      font-size: 13px;
      font-weight: 500;
      border-radius: 9px;
      margin-bottom: 2px;
      transition: all 0.15s ease-in-out;
      position: relative;
    }

    .nav-item-link i {
      font-size: 14px;
      width: 18px;
      text-align: center;
      color: #94a3b8;
      transition: color 0.15s ease;
    }

    .nav-item-link:hover {
      background: #f8fafc;
      color: var(--text-main);
      text-decoration: none;
    }

    .nav-item-link:hover i {
      color: var(--primary);
    }

    /* Active nav item - matching reference screenshot */
    .nav-item-link.active {
      background: var(--primary-light);
      color: var(--primary-dark);
      font-weight: 600;
      text-decoration: none;
    }

    .nav-item-link.active i {
      color: var(--primary);
    }

    .nav-item-link.active::before {
      content: '';
      position: absolute;
      left: 0;
      top: 50%;
      transform: translateY(-50%);
      width: 3.5px;
      height: 18px;
      background: var(--primary);
      border-radius: 0 4px 4px 0;
    }

    .nav-item-badge {
      margin-left: auto;
      font-size: 10.5px;
      padding: 1.5px 6px;
      border-radius: 20px;
      background: #f1f5f9;
      color: #64748b;
      font-weight: 600;
    }

    .nav-item-link.active .nav-item-badge {
      background: #dcfce7;
      color: var(--primary-dark);
    }

    .sidebar-footer {
      padding: 12px 14px;
      border-top: 1px solid var(--border-color);
      background: #ffffff;
    }

    .sidebar-footer-link {
      display: flex;
      align-items: center;
      gap: 9px;
      padding: 8px 12px;
      color: #64748b;
      font-size: 12.5px;
      font-weight: 500;
      text-decoration: none;
      border-radius: 8px;
      transition: all 0.15s ease;
    }

    .sidebar-footer-link:hover {
      background: #fef2f2;
      color: #dc2626;
      text-decoration: none;
    }

    .sidebar-footer-link i {
      font-size: 13px;
      width: 16px;
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
      padding: 0 24px;
      z-index: 1000;
    }

    .topbar-left-wrap {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .btn-mobile-toggle {
      display: none;
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      width: 36px;
      height: 36px;
      border-radius: 8px;
      color: var(--text-main);
      cursor: pointer;
      align-items: center;
      justify-content: center;
      font-size: 14px;
    }

    /* Search Input Pill */
    .topbar-search-wrap {
      position: relative;
      width: 290px;
    }

    .topbar-search-input {
      width: 100%;
      height: 38px;
      padding: 0 16px 0 38px;
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 20px;
      font-size: 12.5px;
      color: var(--text-main);
      outline: none;
      transition: all 0.2s ease;
      font-family: inherit;
    }

    .topbar-search-input:focus {
      background: #ffffff;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.12);
    }

    .topbar-search-icon {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--text-light);
      font-size: 13px;
      pointer-events: none;
    }

    /* Topbar Right Actions */
    .topbar-actions {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .action-btn-circle {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #64748b;
      text-decoration: none;
      position: relative;
      transition: all 0.2s ease;
      cursor: pointer;
    }

    .action-btn-circle:hover {
      background: #f1f5f9;
      color: var(--text-main);
      text-decoration: none;
    }

    .action-btn-circle .badge-dot {
      position: absolute;
      top: 8px;
      right: 9px;
      width: 7px;
      height: 7px;
      background: #ef4444;
      border-radius: 50%;
      border: 1.5px solid #ffffff;
    }

    /* User Profile Pill */
    .topbar-user-pill {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 2px 4px;
      cursor: pointer;
      user-select: none;
    }

    .user-avatar-img {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      object-fit: cover;
      object-position: top;
      border: 1.5px solid #e2e8f0;
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
       MAIN WRAPPER & CARDS
    ==================================================== */
    .app-main {
      margin-left: var(--sidebar-width);
      padding-top: var(--topbar-height);
      min-height: 100vh;
    }

    .content-container {
      padding: 24px 28px 40px;
    }

    .page-header-title {
      font-size: 20px;
      font-weight: 700;
      color: var(--text-main);
      margin: 0 0 4px;
      letter-spacing: -0.3px;
    }

    .page-header-sub {
      font-size: 12.5px;
      color: var(--text-muted);
      margin: 0 0 20px;
    }

    /* Card Component */
    .admin-card {
      background: var(--card-bg);
      border-radius: 16px;
      border: 1px solid var(--border-color);
      box-shadow: 0 4px 18px rgba(15, 23, 42, 0.02);
      padding: 20px 22px;
      margin-bottom: 22px;
      transition: box-shadow 0.2s ease;
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
      font-size: 11.5px;
      color: var(--text-muted);
      margin-top: 2px;
    }

    .btn-more-icon {
      background: none;
      border: none;
      color: var(--text-light);
      font-size: 15px;
      cursor: pointer;
      padding: 4px 8px;
      border-radius: 6px;
    }

    .btn-more-icon:hover {
      background: #f1f5f9;
      color: var(--text-main);
    }

    /* Tables */
    .custom-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      font-size: 13px;
    }

    .custom-table th {
      background: #fafbfc;
      color: #64748b;
      font-weight: 600;
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      padding: 10px 14px;
      border-top: 1px solid #f1f5f9;
      border-bottom: 1px solid #eef2f6;
    }

    .custom-table th:first-child {
      border-top-left-radius: 8px;
      border-bottom-left-radius: 8px;
    }

    .custom-table th:last-child {
      border-top-right-radius: 8px;
      border-bottom-right-radius: 8px;
    }

    .custom-table td {
      padding: 12px 14px;
      vertical-align: middle;
      border-bottom: 1px solid #f8fafc;
      color: #334155;
    }

    .custom-table tr:hover td {
      background: #fbfcfe;
    }

    /* Status Badges */
    .badge-pill {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 3px 10px;
      border-radius: 20px;
      font-size: 11.5px;
      font-weight: 600;
    }

    .badge-green { background: #dcfce7; color: #15803d; }
    .badge-yellow { background: #fef3c7; color: #b45309; }
    .badge-blue { background: #e0f2fe; color: #0369a1; }
    .badge-red { background: #fee2e2; color: #b91c1c; }

    /* Buttons */
    .btn-brand-primary {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: var(--primary);
      color: #ffffff;
      padding: 8px 18px;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 600;
      border: none;
      text-decoration: none;
      transition: background 0.15s ease;
      cursor: pointer;
    }

    .btn-brand-primary:hover {
      background: var(--primary-dark);
      color: #ffffff;
      text-decoration: none;
    }

    /* Mobile Backdrop */
    .sidebar-backdrop {
      display: none;
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(15, 23, 42, 0.4);
      z-index: 1015;
    }

    /* Responsive */
    @media (max-width: 768px) {
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
      .btn-mobile-toggle {
        display: flex;
      }
      .app-main {
        margin-left: 0;
      }
      .topbar-search-wrap {
        width: 170px;
      }
      .user-info-text {
        display: none;
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
    <!-- Brand Logo -->
    <div class="sidebar-brand">
      <div class="sidebar-brand-text">
        <span class="sidebar-brand-title">TK Harapan Bunda</span>
        <span class="sidebar-brand-sub">Admin</span>
      </div>
    </div>

    <!-- Navigation Menu (Menyesuaikan warna dan isi navbar yang ada) -->
    <div class="sidebar-nav">
      <div class="nav-group-label">Menu Utama</div>

      <!-- Dashboard -->
      <a href="{{ route('admin.dashboard') }}" class="nav-item-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fa-solid fa-house"></i>
        <span>Dashboard</span>
      </a>

      <div class="nav-group-label" style="margin-top: 10px;">Data Akademik</div>

      <!-- Data Guru -->
      <a href="{{ route('admin.guru') }}" class="nav-item-link {{ request()->routeIs('admin.guru') ? 'active' : '' }}">
        <i class="fa-solid fa-chalkboard-user"></i>
        <span>Data Struktur Sekolah</span>
      </a>

      <!-- Data Siswa -->
      <a href="{{ route('admin.siswa') }}" class="nav-item-link {{ request()->routeIs('admin.siswa') ? 'active' : '' }}">
        <i class="fa-solid fa-graduation-cap"></i>
        <span>Data Siswa</span>
      </a>

      <!-- Kalender Akademik -->
      <a href="{{ route('admin.kalender') }}" class="nav-item-link {{ request()->routeIs('admin.kalender') ? 'active' : '' }}">
        <i class="fa-solid fa-calendar-days"></i>
        <span>Kalender Akademik</span>
      </a>

      <div class="nav-group-label" style="margin-top: 10px;">Media & Konten</div>

      <!-- Galeri Foto -->
      <a href="{{ route('admin.galeri') }}" class="nav-item-link {{ request()->routeIs('admin.galeri') ? 'active' : '' }}">
        <i class="fa-solid fa-images"></i>
        <span>Galeri Foto</span>
      </a>

      <!-- Kurikulum -->
      <a href="{{ route('admin.kurikulum') }}" class="nav-item-link {{ request()->routeIs('admin.kurikulum') ? 'active' : '' }}">
        <i class="fa-solid fa-book-open"></i>
        <span>Kurikulum</span>
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
      <a href="{{ route('home') }}" class="sidebar-footer-link">
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

      <!-- Search Bar -->
      <div class="topbar-search-wrap">
        <i class="fa-solid fa-magnifying-glass topbar-search-icon"></i>
        <input type="text" class="topbar-search-input" placeholder="Cari data..." />
      </div>
    </div>

    <!-- Right Controls -->
    <div class="topbar-actions">
      <!-- Notification Icon -->
      <a href="#" class="action-btn-circle" title="Notifikasi">
        <i class="fa-regular fa-bell"></i>
        <span class="badge-dot"></span>
      </a>

      <!-- User Profile Pill -->
      <div class="topbar-user-pill">
        <div class="user-info-text">
          <span class="user-name"></span>
          <span class="user-role">Admin</span>
        </div>
        <i class="fa-solid fa-chevron-down user-chevron"></i>
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
  <!-- Chart.js for beautiful charts -->
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

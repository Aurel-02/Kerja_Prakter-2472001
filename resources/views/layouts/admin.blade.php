<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>@yield('title', 'Admin - TK Harapan Bunda')</title>

  <!-- Google Font: Plus Jakarta Sans & Nunito -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Font Awesome 6 & SB Admin 2 Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link href="{{ asset('sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

  <!-- SB Admin 2 Template CSS -->
  <link href="{{ asset('sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="{{ asset('adward/css/datatables/datatables.min.css') }}" />

  <!-- Portal Shared & Admin Theme Stylesheets -->
  <link rel="stylesheet" href="{{ asset('css/portal.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />

  @yield('styles')
</head>

<body id="page-top">

  <!-- Page Wrapper (SB Admin 2) -->
  <div id="wrapper">

    <!-- ================= SIDEBAR (HIJAU TEMA TK HARAPAN BUNDA) ================= -->
    <ul class="navbar-nav bg-gradient-tk sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="sidebar-brand-text mx-2">Portal Admin</div>
      </a>

      <hr class="sidebar-divider my-0">

      <!-- Menu Utama -->
      <div class="sidebar-heading mt-3">Menu Utama</div>

      <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item {{ request()->routeIs('admin.absensi*', 'admin.scan-qr*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.absensi') }}">
          <i class="fas fa-fw fa-qrcode"></i>
          <span>Catat Presensi</span>
        </a>
      </li>

      <li class="nav-item {{ request()->routeIs('admin.riwayat-presensi*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.riwayat-presensi') }}">
          <i class="fas fa-fw fa-history"></i>
          <span>Riwayat Presensi</span>
        </a>
      </li>

      <hr class="sidebar-divider">

      <!-- Data Sekolah -->
      <div class="sidebar-heading">Data Sekolah</div>

      <li class="nav-item {{ request()->routeIs('admin.sekolah*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.sekolah') }}">
          <i class="fas fa-fw fa-school"></i>
          <span>Profil Sekolah</span>
        </a>
      </li>

      <li class="nav-item {{ request()->routeIs('admin.guru') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.guru') }}">
          <i class="fas fa-fw fa-chalkboard-teacher"></i>
          <span>Struktur Sekolah</span>
        </a>
      </li>

      <li class="nav-item {{ request()->routeIs('admin.siswa') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.siswa') }}">
          <i class="fas fa-fw fa-user-graduate"></i>
          <span>Data Siswa</span>
        </a>
      </li>

      <li class="nav-item {{ request()->routeIs('admin.orang-tua') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.orang-tua') }}">
          <i class="fas fa-fw fa-users"></i>
          <span>Data Orang Tua</span>
        </a>
      </li>

      <hr class="sidebar-divider">

      <!-- Akademik -->
      <div class="sidebar-heading">Akademik</div>

      <li class="nav-item {{ request()->routeIs('admin.kalender') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.kalender') }}">
          <i class="fas fa-fw fa-calendar-alt"></i>
          <span>Kalender Akademik</span>
        </a>
      </li>

      <li class="nav-item {{ request()->routeIs('admin.kurikulum') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.kurikulum') }}">
          <i class="fas fa-fw fa-book-open"></i>
          <span>Kurikulum</span>
        </a>
      </li>

      <hr class="sidebar-divider">

      <!-- Media & Konten -->
      <div class="sidebar-heading">Media &amp; Konten</div>

      <li class="nav-item {{ request()->routeIs('admin.galeri') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.galeri') }}">
          <i class="fas fa-fw fa-images"></i>
          <span>Galeri Foto</span>
        </a>
      </li>

      <hr class="sidebar-divider">

      <!-- Sistem -->
      <div class="sidebar-heading">Sistem</div>

      <li class="nav-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.users') }}">
          <i class="fas fa-fw fa-users-cog"></i>
          <span>Kelola Pengguna</span>
        </a>
      </li>

      <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST" id="logoutFormSidebar" style="display: none;">
          @csrf
        </form>
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logoutFormSidebar').submit();">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Logout</span>
        </a>
      </li>

      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" style="color: #16a34a;">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter">1</span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header bg-tk border-0">
                  Pusat Notifikasi
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.riwayat-presensi') }}">
                  <div class="mr-3">
                    <div class="icon-circle bg-tk">
                      <i class="fas fa-clipboard-check text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">Presensi Harian</div>
                    <span class="font-weight-bold">Lihat riwayat presensi siswa hari ini</span>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="{{ route('admin.absensi') }}">Buka Catat Presensi</a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid pb-4">

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
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="position: absolute; top: 10px; right: 14px; background: none; border: none; font-size: 20px; cursor: pointer;">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; TK Harapan Bunda 2026</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- SB Admin 2 Core JavaScript -->
  <script src="{{ asset('sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('sb-admin-2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('sb-admin-2/js/sb-admin-2.min.js') }}"></script>

  <!-- DataTables JS -->
  <script src="{{ asset('adward/js/datatables/datatables.min.js') }}"></script>

  <!-- Chart.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

  @yield('scripts')
</body>

</html>

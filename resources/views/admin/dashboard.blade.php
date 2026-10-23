@extends('layouts.admin')

@section('title', 'Dashboard Admin - TK Harapan Bunda')

@section('content')

  <!-- Judul Halaman -->
  <div style="margin-bottom: 22px;">
    <h1 class="page-header-title">Dashboard Admin</h1>
    <p class="page-header-sub">Selamat datang kembali! Berikut ringkasan data dan aktivitas di TK Harapan Bunda.</p>
  </div>

  <!-- ================= BARIS 1: 3 KARTU STATISTIK (HIJAU KHAS WEB) ================= -->
  <div class="dash-grid-top">
    
    <!-- Kartu 1: Siswa -->
    <div class="stat-banner-card stat-card-green">
      <div class="stat-text-side">
        <span class="stat-label-title">Siswa</span>
        <span class="stat-value-big">42</span>
        <span class="stat-sub-text">Total Siswa Aktif</span>
      </div>
      <div class="stat-icon-wrap stat-icon-green">
        <i class="fa-solid fa-graduation-cap"></i>
      </div>
    </div>

    <!-- Kartu 2: Guru -->
    <div class="stat-banner-card stat-card-green">
      <div class="stat-text-side">
        <span class="stat-label-title">Guru</span>
        <span class="stat-value-big">3</span>
        <span class="stat-sub-text">Tenaga Pendidik</span>
      </div>
      <div class="stat-icon-wrap stat-icon-green">
        <i class="fa-solid fa-chalkboard-user"></i>
      </div>
    </div>

    <!-- Kartu 3: Orang Tua -->
    <div class="stat-banner-card stat-card-green">
      <div class="stat-text-side">
        <span class="stat-label-title">Orang Tua</span>
        <span class="stat-value-big">18</span>
        <span class="stat-sub-text">Perwakilan Wali Murid</span>
      </div>
      <div class="stat-icon-wrap stat-icon-green">
        <i class="fa-solid fa-users"></i>
      </div>
    </div>

  </div>

  <!-- ================= BARIS 2: AGENDA & DISTRIBUSI SISWA ================= -->
  <div class="dash-grid-split">
    
    <!-- Kolom Kiri: Agenda Kalender Akademik Mendatang -->
    <div class="admin-card" style="margin-bottom: 0;">
      <div class="card-header-flex">
        <div>
          <h2 class="card-title-main">Agenda Terdekat Sekolah</h2>
          <div class="card-subtitle-small">Jadwal kegiatan belajar dan peringatan hari besar</div>
        </div>
        <a href="{{ route('admin.kalender') }}" class="btn-link-action">Buka Kalender <i class="fa-solid fa-calendar-day"></i></a>
      </div>

      <div class="agenda-list">
        <div class="agenda-item">
          <div class="agenda-date-box">
            <span class="agenda-day">25</span>
            <span class="agenda-month">Okt</span>
          </div>
          <div class="agenda-info">
            <div class="agenda-title">Hari Sumpah Pemuda</div>
            <div class="agenda-desc">Libur Nasional — Seluruh KBM ditiadakan</div>
          </div>
          <span class="badge-pill badge-yellow"><i class="fa-solid fa-flag"></i> Libur</span>
        </div>

        <div class="agenda-item">
          <div class="agenda-date-box">
            <span class="agenda-day">10</span>
            <span class="agenda-month">Nov</span>
          </div>
          <div class="agenda-info">
            <div class="agenda-title">Hari Pahlawan</div>
            <div class="agenda-desc">Peringatan Hari Pahlawan di lingkungan sekolah</div>
          </div>
          <span class="badge-pill badge-yellow"><i class="fa-solid fa-flag"></i> Libur</span>
        </div>

        <div class="agenda-item">
          <div class="agenda-date-box">
            <span class="agenda-day">25</span>
            <span class="agenda-month">Nov</span>
          </div>
          <div class="agenda-info">
            <div class="agenda-title">Hari Guru Nasional</div>
            <div class="agenda-desc">Pentas kreativitas dan apresiasi murid untuk dewan guru</div>
          </div>
          <span class="badge-pill badge-green"><i class="fa-solid fa-cake-candles"></i> Kegiatan</span>
        </div>
      </div>
    </div>

    <!-- Kolom Kanan: Distribusi Siswa (Donut Chart) -->
    <div class="admin-card" style="margin-bottom: 0; display: flex; flex-direction: column; justify-content: space-between;">
      <div>
        <div class="card-header-flex">
          <div>
            <h2 class="card-title-main">Distribusi Siswa</h2>
            <div class="card-subtitle-small">Perbandingan jenis kelamin siswa aktif</div>
          </div>
          <button class="btn-more-icon" title="Opsi"><i class="fa-solid fa-ellipsis-vertical"></i></button>
        </div>

        <!-- Wadah Donut dengan label total di tengah -->
        <div style="position: relative; height: 195px; display: flex; align-items: center; justify-content: center; margin: 10px 0;">
          <canvas id="studentsDonutChart"></canvas>
          <div class="donut-center-label">
            <div class="donut-sub">Total Siswa</div>
            <div class="donut-num">42</div>
          </div>
        </div>
      </div>

      <!-- Keterangan Jenis Kelamin -->
      <div class="gender-legend-wrap">
        <span class="gender-item">
          <span class="gender-dot" style="background: #16a34a;"></span>
          <span class="gender-text">Laki-laki (24)</span>
        </span>
        <span class="gender-item">
          <span class="gender-dot" style="background: #86efac;"></span>
          <span class="gender-text">Perempuan (18)</span>
        </span>
      </div>
    </div>

  </div>

@endsection

@section('styles')
<style>
  /* ===================== SISTEM GRID ===================== */
  .dash-grid-top {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    margin-bottom: 22px;
  }

  .dash-grid-split {
    display: grid;
    grid-template-columns: 1.4fr 1fr;
    gap: 20px;
    align-items: stretch;
  }

  @media (max-width: 900px) {
    .dash-grid-top {
      grid-template-columns: repeat(2, 1fr);
    }
    .dash-grid-split {
      grid-template-columns: 1fr;
    }
  }

  @media (max-width: 580px) {
    .dash-grid-top {
      grid-template-columns: 1fr;
    }
  }

  /* ===================== KARTU STATISTIK (HIJAU KHAS WEB) ===================== */
  .stat-banner-card {
    border-radius: 16px;
    padding: 18px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    border: 1px solid #bbf7d0;
    background: linear-gradient(135deg, #f0fdf4 0%, #eaf8f0 100%);
  }

  .stat-banner-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px -4px rgba(22, 163, 74, 0.12);
    border-color: #86efac;
  }

  .stat-text-side {
    display: flex;
    flex-direction: column;
  }

  .stat-label-title {
    font-size: 13.5px;
    font-weight: 700;
    color: #15803d;
    margin-bottom: 4px;
  }

  .stat-value-big {
    font-size: 26px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.1;
    letter-spacing: -0.5px;
  }

  .stat-sub-text {
    font-size: 11px;
    color: #64748b;
    margin-top: 4px;
    font-weight: 500;
  }

  /* Ikon Bertema Hijau */
  .stat-icon-wrap {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
  }

  .stat-icon-green {
    background: #dcfce7;
    color: #16a34a;
    border: 1px solid #bbf7d0;
  }

  /* ===================== DAFTAR AGENDA ===================== */
  .agenda-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .agenda-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 14px;
    background: #f8fafc;
    border: 1px solid #f1f5f9;
    border-radius: 10px;
    transition: background 0.15s ease;
  }

  .agenda-item:hover {
    background: #f0fdf4;
    border-color: #bbf7d0;
  }

  .agenda-date-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    flex-shrink: 0;
  }

  .agenda-day {
    font-size: 15px;
    font-weight: 800;
    color: #16a34a;
    line-height: 1;
  }

  .agenda-month {
    font-size: 9.5px;
    font-weight: 700;
    text-transform: uppercase;
    color: #64748b;
  }

  .agenda-info {
    flex: 1;
    min-width: 0;
  }

  .agenda-title {
    font-size: 13px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 2px;
  }

  .agenda-desc {
    font-size: 11.5px;
    color: #64748b;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .btn-link-action {
    font-size: 12px;
    font-weight: 600;
    color: #16a34a;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: color 0.15s ease;
  }

  .btn-link-action:hover {
    color: #15803d;
    text-decoration: underline;
  }

  /* ===================== DIAGRAM DONUT ===================== */
  .donut-center-label {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    pointer-events: none;
  }

  .donut-sub {
    font-size: 11px;
    font-weight: 600;
    color: #64748b;
  }

  .donut-num {
    font-size: 24px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.1;
  }

  .gender-legend-wrap {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 22px;
    margin-top: 10px;
  }

  .gender-item {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 12px;
    font-weight: 600;
    color: #475569;
  }

  .gender-dot {
    width: 9px;
    height: 9px;
    border-radius: 50%;
  }
</style>
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // ----------------------------------------------------
    // Diagram Donut Siswa (Distribusi Jenis Kelamin)
    // ----------------------------------------------------
    const ctxDonut = document.getElementById('studentsDonutChart');
    if (ctxDonut) {
      new Chart(ctxDonut, {
        type: 'doughnut',
        data: {
          labels: ['Laki-laki', 'Perempuan'],
          datasets: [{
            data: [24, 18],
            backgroundColor: ['#16a34a', '#86efac'],
            borderWidth: 2,
            borderColor: '#ffffff',
            hoverOffset: 4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '72%',
          plugins: {
            legend: { display: false },
            tooltip: {
              backgroundColor: '#1e293b',
              padding: 10,
              cornerRadius: 8,
              callbacks: {
                label: function (context) {
                  return ' ' + context.label + ': ' + context.raw + ' Siswa';
                }
              }
            }
          }
        }
      });
    }
  });
</script>
@endsection

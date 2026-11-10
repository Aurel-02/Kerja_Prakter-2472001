@extends('layouts.guru')

@section('title', 'Dashboard Guru - TK Harapan Bunda')

@section('content')

  <!-- Judul Halaman -->
  <div style="margin-bottom: 22px;">
    <h1 class="page-header-title">Dashboard Guru</h1>
    <p class="page-header-sub">Selamat datang kembali! Berikut ringkasan data akademik dan kegiatan belajar di TK Harapan Bunda.</p>
  </div>

  <!-- ================= BARIS 1: 3 KARTU STATISTIK (HIJAU KHAS WEB) ================= -->
  <div class="dash-grid-top">
    
    <!-- Kartu 1: Siswa -->
    <div class="stat-banner-card stat-card-green">
      <div class="stat-text-side">
        <span class="stat-label-title">Siswa</span>
        <span class="stat-value-big">34</span>
        <span class="stat-sub-text">Total Siswa Aktif</span>
      </div>
    </div>

    <!-- Kartu 2: Kurikulum -->
    <div class="stat-banner-card stat-card-green">
      <div class="stat-text-side">
        <span class="stat-label-title">Kurikulum</span>
        <span class="stat-value-big">{{ $totalKurikulum > 0 ? $totalKurikulum : 6 }}</span>
        <span class="stat-sub-text">Program &amp; Tema Belajar</span>
      </div>
    </div>

    <!-- Kartu 3: Penjemputan -->
    <div class="stat-banner-card stat-card-green">
      <div class="stat-text-side">
        <span class="stat-label-title">Penjemputan Hari Ini</span>
        <span class="stat-value-big">{{ $totalPenjemputanHariIni }}</span>
        <span class="stat-sub-text">Siswa Telah Dijemput</span>
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
        <a href="{{ route('kalender') }}" target="_blank" class="btn-link-action">Buka Kalender &rarr;</a>
      </div>

      <div class="agenda-list">
        @if($kegiatanTerdekat && $kegiatanTerdekat->count() > 0)
          @foreach($kegiatanTerdekat as $kegiatan)
            <div class="agenda-item">
              <div class="agenda-date-box">
                <span class="agenda-day">{{ \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->format('d') }}</span>
                <span class="agenda-month">{{ \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->locale('id')->isoFormat('MMM') }}</span>
              </div>
              <div class="agenda-info">
                <div class="agenda-title">{{ $kegiatan->judul_kegiatan }}</div>
                <div class="agenda-desc">{{ $kegiatan->keterangan ?? 'Kegiatan pembelajaran teragendakan' }}</div>
              </div>
              <span class="badge-pill {{ str_contains(strtolower($kegiatan->kategori ?? ''), 'libur') ? 'badge-yellow' : 'badge-green' }}">
                {{ $kegiatan->kategori ?? 'Kegiatan' }}
              </span>
            </div>
          @endforeach
        @else
          <div class="agenda-item">
            <div class="agenda-date-box">
              <span class="agenda-day">25</span>
              <span class="agenda-month">Okt</span>
            </div>
            <div class="agenda-info">
              <div class="agenda-title">Hari Sumpah Pemuda</div>
              <div class="agenda-desc">Libur Nasional — Seluruh KBM ditiadakan</div>
            </div>
            <span class="badge-pill badge-yellow">Libur</span>
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
            <span class="badge-pill badge-yellow">Libur</span>
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
            <span class="badge-pill badge-green">Kegiatan</span>
          </div>
        @endif
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
        </div>

        <!-- Wadah Donut dengan label total di tengah -->
        <div style="position: relative; height: 195px; display: flex; align-items: center; justify-content: center; margin: 10px 0;">
          <canvas id="studentsDonutChart"></canvas>
          <div class="donut-center-label">
            <div class="donut-sub">Total Siswa</div>
            <div class="donut-num">{{ $totalSiswa > 0 ? $totalSiswa : 42 }}</div>
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
    letter-spacing: -0.2px;
  }

  .stat-value-big {
    font-size: 28px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.1;
    margin-bottom: 4px;
  }

  .stat-sub-text {
    font-size: 11.5px;
    font-weight: 500;
    color: #64748b;
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
    gap: 14px;
    padding: 10px 12px;
    border-radius: 10px;
    background: #f8fafc;
    border: 1px solid var(--border-color);
  }

  .agenda-date-box {
    width: 44px;
    height: 44px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .agenda-day {
    font-size: 15px;
    font-weight: 800;
    color: #16a34a;
    line-height: 1;
  }

  .agenda-month {
    font-size: 10px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
  }

  .agenda-info {
    flex: 1;
    min-width: 0;
  }

  .agenda-title {
    font-size: 13px;
    font-weight: 700;
    color: var(--text-main);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .agenda-desc {
    font-size: 11.5px;
    color: var(--text-muted);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .badge-pill {
    padding: 4px 10px;
    border-radius: 9999px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.3px;
    white-space: nowrap;
  }

  .badge-yellow {
    background: #fef3c7;
    color: #b45309;
  }

  .badge-green {
    background: #dcfce7;
    color: #15803d;
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

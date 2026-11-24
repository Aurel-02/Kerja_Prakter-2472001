@extends('layouts.guru')

@section('title', 'Dashboard Guru - TK Harapan Bunda')

@section('content')

  <!-- Judul Halaman -->
  <div style="margin-bottom: 22px;">
    <h1 class="page-header-title">Dashboard Guru</h1>
    <p class="page-header-sub">Selamat datang kembali! Berikut ringkasan data akademik dan kegiatan belajar di TK Harapan Bunda.</p>
  </div>

  <!-- ================= BARIS 1: KARTU JUMLAH SISWA ================= -->
  <div style="margin-bottom: 22px; max-width: 320px;">
    <!-- Kartu: Siswa -->
    <a href="{{ route('guru.siswa') }}" class="stat-banner-card stat-card-green" style="text-decoration: none; color: inherit; cursor: pointer;">
      <div class="stat-text-side">
        <span class="stat-label-title">Siswa</span>
        <span class="stat-value-big">{{ $totalSiswa }}</span>
        <span class="stat-sub-text">Total Siswa Aktif &rarr;</span>
      </div>
      <div class="stat-icon-wrap stat-icon-green">
        <i class="fa-solid fa-graduation-cap"></i>
      </div>
    </a>
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
            <div class="donut-num">{{ $totalSiswa }}</div>
          </div>
        </div>
      </div>

      <!-- Keterangan Jenis Kelamin -->
      <div class="gender-legend-wrap">
        <span class="gender-item">
          <span class="gender-dot" style="background: #16a34a;"></span>
          <span class="gender-text">Laki-laki ({{ $totalLakiLaki }})</span>
        </span>
        <span class="gender-item">
          <span class="gender-dot" style="background: #86efac;"></span>
          <span class="gender-text">Perempuan ({{ $totalPerempuan }})</span>
        </span>
      </div>
    </div>

  </div>

@endsection



@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // ----------------------------------------------------
    // Diagram Donut Siswa (Distribusi Jenis Kelamin)
    // ----------------------------------------------------
    const ctxDonut = document.getElementById('studentsDonutChart');
    if (ctxDonut) {
      const maleCount = {{ (int) $totalLakiLaki }};
      const femaleCount = {{ (int) $totalPerempuan }};
      const hasData = (maleCount + femaleCount) > 0;

      new Chart(ctxDonut, {
        type: 'doughnut',
        data: {
          labels: ['Laki-laki', 'Perempuan'],
          datasets: [{
            data: hasData ? [maleCount, femaleCount] : [0, 0],
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

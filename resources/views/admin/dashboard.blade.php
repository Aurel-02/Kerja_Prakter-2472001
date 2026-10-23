@extends('layouts.admin')

@section('title', 'Admin Dashboard - TK Harapan Bunda')

@section('content')

  <!-- Page Header -->
  <div style="margin-bottom: 22px;">
    <h1 class="page-header-title">Admin Dashboard</h1>
    <p class="page-header-sub">Selamat datang kembali! Berikut ringkasan data dan aktivitas di TK Harapan Bunda.</p>
  </div>

  <!-- ================= ROW 1: 4 STAT CARDS ================= -->
  <div class="dash-grid-top">
    
    <!-- Card 1: Students -->
    <div class="stat-banner-card stat-card-purple">
      <div class="stat-text-side">
        <span class="stat-label-title">Students</span>
        <span class="stat-value-big">42.00</span>
      </div>
      <div class="stat-icon-wrap stat-icon-purple">
        <i class="fa-solid fa-graduation-cap"></i>
      </div>
    </div>

    <!-- Card 2: Teachers -->
    <div class="stat-banner-card stat-card-blue">
      <div class="stat-text-side">
        <span class="stat-label-title">Teachers</span>
        <span class="stat-value-big">3.00</span>
      </div>
      <div class="stat-icon-wrap stat-icon-blue">
        <i class="fa-solid fa-chalkboard-user"></i>
      </div>
    </div>

    <!-- Card 3: Parents / Gallery -->
    <div class="stat-banner-card stat-card-orange">
      <div class="stat-text-side">
        <span class="stat-label-title">Parents</span>
        <span class="stat-value-big">18.00</span>
      </div>
      <div class="stat-icon-wrap stat-icon-orange">
        <i class="fa-solid fa-users"></i>
      </div>
    </div>

    <!-- Card 4: Earnings / Kegiatan -->
    <div class="stat-banner-card stat-card-green">
      <div class="stat-text-side">
        <span class="stat-label-title">Earnings</span>
        <span class="stat-value-big">6.00</span>
      </div>
      <div class="stat-icon-wrap stat-icon-green">
        <i class="fa-solid fa-calendar-check"></i>
      </div>
    </div>

  </div>

  <!-- ================= ROW 2: CHART & DONUT ================= -->
  <div class="dash-grid-split">
    
    <!-- Left: All Exam Result / Monthly Chart -->
    <div class="admin-card" style="margin-bottom: 0;">
      <div class="card-header-flex">
        <div>
          <h2 class="card-title-main">All Exam Result</h2>
          <div class="card-subtitle-small">Students &amp; Teacher</div>
        </div>
        <!-- Custom Legend matching the screenshot -->
        <div class="chart-legend-wrap">
          <span class="legend-badge">
            <span class="legend-dot" style="background: #16a34a;"></span> Teacher
          </span>
          <span class="legend-badge">
            <span class="legend-dot" style="background: #f59e0b;"></span> Student
          </span>
        </div>
      </div>

      <!-- Canvas Chart -->
      <div style="position: relative; height: 260px; width: 100%;">
        <canvas id="examResultChart"></canvas>
      </div>
    </div>

    <!-- Right: Students Donut Chart -->
    <div class="admin-card" style="margin-bottom: 0; display: flex; flex-direction: column; justify-content: space-between;">
      <div>
        <div class="card-header-flex">
          <h2 class="card-title-main">Students</h2>
          <button class="btn-more-icon" title="Opsi"><i class="fa-solid fa-ellipsis-vertical"></i></button>
        </div>

        <!-- Donut Container with centered total -->
        <div style="position: relative; height: 185px; display: flex; align-items: center; justify-content: center; margin: 6px 0;">
          <canvas id="studentsDonutChart"></canvas>
          <div class="donut-center-label">
            <div class="donut-sub">Total</div>
            <div class="donut-num">42</div>
          </div>
        </div>
      </div>

      <!-- Gender Legend underneath -->
      <div class="gender-legend-wrap">
        <span class="gender-item">
          <span class="gender-dot" style="background: #16a34a;"></span>
          <span class="gender-text">Male (24)</span>
        </span>
        <span class="gender-item">
          <span class="gender-dot" style="background: #f59e0b;"></span>
          <span class="gender-text">Female (18)</span>
        </span>
      </div>
    </div>

  </div>

  <!-- ================= ROW 3: STAR STUDENTS & RECENT NOTIFICATIONS ================= -->
  <div class="dash-grid-split" style="margin-top: 22px;">
    
    <!-- Left: Star Students Table -->
    <div class="admin-card" style="margin-bottom: 0;">
      <div class="card-header-flex">
        <h2 class="card-title-main">Star Students</h2>
        <button class="btn-more-icon" title="Opsi"><i class="fa-solid fa-ellipsis-vertical"></i></button>
      </div>

      <div>
        <table class="custom-table">
          <thead>
            <tr>
              <th style="width: 32px; text-align: center;">
                <input type="checkbox" class="custom-checkbox" id="checkAll">
              </th>
              <th>NAME</th>
              <th>ID</th>
              <th>MARKS</th>
              <th>PERCENT</th>
              <th>YEAR</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="text-align: center;"><input type="checkbox" class="custom-checkbox"></td>
              <td>
                <div class="student-cell">
                  <img src="https://images.unsplash.com/photo-1544717305-2782549b5136?w=100&auto=format&fit=crop&q=80" alt="Evelyn Harper" class="student-avatar">
                  <span class="student-name">Evelyn Harper</span>
                </div>
              </td>
              <td class="text-muted">PRE43178</td>
              <td>1185</td>
              <td><span class="percent-badge">98%</span></td>
              <td class="text-muted">2026</td>
            </tr>
            <tr>
              <td style="text-align: center;"><input type="checkbox" class="custom-checkbox" checked></td>
              <td>
                <div class="student-cell">
                  <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=100&auto=format&fit=crop&q=80" alt="Diana Plenty" class="student-avatar">
                  <span class="student-name">Diana Plenty</span>
                </div>
              </td>
              <td class="text-muted">PRE43174</td>
              <td>1165</td>
              <td><span class="percent-badge">91%</span></td>
              <td class="text-muted">2026</td>
            </tr>
            <tr>
              <td style="text-align: center;"><input type="checkbox" class="custom-checkbox"></td>
              <td>
                <div class="student-cell">
                  <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&auto=format&fit=crop&q=80" alt="John Millar" class="student-avatar">
                  <span class="student-name">John Millar</span>
                </div>
              </td>
              <td class="text-muted">PRE43187</td>
              <td>1175</td>
              <td><span class="percent-badge">92%</span></td>
              <td class="text-muted">2026</td>
            </tr>
            <tr>
              <td style="text-align: center;"><input type="checkbox" class="custom-checkbox"></td>
              <td>
                <div class="student-cell">
                  <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="Miles Esther" class="student-avatar">
                  <span class="student-name">Miles Esther</span>
                </div>
              </td>
              <td class="text-muted">PRE45371</td>
              <td>1180</td>
              <td><span class="percent-badge">93%</span></td>
              <td class="text-muted">2026</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Right: All Exam Results / Activity Feed -->
    <div class="admin-card" style="margin-bottom: 0; display: flex; flex-direction: column; justify-content: space-between;">
      <div>
        <div class="card-header-flex">
          <h2 class="card-title-main">All Exam Results</h2>
          <button class="btn-more-icon" title="Opsi"><i class="fa-solid fa-ellipsis-vertical"></i></button>
        </div>

        <div class="activity-feed-list">
          
          <!-- Item 1: New Teacher -->
          <div class="activity-item">
            <div class="activity-icon-box bg-box-blue">
              <i class="fa-solid fa-chalkboard-user"></i>
            </div>
            <div class="activity-content">
              <div class="activity-title-row">
                <span class="activity-title">New Teacher</span>
                <span class="activity-time">Just now</span>
              </div>
              <p class="activity-desc">Nita Yulianti, S.Pd telah aktif terdaftar...</p>
            </div>
          </div>

          <!-- Item 2: Fees Structure -->
          <div class="activity-item">
            <div class="activity-icon-box bg-box-pink">
              <i class="fa-solid fa-receipt"></i>
            </div>
            <div class="activity-content">
              <div class="activity-title-row">
                <span class="activity-title">Fees Structure</span>
                <span class="activity-time">Today</span>
              </div>
              <p class="activity-desc">Laporan administrasi SPP bulan berjalan...</p>
            </div>
          </div>

          <!-- Item 3: New Course -->
          <div class="activity-item">
            <div class="activity-icon-box bg-box-teal">
              <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <div class="activity-content">
              <div class="activity-title-row">
                <span class="activity-title">New Course</span>
                <span class="activity-time">24 Sep 2026</span>
              </div>
              <p class="activity-desc">Modul tematik kurikulum pengenalan alam...</p>
            </div>
          </div>

        </div>
      </div>

      <!-- View All Button -->
      <a href="{{ route('admin.kalender') }}" class="btn-view-all">
        View All
      </a>
    </div>

  </div>

@endsection

@section('styles')
<style>
  /* ===================== GRID SYSTEM ===================== */
  .dash-grid-top {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
    margin-bottom: 22px;
  }

  .dash-grid-split {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
    align-items: stretch;
  }

  @media (max-width: 768px) {
    .dash-grid-top {
      grid-template-columns: repeat(2, 1fr);
    }
    .dash-grid-split {
      grid-template-columns: 1fr;
    }
  }

  @media (max-width: 540px) {
    .dash-grid-top {
      grid-template-columns: 1fr;
    }
  }

  /* ===================== STAT BANNER CARDS ===================== */
  .stat-banner-card {
    border-radius: 16px;
    padding: 18px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: transform 0.15s ease, box-shadow 0.15s ease;
    border: 1px solid transparent;
  }

  .stat-banner-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
  }

  /* Pastel Card Variations matching mockup */
  .stat-card-purple {
    background: #f4eefd;
    border-color: #ebdffb;
  }
  .stat-card-blue {
    background: #e6f6fd;
    border-color: #d1effb;
  }
  .stat-card-orange {
    background: #fdf0e6;
    border-color: #fce2d0;
  }
  .stat-card-green {
    background: #eaf8f0;
    border-color: #d3f3e1;
  }

  .stat-text-side {
    display: flex;
    flex-direction: column;
  }

  .stat-label-title {
    font-size: 13px;
    font-weight: 500;
    color: #475569;
    margin-bottom: 6px;
  }

  .stat-value-big {
    font-size: 24px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1;
    letter-spacing: -0.5px;
  }

  /* Icons */
  .stat-icon-wrap {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
  }

  .stat-icon-purple {
    background: rgba(168, 85, 247, 0.15);
    color: #9333ea;
  }
  .stat-icon-blue {
    background: rgba(14, 165, 233, 0.15);
    color: #0284c7;
  }
  .stat-icon-orange {
    background: rgba(249, 115, 22, 0.15);
    color: #ea580c;
  }
  .stat-icon-green {
    background: rgba(22, 163, 74, 0.15);
    color: #16a34a;
  }

  /* ===================== CHART SECTION ===================== */
  .chart-legend-wrap {
    display: flex;
    align-items: center;
    gap: 16px;
  }

  .legend-badge {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 11.5px;
    font-weight: 600;
    color: #64748b;
  }

  .legend-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
  }

  /* Donut Center Overlay */
  .donut-center-label {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    pointer-events: none;
  }

  .donut-sub {
    font-size: 11.5px;
    font-weight: 500;
    color: #64748b;
  }

  .donut-num {
    font-size: 20px;
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

  /* ===================== TABLE ===================== */
  .custom-checkbox {
    width: 15px;
    height: 15px;
    accent-color: #16a34a;
    cursor: pointer;
    vertical-align: middle;
  }

  .student-cell {
    display: flex;
    align-items: center;
    gap: 9px;
  }

  .student-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    object-fit: cover;
  }

  .student-name {
    font-weight: 600;
    color: #1e293b;
    font-size: 12.5px;
  }

  .percent-badge {
    font-weight: 600;
    color: #16a34a;
    background: #eaf8f0;
    padding: 2px 7px;
    border-radius: 6px;
    font-size: 11px;
  }

  /* ===================== ACTIVITY FEED ===================== */
  .activity-feed-list {
    display: flex;
    flex-direction: column;
    gap: 13px;
    margin-bottom: 16px;
  }

  .activity-item {
    display: flex;
    align-items: flex-start;
    gap: 11px;
  }

  .activity-icon-box {
    width: 36px;
    height: 36px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    flex-shrink: 0;
  }

  .bg-box-blue {
    background: #e0f2fe;
    color: #0284c7;
  }
  .bg-box-pink {
    background: #ffe4e6;
    color: #e11d48;
  }
  .bg-box-teal {
    background: #ccfbf1;
    color: #0d9488;
  }

  .activity-content {
    flex: 1;
    min-width: 0;
  }

  .activity-title-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 2px;
  }

  .activity-title {
    font-size: 12.5px;
    font-weight: 700;
    color: #1e293b;
  }

  .activity-time {
    font-size: 11px;
    color: #94a3b8;
    white-space: nowrap;
  }

  .activity-desc {
    font-size: 11px;
    color: #64748b;
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .btn-view-all {
    display: block;
    width: 100%;
    text-align: center;
    background: #f8fafc;
    color: #64748b;
    padding: 9px 14px;
    border-radius: 9px;
    font-size: 12.5px;
    font-weight: 600;
    text-decoration: none;
    border: 1px solid #e2e8f0;
    transition: all 0.15s ease;
  }

  .btn-view-all:hover {
    background: #eaf8f0;
    color: #16a34a;
    border-color: #bbf7d0;
    text-decoration: none;
  }
</style>
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // ----------------------------------------------------
    // 1. All Exam Result (Grouped Bar Chart)
    // ----------------------------------------------------
    const ctxBar = document.getElementById('examResultChart');
    if (ctxBar) {
      new Chart(ctxBar, {
        type: 'bar',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          datasets: [
            {
              label: 'Teacher',
              data: [65, 80, 75, 85, 120, 55, 78, 48, 82, 115, 72, 68],
              backgroundColor: '#16a34a',
              borderRadius: 3,
              barThickness: 6,
              categoryPercentage: 0.7
            },
            {
              label: 'Student',
              data: [50, 60, 65, 70, 95, 62, 60, 56, 68, 70, 50, 55],
              backgroundColor: '#f59e0b',
              borderRadius: 3,
              barThickness: 6,
              categoryPercentage: 0.7
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false
            },
            tooltip: {
              backgroundColor: '#1e293b',
              titleFont: { family: 'Plus Jakarta Sans', size: 12 },
              bodyFont: { family: 'Plus Jakarta Sans', size: 12 },
              padding: 10,
              cornerRadius: 8
            }
          },
          scales: {
            x: {
              grid: { display: false },
              ticks: {
                color: '#94a3b8',
                font: { family: 'Plus Jakarta Sans', size: 10.5 }
              }
            },
            y: {
              border: { dash: [4, 4] },
              grid: {
                color: '#f1f5f9'
              },
              ticks: {
                color: '#94a3b8',
                font: { family: 'Plus Jakarta Sans', size: 10.5 },
                callback: function (val) {
                  return val === 0 ? '0' : val + 'k';
                }
              }
            }
          }
        }
      });
    }

    // ----------------------------------------------------
    // 2. Students Donut Chart
    // ----------------------------------------------------
    const ctxDonut = document.getElementById('studentsDonutChart');
    if (ctxDonut) {
      new Chart(ctxDonut, {
        type: 'doughnut',
        data: {
          labels: ['Male', 'Female'],
          datasets: [{
            data: [24, 18],
            backgroundColor: ['#16a34a', '#f59e0b'],
            borderWidth: 0,
            hoverOffset: 4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '74%',
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

    // Checkbox toggle all
    const checkAll = document.getElementById('checkAll');
    if (checkAll) {
      checkAll.addEventListener('change', function () {
        document.querySelectorAll('tbody .custom-checkbox').forEach(cb => {
          cb.checked = checkAll.checked;
        });
      });
    }
  });
</script>
@endsection

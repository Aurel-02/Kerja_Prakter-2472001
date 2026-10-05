@extends('layouts.adward')

@section('title', 'TK Harapan Bunda - Kalender Kegiatan')

@section('top_container')
  @include('adward.partials.navbar')
@endsection

@section('content')

  <!-- Section Kalender Akademik TK -->
  <section class="kalender_section layout_padding">
    <div class="container">

      <!-- Judul Halaman -->
      <h2 class="main-heading">
        Kalender Kegiatan Sekolah
      </h2>
      <p class="text-center mb-5">
        Jadwal kegiatan belajar dan agenda seru anak-anak TK Harapan Bunda Tahun Ajaran 2025/2026.
      </p>

      <!-- Semester 1 (Ganjil) -->
      <div class="kalender-semester-header semester-1-header">
        <i class="fa fa-sun-o mr-2"></i> Semester 1 &mdash; Juli s/d Desember
      </div>

      <div class="kalender-cards-grid mb-5">

        <!-- Juli -->
        <div class="kalender-card">
          <div class="kalender-card-header kal-juli">
            <div class="month-badge">
              <i class="fa fa-smile-o"></i>
            </div>
            <h4 class="month-name">Juli</h4>
          </div>
          <div class="kalender-card-body">
            <span class="kalender-activity-tag">
              <i class="fa fa-star mr-1"></i> MPLS Siswa Baru
            </span>
            <p class="kalender-activity-desc">Masa Pengenalan Lingkungan Sekolah agar anak-anak ceria dan nyaman bersekolah.</p>
          </div>
        </div>

        <!-- Agustus -->
        <div class="kalender-card">
          <div class="kalender-card-header kal-agustus">
            <div class="month-badge">
              <i class="fa fa-flag"></i>
            </div>
            <h4 class="month-name">Agustus</h4>
          </div>
          <div class="kalender-card-body">
            <span class="kalender-activity-tag">
              <i class="fa fa-trophy mr-1"></i> Lomba Agustusan
            </span>
            <p class="kalender-activity-desc">Lomba ketangkasan seru dan gembira menyambut HUT Kemerdekaan RI.</p>
          </div>
        </div>

        <!-- September -->
        <div class="kalender-card">
          <div class="kalender-card-header kal-september">
            <div class="month-badge">
              <i class="fa fa-heart"></i>
            </div>
            <h4 class="month-name">September</h4>
          </div>
          <div class="kalender-card-body">
            <span class="kalender-activity-tag">
              <i class="fa fa-users mr-1"></i> Parenting Class
            </span>
            <p class="kalender-activity-desc">Pertemuan konsultasi & kerja sama orang tua dan guru dalam mendampingi anak.</p>
          </div>
        </div>

        <!-- Oktober -->
        <div class="kalender-card">
          <div class="kalender-card-header kal-oktober">
            <div class="month-badge">
              <i class="fa fa-moon-o"></i>
            </div>
            <h4 class="month-name">Oktober</h4>
          </div>
          <div class="kalender-card-body">
            <span class="kalender-activity-tag">
              <i class="fa fa-book mr-1"></i> Manasik Haji Kecil
            </span>
            <p class="kalender-activity-desc">Praktik peragaan ibadah haji anak untuk mengenalkan nilai agama sejak dini.</p>
          </div>
        </div>

        <!-- November -->
        <div class="kalender-card">
          <div class="kalender-card-header kal-november">
            <div class="month-badge">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <h4 class="month-name">November</h4>
          </div>
          <div class="kalender-card-body">
            <span class="kalender-activity-tag">
              <i class="fa fa-briefcase mr-1"></i> Market Day & Profesi
            </span>
            <p class="kalender-activity-desc">Bazaar cilik dan memperagakan kostum cita-cita anak dengan penuh percaya diri.</p>
          </div>
        </div>

        <!-- Desember -->
        <div class="kalender-card">
          <div class="kalender-card-header kal-desember">
            <div class="month-badge">
              <i class="fa fa-music"></i>
            </div>
            <h4 class="month-name">Desember</h4>
          </div>
          <div class="kalender-card-body">
            <span class="kalender-activity-tag">
              <i class="fa fa-graduation-cap mr-1"></i> Pentas Seni & Rapot
            </span>
            <p class="kalender-activity-desc">Panggung apresiasi bakat anak-anak dan penerimaan laporan perkembangan belajar.</p>
          </div>
        </div>

      </div>

      <!-- Semester 2 (Genap) -->
      <div class="kalender-semester-header semester-2-header">
        <i class="fa fa-leaf mr-2"></i> Semester 2 &mdash; Januari s/d Juni
      </div>

      <div class="kalender-cards-grid mb-4">

        <!-- Januari -->
        <div class="kalender-card">
          <div class="kalender-card-header kal-januari">
            <div class="month-badge">
              <i class="fa fa-television"></i>
            </div>
            <h4 class="month-name">Januari</h4>
          </div>
          <div class="kalender-card-body">
            <span class="kalender-activity-tag">
              <i class="fa fa-camera mr-1"></i> Pentas Seni TVRI
            </span>
            <p class="kalender-activity-desc">Kunjungan dan penampilan kreatif anak-anak yang diliput oleh media televisi TVRI.</p>
          </div>
        </div>

        <!-- Februari -->
        <div class="kalender-card">
          <div class="kalender-card-header kal-februari">
            <div class="month-badge">
              <i class="fa fa-user-md"></i>
            </div>
            <h4 class="month-name">Februari</h4>
          </div>
          <div class="kalender-card-body">
            <span class="kalender-activity-tag">
              <i class="fa fa-medkit mr-1"></i> Cek Kesehatan Anak
            </span>
            <p class="kalender-activity-desc">Pemeriksaan fisik, mata, gigi, dan tumbuh kembang anak oleh tenaga medis Puskesmas.</p>
          </div>
        </div>

        <!-- Maret -->
        <div class="kalender-card">
          <div class="kalender-card-header kal-maret">
            <div class="month-badge">
              <i class="fa fa-cutlery"></i>
            </div>
            <h4 class="month-name">Maret</h4>
          </div>
          <div class="kalender-card-body">
            <span class="kalender-activity-tag">
              <i class="fa fa-smile-o mr-1"></i> Cooking Class
            </span>
            <p class="kalender-activity-desc">Belajar membuat camilan sehat sederhana untuk melatih kemandirian dan motorik halus.</p>
          </div>
        </div>

        <!-- April -->
        <div class="kalender-card">
          <div class="kalender-card-header kal-april">
            <div class="month-badge">
              <i class="fa fa-female"></i>
            </div>
            <h4 class="month-name">April</h4>
          </div>
          <div class="kalender-card-body">
            <span class="kalender-activity-tag">
              <i class="fa fa-paint-brush mr-1"></i> Peringatan Hari Kartini
            </span>
            <p class="kalender-activity-desc">Pawai pakaian adat Nusantara untuk menumbuhkan rasa cinta budaya Indonesia.</p>
          </div>
        </div>

        <!-- Mei -->
        <div class="kalender-card">
          <div class="kalender-card-header kal-mei">
            <div class="month-badge">
              <i class="fa fa-building-o"></i>
            </div>
            <h4 class="month-name">Mei</h4>
          </div>
          <div class="kalender-card-body">
            <span class="kalender-activity-tag">
              <i class="fa fa-bus mr-1"></i> Kunjungan Edukasi
            </span>
            <p class="kalender-activity-desc">Outing class dan belajar langsung mengenal tugas profesi di luar ruangan kelas.</p>
          </div>
        </div>

        <!-- Juni -->
        <div class="kalender-card">
          <div class="kalender-card-header kal-juni">
            <div class="month-badge">
              <i class="fa fa-graduation-cap"></i>
            </div>
            <h4 class="month-name">Juni</h4>
          </div>
          <div class="kalender-card-body">
            <span class="kalender-activity-tag">
              <i class="fa fa-certificate mr-1"></i> Wisuda & Rapot Sem 2
            </span>
            <p class="kalender-activity-desc">Pelepasan siswa kelompok B dan penerimaan rapot kelulusan tahun ajaran.</p>
          </div>
        </div>

      </div>

      <!-- Tombol Hubungi Kami -->
      <div class="d-flex justify-content-center mt-5">
        <a href="{{ route('contact') }}" class="call_to-btn">
          <span>Hubungi Kami</span>
          <img src="{{ asset('adward/images/right-arrow.png') }}" alt="Panah">
        </a>
      </div>

    </div>
  </section>

@endsection

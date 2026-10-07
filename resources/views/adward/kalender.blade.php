@extends('layouts.adward')

@section('title', 'TK Harapan Bunda - Kalender Akademik')

@section('top_container')
  @include('adward.partials.navbar')
@endsection

@section('content')

  <section class="kalender_section layout_padding">
    <div class="container">

      <h2 class="main-heading">Kalender Akademik</h2>
      <p class="text-center mb-5">
        Jadwal kegiatan TK Harapan Bunda Tahun Ajaran 2025/2026.
      </p>

      <div class="kal-year-grid">

        {{-- Juli --}}
        <div class="kal-month-box">
          <div class="kal-box-top">
            <span class="kal-box-num">07</span>
            <span class="kal-box-name">Juli</span>
            <span class="kal-box-year">2025</span>
          </div>
          <div class="kal-box-content">
            <i class="fa fa-star kal-icon"></i>
            <strong>MPLS Siswa Baru</strong>
            <p>Masa Pengenalan Lingkungan Sekolah bagi siswa baru.</p>
          </div>
        </div>

        {{-- Agustus --}}
        <div class="kal-month-box">
          <div class="kal-box-top">
            <span class="kal-box-num">08</span>
            <span class="kal-box-name">Agustus</span>
            <span class="kal-box-year">2025</span>
          </div>
          <div class="kal-box-content">
            <i class="fa fa-trophy kal-icon"></i>
            <strong>Lomba Agustusan</strong>
            <p>Lomba seru menyambut HUT Kemerdekaan RI.</p>
          </div>
        </div>

        {{-- September --}}
        <div class="kal-month-box">
          <div class="kal-box-top">
            <span class="kal-box-num">09</span>
            <span class="kal-box-name">September</span>
            <span class="kal-box-year">2025</span>
          </div>
          <div class="kal-box-content">
            <i class="fa fa-users kal-icon"></i>
            <strong>Parenting Class</strong>
            <p>Pertemuan kerja sama orang tua dan guru.</p>
          </div>
        </div>

        {{-- Oktober --}}
        <div class="kal-month-box">
          <div class="kal-box-top">
            <span class="kal-box-num">10</span>
            <span class="kal-box-name">Oktober</span>
            <span class="kal-box-year">2025</span>
          </div>
          <div class="kal-box-content">
            <i class="fa fa-book kal-icon"></i>
            <strong>Manasik Haji Kecil</strong>
            <p>Peragaan ibadah haji untuk mengenalkan nilai agama.</p>
          </div>
        </div>

        {{-- November --}}
        <div class="kal-month-box">
          <div class="kal-box-top">
            <span class="kal-box-num">11</span>
            <span class="kal-box-name">November</span>
            <span class="kal-box-year">2025</span>
          </div>
          <div class="kal-box-content">
            <i class="fa fa-briefcase kal-icon"></i>
            <strong>Market Day &amp; Profesi</strong>
            <p>Bazaar cilik dan peragaan kostum cita-cita anak.</p>
          </div>
        </div>

        {{-- Desember --}}
        <div class="kal-month-box">
          <div class="kal-box-top">
            <span class="kal-box-num">12</span>
            <span class="kal-box-name">Desember</span>
            <span class="kal-box-year">2025</span>
          </div>
          <div class="kal-box-content">
            <i class="fa fa-music kal-icon"></i>
            <strong>Pentas Seni &amp; Rapot</strong>
            <p>Panggung bakat anak dan penerimaan rapot semester 1.</p>
          </div>
        </div>

        {{-- Januari --}}
        <div class="kal-month-box">
          <div class="kal-box-top">
            <span class="kal-box-num">01</span>
            <span class="kal-box-name">Januari</span>
            <span class="kal-box-year">2026</span>
          </div>
          <div class="kal-box-content">
            <i class="fa fa-television kal-icon"></i>
            <strong>Pentas Seni TVRI</strong>
            <p>Penampilan kreatif anak yang diliput oleh TVRI.</p>
          </div>
        </div>

        {{-- Februari --}}
        <div class="kal-month-box">
          <div class="kal-box-top">
            <span class="kal-box-num">02</span>
            <span class="kal-box-name">Februari</span>
            <span class="kal-box-year">2026</span>
          </div>
          <div class="kal-box-content">
            <i class="fa fa-user-md kal-icon"></i>
            <strong>Cek Kesehatan Anak</strong>
            <p>Pemeriksaan kesehatan oleh tenaga medis Puskesmas.</p>
          </div>
        </div>

        {{-- Maret --}}
        <div class="kal-month-box">
          <div class="kal-box-top">
            <span class="kal-box-num">03</span>
            <span class="kal-box-name">Maret</span>
            <span class="kal-box-year">2026</span>
          </div>
          <div class="kal-box-content">
            <i class="fa fa-cutlery kal-icon"></i>
            <strong>Cooking Class</strong>
            <p>Belajar membuat camilan sehat untuk melatih kemandirian.</p>
          </div>
        </div>

        {{-- April --}}
        <div class="kal-month-box">
          <div class="kal-box-top">
            <span class="kal-box-num">04</span>
            <span class="kal-box-name">April</span>
            <span class="kal-box-year">2026</span>
          </div>
          <div class="kal-box-content">
            <i class="fa fa-female kal-icon"></i>
            <strong>Peringatan Hari Kartini</strong>
            <p>Pawai pakaian adat Nusantara.</p>
          </div>
        </div>

        {{-- Mei --}}
        <div class="kal-month-box">
          <div class="kal-box-top">
            <span class="kal-box-num">05</span>
            <span class="kal-box-name">Mei</span>
            <span class="kal-box-year">2026</span>
          </div>
          <div class="kal-box-content">
            <i class="fa fa-bus kal-icon"></i>
            <strong>Kunjungan Edukasi</strong>
            <p>Outing class belajar mengenal profesi di luar kelas.</p>
          </div>
        </div>

        {{-- Juni --}}
        <div class="kal-month-box">
          <div class="kal-box-top">
            <span class="kal-box-num">06</span>
            <span class="kal-box-name">Juni</span>
            <span class="kal-box-year">2026</span>
          </div>
          <div class="kal-box-content">
            <i class="fa fa-graduation-cap kal-icon"></i>
            <strong>Wisuda &amp; Rapot Sem 2</strong>
            <p>Pelepasan siswa kelompok B dan penerimaan rapot.</p>
          </div>
        </div>

      </div>{{-- end year grid --}}

      {{-- CTA --}}
      <div class="d-flex justify-content-center mt-5">
        <a href="{{ route('contact') }}" class="call_to-btn">
          <span>Hubungi Kami</span>
          <img src="{{ asset('adward/images/right-arrow.png') }}" alt="Panah">
        </a>
      </div>

    </div>
  </section>

@endsection

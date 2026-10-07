@extends('layouts.adward')

@section('title', 'TK Harapan Bunda - Fasilitas Sekolah')

@section('top_container')
  @include('adward.partials.navbar')
@endsection

@section('content')

  <!-- fasilitas section -->
  <section class="fasilitas_section layout_padding">
    <div class="container">
      <h2 class="main-heading">
        Fasilitas Sekolah
      </h2>
      <p class="text-center mb-4">
        Berbagai fasilitas lengkap untuk mendukung tumbuh kembang dan kenyamanan belajar anak.
      </p>
      <div class="fasilitas-grid">
        <div class="fasilitas-item">
          <img src="" alt="Ruang Kelas" class="img-fluid fasilitas-img-placeholder">
          <div class="fasilitas-overlay"><span>Ruang Kelas</span></div>
        </div>
        <div class="fasilitas-item">
          <img src="" alt="Area Bermain" class="img-fluid fasilitas-img-placeholder">
          <div class="fasilitas-overlay"><span>Area Bermain</span></div>
        </div>
        <div class="fasilitas-item">
          <img src="" alt="Halaman Sekolah" class="img-fluid fasilitas-img-placeholder">
          <div class="fasilitas-overlay"><span>Halaman Sekolah</span></div>
        </div>
        <div class="fasilitas-item">
          <img src="" alt="Ruang Seni" class="img-fluid fasilitas-img-placeholder">
          <div class="fasilitas-overlay"><span>Ruang Seni</span></div>
        </div>
        <div class="fasilitas-item">
          <img src="" alt="Perpustakaan" class="img-fluid fasilitas-img-placeholder">
          <div class="fasilitas-overlay"><span>Perpustakaan</span></div>
        </div>
        <div class="fasilitas-item">
          <img src="" alt="Aula Sekolah" class="img-fluid fasilitas-img-placeholder">
          <div class="fasilitas-overlay"><span>Aula Sekolah</span></div>
        </div>
      </div>
    </div>
  </section>

@endsection

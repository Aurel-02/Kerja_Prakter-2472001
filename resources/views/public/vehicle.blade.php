@extends('layouts.public')

@section('title', 'TK Harapan Bunda - Fasilitas Sekolah')

@section('top_container')
  @include('public.navbar.navbar')
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
          <img src="{{ asset('adward/images/ruang kepala sekolah.jpeg') }}" alt="Ruang Kelas" class="img-fluid fasilitas-img-placeholder">
          <div class="fasilitas-overlay"><span>Ruang Kelas</span></div>
        </div>
        <div class="fasilitas-item">
          <img src="{{ asset('adward/images/area bermain - 1.jpeg') }}" alt="Area Bermain" class="img-fluid fasilitas-img-placeholder">
          <div class="fasilitas-overlay"><span>Area Bermain</span></div>
        </div>
        <div class="fasilitas-item">
          <img src="{{ asset('adward/images/area bermain - 3.jpeg') }}" alt="Halaman Sekolah" class="img-fluid fasilitas-img-placeholder">
          <div class="fasilitas-overlay"><span>Halaman Sekolah</span></div>
        </div>
        <div class="fasilitas-item">
          <img src="{{ asset('adward/images/media pembelajaran.jpeg') }}" alt="Ruang Seni" class="img-fluid fasilitas-img-placeholder">
          <div class="fasilitas-overlay"><span>Ruang Seni</span></div>
        </div>
        <div class="fasilitas-item">
          <img src="{{ asset('adward/images/loker murid.jpeg') }}" alt="Perpustakaan" class="img-fluid fasilitas-img-placeholder">
          <div class="fasilitas-overlay"><span>Loker Murid</span></div>
        </div>
        <div class="fasilitas-item">
          <img src="{{ asset('adward/images/area bermain -2.jpeg') }}" alt="Aula Sekolah" class="img-fluid fasilitas-img-placeholder">
          <div class="fasilitas-overlay"><span>Area Bermain</span></div>
        </div>
      </div>
    </div>
  </section>

@endsection

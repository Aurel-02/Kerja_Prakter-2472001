@extends('layouts.public')

@section('title', 'TK Harapan Bunda - Struktur')

@section('top_container')
  @include('public.navbar.navbar')
@endsection

@section('content')

  <!-- teacher section -->
  <section class="teacher_section layout_padding">
    <div class="container">
      <h2 class="main-heading">
        Struktur Sekolah TK Harapan Bunda
      </h2>
      <p class="text-center">
        Guru-guru berpengalaman dan penuh kasih sayang yang siap membimbing anak-anak.
      </p>

      {{-- Kepala Sekolah --}}
      <div class="teacher_container layout_padding2">
        <h4 class="text-center mb-3" style="color: #555; font-weight: 600; letter-spacing: 1px;">Kepala Sekolah</h4>
        <div class="d-flex justify-content-center">
          <div class="card teacher-card teacher-card-single">
            <img class="card-img-top teacher-img-placeholder" src="{{ asset('adward/images/kepala sekolah.jpeg') }}" alt="Foto Kepala Sekolah" style="object-position: top;">
            <div class="card-body text-center">
              <h5 class="card-title mb-1">Neneng Nurmayanti, S.Pd</h5>
            </div>
          </div>
        </div>
      </div>

      {{-- Guru Kelas --}}
      <div class="teacher_container mt-4">
        <h4 class="text-center mb-3" style="color: #555; font-weight: 600; letter-spacing: 1px;">Guru Kelas</h4>
        <div class="teacher-card-grid">
          <div class="card teacher-card">
            <img class="card-img-top teacher-img-placeholder" src="{{ asset('adward/images/guru-1.jpeg') }}" alt="Foto Guru Kelas" style="object-position: top;">
            <div class="card-body text-center">
              <h5 class="card-title mb-1">Nita Yulianti</h5>
            </div>
          </div>
          <div class="card teacher-card">
            <img class="card-img-top teacher-img-placeholder" src="{{ asset('adward/images/guru-2.jpeg') }}" alt="Foto Guru Kelas" style="object-position: top;">
            <div class="card-body text-center">
              <h5 class="card-title mb-1">Nia Herlina</h5>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  <!-- teacher section -->

@endsection

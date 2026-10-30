@extends('layouts.public')

@section('title', 'TK Harapan Bunda - Struktur')

@section('top_container')
  @include('public.navbar.navbar')
@endsection

@section('content')

  <!-- teacher section -->
  <section class="teacher_section layout_padding">
    <div class="container">
      <div class="d-flex justify-content-center align-items-center mb-2">
        <h2 class="main-heading mb-0">
          Struktur Sekolah TK Harapan Bunda
        </h2>
        <a href="{{ route('admin.guru') }}" class="btn btn-sm btn-outline-success ml-3" style="border-radius: 20px; font-size: 12px; font-weight: 600;" title="Kelola Guru di Admin">
          <i class="fa fa-pencil"></i> Kelola Guru
        </a>
      </div>
      <p class="text-center">
        Guru-guru berpengalaman dan penuh kasih sayang yang siap membimbing anak-anak.
      </p>

      {{-- Kepala Sekolah --}}
      @if($kepalaSekolah)
      <div class="teacher_container layout_padding2">
        <h4 class="text-center mb-3" style="color: #555; font-weight: 600; letter-spacing: 1px;">{{ $kepalaSekolah->jabatan }}</h4>
        <div class="d-flex justify-content-center">
          <div class="card teacher-card teacher-card-single">
            <img class="card-img-top teacher-img-placeholder" src="{{ asset($kepalaSekolah->foto ?? 'adward/images/kepala sekolah.jpeg') }}" alt="Foto {{ $kepalaSekolah->nama }}" style="object-position: top;">
            <div class="card-body text-center">
              <h5 class="card-title mb-1">{{ $kepalaSekolah->nama }}</h5>
              @if($kepalaSekolah->pendidikan)
                <small class="text-muted">{{ $kepalaSekolah->pendidikan }}</small>
              @endif
            </div>
          </div>
        </div>
      </div>
      @endif

      {{-- Guru Kelas & Staf --}}
      @if($guruList && $guruList->count() > 0)
      <div class="teacher_container mt-4">
        <h4 class="text-center mb-3" style="color: #555; font-weight: 600; letter-spacing: 1px;">Dewan Guru &amp; Tenaga Pendidik</h4>
        <div class="teacher-card-grid">
          @foreach($guruList as $guru)
          <div class="card teacher-card">
            <img class="card-img-top teacher-img-placeholder" src="{{ asset($guru->foto ?? 'adward/images/guru-1.jpeg') }}" alt="Foto {{ $guru->nama }}" style="object-position: top;">
            <div class="card-body text-center">
              <h5 class="card-title mb-1">{{ $guru->nama }}</h5>
              <small class="text-muted d-block">{{ $guru->jabatan }}</small>
              @if($guru->pendidikan)
                <small class="text-muted">{{ $guru->pendidikan }}</small>
              @endif
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @endif

    </div>
  </section>
  <!-- teacher section -->

@endsection

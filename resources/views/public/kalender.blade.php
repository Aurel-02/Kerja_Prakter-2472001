@extends('layouts.public')

@section('title', 'TK Harapan Bunda - Kalender Akademik')

@section('top_container')
  @include('public.navbar.navbar')
@endsection

@section('content')

  <section class="kalender_section layout_padding">
    <div class="container">

      <div class="d-flex justify-content-center align-items-center mb-2">
        <h2 class="main-heading mb-0">Kalender Akademik</h2>
        <a href="{{ route('admin.kalender') }}" class="btn btn-sm btn-outline-success ml-3" style="border-radius: 20px; font-size: 12px; font-weight: 600;" title="Kelola Kalender di Admin">
          <i class="fa fa-pencil"></i> Kelola Agenda
        </a>
      </div>
      <p class="text-center mb-5">
        Jadwal kegiatan belajar dan agenda tahunan TK Harapan Bunda.
      </p>

      {{-- Semester 1 (Ganjil) --}}
      <div class="semester-section mb-5">
        <div class="semester-badge-title mb-4">
          <span class="semester-badge">
            <i class="fa fa-calendar-check-o mr-2"></i> Semester 1 (Ganjil)
          </span>
        </div>
        <div class="kal-year-grid">
          @forelse($kalenderSem1 as $item)
          <div class="kal-month-box">
            <div class="kal-box-top">
              <span class="kal-box-name">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('F') }}</span>
            </div>
            <div class="kal-box-content">
              <i class="fa {{ $item->icon ?? 'fa-calendar-check-o' }} kal-icon"></i>
              <strong>{{ $item->judul_kegiatan }}</strong>
              <p>{{ $item->keterangan ?? '-' }}</p>
            </div>
          </div>
          @empty
          <div class="col-12 text-center text-muted py-3">Belum ada agenda terdaftar untuk Semester 1.</div>
          @endforelse
        </div>
      </div>

      {{-- Semester 2 (Genap) --}}
      <div class="semester-section mb-5">
        <div class="semester-badge-title mb-4">
          <span class="semester-badge">
            <i class="fa fa-calendar-check-o mr-2"></i> Semester 2 (Genap)
          </span>
        </div>
        <div class="kal-year-grid">
          @forelse($kalenderSem2 as $item)
          <div class="kal-month-box">
            <div class="kal-box-top">
              <span class="kal-box-name">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('F') }}</span>
            </div>
            <div class="kal-box-content">
              <i class="fa {{ $item->icon ?? 'fa-calendar-check-o' }} kal-icon"></i>
              <strong>{{ $item->judul_kegiatan }}</strong>
              <p>{{ $item->keterangan ?? '-' }}</p>
            </div>
          </div>
          @empty
          <div class="col-12 text-center text-muted py-3">Belum ada agenda terdaftar untuk Semester 2.</div>
          @endforelse
        </div>
      </div>

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

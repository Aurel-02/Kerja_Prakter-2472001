@extends('layouts.public')

@section('title', 'TK Harapan Bunda - Fasilitas Sekolah')

@section('top_container')
  @include('public.navbar.navbar')
@endsection

@section('content')

  <!-- fasilitas section -->
  <section class="fasilitas_section layout_padding">
    <div class="container">
      <div class="d-flex justify-content-center align-items-center mb-2">
        <h2 class="main-heading mb-0">
          Fasilitas Sekolah
        </h2>
        <a href="{{ route('admin.galeri') }}" class="btn btn-sm btn-outline-success ml-3" style="border-radius: 20px; font-size: 12px; font-weight: 600;" title="Kelola Fasilitas di Admin">
          <i class="fa fa-pencil"></i> Kelola Fasilitas
        </a>
      </div>
      <p class="text-center mb-4">
        Berbagai fasilitas lengkap untuk mendukung tumbuh kembang dan kenyamanan belajar anak.
      </p>
      <div class="fasilitas-grid">
        @forelse($fasilitas as $item)
        <div class="fasilitas-item">
          <img src="{{ asset($item->link_foto) }}" alt="{{ $item->judul }}" class="img-fluid fasilitas-img-placeholder">
          <div class="fasilitas-overlay"><span>{{ $item->judul }}</span></div>
        </div>
        @empty
        <div class="col-12 text-center text-muted py-4">Belum ada foto fasilitas terpasang.</div>
        @endforelse
      </div>
    </div>
  </section>

@endsection

@extends('layouts.public')

@section('title', 'TK Harapan Bunda - Tentang Kami')

@section('top_container')
  @include('public.navbar.navbar')
@endsection

@section('content')

  <!-- 1. Profil Singkat TK Harapan Bunda -->
  <section class="about_section layout_padding bg-white">
    <div class="container">
      <div class="d-flex justify-content-center align-items-center mb-4">
        <h2 class="main-heading mb-0">
          Tentang TK Harapan Bunda
        </h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-success ml-3" style="border-radius: 20px; font-size: 12px; font-weight: 600;" title="Ubah Profil di Admin">
          <i class="fa fa-pencil"></i> Ubah
        </a>
      </div>

      <div class="about-content text-dark mx-auto" style="font-size: 1.05rem; line-height: 1.8; max-width: 900px;">
        @if(isset($sekolah->deskripsi_profil) && !empty($sekolah->deskripsi_profil))
          {!! nl2br(e($sekolah->deskripsi_profil)) !!}
        @else
          <p>
            <strong>TK Harapan Bunda</strong> melayani pendidikan anak usia dini dalam rentang usia 4–6 tahun. Jumlah peserta didik pada tahun ajaran ini sebanyak 34 anak. Anak-anak berasal dari latar belakang keluarga dengan kondisi sosial ekonomi dan budaya yang beragam, mencerminkan karakter masyarakat kota Bandung.
          </p>
          <p class="mb-0">
            Sebagian besar orang tua peserta didik bekerja di sektor formal dan informal, sehingga waktu pendampingan di rumah tidak merata. Hal ini menyebabkan variasi dalam kemampuan awal peserta didik saat memasuki sekolah, baik dari aspek kognitif, sosial emosional, maupun kesiapan literasi dan motorik.
          </p>
        @endif
      </div>
    </div>
  </section>
  <!-- end profil section -->

  <!-- 2. Visi & Misi Section -->
  <section class="visi_misi_section layout_padding bg-light">
    <div class="container">
      <div class="d-flex justify-content-center align-items-center mb-3">
        <h2 class="main-heading mb-0">
          Visi &amp; Misi
        </h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-success ml-3" style="border-radius: 20px; font-size: 12px; font-weight: 600;" title="Ubah Visi & Misi di Admin">
          <i class="fa fa-pencil"></i> Ubah Visi &amp; Misi
        </a>
      </div>
      <p class="text-center mb-5">
        TK Harapan Bunda bertekad memberikan pendidikan anak usia dini yang berkualitas dan berkarakter.
      </p>
      <div class="row">
        <!-- Visi -->
        <div class="col-md-6 mb-4 mb-md-0">
          <div class="vm-card">
            <h3 class="vm-card-title">Visi</h3>
            <p class="vm-visi-text">
              {{ $sekolah->visi ?? 'Terwujudnya murid yang membentuk anak yang berahlak mulia, cerdas, kreatif, mandiri, sehat dan kuat.' }}
            </p>
          </div>
        </div>
        <!-- Misi -->
        <div class="col-md-6">
          <div class="vm-card">
            <h3 class="vm-card-title">Misi</h3>
            <ul class="vm-misi-list">
              @php
                $misiText = $sekolah->misi ?? "1. Menanamkan nilai-nilai keimanan dan ketaqwaan sejak dini.\n2. Mengembangkan kreatifitas dalam setiap kegiatan pembelajaran dan mengembangkan bakat dan minat anak.\n3. Membiasakan sikap mandiri pada anak.\n4. Membiasakan hidup sehat.";
                $misiLines = preg_split('/\r\n|\r|\n/', trim($misiText));
              @endphp
              @foreach($misiLines as $index => $line)
                @if(!empty(trim($line)))
                  <li class="vm-misi-item">
                    <span class="vm-misi-num">{{ preg_match('/^\d+\.?\s*/', $line) ? '' : ($index + 1).'.' }}</span>
                    <p class="vm-misi-text">{{ preg_replace('/^\d+\.?\s*/', '', $line) }}</p>
                  </li>
                @endif
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end visi misi section -->

  <!-- CTA ke Halaman Kurikulum -->
  <section class="layout_padding-bottom text-center bg-white">
    <div class="container">
      <h3 style="font-weight: 700; color: #1e293b; margin-bottom: 12px;">Ingin Mengenal Lebih Dekat Kurikulum Kami?</h3>
      <p class="text-muted mx-auto mb-4" style="max-width: 600px; font-size: 1rem;">
        Pelajari bagaimana struktur kurikulum, kegiatan intrakurikuler, dan capaian pembelajaran di TK Harapan Bunda dirancang secara integratif untuk menumbuhkan potensi setiap anak.
      </p>
      <a href="{{ route('kurikulum') }}" class="call_to-btn">
        <span>Lihat Kurikulum &amp; Pembelajaran</span>
        <img src="{{ asset('adward/images/right-arrow.png') }}" alt="Panah">
      </a>
    </div>
  </section>

@endsection

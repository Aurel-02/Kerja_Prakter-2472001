@extends('layouts.public')

@section('title', 'TK Harapan Bunda - Tentang Kami')

@section('top_container')
  @include('public.navbar.navbar')
@endsection

@section('content')

  <!-- 1. Profil Singkat TK Harapan Bunda -->
  <section class="about_section layout_padding bg-white">
    <div class="container">
      <h2 class="main-heading mb-4">
        Tentang TK Harapan Bunda
      </h2>

      <div class="about-content text-dark mx-auto" style="font-size: 1.05rem; line-height: 1.8; max-width: 900px;">
        <p>
          <strong>TK Harapan Bunda</strong> melayani pendidikan anak usia dini dalam rentang usia 4–6 tahun. Jumlah peserta didik pada tahun ajaran ini sebanyak 34 anak. Anak-anak berasal dari latar belakang keluarga dengan kondisi sosial ekonomi dan budaya yang beragam, mencerminkan karakter masyarakat kota Bandung.
        </p>

        <p class="mb-0">
          Sebagian besar orang tua peserta didik bekerja di sektor formal dan informal, sehingga waktu pendampingan di rumah tidak merata. Hal ini menyebabkan variasi dalam kemampuan awal peserta didik saat memasuki sekolah, baik dari aspek kognitif, sosial emosional, maupun kesiapan literasi dan motorik.
        </p>
      </div>
    </div>
  </section>
  <!-- end profil section -->

  <!-- 2. Visi & Misi Section -->
  <section class="visi_misi_section layout_padding bg-light">
    <div class="container">
      <h2 class="main-heading mb-3">
        Visi &amp; Misi
      </h2>
      <p class="text-center mb-5">
        TK Harapan Bunda bertekad memberikan pendidikan anak usia dini yang berkualitas dan berkarakter.
      </p>
      <div class="row">
        <!-- Visi -->
        <div class="col-md-6 mb-4 mb-md-0">
          <div class="vm-card">
            <h3 class="vm-card-title">Visi</h3>
            <p class="vm-visi-text">
              Terwujudnya murid yang membentuk anak yang berahlak mulia, cerdas, kreatif, mandiri, sehat dan kuat.
            </p>
          </div>
        </div>
        <!-- Misi -->
        <div class="col-md-6">
          <div class="vm-card">
            <h3 class="vm-card-title">Misi</h3>
            <ul class="vm-misi-list">
              <li class="vm-misi-item">
                <span class="vm-misi-num">1.</span>
                <p class="vm-misi-text">Menanamkan nilai-nilai keimanan dan ketaqwaan sejak dini.</p>
              </li>
              <li class="vm-misi-item">
                <span class="vm-misi-num">2.</span>
                <p class="vm-misi-text">Mengembangkan kreatifitas dalam setiap kegiatan pembelajaran dan mengembangkan bakat dan minat anak.</p>
              </li>
              <li class="vm-misi-item">
                <span class="vm-misi-num">3.</span>
                <p class="vm-misi-text">Membiasakan sikap mandiri pada anak.</p>
              </li>
              <li class="vm-misi-item">
                <span class="vm-misi-num">4.</span>
                <p class="vm-misi-text">Membiasakan hidup sehat.</p>
              </li>
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

@extends('layouts.adward')

@section('title', 'TK Harapan Bunda - Tentang Kami')

@section('top_container')
  @include('adward.partials.navbar')
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
        Visi & Misi
      </h2>
      <p class="text-center mb-5">
        TK Harapan Bunda bertekad memberikan pendidikan anak usia dini yang berkualitas dan berkarakter.
      </p>
      <div class="row">
        <div class="col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 15px; background-color: #f0fdf4 !important; border: 1px solid #bbf7d0 !important; border-top: 5px solid #25d366 !important;">
            <div class="card-body">
              <h3 class="card-title text-success font-weight-bold mb-3">
                Visi
              </h3>
              <p class="card-text text-dark font-weight-medium">
                Terwujudnya murid yang membentuk anak yang berahlak mulia, cerdas, kreatif, mandiri, sehat dan kuat.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 15px; background-color: #f0fdf4 !important; border: 1px solid #bbf7d0 !important; border-top: 5px solid #25d366 !important;">
            <div class="card-body">
              <h3 class="card-title text-success font-weight-bold mb-3">
                Misi
              </h3>
              <ol class="pl-3 text-dark font-weight-medium" style="line-height: 1.8;">
                <li>Menanamkan nilai-nilai keimanan dan ketaqwaan sejak dini.</li>
                <li>Mengembangkan kreatifitas dalam setiap kegiatan pembelajaran dan mengembangkan bakat dan minat anak.</li>
                <li>Membiasakan sikap mandiri pada anak.</li>
                <li>Membiasakan hidup sehat.</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end visi misi section -->

  <!-- 3. 6 Pondasi Perkembangan Anak Section -->
  <section class="pondasi_section layout_padding bg-white">
    <div class="container">
      <h2 class="main-heading mb-3">
        6 Pondasi Perkembangan Anak
      </h2>
      <p class="text-center text-muted mb-5" style="max-width: 750px; margin: 0 auto;">
        Penguatan 6 kemampuan pondasi penting untuk membangun karakter dan kesiapan tumbuh kembang anak usia dini secara seimbang.
      </p>

      <div class="row">
        <div class="col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm p-3" style="border-left: 5px solid #25d366; background: #f0fdf4; border-radius: 10px;">
            <h6 class="font-weight-bold text-success mb-1" style="font-size: 1.05rem;">1. Nilai Agama & Budi Pekerti</h6>
            <p class="mb-0 text-dark small" style="font-size: 0.95rem;">Melalui pembiasaan berdoa, menghargai sesama, dan bersikap sopan.</p>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm p-3" style="border-left: 5px solid #25d366; background: #f0fdf4; border-radius: 10px;">
            <h6 class="font-weight-bold text-success mb-1" style="font-size: 1.05rem;">2. Fisik Motorik</h6>
            <p class="mb-0 text-dark small" style="font-size: 0.95rem;">Variasi kemampuan gerak kasar dan halus yang dipengaruhi oleh aktivitas sehari-hari.</p>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm p-3" style="border-left: 5px solid #25d366; background: #f0fdf4; border-radius: 10px;">
            <h6 class="font-weight-bold text-success mb-1" style="font-size: 1.05rem;">3. Kognitif</h6>
            <p class="mb-0 text-dark small" style="font-size: 0.95rem;">Melalui stimulasi berpikir logis, pemecahan masalah, dan penalaran awal.</p>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm p-3" style="border-left: 5px solid #25d366; background: #f0fdf4; border-radius: 10px;">
            <h6 class="font-weight-bold text-success mb-1" style="font-size: 1.05rem;">4. Bahasa</h6>
            <p class="mb-0 text-dark small" style="font-size: 0.95rem;">Penguatan pada bahasa reseptif dan ekspresif, terutama dalam merespons dan menyampaikan ide.</p>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm p-3" style="border-left: 5px solid #25d366; background: #f0fdf4; border-radius: 10px;">
            <h6 class="font-weight-bold text-success mb-1" style="font-size: 1.05rem;">5. Sosial Emosional</h6>
            <p class="mb-0 text-dark small" style="font-size: 0.95rem;">Pembentukan kemandirian, kerja sama, dan kepercayaan diri dalam interaksi kelompok.</p>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm p-3" style="border-left: 5px solid #25d366; background: #f0fdf4; border-radius: 10px;">
            <h6 class="font-weight-bold text-success mb-1" style="font-size: 1.05rem;">6. Seni</h6>
            <p class="mb-0 text-dark small" style="font-size: 0.95rem;">Melalui ekspresi diri lewat menggambar, menyanyi, menari, dan bermain peran.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end pondasi section -->

  <!-- CTA ke Halaman Kurikulum -->
  <section class="layout_padding-bottom text-center bg-white">
    <div class="container">
      <div class="p-4 p-md-5 rounded-lg shadow-sm" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border: 1px solid #bbf7d0; border-radius: 16px;">
        <h3 class="font-weight-bold text-success mb-3">Ingin Mengenal Lebih Dekat Kurikulum Kami?</h3>
        <p class="text-muted mx-auto mb-4" style="max-width: 680px; font-size: 1.05rem;">
          Pelajari bagaimana struktur kurikulum, kegiatan intrakurikuler, dan capaian pembelajaran di TK Harapan Bunda dirancang secara integratif untuk menumbuhkan potensi setiap anak.
        </p>
        <a href="{{ route('kurikulum') }}" class="call_to-btn">
          <span>Lihat Kurikulum & Pembelajaran</span>
          <img src="{{ asset('adward/images/right-arrow.png') }}" alt="Panah">
        </a>
      </div>
    </div>
  </section>

@endsection

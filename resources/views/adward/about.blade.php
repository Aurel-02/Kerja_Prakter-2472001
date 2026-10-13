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

  <!-- 4. SOP KBM Kurikulum CERDAS Section -->
  <section class="sop_section layout_padding bg-light">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="main-heading">
          Kurikulum CERDAS
        </h2>
        <p class="text-muted" style="max-width: 750px; margin: 0 auto;">
          Standar Operasional Prosedur TK Harapan Bunda untuk menciptakan kegiatan pembelajaran yang menyenangkan, aktif, kreatif, religius, dan sesuai kebutuhan perkembangan anak.
        </p>
      </div>

      <!-- Tujuan Section -->
      <div class="card border-0 shadow-sm p-4 mb-5" style="border-radius: 12px; background-color: #f0fdf4; border-left: 5px solid #25d366 !important;">
        <h4 class="text-success font-weight-bold mb-2">
          Tujuan Pembelajaran
        </h4>
        <p class="mb-0 text-dark font-weight-medium" style="font-size: 1.05rem;">
          Menciptakan kegiatan pembelajaran yang menyenangkan, aktif, kreatif, religius, dan sesuai dengan kebutuhan perkembangan anak.
        </p>
      </div>

      <!-- Prinsip Pembelajaran CERDAS (6 Kotak C-E-R-D-A-S) -->
      <h3 class="text-success font-weight-bold mb-4 text-center">
        Prinsip Pembelajaran CERDAS
      </h3>
      <div class="row mb-5">
        <!-- C -->
        <div class="col-md-4 col-sm-6 mb-4">
          <div class="card h-100 border-0 shadow-sm text-center p-3" style="border-radius: 12px; background: #ffffff; border-top: 4px solid #e11d48 !important;">
            <div class="my-2">
              <span class="badge badge-pill badge-danger font-weight-bold px-3 py-2" style="font-size: 1.2rem;">C</span>
            </div>
            <h5 class="font-weight-bold text-danger">CINTA</h5>
            <p class="text-muted small mb-0">Pembelajaran penuh kasih sayang.</p>
          </div>
        </div>
        <!-- E -->
        <div class="col-md-4 col-sm-6 mb-4">
          <div class="card h-100 border-0 shadow-sm text-center p-3" style="border-radius: 12px; background: #ffffff; border-top: 4px solid #0284c7 !important;">
            <div class="my-2">
              <span class="badge badge-pill badge-primary font-weight-bold px-3 py-2" style="font-size: 1.2rem; background-color: #0284c7;">E</span>
            </div>
            <h5 class="font-weight-bold" style="color: #0284c7;">EKSPLORASI</h5>
            <p class="text-muted small mb-0">Anak diberi kesempatan mencoba dan menemukan.</p>
          </div>
        </div>
        <!-- R -->
        <div class="col-md-4 col-sm-6 mb-4">
          <div class="card h-100 border-0 shadow-sm text-center p-3" style="border-radius: 12px; background: #ffffff; border-top: 4px solid #16a34a !important;">
            <div class="my-2">
              <span class="badge badge-pill badge-success font-weight-bold px-3 py-2" style="font-size: 1.2rem; background-color: #16a34a;">R</span>
            </div>
            <h5 class="font-weight-bold text-success">RELIGIUS</h5>
            <p class="text-muted small mb-0">Membiasakan nilai agama dan akhlak mulia.</p>
          </div>
        </div>
        <!-- D -->
        <div class="col-md-4 col-sm-6 mb-4">
          <div class="card h-100 border-0 shadow-sm text-center p-3" style="border-radius: 12px; background: #ffffff; border-top: 4px solid #d97706 !important;">
            <div class="my-2">
              <span class="badge badge-pill badge-warning font-weight-bold text-white px-3 py-2" style="font-size: 1.2rem; background-color: #d97706;">D</span>
            </div>
            <h5 class="font-weight-bold" style="color: #d97706;">DAYA PIKIR</h5>
            <p class="text-muted small mb-0">Mengembangkan kemampuan berpikir dan memecahkan masalah.</p>
          </div>
        </div>
        <!-- A -->
        <div class="col-md-4 col-sm-6 mb-4">
          <div class="card h-100 border-0 shadow-sm text-center p-3" style="border-radius: 12px; background: #ffffff; border-top: 4px solid #9333ea !important;">
            <div class="my-2">
              <span class="badge badge-pill font-weight-bold text-white px-3 py-2" style="font-size: 1.2rem; background-color: #9333ea;">A</span>
            </div>
            <h5 class="font-weight-bold" style="color: #9333ea;">AKTIF</h5>
            <p class="text-muted small mb-0">Anak terlibat langsung dalam kegiatan.</p>
          </div>
        </div>
        <!-- S -->
        <div class="col-md-4 col-sm-6 mb-4">
          <div class="card h-100 border-0 shadow-sm text-center p-3" style="border-radius: 12px; background: #ffffff; border-top: 4px solid #0d9488 !important;">
            <div class="my-2">
              <span class="badge badge-pill font-weight-bold text-white px-3 py-2" style="font-size: 1.2rem; background-color: #0d9488;">S</span>
            </div>
            <h5 class="font-weight-bold" style="color: #0d9488;">SOSIAL</h5>
            <p class="text-muted small mb-0">Mengembangkan kerja sama, komunikasi, dan kepedulian.</p>
          </div>
        </div>
      </div>

      <!-- Prosedur KBM (5 Langkah Alur) -->
      <h3 class="text-success font-weight-bold mb-4 text-center">
        Prosedur Kegiatan Belajar Mengajar
      </h3>
      <div class="row mb-5">
        <!-- 1 -->
        <div class="col-lg col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm p-3" style="border-radius: 12px; background: #fff; border-top: 4px solid #25d366 !important;">
            <div class="d-flex align-items-center mb-2">
              <span class="badge badge-success badge-pill mr-2 px-3 py-1 font-weight-bold" style="font-size: 1rem; background-color: #25d366;">1</span>
              <h6 class="font-weight-bold mb-0 text-success">Penyambutan</h6>
            </div>
            <ul class="pl-3 mb-0 text-dark small" style="line-height: 1.6;">
              <li>Guru menyambut anak dengan ramah.</li>
              <li>Membiasakan salam, senyum, dan sikap sopan.</li>
              <li>Memastikan kondisi anak siap mengikuti pembelajaran.</li>
            </ul>
          </div>
        </div>
        <!-- 2 -->
        <div class="col-lg col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm p-3" style="border-radius: 12px; background: #fff; border-top: 4px solid #25d366 !important;">
            <div class="d-flex align-items-center mb-2">
              <span class="badge badge-success badge-pill mr-2 px-3 py-1 font-weight-bold" style="font-size: 1rem; background-color: #25d366;">2</span>
              <h6 class="font-weight-bold mb-0 text-success">Pembukaan</h6>
            </div>
            <ul class="pl-3 mb-0 text-dark small" style="line-height: 1.6;">
              <li>Berdoa bersama.</li>
              <li>Bernyanyi dan kegiatan penguatan karakter.</li>
              <li>Apersepsi dan menyampaikan kegiatan hari ini.</li>
            </ul>
          </div>
        </div>
        <!-- 3 -->
        <div class="col-lg col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm p-3" style="border-radius: 12px; background: #fff; border-top: 4px solid #25d366 !important;">
            <div class="d-flex align-items-center mb-2">
              <span class="badge badge-success badge-pill mr-2 px-3 py-1 font-weight-bold" style="font-size: 1rem; background-color: #25d366;">3</span>
              <h6 class="font-weight-bold mb-0 text-success">Kegiatan Inti</h6>
            </div>
            <ul class="pl-3 mb-0 text-dark small" style="line-height: 1.6;">
              <li>Guru memberikan pengalaman belajar melalui bermain.</li>
              <li>Anak melakukan eksplorasi, kreativitas, motorik, bahasa, kognitif, dan sosial.</li>
              <li>Guru membimbing & memberikan stimulasi.</li>
            </ul>
          </div>
        </div>
        <!-- 4 -->
        <div class="col-lg col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm p-3" style="border-radius: 12px; background: #fff; border-top: 4px solid #25d366 !important;">
            <div class="d-flex align-items-center mb-2">
              <span class="badge badge-success badge-pill mr-2 px-3 py-1 font-weight-bold" style="font-size: 1rem; background-color: #25d366;">4</span>
              <h6 class="font-weight-bold mb-0 text-success">Istirahat</h6>
            </div>
            <ul class="pl-3 mb-0 text-dark small" style="line-height: 1.6;">
              <li>Membiasakan cuci tangan dan hidup bersih.</li>
              <li>Makan dan minum dengan tertib.</li>
              <li>Bermain secara aman dan menyenangkan.</li>
            </ul>
          </div>
        </div>
        <!-- 5 -->
        <div class="col-lg col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm p-3" style="border-radius: 12px; background: #fff; border-top: 4px solid #25d366 !important;">
            <div class="d-flex align-items-center mb-2">
              <span class="badge badge-success badge-pill mr-2 px-3 py-1 font-weight-bold" style="font-size: 1rem; background-color: #25d366;">5</span>
              <h6 class="font-weight-bold mb-0 text-success">Penutup</h6>
            </div>
            <ul class="pl-3 mb-0 text-dark small" style="line-height: 1.6;">
              <li>Mengingat kembali kegiatan yang dilakukan.</li>
              <li>Anak menyampaikan pengalaman/perasaan.</li>
              <li>Guru memberikan apresiasi & penguatan.</li>
              <li>Berdoa dan salam.</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Penilaian & Tugas Guru & Hasil yang Diharapkan -->
      <div class="row mb-4">
        <div class="col-md-4 mb-4">
          <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 12px; background: #faf5ff; border-top: 4px solid #9333ea !important;">
            <h5 class="font-weight-bold" style="color: #9333ea;">
              Penilaian
            </h5>
            <p class="card-text text-dark small mb-0" style="line-height: 1.7;">
              Penilaian dilakukan melalui observasi, catatan anekdot, hasil karya, dan dokumentasi kegiatan untuk mengetahui perkembangan setiap anak.
            </p>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 12px; background: #fff7ed; border-top: 4px solid #ea580c !important;">
            <h5 class="font-weight-bold" style="color: #ea580c;">
              Tugas Guru
            </h5>
            <p class="card-text text-dark small mb-0" style="line-height: 1.7;">
              Guru wajib menciptakan lingkungan belajar yang aman, nyaman, menyenangkan, memberikan teladan yang baik, serta menghargai setiap keunikan dan kemampuan anak.
            </p>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 12px; background: #f0fdf4; border-top: 4px solid #16a34a !important;">
            <h5 class="font-weight-bold text-success">
              Hasil yang Diharapkan
            </h5>
            <p class="card-text text-dark small mb-0" style="line-height: 1.7;">
              Terwujudnya murid yang <strong>BERAKHLAK MULIA, CERDAS, KREATIF, MANDIRI, SEHAT, DAN KUAT</strong> (sesuai Visi TK Harapan Bunda).
            </p>
          </div>
        </div>
      </div>

      <!-- Slogan Bottom Banner -->
      <div class="text-center p-4 rounded-lg shadow-sm" style="background: linear-gradient(135deg, #25d366, #16a34a); color: #ffffff; border-radius: 15px;">
        <h5 class="font-weight-bold mb-0" style="letter-spacing: 0.5px;">
          "Belajar dengan cinta, bermain dengan gembira, tumbuh bersama menjadi generasi terbaik!"
        </h5>
      </div>

    </div>
  </section>

@endsection

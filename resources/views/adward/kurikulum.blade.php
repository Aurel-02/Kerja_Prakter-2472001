@extends('layouts.adward')

@section('title', 'TK Harapan Bunda - Kurikulum')

@section('top_container')
  @include('adward.partials.navbar')
@endsection

@section('content')

  <!-- Kurikulum Intro -->
  <section class="kuri-intro" style="padding: 70px 0 50px; background: #fff;">
    <div class="container">
      <div class="text-center">
        <h2 style="font-weight: 800; font-size: 2.2rem; color: #1e293b; line-height: 1.35; margin-bottom: 18px;">
          Kurikulum Merdeka<br>
          <span style="color: #25d366;">TK Harapan Bunda</span>
        </h2>
        <p style="color: #555; font-size: 1.02rem; line-height: 1.9; max-width: 680px; margin: 0 auto 14px;">
          Kami mengimplementasikan <strong>Kurikulum Merdeka (PAUD)</strong> yang diselaraskan dengan visi dan nilai keagamaan sekolah. Kurikulum ini memberikan ruang keleluasaan bagi anak didik untuk mengeksplorasi potensinya secara optimal melalui prinsip <strong>Belajar Melalui Bermain</strong> dan <strong>Berpusat pada Anak</strong>.
        </p>
        <p style="color: #666; font-size: 0.95rem; line-height: 1.85; max-width: 600px; margin: 0 auto;">
          Guru berperan sebagai fasilitator yang mendampingi anak dengan penuh kasih sayang, menumbuhkan rasa percaya diri, kemandirian, serta kecintaan terhadap ilmu dan budi pekerti yang luhur sejak usia dini.
        </p>
      </div>
    </div>
  </section>

  <!-- Nilai CERDAS -->
  <section style="padding: 55px 0 60px; background: #f8faf9;">
    <div class="container">
      <div class="text-center" style="margin-bottom: 35px;">
        <h3 style="font-weight: 800; color: #1e293b; font-size: 1.65rem; margin-bottom: 8px;">
          Nilai Pembelajaran <span style="color: #25d366;">CERDAS</span>
        </h3>
        <p style="color: #777; max-width: 550px; margin: 0 auto; font-size: 0.93rem;">
          Enam karakter unggulan yang menjadi jiwa dalam setiap kegiatan belajar dan bermain anak.
        </p>
      </div>

      <div class="kuri-cerdas-wrap">
        <!-- C -->
        <div class="kuri-val-item">
          <div class="kuri-val-letter" style="background: #fef2f2; color: #dc2626;">C</div>
          <h6 class="kuri-val-title" style="color: #dc2626;">Cinta</h6>
          <p class="kuri-val-desc">Pembelajaran dengan kasih sayang dan kehangatan.</p>
        </div>
        <!-- E -->
        <div class="kuri-val-item">
          <div class="kuri-val-letter" style="background: #eff6ff; color: #2563eb;">E</div>
          <h6 class="kuri-val-title" style="color: #2563eb;">Eksplorasi</h6>
          <p class="kuri-val-desc">Memberi kesempatan mencoba dan menemukan hal baru.</p>
        </div>
        <!-- R -->
        <div class="kuri-val-item">
          <div class="kuri-val-letter" style="background: #f0fdf4; color: #16a34a;">R</div>
          <h6 class="kuri-val-title" style="color: #16a34a;">Religius</h6>
          <p class="kuri-val-desc">Membiasakan nilai iman dan akhlak mulia sejak dini.</p>
        </div>
        <!-- D -->
        <div class="kuri-val-item">
          <div class="kuri-val-letter" style="background: #fffbeb; color: #d97706;">D</div>
          <h6 class="kuri-val-title" style="color: #d97706;">Daya Pikir</h6>
          <p class="kuri-val-desc">Mengasah nalar kritis dan pemecahan masalah sederhana.</p>
        </div>
        <!-- A -->
        <div class="kuri-val-item">
          <div class="kuri-val-letter" style="background: #faf5ff; color: #7c3aed;">A</div>
          <h6 class="kuri-val-title" style="color: #7c3aed;">Aktif</h6>
          <p class="kuri-val-desc">Anak terlibat langsung secara interaktif dalam kegiatan.</p>
        </div>
        <!-- S -->
        <div class="kuri-val-item">
          <div class="kuri-val-letter" style="background: #f0fdfa; color: #0d9488;">S</div>
          <h6 class="kuri-val-title" style="color: #0d9488;">Sosial</h6>
          <p class="kuri-val-desc">Menumbuhkan empati, kerja sama, dan komunikasi.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Aspek Perkembangan Anak -->
  <section style="padding: 60px 0; background: #fff;">
    <div class="container">
      <div style="margin-bottom: 38px;">
        <h3 style="font-weight: 800; color: #1e293b; font-size: 1.6rem;">
          Aspek Perkembangan Anak
        </h3>
        <p style="color: #777; max-width: 580px; font-size: 0.93rem; margin-top: 6px;">
          Kemampuan yang distimulasi menyeluruh dalam setiap kegiatan bermain dan belajar anak.
        </p>
      </div>

      <div class="row">
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="kuri-aspek-card">
            <h6 style="font-weight: 700; color: #1e293b; margin-bottom: 6px;">Nilai Agama & Moral</h6>
            <p style="color: #666; font-size: 0.88rem; line-height: 1.65; margin: 0;">
              Mengenal dan mencintai Tuhan, pembiasaan berdoa, mengenal ibadah sederhana, meneladani akhlak mulia, bersikap jujur, sopan santun, serta saling menghargai.
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="kuri-aspek-card">
            <h6 style="font-weight: 700; color: #1e293b; margin-bottom: 6px;">Fisik Motorik</h6>
            <p style="color: #666; font-size: 0.88rem; line-height: 1.65; margin: 0;">
              Stimulasi motorik kasar (berlari, melompat, senam irama) serta motorik halus (meronce, melipat, menggunting, dan memegang alat tulis).
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="kuri-aspek-card">
            <h6 style="font-weight: 700; color: #1e293b; margin-bottom: 6px;">Kognitif</h6>
            <p style="color: #666; font-size: 0.88rem; line-height: 1.65; margin: 0;">
              Mengasah kemampuan berpikir logis, rasa ingin tahu, pengenalan konsep bentuk, ukuran, pola, warna, serta pemecahan masalah secara kreatif.
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="kuri-aspek-card">
            <h6 style="font-weight: 700; color: #1e293b; margin-bottom: 6px;">Bahasa</h6>
            <p style="color: #666; font-size: 0.88rem; line-height: 1.65; margin: 0;">
              Penguatan bahasa reseptif (menyimak, memahami) serta ekspresif (berani berbicara, menceritakan kembali), beserta kesiapan literasi awal.
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="kuri-aspek-card">
            <h6 style="font-weight: 700; color: #1e293b; margin-bottom: 6px;">Sosial Emosional</h6>
            <p style="color: #666; font-size: 0.88rem; line-height: 1.65; margin: 0;">
              Membangun kemandirian, mengenali dan mengelola emosi, menumbuhkan empati, kemampuan berbagi, toleransi, dan bekerja sama.
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="kuri-aspek-card">
            <h6 style="font-weight: 700; color: #1e293b; margin-bottom: 6px;">Seni</h6>
            <p style="color: #666; font-size: 0.88rem; line-height: 1.65; margin: 0;">
              Eksplorasi dan ekspresi daya cipta estetika melalui menggambar, mewarnai, bermain musik, menyanyi, menari, dan bermain peran imajinatif.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Kegiatan Intrakurikuler -->
  <section style="padding: 55px 0 60px; background: #f8faf9;">
    <div class="container">
      <div class="row align-items-start">
        <div class="col-lg-5 mb-4 mb-lg-0">
          <h3 style="font-weight: 800; color: #1e293b; font-size: 1.55rem; margin-bottom: 14px;">
            Kegiatan Intrakurikuler
          </h3>
          <p style="color: #666; font-size: 0.93rem; line-height: 1.8;">
            Pembelajaran dilaksanakan melalui kegiatan yang mengembangkan enam aspek perkembangan anak yang terintegrasi dalam <strong>Agama dan Budi Pekerti</strong>, <strong>Jatidiri</strong>, serta <strong>Dasar-dasar Literasi, Matematika, Sains, Teknologi, Rekayasa dan Seni</strong>.
          </p>
        </div>
        <div class="col-lg-7">
          <div class="kuri-timeline">
            <div class="kuri-tl-item">
              <div class="kuri-tl-dot" style="background: #25d366;"></div>
              <div class="kuri-tl-content">
                <h6 style="font-weight: 700; color: #1e293b; margin-bottom: 3px; font-size: 0.95rem;">Kegiatan Awal</h6>
                <p style="color: #777; font-size: 0.87rem; margin: 0;">Menyambut anak, berdoa bersama, menyanyikan lagu nasional, diskusi ringan tentang tema hari ini.</p>
              </div>
            </div>
            <div class="kuri-tl-item">
              <div class="kuri-tl-dot" style="background: #f59e0b;"></div>
              <div class="kuri-tl-content">
                <h6 style="font-weight: 700; color: #1e293b; margin-bottom: 3px; font-size: 0.95rem;">Kegiatan Inti</h6>
                <p style="color: #777; font-size: 0.87rem; margin: 0;">Kegiatan tematik, bermain peran, eksperimen sains sederhana, dan proyek mini sesuai minat anak.</p>
              </div>
            </div>
            <div class="kuri-tl-item">
              <div class="kuri-tl-dot" style="background: #8b5cf6;"></div>
              <div class="kuri-tl-content">
                <h6 style="font-weight: 700; color: #1e293b; margin-bottom: 3px; font-size: 0.95rem;">Kegiatan Penutup</h6>
                <p style="color: #777; font-size: 0.87rem; margin: 0;">Refleksi bersama, apresiasi hasil karya, evaluasi ringan dan berdoa sebelum pulang.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Kegiatan Ekstrakurikuler -->
  <section style="padding: 60px 0; background: #fff;">
    <div class="container">
      <div class="text-center" style="margin-bottom: 35px;">
        <h3 style="font-weight: 800; color: #1e293b; font-size: 1.55rem; margin-bottom: 8px;">
          Kegiatan Ekstrakurikuler
        </h3>
        <p style="color: #777; max-width: 620px; margin: 0 auto; font-size: 0.93rem;">
          Kegiatan di luar jam belajar untuk mengembangkan potensi, bakat, dan minat anak. Dilaksanakan setiap <strong>Senin, Selasa, dan Kamis</strong> dengan durasi sekitar <strong>60 menit</strong>.
        </p>
      </div>

      <div class="kuri-ekskul-list">
        <div class="kuri-ekskul-row">
          <div class="kuri-ekskul-no">01</div>
          <div class="kuri-ekskul-info">
            <h6 style="font-weight: 700; color: #1e293b; margin-bottom: 2px;">Shalat Dhuha</h6>
            <p style="color: #777; font-size: 0.87rem; margin: 0;">Membiasakan ibadah sunnah, menumbuhkan kedisiplinan, serta menanamkan nilai spiritual dalam keseharian.</p>
          </div>
        </div>
        <div class="kuri-ekskul-row">
          <div class="kuri-ekskul-no">02</div>
          <div class="kuri-ekskul-info">
            <h6 style="font-weight: 700; color: #1e293b; margin-bottom: 2px;">Bacaan Surat-Surat Pendek</h6>
            <p style="color: #777; font-size: 0.87rem; margin: 0;">Mengembangkan kemampuan membaca Al-Quran dengan tartil dan benar.</p>
          </div>
        </div>
        <div class="kuri-ekskul-row">
          <div class="kuri-ekskul-no">03</div>
          <div class="kuri-ekskul-info">
            <h6 style="font-weight: 700; color: #1e293b; margin-bottom: 2px;">Tari Tradisional</h6>
            <p style="color: #777; font-size: 0.87rem; margin: 0;">Melestarikan budaya daerah dan mengembangkan apresiasi seni tradisional.</p>
          </div>
        </div>
        <div class="kuri-ekskul-row">
          <div class="kuri-ekskul-no">04</div>
          <div class="kuri-ekskul-info">
            <h6 style="font-weight: 700; color: #1e293b; margin-bottom: 2px;">English for Kids</h6>
            <p style="color: #777; font-size: 0.87rem; margin: 0;">Mengenalkan bahasa Inggris dasar melalui lagu dan permainan sederhana.</p>
          </div>
        </div>
        <div class="kuri-ekskul-row">
          <div class="kuri-ekskul-no">05</div>
          <div class="kuri-ekskul-info">
            <h6 style="font-weight: 700; color: #1e293b; margin-bottom: 2px;">Kamis Nyunda</h6>
            <p style="color: #777; font-size: 0.87rem; margin: 0;">Mengenalkan undak usuk bahasa Sunda serta menanamkan rasa cinta terhadap budaya lokal dan makanan tradisional.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Slogan -->
  <section style="padding: 50px 0 60px; background: #f8faf9;">
    <div class="container">
      <div style="text-align: center;">
        <p style="font-size: 1.15rem; font-style: italic; color: #4a5568; line-height: 1.7; margin-bottom: 10px;">
          "Belajar dengan cinta, bermain dengan gembira,<br class="d-none d-md-block"> tumbuh bersama menjadi generasi terbaik!"
        </p>
      </div>
    </div>
  </section>

@endsection

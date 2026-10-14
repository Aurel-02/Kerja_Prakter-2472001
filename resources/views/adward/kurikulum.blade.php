@extends('layouts.adward')

@section('title', 'TK Harapan Bunda - Kurikulum')

@section('top_container')
  @include('adward.partials.navbar')
@endsection

@section('content')

  <!-- 1. Deskripsi Kurikulum TK Harapan Bunda -->
  <section class="kurikulum_section layout_padding bg-white">
    <div class="container">
      <h2 class="main-heading mb-4">
        Kurikulum TK Harapan Bunda
      </h2>

      <div class="kurikulum-content text-dark mx-auto mb-5" style="font-size: 1.05rem; line-height: 1.85; max-width: 900px;">
        <p>
          TK Harapan Bunda mengimplementasikan <strong>Kurikulum Merdeka (PAUD)</strong> yang diselaraskan dengan visi dan nilai keagamaan sekolah. Kurikulum ini dirancang untuk memberikan ruang keleluasaan bagi anak didik dalam mengeksplorasi potensi dirinya secara optimal, dengan mengedepankan prinsip <strong>Belajar Melalui Bermain (Play-Based Learning)</strong> dan <strong>Berpusat pada Anak (Child-Centered)</strong>.
        </p>
        <p class="mb-0">
          Dalam penerapannya, proses pembelajaran di TK Harapan Bunda menghargai keunikan latar belakang dan tahap kesiapan masing-masing anak. Guru berperan sebagai fasilitator yang mendampingi anak dengan penuh kasih sayang, menumbuhkan rasa percaya diri, kemandirian, serta kecintaan terhadap ilmu dan budi pekerti yang luhur sejak usia dini.
        </p>
      </div>

      <!-- Nilai Pembelajaran CERDAS -->
      <div class="text-center mb-4">
        <h3 class="text-success font-weight-bold mb-2">
          Nilai Pembelajaran CERDAS
        </h3>
        <p class="text-muted mx-auto" style="max-width: 700px;">
          Karakteristik pembelajaran unggulan di TK Harapan Bunda yang menjadi jiwa dalam setiap kegiatan main dan stimulasi perkembangan anak.
        </p>
      </div>

      <div class="row mb-5">
        <!-- C -->
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
          <div class="card h-100 border-0 shadow-sm text-center p-3 kurikulum-card" style="border-top: 4px solid #e11d48 !important;">
            <div class="my-2">
              <span class="badge badge-pill badge-danger font-weight-bold px-3 py-2" style="font-size: 1.15rem;">C</span>
            </div>
            <h6 class="font-weight-bold text-danger mb-1">CINTA</h6>
            <p class="text-muted small mb-0">Pembelajaran dengan kasih sayang dan kehangatan.</p>
          </div>
        </div>
        <!-- E -->
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
          <div class="card h-100 border-0 shadow-sm text-center p-3 kurikulum-card" style="border-top: 4px solid #0284c7 !important;">
            <div class="my-2">
              <span class="badge badge-pill badge-primary font-weight-bold px-3 py-2" style="font-size: 1.15rem; background-color: #0284c7;">E</span>
            </div>
            <h6 class="font-weight-bold mb-1" style="color: #0284c7;">EKSPLORASI</h6>
            <p class="text-muted small mb-0">Memberi kesempatan mencoba dan menemukan hal baru.</p>
          </div>
        </div>
        <!-- R -->
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
          <div class="card h-100 border-0 shadow-sm text-center p-3 kurikulum-card" style="border-top: 4px solid #16a34a !important;">
            <div class="my-2">
              <span class="badge badge-pill badge-success font-weight-bold px-3 py-2" style="font-size: 1.15rem; background-color: #16a34a;">R</span>
            </div>
            <h6 class="font-weight-bold text-success mb-1">RELIGIUS</h6>
            <p class="text-muted small mb-0">Membiasakan nilai iman dan akhlak mulia sejak dini.</p>
          </div>
        </div>
        <!-- D -->
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
          <div class="card h-100 border-0 shadow-sm text-center p-3 kurikulum-card" style="border-top: 4px solid #d97706 !important;">
            <div class="my-2">
              <span class="badge badge-pill badge-warning font-weight-bold text-white px-3 py-2" style="font-size: 1.15rem; background-color: #d97706;">D</span>
            </div>
            <h6 class="font-weight-bold mb-1" style="color: #d97706;">DAYA PIKIR</h6>
            <p class="text-muted small mb-0">Mengasah nalar kritis dan pemecahan masalah sederhana.</p>
          </div>
        </div>
        <!-- A -->
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
          <div class="card h-100 border-0 shadow-sm text-center p-3 kurikulum-card" style="border-top: 4px solid #9333ea !important;">
            <div class="my-2">
              <span class="badge badge-pill font-weight-bold text-white px-3 py-2" style="font-size: 1.15rem; background-color: #9333ea;">A</span>
            </div>
            <h6 class="font-weight-bold mb-1" style="color: #9333ea;">AKTIF</h6>
            <p class="text-muted small mb-0">Anak terlibat langsung secara interaktif dalam kegiatan.</p>
          </div>
        </div>
        <!-- S -->
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
          <div class="card h-100 border-0 shadow-sm text-center p-3 kurikulum-card" style="border-top: 4px solid #0d9488 !important;">
            <div class="my-2">
              <span class="badge badge-pill font-weight-bold text-white px-3 py-2" style="font-size: 1.15rem; background-color: #0d9488;">S</span>
            </div>
            <h6 class="font-weight-bold mb-1" style="color: #0d9488;">SOSIAL</h6>
            <p class="text-muted small mb-0">Menumbuhkan empati, kerja sama, dan komunikasi.</p>
          </div>
        </div>
      </div>

      <!-- Aspek Perkembangan Anak (Tepat di Bawah CERDAS) -->
      <div class="pt-3">
        <div class="text-center mb-4">
          <h3 class="text-success font-weight-bold mb-2">
            Aspek Perkembangan Anak
          </h3>
          <p class="text-muted mx-auto" style="max-width: 700px;">
            Enam aspek kemampuan penting yang distimulasi secara menyeluruh dalam setiap kegiatan bermain dan belajar anak:
          </p>
        </div>

        <div class="row">
          <!-- 1. Nilai Agama & Budi Pekerti -->
          <div class="col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm p-3" style="border-left: 5px solid #25d366; background: #f0fdf4; border-radius: 10px;">
              <h6 class="font-weight-bold text-success mb-1" style="font-size: 1.05rem;">1. Nilai Agama dan Moral</h6>
              <p class="mb-0 text-dark small" style="font-size: 0.95rem;">Mengenal dan mencintai Tuhan, pembiasaan berdoa sebelum dan sesudah kegiatan, mengenal ibadah sederhana, meneladani akhlak mulia, bersikap jujur, sopan santun, serta saling menghargai.</p>
            </div>
          </div>

          <!-- 2. Fisik Motorik -->
          <div class="col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm p-3" style="border-left: 5px solid #25d366; background: #f0fdf4; border-radius: 10px;">
              <h6 class="font-weight-bold text-success mb-1" style="font-size: 1.05rem;">2. Fisik Motorik</h6>
              <p class="mb-0 text-dark small" style="font-size: 0.95rem;">Stimulasi motorik kasar (keseimbangan tubuh, berlari, melompat, senam irama) serta motorik halus (koordinasi mata-tangan, meronce, melipat, menggunting, dan memegang alat tulis).</p>
            </div>
          </div>

          <!-- 3. Kognitif -->
          <div class="col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm p-3" style="border-left: 5px solid #25d366; background: #f0fdf4; border-radius: 10px;">
              <h6 class="font-weight-bold text-success mb-1" style="font-size: 1.05rem;">3. Kognitif</h6>
              <p class="mb-0 text-dark small" style="font-size: 0.95rem;">Mengasah kemampuan berpikir logis, rasa ingin tahu anak terhadap lingkungan sekitar, pengenalan konsep bentuk, ukuran, pola, warna, serta pemecahan masalah secara kreatif.</p>
            </div>
          </div>

          <!-- 4. Bahasa -->
          <div class="col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm p-3" style="border-left: 5px solid #25d366; background: #f0fdf4; border-radius: 10px;">
              <h6 class="font-weight-bold text-success mb-1" style="font-size: 1.05rem;">4. Bahasa</h6>
              <p class="mb-0 text-dark small" style="font-size: 0.95rem;">Penguatan bahasa reseptif (menyimak dan memahami pembicaraan) serta ekspresif (berani berbicara, menceritakan kembali, tanya jawab), beserta kesiapan literasi awal yang menyenangkan.</p>
            </div>
          </div>

          <!-- 5. Sosial Emosional -->
          <div class="col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm p-3" style="border-left: 5px solid #25d366; background: #f0fdf4; border-radius: 10px;">
              <h6 class="font-weight-bold text-success mb-1" style="font-size: 1.05rem;">5. Sosial Emosional</h6>
              <p class="mb-0 text-dark small" style="font-size: 0.95rem;">Membangun kemandirian (mengurus diri sendiri sesuai usia), mengenali dan mengelola emosi, menumbuhkan rasa empati, kemampuan berbagi, toleransi, dan bekerja sama dalam kelompok.</p>
            </div>
          </div>

          <!-- 6. Seni -->
          <div class="col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm p-3" style="border-left: 5px solid #25d366; background: #f0fdf4; border-radius: 10px;">
              <h6 class="font-weight-bold text-success mb-1" style="font-size: 1.05rem;">6. Seni</h6>
              <p class="mb-0 text-dark small" style="font-size: 0.95rem;">Ruang eksplorasi dan ekspresi daya cipta estetika anak melalui kegiatan menggambar, mewarnai, bermain musik sederhana, menyanyi dengan riang, menari, dan bermain peran imajinatif.</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  <!-- end kurikulum & aspek section -->

  <!-- 2. Kegiatan Intrakurikuler -->
  <section class="intrakurikuler_section layout_padding bg-light">
    <div class="container">
      <h2 class="main-heading mb-4">
        Kegiatan Intrakurikuler
      </h2>

      <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 12px; background-color: #f0fdf4 !important; border: 1px solid #bbf7d0 !important; border-top: 5px solid #25d366 !important;">
        <p class="text-dark mb-4" style="font-size: 1.05rem; line-height: 1.85;">
          Pembelajaran dilaksanakan melalui kegiatan yang mengembangkan enam aspek perkembangan anak: 
          <strong>Nilai Agama dan Moral, Fisik Motorik, Kognitif, Bahasa, Sosial Emosional, dan Seni</strong> yang terintegrasi dalam Ketiga elemen Capaian Pembelajaran yaitu 
          <strong>Agama dan Budi Pekerti, Jatidiri, serta Dasar-dasar Literasi dan Matematika, Sains, Teknologi, Rekayasa dan Seni</strong>.
        </p>

        <h5 class="text-success font-weight-bold mb-3" style="font-size: 1.1rem;">
          Setiap kegiatan harian mencakup:
        </h5>

        <ul class="pl-3 text-dark mb-0 font-weight-medium" style="line-height: 1.9; font-size: 1rem;">
          <li class="mb-2"><strong>Kegiatan Awal:</strong> menyambut, doa, lagu nasional, diskusi ringan</li>
          <li class="mb-2"><strong>Kegiatan Inti:</strong> kegiatan tematik, main peran, eksperimen, proyek mini</li>
          <li class="mb-0"><strong>Kegiatan Penutup:</strong> refleksi, apresiasi, evaluasi ringan, doa pulang</li>
        </ul>
      </div>
    </div>
  </section>
  <!-- end intrakurikuler section -->

  <!-- 3. Kegiatan Ekstrakurikuler -->
  <section class="ekskul_section layout_padding bg-white">
    <div class="container">
      <h2 class="main-heading mb-4">
        Kegiatan Ekstrakurikuler
      </h2>

      <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 12px; background-color: #f0fdf4 !important; border: 1px solid #bbf7d0 !important; border-top: 5px solid #25d366 !important;">
        <p class="text-dark mb-0 font-weight-medium" style="font-size: 1.02rem; line-height: 1.85;">
          Kegiatan Ekstrakurikuler adalah kegiatan pengembangan karakter dalam rangka perluasan potensi, bakat, minat, kemampuan, kepribadian, kerja sama dan kemandirian peserta didik secara optimal yang dilakukan di luar jam belajar. Kegiatan ekstrakurikuler di TK Harapan Bunda diselenggarakan setiap hari <strong>Senin, Selasa dan Kamis</strong> dengan lama waktu kegiatan sekitar <strong>60 menit</strong> pada masing - masing ekskul. Kegiatan ekstrakurikuler yang dimaksud adalah <strong>menari</strong> dan <strong>iqro</strong>. Setiap kegiatan ekstrakurikuler yang dilaksanakan memiliki tujuan tersendiri.
        </p>
      </div>

      <!-- Tabel Ekstrakurikuler Sederhana (Tanpa 8 Dimensi Profil Lulusan) -->
      <div class="table-responsive shadow-sm" style="border-radius: 12px; overflow: hidden; border: 1px solid #bbf7d0;">
        <table class="table table-hover mb-0" style="background: #ffffff;">
          <thead style="background: #25d366; color: #ffffff;">
            <tr>
              <th style="width: 8%; text-align: center; vertical-align: middle;" class="py-3 font-weight-bold">No</th>
              <th style="width: 32%; vertical-align: middle;" class="py-3 font-weight-bold">Jenis Kegiatan Ekstrakurikuler</th>
              <th style="width: 60%; vertical-align: middle;" class="py-3 font-weight-bold">Tujuan</th>
            </tr>
          </thead>
          <tbody class="text-dark">
            <!-- 1. Shalat Dhuha -->
            <tr>
              <td class="text-center font-weight-bold" style="vertical-align: middle;">1</td>
              <td style="vertical-align: middle;">
                <strong class="text-success" style="font-size: 1.02rem;">Shalat dhuha</strong>
              </td>
              <td style="vertical-align: middle; line-height: 1.7; font-size: 0.95rem;">
                Membiasakan ibadah sunnah, menumbuhkan kedisiplinan, serta menanamkan nilai spiritual dalam keseharian.
              </td>
            </tr>

            <!-- 2. Bacaan Surat-Surat Pendek -->
            <tr>
              <td class="text-center font-weight-bold" style="vertical-align: middle;">2</td>
              <td style="vertical-align: middle;">
                <strong class="text-success" style="font-size: 1.02rem;">Bacaan surat-surat pendek</strong>
              </td>
              <td style="vertical-align: middle; line-height: 1.7; font-size: 0.95rem;">
                Mengembangkan kemampuan membaca Al-Quran dengan tartil dan benar.
              </td>
            </tr>

            <!-- 3. Tari Tradisional -->
            <tr>
              <td class="text-center font-weight-bold" style="vertical-align: middle;">3</td>
              <td style="vertical-align: middle;">
                <strong class="text-success" style="font-size: 1.02rem;">Tari Tradisional</strong>
              </td>
              <td style="vertical-align: middle; line-height: 1.7; font-size: 0.95rem;">
                Melestarikan budaya daerah dan mengembangkan apresiasi seni tradisional.
              </td>
            </tr>

            <!-- 4. English for Kids -->
            <tr>
              <td class="text-center font-weight-bold" style="vertical-align: middle;">4</td>
              <td style="vertical-align: middle;">
                <strong class="text-success" style="font-size: 1.02rem;">English for Kids</strong>
              </td>
              <td style="vertical-align: middle; line-height: 1.7; font-size: 0.95rem;">
                Mengenalkan bahasa Inggris dasar melalui lagu dan permainan sederhana.
              </td>
            </tr>

            <!-- 5. Kamis Nyunda -->
            <tr>
              <td class="text-center font-weight-bold" style="vertical-align: middle;">5</td>
              <td style="vertical-align: middle;">
                <strong class="text-success" style="font-size: 1.02rem;">Kamis Nyunda</strong>
              </td>
              <td style="vertical-align: middle; line-height: 1.7; font-size: 0.95rem;">
                Mengenalkan undak usuk bahasa Sunda di hari Kamis serta menanamkan rasa cinta terhadap budaya lokal. Mengenalkan makanan tradisional.
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <!-- end ekskul section -->

  <!-- 4. Slogan Section -->
  <section class="cta_section layout_padding bg-light">
    <div class="container text-center">
      <!-- Slogan Bottom Banner -->
      <div class="text-center p-4 p-md-5 rounded-lg shadow-sm" style="background: linear-gradient(135deg, #25d366, #16a34a); color: #ffffff; border-radius: 18px;">
        <h4 class="font-weight-bold mb-2" style="letter-spacing: 0.5px;">
          "Belajar dengan cinta, bermain dengan gembira, tumbuh bersama menjadi generasi terbaik!"
        </h4>
        <p class="mb-0 text-white-50" style="font-size: 1rem;">
          Komitmen TK Harapan Bunda dalam menghadirkan lingkungan belajar anak usia dini yang bermakna dan penuh inspirasi.
        </p>
      </div>
    </div>
  </section>

@endsection

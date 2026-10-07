@extends('layouts.adward')

@section('title', 'TK Harapan Bunda - Tentang Kami')

@section('top_container')
  @include('adward.partials.navbar')
@endsection

@section('content')

  <!-- about section -->
  <section class="about_section layout_padding">
    <div class="container">
      <h2 class="main-heading">
        Tentang TK Harapan Bunda
      </h2>
      <p class="text-center">
        TK Harapan Bunda adalah lembaga pendidikan anak usia dini yang berfokus pada pengembangan kecerdasan, karakter, dan kreativitas anak.
      </p>
    </div>
  </section>
  <!-- about section -->

  <!-- visi misi section -->
  <section class="visi_misi_section layout_padding bg-light">
    <div class="container">
      <h2 class="main-heading">
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
                <i class="fa fa-eye mr-2"></i> Visi
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
                <i class="fa fa-bullseye mr-2"></i> Misi
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

@endsection

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
        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
      </p>
      <div class="about_img-box">
        <img src="{{ asset('adward/images/kids.jpg') }}" alt="" class="img-fluid w-100">
      </div>
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
          <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 15px; border-top: 5px solid #25d366 !important;">
            <div class="card-body">
              <h3 class="card-title text-success font-weight-bold mb-3">
                <i class="fa fa-eye mr-2"></i> Visi
              </h3>
              <p class="card-text">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 15px; border-top: 5px solid #25d366 !important;">
            <div class="card-body">
              <h3 class="card-title text-success font-weight-bold mb-3">
                <i class="fa fa-bullseye mr-2"></i> Misi
              </h3>
              <ul class="pl-3" style="line-height: 1.8;">
                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                <li>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
                <li>Ut enim ad minim veniam, quis nostrud exercitation ullamco.</li>
                <li>Duis aute irure dolor in reprehenderit in voluptate velit esse.</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end visi misi section -->

@endsection

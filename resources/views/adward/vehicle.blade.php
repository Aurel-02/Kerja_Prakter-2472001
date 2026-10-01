@extends('layouts.adward')

@section('title', 'TK Harapan Bunda - Fasilitas Kendaraan')

@section('top_container')
  @include('adward.partials.navbar')
@endsection

@section('content')

  <!-- vehicle section -->
  <section class="vehicle_section layout_padding">
    <div class="container">
      <h2 class="main-heading ">
        Fasilitas Kendaraan
      </h2>
      <p class="text-center">
        Fasilitas antar jemput anak-anak yang aman, nyaman, dan terpercaya.
      </p>
      <div class="layout_padding-top">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="vehicle_img-box ">
                <img src="{{ asset('adward/images/bus.png') }}" alt="" class="img-fluid w-100">
              </div>
            </div>
            <div class="carousel-item">
              <div class="vehicle_img-box ">
                <img src="{{ asset('adward/images/bus.png') }}" alt="" class="img-fluid w-100">
              </div>
            </div>
            <div class="carousel-item">
              <div class="vehicle_img-box ">
                <img src="{{ asset('adward/images/bus.png') }}" alt="" class="img-fluid w-100">
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Sebelumnya</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Berikutnya</span>
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- vehicle section -->

@endsection

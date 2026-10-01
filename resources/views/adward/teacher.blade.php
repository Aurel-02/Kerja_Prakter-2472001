@extends('layouts.adward')

@section('title', 'TK Harapan Bunda - Pengajar')

@section('top_container')
  @include('adward.partials.navbar')
@endsection

@section('content')

  <!-- teacher section -->
  <section class="teacher_section layout_padding-bottom">
    <div class="container">
      <h2 class="main-heading ">
        Pengajar Kami
      </h2>
      <p class="text-center">
        Guru-guru berpengalaman dan penuh kasih sayang yang siap membimbing anak-anak.
      </p>
      <div class="teacher_container layout_padding2">
        <div class="card-deck">
          <div class="card">
            <img class="card-img-top" src="{{ asset('adward/images/teacher-1.jpg') }}" alt="Foto Pengajar">
            <div class="card-body">
              <h5 class="card-title">Den Mark</h5>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top" src="{{ asset('adward/images/teacher-2.jpg') }}" alt="Foto Pengajar">
            <div class="card-body">
              <h5 class="card-title">Leena Jorj</h5>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top" src="{{ asset('adward/images/teacher-3.jpg') }}" alt="Foto Pengajar">
            <div class="card-body">
              <h5 class="card-title">Magi Den</h5>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top" src="{{ asset('adward/images/teacher-4.jpg') }}" alt="Foto Pengajar">
            <div class="card-body">
              <h5 class="card-title">Jonson Mark</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- teacher section -->

@endsection

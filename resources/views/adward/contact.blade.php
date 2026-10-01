@extends('layouts.adward')

@section('title', 'TK Harapan Bunda - Hubungi Kami')

@section('top_container')
  @include('adward.partials.navbar')
@endsection

@section('content')

  <!-- contact section -->
  <section class="contact_section layout_padding">
    <div class="container">
      <h2 class="main-heading">
        Hubungi Kami
      </h2>
      <p class="text-center">
        Kirimkan pesan atau pertanyaan Anda kepada tim TK Harapan Bunda.
      </p>
      <div class="">
        <div class="contact_section-container">
          <div class="row">
            <div class="col-md-6 mx-auto">
              <div class="contact-form">
                <form action="{{ route('contact.send') }}" method="POST">
                  @csrf
                  <div>
                    <input type="text" placeholder="Nama Lengkap" name="name">
                  </div>
                  <div>
                    <input type="text" placeholder="Nomor Telepon" name="phone">
                  </div>
                  <div>
                    <input type="email" placeholder="Email" name="email">
                  </div>
                  <div>
                    <input type="text" placeholder="Pesan" class="input_message" name="message">
                  </div>
                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn_on-hover">
                      Kirim
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end contact section -->

  <!-- map section -->
  <section class="map_section layout_padding-top">
    <div class="container text-center mb-4">
      <h2 class="main-heading">
        Lokasi TK Harapan Bunda
      </h2>
      <p class="text-center">
        Jl. Babakan Ciparay No.251, Sukahaji, Kec. Babakan Ciparay, Kota Bandung, Jawa Barat 40242
      </p>
    </div>
    <div class="container-fluid p-0">
      <iframe
        src="https://maps.google.com/maps?q=Jl.+Babakan+Ciparay+No.251,+Sukahaji,+Kec.+Babakan+Ciparay,+Kota+Bandung,+Jawa+Barat+40242&output=embed"
        width="100%"
        height="450"
        style="border:0;"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </section>
  <!-- end map section -->

@endsection

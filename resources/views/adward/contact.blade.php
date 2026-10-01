@extends('layouts.adward')

@section('title', 'Adward - Contact Us')

@section('top_container')
  @include('adward.partials.navbar')
@endsection

@section('content')

  <!-- contact section -->
  <section class="contact_section layout_padding">
    <div class="container">
      <h2 class="main-heading">
        Contact Now
      </h2>
      <p class="text-center">
        reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
      </p>
      <div class="">
        <div class="contact_section-container">
          <div class="row">
            <div class="col-md-6 mx-auto">
              <div class="contact-form">
                <form action="{{ route('contact.send') }}" method="POST">
                  @csrf
                  <div>
                    <input type="text" placeholder="Name" name="name">
                  </div>
                  <div>
                    <input type="text" placeholder="Phone Number" name="phone">
                  </div>
                  <div>
                    <input type="email" placeholder="Email" name="email">
                  </div>
                  <div>
                    <input type="text" placeholder="Message" class="input_message" name="message">
                  </div>
                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn_on-hover">
                      Send
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

@endsection

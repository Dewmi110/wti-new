@extends('frontend.components.layout')

@section('content')

<section class="hero-wrap hero-wrap-2"
  style="background-image: url('{{ asset(\Illuminate\Support\Facades\Storage::url($contactBanner->banner_image)) }}'); min-height: 85vh; position: relative;">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center" style="min-height: 85vh;">
      <div class="col-md-9 ftco-animate pb-5 text-center">
        <p class="breadcrumbs">
          <span class="mr-2"><a href="{{ route('frontend.index') }}">Home <i class="fa fa-chevron-right"></i></a></span>
          <span>Contact Us <i class="fa fa-chevron-right"></i></span>
        </p>
        <h1 class="mb-0 bread">Contact Us</h1>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section ftco-no-pb">
  <div class="container">
    <div class="row justify-content-center mb-2">

      <div class="col-md-4 ftco-animate mb-4">
        <div class="contact-info-box text-center">
          <div class="cib-icon mx-auto mb-3">
            <span class="fa fa-map-marker"></span>
          </div>
          <h5 class="cib-title">Our Location</h5>
          <p class="cib-text">321-4/1, 4th Floor Galle road,<br>Colombo 03, Sri Lanka</p>
        </div>
      </div>

      <div class="col-md-4 ftco-animate mb-4">
        <div class="contact-info-box text-center">
          <div class="cib-icon mx-auto mb-3">
            <span class="fa fa-phone"></span>
          </div>
          <h5 class="cib-title">Phone / WhatsApp</h5>
          <p class="cib-text">
            <a href="tel:+94777377956">+94 777 377 956</a><br>
            <a href="https://wa.me/94777377956" target="_blank" style="color:#25D366;font-weight:700;">
              <i class="fa fa-whatsapp"></i> WhatsApp Us
            </a>
          </p>
        </div>
      </div>

      <div class="col-md-4 ftco-animate mb-4">
        <div class="contact-info-box text-center">
          <div class="cib-icon mx-auto mb-3">
            <span class="fa fa-envelope"></span>
          </div>
          <h5 class="cib-title">Email Address</h5>
          <p class="cib-text">
            <a href="mailto:hello@wti.lk">hello@wti.lk</a><br>
            {{-- <a href="mailto:bookings@yourcompany.com">bookings@yourcompany.com</a> --}}
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

<section class="ftco-section">
  <div class="container">
    <div class="row">

      <div class="col-md-5 ftco-animate mb-5 mb-md-0 pr-md-5">

        <span class="contact-eyebrow">Get In Touch</span>
        <h2 class="contact-heading">
          Reach &amp; <span style="color:#DB1A1A;">Contact Us!</span>
        </h2>
        <p class="contact-subtext">
          Have a trip in mind? Fill out the enquiry form and our travel experts will
          get back to you within 24 hours with a personalised itinerary and quote.
        </p>

        <ul class="ftco-footer-social list-unstyled d-flex mb-4">
          <li><a href="#"><span class="fa fa-facebook"></span></a></li>
          <li><a href="#"><span class="fa fa-twitter"></span></a></li>
          <li><a href="#"><span class="fa fa-youtube-play"></span></a></li>
          <li><a href="#"><span class="fa fa-instagram"></span></a></li>
          <li><a href="#"><span class="fa fa-pinterest"></span></a></li>
        </ul>

        <div class="contact-map-wrap">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.7985657974297!2d79.8560045!3d6.9218374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2591614f2f0db%3A0x3f8f3c2e5e5e5e5e!2sColombo!5e0!3m2!1sen!2slk!4v1680000000000"
            width="100%" height="320" style="border:0;display:block;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>

      </div>

      {{-- ── RIGHT: enquiry form ── --}}
      <div class="col-md-7 ftco-animate">
        @include('frontend.enquiry_form')
      </div>
    </div>
  </div>
</section>

@endsection
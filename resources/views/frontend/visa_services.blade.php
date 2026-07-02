@extends('frontend.components.layout')
@php
    $meta_title = 'Visa Services | WTI Holidays';
    $meta_description = 'Get in touch with WTI Holidays for personalised visa services, including tourist, business, and student visas. Apply for your travel documents with our expert assistance.';
    $meta_keywords = 'visa services, travel documents, tourist visa, business visa, student visa, WTI holidays';
@endphp

@section('content')
<section class="hero-wrap hero-wrap-2"
  style="background-image: url('{{ $visaServicesBanner && $visaServicesBanner->banner_image ? \Illuminate\Support\Facades\Storage::url($visaServicesBanner->banner_image) : asset('images/hero-bg-1.jpg') }}'); min-height: 85vh; position: relative;">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center" style="min-height: 85vh;">
      <div class="col-md-9 ftco-animate pb-5 text-center">
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('frontend.index') }}">Home <i
                class="fa fa-chevron-right"></i></a></span> <span>Services <i class="fa fa-chevron-right"></i></span></p>
        <h1 class="mb-0 bread">Visa Services</h1>
      </div>
    </div>
  </div>
  </div>
</section>

<section class="ftco-section ftco-section--intro bg-white">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 text-center ftco-animate">
        <span class="service-eyebrow">What We Offer</span>
          @if($visaServices)
              <h2 class="service-title">{{ $visaServices->title }}</h2>

              <p class="service-description">
                  {{ $visaServices->description }}
              </p>
          @endif
      </div>
    </div>
  </div>
</section>
 
{{-- ═══════════════════════════════════════════
     SERVICE CARDS
═══════════════════════════════════════════ --}}
<section class="ftco-section ftco-section--cards bg-light-grey">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-7 text-center ftco-animate">
        <span class="service-eyebrow">Our Services</span>
        <h2 class="section-heading">Types of Visas We Offer</h2>
      </div>
    </div>

    <div class="row sc-row">

      {{-- Card 1 --}}
      <div class="col-md-4 mb-4">
        <div class="sc-wrap">
          <div class="sc-inner">
            <div class="sc-icon-box"><i class="fa fa-plane"></i></div>
            <h3 class="sc-title">Tourist Visas</h3>
            <p class="sc-text">For leisure and short-term travel.</p>
            {{-- <a href="#" class="sc-link">Explore Routes <i class="fa fa-arrow-right"></i></a> --}}
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="sc-wrap sc-wrap--featured">
          <div class="sc-inner sc-inner--featured">
            <div class="sc-icon-box"><i class="fa fa-globe"></i></div>
            <h3 class="sc-title">Business Visas</h3>
            <p class="sc-text">For corporate travelers and conferences.</p>
            {{-- <a href="#" class="sc-link">View Destinations <i class="fa fa-arrow-right"></i></a> --}}
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="sc-wrap sc-wrap--featured">
          <div class="sc-inner sc-inner--featured">
            <div class="sc-icon-box"><i class="fa fa-globe"></i></div>
            <h3 class="sc-title">Student Visas</h3>
            <p class="sc-text">For study and academic purposes.</p>
            {{-- <a href="#" class="sc-link">View Destinations <i class="fa fa-arrow-right"></i></a> --}}
          </div>
        </div>
      </div>

     
      <div class="col-md-4 mb-4">
        <div class="sc-wrap">
          <div class="sc-inner">
            <div class="sc-icon-box"><i class="fa fa-star"></i></div>
            <h3 class="sc-title">Transit Visas</h3>
            <p class="sc-text">For stopovers between flights.</p>
            {{-- <a href="#" class="sc-link">Learn More <i class="fa fa-arrow-right"></i></a> --}}
          </div>
        </div>
      </div>
    </div>{{-- /.row --}}
  </div>
</section>

{{-- ═══════════════════════════════════════════
     AIRLINE PARTNERS LOGO SLIDER
═══════════════════════════════════════════ --}}
<section class="ftco-section ftco-section--partners bg-white">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-7 text-center ftco-animate">
        <span class="service-eyebrow">Trusted Partners</span>
        <h2 class="section-heading">Airlines We Work With</h2>
      </div>
    </div>
    <div class="row ftco-animate">
      <div class="col-12">
        <div class="partner-slider owl-carousel">

          <div class="partner-logo">
            <img src="{{ asset('images/country/aus.webp') }}" alt="Emirates">
          </div>
          <div class="partner-logo">
            <img src="{{ asset('images/country/canada.svg') }}" alt="Qatar Airways">
          </div>
          <div class="partner-logo">
            <img src="{{ asset('images/country/india.webp') }}" alt="Singapore Airlines">
          </div>
          <div class="partner-logo">
            <img src="{{ asset('images/country/iran.png') }}" alt="Etihad Airways">
          </div>
          <div class="partner-logo">
            <img src="{{ asset('images/country/kuwait.png') }}" alt="Lufthansa">
          </div>
          <div class="partner-logo">
            <img src="{{ asset('images/country/oman.png') }}" alt="Turkish Airlines">
          </div>
          <div class="partner-logo">
            <img src="{{ asset('images/country/qatar.svg') }}" alt="British Airways">
          </div>
          <div class="partner-logo">
            <img src="{{ asset('images/country/saudi.webp') }}" alt="AirAsia">
          </div>
          <div class="partner-logo">
            <img src="{{ asset('images/country/Singapore.png') }}" alt="AirAsia">
          </div>
          <div class="partner-logo">
            <img src="{{ asset('images/country/turkey.webp') }}" alt="AirAsia">
          </div>
          <div class="partner-logo">
            <img src="{{ asset('images/country/uae.png') }}" alt="AirAsia">
          </div>
          <div class="partner-logo">
            <img src="{{ asset('images/country/uk.webp') }}" alt="AirAsia">
          </div>
          <div class="partner-logo">
            <img src="{{ asset('images/country/usa.webp') }}" alt="AirAsia">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ═══════════════════════════════════════════
     SUB BANNER / CTA
═══════════════════════════════════════════ --}}
<section class="sub-banner"
  style="background-image: url('{{ asset('images/bg_2.jpg') }}');">
  <div class="sub-banner__overlay"></div>
  <div class="sub-banner__plane-deco"><i class="fa fa-plane"></i></div>
  <div class="container">
    <div class="row align-items-center justify-content-between">
      <div class="col-md-7 ftco-animate">
        <span class="sub-banner__eyebrow">Ready to Take Off?</span>
        <h2 class="sub-banner__heading">Your next adventure is one click away.</h2>
        <p class="sub-banner__text">
          Tell us where you want to go and we'll handle the rest —
          the best seats, the best prices, and a team on call from departure to arrival.
        </p>
      </div>
      <div class="col-md-4 text-md-right ftco-animate">
        <a href="{{ route('frontend.contact') }}" class="btn-sub-banner btn-sub-banner--primary">
          Book Now <i class="fa fa-plane ml-2"></i>
        </a>
        <a href="{{ route('frontend.contact') }}" class="btn-sub-banner btn-sub-banner--ghost mt-3">
          Talk to an Agent
        </a>
      </div>
    </div>
  </div>
</section>

@endsection


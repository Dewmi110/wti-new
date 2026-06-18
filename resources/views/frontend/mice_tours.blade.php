@extends('frontend.components.layout')

@section('content')
<section class="hero-wrap hero-wrap-2"
  style="background-image: url('images/bg_6.jpg'); min-height: 85vh; position: relative;">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center" style="min-height: 85vh;">
      <div class="col-md-9 ftco-animate pb-5 text-center">
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('frontend.index') }}">Home <i
                class="fa fa-chevron-right"></i></a></span> <span>Services <i class="fa fa-chevron-right"></i></span></p>
        <h1 class="mb-0 bread">MICE Tours</h1>
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
        <h2 class="service-title">Fly Anywhere, <span class="service-title__accent">Hassle-Free</span></h2>
        <p class="service-description">
          We take the stress out of booking air travel. Whether you're planning a business trip, a family holiday,
          or a solo adventure, our team finds the best routes and fares so you arrive relaxed — before the journey even begins.
          Enjoy flexible booking, 24/7 support, and competitive prices on thousands of destinations worldwide.
        </p>
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
        <h2 class="section-heading">Everything You Need in One Place</h2>
      </div>
    </div>

    <div class="row sc-row">

      {{-- Card 1 --}}
      <div class="col-md-4 mb-4">
        <div class="sc-wrap">
          <div class="sc-inner">
            <div class="sc-icon-box"><i class="fa fa-plane"></i></div>
            <h3 class="sc-title">Domestic Flights</h3>
            <p class="sc-text">Quick connections across all major local airports. We compare dozens of airlines in seconds to get you the lowest available fare on your schedule.</p>
            <a href="#" class="sc-link">Explore Routes <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
      </div>

   
      {{-- <div class="col-md-4 mb-4">
        <div class="sc-wrap sc-wrap--featured">
          <div class="sc-inner sc-inner--featured">
            <div class="sc-icon-box"><i class="fa fa-globe"></i></div>
            <h3 class="sc-title">International Flights</h3>
            <p class="sc-text">Fly to over 150 countries with premium carriers and budget airlines alike. Multi-city routing, stopovers, and open-jaw tickets — all in one booking.</p>
            <a href="#" class="sc-link">View Destinations <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
      </div>

     
      <div class="col-md-4 mb-4">
        <div class="sc-wrap">
          <div class="sc-inner">
            <div class="sc-icon-box"><i class="fa fa-star"></i></div>
            <h3 class="sc-title">Business & First Class</h3>
            <p class="sc-text">Upgrade your journey with lie-flat seats, priority boarding, and premium lounges. We handle all the details so you can focus on what matters.</p>
            <a href="#" class="sc-link">Learn More <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
      </div>

    
      <div class="col-md-4 mb-4">
        <div class="sc-wrap">
          <div class="sc-inner">
            <div class="sc-icon-box"><i class="fa fa-clock-o"></i></div>
            <h3 class="sc-title">Last-Minute Deals</h3>
            <p class="sc-text">Spontaneous traveller? We track flash sales and unsold seats daily, so you get the best price even when you book 24 hours before departure.</p>
            <a href="#" class="sc-link">See Today's Deals <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
      </div>

     
      <div class="col-md-4 mb-4">
        <div class="sc-wrap">
          <div class="sc-inner">
            <div class="sc-icon-box"><i class="fa fa-users"></i></div>
            <h3 class="sc-title">Group Bookings</h3>
            <p class="sc-text">Travelling with 10 or more? Our group specialists negotiate block-rate seats, manage name changes, and keep your whole party together.</p>
            <a href="#" class="sc-link">Request a Quote <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
      </div>

      
      <div class="col-md-4 mb-4">
        <div class="sc-wrap">
          <div class="sc-inner">
            <div class="sc-icon-box"><i class="fa fa-shield"></i></div>
            <h3 class="sc-title">Flexible & Refundable</h3>
            <p class="sc-text">Plans change. We offer fully refundable fares and free date-change options so you can book with confidence no matter what comes up.</p>
            <a href="#" class="sc-link">Check Policy <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
      </div> --}}

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
            <img src="{{ asset('images/airlines/emirates.png') }}" alt="Emirates">
          </div>
          <div class="partner-logo">
            <img src="{{ asset('images/airlines/qatar.png') }}" alt="Qatar Airways">
          </div>
          <div class="partner-logo">
            <img src="{{ asset('images/airlines/singapore.png') }}" alt="Singapore Airlines">
          </div>
          <div class="partner-logo">
            <img src="{{ asset('images/airlines/etihad.png') }}" alt="Etihad Airways">
          </div>
          <div class="partner-logo">
            <img src="{{ asset('images/airlines/lufthansa.png') }}" alt="Lufthansa">
          </div>
          <div class="partner-logo">
            <img src="{{ asset('images/airlines/turkish.png') }}" alt="Turkish Airlines">
          </div>
          <div class="partner-logo">
            <img src="{{ asset('images/airlines/british.png') }}" alt="British Airways">
          </div>
          <div class="partner-logo">
            <img src="{{ asset('images/airlines/airasia.png') }}" alt="AirAsia">
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


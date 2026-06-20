@extends('frontend.components.layout')

@section('content')
<section class="hero-wrap hero-wrap-2"
  style="background-image: url('{{ $corporateBanner && $corporateBanner->banner_image ? \Illuminate\Support\Facades\Storage::url($corporateBanner->banner_image) : asset('images/hero-bg-1.jpg') }}'); min-height: 85vh; position: relative;">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center" style="min-height: 85vh;">
      <div class="col-md-9 ftco-animate pb-5 text-center">
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('frontend.index') }}">Home <i
                class="fa fa-chevron-right"></i></a></span> <span>Services <i class="fa fa-chevron-right"></i></span></p>
        <h1 class="mb-0 bread">{{ $corporateBanner->title ?? 'Corporate Travel Solutions by WTI' }}</h1>
      </div>
    </div>
  </div>
</section>
<section class="ftco-section ftco-section--intro bg-white">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 text-center ftco-animate">
        {{-- <span class="service-eyebrow">What We Offer</span>
        <h2 class="service-title">Fly Anywhere, <span class="service-title__accent">Hassle-Free</span></h2> --}}
        <p class="service-description">
          {{ $corporateBanner->description }}
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
        <h2 class="section-heading">Why Choose WTI for Corporate Travel?</h2>
      </div>
    </div>

    <div class="row sc-row">

      {{-- Card 1 --}}
      <div class="col-md-4 mb-4">
        <div class="sc-wrap">
          <div class="sc-inner">
            <div class="sc-icon-box"><i class="fa fa-plane"></i></div>
            <h3 class="sc-title">Customized Travel Management</h3>
            <p class="sc-text">We understand that every business has unique travel requirements. Our team offers fully customized corporate travel solutions to align with your company’s policies, budgets, and preferences.</p>
            {{-- <a href="#" class="sc-link">Explore Routes <i class="fa fa-arrow-right"></i></a> --}}
          </div>
        </div>
      </div>

   
      <div class="col-md-4 mb-4">
        <div class="sc-wrap sc-wrap--featured">
          <div class="sc-inner sc-inner--featured">
            <div class="sc-icon-box"><i class="fa fa-globe"></i></div>
            <h3 class="sc-title">Dedicated Account Manager</h3>
            <p class="sc-text">Each corporate client is assigned a dedicated travel expert to handle all bookings, manage itineraries, and provide 24/7 support for any travel emergencies.</p>
            {{-- <a href="#" class="sc-link">View Destinations <i class="fa fa-arrow-right"></i></a> --}}
          </div>
        </div>
      </div>

     
      <div class="col-md-4 mb-4">
        <div class="sc-wrap">
          <div class="sc-inner">
            <div class="sc-icon-box"><i class="fa fa-star"></i></div>
            <h3 class="sc-title">Exclusive Corporate Rates & Discounts</h3>
            <p class="sc-text">Our partnerships with leading airlines, hotels, and transport providers allow us to secure the best corporate rates, discounts, and perks for our clients.</p>
            {{-- <a href="#" class="sc-link">Learn More <i class="fa fa-arrow-right"></i></a> --}}
          </div>
        </div>
      </div>

    
      <div class="col-md-4 mb-4">
        <div class="sc-wrap">
          <div class="sc-inner">
            <div class="sc-icon-box"><i class="fa fa-clock-o"></i></div>
            <h3 class="sc-title">Seamless Flight & Hotel Bookings</h3>
            <p class="sc-text">We offer a one-stop solution for booking domestic and international flights, premium hotels, serviced apartments, and conference venues at competitive prices.</p>
            {{-- <a href="#" class="sc-link">See Today's Deals <i class="fa fa-arrow-right"></i></a> --}}
          </div>
        </div>
      </div>

     
      <div class="col-md-4 mb-4">
        <div class="sc-wrap">
          <div class="sc-inner">
            <div class="sc-icon-box"><i class="fa fa-users"></i></div>
            <h3 class="sc-title">Visa Assistance & Documentation</h3>
            <p class="sc-text">Need quick visa processing for business trips? Our experts handle visa applications, documentation, and embassy coordination for your team.</p>
            {{-- <a href="#" class="sc-link">Request a Quote <i class="fa fa-arrow-right"></i></a> --}}
          </div>
        </div>
      </div>

      
      <div class="col-md-4 mb-4">
        <div class="sc-wrap">
          <div class="sc-inner">
            <div class="sc-icon-box"><i class="fa fa-shield"></i></div>
            <h3 class="sc-title">MICE & Corporate Events Management</h3>
            <p class="sc-text">From international business conferences to incentive tours and product launches, we manage corporate meetings, incentives, conventions, and exhibitions (MICE) with precision.</p>
            {{-- <a href="#" class="sc-link">Check Policy <i class="fa fa-arrow-right"></i></a> --}}
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="sc-wrap">
          <div class="sc-inner">
            <div class="sc-icon-box"><i class="fa fa-shield"></i></div>
            <h3 class="sc-title">24/7 Travel Support</h3>
            <p class="sc-text">Business travel comes with unexpected challenges. Our team is available 24/7 to handle lastminute changes, cancellations, or emergency travel needs.</p>
            {{-- <a href="#" class="sc-link">Check Policy <i class="fa fa-arrow-right"></i></a> --}}
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="sc-wrap">
          <div class="sc-inner">
            <div class="sc-icon-box"><i class="fa fa-shield"></i></div>
            <h3 class="sc-title">Comprehensive Travel Reports & Cost Analysis</h3>
            <p class="sc-text">We provide detailed reports and analytics on corporate travel expenses, helping companies track budgets, optimize spending, and improve cost efficiency.</p>
            {{-- <a href="#" class="sc-link">Check Policy <i class="fa fa-arrow-right"></i></a> --}}
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


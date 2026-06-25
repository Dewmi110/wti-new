@extends('frontend.components.layout')

@section('content')
<section class="hero-wrap hero-wrap-2"
style="background-image: url('{{ $miceToursBanner && $miceToursBanner->banner_image ? \Illuminate\Support\Facades\Storage::url($miceToursBanner->banner_image) : asset('images/hero-bg-1.jpg') }}'); min-height: 85vh; position: relative;">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center" style="min-height: 85vh;">
      <div class="col-md-9 ftco-animate pb-5 text-center">
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('frontend.index') }}">Home <i
                class="fa fa-chevron-right"></i></a></span> <span>Services <i class="fa fa-chevron-right"></i></span></p>
        <h1 class="mb-0 bread">MICE</h1>
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
        @if($miceTours)
            <h2 class="service-title">{{ $miceTours->title }}</h2>

            <p class="service-description">
                {{ $miceTours->description }}
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
        <h2 class="section-heading">Our Sri Lanka MICE Services</h2>
      </div>
    </div>

    <div class="row sc-row">

      {{-- Card 1 --}}
      <div class="col-md-4 mb-4">
        <div class="sc-wrap">
          <div class="sc-inner">
            <div class="sc-icon-box"><i class="fa fa-plane"></i></div>
            <h3 class="sc-title">Corporate Meetings & Executive Retreats</h3>
            <p class="sc-text">Organize board meetings, leadership summits, and exclusive retreats in luxury hotels or eco-friendly resorts.</p>
            {{-- <a href="#" class="sc-link">Explore Routes <i class="fa fa-arrow-right"></i></a> --}}
          </div>
        </div>
      </div>

   
      <div class="col-md-4 mb-4">
        <div class="sc-wrap sc-wrap--featured">
          <div class="sc-inner sc-inner--featured">
            <div class="sc-icon-box"><i class="fa fa-globe"></i></div>
            <h3 class="sc-title">Incentive Travel Programs</h3>
            <p class="sc-text">Reward top-performing employees with customized incentive trips, adventure tourism, or wellness retreats.</p>
            {{-- <a href="#" class="sc-link">View Destinations <i class="fa fa-arrow-right"></i></a> --}}
          </div>
        </div>
      </div>

     
      <div class="col-md-4 mb-4">
        <div class="sc-wrap">
          <div class="sc-inner">
            <div class="sc-icon-box"><i class="fa fa-star"></i></div>
            <h3 class="sc-title">Conferences & Conventions</h3>
            <p class="sc-text">Full-scale management, from venue selection to speaker coordination, for international conferences and seminars.</p>
            {{-- <a href="#" class="sc-link">Learn More <i class="fa fa-arrow-right"></i></a> --}}
          </div>
        </div>
      </div>

    
      <div class="col-md-4 mb-4">
        <div class="sc-wrap">
          <div class="sc-inner">
            <div class="sc-icon-box"><i class="fa fa-clock-o"></i></div>
            <h3 class="sc-title">Exhibitions & Trade Shows</h3>
            <p class="sc-text">Design, logistics, and exhibitor support for large-scale expos and networking events.</p>
            {{-- <a href="#" class="sc-link">See Today's Deals <i class="fa fa-arrow-right"></i></a> --}}
          </div>
        </div>
      </div>

     
      <div class="col-md-4 mb-4">
        <div class="sc-wrap">
          <div class="sc-inner">
            <div class="sc-icon-box"><i class="fa fa-users"></i></div>
            <h3 class="sc-title">Team-Building & Outdoor Activities</h3>
            <p class="sc-text">Curate unique experiences such as safari retreats, cultural tours, and adventure sports for corporate teams.</p>
            {{-- <a href="#" class="sc-link">Request a Quote <i class="fa fa-arrow-right"></i></a> --}}
          </div>
        </div>
      </div>

      
      {{-- <div class="col-md-4 mb-4">
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
{{-- <section class="ftco-section ftco-section--partners bg-white">
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
</section> --}}

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


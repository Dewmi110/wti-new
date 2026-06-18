@extends('frontend.components.layout')

@section('content')
<div class="hero-wrap js-fullheight owl-carousel">
    @foreach ($imageSliders as $slider)
    <div class="hero-slide js-fullheight"
        style="background-image: url('{{ Storage::url($slider->image_path) }}'); background-position: center; background-size: cover;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
                <div class="col-md-7 ftco-animate">
                    <span class="subheading"
                        style="background: rgba(255, 255, 255, 0.9); color: #e11d2e; display: inline-block; padding: 12px 24px; line-height: 1;">
                        {{ $slider->header ?? 'Explore Handpicked Tours' }}</span>
                   
                    <h1 class="mb-4">{{ $slider->title ?? 'Unforgettable Journeys Await' }}</h1>
                    <p class="caps">{{ $slider->description ?? 'Find curated packages and authentic experiences.' }}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    {{-- <div class="hero-slide js-fullheight"
        style="background-image: url('{{ asset('images/hero-slider/slider7.jpg') }}'); background-position: center; background-size: cover;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
                <div class="col-md-7 ftco-animate">
                    <span class="subheading"
                        style="background: rgba(255, 255, 255, 0.9); color: #e11d2e; display: inline-block; padding: 12px 24px; line-height: 1;">Explore
                        Handpicked Tours</span>
                    <h1 class="mb-4">Unforgettable Journeys Await</h1>
                    <p class="caps">Find curated packages and authentic experiences.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-slide js-fullheight"
        style="background-image: url('{{ asset('images/hero-slider/slider3.jpg') }}'); background-position: center; background-size: cover;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
                <div class="col-md-7 ftco-animate">
                    <span class="subheading"
                        style="background: rgba(255, 255, 255, 0.9); color: #e11d2e; display: inline-block; padding: 12px 24px; line-height: 1;">Travel
                        With Confidence</span>
                    <h1 class="mb-4">Safe, Seamless & Memorable</h1>
                    <p class="caps">Let us handle the details while you make memories.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-slide js-fullheight"
        style="background-image: url('{{ asset('images/hero-slider/slider4.jpg') }}'); background-position: center; background-size: cover;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
                <div class="col-md-7 ftco-animate">
                    <span class="subheading"
                        style="background: rgba(255, 255, 255, 0.9); color: #e11d2e; display: inline-block; padding: 12px 24px; line-height: 1;">Amazing
                        Destinations</span>
                    <h1 class="mb-4">Create Lasting Memories</h1>
                    <p class="caps">Experience the beauty and culture of the world.</p>
                </div>
            </div>
        </div>
    </div> --}}
</div>

<section class="ftco-section ftco-no-pb ftco-no-pt">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="ftco-search d-flex justify-content-center">
                    <div class="row">
                        <div class="col-md-12 nav-link-wrap">
                            <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                {{-- <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill"
                                    href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Search
                                    Tour</a>

                                <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab"
                                    aria-controls="v-pills-2" aria-selected="false">Hotel</a> --}}
                            </div>
                        </div>
                        <div class="col-md-12 tab-wrap">

                            <div class="tab-content" id="v-pills-tabContent">

                                <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel"
                                    aria-labelledby="v-pills-nextgen-tab">
                                    <form action="#" class="search-property-1">
                                        <div class="row no-gutters">
                                            <div class="col-md d-flex">
                                                <div class="form-group p-4 border-0">
                                                    <label for="#">Destination</label>
                                                    <div class="form-field">
                                                        <div class="icon"><span class="fa fa-search"></span></div>
                                                        <input type="text" class="form-control"
                                                            placeholder="Search place">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md d-flex">
                                                <div class="form-group p-4">
                                                    <label for="#">Check-in date</label>
                                                    <div class="form-field">
                                                        <div class="icon"><span class="fa fa-calendar"></span></div>
                                                        <input type="text" class="form-control checkin_date"
                                                            placeholder="Check In Date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md d-flex">
                                                <div class="form-group p-4">
                                                    <label for="#">Check-out date</label>
                                                    <div class="form-field">
                                                        <div class="icon"><span class="fa fa-calendar"></span></div>
                                                        <input type="text" class="form-control checkout_date"
                                                            placeholder="Check Out Date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md d-flex">
                                                <div class="form-group p-4">
                                                    <label for="#">Price Limit</label>
                                                    <div class="form-field">
                                                        <div class="select-wrap">
                                                            <div class="icon"><span class="fa fa-chevron-down"></span>
                                                            </div>
                                                            <select name="" id="" class="form-control">
                                                                <option value="">$100</option>
                                                                <option value="">$10,000</option>
                                                                <option value="">$50,000</option>
                                                                <option value="">$100,000</option>
                                                                <option value="">$200,000</option>
                                                                <option value="">$300,000</option>
                                                                <option value="">$400,000</option>
                                                                <option value="">$500,000</option>
                                                                <option value="">$600,000</option>
                                                                <option value="">$700,000</option>
                                                                <option value="">$800,000</option>
                                                                <option value="">$900,000</option>
                                                                <option value="">$1,000,000</option>
                                                                <option value="">$2,000,000</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md d-flex">
                                                <div class="form-group d-flex w-100 border-0">
                                                    <div class="form-field w-100 align-items-center d-flex">
                                                        <input type="submit" value="Search"
                                                            class="align-self-stretch form-control btn btn-primary">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="v-pills-2" role="tabpanel"
                                    aria-labelledby="v-pills-performance-tab">
                                    <form action="#" class="search-property-1">
                                        <div class="row no-gutters">
                                            <div class="col-lg d-flex">
                                                <div class="form-group p-4 border-0">
                                                    <label for="#">Destination</label>
                                                    <div class="form-field">
                                                        <div class="icon"><span class="fa fa-search"></span></div>
                                                        <input type="text" class="form-control"
                                                            placeholder="Search place">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg d-flex">
                                                <div class="form-group p-4">
                                                    <label for="#">Check-in date</label>
                                                    <div class="form-field">
                                                        <div class="icon"><span class="fa fa-calendar"></span></div>
                                                        <input type="text" class="form-control checkin_date"
                                                            placeholder="Check In Date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg d-flex">
                                                <div class="form-group p-4">
                                                    <label for="#">Check-out date</label>
                                                    <div class="form-field">
                                                        <div class="icon"><span class="fa fa-calendar"></span></div>
                                                        <input type="text" class="form-control checkout_date"
                                                            placeholder="Check Out Date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg d-flex">
                                                <div class="form-group p-4">
                                                    <label for="#">Price Limit</label>
                                                    <div class="form-field">
                                                        <div class="select-wrap">
                                                            <div class="icon"><span class="fa fa-chevron-down"></span>
                                                            </div>
                                                            <select name="" id="" class="form-control">
                                                                <option value="">$100</option>
                                                                <option value="">$10,000</option>
                                                                <option value="">$50,000</option>
                                                                <option value="">$100,000</option>
                                                                <option value="">$200,000</option>
                                                                <option value="">$300,000</option>
                                                                <option value="">$400,000</option>
                                                                <option value="">$500,000</option>
                                                                <option value="">$600,000</option>
                                                                <option value="">$700,000</option>
                                                                <option value="">$800,000</option>
                                                                <option value="">$900,000</option>
                                                                <option value="">$1,000,000</option>
                                                                <option value="">$2,000,000</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg d-flex">
                                                <div class="form-group d-flex w-100 border-0">
                                                    <div class="form-field w-100 align-items-center d-flex">
                                                        <input type="submit" value="Search"
                                                            class="align-self-stretch form-control btn btn-primary p-0">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<section class="ftco-section img ftco-select-destination" style="background-image: url(images/bg_12.png);">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Get Your Best Experience</span>
                <h2 class="mb-1">Select Your Destination</h2>
                <p class="caps">Travel to the any corner of the world, without going around in circles</p>
            </div>
        </div>
    </div>
    <div class="container container-2">
        <div class="row">
            <div class="col-md-3 col-sm-12 ftco-animate">
                <div class="text-center mt-4">
                    {{-- <p><a href="{{ route('frontend.visit_to_srilanka') }}" class="btn btn-primary py-3 px-5">Search
                            Destination</a></p> --}}
                </div>
            </div>
            <div class="col-md-12 col-sm-12 ftco-animate">
                <div class="carousel-destination owl-carousel ftco-animate">
                    @php
                    $displayDestinations = $destinations->take(6);
                    $displayCount = $displayDestinations->count();
                    @endphp

                    @if ($displayCount > 0)
                    @foreach ($displayDestinations as $destination)
                    <div class="item">
                        <div class="destination-card-v4">
                            <a href="{{ route('frontend.visit_to_srilanka') }}" class="destination-card-v4__media">
                                <img src="{{ $destination->image ? asset('storage/' . $destination->image) : asset('images/place-1.jpg') }}"
                                    alt="{{ $destination->name }}" class="destination-card-v4__image">
                                <span class="destination-card-v4__badge">
                                    @for ($star = 0; $star < 5; $star++) <i class="fa fa-star"></i>
                                        @endfor
                                </span>
                            </a>
                            <div class="destination-card-v4__body">
                                <span class="destination-card-v4__eyebrow">{{
                                    strtoupper(optional($destination->country)->name ?? 'DESTINATION') }}</span>
                                <h3 class="destination-card-v4__title">{{ $destination->name }}</h3>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @for ($i = $displayCount; $i < 6; $i++) <div class="item">
                        <div class="destination-card-v4 destination-card-v4--empty">
                            <div class="destination-card-v4__body">
                                <span class="destination-card-v4__eyebrow">DESTINATION</span>
                                <h3 class="destination-card-v4__title">Coming Soon</h3>
                            </div>
                        </div>
                </div>
                @endfor
                @else
                @for ($i = 0; $i < 6; $i++) <div class="item">
                    <div class="destination-card-v4 destination-card-v4--empty">
                        <div class="destination-card-v4__body">
                            <span class="destination-card-v4__eyebrow">DESTINATION</span>
                            <h3 class="destination-card-v4__title">No destinations yet</h3>
                            <p class="destination-card-v4__text">Add active destinations from the admin panel to show
                                them here.</p>
                        </div>
                    </div>
            </div>
            @endfor
            @endif
        </div>
    </div>

    </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Find Your Destinations Here</span>
                <h2 class="mb-1">Tour Packages</h2>
                <p class="cap">Discover our most popular tour packages and create unforgettable memories.</p>
            </div>
        </div>
        <div class="row">
            @if ($tours->isNotEmpty())
            @foreach ($tours as $tour)
            @php
            $coverImagePath = $tour->banner_img_path ?: $tour->images->first()?->img_path;
            $coverImageUrl = $coverImagePath ? \Illuminate\Support\Facades\Storage::url($coverImagePath) :
            asset('images/destination-1.jpg');
            $displayPrice = $tour->discount_price ?: $tour->price;
            $locationName = optional($tour->countryModel)->name ?? 'Sri Lanka';
            $features = is_array($tour->features) ? $tour->features : [];
            @endphp

            <div class="col-md-3 ftco-animate mb-4">
                <div class="tour-card-v3">

                    {{-- Full-bleed background image --}}
                    <div class="tour-card-v3__img" style="background-image: url('{{ $coverImageUrl }}');"></div>

                    {{-- White slide-up panel --}}
                    <div class="tour-card-v3__footer">

                        {{-- Scrollable content inside panel --}}
                        <div class="tour-card-v3__footer-inner">

                            <div class="tour-card-v3__footer-top">
                                <div style="min-width: 0;">
                                    <h3 class="tour-card-v3__title">
                                        <a href="{{ route('frontend.single_tour', $tour) }}">{{ $tour->title
                                            }}</a>
                                    </h3>
                                    <p class="tour-card-v3__subtitle">{{ $tour->duration }} Nights, {{
                                        $locationName }}</p>
                                </div>
                                {{-- <span class="tour-card-v3__toggle-icon">&#8743;</span> --}}
                            </div>

                            <div class="tour-card-v3__icons">
                                <span title="Accommodation"><i class="fa fa-building-o"></i></span>
                                <span title="Flights"><i class="fa fa-plane"></i></span>
                                <span title="Transport"><i class="fa fa-car"></i></span>
                                <span title="WiFi"><i class="fa fa-wifi"></i></span>
                            </div>

                            <div class="tour-card-v3__details">
                                @if(!empty($features))
                                @foreach ($features as $feature)
                                @if(!empty($feature['label']))
                                <p>- {{ strtoupper($feature['label']) }}</p>
                                @endif
                                @endforeach
                                @else
                                <p>No features listed.</p>
                                @endif
                            </div>

                        </div>{{-- end footer-inner --}}
                        {{-- Bottom bar OUTSIDE footer-inner so sticky works --}}
                        <div class="tour-card-v3__bottom">
                            <div class="tour-card-v3__price-wrap">
                                <span class="tour-card-v3__nights">{{ $tour->duration }} Nights</span>
                                <span class="tour-card-v3__price">From ${{ number_format((float) $displayPrice,
                                    0) }} PP</span>
                            </div>
                            <a href="{{ route('frontend.single_tour', $tour) }}" class="tour-card-v3__btn">VIEW
                                DEAL</a>
                        </div>
                    </div>{{-- end footer --}}
                </div>
            </div>
            @endforeach
            @else
            <div class="col-12">
                <p class="text-center mb-0">No tours are available right now.</p>
            </div>
            @endif
        </div>
    </div>
</section>

<section class="ftco-section ftco-section--parallax">
    <div class="ftco-section__parallax-bg" id="parallaxBg"></div>
    <div class="ftco-section__overlay"></div>
    <div class="container" style="position: relative; z-index: 2;">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Find Your Destinations Here</span>
                <h2 class="mb-1">Featured Tours</h2>
                <p class="cap">Discover our most popular tour packages and create unforgettable memories.</p>
            </div>
        </div>
        <div class="row">
            @if ($featured_tours->isNotEmpty())
            @foreach ($featured_tours as $featured_tour)
            @php
            $coverImagePath = $featured_tour->banner_img_path ?: $featured_tour->images->first()?->img_path;
            $coverImageUrl = $coverImagePath ? \Illuminate\Support\Facades\Storage::url($coverImagePath) :
            asset('images/destination-1.jpg');
            $displayPrice = $featured_tour->discount_price ?: $featured_tour->price;
            $locationName = optional($featured_tour->countryModel)->name ?? 'Sri Lanka';
            $features = is_array($featured_tour->features) ? $featured_tour->features : [];
            @endphp

            <div class="col-md-3 ftco-animate mb-4">
                <div class="tour-card-v3">

                    {{-- Full-bleed background image --}}
                    <div class="tour-card-v3__img" style="background-image: url('{{ $coverImageUrl }}');"></div>

                    {{-- White slide-up panel --}}
                    <div class="tour-card-v3__footer">

                        {{-- Scrollable content inside panel --}}
                        <div class="tour-card-v3__footer-inner">

                            <div class="tour-card-v3__footer-top">
                                <div style="min-width: 0;">
                                    <h3 class="tour-card-v3__title">
                                        <a href="{{ route('frontend.single_tour', $featured_tour) }}">{{ $featured_tour->title
                                            }}</a>
                                    </h3>
                                    <p class="tour-card-v3__subtitle">{{ $featured_tour->duration }} Nights, {{
                                        $locationName }}</p>
                                </div>
                                {{-- <span class="tour-card-v3__toggle-icon">&#8743;</span> --}}
                            </div>

                            <div class="tour-card-v3__icons">
                                <span title="Accommodation"><i class="fa fa-building-o"></i></span>
                                <span title="Flights"><i class="fa fa-plane"></i></span>
                                <span title="Transport"><i class="fa fa-car"></i></span>
                                <span title="WiFi"><i class="fa fa-wifi"></i></span>
                            </div>

                            <div class="tour-card-v3__details">
                                @if(!empty($features))
                                @foreach ($features as $feature)
                                @if(!empty($feature['label']))
                                <p>- {{ strtoupper($feature['label']) }}</p>
                                @endif
                                @endforeach
                                @else
                                <p>No features listed.</p>
                                @endif
                            </div>

                        </div>{{-- end footer-inner --}}
                        {{-- Bottom bar OUTSIDE footer-inner so sticky works --}}
                        <div class="tour-card-v3__bottom">
                            <div class="tour-card-v3__price-wrap">
                                <span class="tour-card-v3__nights">{{ $featured_tour->duration }} Nights</span>
                                <span class="tour-card-v3__price">From ${{ number_format((float) $displayPrice,
                                    0) }} PP</span>
                            </div>
                            <a href="{{ route('frontend.single_tour', $featured_tour) }}" class="tour-card-v3__btn">VIEW
                                DEAL</a>
                        </div>
                    </div>{{-- end footer --}}
                </div>
            </div>
            @endforeach
            @else
            <div class="col-12">
                <p class="text-center mb-0">No tours are available right now.</p>
            </div>
            @endif
        </div>
    </div>
</section>

<section class="ftco-section ftco-about img" style="background-image: url(images/bg_7.jpg);">
    <div class="overlay"></div>
    <div class="container py-md-5">
        <div class="row py-md-5">
            <div class="col-md d-flex align-items-center justify-content-center">
                {{-- <a href="https://vimeo.com/45830194"
                    class="icon-video popup-vimeo d-flex align-items-center justify-content-center mb-4">
                    <span class="fa fa-play"></span>
                </a> --}}
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-about ftco-no-pt img">
    <div class="container">
        <div class="row d-flex">
            <div class="col-md-12 about-intro">
                <div class="row">
                    <div class="col-md-6 d-flex align-items-stretch">
                        <div class="img d-flex w-100 align-items-center justify-content-center"
                            style="background-image:url(images/about_2.jpg);">
                        </div>
                    </div>
                    <div class="col-md-6 pl-md-5 py-5">
                        <div class="row justify-content-start pb-3">
                            <div class="col-md-12 heading-section ftco-animate">
                                <span class="subheading">About Us</span>
                                <h2 class="mb-4">Make Your Tour Memorable and Safe With Us</h2>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                    Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right
                                    at the coast of the Semantics, a large language ocean.</p>
                                <p><a href="#" class="btn btn-primary">Book Your Destination</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section testimony-section bg-bottom" style="background-image: url(images/bg_10.jpg);">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                <span class="subheading">Testimonial</span>
                <h2 class="mb-4">Tourist Feedback</h2>
            </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel">
                    <div class="item">
                        <div class="testimony-wrap py-4">
                            <div class="text">
                                <p class="star">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </p>
                                <p class="testimonial-text mb-4">Far far away, behind the word mountains, far from the
                                    countries Vokalia
                                    and Consonantia, there live the blind texts.</p>
                                <div class="d-flex align-items-center">
                                    <div class="user-img" style="background-image: url(images/person_1.jpg)"></div>
                                    <div class="pl-3">
                                        <p class="name">Roger Scott</p>
                                        <span class="position">Marketing Manager</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap py-4">
                            <div class="text">
                                <p class="star">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </p>
                                <p class="testimonial-text mb-4">Far far away, behind the word mountains, far from the
                                    countries Vokalia
                                    and Consonantia, there live the blind texts.</p>
                                <div class="d-flex align-items-center">
                                    <div class="user-img" style="background-image: url(images/person_2.jpg)"></div>
                                    <div class="pl-3">
                                        <p class="name">Roger Scott</p>
                                        <span class="position">Marketing Manager</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap py-4">
                            <div class="text">
                                <p class="star">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </p>
                                <p class="testimonial-text mb-4">Far far away, behind the word mountains, far from the
                                    countries Vokalia
                                    and Consonantia, there live the blind texts.</p>
                                <div class="d-flex align-items-center">
                                    <div class="user-img" style="background-image: url(images/person_3.jpg)"></div>
                                    <div class="pl-3">
                                        <p class="name">Roger Scott</p>
                                        <span class="position">Marketing Manager</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Our Blog</span>
                <h2 class="mb-4">Recent Post</h2>
            </div>
        </div>
        <div class="row d-flex">
      @foreach($blogs as $blog)
      @php
      $image = $blog->image ?: $blog->images->first()?->image;
      $image = $image ? \Illuminate\Support\Facades\Storage::url($image) :
      asset('images/destination-1.jpg');
      @endphp

      <div class="col-md-4 d-flex ftco-animate mb-4">
        <div class="tour-card-v2 w-100">
          <div class="tour-card-v2__img" style="background-image: url('{{ $image }}');"></div>
          <span class="tour-card-v2__discount">Article</span>
          <div class="tour-card-v2__body">
            <div class="tour-card-v2__meta">
              <span><i class="fa fa-clock-o"></i>{{ $blog->created_at->format('M D, Y') }}</span>
              <span><i class="fa fa-group"></i>Admin</span>
              {{-- <span><i class="fa fa-map-marker"></i> Malaysia</span> --}}
            </div>
            <h3 class="tour-card-v2__title">{{ $blog->name }}</h3>
            {{-- <p class="tour-card-v2__desc">{{ $blog->content ?: 'No description available.' }}</p> --}}
            {{-- <div class="tour-card-v2__price">
              price: <span class="tour-card-v2__old">$1300</span> <span class="tour-card-v2__new">$1105</span>
            </div> --}}
            <a href="{{ route('frontend.blog-single', $blog->id) }}" class="tour-card-v2__btn">Read More</a>
          </div>
        </div>
      </div>
      @endforeach
      {{-- <div class="col-md-4 d-flex ftco-animate mb-4">
        <div class="tour-card-v2 w-100">
          <div class="tour-card-v2__img" style="background-image: url('images/image_2.jpg');"></div>
          <span class="tour-card-v2__discount">UPTO 17% off</span>
          <div class="tour-card-v2__body">
            <div class="tour-card-v2__meta">
              <span><i class="fa fa-clock-o"></i> 5D/4N</span>
              <span><i class="fa fa-group"></i> pax: 10</span>
              <span><i class="fa fa-map-marker"></i> Malaysia</span>
            </div>
            <h3 class="tour-card-v2__title">Weekend To Paris</h3>
            <p class="tour-card-v2__desc">Fusce hic augue velit wisi ips quibus dam pariatur, iusto.</p>
            <div class="tour-card-v2__price">
              price: <span class="tour-card-v2__old">$1100</span> <span class="tour-card-v2__new">$900</span>
            </div>
            <a href="blog-single.html" class="tour-card-v2__btn">BOOK NOW</a>
          </div>
        </div>
      </div>

      <div class="col-md-4 d-flex ftco-animate mb-4">
        <div class="tour-card-v2 w-100">
          <div class="tour-card-v2__img" style="background-image: url('images/image_3.jpg');"></div>
          <span class="tour-card-v2__discount">UPTO 20% off</span>
          <div class="tour-card-v2__body">
            <div class="tour-card-v2__meta">
              <span><i class="fa fa-clock-o"></i> 6D/5N</span>
              <span><i class="fa fa-group"></i> pax: 8</span>
              <span><i class="fa fa-map-marker"></i> Sri Lanka</span>
            </div>
            <h3 class="tour-card-v2__title">Most Popular Place In This World</h3>
            <p class="tour-card-v2__desc">Fusce hic augue velit wisi ips quibus dam pariatur, iusto.</p>
            <div class="tour-card-v2__price">
              price: <span class="tour-card-v2__old">$950</span> <span class="tour-card-v2__new">$760</span>
            </div>
            <a href="blog-single.html" class="tour-card-v2__btn">BOOK NOW</a>
          </div>
        </div>
      </div> --}}

    </div>
    </div>
</section>

{{-- <section class="ftco-intro ftco-section ftco-no-pt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <div class="img" style="background-image: url(images/bg_2.jpg);">
                    <div class="overlay"></div>
                    <h2>We Are Pacific A Travel Agency</h2>
                    <p>We can manage your dream building A small river named Duden flows by their place</p>
                    <p class="mb-0"><a href="#" class="btn btn-primary px-4 py-3">Ask For A Quote</a></p>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<style>
    /* --- Parallax Section --- */
.ftco-section--parallax {
    position: relative;
    overflow: hidden;
}

.ftco-section__parallax-bg {
    position: absolute;
    inset: -30% 0; /* extra height top & bottom for parallax travel */
    background-image: url('/images/paralax-6.jpg'); /* 👈 change this */
    background-size: cover;
    background-position: center;
    will-change: transform;
    z-index: 0;
}

.ftco-section__overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.55); /* dark tint so text stays readable */
    z-index: 1;
}

/* Make headings/text readable on dark bg */
.ftco-section--parallax .subheading,
.ftco-section--parallax h2,
.ftco-section--parallax .cap {
    color: #fff;
}
</style>
<script>
    $(document).ready(function () {
        $('.carousel-destination').owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            navText: [
                '<i class="fa fa-chevron-left"></i>',
                '<i class="fa fa-chevron-right"></i>'
            ],
            responsive: {
                0: { items: 1 },
                576: { items: 2 },
                992: { items: 3 },
                1200: { items: 4 }
            }
        });
    });

    /* --- Parallax Section --- */
.ftco-section--parallax {
    position: relative;
    overflow: hidden;
}

.ftco-section__parallax-bg {
    position: absolute;
    inset: -30% 0; /* extra height top & bottom for parallax travel */
    background-image: url('/images/paralax-6.jpg'); /* 👈 change this */
    background-size: cover;
    background-position: center;
    will-change: transform;
    z-index: 0;
}

.ftco-section__overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.55); /* dark tint so text stays readable */
    z-index: 1;
}

/* Make headings/text readable on dark bg */
.ftco-section--parallax .subheading,
.ftco-section--parallax h2,
.ftco-section--parallax .cap {
    color: #fff;
}
</script>
@endsection
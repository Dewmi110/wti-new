@extends('frontend.components.layout')

@section('content')
<div class="hero-wrap js-fullheight owl-carousel">
    <div class="hero-slide js-fullheight" style="background-image: url('{{ asset('images/hero-slider/slider6.jpg') }}'); background-position: center; background-size: cover;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
                <div class="col-md-7 ftco-animate">
                    <span class="subheading" style="background: rgba(255, 255, 255, 0.9); color: #e11d2e; display: inline-block; padding: 12px 24px; line-height: 1;">Welcome to WTI Holidays</span>
                    <h1 class="mb-4">Discover Your Favorite Place with Us</h1>
                    <p class="caps">Travel to the any corner of the world, without going around in circles</p>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-slide js-fullheight" style="background-image: url('{{ asset('images/hero-slider/slider7.jpg') }}'); background-position: center; background-size: cover;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
                <div class="col-md-7 ftco-animate">
                    <span class="subheading" style="background: rgba(255, 255, 255, 0.9); color: #e11d2e; display: inline-block; padding: 12px 24px; line-height: 1;">Explore Handpicked Tours</span>
                    <h1 class="mb-4">Unforgettable Journeys Await</h1>
                    <p class="caps">Find curated packages and authentic experiences.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-slide js-fullheight" style="background-image: url('{{ asset('images/hero-slider/slider3.jpg') }}'); background-position: center; background-size: cover;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
                <div class="col-md-7 ftco-animate">
                    <span class="subheading" style="background: rgba(255, 255, 255, 0.9); color: #e11d2e; display: inline-block; padding: 12px 24px; line-height: 1;">Travel With Confidence</span>
                    <h1 class="mb-4">Safe, Seamless & Memorable</h1>
                    <p class="caps">Let us handle the details while you make memories.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-slide js-fullheight" style="background-image: url('{{ asset('images/hero-slider/slider4.jpg') }}'); background-position: center; background-size: cover;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
                <div class="col-md-7 ftco-animate">
                    <span class="subheading" style="background: rgba(255, 255, 255, 0.9); color: #e11d2e; display: inline-block; padding: 12px 24px; line-height: 1;">Amazing Destinations</span>
                    <h1 class="mb-4">Create Lasting Memories</h1>
                    <p class="caps">Experience the beauty and culture of the world.</p>
                </div>
            </div>
        </div>
    </div>
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

{{-- <section class="ftco-section services-section">
    <div class="container">
        <div class="row d-flex">
            <div class="col-md-6 order-md-last heading-section pl-md-5 ftco-animate d-flex align-items-center">
                <div class="w-100">
                    <span class="subheading">Welcome to WTI Holidays</span>
                    <h2 class="mb-4">It's time to start your adventure</h2>
                    <p>Escape the ordinary and dive into unforgettable adventures. Whether you crave tranquil beaches, breathtaking mountain escapes, or vibrant city explorations, we craft experiences that match your dreams. Travel isn’t just about the destination—it’s about the memories you create along the way. With our carefully curated packages, seamless itineraries, and expert guidance, you can embrace new cultures, discover hidden gems, and travel with complete peace of mind. Let us handle the details while you focus on making moments that last a lifetime.</p>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there
                        live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics,
                        a large language ocean.
                        A small river named Duden flows by their place and supplies it with the necessary regelialia.
                    </p>
                    <p><a href="{{ route('frontend.visit_to_srilanka') }}" class="btn btn-primary py-3 px-4">Search Destination</a></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                        <div class="services services-1 color-1 d-block img"
                            style="background-image: url(images/services-1.jpg);">
                            <div class="icon d-flex align-items-center justify-content-center"><span
                                    class="flaticon-paragliding"></span></div>
                            <div class="media-body">
                                <h3 class="heading mb-3">Activities</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                        <div class="services services-1 color-2 d-block img"
                            style="background-image: url(images/services-2.jpg);">
                            <div class="icon d-flex align-items-center justify-content-center"><span
                                    class="flaticon-route"></span></div>
                            <div class="media-body">
                                <h3 class="heading mb-3">Travel Arrangements</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                        <div class="services services-1 color-3 d-block img"
                            style="background-image: url(images/services-3.jpg);">
                            <div class="icon d-flex align-items-center justify-content-center"><span
                                    class="flaticon-tour-guide"></span></div>
                            <div class="media-body">
                                <h3 class="heading mb-3">Private Guide</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                        <div class="services services-1 color-4 d-block img"
                            style="background-image: url(images/services-4.jpg);">
                            <div class="icon d-flex align-items-center justify-content-center"><span
                                    class="flaticon-map"></span></div>
                            <div class="media-body">
                                <h3 class="heading mb-3">Location Manager</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

{{-- <div class="paralax-1" style="background-image: url('{{ asset('images/paralax-6.jpg') }}');" data-scrollax="properties: { translateY: '30%' }">
</div> --}}

<section class="ftco-section img ftco-select-destination" style="background-image: url(images/bg_11.png);">
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
                    {{-- <p><a href="{{ route('frontend.visit_to_srilanka') }}" class="btn btn-primary py-3 px-5">Search Destination</a></p> --}}
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
                                        <img src="{{ asset('images/place-1.jpg') }}" alt="{{ $destination->name }}" class="destination-card-v4__image">
                                        <span class="destination-card-v4__badge">
                                            @for ($star = 0; $star < 5; $star++)
                                                <i class="fa fa-star"></i>
                                            @endfor
                                        </span>
                                    </a>
                                    <div class="destination-card-v4__body">
                                        <span class="destination-card-v4__eyebrow">{{ strtoupper(optional($destination->country)->name ?? 'DESTINATION') }}</span>
                                        <h3 class="destination-card-v4__title">{{ $destination->name }}</h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @for ($i = $displayCount; $i < 6; $i++)
                            <div class="item">
                                <div class="destination-card-v4 destination-card-v4--empty">
                                    <div class="destination-card-v4__body">
                                        <span class="destination-card-v4__eyebrow">DESTINATION</span>
                                        <h3 class="destination-card-v4__title">Coming Soon</h3>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    @else
                        @for ($i = 0; $i < 6; $i++)
                            <div class="item">
                                <div class="destination-card-v4 destination-card-v4--empty">
                                    <div class="destination-card-v4__body">
                                        <span class="destination-card-v4__eyebrow">DESTINATION</span>
                                        <h3 class="destination-card-v4__title">No destinations yet</h3>
                                        <p class="destination-card-v4__text">Add active destinations from the admin panel to show them here.</p>
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
{{-- <div class="paralax-1" style="background-image: url('{{ asset('images/paralax-5.jpg') }}');" data-scrollax="properties: { translateY: '30%' }">
</div> --}}
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
            <div class="col-md-4 ftco-animate">
                <div class="project-wrap">
                    <a href="#" class="img" style="background-image: url(images/destination-1.jpg);">
                        <span class="price">$550/person</span>
                    </a>
                    <div class="text p-4">
                        <span class="days">8 Days Tour</span>
                        <h3><a href="#">Banaue Rice Terraces</a></h3>
                        <p class="location"><span class="fa fa-map-marker"></span> Banaue, Ifugao, Philippines</p>
                        <ul>
                            <li><span class="flaticon-shower"></span>2</li>
                            <li><span class="flaticon-king-size"></span>3</li>
                            <li><span class="flaticon-mountains"></span>Near Mountain</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ftco-animate">
                <div class="project-wrap">
                    <a href="#" class="img" style="background-image: url(images/destination-2.jpg);">
                        <span class="price">$550/person</span>
                    </a>
                    <div class="text p-4">
                        <span class="days">10 Days Tour</span>
                        <h3><a href="#">Banaue Rice Terraces</a></h3>
                        <p class="location"><span class="fa fa-map-marker"></span> Banaue, Ifugao, Philippines</p>
                        <ul>
                            <li><span class="flaticon-shower"></span>2</li>
                            <li><span class="flaticon-king-size"></span>3</li>
                            <li><span class="flaticon-sun-umbrella"></span>Near Beach</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ftco-animate">
                <div class="project-wrap">
                    <a href="#" class="img" style="background-image: url(images/destination-3.jpg);">
                        <span class="price">$550/person</span>
                    </a>
                    <div class="text p-4">
                        <span class="days">7 Days Tour</span>
                        <h3><a href="#">Banaue Rice Terraces</a></h3>
                        <p class="location"><span class="fa fa-map-marker"></span> Banaue, Ifugao, Philippines</p>
                        <ul>
                            <li><span class="flaticon-shower"></span>2</li>
                            <li><span class="flaticon-king-size"></span>3</li>
                            <li><span class="flaticon-sun-umbrella"></span>Near Beach</li>
                        </ul>
                    </div>
                </div>
            </div>
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
                                <p class="testimonial-text mb-4">Far far away, behind the word mountains, far from the countries Vokalia
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
                                <p class="testimonial-text mb-4">Far far away, behind the word mountains, far from the countries Vokalia
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
                                <p class="testimonial-text mb-4">Far far away, behind the word mountains, far from the countries Vokalia
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

    <div class="col-md-4 d-flex ftco-animate mb-4">
      <div class="tour-card-v2 w-100">
        <div class="tour-card-v2__img" style="background-image: url('images/image_1.jpg');"></div>
        <span class="tour-card-v2__discount">UPTO 25% off</span>
        <div class="tour-card-v2__body">
          <div class="tour-card-v2__meta">
            <span><i class="fa fa-clock-o"></i> 7D/6N</span>
            <span><i class="fa fa-group"></i> pax: 10</span>
            <span><i class="fa fa-map-marker"></i> Malaysia</span>
          </div>
          <h3 class="tour-card-v2__title">Most Popular Place In This World</h3>
          <p class="tour-card-v2__desc">Fusce hic augue velit wisi ips quibus dam pariatur, iusto.</p>
          <div class="tour-card-v2__price">
            price: <span class="tour-card-v2__old">$1300</span> <span class="tour-card-v2__new">$1105</span>
          </div>
          <a href="blog-single.html" class="tour-card-v2__btn">BOOK NOW</a>
        </div>
      </div>
    </div>

    <div class="col-md-4 d-flex ftco-animate mb-4">
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
    </div>

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
      0:    { items: 1 },
      576:  { items: 2 },
      992:  { items: 3 },
      1200: { items: 4 }
    }
  });
});
</script>
@endsection
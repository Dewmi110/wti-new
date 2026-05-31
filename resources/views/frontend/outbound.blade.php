@extends('frontend.components.layout')

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/paralax-4.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('frontend.index') }}">Home <i
                                class="fa fa-chevron-right"></i></a></span> <span>Tour List <i
                            class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">Outbound List</h1>
            </div>
        </div>
    </div>
</section>

@include('frontend.components.search')

<section class="ftco-section">
    <div class="container">
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
        </div>
        @include('frontend.components.pagination')
    </div>
</section>



<section class="ftco-intro ftco-section ftco-no-pt">
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
</section>
@endsection
@extends('frontend.components.layout')
@section('content')

<section class="hero-wrap hero-wrap-2"
    style="background-image: url('{{ $coverImageUrl }}'); min-height: 85vh; position: relative;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" style="min-height: 85vh;">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('frontend.index') }}">Home <i
                                class="fa fa-chevron-right"></i></a></span> <span>Tour List <i
                            class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">{{ $type_name }}</h1>
            </div>
        </div>
    </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            {{-- LEFT: Filter Sidebar --}}
            <div class="col-md-3">
                <div style="position: sticky; top: 20px;">
                    @include('frontend.components.filter_bar')
                </div>
            </div>
            {{-- RIGHT: Tour Cards Grid --}}
            <div class="col-md-9">
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
             
                    <div class="col-md-4 ftco-animate mb-4">
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
                                        <span class="tour-card-v3__price">From Rs {{ number_format((float) $displayPrice,
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
                {{-- Pagination --}}
                @include('frontend.components.pagination')
            </div>
        </div>
    </div>
</section>
@endsection
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
                <h1 class="mb-0 bread">Visit to Sri Lanka List</h1>
            </div>
        </div>
    </div>
</section>

@include('frontend.components.search')

<section class="ftco-section">
    <div class="container">
        <div class="row">
            @if ($tours->isNotEmpty())
                @foreach ($tours as $tour)
                    @php
                        $coverImagePath = $tour->banner_img_path ?: $tour->images->first()?->img_path;
                        $coverImageUrl = $coverImagePath ? \Illuminate\Support\Facades\Storage::url($coverImagePath) : asset('images/destination-1.jpg');
                        $displayPrice = $tour->discount_price ?: $tour->price;
                        $locationName = optional($tour->countryModel)->name ?? 'Sri Lanka';
                        $features = is_array($tour->features) ? $tour->features : [];
                    @endphp

                    <div class="col-md-4 ftco-animate">
                        <div class="project-wrap">
                            <a href="{{ route('frontend.single_tour', $tour) }}" class="img" style="background-image: url('{{ $coverImageUrl }}');">
                                <span class="price">${{ number_format((float) $displayPrice, 0) }}.00/person</span>
                            </a>
                            <div class="text p-4">
                                <span class="days">{{ $tour->duration }} Days Tour</span>
                                <h3><a href="{{ route('frontend.single_tour', $tour) }}" class="tour-title" title="{{ $tour->title }}" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:block;">{{ $tour->title }}</a></h3>
                                <p class="location"><span class="fa fa-map-marker"></span> {{ $locationName }}</p>
                                <ul>
                                    @foreach ($features as $feature)
                                        @php
                                            $featurePrefix = $feature['prefix'] ?? 'fas';
                                            $featureIcon = $feature['icon'] ?? '';
                                            $featureLabel = $feature['label'] ?? '';
                                        @endphp

                                        @if ($featureIcon !== '' || $featureLabel !== '')
                                            <li>
                                                @if ($featurePrefix === 'emoji')
                                                    <span>{{ $featureIcon }}</span>
                                                @else
                                                    <span class="{{ $featurePrefix }} {{ $featureIcon }}"></span>
                                                @endif
                                                {{ $featureLabel }}
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <p class="text-center mb-0">No tours are available right now.</p>
                </div>
            @endif
        </div>
        @include('frontend.components.pagination')
    </div>
</section>



{{-- <div class="paralax-1" style="background-image: url('{{ asset('images/paralax-6.jpg') }}');" data-scrollax="properties: { translateY: '30%' }">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center ftco-animate">
                <h2 class="mb-2">Explore More Tours in Sri Lanka</h2>
                <p class="mb-4">Curated packages, authentic experiences and great prices — choose your next adventure.</p>
                <p class="mb-0"><a href="{{ route('frontend.visit_to_srilanka') }}" class="btn btn-primary px-4 py-3">View All Tours</a></p>
            </div>
        </div>
    </div>
</div>

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
</section> --}}
@endsection
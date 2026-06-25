@extends('frontend.components.layout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/single-tour.css') }}">

@php
if (! function_exists('tourRichTextToHtml')) {
function tourRichTextToHtml(string $text): string
{
$text = trim($text);
if ($text === '') return '';
$escaped = e($text);
$escaped = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $escaped);
$escaped = preg_replace('/__(.+?)__/', '<strong>$1</strong>', $escaped);
$escaped = preg_replace('/\*(.+?)\*/', '<em>$1</em>', $escaped);
$escaped = preg_replace('/_(.+?)_/', '<em>$1</em>', $escaped);
$lines = preg_split('/\r\n|\r|\n/', $escaped);
$html = ''; $listOpen = false;
foreach ($lines as $line) {
$trimmedLine = trim($line);
if ($trimmedLine === '') {
if ($listOpen) { $html .= '</ul>'; $listOpen = false; }
continue;
}
if (preg_match('/^[\-\*\+]\s+(.+)$/', $trimmedLine, $matches)) {
if (!$listOpen) { $html .= '<ul class="rich-text-list">'; $listOpen = true; }
    $html .= '<li>' . $matches[1] . '</li>';
    continue;
    }
    if ($listOpen) { $html .= '</ul>'; $listOpen = false; }
$html .= '<p>' . $trimmedLine . '</p>';
}
if ($listOpen) $html .= '</ul>';
return $html;
}
}

$coverImagePath = $tour->banner_img_path ?: $tour->images->first()?->img_path;
$coverImageUrl = $coverImagePath
? \Illuminate\Support\Facades\Storage::url($coverImagePath)
: asset('images/destination-1.jpg');
$displayPrice = $tour->discount_price ?: $tour->price;
$locationName = optional($tour->countryModel)->name ?? 'Sri Lanka';
$tourImages = $tour->images->pluck('img_path')->map(fn($p) => \Illuminate\Support\Facades\Storage::url($p))->toArray();
$features = is_array($tour->features) ? $tour->features : [];
$itinerary = $tour->itineraries->toArray();
$includes = [];
$priceIncludesHtml = '';
if (is_array($tour->includes)) { $includes = $tour->includes; }
elseif (!empty($tour->price_include)) { $priceIncludesHtml = tourRichTextToHtml($tour->price_include); }
$excludes = is_array($tour->excludes) ? $tour->excludes : [];
$highlights = [];
if (is_array($tour->highlights)) { $highlights = $tour->highlights; }
elseif (!empty($tour->highlight_activities)) {
$highlights = array_filter(array_map('trim', preg_split('/[\r\n]+/', $tour->highlight_activities)), static fn($i) => $i
!== '');
}
$cancellationPolicy = $tour->cancellation_policy ?? '';
$formattedCancellationPolicy = $cancellationPolicy !== '' ? tourRichTextToHtml($cancellationPolicy) : '';
@endphp

{{-- ============================================================
HERO BANNER — thin stripe, not full-screen
============================================================ --}}
<section class="td-hero" style="background-image: url('{{ $coverImageUrl }}');">
    <div class="td-hero__overlay"></div>
    <div class="container td-hero__inner">
        <nav class="td-breadcrumb">
            <a href="{{ route('frontend.index') }}">Home</a>
            <i class="fa fa-angle-right"></i>
            <a href="{{ route('frontend.visit_to_srilanka') }}">Tours</a>
            <i class="fa fa-angle-right"></i>
            <span>{{ Str::limit($tour->title, 50) }}</span>
        </nav>
        <h1 class="td-hero__title">{{ $tour->title }}</h1>
    </div>
</section>

{{-- ============================================================
MAIN TWO-COLUMN LAYOUT
============================================================ --}}
<div class="td-page container">
    <div class="td-layout">

        {{-- ======================== LEFT COLUMN ======================== --}}
        @include('frontend.components.single_tour_details')

        {{-- ======================== RIGHT SIDEBAR ======================== --}}
        @include('frontend.components.single_tour_sidebar')
    </div>
</div>

<!-- Related Tours Section -->
{{-- <section class="ftco-section bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 style="font-size: 32px; font-weight: 800; color: #333; margin-bottom: 10px;">More Tours in {{
                    $locationName }}</h2>
                <p style="color: #999; font-size: 16px;">Explore other amazing tours in the same destination</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center py-5">
                <p style="color: #999;">More tours coming soon...</p>
            </div>
        </div>
    </div>
</section> --}}
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 style="font-size:32px; font-weight:800; color:#333; margin-bottom:10px;">
                    More Tours in {{ $locationName }}
                </h2>
                <p style="color:#999; font-size:16px;">Explore other amazing tours in the same destination</p>
            </div>
        </div>

        @if($relatedTours->isEmpty())
            <div class="row">
                <div class="col-12 text-center py-5">
                    <p style="color:#999;">No other tours available in {{ $locationName }} yet.</p>
                </div>
            </div>
        @else
            <div class="row">
                @foreach($relatedTours as $related)
                @php
                    $relFeatures = is_array($related->features) ? $related->features : [];
                @endphp
                <div class="col-md-3 ftco-animate mb-4">
                    <div class="tour-card-v3">
                        <div class="tour-card-v3__img"
                             style="background-image: url('{{ $related->cover_url }}');"></div>
                        <div class="tour-card-v3__footer">
                            <div class="tour-card-v3__footer-inner">
                                <div class="tour-card-v3__footer-top">
                                    <div style="min-width:0;">
                                        <h3 class="tour-card-v3__title">
                                            <a href="{{ route('frontend.single_tour', $related) }}">
                                                {{ $related->title }}
                                            </a>
                                        </h3>
                                        <p class="tour-card-v3__subtitle">
                                            {{ $related->duration }} Nights, {{ $locationName }}
                                        </p>
                                    </div>
                                </div>

                                <div class="tour-card-v3__icons">
                                    <span title="Accommodation"><i class="fa fa-building-o"></i></span>
                                    <span title="Flights"><i class="fa fa-plane"></i></span>
                                    <span title="Transport"><i class="fa fa-car"></i></span>
                                    <span title="WiFi"><i class="fa fa-wifi"></i></span>
                                </div>

                                <div class="tour-card-v3__details">
                                    @if(!empty($relFeatures))
                                        @foreach($relFeatures as $feature)
                                            @if(!empty($feature['label']))
                                                <p>- {{ strtoupper($feature['label']) }}</p>
                                            @endif
                                        @endforeach
                                    @else
                                        <p>No features listed.</p>
                                    @endif
                                </div>
                            </div>

                            <div class="tour-card-v3__bottom">
                                <div class="tour-card-v3__price-wrap">
                                    <span class="tour-card-v3__nights">{{ $related->duration }} Nights</span>
                                    <span class="tour-card-v3__price">
                                        From {{ $related->currency ?? 'USD' }} {{ number_format((float) $related->display_price, 0) }} PP
                                    </span>
                                </div>
                                <a href="{{ route('frontend.single_tour', $related) }}"
                                   class="tour-card-v3__btn">VIEW DEAL</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</section>


{{-- Booking Modal --}}
@include('frontend.components.booking_modal')


{{-- ============================================================
SCRIPTS
============================================================ --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    const scImages = @json(array_slice($tourImages, 0, 4));
    let scCurrentIndex = 0;

    function openLightbox(src, index) {
        scCurrentIndex = index;
        document.getElementById('sc-lightbox-img').src = src;
        document.getElementById('sc-lightbox').classList.add('sc-active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        document.getElementById('sc-lightbox').classList.remove('sc-active');
        document.body.style.overflow = '';
    }

    function changeImage(direction) {
        scCurrentIndex = (scCurrentIndex + direction + scImages.length) % scImages.length;
        document.getElementById('sc-lightbox-img').src = scImages[scCurrentIndex];
    }

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') changeImage(-1);
        if (e.key === 'ArrowRight') changeImage(1);
    });
    $(document).ready(function () {
        // Gallery carousel
        var $oc = $('#tdCarousel').owlCarousel({
            items: 1, loop: true, autoplay: true, autoplayTimeout: 5000,
            margin: 0, nav: true,
            navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
            dots: false
        });
        $('.td-gallery__thumb').on('click', function () {
            $oc.trigger('to.owl.carousel', [$(this).data('index'), 300]);
            $('.td-gallery__thumb').removeClass('active');
            $(this).addClass('active');
        });
        $oc.on('changed.owl.carousel', function (e) {
            $('.td-gallery__thumb').removeClass('active');
            $('.td-gallery__thumb').eq(e.item.index % e.item.count).addClass('active');
        });

        // Itinerary chevron sync
        $('[id^="itin-"]').on('show.bs.collapse', function () {
            $('[data-target="#' + $(this).attr('id') + '"]').attr('aria-expanded', 'true');
        }).on('hide.bs.collapse', function () {
            $('[data-target="#' + $(this).attr('id') + '"]').attr('aria-expanded', 'false');
        });
    });
</script>

@endsection
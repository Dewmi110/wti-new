@extends('frontend.components.layout')

@section('content')

@php
    $coverImagePath = $tour->banner_img_path ?: $tour->images->first()?->img_path;
    $coverImageUrl = $coverImagePath 
        ? \Illuminate\Support\Facades\Storage::url($coverImagePath)
        : asset('images/destination-1.jpg');
    $displayPrice = $tour->discount_price ?: $tour->price;
    $locationName = optional($tour->countryModel)->name ?? 'Sri Lanka';
    $tourImages = $tour->images->pluck('img_path')->map(fn($path) => 
        \Illuminate\Support\Facades\Storage::url($path)
    )->toArray();
    $features = is_array($tour->features) ? $tour->features : [];
    $itinerary = is_array($tour->itinerary) ? $tour->itinerary : [];
    $includes = is_array($tour->includes) ? $tour->includes : [];
    $excludes = is_array($tour->excludes) ? $tour->excludes : [];
@endphp

<!-- Hero Section -->
<section class="hero-wrap hero-wrap-2"
    style="background-image: url('{{ $coverImageUrl }}'); min-height: 70vh; position: relative;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" style="min-height: 70vh;">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ route('frontend.index') }}">Home <i class="fa fa-chevron-right"></i></a></span>
                    <span class="mr-2"><a href="{{ route('frontend.visit_to_srilanka') }}">Tours <i class="fa fa-chevron-right"></i></a></span>
                    <span>{{ Str::limit($tour->title, 40) }} <i class="fa fa-chevron-right"></i></span>
                </p>
                <h1 class="mb-3 bread">{{ $tour->title }}</h1>
                <p style="color: rgba(255,255,255,0.9); font-size: 16px;">
                    <i class="fa fa-map-marker mr-2"></i>{{ $locationName }} • 
                    <i class="fa fa-calendar mr-2"></i>{{ $tour->duration }} Nights
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Main Content Section -->
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <!-- LEFT: Main Content -->
            <div class="col-lg-8 ftco-animate">
                
                <!-- Image Carousel -->
                @if (!empty($tourImages))
                <div class="mb-5">
                    <div class="owl-carousel owl-theme tour-carousel" id="tourCarousel">
                        @foreach ($tourImages as $image)
                            <div class="item">
                                <img src="{{ $image }}" alt="Tour Image" class="img-fluid rounded" 
                                    style="width: 100%; height: 450px; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                    <div class="carousel-thumbnails mt-3 d-flex gap-2 flex-wrap">
                        @foreach ($tourImages as $index => $image)
                            <img src="{{ $image }}" alt="Thumbnail" 
                                class="carousel-thumb rounded cursor-pointer" 
                                data-index="{{ $index }}"
                                style="width: 80px; height: 60px; object-fit: cover; border: 2px solid #ddd; cursor: pointer; transition: all 0.3s;">
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Tour Overview -->
                <div class="mb-5">
                    <h2 class="mb-4">Tour Overview</h2>
                    <p class="lead" style="color: #666; line-height: 1.8;">{{ $tour->description }}</p>
                    
                    <!-- Key Features -->
                    @if (!empty($features))
                    <div class="mt-4">
                        <h5 class="mb-3">Key Features</h5>
                        <div class="row">
                            @foreach ($features as $feature)
                                @if (!empty($feature['label']))
                                <div class="col-md-6 mb-2">
                                    <p>
                                        <i class="fa fa-check-circle" style="color: #DB1A1A; margin-right: 10px;"></i>
                                        {{ $feature['label'] }}
                                    </p>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Itinerary Accordion -->
                @if (!empty($itinerary))
                <div class="mb-5">
                    <h2 class="mb-4">Tour Itinerary</h2>
                    <div class="accordion" id="itineraryAccordion">
                        @foreach ($itinerary as $index => $day)
                            @php
                                $dayNumber = $day['day'] ?? ($index + 1);
                                $dayTitle = $day['title'] ?? "Day $dayNumber";
                                $dayDescription = $day['description'] ?? '';
                            @endphp
                            <div class="card mb-2" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                <div class="card-header p-0" id="heading{{ $index }}" 
                                    style="background: linear-gradient(135deg, #2c687b 0%, #3d7a99 100%); border-radius: 8px;">
                                    <button class="btn btn-link btn-block text-left p-3" type="button" 
                                        data-toggle="collapse" data-target="#collapse{{ $index }}" 
                                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                        style="color: #fff; text-decoration: none; font-weight: 600; font-size: 15px;">
                                        <i class="fa fa-calendar-o mr-2"></i>{{ $dayTitle }}
                                        <i class="fa fa-chevron-down float-right" style="transition: transform 0.3s;"></i>
                                    </button>
                                </div>
                                <div id="collapse{{ $index }}" class="collapse {{ $index === 0 ? 'show' : '' }}" 
                                    aria-labelledby="heading{{ $index }}" data-parent="#itineraryAccordion">
                                    <div class="card-body" style="background: #f9f9f9; padding: 20px;">
                                        {!! nl2br($dayDescription) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Includes & Excludes -->
                {{-- <div class="mb-5">
                    <h2 class="mb-4">What's Included & Excluded</h2>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <h5 class="mb-3" style="color: #28a745; font-weight: 700;">
                                <i class="fa fa-check-circle mr-2"></i>Included
                            </h5>
                            <ul style="list-style: none; padding: 0;">
                                @forelse ($includes as $item)
                                    @if (!empty($item['label']))
                                    <li class="mb-2 pb-2" style="border-bottom: 1px solid #f0f0f0;">
                                        <i class="fa fa-check" style="color: #28a745; margin-right: 8px; font-weight: bold;"></i>
                                        {{ $item['label'] }}
                                    </li>
                                    @endif
                                @empty
                                    <li class="text-muted">No items specified</li>
                                @endforelse
                            </ul>
                        </div> --}}

                        <!-- Excludes -->
                        {{-- <div class="col-md-6 mb-4">
                            <h5 class="mb-3" style="color: #dc3545; font-weight: 700;">
                                <i class="fa fa-times-circle mr-2"></i>Not Included
                            </h5>
                            <ul style="list-style: none; padding: 0;">
                                @forelse ($excludes as $item)
                                    @if (!empty($item['label']))
                                    <li class="mb-2 pb-2" style="border-bottom: 1px solid #f0f0f0;">
                                        <i class="fa fa-times" style="color: #dc3545; margin-right: 8px; font-weight: bold;"></i>
                                        {{ $item['label'] }}
                                    </li>
                                    @endif
                                @empty
                                    <li class="text-muted">No items specified</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div> --}}

                <!-- Map Section -->
                {{-- <div class="mb-5">
                    <h2 class="mb-4">Tour Location</h2>
                    <div id="map" style="width: 100%; height: 400px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);"></div>
                </div> --}}

                <!-- Inquiry Form -->
                <div class="mb-5">
                    <h4 class="mb-4">Interested in this Tour?</h4>
                    <form action="{{ route('send.inquiry') }}" method="POST" class="bg-light p-4 rounded" style="width: 80%">
                        @csrf
                        <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fullName">Full Name *</label>
                                <input type="text" class="form-control" id="fullName" name="full_name" 
                                    placeholder="Your full name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email Address *</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                    placeholder="your.email@example.com" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phone">Phone Number *</label>
                                <input type="tel" class="form-control" id="phone" name="phone" 
                                    placeholder="+1 (555) 000-0000" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="travelers">Number of Travelers *</label>
                                <input type="number" class="form-control" id="travelers" name="travelers" 
                                    placeholder="2" min="1" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="startDate">Preferred Start Date</label>
                                <input type="date" class="form-control" id="startDate" name="start_date">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="budget">Budget Range</label>
                                <select class="form-control" id="budget" name="budget">
                                    <option value="">Select budget range</option>
                                    <option value="budget">Under $1,000</option>
                                    <option value="moderate">$1,000 - $2,500</option>
                                    <option value="mid-range">$2,500 - $5,000</option>
                                    <option value="luxury">Above $5,000</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message">Message / Special Requests</label>
                            <textarea class="form-control" id="message" name="message" rows="5" 
                                placeholder="Tell us about any special requests or preferences..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            <i class="fa fa-send mr-2"></i>Send Inquiry
                        </button>
                    </form>
                </div>

            </div>

            <!-- RIGHT: Sidebar -->
            <div class="col-lg-4">
                
                <!-- Price Card -->
                <div class="bg-white rounded-lg shadow-sm p-4 mb-4" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
                    <div class="mb-4">
                        <h4 style="color: #999; font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">
                            Price Per Person
                        </h4>
                        <div class="mb-3">
                            @if ($tour->discount_price)
                                <div style="display: flex; align-items: baseline; gap: 10px;">
                                    <span style="font-size: 28px; font-weight: 800; color: #DB1A1A;">
                                        ${{ number_format((float) $tour->discount_price, 0) }}
                                    </span>
                                    <span style="font-size: 16px; color: #999; text-decoration: line-through;">
                                        ${{ number_format((float) $tour->price, 0) }}
                                    </span>
                                </div>
                                <span style="color: #DB1A1A; font-weight: 600; font-size: 12px;">
                                    Save ${{ number_format((float) $tour->price - $tour->discount_price, 0) }}
                                </span>
                            @else
                                <span style="font-size: 32px; font-weight: 800; color: #DB1A1A;">
                                    ${{ number_format((float) $tour->price, 0) }}
                                </span>
                            @endif
                        </div>
                        <p style="color: #999; font-size: 13px; margin-bottom: 0;">
                            For {{ $tour->duration }} nights accommodation, meals & activities
                        </p>
                    </div>

                    <button class="btn btn-primary btn-block mb-2" data-toggle="modal" data-target="#bookingModal">
                        <i class="fa fa-calendar mr-2"></i>Book Now
                    </button>
                    <button class="btn btn-outline-primary btn-block">
                        <i class="fa fa-heart mr-2"></i>Add to Wishlist
                    </button>
                </div>

                <!-- Tour Details Card -->
                <div class="bg-light rounded-lg p-4 mb-4" style="border-radius: 12px;">
                    <h5 class="mb-4" style="font-weight: 700; color: #333;">Tour Details</h5>
                    
                    <div class="detail-item mb-3">
                        <span style="color: #999; font-size: 13px; font-weight: 600; text-transform: uppercase;">Duration</span>
                        <p style="margin: 0; color: #333; font-weight: 600;">{{ $tour->duration }} Nights</p>
                    </div>

                    <div class="detail-item mb-3">
                        <span style="color: #999; font-size: 13px; font-weight: 600; text-transform: uppercase;">Destination</span>
                        <p style="margin: 0; color: #333; font-weight: 600;">{{ $locationName }}</p>
                    </div>

                    @if ($tour->type)
                    <div class="detail-item mb-3">
                        <span style="color: #999; font-size: 13px; font-weight: 600; text-transform: uppercase;">Tour Type</span>
                        <p style="margin: 0; color: #333; font-weight: 600;">{{ $tour->type->name ?? 'N/A' }}</p>
                    </div>
                    @endif

                    @if ($tour->theme)
                    <div class="detail-item mb-3">
                        <span style="color: #999; font-size: 13px; font-weight: 600; text-transform: uppercase;">Theme</span>
                        <p style="margin: 0; color: #333; font-weight: 600;">{{ $tour->theme->name ?? 'N/A' }}</p>
                    </div>
                    @endif

                    <div class="detail-item mb-0">
                        <span style="color: #999; font-size: 13px; font-weight: 600; text-transform: uppercase;">Best Season</span>
                        <p style="margin: 0; color: #333; font-weight: 600;">Year Round</p>
                    </div>
                </div>

                <!-- Share Card -->
                <div class="bg-white rounded-lg p-4" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
                    <h5 class="mb-4" style="font-weight: 700; color: #333;">Share This Tour</h5>
                    <div class="d-flex gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" 
                            target="_blank" class="btn btn-sm" style="background: #3b5998; color: #fff;">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $tour->title }}" 
                            target="_blank" class="btn btn-sm" style="background: #1da1f2; color: #fff;">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="https://wa.me/?text={{ $tour->title }}%20{{ url()->current() }}" 
                            target="_blank" class="btn btn-sm" style="background: #25d366; color: #fff;">
                            <i class="fa fa-whatsapp"></i>
                        </a>
                        <a href="mailto:?subject={{ $tour->title }}&body={{ url()->current() }}" 
                            class="btn btn-sm" style="background: #EA4335; color: #fff;">
                            <i class="fa fa-envelope"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Related Tours Section -->
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 style="font-size: 32px; font-weight: 800; color: #333; margin-bottom: 10px;">More Tours in {{ $locationName }}</h2>
                <p style="color: #999; font-size: 16px;">Explore other amazing tours in the same destination</p>
            </div>
        </div>
        <div class="row">
            <!-- Related tours would be displayed here -->
            <div class="col-12 text-center py-5">
                <p style="color: #999;">More tours coming soon...</p>
            </div>
        </div>
    </div>
</section>

<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Book {{ $tour->title }}</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                    
                    <div class="form-group">
                        <label>Full Name *</label>
                        <input type="text" class="form-control" name="full_name" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Email *</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Phone *</label>
                            <input type="tel" class="form-control" name="phone" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Number of Travelers *</label>
                            <input type="number" class="form-control" name="travelers" min="1" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Preferred Date</label>
                            <input type="date" class="form-control" name="travel_date">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Special Requests</label>
                        <textarea class="form-control" name="special_requests" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        Complete Booking
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .detail-item {
        padding-bottom: 12px;
        border-bottom: 1px solid #e0e0e0;
    }

    .detail-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    /* Accordion Animation */
    .card-header .btn-link i {
        transition: transform 0.3s ease;
    }

    .card-header .btn-link[aria-expanded="true"] i {
        transform: rotate(180deg);
    }

    /* Carousel Thumbnails */
    .carousel-thumb {
        opacity: 0.6;
        border-color: #ddd !important;
    }

    .carousel-thumb:hover,
    .carousel-thumb.active {
        opacity: 1;
        border-color: #DB1A1A !important;
    }

    /* Tour Carousel */
    .tour-carousel .item {
        padding: 0 10px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .carousel-thumbnails {
            overflow-x: auto;
            flex-wrap: nowrap;
        }

        #map {
            height: 300px !important;
        }
    }
</style>

<!-- Owl Carousel Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

<script>
    $(document).ready(function() {
        // Initialize Owl Carousel
        $("#tourCarousel").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000,
            margin: 0,
            nav: true,
            navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
            dots: false
        });

        // Thumbnail click handler
        $('.carousel-thumb').on('click', function() {
            let index = $(this).data('index');
            $("#tourCarousel").trigger('to.owl.carousel', [index, 300]);
            
            // Update active thumbnail
            $('.carousel-thumb').removeClass('active').css('opacity', '0.6');
            $(this).addClass('active').css('opacity', '1');
        });

        // Update thumbnail when carousel slides
        $("#tourCarousel").on('changed.owl.carousel', function(e) {
            $('.carousel-thumb').removeClass('active').css('opacity', '0.6');
            $('.carousel-thumb').eq(e.item.index).addClass('active').css('opacity', '1');
        });

        // Initialize Map (if needed)
        if (document.getElementById('map')) {
            // Add your map initialization code here
            // Example: Google Maps, Mapbox, Leaflet, etc.
        }
    });
</script>

<style>
  /* =============================================
   Single Tour Page Styles
   ============================================= */

/* Improved Card Styling */
.rounded-lg {
    border-radius: 12px !important;
}

.shadow-sm {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08) !important;
}

/* Price Card */
.price-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    border-radius: 12px;
    padding: 30px;
}

.price-card h4 {
    font-size: 32px;
    font-weight: 800;
    margin-bottom: 10px;
}

.price-card p {
    font-size: 13px;
    opacity: 0.9;
}

/* Tour Details Card */
.details-card {
    background: #f8f9fa;
    border-left: 4px solid #DB1A1A;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #e0e0e0;
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-label {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    color: #999;
    letter-spacing: 0.5px;
}

.detail-value {
    font-weight: 600;
    color: #333;
}

/* Accordion Styles */
.accordion .card {
    border: none;
    border-radius: 8px;
    margin-bottom: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.accordion .card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.accordion .card-header {
    padding: 0;
    background: linear-gradient(135deg, #2c687b 0%, #3d7a99 100%);
    border: none;
}

.accordion .card-header button {
    color: #fff;
    font-weight: 600;
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    padding: 18px 20px;
    text-align: left;
}

.accordion .card-header button:hover {
    background: rgba(0, 0, 0, 0.1);
}

.accordion .card-header button[aria-expanded="true"] {
    background: rgba(0, 0, 0, 0.15);
}

.accordion .card-body {
    padding: 20px;
    background: #f9f9f9;
    color: #666;
    line-height: 1.8;
}

/* Itinerary List */
.itinerary-item {
    position: relative;
    padding-left: 30px;
    margin-bottom: 20px;
}

.itinerary-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 20px;
    height: 20px;
    background: #DB1A1A;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 12px;
    font-weight: bold;
}

/* Includes/Excludes List */
.include-item,
.exclude-item {
    display: flex;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f0f0f0;
}

.include-item:last-child,
.exclude-item:last-child {
    border-bottom: none;
}

.include-item i {
    color: #28a745;
    margin-right: 12px;
    font-weight: bold;
    min-width: 16px;
}

.exclude-item i {
    color: #dc3545;
    margin-right: 12px;
    font-weight: bold;
    min-width: 16px;
}

/* Form Styling */
.inquiry-form {
    background: #f8f9fa;
    padding: 30px;
    border-radius: 12px;
    border: 1px solid #e0e0e0;
}

.inquiry-form .form-group label {
    font-weight: 600;
    color: #333;
    font-size: 14px;
    margin-bottom: 8px;
}

.inquiry-form .form-control {
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 12px 15px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.inquiry-form .form-control:focus {
    border-color: #DB1A1A;
    box-shadow: 0 0 0 0.2rem rgba(219, 26, 26, 0.25);
}

.inquiry-form textarea.form-control {
    resize: vertical;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
}

/* Share Buttons */
.share-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    color: #fff;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 16px;
}

.share-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    text-decoration: none;
    color: #fff;
}

/* Gallery/Carousel */
.tour-carousel {
    border-radius: 8px;
    overflow: hidden;
}

.tour-carousel .owl-nav {
    position: absolute;
    top: 50%;
    width: 100%;
    transform: translateY(-50%);
    display: flex;
    justify-content: space-between;
    padding: 0 15px;
    z-index: 10;
}

.tour-carousel .owl-nav button {
    background: rgba(0, 0, 0, 0.4) !important;
    color: #fff !important;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    border: none;
}

.tour-carousel .owl-nav button:hover {
    background: #DB1A1A !important;
}

/* Thumbnail Gallery */
.carousel-thumbnails {
    display: flex;
    gap: 10px;
    overflow-x: auto;
    padding: 10px 0;
}

.carousel-thumb {
    width: 80px;
    height: 60px;
    object-fit: cover;
    border-radius: 6px;
    border: 2px solid #ddd;
    cursor: pointer;
    opacity: 0.6;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.carousel-thumb:hover {
    opacity: 1;
    border-color: #DB1A1A;
}

.carousel-thumb.active {
    opacity: 1;
    border-color: #DB1A1A;
    box-shadow: 0 0 0 3px rgba(219, 26, 26, 0.2);
}

/* Map Section */
#map {
    width: 100%;
    height: 400px;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Modal Customization */
.modal-content {
    border: none;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
}

.modal-header {
    border-bottom: 1px solid #f0f0f0;
    padding: 25px;
    background: #f8f9fa;
}

.modal-title {
    font-weight: 700;
    color: #333;
}

/* Booking Button */
.btn-book {
    background: linear-gradient(135deg, #2c687b 0%, #3d7a99 100%);
    border: none;
    color: #fff;
    font-weight: 700;
    padding: 14px 28px;
    border-radius: 50px;
    transition: all 0.3s ease;
}

.btn-book:hover {
    background: #DB1A1A;
    color: #fff;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

/* Related Tours Section */
.related-tours {
    background: #f8f9fa;
    padding: 60px 0;
    margin-top: 60px;
}

.related-tour-card {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}

.related-tour-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
}

/* Breadcrumb Customization */
.breadcrumbs {
    font-size: 14px;
    color: rgba(255, 255, 255, 0.9);
}

.breadcrumbs a {
    color: #fff;
    text-decoration: none;
    transition: color 0.3s ease;
}

.breadcrumbs a:hover {
    color: #DB1A1A;
}

/* Hero Section */
.hero-wrap-2 {
    position: relative;
    background-attachment: fixed;
    background-size: cover;
    background-position: center;
}

.hero-wrap-2 .overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4);
}

.bread {
    font-size: 48px;
    font-weight: 800;
    color: #fff;
    margin-bottom: 15px;
}

@media (max-width: 768px) {
    .bread {
        font-size: 32px;
    }

    .inquiry-form {
        padding: 20px;
    }

    #map {
        height: 300px;
    }

    .carousel-thumbnails {
        gap: 5px;
    }

    .carousel-thumb {
        width: 60px;
        height: 45px;
    }

    .tour-carousel .owl-nav {
        padding: 0 10px;
    }

    .tour-carousel .owl-nav button {
        width: 35px;
        height: 35px;
        font-size: 14px;
    }
}

/* Responsive Grid */
@media (max-width: 991px) {
    .col-lg-8,
    .col-lg-4 {
        margin-bottom: 30px;
    }
}

/* Utility Classes */
.gap-2 {
    gap: 10px;
}

.cursor-pointer {
    cursor: pointer;
}

.text-truncate-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Loading State */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

/* Custom Scrollbar */
.carousel-thumbnails::-webkit-scrollbar {
    height: 4px;
}

.carousel-thumbnails::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.carousel-thumbnails::-webkit-scrollbar-thumb {
    background: #ddd;
    border-radius: 10px;
}

.carousel-thumbnails::-webkit-scrollbar-thumb:hover {
    background: #DB1A1A;
}

</style>
@endsection

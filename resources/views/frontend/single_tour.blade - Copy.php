@extends('frontend.components.layout')

@section('content')

@php
    if (! function_exists('tourRichTextToHtml')) {
        function tourRichTextToHtml(string $text): string
        {
            $text = trim($text);
            if ($text === '') {
                return '';
            }

            $escaped = e($text);
            $escaped = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $escaped);
            $escaped = preg_replace('/__(.+?)__/', '<strong>$1</strong>', $escaped);
            $escaped = preg_replace('/\*(.+?)\*/', '<em>$1</em>', $escaped);
            $escaped = preg_replace('/_(.+?)_/', '<em>$1</em>', $escaped);

            $lines = preg_split('/\r\n|\r|\n/', $escaped);
            $html = '';
            $listOpen = false;

            foreach ($lines as $line) {
                $trimmedLine = trim($line);
                if ($trimmedLine === '') {
                    if ($listOpen) {
                        $html .= '</ul>';
                        $listOpen = false;
                    }
                    continue;
                }

                if (preg_match('/^[\-\*\+]\s+(.+)$/', $trimmedLine, $matches)) {
                    if (! $listOpen) {
                        $html .= '<ul class="rich-text-list">';
                        $listOpen = true;
                    }
                    $html .= '<li>' . $matches[1] . '</li>';
                    continue;
                }

                if ($listOpen) {
                    $html .= '</ul>';
                    $listOpen = false;
                }

                $html .= '<p>' . $trimmedLine . '</p>';
            }

            if ($listOpen) {
                $html .= '</ul>';
            }

            return $html;
        }
    }

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
    $itinerary = $tour->itineraries->toArray();
    $includes = [];
    $priceIncludesHtml = '';
    if (is_array($tour->includes)) {
        $includes = $tour->includes;
    } elseif (!empty($tour->price_include)) {
        $priceIncludesHtml = tourRichTextToHtml($tour->price_include);
    }
    $excludes = is_array($tour->excludes) ? $tour->excludes : [];
    $highlights = [];
    if (is_array($tour->highlights)) {
        $highlights = $tour->highlights;
    } elseif (!empty($tour->highlight_activities)) {
        $highlights = array_filter(array_map('trim', preg_split('/[\r\n]+/', $tour->highlight_activities)), static fn ($item) => $item !== '');
    }
    $cancellationPolicy = $tour->cancellation_policy ?? '';
    $formattedCancellationPolicy = $cancellationPolicy !== '' ? tourRichTextToHtml($cancellationPolicy) : '';
@endphp

<!-- Hero Section -->
<section class="hero-wrap hero-wrap-2"
    style="background-image: url('{{ $coverImageUrl }}'); min-height: 70vh; position: relative;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" style="min-height: 90vh;">
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

                <!-- =============================================
                     TOUR HIGHLIGHTS SECTION
                ============================================= -->
                @if (!empty($highlights))
                <div class="mb-5">
                    <div class="section-title-bar mb-4">
                        <h2 class="section-title-text">Tour Highlights</h2>
                    </div>
                    <div class="highlights-grid">
                        @foreach ($highlights as $index => $highlight)
                            @if (!empty($highlight['label']))
                            <div class="highlight-card">
                                <div class="highlight-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                                <div class="highlight-icon">
                                    <i class="fa fa-{{ $highlight['icon'] ?? 'star' }}"></i>
                                </div>
                                <div class="highlight-content">
                                    <p class="highlight-label">{{ $highlight['label'] }}</p>
                                    @if (!empty($highlight['description']))
                                        <p class="highlight-desc">{{ $highlight['description'] }}</p>
                                    @endif
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- =============================================
                     PRICE INCLUDES & EXCLUDES SECTION
                ============================================= -->
                <div class="mb-5">
                    <div class="section-title-bar mb-4">
                        <h2 class="section-title-text">What's Included & Excluded</h2>
                    </div>
                    <div class="inc-exc-wrapper">
                        <!-- Included -->
                        <div class="inc-exc-column inc-column">
                            <div class="inc-exc-header inc-header">
                                <i class="fa fa-check-circle mr-2"></i>Included
                            </div>
                            <div class="inc-exc-body">
                            @if (!empty($priceIncludesHtml))
                                {!! $priceIncludesHtml !!}
                            @elseif (!empty($includes))
                                <ul class="inc-exc-list">
                                    @forelse ($includes as $item)
                                        @if (!empty($item['label']))
                                        <li class="inc-exc-item inc-item">
                                            <span class="inc-exc-icon">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <span>{{ $item['label'] }}</span>
                                        </li>
                                        @endif
                                    @empty
                                        <li class="inc-exc-item text-muted">
                                            <span class="inc-exc-icon"><i class="fa fa-minus"></i></span>
                                            <span>No items specified</span>
                                        </li>
                                    @endforelse
                                </ul>
                            @else
                                <p class="text-muted">No items specified</p>
                            @endif
                        </div>
                        </div>

                        <!-- Divider -->
                        <div class="inc-exc-divider"></div>

                        <!-- Excluded -->
                        <div class="inc-exc-column exc-column">
                            <div class="inc-exc-header exc-header">
                                <i class="fa fa-times-circle mr-2"></i>Not Included
                            </div>
                            <ul class="inc-exc-list">
                                @forelse ($excludes as $item)
                                    @if (!empty($item['label']))
                                    <li class="inc-exc-item exc-item">
                                        <span class="inc-exc-icon exc-icon">
                                            <i class="fa fa-times"></i>
                                        </span>
                                        <span>{{ $item['label'] }}</span>
                                    </li>
                                    @endif
                                @empty
                                    <li class="inc-exc-item text-muted">
                                        <span class="inc-exc-icon"><i class="fa fa-minus"></i></span>
                                        <span>No items specified</span>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- =============================================
                     CANCELLATION POLICY SECTION
                ============================================= -->
                <div class="mb-5">
                    <div class="section-title-bar mb-4">
                        <h2 class="section-title-text">Cancellation Policy</h2>
                    </div>
                    <div class="cancellation-wrapper">
                        <div class="cancellation-alert">
                            <i class="fa fa-info-circle cancellation-alert-icon"></i>
                            <p class="cancellation-alert-text">Please read our cancellation policy carefully before booking.</p>
                        </div>

                        @if (!empty($formattedCancellationPolicy))
                            <div class="cancellation-custom-policy">
                                {!! $formattedCancellationPolicy !!}
                            </div>
                        @else
                            <!-- Default policy tiers -->
                            <div class="cancellation-tiers">
                                <div class="cancellation-tier tier-green">
                                    <div class="tier-icon">
                                        <i class="fa fa-calendar-check-o"></i>
                                    </div>
                                    <div class="tier-content">
                                        <h6 class="tier-title">30+ Days Before Departure</h6>
                                        <p class="tier-desc">Full refund minus a small administrative fee.</p>
                                        <span class="tier-badge badge-green">Full Refund</span>
                                    </div>
                                </div>

                                <div class="cancellation-tier tier-yellow">
                                    <div class="tier-icon">
                                        <i class="fa fa-calendar-minus-o"></i>
                                    </div>
                                    <div class="tier-content">
                                        <h6 class="tier-title">15–29 Days Before Departure</h6>
                                        <p class="tier-desc">50% of the total tour cost will be charged as a cancellation fee.</p>
                                        <span class="tier-badge badge-yellow">50% Refund</span>
                                    </div>
                                </div>

                                <div class="cancellation-tier tier-orange">
                                    <div class="tier-icon">
                                        <i class="fa fa-calendar-times-o"></i>
                                    </div>
                                    <div class="tier-content">
                                        <h6 class="tier-title">7–14 Days Before Departure</h6>
                                        <p class="tier-desc">25% of the total tour cost will be refunded.</p>
                                        <span class="tier-badge badge-orange">25% Refund</span>
                                    </div>
                                </div>

                                <div class="cancellation-tier tier-red">
                                    <div class="tier-icon">
                                        <i class="fa fa-ban"></i>
                                    </div>
                                    <div class="tier-content">
                                        <h6 class="tier-title">Less Than 7 Days / No Show</h6>
                                        <p class="tier-desc">No refund will be issued for late cancellations or no-shows.</p>
                                        <span class="tier-badge badge-red">No Refund</span>
                                    </div>
                                </div>
                            </div>

                            <div class="cancellation-notes">
                                <p class="mb-1"><i class="fa fa-asterisk mr-2" style="color: #DB1A1A; font-size: 10px;"></i>
                                    Cancellation requests must be submitted in writing via email.
                                </p>
                                <p class="mb-1"><i class="fa fa-asterisk mr-2" style="color: #DB1A1A; font-size: 10px;"></i>
                                    Refunds are processed within 10–14 business days of approval.
                                </p>
                                <p class="mb-0"><i class="fa fa-asterisk mr-2" style="color: #DB1A1A; font-size: 10px;"></i>
                                    We strongly recommend purchasing travel insurance to protect your booking.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                
                <!-- =============================================
                     DAY-BY-DAY TOUR ITINERARY TIMELINE
                ============================================= -->
                @if (!empty($itinerary))
                <div class="mb-5">
                    <div class="section-title-bar mb-4">
                        <h2 class="section-title-text">Day by Day Itinerary</h2>
                    </div>

                    <!-- Summary strip -->
                    <div class="itinerary-summary-strip mb-4">
                        <div class="itinerary-summary-item">
                            <i class="fa fa-calendar"></i>
                            <span>{{ count($itinerary) }} Days</span>
                        </div>
                        <div class="itinerary-summary-divider"></div>
                        <div class="itinerary-summary-item">
                            <i class="fa fa-moon-o"></i>
                            <span>{{ $tour->duration }} Nights</span>
                        </div>
                        <div class="itinerary-summary-divider"></div>
                        <div class="itinerary-summary-item">
                            <i class="fa fa-map-marker"></i>
                            <span>{{ $locationName }}</span>
                        </div>
                    </div>

                    <!-- Timeline -->
                    <div class="itinerary-timeline">
                        @foreach ($itinerary as $index => $day)
                            @php
                                $dayNumber  = $day['day']         ?? ($index + 1);
                                $dayTitle   = $day['title']        ?? "Day $dayNumber";
                                $dayDesc    = $day['description']  ?? '';
                                $dayImage   = !empty($day['image'])
                                    ? \Illuminate\Support\Facades\Storage::url($day['image'])
                                    : null;
                                $isLast     = $index === count($itinerary) - 1;
                                $meals      = $day['meals']        ?? [];
                                $activities = $day['activities']   ?? [];
                                $accommodation = $day['accommodation'] ?? '';
                            @endphp

                            <div class="itinerary-row {{ $isLast ? 'itinerary-row--last' : '' }}">

                                <!-- Left: day marker -->
                                <div class="itinerary-marker-col">
                                    <div class="itinerary-day-circle">
                                        <span class="itinerary-day-label">Day</span>
                                        <span class="itinerary-day-num">{{ $dayNumber }}</span>
                                    </div>
                                    @if (!$isLast)
                                        <div class="itinerary-connector"></div>
                                    @endif
                                </div>

                                <!-- Right: content card -->
                                <div class="itinerary-content-col">
                                    <div class="itinerary-card-block {{ $index === 0 ? 'itinerary-card-block--active' : '' }}">

                                        <!-- Card header — always visible, click to expand -->
                                        <div class="itinerary-card-header" 
                                            data-toggle="collapse" 
                                            data-target="#itin-day-{{ $index }}" 
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                            role="button">
                                            <div class="itinerary-card-header-left">
                                                <h5 class="itinerary-card-title">{{ $dayTitle }}</h5>
                                                @if (!empty($accommodation))
                                                    <span class="itinerary-accommodation-badge">
                                                        <i class="fa fa-bed mr-1"></i>{{ $accommodation }}
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="itinerary-toggle-btn">
                                                <i class="fa fa-chevron-down"></i>
                                            </div>
                                        </div>

                                        <!-- Collapsible body -->
                                        <div id="itin-day-{{ $index }}" class="collapse {{ $index === 0 ? 'show' : '' }}">
                                            <div class="itinerary-card-body">

                                                @if ($dayImage)
                                                    <img src="{{ $dayImage }}" alt="{{ $dayTitle }}" class="itinerary-day-image">
                                                @endif

                                                @if (!empty($dayDesc))
                                                    <p class="itinerary-desc-text">{!! nl2br(e($dayDesc)) !!}</p>
                                                @endif

                                                <!-- Meals & Activities meta row -->
                                                @if (!empty($meals) || !empty($activities))
                                                <div class="itinerary-meta-row">
                                                    @if (!empty($meals))
                                                    <div class="itinerary-meta-group">
                                                        <span class="itinerary-meta-label">
                                                            <i class="fa fa-cutlery mr-1"></i>Meals
                                                        </span>
                                                        <div class="itinerary-meta-tags">
                                                            @foreach ((array) $meals as $meal)
                                                                <span class="itinerary-tag itinerary-tag--meal">{{ $meal }}</span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @if (!empty($activities))
                                                    <div class="itinerary-meta-group">
                                                        <span class="itinerary-meta-label">
                                                            <i class="fa fa-flag-o mr-1"></i>Activities
                                                        </span>
                                                        <div class="itinerary-meta-tags">
                                                            @foreach ((array) $activities as $activity)
                                                                <span class="itinerary-tag itinerary-tag--activity">{{ $activity }}</span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- /.itinerary-row -->
                        @endforeach
                    </div><!-- /.itinerary-timeline -->
                </div>
                @endif

                <!-- Inquiry Form -->
                <div class="mb-5">
                    <h4 class="mb-4">Interested in this Tour?</h4>
                    <form action="{{ route('send.inquiry') }}" method="POST" class="bg-light p-4 rounded">
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
                        <p style="margin: 0; color: #333; font-weight: 600;">{{ $tour->type->type_name ?? 'N/A' }}</p>
                    </div>
                    @endif

                    @if ($tour->theme)
                    <div class="detail-item mb-3">
                        <span style="color: #999; font-size: 13px; font-weight: 600; text-transform: uppercase;">Theme</span>
                        <p style="margin: 0; color: #333; font-weight: 600;">{{ $tour->theme->theme_name ?? 'N/A' }}</p>
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
    /* =============================================
       Shared Section Title Bar
    ============================================= */
    .section-title-bar {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .section-title-bar::before {
        content: '';
        display: block;
        width: 5px;
        height: 32px;
        background: linear-gradient(180deg, #DB1A1A 0%, #a01212 100%);
        border-radius: 3px;
        flex-shrink: 0;
    }

    .section-title-text {
        font-size: 22px;
        font-weight: 800;
        color: #222;
        margin: 0;
        letter-spacing: -0.3px;
    }

    /* =============================================
       Tour Highlights
    ============================================= */
    .highlights-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .highlight-card {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        background: #fff;
        border: 1px solid #eaeaea;
        border-radius: 10px;
        padding: 18px 16px;
        position: relative;
        overflow: hidden;
        transition: box-shadow 0.25s ease, transform 0.25s ease;
    }

    .highlight-card:hover {
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.09);
        transform: translateY(-2px);
    }

    .highlight-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 3px;
        height: 100%;
        background: linear-gradient(180deg, #DB1A1A, #a01212);
        border-radius: 3px 0 0 3px;
    }

    .highlight-number {
        position: absolute;
        top: 10px;
        right: 12px;
        font-size: 11px;
        font-weight: 800;
        color: #e8e8e8;
        letter-spacing: 0.5px;
    }

    .highlight-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #fef0f0, #fde0e0);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .highlight-icon i {
        color: #DB1A1A;
        font-size: 16px;
    }

    .highlight-content {
        flex: 1;
        min-width: 0;
    }

    .highlight-label {
        font-size: 14px;
        font-weight: 700;
        color: #222;
        margin: 0 0 4px 0;
        line-height: 1.4;
    }

    .highlight-desc {
        font-size: 12px;
        color: #888;
        margin: 0;
        line-height: 1.5;
    }

    @media (max-width: 576px) {
        .highlights-grid {
            grid-template-columns: 1fr;
        }
    }

    /* =============================================
       Itinerary Enhancements
    ============================================= */
    /* =============================================
       Day-by-Day Itinerary Timeline
    ============================================= */

    /* Summary strip */
    .itinerary-summary-strip {
        display: flex;
        align-items: center;
        background: #f4f8fb;
        border: 1px solid #dce8f0;
        border-radius: 10px;
        padding: 14px 22px;
        gap: 0;
    }

    .itinerary-summary-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13.5px;
        font-weight: 600;
        color: #2c687b;
        flex: 1;
        justify-content: center;
    }

    .itinerary-summary-item i {
        font-size: 15px;
        color: #DB1A1A;
    }

    .itinerary-summary-divider {
        width: 1px;
        height: 28px;
        background: #ccdde6;
        flex-shrink: 0;
    }

    /* Timeline layout */
    .itinerary-timeline {
        position: relative;
    }

    .itinerary-row {
        display: flex;
        gap: 0;
        align-items: flex-start;
        position: relative;
    }

    /* Left column: circle + connector line */
    .itinerary-marker-col {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex-shrink: 0;
        width: 68px;
    }

    .itinerary-day-circle {
        width: 54px;
        height: 54px;
        border-radius: 50%;
        background: #2c687b;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 3px 10px rgba(44, 104, 123, 0.3);
        z-index: 2;
        position: relative;
    }

    .itinerary-day-label {
        font-size: 9px;
        font-weight: 700;
        color: rgba(255,255,255,0.7);
        text-transform: uppercase;
        letter-spacing: 0.8px;
        line-height: 1;
    }

    .itinerary-day-num {
        font-size: 20px;
        font-weight: 800;
        color: #fff;
        line-height: 1;
    }

    .itinerary-connector {
        width: 2px;
        background: linear-gradient(180deg, #2c687b 0%, #ccdde6 100%);
        flex: 1;
        min-height: 30px;
    }

    /* Right column: card */
    .itinerary-content-col {
        flex: 1;
        min-width: 0;
        padding-left: 16px;
        padding-bottom: 28px;
    }

    .itinerary-row--last .itinerary-content-col {
        padding-bottom: 0;
    }

    .itinerary-card-block {
        background: #fff;
        border: 1px solid #e4e4e4;
        border-radius: 10px;
        overflow: hidden;
        transition: box-shadow 0.2s;
    }

    .itinerary-card-block--active,
    .itinerary-card-block:hover {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
    }

    .itinerary-card-block--active {
        border-left: 3px solid #2c687b;
    }

    /* Card header (clickable) */
    .itinerary-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 18px;
        cursor: pointer;
        user-select: none;
        background: #fff;
        transition: background 0.15s;
    }

    .itinerary-card-header:hover {
        background: #f8fbfc;
    }

    .itinerary-card-header-left {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .itinerary-card-title {
        font-size: 15px;
        font-weight: 700;
        color: #222;
        margin: 0;
        line-height: 1.3;
    }

    .itinerary-accommodation-badge {
        display: inline-flex;
        align-items: center;
        background: #f0f7fa;
        color: #2c687b;
        border: 1px solid #ccdde6;
        border-radius: 20px;
        padding: 2px 10px;
        font-size: 11.5px;
        font-weight: 600;
    }

    .itinerary-toggle-btn {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 1px solid #e4e4e4;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #888;
        transition: all 0.25s;
    }

    .itinerary-card-header[aria-expanded="true"] .itinerary-toggle-btn {
        background: #2c687b;
        border-color: #2c687b;
        color: #fff;
    }

    .itinerary-card-header[aria-expanded="true"] .itinerary-toggle-btn i {
        transform: rotate(180deg);
    }

    .itinerary-toggle-btn i {
        font-size: 12px;
        transition: transform 0.25s;
    }

    /* Card body */
    .itinerary-card-body {
        padding: 0 18px 18px;
        border-top: 1px solid #f0f0f0;
    }

    .itinerary-day-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        margin: 14px 0;
    }

    .itinerary-desc-text {
        font-size: 14px;
        color: #555;
        line-height: 1.9;
        margin: 14px 0 0;
    }

    /* Meals / Activities meta */
    .itinerary-meta-row {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin-top: 16px;
        padding-top: 14px;
        border-top: 1px solid #f0f0f0;
    }

    .itinerary-meta-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .itinerary-meta-label {
        font-size: 11px;
        font-weight: 700;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 0.6px;
    }

    .itinerary-meta-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .itinerary-tag {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .itinerary-tag--meal {
        background: #fff8e1;
        color: #8a5c00;
        border: 1px solid #ffe082;
    }

    .itinerary-tag--activity {
        background: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #c8e6c9;
    }

    @media (max-width: 576px) {
        .itinerary-marker-col {
            width: 50px;
        }
        .itinerary-day-circle {
            width: 44px;
            height: 44px;
        }
        .itinerary-day-num {
            font-size: 16px;
        }
        .itinerary-summary-strip {
            flex-direction: column;
            gap: 10px;
            padding: 12px 16px;
        }
        .itinerary-summary-divider {
            width: 40px;
            height: 1px;
        }
    }

    /* =============================================
       Includes & Excludes
    ============================================= */
    .inc-exc-wrapper {
        display: flex;
        gap: 0;
        border: 1px solid #e8e8e8;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
    }

    .inc-exc-column {
        flex: 1;
        min-width: 0;
    }

    .inc-exc-header {
        padding: 16px 20px;
        font-weight: 700;
        font-size: 14px;
        display: flex;
        align-items: center;
        letter-spacing: 0.3px;
    }

    .inc-header {
        background: linear-gradient(135deg, #e8f8ee, #d4f0de);
        color: #1a7a3a;
        border-bottom: 1px solid #c3e8d0;
    }

    .exc-header {
        background: linear-gradient(135deg, #fef0f0, #fde0e0);
        color: #9a1c1c;
        border-bottom: 1px solid #f5c8c8;
    }

    .inc-exc-list {
        list-style: none;
        padding: 12px 0;
        margin: 0;
    }

    .inc-exc-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 10px 20px;
        font-size: 13.5px;
        color: #444;
        border-bottom: 1px solid #f5f5f5;
        transition: background 0.2s;
    }

    .inc-exc-item:last-child {
        border-bottom: none;
    }

    .inc-exc-item:hover {
        background: #fafafa;
    }

    .inc-exc-icon {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 1px;
        background: #e8f8ee;
    }

    .inc-exc-icon i {
        font-size: 11px;
        color: #1a7a3a;
        font-weight: bold;
    }

    .exc-icon {
        background: #fef0f0;
    }

    .exc-icon i {
        color: #c0392b;
    }

    .inc-exc-divider {
        width: 1px;
        background: #e8e8e8;
        flex-shrink: 0;
    }

    @media (max-width: 640px) {
        .inc-exc-wrapper {
            flex-direction: column;
        }
        .inc-exc-divider {
            width: 100%;
            height: 1px;
        }
    }

    /* =============================================
       Cancellation Policy
    ============================================= */
    .cancellation-wrapper {
        border: 1px solid #e8e8e8;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
    }

    .cancellation-alert {
        display: flex;
        align-items: center;
        gap: 12px;
        background: linear-gradient(135deg, #fff8e1, #fff3cd);
        border-bottom: 1px solid #ffe082;
        padding: 14px 20px;
    }

    .cancellation-alert-icon {
        color: #f59e0b;
        font-size: 18px;
        flex-shrink: 0;
    }

    .cancellation-alert-text {
        margin: 0;
        font-size: 13px;
        color: #78520a;
        font-weight: 500;
    }

    .cancellation-tiers {
        padding: 8px 0;
    }

    .cancellation-tier {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 18px 20px;
        border-bottom: 1px solid #f5f5f5;
        transition: background 0.2s;
    }

    .cancellation-tier:last-child {
        border-bottom: none;
    }

    .cancellation-tier:hover {
        background: #fafafa;
    }

    .tier-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 18px;
    }

    .tier-green .tier-icon  { background: #e8f8ee; color: #1a7a3a; }
    .tier-yellow .tier-icon { background: #fffbeb; color: #d97706; }
    .tier-orange .tier-icon { background: #fff4e5; color: #c2460c; }
    .tier-red .tier-icon    { background: #fef0f0; color: #c0392b; }

    .tier-content {
        flex: 1;
    }

    .tier-title {
        font-size: 14px;
        font-weight: 700;
        color: #222;
        margin: 0 0 4px 0;
    }

    .tier-desc {
        font-size: 13px;
        color: #666;
        margin: 0 0 8px 0;
        line-height: 1.5;
    }

    .tier-badge {
        display: inline-block;
        padding: 3px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.4px;
        text-transform: uppercase;
    }

    .badge-green  { background: #e8f8ee; color: #1a7a3a; }
    .badge-yellow { background: #fffbeb; color: #d97706; }
    .badge-orange { background: #fff4e5; color: #c2460c; }
    .badge-red    { background: #fef0f0; color: #c0392b; }

    .cancellation-notes {
        background: #f8f9fa;
        border-top: 1px solid #e8e8e8;
        padding: 16px 20px;
    }

    .cancellation-notes p {
        font-size: 12.5px;
        color: #777;
        line-height: 1.6;
    }

    .cancellation-custom-policy {
        padding: 24px;
        font-size: 14px;
        color: #555;
        line-height: 1.9;
        background: #fff;
    }

    /* =============================================
       Existing styles (unchanged)
    ============================================= */
    .detail-item {
        padding-bottom: 12px;
        border-bottom: 1px solid #e0e0e0;
    }

    .detail-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .card-header .btn-link i {
        transition: transform 0.3s ease;
    }

    .card-header .btn-link[aria-expanded="true"] i.fa-chevron-down {
        transform: rotate(180deg);
    }

    .carousel-thumb {
        opacity: 0.6;
        border-color: #ddd !important;
    }

    .carousel-thumb:hover,
    .carousel-thumb.active {
        opacity: 1;
        border-color: #DB1A1A !important;
    }

    .tour-carousel .item {
        padding: 0 10px;
    }

    .rounded-lg {
        border-radius: 12px !important;
    }

    .shadow-sm {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08) !important;
    }

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

    .carousel-thumb.active {
        opacity: 1;
        border-color: #DB1A1A;
        box-shadow: 0 0 0 3px rgba(219, 26, 26, 0.2);
    }

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

    .breadcrumbs {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.9);
    }

    .breadcrumbs a {
        color: #fff;
        text-decoration: none;
    }

    .gap-2 { gap: 10px; }
    .cursor-pointer { cursor: pointer; }

    @media (max-width: 768px) {
        .bread { font-size: 32px; }
        .carousel-thumbnails { gap: 5px; }
        .carousel-thumb { width: 60px; height: 45px; }
    }

    @media (max-width: 991px) {
        .col-lg-8, .col-lg-4 { margin-bottom: 30px; }
    }

    .carousel-thumbnails::-webkit-scrollbar { height: 4px; }
    .carousel-thumbnails::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
    .carousel-thumbnails::-webkit-scrollbar-thumb { background: #ddd; border-radius: 10px; }
    .carousel-thumbnails::-webkit-scrollbar-thumb:hover { background: #DB1A1A; }

    .inc-exc-body {
        line-height: 1.75;
    }

    .inc-exc-body p {
        margin: 0 0 0.85rem;
    }

    .inc-exc-body ul {
        margin: 0 0 0.85rem 0;
        padding-left: 1.35rem;
    }

    .inc-exc-body li {
        margin-bottom: 0.5rem;
    }

    .inc-exc-body strong {
        font-weight: 700;
    }

    .inc-exc-body em {
        font-style: italic;
    }
</style>

<!-- Owl Carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

<script>
    $(document).ready(function() {
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

        $('.carousel-thumb').on('click', function() {
            let index = $(this).data('index');
            $("#tourCarousel").trigger('to.owl.carousel', [index, 300]);
            $('.carousel-thumb').removeClass('active').css('opacity', '0.6');
            $(this).addClass('active').css('opacity', '1');
        });

        $("#tourCarousel").on('changed.owl.carousel', function(e) {
            $('.carousel-thumb').removeClass('active').css('opacity', '0.6');
            $('.carousel-thumb').eq(e.item.index).addClass('active').css('opacity', '1');
        });

        // Sync itinerary header aria-expanded for chevron rotation
        $('[id^="itin-day-"]').on('show.bs.collapse', function() {
            var id = $(this).attr('id');
            $('[data-target="#' + id + '"]').attr('aria-expanded', 'true');
        }).on('hide.bs.collapse', function() {
            var id = $(this).attr('id');
            $('[data-target="#' + id + '"]').attr('aria-expanded', 'false');
        });
    });
</script>

@endsection
@extends('frontend.components.layout')

@section('content')

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
        <div class="td-main">

            {{-- ── Package Header Card ── --}}
            <div class="td-card td-package-header">
                <div class="td-package-header__left">
                    <h2 class="td-package-header__title">{{ $tour->title }}</h2>
                    {{-- Star rating --}}
                    <div class="td-stars mb-2">
                        @for ($s = 0; $s < 4; $s++)<i class="fa fa-star"></i>@endfor
                    </div>
                    {{-- Meta chips --}}
                    <div class="td-meta-row">
                        <span class="td-meta-chip">
                            <i class="fa fa-moon-o"></i>
                            {{ $tour->duration }}D/N
                        </span>
                        <span class="td-meta-chip">
                            <i class="fa fa-users"></i>
                            pax: 10
                        </span>
                        @if ($tour->type)
                        <span class="td-meta-chip">
                            <i class="fa fa-tag"></i>
                            {{ $tour->type->type_name ?? '' }}
                        </span>
                        @endif
                        <span class="td-meta-chip">
                            <i class="fa fa-map-marker"></i>
                            {{ $locationName }}
                        </span>
                    </div>
                </div>
                <div class="td-package-header__price">
                    @if ($tour->discount_price)
                    <div class="td-price__old">${{ number_format((float)$tour->price, 0) }}</div>
                    @endif
                    <div class="td-price__main">${{ number_format((float)$displayPrice, 0) }}</div>
                    <div class="td-price__label">per person</div>
                </div>
            </div>

            {{-- ── Overview ── --}}
            <div class="td-card">
                <h3 class="td-section-title">Overview :</h3>
                <p class="td-overview-text">{{ $tour->description }}</p>

                @if (!empty($highlights))
                <div class="td-highlights mt-3">
                    <h4 class="td-sub-title">Tour Highlights</h4>
                    <div class="td-highlights-grid">
                        @foreach ($highlights as $i => $h)
                        @php $label = is_array($h) ? ($h['label'] ?? '') : $h; @endphp
                        @if (!empty($label))
                        <div class="td-highlight-item">
                            <i class="fa fa-check-circle"></i>
                            <span>{{ $label }}</span>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- ── Include & Exclude ── --}}
            <div class="td-card">
                <h3 class="td-section-title">Include &amp; Exclude :</h3>
                <div class="td-inc-exc">
                    {{-- Included --}}
                    <div class="td-inc-exc__col">
                        @if (!empty($priceIncludesHtml))
                        <div class="td-inc-exc__html">{!! $priceIncludesHtml !!}</div>
                        @elseif (!empty($includes))
                        @foreach ($includes as $item)
                        @if (!empty($item['label']))
                        <div class="td-inc-exc__row td-inc-exc__row--inc">
                            <i class="fa fa-check"></i>
                            <span>{{ $item['label'] }}</span>
                        </div>
                        @endif
                        @endforeach
                        @else
                        <div class="td-inc-exc__row td-inc-exc__row--inc">
                            <i class="fa fa-check"></i><span>Specialized bilingual guide</span>
                        </div>
                        <div class="td-inc-exc__row td-inc-exc__row--inc">
                            <i class="fa fa-check"></i><span>Private Transport</span>
                        </div>
                        <div class="td-inc-exc__row td-inc-exc__row--inc">
                            <i class="fa fa-check"></i><span>Entrance Fees</span>
                        </div>
                        <div class="td-inc-exc__row td-inc-exc__row--inc">
                            <i class="fa fa-check"></i><span>Breakfast And Lunch Box</span>
                        </div>
                        @endif
                    </div>
                    {{-- Excluded --}}
                    <div class="td-inc-exc__col">
                        @if (!empty($excludes))
                        @foreach ($excludes as $item)
                        @if (!empty($item['label']))
                        <div class="td-inc-exc__row td-inc-exc__row--exc">
                            <i class="fa fa-times"></i>
                            <span>{{ $item['label'] }}</span>
                        </div>
                        @endif
                        @endforeach
                        @else
                        <div class="td-inc-exc__row td-inc-exc__row--exc">
                            <i class="fa fa-times"></i><span>Guide Service Fee</span>
                        </div>
                        <div class="td-inc-exc__row td-inc-exc__row--exc">
                            <i class="fa fa-times"></i><span>Room Service Fees</span>
                        </div>
                        <div class="td-inc-exc__row td-inc-exc__row--exc">
                            <i class="fa fa-times"></i><span>Driver Service Fee</span>
                        </div>
                        <div class="td-inc-exc__row td-inc-exc__row--exc">
                            <i class="fa fa-times"></i><span>Any Private Expenses</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ── Itinerary ── --}}
            @if (!empty($itinerary))
            <div class="td-card">
                <h3 class="td-section-title">Itinerary :</h3>
                <p class="td-overview-text mb-4">{{ $tour->description }}</p>
                <div class="td-itinerary">
                    @foreach ($itinerary as $idx => $day)
                    @php
                    $dayNumber = $day['day'] ?? ($idx + 1);
                    $dayTitle = $day['title'] ?? "Day $dayNumber";
                    $dayDesc = $day['description'] ?? '';
                    $isLast = $idx === count($itinerary) - 1;
                    $meals = $day['meals'] ?? [];
                    $activities = $day['activities'] ?? [];
                    $accommodation = $day['accommodation'] ?? '';
                    $dayImage = !empty($day['image'])
                    ? \Illuminate\Support\Facades\Storage::url($day['image'])
                    : null;
                    @endphp
                    <div class="td-itin-row {{ $isLast ? 'td-itin-row--last' : '' }}">
                        <div class="td-itin-dot">
                            <span class="td-itin-num">{{ str_pad($dayNumber, 2, '0', STR_PAD_LEFT) }}</span>
                            @if (!$isLast)<div class="td-itin-line"></div>@endif
                        </div>
                        <div class="td-itin-body">
                            <button class="td-itin-toggle" data-toggle="collapse" data-target="#itin-{{ $idx }}"
                                aria-expanded="{{ $idx === 0 ? 'true' : 'false' }}">
                                <span class="td-itin-toggle__title">{{ $dayTitle }}</span>
                                <i class="fa fa-chevron-down td-itin-toggle__chevron"></i>
                            </button>
                            <div id="itin-{{ $idx }}" class="collapse {{ $idx === 0 ? 'show' : '' }} td-itin-content">
                                @if ($dayImage)
                                <img src="{{ $dayImage }}" alt="{{ $dayTitle }}" class="td-itin-img">
                                @endif
                                @if (!empty($dayDesc))
                                <p class="td-itin-desc">{!! nl2br(e($dayDesc)) !!}</p>
                                @endif
                                @if (!empty($accommodation))
                                <p class="td-itin-stay"><i class="fa fa-bed mr-1"></i>{{ $accommodation }}</p>
                                @endif
                                @if (!empty($meals) || !empty($activities))
                                <div class="td-itin-tags">
                                    @foreach ((array)$meals as $m)
                                    <span class="td-tag td-tag--meal"><i class="fa fa-cutlery mr-1"></i>{{ $m }}</span>
                                    @endforeach
                                    @foreach ((array)$activities as $a)
                                    <span class="td-tag td-tag--act"><i class="fa fa-flag-o mr-1"></i>{{ $a }}</span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- ── Cancellation Policy ── --}}
            <div class="td-card">
                <h3 class="td-section-title">Cancellation Policy :</h3>
                @if (!empty($formattedCancellationPolicy))
                <div class="td-overview-text">{!! $formattedCancellationPolicy !!}</div>
                @else
                <div class="td-overview-text">No cancellation policy available.</div>
                {{-- <div class="td-cancel-tiers">
                    <div class="td-cancel-tier td-cancel-tier--green">
                        <i class="fa fa-calendar-check-o"></i>
                        <div>
                            <strong>30+ Days Before</strong>
                            <p>Full refund minus a small administrative fee.</p>
                        </div>
                        <span class="td-cancel-badge td-cancel-badge--green">Full Refund</span>
                    </div>
                    <div class="td-cancel-tier td-cancel-tier--yellow">
                        <i class="fa fa-calendar-minus-o"></i>
                        <div>
                            <strong>15–29 Days Before</strong>
                            <p>50% cancellation fee applies.</p>
                        </div>
                        <span class="td-cancel-badge td-cancel-badge--yellow">50% Refund</span>
                    </div>
                    <div class="td-cancel-tier td-cancel-tier--orange">
                        <i class="fa fa-calendar-times-o"></i>
                        <div>
                            <strong>7–14 Days Before</strong>
                            <p>25% of the total tour cost will be refunded.</p>
                        </div>
                        <span class="td-cancel-badge td-cancel-badge--orange">25% Refund</span>
                    </div>
                    <div class="td-cancel-tier td-cancel-tier--red">
                        <i class="fa fa-ban"></i>
                        <div>
                            <strong>Less Than 7 Days / No Show</strong>
                            <p>No refund will be issued.</p>
                        </div>
                        <span class="td-cancel-badge td-cancel-badge--red">No Refund</span>
                    </div>
                </div> --}}
                @endif
            </div>

            {{-- ── Inquiry Form ── --}}
            <div class="td-card">
                <h3 class="td-section-title">Send an Inquiry :</h3>
                <form action="{{ route('send.inquiry') }}" method="POST" class="td-inquiry-form">
                    @csrf
                    <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                    <div class="td-form-row">
                        <div class="td-form-group">
                            <input type="text" name="full_name" class="td-input" placeholder="Your Name *" required>
                        </div>
                        <div class="td-form-group">
                            <input type="email" name="email" class="td-input" placeholder="Your Email *" required>
                        </div>
                    </div>
                    <div class="td-form-row">
                        <div class="td-form-group">
                            <input type="tel" name="phone" class="td-input" placeholder="Phone Number *" required>
                        </div>
                        <div class="td-form-group">
                            <input type="number" name="travelers" class="td-input" placeholder="No. of Travelers *"
                                min="1" required>
                        </div>
                    </div>
                    <div class="td-form-row">
                        <div class="td-form-group">
                            <input type="date" name="start_date" class="td-input">
                        </div>
                        <div class="td-form-group">
                            <select name="budget" class="td-input">
                                <option value="">Budget Range</option>
                                <option value="budget">Under $1,000</option>
                                <option value="moderate">$1,000 – $2,500</option>
                                <option value="mid-range">$2,500 – $5,000</option>
                                <option value="luxury">Above $5,000</option>
                            </select>
                        </div>
                    </div>
                    <div class="td-form-group td-form-group--full">
                        <textarea name="message" class="td-input td-textarea"
                            placeholder="Message / Special Requests"></textarea>
                    </div>
                    <button type="submit" class="td-btn-primary td-btn-full">
                        <i class="fa fa-paper-plane mr-2"></i>Send Inquiry
                    </button>
                </form>
            </div>

        </div>{{-- /td-main --}}


        {{-- ======================== RIGHT SIDEBAR ======================== --}}
        <div class="td-sidebar">
            {{-- ── Related Images ── --}}
            @if (!empty($tourImages))
            <div class="td-card td-related-images">
                <h4 class="td-sidebar-section-title">Image Gallery</h4>
                <p class="td-sidebar-section-sub">Explore the beautiful destinations on this tour.</p>
                <div class="td-related-grid">
                    @foreach (array_slice($tourImages, 0, 4) as $img)
                    <img src="{{ $img }}" alt="Related" class="td-related-img">
                    @endforeach
                </div>
            </div>
            @endif

            {{-- ── Tour Details ── --}}
            <div class="td-card td-tour-details-card">
                <h4 class="td-sidebar-section-title">Tour Details</h4>
                <div class="td-detail-row">
                    <span class="td-detail-label"><i class="fa fa-moon-o"></i> Duration</span>
                    <span class="td-detail-value">{{ $tour->duration }} Nights</span>
                </div>
                <div class="td-detail-row">
                    <span class="td-detail-label"><i class="fa fa-map-marker"></i> Destination</span>
                    <span class="td-detail-value">{{ $locationName }}</span>
                </div>
                @if ($tour->type)
                <div class="td-detail-row">
                    <span class="td-detail-label"><i class="fa fa-tag"></i> Tour Type</span>
                    <span class="td-detail-value">{{ $tour->type->type_name ?? 'N/A' }}</span>
                </div>
                @endif
                @if ($tour->theme)
                <div class="td-detail-row">
                    <span class="td-detail-label"><i class="fa fa-paint-brush"></i> Theme</span>
                    <span class="td-detail-value">{{ $tour->theme->theme_name ?? 'N/A' }}</span>
                </div>
                @endif
                <div class="td-detail-row">
                    <span class="td-detail-label"><i class="fa fa-dollar"></i> Price</span>
                    <span class="td-detail-value td-detail-value--price">${{ number_format((float)$displayPrice, 0) }} /
                        person</span>
                </div>

                <button class="btn btn-primary btn-block mt-5" data-toggle="modal" data-target="#bookingModal">
                    <i class="fa fa-calendar mr-2"></i>Book Now
                </button>
            </div>

            {{-- ── Share ── --}}
            <div class="td-card">
                <h4 class="td-sidebar-section-title">Share This Tour</h4>
                <div class="td-share-row">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank"
                        class="td-share-btn td-share-btn--fb">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $tour->title }}"
                        target="_blank" class="td-share-btn td-share-btn--tw">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a href="https://wa.me/?text={{ $tour->title }}%20{{ url()->current() }}" target="_blank"
                        class="td-share-btn td-share-btn--wa">
                        <i class="fa fa-whatsapp"></i>
                    </a>
                    <a href="mailto:?subject={{ $tour->title }}&body={{ url()->current() }}"
                        class="td-share-btn td-share-btn--em">
                        <i class="fa fa-envelope"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Tours Section -->
<section class="ftco-section bg-light">
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
</section>

{{-- Booking Modal --}}
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 10px; border: none;">
            <div class="modal-header" style="background: #2c687b; color: #fff; border-radius: 10px 10px 0 0;">
                <h5 class="modal-title" style="font-weight: 700;">Book {{ $tour->title }}</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 1;">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                    <input type="text" name="full_name" class="td-input mb-3" placeholder="Full Name *" required>
                    <div class="td-form-row">
                        <input type="email" name="email" class="td-input" placeholder="Email *" required>
                        <input type="tel" name="phone" class="td-input" placeholder="Phone *" required>
                    </div>
                    <div class="td-form-row mt-3">
                        <input type="number" name="travelers" class="td-input" placeholder="Travelers *" min="1"
                            required>
                        <input type="date" name="travel_date" class="td-input">
                    </div>
                    <textarea name="special_requests" class="td-input td-textarea mt-3"
                        placeholder="Special Requests"></textarea>
                    <button type="submit" class="td-btn-primary td-btn-full mt-3">Complete Booking</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ============================================================
STYLES
============================================================ --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<style>
    /* ── Reset helpers ── */
    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    .td-page {
        padding-top: 36px;
        padding-bottom: 56px;
    }

    /* ── Hero ── */
    .td-hero {
        position: relative;
        height: 400px;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: flex-end;
    }

    .td-hero__overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0.6) 100%);
    }

    .td-hero__inner {
        position: relative;
        z-index: 1;
        padding-bottom: 28px;
    }

    .td-hero__title {
        font-size: 30px;
        font-weight: 800;
        color: #fff;
        margin: 6px 0 0;
        line-height: 1.2;
    }

    .td-breadcrumb {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.85);
    }

    .td-breadcrumb a {
        color: #fff;
        text-decoration: none;
    }

    .td-breadcrumb a:hover {
        text-decoration: underline;
    }

    .td-breadcrumb i {
        font-size: 10px;
    }

    /* ── Two-column layout ── */
    .td-layout {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 28px;
        align-items: start;
    }

    @media (max-width: 992px) {
        .td-layout {
            grid-template-columns: 1fr;
        }

        .td-sidebar {
            order: -1;
        }
    }

    /* ── Card ── */
    .td-card {
        background: #fff;
        border: 1px solid #e8e8e8;
        border-radius: 8px;
        padding: 24px;
        margin-bottom: 20px;
    }

    /* ── Package Header ── */
    .td-package-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
    }

    .td-package-header__title {
        font-size: 22px;
        font-weight: 800;
        color: #222;
        margin: 0 0 6px;
        line-height: 1.25;
    }

    .td-stars i {
        color: #f5a623;
        font-size: 14px;
        margin-right: 2px;
    }

    .td-meta-row {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 10px;
    }

    .td-meta-chip {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #f4f8fa;
        border: 1px solid #dce8f0;
        border-radius: 20px;
        padding: 4px 12px;
        font-size: 12px;
        font-weight: 600;
        color: #2c687b;
    }

    .td-meta-chip i {
        color: #DB1A1A;
        font-size: 11px;
    }

    .td-price__main {
        font-size: 30px;
        font-weight: 900;
        color: #DB1A1A;
        line-height: 1;
    }

    .td-price__old {
        font-size: 14px;
        color: #aaa;
        text-decoration: line-through;
        margin-bottom: 2px;
    }

    .td-price__label {
        font-size: 12px;
        color: #999;
        margin-top: 3px;
        white-space: nowrap;
    }

    /* ── Gallery ── */
    .td-gallery__img {
        width: 100%;
        height: 380px;
        object-fit: cover;
        border-radius: 6px;
        display: block;
    }

    .td-gallery__thumbs {
        display: flex;
        gap: 8px;
        margin-top: 10px;
        overflow-x: auto;
        padding-bottom: 4px;
    }

    .td-gallery__thumb {
        width: 78px;
        height: 56px;
        object-fit: cover;
        border-radius: 5px;
        border: 2px solid #e0e0e0;
        cursor: pointer;
        opacity: 0.6;
        transition: opacity .25s, border-color .25s;
        flex-shrink: 0;
    }

    .td-gallery__thumb.active,
    .td-gallery__thumb:hover {
        opacity: 1;
        border-color: #DB1A1A;
    }

    /* ── Section titles ── */
    .td-section-title {
        font-size: 17px;
        font-weight: 800;
        color: #222;
        margin: 0 0 16px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .td-section-title::before {
        content: '';
        display: inline-block;
        width: 4px;
        height: 18px;
        background: #DB1A1A;
        border-radius: 3px;
    }

    .td-sub-title {
        font-size: 14px;
        font-weight: 700;
        color: #333;
        margin: 0 0 10px;
    }

    .td-overview-text {
        font-size: 14px;
        color: #555;
        line-height: 1.9;
        margin: 0;
    }

    /* ── Highlights ── */
    .td-highlights-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }

    @media (max-width: 576px) {
        .td-highlights-grid {
            grid-template-columns: 1fr;
        }
    }

    .td-highlight-item {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        font-size: 13px;
        color: #444;
        padding: 6px 0;
    }

    .td-highlight-item i {
        color: #DB1A1A;
        margin-top: 2px;
        flex-shrink: 0;
    }

    /* ── Include & Exclude ── */
    .td-inc-exc {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0;
        border: 1px solid #e8e8e8;
        border-radius: 7px;
        overflow: hidden;
    }

    @media (max-width: 576px) {
        .td-inc-exc {
            grid-template-columns: 1fr;
        }
    }

    .td-inc-exc__col {
        padding: 16px 18px;
    }

    .td-inc-exc__col:first-child {
        border-right: 1px solid #e8e8e8;
    }

    .td-inc-exc__row {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 13.5px;
        color: #444;
        padding: 7px 0;
        border-bottom: 1px solid #f5f5f5;
    }

    .td-inc-exc__row:last-child {
        border-bottom: none;
    }

    .td-inc-exc__row--inc i {
        color: #1a7a3a;
        margin-top: 2px;
    }

    .td-inc-exc__row--exc i {
        color: #c0392b;
        margin-top: 2px;
    }

    .td-inc-exc__html {
        font-size: 13.5px;
        color: #444;
        line-height: 1.8;
    }

    /* ── Itinerary ── */
    .td-itinerary {
        position: relative;
    }

    .td-itin-row {
        display: flex;
        gap: 16px;
        align-items: flex-start;
        padding-bottom: 20px;
    }

    .td-itin-row--last {
        padding-bottom: 0;
    }

    .td-itin-dot {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex-shrink: 0;
        width: 44px;
    }

    .td-itin-num {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #2c687b;
        color: #fff;
        font-size: 13px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        z-index: 1;
        box-shadow: 0 2px 8px rgba(44, 104, 123, .3);
    }

    .td-itin-line {
        width: 2px;
        flex: 1;
        min-height: 20px;
        background: linear-gradient(#2c687b, #dce8f0);
        margin-top: 4px;
    }

    .td-itin-body {
        flex: 1;
        min-width: 0;
    }

    .td-itin-toggle {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        background: #f8fbfc;
        border: 1px solid #dce8f0;
        border-radius: 6px;
        padding: 10px 14px;
        cursor: pointer;
        text-align: left;
        transition: background .2s;
    }

    .td-itin-toggle:hover {
        background: #edf5f8;
    }

    .td-itin-toggle[aria-expanded="true"] {
        background: #2c687b;
        border-color: #2c687b;
    }

    .td-itin-toggle[aria-expanded="true"] .td-itin-toggle__title {
        color: #fff;
    }

    .td-itin-toggle[aria-expanded="true"] .td-itin-toggle__chevron {
        color: #fff;
        transform: rotate(180deg);
    }

    .td-itin-toggle__title {
        font-size: 14px;
        font-weight: 700;
        color: #222;
    }

    .td-itin-toggle__chevron {
        font-size: 12px;
        color: #888;
        transition: transform .25s;
        flex-shrink: 0;
    }

    .td-itin-content {
        padding: 14px 0 0 0;
        font-size: 13.5px;
        color: #555;
        line-height: 1.8;
    }

    .td-itin-img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 6px;
        margin-bottom: 10px;
        display: block;
    }

    .td-itin-desc {
        margin: 0 0 10px;
    }

    .td-itin-stay {
        font-size: 13px;
        color: #2c687b;
        font-weight: 600;
        margin: 6px 0;
    }

    .td-itin-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 8px;
    }

    .td-tag {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .td-tag--meal {
        background: #fff8e1;
        color: #8a5c00;
        border: 1px solid #ffe082;
    }

    .td-tag--act {
        background: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #c8e6c9;
    }

    /* ── Cancellation ── */
    .td-cancel-tiers {
        display: flex;
        flex-direction: column;
        gap: 0;
        border: 1px solid #e8e8e8;
        border-radius: 8px;
        overflow: hidden;
    }

    .td-cancel-tier {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 18px;
        border-bottom: 1px solid #f0f0f0;
        font-size: 13.5px;
        transition: background .2s;
    }

    .td-cancel-tier:last-child {
        border-bottom: none;
    }

    .td-cancel-tier:hover {
        background: #fafafa;
    }

    .td-cancel-tier>i {
        font-size: 22px;
        flex-shrink: 0;
    }

    .td-cancel-tier>div {
        flex: 1;
    }

    .td-cancel-tier>div strong {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: #222;
        margin-bottom: 2px;
    }

    .td-cancel-tier>div p {
        margin: 0;
        font-size: 12.5px;
        color: #666;
    }

    .td-cancel-tier--green>i {
        color: #1a7a3a;
    }

    .td-cancel-tier--yellow>i {
        color: #d97706;
    }

    .td-cancel-tier--orange>i {
        color: #c2460c;
    }

    .td-cancel-tier--red>i {
        color: #c0392b;
    }

    .td-cancel-badge {
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .td-cancel-badge--green {
        background: #e8f8ee;
        color: #1a7a3a;
    }

    .td-cancel-badge--yellow {
        background: #fffbeb;
        color: #d97706;
    }

    .td-cancel-badge--orange {
        background: #fff4e5;
        color: #c2460c;
    }

    .td-cancel-badge--red {
        background: #fef0f0;
        color: #c0392b;
    }

    /* ── Inquiry Form ── */
    .td-inquiry-form {}

    .td-form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 12px;
    }

    @media (max-width: 576px) {
        .td-form-row {
            grid-template-columns: 1fr;
        }
    }

    .td-form-group {
        display: flex;
        flex-direction: column;
    }

    .td-form-group--full {
        margin-bottom: 12px;
    }

    .td-input {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 13.5px;
        color: #333;
        background: #fafafa;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .td-input:focus {
        border-color: #2c687b;
        box-shadow: 0 0 0 3px rgba(44, 104, 123, .1);
        background: #fff;
    }

    .td-input::placeholder {
        color: #aaa;
    }

    .td-textarea {
        resize: vertical;
        min-height: 110px;
    }

    .mb-2 {
        margin-bottom: 8px !important;
    }

    .mb-3 {
        margin-bottom: 12px !important;
    }

    .mt-2 {
        margin-top: 8px !important;
    }

    .mt-3 {
        margin-top: 12px !important;
    }

    /* ── Buttons ── */
    .td-btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #DB1A1A;
        color: #fff;
        border: none;
        padding: 11px 24px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: background .2s, transform .15s;
        text-decoration: none;
    }

    .td-btn-primary:hover {
        background: #b51414;
        transform: translateY(-1px);
        color: #fff;
    }

    .td-btn-full {
        width: 100%;
    }

    /* ── SIDEBAR ── */
    .td-sidebar {
        position: sticky;
        top: 20px;
    }

    @media (max-width: 992px) {
        .td-sidebar {
            position: static;
        }
    }

    /* Booking card */
    .td-booking-card {
        padding: 0;
        overflow: hidden;
    }

    .td-booking-card__head {
        background: #2c687b;
        color: #fff;
        padding: 14px 20px;
        font-size: 15px;
        font-weight: 700;
        display: flex;
        align-items: center;
    }

    .td-booking-card__body {
        padding: 18px 20px;
    }

    .td-booking-card__intro {
        font-size: 13px;
        color: #666;
        margin-bottom: 14px;
        line-height: 1.6;
    }

    /* Sidebar section titles */
    .td-sidebar-section-title {
        font-size: 15px;
        font-weight: 800;
        color: #222;
        margin: 0 0 6px;
    }

    .td-sidebar-section-sub {
        font-size: 12.5px;
        color: #999;
        margin: 0 0 12px;
    }

    /* Related images */
    .td-related-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }

    .td-related-img {
        width: 100%;
        height: 90px;
        object-fit: cover;
        border-radius: 6px;
        display: block;
        transition: opacity .2s;
    }

    .td-related-img:hover {
        opacity: .85;
    }

    /* Tour details */
    .td-detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 9px 0;
        border-bottom: 1px solid #f0f0f0;
        font-size: 13px;
    }

    .td-detail-row:last-child {
        border-bottom: none;
    }

    .td-detail-label {
        color: #888;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .td-detail-label i {
        color: #DB1A1A;
    }

    .td-detail-value {
        color: #333;
        font-weight: 700;
    }

    .td-detail-value--price {
        color: #DB1A1A;
    }

    /* More packages */
    .td-more-packages {
        padding: 0;
        overflow: hidden;
    }

    .td-more-packages__head {
        background: #2c687b;
        color: #fff;
        padding: 13px 18px;
        font-size: 14px;
        font-weight: 700;
        display: flex;
        align-items: center;
    }

    .td-more-packages__list {
        list-style: none;
        padding: 8px 0;
        margin: 0;
    }

    .td-more-packages__list li a {
        display: flex;
        align-items: center;
        padding: 10px 18px;
        font-size: 13.5px;
        color: #444;
        text-decoration: none;
        border-bottom: 1px solid #f0f0f0;
        transition: background .15s, color .15s;
    }

    .td-more-packages__list li:last-child a {
        border-bottom: none;
    }

    .td-more-packages__list li a:hover {
        background: #f4f8fa;
        color: #2c687b;
    }

    .td-more-packages__list li a i {
        color: #DB1A1A;
    }

    /* Share buttons */
    .td-share-row {
        display: flex;
        gap: 8px;
    }

    .td-share-btn {
        width: 36px;
        height: 36px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-decoration: none;
        font-size: 15px;
        transition: opacity .2s;
    }

    .td-share-btn:hover {
        opacity: .85;
        color: #fff;
    }

    .td-share-btn--fb {
        background: #3b5998;
    }

    .td-share-btn--tw {
        background: #1da1f2;
    }

    .td-share-btn--wa {
        background: #25d366;
    }

    .td-share-btn--em {
        background: #EA4335;
    }

    /* owl carousel nav */
    .owl-nav button {
        background: rgba(255, 255, 255, .85) !important;
        border-radius: 50% !important;
        width: 34px !important;
        height: 34px !important;
    }

    .owl-nav button span {
        font-size: 18px;
        line-height: 1;
        color: #333;
    }

    .modal-title {
        color: #fff;
    }
</style>

{{-- ============================================================
SCRIPTS
============================================================ --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
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
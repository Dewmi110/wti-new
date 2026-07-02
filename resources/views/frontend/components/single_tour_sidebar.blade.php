<div class="td-sidebar">
            {{-- ── Related Images ── --}}
            @if (!empty($tourImages))
            <div class="td-card td-related-images">
                <h4 class="td-sidebar-section-title">Image Gallery</h4>
                <p class="td-sidebar-section-sub">Explore the beautiful destinations on this tour.</p>
                <div class="td-related-grid">
                    @foreach (array_slice($tourImages, 0, 4) as $index => $img)
                    <div class="td-related-img-wrap" onclick="openLightbox('{{ $img }}', {{ $index }})">
                        <img src="{{ $img }}" alt="Related" class="td-related-img">
                        <div class="td-related-overlay"><i class="fa fa-search-plus"></i></div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- ── Lightbox ── --}}
            <div id="sc-lightbox" class="sc-lightbox-backdrop" onclick="closeLightbox()">
                <button class="sc-lightbox-close" onclick="closeLightbox()">&times;</button>
                <button class="sc-lightbox-prev" onclick="event.stopPropagation(); changeImage(-1)">&#10094;</button>
                <button class="sc-lightbox-next" onclick="event.stopPropagation(); changeImage(1)">&#10095;</button>
                <div class="sc-lightbox-content" onclick="event.stopPropagation()">
                    <img id="sc-lightbox-img" src="" alt="Tour Image">
                </div>
            </div>

            {{-- ── Tour Details ── --}}
            <div class="td-card td-tour-details-card">
                <h4 class="td-sidebar-section-title">Tour Details</h4>
                <div class="td-detail-row">
                    <span class="td-detail-label"><i class="fa fa-moon-o"></i> Duration</span>
                    <span class="td-detail-value">{{ $tour->duration }} Nights</span>
                </div>
                <div class="td-detail-row">
                    <span class="td-detail-label"><i class="fa fa-map-marker"></i> Location</span>
                    <span class="td-detail-value">{{ $locationName }}</span>
                </div>
                <div class="td-detail-row">
                    <span class="td-detail-label"><i class="fa fa-map-marker"></i> Destinations</span>
                    <span class="td-detail-value">
                        {{ $tourDestinations->pluck('name')->implode(', ') }}
                    </span>
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
                    <span class="td-detail-value td-detail-value--price">{{ $tour->currency }} {{ number_format((float)$displayPrice, 0) }} /
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
                    {{-- <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $tour->title }}"
                        target="_blank" class="td-share-btn td-share-btn--tw">
                        <i class="fa fa-twitter"></i>
                    </a> --}}
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
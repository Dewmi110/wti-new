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
                            {{ $tour->duration ?? '' }}
                        </span>
                        <span class="td-meta-chip">
                            <i class="fa fa-users"></i>
                            package for {{ $tour->group_size ?? '' }} people
                        </span>
                        @if ($tour->type)
                        <span class="td-meta-chip">
                            <i class="fa fa-tag"></i>
                            {{ $tour->type->type_name ?? '' }}
                        </span>
                        @endif
                        <span class="td-meta-chip">
                            <i class="fa fa-map-marker"></i>
                            {{ $locationName ?? '' }}
                        </span>
                    </div>
                </div>
                <div class="td-package-header__price">
                    @if ($tour->discount_price)
                    <div class="td-price__old">{{ $tour->currency }} {{ number_format((float)$tour->price, 0) ? : '_' }}</div>
                    @endif
                    <div class="td-price__main">{{ $tour->currency }} {{ number_format((float)$displayPrice, 0) ? : '_' }}</div>
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
                        @forelse($includes as $item)
                            <div class="td-inc-exc__row td-inc-exc__row--inc">
                                <i class="fa fa-check"></i>
                                <span>{{ $item->title }}</span>
                            </div>
                        @empty
                            <div class="td-overview-text">No inclusions listed.</div>
                        @endforelse
                    </div>
                    {{-- Excluded --}}
                    <div class="td-inc-exc__col">
                        @forelse($excludes as $item)
                            <div class="td-inc-exc__row td-inc-exc__row--exc">
                                <i class="fa fa-times"></i>
                                <span>{{ $item->title }}</span>
                            </div>
                        @empty
                            <div class="td-overview-text">No exclusions listed.</div>
                        @endforelse
                    </div>
                </div>
            </div>
            @if(!empty($mapImageUrl))
            <div class="td-card">
                <h3 class="td-section-title">Tour Map :</h3>
                <img src="{{ $mapImageUrl ?? asset('images/default.png') }}" alt="{{ $tour->title }} route map" style="width:80%; border-radius:12px;">
            </div>
            @endif

            {{-- ── Itinerary ── --}}
            @include('frontend.components.tour_itinerary')

            {{-- ── Cancellation Policy ── --}}
            <div class="td-card">
                <h3 class="td-section-title">Cancellation Policy :</h3>
                @forelse($cancellationPolicies as $policy)
                    <div class="td-highlight-item" style="margin-bottom:8px;">
                        <i class="fa fa-check-circle"></i>
                        <span>
                            <strong>{{ $policy->title }}</strong>
                            @if($policy->description)
                                — {{ $policy->description }}
                            @endif
                        </span>
                    </div>
                @empty
                    <div class="td-overview-text">No cancellation policy available.</div>
                @endforelse
            </div>

            {{-- ── Inquiry Form ── --}}
            <div class="td-card">
                @include('frontend.enquiry_form')
            </div>

        </div>
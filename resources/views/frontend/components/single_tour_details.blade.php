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
            @include('frontend.components.tour_itinerary')

            {{-- ── Cancellation Policy ── --}}
            <div class="td-card">
                <h3 class="td-section-title">Cancellation Policy :</h3>
                @if (!empty($formattedCancellationPolicy))
                <div class="td-overview-text">{!! $formattedCancellationPolicy !!}</div>
                @else
                <div class="td-overview-text">No cancellation policy available.</div>
                @endif
            </div>

            {{-- ── Inquiry Form ── --}}
            <div class="td-card">
                @include('frontend.enquiry_form')
            </div>

        </div>
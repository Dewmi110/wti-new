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
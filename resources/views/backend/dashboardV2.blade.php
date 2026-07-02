@extends('backend.components.layoutV2')
@section('main')
<!-- MAIN -->
@include('backend.components.navbars.header')

  <!-- CONTENT -->
  <div class="content">

    <!-- MAIN COLUMN -->
    <div class="content-main">

      <!-- STATS -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon" style="background:#f0eeff;color:#6c5ce7;"><i class="fas fa-dollar-sign"></i></div>
          <div>
            <div class="stat-value">{{ $totalBookings }}</div>
            <div class="stat-label">Bookings</div>
          </div>
          <div class="stat-change up"><i class="fas fa-arrow-up" style="font-size:9px"></i> {{ $totalBookings }} total</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:#e8f8f3;color:#00b894;"><i class="fas fa-users"></i></div>
          <div>
            <div class="stat-value">{{ number_format($activeUsers) }}</div>
            <div class="stat-label">Active Users</div>
          </div>
          <div class="stat-change up"><i class="fas fa-arrow-up" style="font-size:9px"></i> Registered</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:#fff4e6;color:#fdcb6e;"><i class="fas fa-user-plus"></i></div>
          <div>
            <div class="stat-value">{{ number_format($totalDestinations) }}</div>
            <div class="stat-label">Total Destinations</div>
          </div>
          <div class="stat-change up"><i class="fas fa-arrow-up" style="font-size:9px"></i> Active</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:#e8f2ff;color:#74b9ff;"><i class="fas fa-chart-line"></i></div>
          <div>
            <div class="stat-value">{{ number_format($totalCountries) }}</div>
            <div class="stat-label">Total Countries</div>
          </div>
          <div class="stat-change up"><i class="fas fa-arrow-up" style="font-size:9px"></i> Covered</div>
        </div>
      </div>

      <!-- HOTELS / FEATURED TOURS -->
      <div class="card">
        <div class="section-header">
          <div class="section-title">Tours</div>
          <a href="{{ route('admin.tours.index') }}" class="see-all">See all <i class="fas fa-chevron-right" style="font-size:10px"></i></a>
        </div>
        <div class="tabs">
          <div class="tab active">Recently Added</div>
          <div class="tab">Featured</div>
          <div class="tab">Home</div>
        </div>
        <div class="hotels-grid">
          @forelse ($featuredTours as $tour)
            <div class="hotel-card">
              @if($tour->image)
                <div class="hotel-img" style="background-image:url('{{ asset('storage/' . $tour->image) }}');background-size:cover;background-position:center;"></div>
              @else
                <div class="hotel-img" style="background:linear-gradient(135deg,#2c5364,#203a43,#0f2027);display:flex;align-items:center;justify-content:center;font-size:40px;">🏯</div>
              @endif
              <div class="hotel-overlay">
                <div class="hotel-name">{{ $tour->name }}</div>
                <div class="hotel-location">{{ $tour->destination->name ?? 'N/A' }}</div>
                <div class="hotel-meta">
                  <span><i class="fas fa-calendar-alt"></i> {{ $tour->duration ?? '—' }}</span>
                  <span><i class="fas fa-star" style="color:#fdcb6e"></i> {{ $tour->rating ?? '4.5' }}</span>
                </div>
              </div>
            </div>
          @empty
            <p style="color:var(--text-muted);font-size:13px;">No tours found.</p>
          @endforelse
        </div>
      </div>

      <!-- BOOKING HISTORY + BEST RESORTS -->
      <div class="two-col">

        <!-- BOOKING HISTORY -->
        <div class="card">
          <div class="section-header">
            <div>
              <div class="section-title">Booking History</div>
              <div style="font-size:11px;color:var(--text-muted);margin-top:2px;">{{ $totalBookings }} Bookings found</div>
            </div>
            <button class="filter-btn"><i class="fas fa-sliders-h"></i> Filters</button>
          </div>
          <div class="booking-list">
            @forelse ($recentBookings as $booking)
              <div class="booking-item">
                <div class="booking-thumb-placeholder" style="background:#e8f2ff;">🌊</div>
                <div class="booking-info">
                  <div class="booking-name">{{ $booking->tour->name ?? $booking->name ?? 'Untitled' }}</div>
                  <div class="booking-loc"><i class="fas fa-map-marker-alt" style="font-size:9px"></i> {{ $booking->tour->destination->name ?? '—' }}</div>
                </div>
                <div class="booking-date"><i class="fas fa-plane" style="color:var(--purple)"></i> {{ \Carbon\Carbon::parse($booking->created_at)->format('d-m-Y') }}</div>
                <div class="booking-adjust">{{ $booking->status ?? 'Pending' }}</div>
              </div>
            @empty
              <p style="color:var(--text-muted);font-size:13px;">No bookings yet.</p>
            @endforelse
          </div>
        </div>

        <!-- BEST RESORTS -->
        {{-- <div class="card">
          <div class="section-header">
            <div class="section-title">Best Resorts</div>
            <div style="display:flex;gap:6px;">
              <button class="icon-btn" style="width:28px;height:28px;font-size:12px"><i class="fas fa-minus"></i></button>
              <button class="icon-btn" style="width:28px;height:28px;font-size:12px"><i class="fas fa-sliders-h"></i></button>
            </div>
          </div>
          @forelse ($bestResorts as $resort)
            <div class="resort-item">
              <div class="resort-thumb-placeholder" style="background:#e8f8f3;">🏝️</div>
              <div class="resort-info">
                <div class="resort-name">{{ $resort->name }}</div>
                <div class="resort-country"><i class="fas fa-map-marker-alt" style="font-size:9px"></i> {{ $resort->destination->country->name ?? '—' }}</div>
              </div>
              <div class="resort-price">${{ $resort->price ?? '0' }}<span>/day</span></div>
            </div>
          @empty
            <p style="color:var(--text-muted);font-size:13px;">No data available.</p>
          @endforelse
        </div> --}}

      </div>

    </div>

    <!-- SIDE COLUMN -->
    <div class="content-side">

      <!-- CALENDAR -->
      <div class="card">
        <div class="section-title" style="margin-bottom:14px">Available Dates</div>
        <div class="calendar-header">
          <button class="cal-nav"><i class="fas fa-chevron-left"></i></button>
          <span class="cal-title">{{ now()->format('F Y') }}</span>
          <button class="cal-nav"><i class="fas fa-chevron-right"></i></button>
        </div>
        <div class="cal-grid">
          <div class="cal-day-label">Mon</div>
          <div class="cal-day-label">Tue</div>
          <div class="cal-day-label">Wed</div>
          <div class="cal-day-label">Thu</div>
          <div class="cal-day-label">Fri</div>
          <div class="cal-day-label">Sat</div>
          <div class="cal-day-label">Sun</div>

          @php
            $firstDay = \Carbon\Carbon::now()->startOfMonth();
            $daysInMonth = $firstDay->daysInMonth;
            $startOffset = $firstDay->dayOfWeekIso - 1; // Mon=0
            $today = now()->day;
          @endphp

          @for ($i = 0; $i < $startOffset; $i++)
            <div class="cal-day muted"></div>
          @endfor

          @for ($day = 1; $day <= $daysInMonth; $day++)
            <div class="cal-day {{ $day == $today ? 'today' : '' }}">{{ $day }}</div>
          @endfor
        </div>
      </div>

      <!-- TRANSPORTATION -->
      {{-- <div class="card">
        <div class="section-title" style="margin-bottom:14px">Transportation</div>
        <div class="transport-grid">
          <div class="transport-btn active">
            <i class="fas fa-plane"></i>
            Flight
          </div>
          <div class="transport-btn">
            <i class="fas fa-train"></i>
            Train
          </div>
          <div class="transport-btn">
            <i class="fas fa-ship"></i>
            Ship
          </div>
          <div class="transport-btn">
            <i class="fas fa-bus"></i>
            Bus
          </div>
          <div class="transport-btn">
            <i class="fas fa-car"></i>
            Car
          </div>
          <div class="transport-btn add">
            <i class="fas fa-plus"></i>
            More
          </div>
        </div>
      </div> --}}

    </div>
  </div>
@endsection
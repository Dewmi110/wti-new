@extends('backend.components.layoutV2')
@section('main')
<!-- MAIN -->
{{-- <main class="main"> --}}
 
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
            <div class="stat-value">$53k</div>
            <div class="stat-label">Today's Revenue</div>
          </div>
          <div class="stat-change up"><i class="fas fa-arrow-up" style="font-size:9px"></i> +55% vs last week</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:#e8f8f3;color:#00b894;"><i class="fas fa-users"></i></div>
          <div>
            <div class="stat-value">2,300</div>
            <div class="stat-label">Active Users</div>
          </div>
          <div class="stat-change up"><i class="fas fa-arrow-up" style="font-size:9px"></i> +3% vs last month</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:#fff4e6;color:#fdcb6e;"><i class="fas fa-user-plus"></i></div>
          <div>
            <div class="stat-value">3,462</div>
            <div class="stat-label">New Clients</div>
          </div>
          <div class="stat-change down"><i class="fas fa-arrow-down" style="font-size:9px"></i> -2% vs yesterday</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:#e8f2ff;color:#74b9ff;"><i class="fas fa-chart-line"></i></div>
          <div>
            <div class="stat-value">$103k</div>
            <div class="stat-label">Total Sales</div>
          </div>
          <div class="stat-change up"><i class="fas fa-arrow-up" style="font-size:9px"></i> +5% vs yesterday</div>
        </div>
      </div>
 
      <!-- HOTELS -->
      <div class="card">
        <div class="section-header">
          <div class="section-title">Hotels</div>
          <div class="see-all">See all <i class="fas fa-chevron-right" style="font-size:10px"></i></div>
        </div>
        <div class="tabs">
          <div class="tab active">Most popular</div>
          <div class="tab">Best price</div>
          <div class="tab">Near me</div>
        </div>
        <div class="hotels-grid">
          <div class="hotel-card">
            <div class="hotel-img" style="background:linear-gradient(135deg,#2c5364,#203a43,#0f2027);display:flex;align-items:center;justify-content:center;font-size:40px;">🏯</div>
            <div class="hotel-overlay">
              <div class="hotel-name">Oasis Kathmandu Hotel</div>
              <div class="hotel-location">Nepal</div>
              <div class="hotel-meta">
                <span><i class="fas fa-calendar-alt"></i> 3–5 days</span>
                <span><i class="fas fa-star" style="color:#fdcb6e"></i> 4.5</span>
              </div>
            </div>
          </div>
          <div class="hotel-card">
            <div class="hotel-img" style="background:linear-gradient(135deg,#c94b4b,#4b134f);display:flex;align-items:center;justify-content:center;font-size:40px;">🕌</div>
            <div class="hotel-overlay">
              <div class="hotel-name">Jhon Mugal Agra Hotel</div>
              <div class="hotel-location">Mahal</div>
              <div class="hotel-meta">
                <span><i class="fas fa-calendar-alt"></i> 5–7 days</span>
                <span><i class="fas fa-star" style="color:#fdcb6e"></i> 4.7</span>
              </div>
            </div>
          </div>
          <div class="hotel-card">
            <div class="hotel-img" style="background:linear-gradient(135deg,#1a6b4a,#0e4229);display:flex;align-items:center;justify-content:center;font-size:40px;">🌴</div>
            <div class="hotel-overlay">
              <div class="hotel-name">Pan Pacific Toronto</div>
              <div class="hotel-location">Canada</div>
              <div class="hotel-meta">
                <span><i class="fas fa-calendar-alt"></i> 2–4 days</span>
                <span><i class="fas fa-star" style="color:#fdcb6e"></i> 4.7</span>
              </div>
            </div>
          </div>
        </div>
      </div>
 
      <!-- BOOKING HISTORY + BEST RESORTS -->
      <div class="two-col">
 
        <!-- BOOKING HISTORY -->
        <div class="card">
          <div class="section-header">
            <div>
              <div class="section-title">Booking History</div>
              <div style="font-size:11px;color:var(--text-muted);margin-top:2px;">120 Destinations found</div>
            </div>
            <button class="filter-btn"><i class="fas fa-sliders-h"></i> Filters</button>
          </div>
          <div class="booking-list">
            <div class="booking-item">
              <div class="booking-thumb-placeholder" style="background:#e8f2ff;">🌊</div>
              <div class="booking-info">
                <div class="booking-name">Star Pacific Ocean</div>
                <div class="booking-loc"><i class="fas fa-map-marker-alt" style="font-size:9px"></i> USA, Miami (3 Night)</div>
              </div>
              <div class="booking-date"><i class="fas fa-plane" style="color:var(--purple)"></i> 07-12-2024</div>
              <div class="booking-adjust">1 Adjust</div>
            </div>
            <div class="booking-item">
              <div class="booking-thumb-placeholder" style="background:#e8f8f3;">🌉</div>
              <div class="booking-info">
                <div class="booking-name">Wallpaper Bridge</div>
                <div class="booking-loc"><i class="fas fa-map-marker-alt" style="font-size:9px"></i> England, London (7 Night)</div>
              </div>
              <div class="booking-date"><i class="fas fa-plane" style="color:var(--purple)"></i> 09-12-2024</div>
              <div class="booking-adjust">3 Adjust</div>
            </div>
            <div class="booking-item">
              <div class="booking-thumb-placeholder" style="background:#fff4e6;">🏙️</div>
              <div class="booking-info">
                <div class="booking-name">Dubai Hotel</div>
                <div class="booking-loc"><i class="fas fa-map-marker-alt" style="font-size:9px"></i> UAE, Dubai (4 Night)</div>
              </div>
              <div class="booking-date"><i class="fas fa-plane" style="color:var(--purple)"></i> 13-12-2024</div>
              <div class="booking-adjust">2 Adjust</div>
            </div>
            <div class="booking-item">
              <div class="booking-thumb-placeholder" style="background:#fce8f4;">🌊</div>
              <div class="booking-info">
                <div class="booking-name">Anagram Water Falls</div>
                <div class="booking-loc"><i class="fas fa-map-marker-alt" style="font-size:9px"></i> USA, Miami (3 Night)</div>
              </div>
              <div class="booking-date"><i class="fas fa-plane" style="color:var(--purple)"></i> 22-12-2024</div>
              <div class="booking-adjust">3 Adjust</div>
            </div>
          </div>
        </div>
 
        <!-- BEST RESORTS -->
        <div class="card">
          <div class="section-header">
            <div class="section-title">Best Resorts</div>
            <div style="display:flex;gap:6px;">
              <button class="icon-btn" style="width:28px;height:28px;font-size:12px"><i class="fas fa-minus"></i></button>
              <button class="icon-btn" style="width:28px;height:28px;font-size:12px"><i class="fas fa-sliders-h"></i></button>
            </div>
          </div>
          <div class="resort-item">
            <div class="resort-thumb-placeholder" style="background:#e8f8f3;">🏝️</div>
            <div class="resort-info">
              <div class="resort-name">Heritage Resort</div>
              <div class="resort-country"><i class="fas fa-map-marker-alt" style="font-size:9px"></i> Singapore</div>
            </div>
            <div class="resort-price">$120<span>/day</span></div>
          </div>
          <div class="resort-item">
            <div class="resort-thumb-placeholder" style="background:#f0eeff;">⛩️</div>
            <div class="resort-info">
              <div class="resort-name">Royal Hills Resort</div>
              <div class="resort-country"><i class="fas fa-map-marker-alt" style="font-size:9px"></i> Thailand</div>
            </div>
            <div class="resort-price">$110<span>/day</span></div>
          </div>
          <div class="resort-item">
            <div class="resort-thumb-placeholder" style="background:#e8f2ff;">🌿</div>
            <div class="resort-info">
              <div class="resort-name">Greenview Resort</div>
              <div class="resort-country"><i class="fas fa-map-marker-alt" style="font-size:9px"></i> India</div>
            </div>
            <div class="resort-price">$120<span>/day</span></div>
          </div>
        </div>
 
      </div>
 
      <!-- CHART -->
      <div class="card">
        <div class="section-header">
          <div>
            <div class="section-title">Revenue Overview</div>
            <div style="font-size:11px;color:var(--text-muted);margin-top:2px;">Monthly performance 2024</div>
          </div>
          <div style="display:flex;gap:16px;font-size:11px;">
            <span style="display:flex;align-items:center;gap:5px"><span style="width:10px;height:10px;border-radius:2px;background:#6c5ce7;display:inline-block"></span> Bookings</span>
            <span style="display:flex;align-items:center;gap:5px"><span style="width:10px;height:10px;border-radius:2px;background:#00b894;display:inline-block"></span> Revenue</span>
          </div>
        </div>
        <div class="chart-wrap">
          <canvas id="revenueChart" role="img" aria-label="Monthly revenue and bookings chart for 2024. Revenue peaks in July and December.">Monthly revenue overview showing bookings and revenue for each month of 2024.</canvas>
        </div>
      </div>
 
    </div>
 
    <!-- SIDE COLUMN -->
    <div class="content-side">
 
      <!-- CALENDAR -->
      <div class="card">
        <div class="section-title" style="margin-bottom:14px">Available Dates</div>
        <div class="calendar-header">
          <button class="cal-nav"><i class="fas fa-chevron-left"></i></button>
          <span class="cal-title">January 2024</span>
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
          <!-- Week 1 -->
          <div class="cal-day muted"></div>
          <div class="cal-day muted"></div>
          <div class="cal-day muted"></div>
          <div class="cal-day muted"></div>
          <div class="cal-day muted"></div>
          <div class="cal-day">1</div>
          <div class="cal-day">2</div>
          <!-- Week 2 -->
          <div class="cal-day">3</div>
          <div class="cal-day">4</div>
          <div class="cal-day">5</div>
          <div class="cal-day today">6</div>
          <div class="cal-day">7</div>
          <div class="cal-day">8</div>
          <div class="cal-day">9</div>
          <!-- Week 3 -->
          <div class="cal-day">10</div>
          <div class="cal-day">11</div>
          <div class="cal-day">12</div>
          <div class="cal-day">13</div>
          <div class="cal-day">14</div>
          <div class="cal-day">15</div>
          <div class="cal-day">16</div>
          <!-- Week 4 -->
          <div class="cal-day">17</div>
          <div class="cal-day">18</div>
          <div class="cal-day booked">19</div>
          <div class="cal-day">20</div>
          <div class="cal-day">21</div>
          <div class="cal-day">22</div>
          <div class="cal-day">23</div>
          <!-- Week 5 -->
          <div class="cal-day">24</div>
          <div class="cal-day">25</div>
          <div class="cal-day">26</div>
          <div class="cal-day">27</div>
          <div class="cal-day">28</div>
          <div class="cal-day">29</div>
          <div class="cal-day">30</div>
          <!-- Week 6 -->
          <div class="cal-day">31</div>
        </div>
      </div>
 
      <!-- TRANSPORTATION -->
      <div class="card">
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
      </div>
 
      <!-- MY CARD -->
      <div class="card">
        <div class="section-title" style="margin-bottom:14px">My Card</div>
        <div class="credit-card">
          <div class="card-chip"></div>
          <div class="card-number">4507 8896 5564 6743</div>
          <div style="display:flex;align-items:flex-end;justify-content:space-between">
            <div>
              <div class="card-holder">Card holder</div>
              <div class="card-name">Joy Dey</div>
            </div>
            <div class="card-balance">
              <span>Balance</span>
              $320.91
            </div>
          </div>
          <div style="display:flex;justify-content:space-between;align-items:center;margin-top:14px">
            <div style="font-size:10px;opacity:0.6">RCC Bank</div>
            <div style="display:flex;gap:-4px">
              <div style="width:22px;height:22px;border-radius:50%;background:#fdcb6e;opacity:0.9"></div>
              <div style="width:22px;height:22px;border-radius:50%;background:#e17055;opacity:0.9;margin-left:-8px"></div>
            </div>
          </div>
        </div>
      </div>
 
    </div>
  </div>
{{-- </main> --}}
@endsection
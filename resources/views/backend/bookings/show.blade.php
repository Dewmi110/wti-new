@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')

<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
    <h3 class="card-header-title">Booking #{{ $booking->id }}</h3>
    <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm" style="background:#f1f3f5; color:#555;">
        <i class="fas fa-arrow-left"></i> Back to Bookings
    </a>
</div>

<div style="display:grid; grid-template-columns: 1fr 320px; gap:20px; align-items:start;">

    {{-- ── Left Column ── --}}
    <div style="display:flex; flex-direction:column; gap:20px;">

        {{-- Guest Details --}}
        <div class="card" style="padding:0;">
            <div class="detail-section-header">
                <i class="fas fa-user"></i> Guest Details
            </div>
            <div class="detail-body">
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Full Name</span>
                        <span class="detail-value">{{ $booking->full_name }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Email Address</span>
                        <span class="detail-value">
                            <a href="mailto:{{ $booking->email }}" style="color:#2c687b;">{{ $booking->email }}</a>
                        </span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Phone Number</span>
                        <span class="detail-value">{{ $booking->phone }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Travel Details --}}
        <div class="card" style="padding:0;">
            <div class="detail-section-header">
                <i class="fas fa-plane"></i> Travel Details
            </div>
            <div class="detail-body">
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Tour Package</span>
                        <span class="detail-value">{{ $booking->tour?->title ?? '—' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Travel Date</span>
                        <span class="detail-value">{{ $booking->travel_date?->format('d M Y') ?? '—' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">No. of Travelers</span>
                        <span class="detail-value">{{ $booking->travelers }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Submitted On</span>
                        <span class="detail-value">{{ $booking->created_at?->format('d M Y, h:i A') }}</span>
                    </div>
                </div>

                {{-- Special Requests --}}
                @if($booking->special_requests)
                <div style="margin-top:16px; padding-top:16px; border-top:1px solid #f0f0f0;">
                    <span class="detail-label">Special Requests</span>
                    <div style="margin-top:8px; background:#f9f9f9; border-radius:6px; padding:14px;
                                font-size:14px; color:#555; line-height:1.7;">
                        {{ $booking->special_requests }}
                    </div>
                </div>
                @endif
            </div>
        </div>

    </div>

    {{-- ── Right Column ── --}}
    <div style="display:flex; flex-direction:column; gap:20px;">

        {{-- Status Card --}}
        <div class="card" style="padding:0;">
            <div class="detail-section-header">
                <i class="fas fa-info-circle"></i> Booking Status
            </div>
            <div class="detail-body">
                <div style="margin-bottom:16px; text-align:center;">
                    @if($booking->status === 'confirmed')
                        <span class="td-badge badge-success" style="font-size:14px; padding:8px 20px;">
                            <span class="dot dot-green"></span> Confirmed
                        </span>
                    @elseif($booking->status === 'cancelled')
                        <span class="td-badge badge-dark" style="font-size:14px; padding:8px 20px;">
                            <span class="dot dot-orange"></span> Cancelled
                        </span>
                    @else
                        <span class="td-badge" style="background:#fff8e6; color:#b37400; font-size:14px; padding:8px 20px;">
                            <span class="dot" style="background:#f4a020;"></span> Pending
                        </span>
                    @endif
                </div>

                <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST">
                    @csrf @method('PATCH')
                    <select name="status" class="form-input" style="margin-bottom:10px;">
                        <option value="pending"   {{ $booking->status === 'pending'   ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm" style="width:100%;">
                        <i class="fas fa-save"></i> Update Status
                    </button>
                </form>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="card" style="padding:0;">
            <div class="detail-section-header">
                <i class="fas fa-bolt"></i> Quick Actions
            </div>
            <div class="detail-body" style="display:flex; flex-direction:column; gap:8px;">
                <a href="mailto:{{ $booking->email }}" class="btn btn-sm"
                   style="background:#e8f4f8; color:#2c687b; width:100%; text-align:center;">
                    <i class="fas fa-envelope"></i> Email Guest
                </a>
                <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm"
                            style="background:#ffeaea; color:#c0392b; width:100%;"
                            onclick="return confirm('Delete this booking permanently?')">
                        <i class="fas fa-trash"></i> Delete Booking
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

@if(session('success'))
<div style="position:fixed; bottom:24px; right:24px; background:#2c687b; color:#fff;
            padding:12px 20px; border-radius:8px; font-size:14px; z-index:9999;
            box-shadow:0 4px 12px rgba(0,0,0,0.15);">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif

<style>
.detail-section-header {
    padding: 14px 20px;
    font-size: 13px;
    font-weight: 700;
    color: #2c687b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 1px solid #f0f0f0;
    display: flex;
    align-items: center;
    gap: 8px;
}
.detail-body {
    padding: 20px;
}
.detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}
.detail-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}
.detail-label {
    font-size: 11px;
    color: #aaa;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}
.detail-value {
    font-size: 14px;
    color: #2c3e50;
    font-weight: 600;
}
</style>

@endsection
@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')

<div>
    <h3 class="card-header-title">Bookings</h3>
</div>

<div class="card">

    <div class="table-toolbar">
    <div class="table-search">
        <form method="GET" action="{{ route('admin.bookings.index') }}" style="display:flex; align-items:center; gap:10px;">
            <div class="input-icon-wrap">
                <i class="fas fa-search input-icon"></i>
                <input type="text" name="search" class="form-input"
                       placeholder="Search name or email…" value="{{ request('search') }}">
            </div>
            <select name="status" class="form-input" style="width:150px;">
                <option value="">All Statuses</option>
                <option value="pending"   {{ request('status') === 'pending'   ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-filter"></i> Filter
            </button>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm"
                   style="background:#f1f3f5; color:#555;">
                    <i class="fas fa-times"></i> Reset
                </a>
            @endif
        </form>
    </div>
</div>

    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th width="60">#</th>
                    <th>Guest</th>
                    <th>Tour</th>
                    <th width="100">Travelers</th>
                    <th width="130">Travel Date</th>
                    <th width="110">Status</th>
                    <th width="130">Submitted</th>
                    <th width="120" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                <tr>
                    <td>
                        {{ ($bookings->currentPage() - 1) * $bookings->perPage() + $loop->iteration }}
                    </td>
                    <td>
                        <div class="avatar-info">
                            <strong>{{ $booking->full_name }}</strong>
                            <span><i class="fas fa-envelope" style="font-size:11px; color:#aaa;"></i>
                                {{ $booking->email }}
                            </span>
                            <span><i class="fas fa-phone" style="font-size:11px; color:#aaa;"></i>
                                {{ $booking->phone }}
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="avatar-info">
                            <strong>{{ $booking->tour?->title ?? '—' }}</strong>
                        </div>
                    </td>
                    <td>{{ $booking->travelers }}</td>
                    <td>{{ $booking->travel_date?->format('d M Y') ?? '—' }}</td>
                    <td>
                        @if($booking->status === 'confirmed')
                            <span class="td-badge badge-success">
                                <span class="dot dot-green"></span> Confirmed
                            </span>
                        @elseif($booking->status === 'cancelled')
                            <span class="td-badge badge-dark">
                                <span class="dot dot-orange"></span> Cancelled
                            </span>
                        @else
                            <span class="td-badge" style="background:#fff8e6; color:#b37400;">
                                <span class="dot" style="background:#f4a020;"></span> Pending
                            </span>
                        @endif
                    </td>
                    <td>{{ $booking->created_at?->format('d M Y') }}</td>
                    <td>
                        <div class="td-actions justify-content-center">
                            <a href="{{ route('admin.bookings.show', $booking) }}"
                               class="action-btn action-edit" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-btn action-delete"
                                        onclick="return confirm('Delete this booking?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center" style="padding:40px; color:#aaa;">
                        <i class="fas fa-calendar-times" style="font-size:28px; margin-bottom:8px; display:block;"></i>
                        No bookings found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="table-footer">
        <div class="table-info">
            Showing {{ $bookings->firstItem() ?? 0 }} - {{ $bookings->lastItem() ?? 0 }}
            of {{ $bookings->total() }} bookings
        </div>
        <div>{{ $bookings->withQueryString()->links() }}</div>
    </div>

</div>

<style>
.text-center { text-align: center; }
.justify-content-center { justify-content: center; }
.table-wrap { width: 100%; overflow-x: auto; }
.data-table { width: 100%; }
.d-flex { display: flex; align-items: center; }

.btn-primary {
    background: #2c687b !important;
    border-color: #2c687b !important;
    color: #fff !important;
}
.btn-primary:hover {
    background: #1a4a5a !important;
}
.table-search {
    max-width: 100% !important;
}
/* existing styles below */
.text-center { text-align: center; }
.justify-content-center { justify-content: center; }
.table-wrap { width: 100%; overflow-x: auto; }
.data-table { width: 100%; }

</style>

@endsection
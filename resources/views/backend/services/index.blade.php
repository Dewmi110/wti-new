@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')

<div>
    <h3 class="card-header-title">Services</h3>
</div>

@if(session('success'))
    <div class="alert alert-success mb-3" style="padding:12px 18px;background:#d4edda;color:#155724;border-radius:8px;border:1px solid #c3e6cb;">
        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
    </div>
@endif

<div class="card">

    <div class="table-toolbar">
        <div class="table-search">
            <div class="input-icon-wrap">
                <i class="fas fa-search input-icon"></i>
                <input type="text" id="serviceSearch" class="form-input" placeholder="Search services...">
            </div>
        </div>
        <div class="table-filters">
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Add Service
            </a>
        </div>
    </div>

    <div class="table-wrap">
        <table class="data-table" id="servicesTable">
            <thead>
                <tr>
                    <th width="60">#</th>
                    <th>Service Type</th>
                    <th>Title</th>
                    <th>Banner Image</th>
                    <th>Description</th>
                    <th width="120" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td>{{ ($items->currentPage() - 1) * $items->perPage() + $loop->iteration }}</td>

                    <td>
                        <span class="badge-service-type">
                            {{ $item->serviceType?->name ?? '—' }}
                        </span>
                    </td>

                    <td><strong>{{ $item->title }}</strong></td>

                    <td>
                        @if($item->banner_image)
                            <img src="{{  asset('storage/' . $item->banner_image) }}"
                                alt="Banner"
                                style="width:80px;height:50px;object-fit:cover;border-radius:6px;border:1px solid #ddd;">
                        @else
                            <span style="color:#9ca3af;">No Image</span>
                        @endif
                    </td>

                    <td>
                        <span class="td-desc-clamp">{{ $item->description }}</span>
                    </td>

                    <td>
                        <div class="td-actions justify-content-center">
                            <a href="{{ route('admin.services.edit', $item) }}"
                               class="action-btn action-edit" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.services.destroy', $item) }}"
                                  method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn action-delete"
                                    title="Delete"
                                    onclick="return confirm('Delete this service?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding:32px;color:#6b7280;">
                        <i class="fas fa-inbox" style="font-size:24px;display:block;margin-bottom:8px;"></i>
                        No services found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="table-footer">
        <div class="table-info">
            Showing {{ $items->firstItem() ?? 0 }} – {{ $items->lastItem() ?? 0 }}
            of {{ $items->total() }} services
        </div>
        <div>{{ $items->links() }}</div>
    </div>
</div>

<style>
.text-center       { text-align: center; }
.justify-content-center { justify-content: center; }
.table-wrap        { width: 100%; overflow-x: auto; }
.data-table        { width: 100%; }

.td-desc-clamp {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    max-width: 320px;
    font-size: 13px;
    color: #6b7280;
}

.badge-service-type {
    display: inline-block;
    background: #e8f4f7;
    color: #2C687B;
    font-size: 12px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 100px;
    white-space: nowrap;
}
</style>

<script>
// Live search filter
document.getElementById('serviceSearch').addEventListener('input', function () {
    var q = this.value.toLowerCase();
    document.querySelectorAll('#servicesTable tbody tr').forEach(function (row) {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>

@endsection

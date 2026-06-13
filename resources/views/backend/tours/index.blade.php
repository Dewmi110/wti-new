@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')
<div>
    <h3 class="card-header-title">
        Tour Packages
    </h3>
</div>

<div class="card">

    <div class="table-toolbar">
        <div class="table-search">
            <div class="input-icon-wrap">
                <i class="fas fa-search input-icon"></i>
                <input type="text"
                       class="form-input"
                       placeholder="Search tours...">
            </div>
        </div>

        <div class="table-filters">
            <a href="{{ route('admin.tours.create') }}"
               class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i>
                Create Tour
            </a>
        </div>
    </div>

    <div class="table-wrap">

        <table class="data-table">

            <thead>
                <tr>
                    <th width="70">#</th>
                    <th width="90">Image</th>
                    <th>Tour</th>
                    <th width="150">Type</th>
                    <th width="120">Status</th>
                    <th width="150" class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($tours as $tour)

                    <tr>

                        <td>
                            {{ ($tours->currentPage() - 1) * $tours->perPage() + $loop->iteration }}
                        </td>

                        <td>

                            @php
                                $tourImagePath = $tour->images->first()?->img_path ?? $tour->banner_img_path;
                            @endphp

                            @if($tourImagePath)
                                <img src="{{ Storage::url($tourImagePath) }}"
                                     alt="{{ $tour->title }}"
                                     class="tour-thumb">
                            @else
                                <div class="tour-thumb placeholder-thumb">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif

                        </td>

                        <td>
                            <div class="avatar-info">
                                <strong>{{ $tour->title }}</strong>

                                <span>
                                    {{ \Illuminate\Support\Str::limit(strip_tags($tour->description), 80) }}
                                </span>
                            </div>
                        </td>

                        <td>
                            {{ optional($tour->type)->type_name ?? '-' }}
                        </td>

                        <td>

                            @if($tour->status == 1)
                                <span class="td-badge badge-success">
                                    <span class="dot dot-green"></span>
                                    Active
                                </span>
                            @elseif($tour->status == 0)
                                <span class="td-badge badge-dark">
                                    <span class="dot dot-orange"></span>
                                    Inactive
                                </span>
                            @else
                                <span class="td-badge badge-danger">
                                    <span class="dot"></span>
                                    Deleted
                                </span>
                            @endif

                        </td>

                        <td>

                            <div class="td-actions justify-content-center">

                                <button type="button"
                                        class="action-btn action-view"
                                        data-bs-toggle="modal"
                                        data-bs-target="#tourModal{{ $tour->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <a href="{{ route('admin.tours.edit', $tour) }}"
                                   class="action-btn action-edit">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <form action="{{ route('admin.tours.destroy', $tour) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="action-btn action-delete"
                                            onclick="return confirm('Delete this tour?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center">
                            No tours found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="table-footer">

        <div class="table-info">
            Showing
            {{ $tours->firstItem() ?? 0 }}
            -
            {{ $tours->lastItem() ?? 0 }}
            of
            {{ $tours->total() }}
            tours
        </div>

        <div>
            {{ $tours->links() }}
        </div>

    </div>

</div>

{{-- Tour View Modals --}}
@foreach($tours as $tour)

{{-- <div class="modal fade"
     id="tourModal{{ $tour->id }}"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-scrollable">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    {{ $tour->title }}
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">

                <div class="row g-3">

                    <div class="col-md-6">
                        <strong>Type:</strong>
                        {{ optional($tour->type)->type_name ?? '-' }}
                    </div>

                    <div class="col-md-6">
                        <strong>Country:</strong>
                        {{ optional($tour->countryModel)->name ?? '-' }}
                    </div>

                    <div class="col-md-6">
                        <strong>Duration:</strong>
                        {{ $tour->duration }}
                    </div>

                    <div class="col-md-6">
                        <strong>Price:</strong>
                        {{ number_format($tour->price, 2) }}
                    </div>

                    <div class="col-md-6">
                        <strong>Discount Price:</strong>
                        {{ $tour->discount_price ? number_format($tour->discount_price,2) : '-' }}
                    </div>

                    <div class="col-md-6">
                        <strong>Status:</strong>
                        {{ $tour->status == 1 ? 'Active' : ($tour->status == 0 ? 'Inactive' : 'Deleted') }}
                    </div>

                    <div class="col-12">
                        <strong>Description:</strong>
                        <p class="mt-2">
                            {{ $tour->description }}
                        </p>
                    </div>

                    <div class="col-12">
                        <strong>Highlight Activities:</strong>
                        <p class="mt-2">
                            {{ $tour->highlight_activities ?: '-' }}
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div> --}}

@endforeach

<style>
.tour-thumb{
    width:60px;
    height:60px;
    object-fit:cover;
    border-radius:10px;
}

.placeholder-thumb{
    display:flex;
    align-items:center;
    justify-content:center;
    background:#f3f4f6;
    color:#9ca3af;
}

.text-center{
    text-align:center;
}

.justify-content-center{
    justify-content:center;
}

.table-wrap{
    overflow-x:auto;
}

.data-table{
    width:100%;
}

.badge-danger{
    background:#fee2e2;
    color:#dc2626;
}
</style>

@endsection
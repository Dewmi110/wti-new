@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')
<div>
        <h3 class="card-header-title">
            Destinations
        </h3>
    </div>
<div class="card">

    <div class="table-toolbar">
        <div class="table-search">
            <div class="input-icon-wrap">
                <i class="fas fa-search input-icon"></i>
                <input type="text"
                       class="form-input"
                       placeholder="Search destinations...">
            </div>
        </div>

        <div class="table-filters">
            <a href="{{ route('admin.destinations.create') }}"
               class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i>
                Add Destination
            </a>
        </div>
    </div>

    <div class="table-wrap">

        <table class="data-table">

            <thead>
                <tr>
                    <th width="70">#</th>
                    <th>Image</th>
                    <th>Destination</th>
                    <th>Country</th>
                    <th width="120">Status</th>
                    <th width="120" class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($items as $it)

                    <tr>

                        <td>
                            {{ ($items->currentPage() - 1) * $items->perPage() + $loop->iteration }}
                        </td>

                        <td>

                            @php
                                $ImagePath = $it->image;
                            @endphp

                            @if($ImagePath)
                                <img src="{{ asset('storage/' . $ImagePath) }}"
                                     alt="{{ $it->title }}"
                                     class="tour-thumb">
                            @else
                                <div class="tour-thumb placeholder-thumb">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif

                        </td>

                        <td>
                            <strong>{{ $it->name }}</strong>
                        </td>

                        <td>
                            {{ optional($it->country)->name ?? '-' }}
                        </td>

                        <td>
                            @if($it->status)
                                <span class="td-badge badge-success">
                                    <span class="dot dot-green"></span>
                                    Active
                                </span>
                            @else
                                <span class="td-badge badge-dark">
                                    <span class="dot dot-orange"></span>
                                    Inactive
                                </span>
                            @endif
                        </td>

                        <td>
                            <div class="td-actions justify-content-center">

                                <a href="{{ route('admin.destinations.edit', $it) }}"
                                   class="action-btn action-edit">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <form action="{{ route('admin.destinations.destroy', $it) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="action-btn action-delete"
                                            onclick="return confirm('Delete this destination?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center">
                            No destinations found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="table-footer">

        <div class="table-info">
            Showing
            {{ $items->firstItem() ?? 0 }}
            -
            {{ $items->lastItem() ?? 0 }}
            of
            {{ $items->total() }}
            destinations
        </div>

        <div>
            {{ $items->links() }}
        </div>

    </div>

</div>

<style>
.text-center{
    text-align:center;
}

.justify-content-center{
    justify-content:center;
}

.table-wrap{
    width:100%;
    overflow-x:auto;
}

.data-table{
    width:100%;
}
.tour-thumb{
    width:60px;
    height:60px;
    object-fit:cover;
    border-radius:10px;
}
</style>

@endsection
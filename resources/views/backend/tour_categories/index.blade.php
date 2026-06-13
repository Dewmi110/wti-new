@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')
<div>
        <h3 class="card-header-title">
            Tour Categories
        </h3>
    </div>
<div class="card">

    <div class="table-toolbar">

        <div class="table-search">
            <div class="input-icon-wrap">
                <i class="fas fa-search input-icon"></i>
                <input type="text"
                       class="form-input"
                       placeholder="Search categories...">
            </div>
        </div>

        <div class="table-filters">
            <a href="{{ route('admin.tour-categories.create') }}"
               class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i>
                Create Category
            </a>
        </div>

    </div>

    <div class="table-wrap">

        <table class="data-table">

            <thead>
                <tr>
                    <th width="80">#</th>
                    <th>Category Name</th>
                    <th width="140">Status</th>
                    <th width="140" class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($items as $it)

                    <tr>

                        <td>
                            {{ ($items->currentPage() - 1) * $items->perPage() + $loop->iteration }}
                        </td>

                        <td>
                            <div class="td-avatar">

                                <div class="avatar">
                                    <i class="fas fa-folder"></i>
                                </div>

                                <div class="avatar-info">
                                    <strong>{{ $it->category_name }}</strong>
                                    <span>Tour Category</span>
                                </div>

                            </div>
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

                                <a href="{{ route('admin.tour-categories.edit', $it) }}"
                                   class="action-btn action-edit"
                                   title="Edit">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <form action="{{ route('admin.tour-categories.destroy', $it) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="action-btn action-delete"
                                            title="Delete"
                                            onclick="return confirm('Delete this category?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="text-center">
                            No categories found.
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
            categories
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

.avatar{
    width:36px;
    height:36px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#f3f4f6;
    color:#6b7280;
}

.table-wrap{
    width:100%;
    overflow-x:auto;
}

.data-table{
    width:100%;
}
</style>

@endsection
@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')
<div>
        <h3 class="card-header-title">
            Blog
        </h3>
    </div>
<div class="card">

    <div class="table-toolbar">
        <div class="table-search">
            <div class="input-icon-wrap">
                <i class="fas fa-search input-icon"></i>
                <input type="text"
                       class="form-input"
                       placeholder="Search blogs...">
            </div>
        </div>

        <div class="table-filters">
            <a href="{{ route('admin.blogs.create') }}"
               class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i>
                Add Blog
            </a>
        </div>
    </div>

    <div class="table-wrap">

        <table class="data-table">

            <thead>
                <tr>
                    <th width="70">#</th>
                    <th>Blog</th>
                    <th width="100">Image</th>
                    <th width="120">Status</th>
                    <th width="150">Created</th>
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
                            <div class="td-avatar">

                                {{-- @if($it->image)
                                    <img src="{{ asset('storage/'.$it->image) }}"
                                         class="avatar"
                                         alt="{{ $it->name }}">
                                @else
                                    <div class="avatar">
                                        <i class="fas fa-blog"></i>
                                    </div>
                                @endif --}}

                                <div class="avatar-info">
                                    <strong>{{ $it->name }}</strong>

                                    <span>
                                        {{ \Illuminate\Support\Str::limit(strip_tags($it->description ?? ''), 60) }}
                                    </span>
                                </div>

                            </div>
                        </td>

                        <td>

                            @if($it->image)
                                <img src="{{ asset('storage/'.$it->image) }}"
                                     alt="{{ $it->name }}"
                                     class="blog-thumb">
                            @else
                                <span class="text-muted">
                                    No Image
                                </span>
                            @endif

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
                            {{ $it->created_at?->format('d M Y') }}
                        </td>

                        <td>

                            <div class="td-actions justify-content-center">

                                <a href="{{ route('admin.blogs.edit',$it) }}"
                                   class="action-btn action-edit">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <form action="{{ route('admin.blogs.destroy',$it) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="action-btn action-delete"
                                            onclick="return confirm('Delete this blog?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center">
                            No blogs found.
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
            blogs
        </div>

        <div>
            {{ $items->links() }}
        </div>

    </div>

</div>

<style>
.blog-thumb{
    width:55px;
    height:55px;
    object-fit:cover;
    border-radius:8px;
}

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
    object-fit:cover;
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
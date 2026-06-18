@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')

{{-- <div class="page"> --}}

    {{-- <div class="section-block">
        <div class="section-heading">
            Tour Management
        </div>
    </div> --}}
    <div>
        <h3 class="card-header-title">
            User Management
        </h3>
    </div>
    <div class="card">

        <div class="table-toolbar">


            <div class="table-search">
                <div class="input-icon-wrap">
                    <i class="fas fa-search input-icon"></i>
                    <input type="text" class="form-input" placeholder="Search users...">
                </div>
            </div>
            <div class="table-filters">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i>
                    Create User
                </a>
            </div>
        </div>

        <div class="table-wrap">

            <table class="data-table">

                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>User Role</th>
                        <th width="140">Status</th>
                        <th width="120" class="text-center">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($items as $it)

                    <tr>

                        <td>
                            <strong>{{ $it->name }}</strong>
                        </td>

                        <td>
                            {{ $it->role->name ?? 'No Role' }}
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

                                <a href="{{ route('admin.users.edit', $it) }}" class="action-btn action-edit"
                                    title="Edit">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <form action="{{ route('admin.users.destroy', $it) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="action-btn action-delete" title="Delete"
                                        onclick="return confirm('Delete this user?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="4" class="text-center">
                            No users found.
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
                records
            </div>

            <div>
                {{ $items->links() }}
            </div>

        </div>

    </div>

{{-- </div> --}}

{{-- </main> --}}

<style>
    .text-center {
        text-align: center;
    }

    .justify-content-center {
        justify-content: center;
    }
</style>

@endsection
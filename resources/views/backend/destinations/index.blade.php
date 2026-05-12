<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='destinations'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Destinations"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 px-3">
                            <h6 class="mb-0">Destinations</h6>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <a class="btn btn-sm btn-primary mb-3" href="{{ route('admin.destinations.create') }}">Create Destination</a>

                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Country</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $it)
                                        <tr>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $it->name }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">{{ optional($it->country)->name }}</p>
                                            </td>
                                            <td>
                                                <span class="badge {{ $it->status ? 'bg-success' : 'bg-secondary' }}">{{ $it->status ? 'Active' : 'Inactive' }}</span>
                                            </td>
                                            <td class="text-end">
                                                <a class="btn btn-link text-dark text-sm mb-0" href="{{ route('admin.destinations.edit', $it) }}" title="Edit" aria-label="Edit">
                                                    <i class="material-icons opacity-10">edit</i>
                                                </a>
                                                <form action="{{ route('admin.destinations.destroy', $it) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger text-sm mb-0" title="Delete" aria-label="Delete" onclick="return confirm('Delete this destination?')">
                                                        <i class="material-icons opacity-10">delete</i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">{{ $items->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>

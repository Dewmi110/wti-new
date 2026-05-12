<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='tour-themes'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Tour Themes"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 px-3">
                            <h6 class="mb-0">Tour Themes</h6>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <a class="btn btn-sm btn-primary mb-3" href="{{ route('admin.tour-themes.create') }}">Create Theme</a>

                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $item->theme_name }}</p>
                                            </td>
                                            <td>
                                                <span class="badge {{ $item->status ? 'bg-success' : 'bg-secondary' }}">{{ $item->status ? 'Active' : 'Inactive' }}</span>
                                            </td>
                                            <td class="text-end">
                                                <a class="btn btn-link text-dark text-sm mb-0" href="{{ route('admin.tour-themes.edit', $item) }}" title="Edit" aria-label="Edit">
                                                    <i class="material-icons opacity-10">edit</i>
                                                </a>
                                                <form action="{{ route('admin.tour-themes.destroy', $item) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger text-sm mb-0" title="Delete" aria-label="Delete" onclick="return confirm('Delete this theme?')">
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


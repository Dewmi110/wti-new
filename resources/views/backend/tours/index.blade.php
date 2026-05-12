<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='tours'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Tour Packages"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 px-3">
                            <h6 class="mb-0">Tour Packages</h6>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <a class="btn btn-sm btn-primary mb-3" href="{{ route('admin.tours.create') }}">Create Tour</a>

                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Location</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Duration</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tours as $tour)
                                        <tr>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                            </td>
                                            <td>
                                                @php
                                                    $tourImagePath = $tour->images->first()?->img_path ?? $tour->banner_img_path;
                                                @endphp
                                                @if($tourImagePath)
                                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($tourImagePath) }}" alt="{{ $tour->title }}" class="rounded" style="width: 56px; height: 56px; object-fit: cover;">
                                                @else
                                                    <span class="text-xs text-secondary">No image</span>
                                                @endif
                                            </td>
                                            <td><p class="text-sm font-weight-bold mb-0">{{ $tour->title }}</p></td>
                                            <td><p class="text-sm mb-0">{{ optional($tour->type)->type_name }}</p></td>
                                            <td><p class="text-sm mb-0">{{ optional($tour->countryModel)->name ?? '-' }}</p></td>
                                            <td><p class="text-sm mb-0">{{ $tour->duration }}</p></td>
                                            <td><p class="text-sm mb-0">{{ number_format($tour->price,2) }}</p></td>
                                            <td>
                                                <span class="badge {{ $tour->status == 1 ? 'bg-success' : ($tour->status == 0 ? 'bg-secondary' : 'bg-danger') }}">
                                                    {{ $tour->status == 1 ? 'Active' : ($tour->status == 0 ? 'Inactive' : 'Deleted') }}
                                                </span>
                                            </td>
                                            <td class="text-start">
                                                <button type="button" class="btn btn-link text-info text-sm mb-0" data-bs-toggle="modal" data-bs-target="#tourViewModal{{ $tour->id }}" title="View" aria-label="View">
                                                    <i class="material-icons opacity-10">visibility</i>
                                                </button>
                                                <a class="btn btn-link text-dark text-sm mb-0" href="{{ route('admin.tours.edit', $tour) }}" title="Edit" aria-label="Edit">
                                                    <i class="material-icons opacity-10">edit</i>
                                                </a>
                                                <form action="{{ route('admin.tours.destroy', $tour) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger text-sm mb-0" title="Delete" aria-label="Delete" onclick="return confirm('Delete this tour?')">
                                                        <i class="material-icons opacity-10">delete</i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @foreach($tours as $tour)
                                <div class="modal fade" id="tourViewModal{{ $tour->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ $tour->title }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <div class="col-md-6"><strong>Type:</strong> {{ optional($tour->type)->type_name ?? '-' }}</div>
                                                    <div class="col-md-6"><strong>Location:</strong> {{ optional($tour->countryModel)->name ?? '-' }}</div>
                                                    <div class="col-md-6"><strong>Duration:</strong> {{ $tour->duration }}</div>
                                                    <div class="col-md-6"><strong>Price:</strong> {{ number_format($tour->price, 2) }}</div>
                                                    <div class="col-md-6"><strong>Discount Price:</strong> {{ $tour->discount_price ? number_format($tour->discount_price, 2) : '-' }}</div>
                                                    <div class="col-md-6"><strong>Status:</strong> {{ $tour->status == 1 ? 'Active' : ($tour->status == 0 ? 'Inactive' : 'Deleted') }}</div>
                                                    <div class="col-12"><strong>Description:</strong><br>{{ $tour->description }}</div>
                                                    <div class="col-12"><strong>Highlight Activities:</strong><br>{{ $tour->highlight_activities ?: '-' }}</div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="mt-3">{{ $tours->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>


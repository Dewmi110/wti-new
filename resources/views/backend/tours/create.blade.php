<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='tours'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Create Tour"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-10 col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-header pb-0 px-3 d-flex align-items-center justify-content-between">
                            <h6 class="mb-0">Create Tour</h6>
                            <a href="{{ route('admin.tours.index') }}" class="btn btn-outline-primary btn-sm mb-0">Back</a>
                        </div>
                        <div class="card-body pt-4 p-3">
                            @if($errors->any())
                                <div class="alert alert-danger">{{ $errors->first() }}</div>
                            @endif

                            @php
                                $highlightActivities = old('highlight_activities', ['']);
                                $selectedDestinationIds = old('destinations', []);

                                if (! is_array($selectedDestinationIds)) {
                                    $selectedDestinationIds = [];
                                }

                                $selectedDestinationIds = collect($selectedDestinationIds)
                                    ->map(static fn ($destinationId) => (int) $destinationId)
                                    ->filter()
                                    ->values()
                                    ->all();

                                $selectedDestinationNames = collect($destinations)
                                    ->filter(static fn ($destination) => in_array((int) $destination->id, $selectedDestinationIds, true))
                                    ->pluck('name')
                                    ->values()
                                    ->all();

                                if (! is_array($highlightActivities) || $highlightActivities === []) {
                                    $highlightActivities = [''];
                                }
                            @endphp

                            <form action="{{ route('admin.tours.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-12">
                                        <div class="border rounded-3 p-3">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="mb-0">Basic Info</h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-outline mt-3">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-outline mt-3">
                                                        <label class="form-label">Slug</label>
                                                        <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="input-group input-group-outline mt-3">
                                                        <label class="form-label">Description</label>
                                                        <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group input-group-outline mt-3">
                                                        <label class="form-label">Duration</label>
                                                        <input type="text" name="duration" class="form-control" value="{{ old('duration') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="border rounded-3 p-3">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="mb-0">Tour Type</h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-outline mt-3 is-filled">
                                                        <label class="form-label">Type</label>
                                                        <select name="t_type" class="form-control">
                                                            @foreach($types as $t)
                                                                <option value="{{ $t->id }}">{{ $t->type_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="border rounded-3 p-3">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="mb-0">Classification</h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-outline mt-3 is-filled">
                                                        <label class="form-label">Category</label>
                                                        <select name="t_category" class="form-control">
                                                            @foreach($categories as $c)
                                                                <option value="{{ $c->id }}">{{ $c->category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-outline mt-3 is-filled">
                                                        <label class="form-label">Theme</label>
                                                        <select name="t_theme" class="form-control">
                                                            @foreach($themes as $th)
                                                                <option value="{{ $th->id }}">{{ $th->theme_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="border rounded-3 p-3">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="mb-0">Location</h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-outline mt-3 is-filled">
                                                        <label class="form-label">Country</label>
                                                        <select id="country-select" name="country" class="form-control">
                                                            @foreach($countries as $co)
                                                                <option value="{{ $co->id }}">{{ $co->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="destinationsDropdownToggle">Destinations</label>
                                                        <div class="dropdown-multiselect position-relative">
                                                            <button type="button" class="form-control form-control-alternative d-flex justify-content-between align-items-center" id="destinationsDropdownToggle">
                                                                <span class="selected-text" id="destinationsSelectedText">{{ implode(', ', $selectedDestinationNames) ?: 'Select destinations' }}</span>
                                                                <span class="text-muted"><i class="fas fa-chevron-down"></i></span>
                                                            </button>
                                                            <div class="dropdown-menu w-100 mt-1 p-0" id="destinationsDropdownMenu" style="display: none; max-height: 280px; overflow-y: auto;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="border rounded-3 p-3">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="mb-0">Cover / Main Image</h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-outline mt-3">
                                                        <label class="form-label">Banner Image</label>
                                                        <input type="file" name="banner_img" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="border rounded-3 p-3">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="mb-0">Pricing</h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="input-group input-group-outline mt-3">
                                                        <label class="form-label">Price</label>
                                                        <input type="text" name="price" class="form-control" value="{{ old('price') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group input-group-outline mt-3">
                                                        <label class="form-label">Discount Price</label>
                                                        <input type="text" name="discount_price" class="form-control" value="{{ old('discount_price') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="border rounded-3 p-3">
                                            <div class="d-flex justify-content-between align-items-center mt-1 mb-3">
                                                <h6 class="mb-0">Highlights / Activities</h6>
                                                <button type="button" class="btn btn-sm btn-outline-primary mb-0" onclick="addHighlightActivity()">Add Point</button>
                                            </div>
                                            <div id="highlight-activities" class="mt-2">
                                                @foreach($highlightActivities as $highlightActivity)
                                                    <div class="row highlight-activity-row mb-3 align-items-start">
                                                        <div class="col-md-11">
                                                            <div class="input-group input-group-outline is-filled">
                                                                <label class="form-label">Point</label>
                                                                <input type="text" name="highlight_activities[{{ $loop->index }}]" class="form-control" value="{{ $highlightActivity }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 d-flex align-items-center pt-2">
                                                            <button type="button" class="btn btn-link text-danger p-0" onclick="removeHighlightActivity(this)">Remove</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="border rounded-3 p-3">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="mb-0">Day-by-Day Itinerary</h6>
                                                <button type="button" class="btn btn-sm btn-outline-primary mb-0" onclick="addItinerary()">Add Day</button>
                                            </div>
                                            <div id="itineraries" class="mt-3">
                                                <div class="row itinerary-row mb-3">
                                                    <div class="col-md-2">
                                                        <div class="input-group input-group-outline is-filled">
                                                            <label class="form-label">Day</label>
                                                            <input type="number" name="itineraries[0][day]" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="input-group input-group-outline is-filled">
                                                            <label class="form-label">Description</label>
                                                            <textarea name="itineraries[0][description]" class="form-control" rows="2"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="border rounded-3 p-3">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="mb-0">Image Gallery</h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-outline mt-3">
                                                        <label class="form-label">Images</label>
                                                        <input type="file" name="images[]" class="form-control" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="border rounded-3 p-3">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="mb-0">Visibility</h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="input-group input-group-outline mt-3 is-filled">
                                                        <label class="form-label">Visibility</label>
                                                        <select name="visibility" class="form-control">
                                                            <option value="1">Home</option>
                                                            <option value="0">Featured</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check form-switch mt-4 pt-2">
                                                        <input class="form-check-input" type="checkbox" id="status" name="status" value="0" checked disabled>
                                                        <label class="form-check-label" for="status">Status defaults to inactive</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>

<script>
let idx = 1;
let highlightIdx = {{ count($highlightActivities) }};
let selectedDestinationIds = @json($selectedDestinationIds);
const initialDestinations = @json(
    $destinations->map(static function ($destination) {
        return [
            'id' => $destination->id,
            'name' => $destination->name,
        ];
    })->values()
);

function getDestinationMenu() {
    return document.getElementById('destinationsDropdownMenu');
}

function getDestinationToggle() {
    return document.getElementById('destinationsDropdownToggle');
}

function getDestinationDisplay() {
    return document.getElementById('destinationsSelectedText');
}

function syncSelectedDestinationIds() {
    selectedDestinationIds = Array.from(document.querySelectorAll('input.destination-checkbox:checked')).map(function (checkbox) {
        return Number(checkbox.value);
    });
}

function updateDestinationDisplay() {
    const display = getDestinationDisplay();

    if (!display) {
        return;
    }

    syncSelectedDestinationIds();

    const labels = Array.from(document.querySelectorAll('input.destination-checkbox:checked')).map(function (checkbox) {
        return checkbox.dataset.label || '';
    }).filter(function (label) {
        return label !== '';
    });

    display.textContent = labels.length ? labels.join(', ') : 'Select destinations';
}

function setDestinationMenuVisibility(isVisible) {
    const menu = getDestinationMenu();

    if (!menu) {
        return;
    }

    menu.style.display = isVisible ? 'block' : 'none';
}

function toggleDestinationMenu() {
    const menu = getDestinationMenu();

    if (!menu) {
        return;
    }

    setDestinationMenuVisibility(menu.style.display !== 'block');
}

function renderDestinationOptions(destinations) {
    const menu = getDestinationMenu();

    if (!menu) {
        return;
    }

    menu.innerHTML = '';

    destinations.forEach(function (destination) {
        const option = document.createElement('div');
        option.className = 'custom-control custom-checkbox px-3 py-1';

        const checkbox = document.createElement('input');
        checkbox.className = 'custom-control-input destination-checkbox';
        checkbox.type = 'checkbox';
        checkbox.id = 'destination_' + destination.id;
        checkbox.name = 'destinations[]';
        checkbox.value = destination.id;
        checkbox.dataset.label = destination.name;
        checkbox.checked = selectedDestinationIds.map(String).includes(String(destination.id));
        checkbox.addEventListener('change', updateDestinationDisplay);

        const label = document.createElement('label');
        label.className = 'custom-control-label';
        label.setAttribute('for', checkbox.id);
        label.textContent = destination.name;

        option.appendChild(checkbox);
        option.appendChild(label);
        menu.appendChild(option);
    });

    updateDestinationDisplay();
}

async function fetchDestinationsForCountry(countryId) {
    try {
        const response = await fetch('/admin/countries/' + countryId + '/destinations');

        if (!response.ok) {
            return;
        }

        const destinations = await response.json();
        renderDestinationOptions(destinations);
    } catch (error) {
        console.error(error);
    }
}

function addItinerary() {
    const wrapper = document.createElement('div');
    wrapper.className = 'row itinerary-row mb-3';
    wrapper.innerHTML = `
        <div class="col-md-2">
            <div class="input-group input-group-outline is-filled">
                <label class="form-label">Day</label>
                <input type="number" name="itineraries[${idx}][day]" class="form-control">
            </div>
        </div>
        <div class="col-md-10">
            <div class="input-group input-group-outline is-filled">
                <label class="form-label">Description</label>
                <textarea name="itineraries[${idx}][description]" class="form-control" rows="2"></textarea>
            </div>
        </div>
    `;
    document.getElementById('itineraries').appendChild(wrapper);
    idx++;
}

function addHighlightActivity() {
    const wrapper = document.createElement('div');
    wrapper.className = 'row highlight-activity-row mb-3 align-items-start';
    wrapper.innerHTML = `
        <div class="col-md-11">
            <div class="input-group input-group-outline is-filled">
                <label class="form-label">Point</label>
                <input type="text" name="highlight_activities[${highlightIdx}]" class="form-control">
            </div>
        </div>
        <div class="col-md-1 d-flex align-items-center pt-2">
            <button type="button" class="btn btn-link text-danger p-0" onclick="removeHighlightActivity(this)">Remove</button>
        </div>
    `;
    document.getElementById('highlight-activities').appendChild(wrapper);
    highlightIdx++;
}

function removeHighlightActivity(button) {
    const row = button.closest('.highlight-activity-row');
    const container = document.getElementById('highlight-activities');

    if (row) {
        row.remove();
    }

    if (container && container.querySelectorAll('.highlight-activity-row').length === 0) {
        addHighlightActivity();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const countrySelect = document.getElementById('country-select');
    const destinationToggle = getDestinationToggle();

    renderDestinationOptions(initialDestinations);

    if (destinationToggle) {
        destinationToggle.addEventListener('click', function (event) {
            event.preventDefault();
            event.stopPropagation();
            toggleDestinationMenu();
        });
    }

    document.addEventListener('click', function (event) {
        const menu = getDestinationMenu();
        const toggle = getDestinationToggle();

        if (!menu || !toggle) {
            return;
        }

        if (!menu.contains(event.target) && !toggle.contains(event.target)) {
            setDestinationMenuVisibility(false);
        }
    });

    if (countrySelect) {
        fetchDestinationsForCountry(countrySelect.value);
        countrySelect.addEventListener('change', function(e) {
            fetchDestinationsForCountry(e.target.value);
        });
    }
});
</script>


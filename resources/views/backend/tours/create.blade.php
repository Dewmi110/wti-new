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
                                $featureItems = old('features', []);

                                if (! is_array($selectedDestinationIds)) {
                                    $selectedDestinationIds = [];
                                }

                                if (! is_array($featureItems)) {
                                    $featureItems = [];
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

                                $featureItems = collect($featureItems)
                                    ->map(static function ($feature) {
                                        if (! is_array($feature)) {
                                            return null;
                                        }

                                        $label = trim((string) ($feature['label'] ?? ''));
                                        $prefix = trim((string) ($feature['prefix'] ?? 'fas'));
                                        $icon = trim((string) ($feature['icon'] ?? ''));

                                        if ($label === '' || $icon === '') {
                                            return null;
                                        }

                                        if ($prefix === '') {
                                            $prefix = 'fas';
                                        }

                                        return [
                                            'label' => $label,
                                            'prefix' => $prefix,
                                            'icon' => $icon,
                                        ];
                                    })
                                    ->filter()
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
                                                    <div class="form-group mt-3">
                                                        <label class="form-control-label mb-2" for="destinationsDropdownToggle">Destinations</label>
                                                        <div class="dropdown-multiselect position-relative tour-destination-picker">
                                                            <button type="button" class="form-control destination-select-toggle d-flex justify-content-between align-items-center" id="destinationsDropdownToggle">
                                                                <span class="selected-text text-truncate" id="destinationsSelectedText">{{ implode(', ', $selectedDestinationNames) ?: 'Select destinations' }}</span>
                                                                <span class="text-muted ms-3"><i class="fas fa-chevron-down"></i></span>
                                                            </button>
                                                            <div class="dropdown-menu w-100 mt-2 p-0 destination-dropdown-menu" id="destinationsDropdownMenu" style="max-height: 280px; overflow-y: auto;">
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
                                                <h6 class="mb-0">Tour Features</h6>
                                                <small class="text-muted">Search an icon and add multiple feature tags</small>
                                            </div>
                                            <div class="feature-picker position-relative">
                                                <div class="position-relative">
                                                    <label class="form-control-label mb-2" for="featureSearchInput">Feature search</label>
                                                    <input type="search" id="featureSearchInput" class="form-control feature-search-input" placeholder="Type Beach, Adventure, Camping, Family Friendly..." autocomplete="off">
                                                    <div id="featureSuggestions" class="feature-suggestions"></div>
                                                </div>
                                                <div id="featureSelectedGrid" class="feature-selected-grid mt-3"></div>
                                                <div id="featureHiddenInputs"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="border rounded-3 p-3">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="mb-0">Cover / Main Image</h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8 col-xl-6">
                                                    <label class="form-control-label mb-2">Banner Image</label>
                                                    <label class="tour-upload-trigger w-100" for="banner_img_input">
                                                        <input id="banner_img_input" type="file" name="banner_img" class="tour-upload-input" accept="image/*">
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="tour-upload-icon">
                                                                <i class="fas fa-image"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div class="tour-upload-title">Choose a main cover image</div>
                                                                <div class="tour-upload-hint">PNG, JPG, or JPEG. Click to browse and preview instantly.</div>
                                                            </div>
                                                            <div class="tour-upload-action text-primary fw-semibold">Browse</div>
                                                        </div>
                                                    </label>
                                                    <div class="tour-preview-card mt-3" id="bannerPreview">
                                                        <div class="tour-preview-empty p-4 text-center text-secondary">
                                                            <i class="fas fa-image fa-2x mb-2"></i>
                                                            <div>No banner image selected yet.</div>
                                                        </div>
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
                                                <div class="col-12">
                                                    <label class="form-control-label mb-2">Images</label>
                                                    <label class="tour-upload-trigger w-100" for="gallery_images_input">
                                                        <input id="gallery_images_input" type="file" name="images[]" class="tour-upload-input" accept="image/*" multiple>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="tour-upload-icon tour-upload-icon-gallery">
                                                                <i class="fas fa-images"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div class="tour-upload-title">Add gallery images</div>
                                                                <div class="tour-upload-hint">Select multiple images to preview them before saving.</div>
                                                            </div>
                                                            <div class="tour-upload-action text-primary fw-semibold">Browse</div>
                                                        </div>
                                                    </label>
                                                    <div class="tour-preview-grid mt-3" id="galleryPreview"></div>
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

<style>
.tour-destination-picker .destination-select-toggle {
    min-height: 48px;
    padding: 0.75rem 1rem;
    border: 1px solid #d2d6da;
    border-radius: 0.75rem;
    background-color: #fff;
    box-shadow: none;
}

.tour-destination-picker .destination-select-toggle:focus,
.tour-destination-picker .destination-select-toggle:focus-visible {
    border-color: #5e72e4;
    box-shadow: 0 0 0 3px rgba(94, 114, 228, 0.12);
    outline: none;
}

.destination-dropdown-menu {
    display: none;
    z-index: 1080;
    border-radius: 0.875rem;
    border: 1px solid #e9ecef;
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.12);
}

.destination-dropdown-menu.is-open {
    display: block !important;
}

.destination-dropdown-menu .custom-control {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.7rem 1rem;
    margin-bottom: 0;
}

.destination-dropdown-menu .custom-control:hover {
    background: #f8f9fa;
}

.destination-search-wrap {
    position: sticky;
    top: 0;
    z-index: 1;
    padding: 0.75rem;
    background: #fff;
    border-bottom: 1px solid #eef1f4;
}

.destination-search-input {
    width: 100%;
    border: 1px solid #d2d6da;
    border-radius: 0.6rem;
    padding: 0.45rem 0.75rem;
    font-size: 0.875rem;
}

.destination-search-input:focus {
    border-color: #5e72e4;
    outline: none;
    box-shadow: 0 0 0 3px rgba(94, 114, 228, 0.12);
}

.destination-options-list {
    max-height: 220px;
    overflow-y: auto;
}

.destination-empty-message {
    padding: 0.65rem 1rem;
    font-size: 0.85rem;
    color: #8392ab;
}

.feature-picker {
    position: relative;
}

.feature-search-input {
    min-height: 48px;
}

.feature-suggestions {
    position: absolute;
    top: calc(100% + 0.5rem);
    left: 0;
    right: 0;
    display: none;
    max-height: 320px;
    overflow-y: auto;
    border: 1px solid #e9ecef;
    border-radius: 0.9rem;
    background: #fff;
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.12);
    z-index: 1085;
}

.feature-suggestion-item {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 0.85rem;
    padding: 0.8rem 1rem;
    border: 0;
    background: #fff;
    text-align: left;
}

.feature-suggestion-item:hover,
.feature-suggestion-item:focus {
    background: #f8f9fa;
    outline: none;
}

.feature-suggestion-icon,
.feature-card-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 0.85rem;
    background: rgba(94, 114, 228, 0.12);
    color: #5e72e4;
    flex-shrink: 0;
}

.feature-suggestion-emoji,
.feature-card-icon {
    font-size: 1.45rem;
    line-height: 1;
}

.feature-suggestion-label,
.feature-card-title {
    font-weight: 600;
    color: #344767;
}

.feature-suggestion-subtext {
    font-size: 0.78rem;
    color: #8392ab;
}

.feature-suggestion-empty,
.feature-selected-empty {
    padding: 0.85rem 1rem;
    font-size: 0.875rem;
    color: #8392ab;
}

.feature-selected-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
    gap: 0.85rem;
}

.feature-card {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    padding: 0.9rem 1rem;
    border: 1px solid #e9ecef;
    border-radius: 1rem;
    background: #fff;
    box-shadow: 0 0.5rem 1.25rem rgba(0, 0, 0, 0.05);
}

.feature-card-main {
    display: flex;
    align-items: center;
    gap: 0.85rem;
    min-width: 0;
}

.feature-card-text {
    min-width: 0;
}

.feature-card-text .feature-suggestion-subtext {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.feature-card-remove {
    border: 0;
    background: transparent;
    color: #f5365c;
    font-size: 0.95rem;
    line-height: 1;
}

.feature-card-remove:hover {
    color: #d81b60;
}

.tour-upload-trigger {
    position: relative;
    display: block;
    padding: 1rem 1.15rem;
    border: 1px dashed #ced4da;
    border-radius: 1rem;
    background: linear-gradient(180deg, #ffffff 0%, #fbfcfe 100%);
    cursor: pointer;
    transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
}

.tour-upload-trigger:hover {
    border-color: #5e72e4;
    box-shadow: 0 0.75rem 1.5rem rgba(94, 114, 228, 0.08);
    transform: translateY(-1px);
}

.tour-upload-input {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.tour-upload-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 3.25rem;
    height: 3.25rem;
    border-radius: 0.95rem;
    background: rgba(94, 114, 228, 0.12);
    color: #5e72e4;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.tour-upload-icon-gallery {
    background: rgba(45, 206, 137, 0.12);
    color: #2dce89;
}

.tour-upload-title {
    font-weight: 600;
    color: #344767;
}

.tour-upload-hint {
    color: #8392ab;
    font-size: 0.875rem;
}

.tour-preview-card {
    min-height: 180px;
    border: 1px solid #e9ecef;
    border-radius: 1rem;
    background: #f8f9fa;
    overflow: hidden;
}

.tour-preview-card img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.tour-preview-empty {
    min-height: 180px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.tour-preview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
}

.tour-preview-tile {
    border: 1px solid #e9ecef;
    border-radius: 1rem;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 0.5rem 1.25rem rgba(0, 0, 0, 0.05);
}

.tour-preview-tile .tour-preview-thumb {
    width: 100%;
    aspect-ratio: 4 / 3;
    object-fit: cover;
    display: block;
}

.tour-preview-meta {
    padding: 0.75rem;
    font-size: 0.8rem;
    color: #8392ab;
    word-break: break-word;
}
</style>

<script>
let idx = 1;
let highlightIdx = {{ count($highlightActivities) }};
let selectedDestinationIds = @json($selectedDestinationIds);
const destinationsByCountryUrlTemplate = @json(route('admin.countries.destinations', ['id' => '__COUNTRY__']));
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

function getFeatureSearchInput() {
    return document.getElementById('featureSearchInput');
}

function getFeatureSuggestionsMenu() {
    return document.getElementById('featureSuggestions');
}

function getFeatureSelectedGrid() {
    return document.getElementById('featureSelectedGrid');
}

function getFeatureHiddenInputs() {
    return document.getElementById('featureHiddenInputs');
}

const featureSuggestionCatalog = [
    { label: 'Near Mountain', prefix: 'emoji', icon: '⛰️', keywords: ['mountain', 'hill', 'peak', 'trek'] },
    { label: 'Beach', prefix: 'emoji', icon: '🏖️', keywords: ['beach', 'waves', 'ocean', 'sea'] },
    { label: 'Adventure', prefix: 'emoji', icon: '🧭', keywords: ['adventure', 'hiking', 'trail', 'compass'] },
    { label: 'Family Friendly', prefix: 'emoji', icon: '👨‍👩‍👧‍👦', keywords: ['family', 'children', 'kids', 'group'] },
    { label: 'Camping', prefix: 'emoji', icon: '🏕️', keywords: ['camping', 'tent', 'camp'] },
    { label: 'Wildlife', prefix: 'emoji', icon: '🦁', keywords: ['wildlife', 'animals', 'nature', 'safari'] },
    { label: 'Scenic View', prefix: 'emoji', icon: '🌄', keywords: ['scenic', 'view', 'landscape', 'panorama'] },
    { label: 'City Tour', prefix: 'emoji', icon: '🏙️', keywords: ['city', 'urban', 'metropolitan'] },
    { label: 'Cultural', prefix: 'emoji', icon: '🏛️', keywords: ['culture', 'cultural', 'heritage', 'museum'] },
    { label: 'Relaxing', prefix: 'emoji', icon: '🧘', keywords: ['relax', 'spa', 'calm', 'wellness'] },
    { label: 'Waterfall', prefix: 'emoji', icon: '💦', keywords: ['waterfall', 'falls', 'water'] },
    { label: 'Sunrise', prefix: 'emoji', icon: '🌅', keywords: ['sunrise', 'morning', 'dawn'] },
    { label: 'Sunset', prefix: 'emoji', icon: '🌇', keywords: ['sunset', 'evening', 'dusk'] },
    { label: 'Boat Ride', prefix: 'emoji', icon: '🚤', keywords: ['boat', 'ride', 'water', 'cruise'] },
    { label: 'Hiking', prefix: 'emoji', icon: '🥾', keywords: ['hiking', 'trek', 'walk', 'trail'] },
    { label: 'Food', prefix: 'emoji', icon: '🍽️', keywords: ['food', 'dining', 'meal', 'restaurant'] },
    { label: 'Shopping', prefix: 'emoji', icon: '🛍️', keywords: ['shopping', 'store', 'market'] },
    { label: 'Hotel', prefix: 'emoji', icon: '🏨', keywords: ['hotel', 'stay', 'resort', 'accommodation'] },
    { label: 'Flight', prefix: 'emoji', icon: '✈️', keywords: ['flight', 'airplane', 'airport', 'travel'] },
    { label: 'Train', prefix: 'emoji', icon: '🚆', keywords: ['train', 'rail', 'railway'] },
    { label: 'Car', prefix: 'emoji', icon: '🚗', keywords: ['car', 'road', 'drive'] },
    { label: 'Bike', prefix: 'emoji', icon: '🚲', keywords: ['bike', 'cycle', 'cycling'] },
    { label: 'Beach Umbrella', prefix: 'emoji', icon: '⛱️', keywords: ['umbrella', 'beach', 'shade'] },
    { label: 'Tent', prefix: 'emoji', icon: '⛺', keywords: ['tent', 'camp', 'camping'] },
    { label: 'Spa', prefix: 'emoji', icon: '💆', keywords: ['spa', 'massage', 'relax'] },
    { label: 'Swimming', prefix: 'emoji', icon: '🏊', keywords: ['swim', 'pool', 'water'] },
    { label: 'Kayak', prefix: 'emoji', icon: '🛶', keywords: ['kayak', 'canoe', 'paddle', 'water'] },
    { label: 'Safari', prefix: 'emoji', icon: '🦓', keywords: ['safari', 'wildlife', 'animals'] },
    { label: 'Snow', prefix: 'emoji', icon: '❄️', keywords: ['snow', 'winter', 'cold'] },
    { label: 'Forest', prefix: 'emoji', icon: '🌲', keywords: ['forest', 'tree', 'nature', 'woods'] },
    { label: 'Island', prefix: 'emoji', icon: '🏝️', keywords: ['island', 'tropical', 'beach'] },
    { label: 'Temple', prefix: 'emoji', icon: '🛕', keywords: ['temple', 'religion', 'heritage'] },
    { label: 'Museum', prefix: 'emoji', icon: '🏛️', keywords: ['museum', 'culture', 'history'] },
    { label: 'Nightlife', prefix: 'emoji', icon: '🎉', keywords: ['nightlife', 'party', 'fun', 'evening'] },
    { label: 'Photography', prefix: 'emoji', icon: '📸', keywords: ['photo', 'camera', 'capture'] },
    { label: 'Romantic', prefix: 'emoji', icon: '💞', keywords: ['romantic', 'couple', 'honeymoon'] },
    { label: 'Family', prefix: 'emoji', icon: '👪', keywords: ['family', 'kids', 'children'] },
    { label: 'Group', prefix: 'emoji', icon: '👥', keywords: ['group', 'team', 'friends'] },
    { label: 'Backpacking', prefix: 'emoji', icon: '🎒', keywords: ['backpack', 'travel', 'budget'] },
    { label: 'Pet Friendly', prefix: 'emoji', icon: '🐶', keywords: ['pet', 'dog', 'friendly', 'animals'] },
    { label: 'Eco Friendly', prefix: 'emoji', icon: '🌿', keywords: ['eco', 'green', 'sustainable', 'nature'] },
    { label: 'Luxury', prefix: 'emoji', icon: '💎', keywords: ['luxury', 'premium', 'vip'] },
    { label: 'Budget', prefix: 'emoji', icon: '💰', keywords: ['budget', 'cheap', 'affordable'] },
    { label: 'Adventure Sports', prefix: 'emoji', icon: '🏄', keywords: ['adventure', 'sports', 'surf', 'active'] },
    { label: 'Boat Tour', prefix: 'emoji', icon: '🛥️', keywords: ['boat', 'tour', 'water', 'cruise'] },
    { label: 'Countryside', prefix: 'emoji', icon: '🌾', keywords: ['countryside', 'rural', 'village', 'farm'] },
    { label: 'Festival', prefix: 'emoji', icon: '🎆', keywords: ['festival', 'celebration', 'event'] },
    { label: 'Historic', prefix: 'emoji', icon: '🏰', keywords: ['historic', 'history', 'castle'] },
];

const initialFeatureItems = @json($featureItems);
let featureItems = Array.isArray(initialFeatureItems)
    ? initialFeatureItems.map(function (feature) {
        return {
            label: String((feature && feature.label) || '').trim(),
            prefix: String((feature && feature.prefix) || 'fas').trim() || 'fas',
            icon: String((feature && feature.icon) || '').trim(),
        };
    }).filter(function (feature) {
        return feature.label !== '' && feature.icon !== '';
    })
    : [];

function prettifyIconName(iconName) {
    return String(iconName || '')
        .replace(/-/g, ' ')
        .replace(/\b\w/g, function (letter) {
            return letter.toUpperCase();
        })
        .trim();
}

function syncSelectedDestinationIds() {
    selectedDestinationIds = Array.from(document.querySelectorAll('input.destination-checkbox:checked')).map(function (checkbox) {
        return Number(checkbox.value);
    });
}

function normalizeFeatureQuery(value) {
    return String(value || '').trim().toLowerCase();
}

function getMatchingFeatureSuggestions(query) {
    const normalizedQuery = normalizeFeatureQuery(query);

    return featureSuggestionCatalog.filter(function (feature) {
        if (normalizedQuery === '') {
            return true;
        }

        const searchableText = [feature.label, feature.icon].concat(feature.keywords || []).join(' ').toLowerCase();
        return searchableText.includes(normalizedQuery);
    });
}

function setFeatureSuggestionsVisibility(isVisible) {
    const menu = getFeatureSuggestionsMenu();

    if (!menu) {
        return;
    }

    menu.style.display = isVisible ? 'block' : 'none';
}

function renderFeatureSelectedCards() {
    const grid = getFeatureSelectedGrid();
    const hiddenInputs = getFeatureHiddenInputs();

    if (!grid || !hiddenInputs) {
        return;
    }

    grid.innerHTML = '';
    hiddenInputs.innerHTML = '';

    if (!featureItems.length) {
        grid.innerHTML = '<div class="feature-selected-empty">Selected features will appear here.</div>';
        return;
    }

    featureItems.forEach(function (feature, index) {
        const card = document.createElement('div');
        card.className = 'feature-card';

        const main = document.createElement('div');
        main.className = 'feature-card-main';

        const iconWrap = document.createElement('div');
        iconWrap.className = 'feature-card-icon';
        if (feature.prefix === 'emoji') {
            iconWrap.textContent = feature.icon;
        } else {
            iconWrap.innerHTML = '<i class="' + feature.prefix + ' ' + feature.icon + '"></i>';
        }

        const textWrap = document.createElement('div');
        textWrap.className = 'feature-card-text';

        const title = document.createElement('div');
        title.className = 'feature-card-title';
        title.textContent = feature.label;

        const subtitle = document.createElement('div');
        subtitle.className = 'feature-suggestion-subtext';
        subtitle.textContent = feature.prefix === 'emoji' ? 'emoji' : feature.prefix + ' ' + feature.icon;

        textWrap.appendChild(title);
        textWrap.appendChild(subtitle);

        main.appendChild(iconWrap);
        main.appendChild(textWrap);

        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.className = 'feature-card-remove';
        removeButton.setAttribute('aria-label', 'Remove ' + feature.label);
        removeButton.innerHTML = '<i class="fas fa-times"></i>';
        removeButton.addEventListener('click', function () {
            removeFeature(index);
        });

        card.appendChild(main);
        card.appendChild(removeButton);
        grid.appendChild(card);

        const labelInput = document.createElement('input');
        labelInput.type = 'hidden';
        labelInput.name = 'features[' + index + '][label]';
        labelInput.value = feature.label;

        const prefixInput = document.createElement('input');
        prefixInput.type = 'hidden';
        prefixInput.name = 'features[' + index + '][prefix]';
        prefixInput.value = feature.prefix;

        const iconInput = document.createElement('input');
        iconInput.type = 'hidden';
        iconInput.name = 'features[' + index + '][icon]';
        iconInput.value = feature.icon;

        hiddenInputs.appendChild(labelInput);
        hiddenInputs.appendChild(prefixInput);
        hiddenInputs.appendChild(iconInput);
    });
}

async function renderFeatureSuggestions(query) {
    const menu = getFeatureSuggestionsMenu();

    if (!menu) {
        return;
    }

    const matches = getMatchingFeatureSuggestions(query);
    menu.innerHTML = '';

    if (!matches.length) {
        menu.innerHTML = '<div class="feature-suggestion-empty">No matching features found.</div>';
        setFeatureSuggestionsVisibility(true);
        return;
    }

    matches.forEach(function (feature) {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'feature-suggestion-item';

        if (feature.prefix === 'emoji') {
            button.innerHTML = '\n            <span class="feature-suggestion-icon feature-suggestion-emoji">' + feature.icon + '</span>\n            <span class="feature-card-text">\n                <span class="feature-suggestion-label d-block">' + feature.label + '</span>\n                <span class="feature-suggestion-subtext d-block">Add icon + label</span>\n            </span>\n        ';
        } else {
            button.innerHTML = '\n            <span class="feature-suggestion-icon"><i class="' + feature.prefix + ' ' + feature.icon + '"></i></span>\n            <span class="feature-card-text">\n                <span class="feature-suggestion-label d-block">' + feature.label + '</span>\n                <span class="feature-suggestion-subtext d-block">Add icon + label</span>\n            </span>\n        ';
        }

        button.addEventListener('click', function () {
            addFeature(feature);
        });

        menu.appendChild(button);
    });

    setFeatureSuggestionsVisibility(true);
}

function addFeature(feature) {
    const label = String((feature && feature.label) || '').trim();
    const prefix = String((feature && feature.prefix) || 'emoji').trim() || 'emoji';
    const icon = String((feature && feature.icon) || '').trim();

    if (label === '' || icon === '') {
        return;
    }

    const alreadySelected = featureItems.some(function (item) {
        return item.label.toLowerCase() === label.toLowerCase() && item.icon === icon && item.prefix === prefix;
    });

    if (alreadySelected) {
        return;
    }

    featureItems.push({ label: label, prefix: prefix, icon: icon });
    renderFeatureSelectedCards();

    const searchInput = getFeatureSearchInput();

    if (searchInput) {
        searchInput.value = '';
        searchInput.focus();
    }

    setFeatureSuggestionsVisibility(false);
}

function removeFeature(index) {
    featureItems.splice(index, 1);
    renderFeatureSelectedCards();
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
    const toggle = getDestinationToggle();

    if (!menu) {
        return;
    }

    menu.classList.toggle('is-open', isVisible);

    if (toggle) {
        toggle.setAttribute('aria-expanded', isVisible ? 'true' : 'false');
    }
}

function toggleDestinationMenu() {
    const menu = getDestinationMenu();

    if (!menu) {
        return;
    }

    setDestinationMenuVisibility(!menu.classList.contains('is-open'));
}

function createPreviewImage(file, className) {
    const image = document.createElement('img');
    const previewUrl = URL.createObjectURL(file);

    image.className = className;
    image.src = previewUrl;
    image.alt = file.name;
    image.addEventListener('load', function () {
        URL.revokeObjectURL(previewUrl);
    }, { once: true });

    return image;
}

function renderBannerPreview(fileInput) {
    const preview = document.getElementById('bannerPreview');

    if (!preview) {
        return;
    }

    const file = fileInput && fileInput.files ? fileInput.files[0] : null;
    preview.innerHTML = '';

    if (!file) {
        preview.innerHTML = `
            <div class="tour-preview-empty p-4 text-center text-secondary">
                <i class="fas fa-image fa-2x mb-2"></i>
                <div>No banner image selected yet.</div>
            </div>
        `;
        return;
    }

    preview.appendChild(createPreviewImage(file, 'tour-preview-thumb'));
}

function renderGalleryPreview(fileInput) {
    const preview = document.getElementById('galleryPreview');

    if (!preview) {
        return;
    }

    const files = fileInput && fileInput.files ? Array.from(fileInput.files) : [];
    preview.innerHTML = '';

    if (!files.length) {
        preview.innerHTML = `
            <div class="tour-preview-empty p-4 text-center text-secondary border border-dashed rounded-3 bg-white">
                <i class="fas fa-images fa-2x mb-2"></i>
                <div>No gallery images selected yet.</div>
            </div>
        `;
        return;
    }

    files.forEach(function (file) {
        const tile = document.createElement('div');
        tile.className = 'tour-preview-tile';

        tile.appendChild(createPreviewImage(file, 'tour-preview-thumb'));

        const meta = document.createElement('div');
        meta.className = 'tour-preview-meta';
        meta.textContent = file.name;
        tile.appendChild(meta);

        preview.appendChild(tile);
    });
}

function renderDestinationOptions(destinations) {
    const menu = getDestinationMenu();

    if (!menu) {
        return;
    }

    menu.innerHTML = '';

    if (!Array.isArray(destinations) || destinations.length === 0) {
        menu.innerHTML = '<div class="destination-empty-message">No destinations available for this country.</div>';
        updateDestinationDisplay();
        return;
    }

    const searchWrap = document.createElement('div');
    searchWrap.className = 'destination-search-wrap';

    const searchInput = document.createElement('input');
    searchInput.type = 'search';
    searchInput.className = 'destination-search-input';
    searchInput.placeholder = 'Search destinations...';
    searchInput.setAttribute('aria-label', 'Search destinations');
    searchWrap.appendChild(searchInput);

    const optionsList = document.createElement('div');
    optionsList.className = 'destination-options-list';

    menu.appendChild(searchWrap);
    menu.appendChild(optionsList);

    destinations.forEach(function (destination) {
        const option = document.createElement('div');
        option.className = 'custom-control custom-checkbox px-3 py-1';
        option.dataset.label = String(destination.name || '').toLowerCase();

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
        optionsList.appendChild(option);
    });

    const emptySearchState = document.createElement('div');
    emptySearchState.className = 'destination-empty-message';
    emptySearchState.textContent = 'No destinations match your search.';
    emptySearchState.style.display = 'none';
    optionsList.appendChild(emptySearchState);

    searchInput.addEventListener('input', function () {
        const query = searchInput.value.trim().toLowerCase();
        let visibleCount = 0;

        Array.from(optionsList.querySelectorAll('.custom-control')).forEach(function (option) {
            const label = option.dataset.label || '';
            const isVisible = query === '' || label.includes(query);
            option.style.display = isVisible ? '' : 'none';

            if (isVisible) {
                visibleCount++;
            }
        });

        emptySearchState.style.display = visibleCount === 0 ? 'block' : 'none';
    });

    updateDestinationDisplay();
}

async function fetchDestinationsForCountry(countryId) {
    try {
        const response = await fetch(destinationsByCountryUrlTemplate.replace('__COUNTRY__', String(countryId)));

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
    const featureSearchInput = getFeatureSearchInput();
    const bannerInput = document.getElementById('banner_img_input');
    const galleryInput = document.getElementById('gallery_images_input');

    renderDestinationOptions(initialDestinations);
    renderFeatureSelectedCards();
    renderBannerPreview(bannerInput);
    renderGalleryPreview(galleryInput);

    if (featureSearchInput) {
        featureSearchInput.addEventListener('input', function () {
            void renderFeatureSuggestions(featureSearchInput.value);
        });

        featureSearchInput.addEventListener('focus', function () {
            void renderFeatureSuggestions(featureSearchInput.value);
        });

        featureSearchInput.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();

                const matches = getMatchingFeatureSuggestions(featureSearchInput.value);

                if (matches.length) {
                    addFeature(matches[0]);
                }
            }

            if (event.key === 'Escape') {
                setFeatureSuggestionsVisibility(false);
            }
        });
    }

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
        const featurePicker = document.querySelector('.feature-picker');

        if (!menu || !toggle) {
            return;
        }

        if (!menu.contains(event.target) && !toggle.contains(event.target)) {
            setDestinationMenuVisibility(false);
        }

        if (featurePicker && !featurePicker.contains(event.target)) {
            setFeatureSuggestionsVisibility(false);
        }
    });

    if (countrySelect) {
        fetchDestinationsForCountry(countrySelect.value);
        countrySelect.addEventListener('change', function(e) {
            fetchDestinationsForCountry(e.target.value);
        });
    }

    if (bannerInput) {
        bannerInput.addEventListener('change', function () {
            renderBannerPreview(bannerInput);
        });
    }

    if (galleryInput) {
        galleryInput.addEventListener('change', function () {
            renderGalleryPreview(galleryInput);
        });
    }
});
</script>


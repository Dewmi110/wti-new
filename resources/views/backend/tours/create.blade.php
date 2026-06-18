@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')

<div class="page">

    {{-- Page Title --}}
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:4px;">
        <h3 class="card-header-title">Create Tour</h3>
        <a href="{{ route('admin.tours.index') }}" class="btn btn-outline btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    @php
        $highlightActivities     = old('highlight_activities', ['']);
        $selectedDestinationIds  = old('destinations', []);
        $featureItems            = old('features', []);

        if (!is_array($selectedDestinationIds)) $selectedDestinationIds = [];
        if (!is_array($featureItems))            $featureItems = [];

        $selectedDestinationIds = collect($selectedDestinationIds)
            ->map(fn($d) => (int) $d)->filter()->values()->all();

        $selectedDestinationNames = collect($destinations)
            ->filter(fn($d) => in_array((int) $d->id, $selectedDestinationIds, true))
            ->pluck('name')->values()->all();

        $featureItems = collect($featureItems)
            ->map(function ($feature) {
                if (!is_array($feature)) return null;
                $label  = trim((string) ($feature['label']  ?? ''));
                $prefix = trim((string) ($feature['prefix'] ?? 'fas'));
                $icon   = trim((string) ($feature['icon']   ?? ''));
                if ($label === '' || $icon === '') return null;
                return ['label' => $label, 'prefix' => $prefix ?: 'fas', 'icon' => $icon];
            })->filter()->values()->all();

        if (!is_array($highlightActivities) || $highlightActivities === []) {
            $highlightActivities = [''];
        }
    @endphp

    @if($errors->any())
        <div class="alert alert-danger" style="margin-bottom:16px;">
            <i class="fas fa-times-circle alert-icon"></i>
            <div class="alert-body">
                <strong>Please fix the following errors:</strong>
                {{ $errors->first() }}
            </div>
        </div>
    @endif

    <form action="{{ route('admin.tours.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="display:flex; flex-direction:column; gap:18px;">

            {{-- ── 1. BASIC INFO ── --}}
            <div class="card">
                <div class="card-header" style="padding:18px 22px 0;">
                    <div class="card-header-title">
                        <i class="fas fa-info-circle" style="color:var(--purple);margin-right:6px;"></i>
                        Basic Information
                    </div>
                </div>
                <div class="card-body" style="display:flex; flex-direction:column; gap:16px;">
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Title <span class="required">*</span></label>
                            <div class="input-icon-wrap">
                                <i class="fas fa-suitcase-rolling input-icon"></i>
                                <input type="text" name="title"
                                    class="form-input {{ $errors->has('title') ? 'is-error' : '' }}"
                                    placeholder="e.g. Bali Island Escape 7D6N"
                                    value="{{ old('title') }}">
                            </div>
                            @error('title')
                                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Slug</label>
                            <div class="input-icon-wrap">
                                <i class="fas fa-link input-icon"></i>
                                <input type="text" name="slug" class="form-input"
                                    placeholder="auto-generated-slug"
                                    value="{{ old('slug') }}">
                            </div>
                            <div class="form-hint">Leave empty to auto-generate from title</div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Duration</label>
                            <div class="input-icon-wrap">
                                <i class="fas fa-clock input-icon"></i>
                                <input type="text" name="duration" class="form-input"
                                    placeholder="e.g. 7D / 6N"
                                    value="{{ old('duration') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description <span class="required">*</span></label>
                        <textarea name="description"
                            class="form-textarea {{ $errors->has('description') ? 'is-error' : '' }}"
                            placeholder="Full tour description..."
                            style="min-height:120px;">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- ── 2. CLASSIFICATION ── --}}
            <div class="card">
                <div class="card-header" style="padding:18px 22px 0;">
                    <div class="card-header-title">
                        <i class="fas fa-tags" style="color:var(--purple);margin-right:6px;"></i>
                        Classification
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-grid-3">
                        <div class="form-group">
                            <label class="form-label">Tour Type <span class="required">*</span></label>
                            <div class="form-select-wrap">
                                <select name="t_type" class="form-select">
                                    <option value="">Select type...</option>
                                    @foreach($types as $t)
                                        <option value="{{ $t->id }}" {{ old('t_type') == $t->id ? 'selected' : '' }}>
                                            {{ $t->type_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('t_type')
                                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Category <span class="required">*</span></label>
                            <div class="form-select-wrap">
                                <select name="t_category" class="form-select">
                                    <option value="">Select category...</option>
                                    @foreach($categories as $c)
                                        <option value="{{ $c->id }}" {{ old('t_category') == $c->id ? 'selected' : '' }}>
                                            {{ $c->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('t_category')
                                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Theme</label>
                            <div class="form-select-wrap">
                                <select name="t_theme" class="form-select">
                                    <option value="">Select theme...</option>
                                    @foreach($themes as $th)
                                        <option value="{{ $th->id }}" {{ old('t_theme') == $th->id ? 'selected' : '' }}>
                                            {{ $th->theme_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── 3. LOCATION ── --}}
            <div class="card">
                <div class="card-header" style="padding:18px 22px 0;">
                    <div class="card-header-title">
                        <i class="fas fa-map-marker-alt" style="color:var(--purple);margin-right:6px;"></i>
                        Location
                    </div>
                </div>
                <div class="card-body" style="display:flex; flex-direction:column; gap:16px;">

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Country <span class="required">*</span></label>
                            <div class="form-select-wrap">
                                <select id="country-select" name="country" class="form-select">
                                    <option value="">Select country...</option>
                                    @foreach($countries as $co)
                                        <option value="{{ $co->id }}" {{ old('country') == $co->id ? 'selected' : '' }}>
                                            {{ $co->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('country')
                                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Destinations multiselect --}}
                    <div class="form-group">
                        <label class="form-label">Destinations</label>
                        <div class="tour-destination-picker" style="position:relative;">
                            <button type="button"
                                id="destinationsDropdownToggle"
                                class="form-input"
                                style="display:flex; justify-content:space-between; align-items:center;
                                       cursor:pointer; text-align:left; height:42px; width:100%;">
                                <span id="destinationsSelectedText"
                                    style="overflow:hidden; text-overflow:ellipsis; white-space:nowrap; color:var(--text-muted);">
                                    {{ implode(', ', $selectedDestinationNames) ?: 'Select destinations...' }}
                                </span>
                                <i class="fas fa-chevron-down"
                                    style="color:var(--text-muted); font-size:11px; flex-shrink:0; margin-left:8px;"></i>
                            </button>
                            <div id="destinationsDropdownMenu"
                                style="display:none; position:absolute; top:100%; left:0; right:0; z-index:200;
                                       background:white; border:1.5px solid var(--purple);
                                       border-radius:var(--radius-sm); margin-top:4px;
                                       max-height:260px; overflow-y:auto;
                                       box-shadow:0 8px 24px rgba(108,92,231,0.12);">
                            </div>
                        </div>
                        <div class="form-hint">Select a country first to load destinations</div>
                    </div>

                </div>
            </div>

            {{-- ── 4. TOUR FEATURES ── --}}
            <div class="card">
                <div class="card-header" style="padding:18px 22px 0;">
                    <div style="display:flex; align-items:center; justify-content:space-between; width:100%;">
                        <div class="card-header-title">
                            <i class="fas fa-star" style="color:var(--purple);margin-right:6px;"></i>
                            Tour Features
                        </div>
                        <span style="font-size:11px; color:var(--text-muted);">
                            Search an icon and add multiple feature tags
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="feature-picker" style="position:relative;">
                        <div class="form-group">
                            <label class="form-label">Search Feature</label>
                            <div class="input-icon-wrap">
                                <i class="fas fa-search input-icon"></i>
                                <input type="search" id="featureSearchInput" class="form-input"
                                    placeholder="Type Beach, Adventure, Camping, Family Friendly..."
                                    autocomplete="off">
                            </div>
                            <div id="featureSuggestions" class="feature-suggestions"></div>
                        </div>
                        <div id="featureSelectedGrid" class="feature-selected-grid" style="margin-top:12px;"></div>
                        <div id="featureHiddenInputs"></div>
                    </div>
                </div>
            </div>

            {{-- ── 5. COVER / BANNER IMAGE ── --}}
            <div class="card">
                <div class="card-header" style="padding:18px 22px 0;">
                    <div class="card-header-title">
                        <i class="fas fa-image" style="color:var(--purple);margin-right:6px;"></i>
                        Cover / Banner Image
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Banner Image <span class="required">*</span></label>
                        <label class="file-upload" for="banner_img_input">
                            <input id="banner_img_input" type="file" name="banner_img"
                                accept="image/*" onchange="previewBanner(event)">
                            <div class="upload-icon"><i class="fas fa-image"></i></div>
                            <div class="upload-text">Click to upload a main cover image</div>
                            <div class="upload-hint">PNG, JPG, JPEG — max 5MB</div>
                        </label>
                        @error('banner_img')
                            <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Preview (hidden until file chosen) --}}
                    <div id="bannerPreview" style="display:none; margin-top:12px;">
                        <label class="form-label">Preview</label>
                        <div style="position:relative; display:inline-block; margin-top:6px;">
                            <img id="bannerPreviewImg" src="" alt="Banner preview"
                                style="height:140px; border-radius:10px; object-fit:cover;
                                       border:1px solid var(--border);">
                            <button type="button" onclick="clearBanner()"
                                style="position:absolute; top:5px; right:5px; width:22px; height:22px;
                                       background:var(--red); border:none; border-radius:50%;
                                       color:white; font-size:9px; cursor:pointer;
                                       display:flex; align-items:center; justify-content:center;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── 6. PRICING ── --}}
            <div class="card">
                <div class="card-header" style="padding:18px 22px 0;">
                    <div class="card-header-title">
                        <i class="fas fa-dollar-sign" style="color:var(--purple);margin-right:6px;"></i>
                        Pricing
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-grid-3">
                        <div class="form-group">
                            <label class="form-label">Price <span class="required">*</span></label>
                            <div class="input-icon-wrap">
                                <i class="fas fa-dollar-sign input-icon"></i>
                                <input type="text" name="price"
                                    class="form-input {{ $errors->has('price') ? 'is-error' : '' }}"
                                    placeholder="0.00"
                                    value="{{ old('price') }}">
                            </div>
                            @error('price')
                                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Discount Price</label>
                            <div class="input-icon-wrap">
                                <i class="fas fa-percent input-icon"></i>
                                <input type="text" name="discount_price" class="form-input"
                                    placeholder="0.00"
                                    value="{{ old('discount_price') }}">
                            </div>
                            <div class="form-hint">Leave empty if no discount</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── 7. HIGHLIGHT ACTIVITIES ── --}}
            <div class="card">

                <div class="card-header" style="padding:18px 22px 0;">
                    <div class="card-header-title">
                        <i class="fas fa-users" style="color:var(--purple);margin-right:6px;"></i>
                        Group & Policies
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-grid-3">
                        <div class="form-group">
                            <label class="form-label">Group Size</label>
                            <div class="input-icon-wrap">
                                <i class="fas fa-user-friends input-icon"></i>
                                <input type="number" name="group_size" class="form-input {{ $errors->has('group_size') ? 'is-error' : '' }}"
                                    placeholder="e.g. 10" value="{{ old('group_size') }}">
                            </div>
                            @error('group_size')<div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Guide</label>
                            <div class="input-icon-wrap">
                                <i class="fas fa-user-tie input-icon"></i>
                                <input type="text" name="guide" class="form-input" placeholder="Guide name or info"
                                    value="{{ old('guide') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Price Includes</label>
                            <div class="input-icon-wrap">
                                <i class="fas fa-list input-icon"></i>
                                <textarea name="price_include" class="form-input" rows="4" placeholder="Use line breaks for bullets, **bold**, or *italic* formatting">{{ old('price_include') }}</textarea>
                            </div>
                            <div class="form-hint">Use one entry per line. Prefix list items with -, *, or + for bullet formatting.</div>
                        </div>

                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label class="form-label">Cancellation Policy</label>
                            <div class="input-icon-wrap">
                                <i class="fas fa-file-contract input-icon"></i>
                                <textarea name="cancellation_policy" class="form-input" rows="4" placeholder="Use line breaks for bullets, **bold**, or *italic* formatting">{{ old('cancellation_policy') }}</textarea>
                            </div>
                            <div class="form-hint">Enter a full policy with paragraphs, bullets, and emphasis.</div>
                        </div>
                    </div>
                </div>
                <div class="card-header" style="padding:18px 22px 0;">
                    <div style="display:flex; align-items:center; justify-content:space-between; width:100%;">
                        <div class="card-header-title">
                            <i class="fas fa-list-ul" style="color:var(--purple);margin-right:6px;"></i>
                            Highlight Activities
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm"
                            onclick="addHighlightActivity()">
                            <i class="fas fa-plus"></i> Add Point
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="highlight-activities" style="display:flex; flex-direction:column; gap:10px;">
                        @foreach($highlightActivities as $highlightActivity)
                            <div class="highlight-activity-row"
                                style="display:flex; align-items:center; gap:10px;">
                                <div class="input-icon-wrap" style="flex:1;">
                                    <i class="fas fa-grip-lines input-icon"></i>
                                    <input type="text"
                                        name="highlight_activities[{{ $loop->index }}]"
                                        class="form-input"
                                        placeholder="e.g. Snorkeling at coral reef"
                                        value="{{ $highlightActivity }}">
                                </div>
                                <button type="button" class="action-btn action-delete"
                                    onclick="removeHighlightActivity(this)" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ── 8. DAY-BY-DAY ITINERARY ── --}}
            <div class="card">
                <div class="card-header" style="padding:18px 22px 0;">
                    <div style="display:flex; align-items:center; justify-content:space-between; width:100%;">
                        <div class="card-header-title">
                            <i class="fas fa-calendar-alt" style="color:var(--purple);margin-right:6px;"></i>
                            Day-by-Day Itinerary
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm"
                            onclick="addItinerary()">
                            <i class="fas fa-plus"></i> Add Day
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="itineraries" style="display:flex; flex-direction:column; gap:12px;">
                        {{-- Default first row --}}
                        <div class="itinerary-row"
                            style="display:grid; grid-template-columns:90px 1fr auto; gap:10px; align-items:start;">
                            <div class="form-group">
                                <label class="form-label">Day</label>
                                <input type="number" name="itineraries[0][day]"
                                    class="form-input" placeholder="1">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea name="itineraries[0][description]"
                                    class="form-textarea"
                                    style="min-height:70px;"
                                    placeholder="Describe the day's activities..."></textarea>
                            </div>
                            <div style="padding-top:26px;">
                                <button type="button" class="action-btn action-delete"
                                    onclick="this.closest('.itinerary-row').remove()" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── 9. IMAGE GALLERY ── --}}
            <div class="card">
                <div class="card-header" style="padding:18px 22px 0;">
                    <div class="card-header-title">
                        <i class="fas fa-images" style="color:var(--purple);margin-right:6px;"></i>
                        Image Gallery
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Gallery Images</label>
                        <label class="file-upload" for="gallery_images_input">
                            <input id="gallery_images_input" type="file" name="images[]"
                                accept="image/*" multiple onchange="previewGallery(event)">
                            <div class="upload-icon"><i class="fas fa-photo-video"></i></div>
                            <div class="upload-text">Click to upload gallery images</div>
                            <div class="upload-hint">Select multiple images — max 5MB each</div>
                        </label>
                        @error('images')
                            <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div id="galleryPreview"
                        style="display:flex; flex-wrap:wrap; gap:10px; margin-top:10px;"></div>
                </div>
            </div>

            {{-- ── 10. VISIBILITY & STATUS ── --}}
            <div class="card">
                <div class="card-header" style="padding:18px 22px 0;">
                    <div class="card-header-title">
                        <i class="fas fa-eye" style="color:var(--purple);margin-right:6px;"></i>
                        Visibility & Status
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Display Location</label>
                            <div class="form-select-wrap">
                                <select name="visibility" class="form-select">
                                    <option value="1" {{ old('visibility') == 1 ? 'selected' : '' }}>Home</option>
                                    <option value="0" {{ old('visibility') == 0 ? 'selected' : '' }}>Featured</option>
                                </select>
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <label class="form-label">Status</label>
                            <div style="margin-top:6px;">
                                <div class="toggle-wrap">
                                    <label class="toggle">
                                        <input type="checkbox" name="status" value="0" disabled>
                                        <span class="toggle-slider"></span>
                                    </label>
                                    <span class="toggle-label" style="color:var(--text-muted);">
                                        Status defaults to inactive after creation
                                    </span>
                                </div>
                                <div class="form-hint" style="margin-top:6px;">
                                    You can activate the tour from the edit page after reviewing it.
                                </div>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <div style="margin-top:6px;">
                                <div class="toggle-wrap">
                                    @php
                                        $canToggle = auth()->user()->isSuperAdmin() || auth()->user()->isAdmin();
                                    @endphp

                                    <label class="toggle">
                                        <input type="checkbox"
                                            name="status"
                                            value="1"
                                            {{ $canToggle ? '' : 'disabled' }}>
                                        <span class="toggle-slider"></span>
                                    </label>

                                    @if($canToggle)
                                        <span class="toggle-label" id="status-label">Inactive</span>
                                    @else
                                        <span class="toggle-label" style="color:var(--text-muted);">
                                            Status defaults to inactive after creation
                                        </span>
                                    @endif
                                </div>

                                @if(!$canToggle)
                                    <div class="form-hint" style="margin-top:6px;">
                                        You can activate the tour from the edit page after reviewing it.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── FORM ACTIONS ── --}}
            <div style="display:flex; justify-content:flex-end; gap:10px; padding-bottom:20px;">
                <a href="{{ route('admin.tours.index') }}" class="btn btn-outline">
                    <i class="fas fa-times"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check-circle"></i> Create Tour
                </button>
            </div>

        </div>
    </form>

</div>

{{-- ── SCRIPTS ── --}}
<script>
// Banner preview
function previewBanner(event) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('bannerPreviewImg').src = e.target.result;
        document.getElementById('bannerPreview').style.display = 'block';
    };
    reader.readAsDataURL(file);
}
function clearBanner() {
    document.getElementById('banner_img_input').value = '';
    document.getElementById('bannerPreviewImg').src = '';
    document.getElementById('bannerPreview').style.display = 'none';
}

// Gallery preview
function previewGallery(event) {
    const preview = document.getElementById('galleryPreview');
    preview.innerHTML = '';
    Array.from(event.target.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const wrap = document.createElement('div');
            wrap.style.cssText = 'position:relative;';
            wrap.innerHTML = `
                <img src="${e.target.result}"
                    style="width:80px; height:80px; border-radius:10px;
                           object-fit:cover; border:1px solid var(--border);">
            `;
            preview.appendChild(wrap);
        };
        reader.readAsDataURL(file);
    });
}

// Highlight Activities
let highlightIndex = {{ count($highlightActivities) }};
function addHighlightActivity() {
    const container = document.getElementById('highlight-activities');
    const row = document.createElement('div');
    row.className = 'highlight-activity-row';
    row.style.cssText = 'display:flex; align-items:center; gap:10px;';
    row.innerHTML = `
        <div class="input-icon-wrap" style="flex:1;">
            <i class="fas fa-grip-lines input-icon"></i>
            <input type="text"
                name="highlight_activities[${highlightIndex}]"
                class="form-input"
                placeholder="e.g. Visit local temples">
        </div>
        <button type="button" class="action-btn action-delete"
            onclick="removeHighlightActivity(this)" title="Remove">
            <i class="fas fa-times"></i>
        </button>
    `;
    container.appendChild(row);
    highlightIndex++;
}
function removeHighlightActivity(btn) {
    btn.closest('.highlight-activity-row').remove();
}

// Itinerary
let itineraryIndex = 1;
function addItinerary() {
    const container = document.getElementById('itineraries');
    const row = document.createElement('div');
    row.className = 'itinerary-row';
    row.style.cssText = 'display:grid; grid-template-columns:90px 1fr auto; gap:10px; align-items:start;';
    row.innerHTML = `
        <div class="form-group">
            <label class="form-label">Day</label>
            <input type="number"
                name="itineraries[${itineraryIndex}][day]"
                class="form-input"
                placeholder="${itineraryIndex + 1}">
        </div>
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="itineraries[${itineraryIndex}][description]"
                class="form-textarea"
                style="min-height:70px;"
                placeholder="Describe the day's activities..."></textarea>
        </div>
        <div style="padding-top:26px;">
            <button type="button" class="action-btn action-delete"
                onclick="this.closest('.itinerary-row').remove()" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    container.appendChild(row);
    itineraryIndex++;
}

// Destinations dropdown toggle
document.getElementById('destinationsDropdownToggle')?.addEventListener('click', function () {
    const menu = document.getElementById('destinationsDropdownMenu');
    menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
});
document.addEventListener('click', function (e) {
    if (!e.target.closest('.tour-destination-picker')) {
        const menu = document.getElementById('destinationsDropdownMenu');
        if (menu) menu.style.display = 'none';
    }
});
</script>

@endsection

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


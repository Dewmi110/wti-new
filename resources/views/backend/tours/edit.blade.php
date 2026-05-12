<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='tours'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Edit Tour"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-10 col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-header pb-0 px-3 d-flex align-items-center justify-content-between">
                            <h6 class="mb-0">Edit Tour</h6>
                            <a href="{{ route('admin.tours.index') }}" class="btn btn-outline-primary btn-sm mb-0">Back</a>
                        </div>
                        <div class="card-body pt-4 p-3">
                            @if($errors->any())
                                <div class="alert alert-danger">{{ $errors->first() }}</div>
                            @endif

                            <form action="{{ route('admin.tours.update', $tour) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline mt-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control" value="{{ old('title', $tour->title) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline mt-3">
                                            <label class="form-label">Slug</label>
                                            <input type="text" name="slug" class="form-control" value="{{ old('slug', $tour->slug) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline mt-3 is-filled">
                                            <label class="form-label">Category</label>
                                            <select name="t_category" class="form-control">
                                                @foreach($categories as $c)
                                                    <option value="{{ $c->id }}" @selected($tour->t_category == $c->id)>{{ $c->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline mt-3 is-filled">
                                            <label class="form-label">Type</label>
                                            <select name="t_type" class="form-control">
                                                @foreach($types as $t)
                                                    <option value="{{ $t->id }}" @selected($tour->t_type == $t->id)>{{ $t->type_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline mt-3 is-filled">
                                            <label class="form-label">Theme</label>
                                            <select name="t_theme" class="form-control">
                                                @foreach($themes as $th)
                                                    <option value="{{ $th->id }}" @selected($tour->t_theme == $th->id)>{{ $th->theme_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline mt-3 is-filled">
                                            <label class="form-label">Country</label>
                                            <select id="country-select" name="country" class="form-control">
                                                @foreach($countries as $co)
                                                    <option value="{{ $co->id }}" @selected($tour->country == $co->id)>{{ $co->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group input-group-outline mt-3 is-filled">
                                            <label class="form-label">Destinations</label>
                                            <select id="destinations-select" name="destinations[]" class="form-control" multiple>
                                                @foreach($destinations as $d)
                                                    <option value="{{ $d->id }}" @selected(in_array($d->id, $tour->destinations ?? []))>{{ $d->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline mt-3">
                                            <label class="form-label">Banner Image</label>
                                            <input type="file" name="banner_img" class="form-control">
                                        </div>
                                        @if($tour->banner_img_path)
                                            <small class="text-muted d-block mt-2">Current: {{ $tour->banner_img_path }}</small>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline mt-3">
                                            <label class="form-label">Images</label>
                                            <input type="file" name="images[]" class="form-control" multiple>
                                        </div>
                                        @if($tour->images->isNotEmpty())
                                            <small class="text-muted d-block mt-2">Existing images: {{ $tour->images->count() }}</small>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group input-group-outline mt-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control" rows="4">{{ old('description', $tour->description) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group input-group-outline mt-3">
                                            <label class="form-label">Duration</label>
                                            <input type="text" name="duration" class="form-control" value="{{ old('duration', $tour->duration) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group input-group-outline mt-3">
                                            <label class="form-label">Price</label>
                                            <input type="text" name="price" class="form-control" value="{{ old('price', $tour->price) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group input-group-outline mt-3">
                                            <label class="form-label">Discount Price</label>
                                            <input type="text" name="discount_price" class="form-control" value="{{ old('discount_price', $tour->discount_price) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group input-group-outline mt-3">
                                            <label class="form-label">Highlight Activities</label>
                                            <textarea name="highlight_activities" class="form-control" rows="3">{{ old('highlight_activities', $tour->highlight_activities) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">Itineraries</h6>
                                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addItinerary()">Add Day</button>
                                        </div>
                                        <div id="itineraries" class="mt-3">
                                            @foreach($tour->itineraries as $i)
                                                <div class="row itinerary-row mb-3">
                                                    <div class="col-md-2">
                                                        <div class="input-group input-group-outline is-filled">
                                                            <label class="form-label">Day</label>
                                                            <input type="number" name="itineraries[{{ $loop->index }}][day]" class="form-control" value="{{ $i->day }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="input-group input-group-outline is-filled">
                                                            <label class="form-label">Description</label>
                                                            <textarea name="itineraries[{{ $loop->index }}][description]" class="form-control" rows="2">{{ $i->description }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group input-group-outline mt-3 is-filled">
                                            <label class="form-label">Visibility</label>
                                            <select name="visibility" class="form-control">
                                                <option value="1" @selected($tour->visibility == 1)>Home</option>
                                                <option value="0" @selected($tour->visibility == 0)>Featured</option>
                                            </select>
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

@push('js')
<script>
let idx = {{ $tour->itineraries->count() }};
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

async function fetchDestinationsForCountry(countryId) {
    const select = document.getElementById('destinations-select');
    if (!select) return;
    try {
        const res = await fetch('/admin/countries/' + countryId + '/destinations');
        if (!res.ok) return;
        const list = await res.json();
        const current = Array.from(select.selectedOptions).map(o => o.value);
        select.innerHTML = '';
        list.forEach(d => {
            const opt = document.createElement('option');
            opt.value = d.id;
            opt.textContent = d.name;
            if (current.includes(String(d.id))) opt.selected = true;
            select.appendChild(opt);
        });
    } catch (e) {
        console.error(e);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const countrySelect = document.getElementById('country-select');
    if (countrySelect) {
        fetchDestinationsForCountry(countrySelect.value);
        countrySelect.addEventListener('change', function(e) {
            fetchDestinationsForCountry(e.target.value);
        });
    }
});
</script>
@endpush


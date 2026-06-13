@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')

<div class="page">
    <div class="section-block">
        <div class="card">

            {{-- Header --}}
            <div class="card-header" style="padding:18px 22px 0;">
                <div>
                    <div class="card-header-title">Create Destination</div>
                    <div class="card-header-sub">Add a new destination to the system</div>
                </div>
                <a href="{{ route('admin.destinations.index') }}" class="btn btn-outline btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

            {{-- Body --}}
            <div class="card-body">

                @if($errors->any())
                    <div class="alert alert-danger" style="margin-bottom:18px;">
                        <i class="fas fa-times-circle alert-icon"></i>
                        <div class="alert-body">
                            <strong>Error</strong>
                            {{ $errors->first() }}
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.destinations.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    {{-- Name + Country --}}
                    <div class="form-grid-2" style="margin-bottom:18px;">

                        <div class="form-group">
                            <label class="form-label">
                                Destination Name <span class="required">*</span>
                            </label>
                            <div class="input-icon-wrap">
                                <i class="fas fa-map-marker-alt input-icon"></i>
                                <input type="text"
                                       name="name"
                                       class="form-input {{ $errors->has('name') ? 'is-error' : '' }}"
                                       value="{{ old('name') }}"
                                       placeholder="e.g. Bali, Colombo, Kathmandu">
                            </div>
                            @error('name')
                                <div class="form-error">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Country <span class="required">*</span>
                            </label>
                            <div class="form-select-wrap">
                                <select name="country_id"
                                        class="form-select {{ $errors->has('country_id') ? 'is-error' : '' }}">
                                    <option value="">Select country...</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}"
                                            {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('country_id')
                                <div class="form-error">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>

                    {{-- Image Upload --}}
                    <div class="form-group" style="margin-bottom:18px;">
                        <label class="form-label">Destination Image</label>

                        <label class="file-upload" for="imageInput" id="uploadBox">
                            <input type="file"
                                   name="image"
                                   id="imageInput"
                                   accept="image/*"
                                   onchange="previewDestImage(event)">
                            <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                            <div class="upload-text">Click to upload image</div>
                            <div class="upload-hint">JPG, PNG, WEBP — max 2MB</div>
                        </label>

                        @error('image')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror

                        {{-- Preview --}}
                        <div id="imagePreview" style="display:none; margin-top:12px;">
                            <div style="position:relative; display:inline-block;">
                                <img id="previewImage" src="" alt="Preview"
                                    style="height:120px; border-radius:10px;
                                           object-fit:cover; border:1px solid var(--border);">
                                <button type="button" onclick="clearDestImage()"
                                    style="position:absolute; top:5px; right:5px;
                                           width:22px; height:22px; background:var(--red);
                                           border:none; border-radius:50%; color:white;
                                           font-size:9px; cursor:pointer;
                                           display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                    {{-- Status --}}
                    <div class="form-group" style="margin-bottom:24px;">
                        <label class="form-label">Status</label>
                        <div class="toggle-wrap">
                            <label class="toggle">
                                <input type="checkbox" name="status" value="1" checked>
                                <span class="toggle-slider"></span>
                            </label>
                            <span class="toggle-label">Active (visible on site)</span>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div style="display:flex; justify-content:flex-end; gap:10px;
                                padding-top:16px; border-top:1px solid var(--border);">
                        <a href="{{ route('admin.destinations.index') }}" class="btn btn-outline">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Destination
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewDestImage(event) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('previewImage').src = e.target.result;
        document.getElementById('imagePreview').style.display = 'block';
    };
    reader.readAsDataURL(file);
}

function clearDestImage() {
    document.getElementById('imageInput').value = '';
    document.getElementById('previewImage').src = '';
    document.getElementById('imagePreview').style.display = 'none';
}
</script>

@endsection
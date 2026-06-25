@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')

<div class="page">
    <div class="section-block">
        <div class="card">
            {{-- Header --}}
            <div class="card-header" style="padding:18px 22px 0;">
                <div>
                    <div class="card-header-title">Create Service</div>
                    <div class="card-header-sub">Add a new service to the system</div>
                </div>
                <a href="{{ route('admin.services.index') }}" class="btn btn-outline btn-sm">
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

                <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Name + Country --}}
                    <div class="form-grid-2" style="margin-bottom:18px;">

                        <div class="form-group">
                            <label class="form-label">
                                Service Type <span class="text-danger">*</span>
                            </label>
                            <select name="s_id" class="form-input @error('s_id') is-invalid @enderror" required>
                                <option value="" disabled selected>Select a service type…</option>
                                @foreach($serviceTypes as $type)
                                <option value="{{ $type->id }}" {{ old('s_id')==$type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('s_id')
                            <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title" class="form-input @error('title') is-invalid @enderror"
                                value="{{ old('title') }}" placeholder="e.g. Luxury Inbound Package" required>
                            @error('title')
                            <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    {{-- Image Upload --}}
                    <div class="form-group" style="margin-bottom:18px;">

                        <label class="form-label">
                            Description <span class="text-danger">*</span>
                        </label>
                        <textarea name="description" rows="5"
                            class="form-input @error('description') is-invalid @enderror"
                            placeholder="Describe this service…" required>{{ old('description') }}</textarea>
                        @error('description')
                        <span class="field-error">{{ $message }}</span>
                        @enderror

                    </div>
                    {{-- Banner Image --}}
                    <div class="form-group" style="margin-bottom:18px;">
                        <label class="form-label">
                            Banner Image <span class="text-danger">*</span>
                        </label>

                        <input type="file"
                            name="banner_image"
                            accept="image/*"
                            class="form-input @error('banner_image') is-invalid @enderror"
                            onchange="previewCreateImage(event)">

                        @error('banner_image')
                            <span class="field-error">{{ $message }}</span>
                        @enderror

                        <div style="margin-top:10px;">
                            <img id="createPreview"
                                src=""
                                style="max-width:250px; display:none; border-radius:8px; border:1px solid #ddd;">
                        </div>
                    </div>
                    {{-- Status --}}
                    {{-- <div class="form-group" style="margin-bottom:24px;">
                        <label class="form-label">Status</label>
                        <div class="toggle-wrap">
                            <label class="toggle">
                                <input type="checkbox" name="status" value="1" checked>
                                <span class="toggle-slider"></span>
                            </label>
                            <span class="toggle-label">Active (visible on site)</span>
                        </div>
                    </div> --}}

                    {{-- Actions --}}
                    <div style="display:flex; justify-content:flex-end; gap:10px;
                                padding-top:16px; border-top:1px solid var(--border);">
                        <a href="{{ route('admin.services.index') }}" class="btn btn-outline">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Service
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script>
function previewCreateImage(event) {
    const reader = new FileReader();

    reader.onload = function() {
        const output = document.getElementById('createPreview');
        output.src = reader.result;
        output.style.display = 'block';
    }

    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
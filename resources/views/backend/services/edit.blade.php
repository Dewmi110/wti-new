@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')

<div class="page">
    <div class="section-block">
        <div class="card">

            {{-- Header --}}
            <div class="card-header" style="padding:18px 22px 0;">
                <div>
                    <div class="card-header-title">Edit Service</div>
                    <div class="card-header-sub">Update service details</div>
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

                <form action="{{ route('admin.services.update', $service) }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Service Type + Title --}}
                    <div class="form-group">
                        <label class="form-label">
                            Service Type <span class="required">*</span>
                        </label>

                        <select class="form-input" disabled>
                            @foreach($serviceTypes as $serviceType)
                                <option value="{{ $serviceType->id }}"
                                    {{ old('s_id', $service->s_id) == $serviceType->id ? 'selected' : '' }}>
                                    {{ $serviceType->name }}
                                </option>
                            @endforeach
                        </select>

                        {{-- Hidden field so value is still submitted --}}
                        <input type="hidden" name="s_id" value="{{ $service->s_id }}">
                    </div>

                    {{-- Title --}}
                    <div class="form-group">
                        <label class="form-label">
                            Title <span class="required">*</span>
                        </label>
                        <input type="text" class="form-input" name="title" id="title" value="{{ old('title', $service->title) }}" />
                    </div>

                    {{-- Description --}}
                    <div class="form-group">
                        <label class="form-label">
                            Description <span class="required">*</span>
                        </label>
                        <textarea class="form-input" name="description" id="description" rows="4">{{ old('description', $service->description) }}</textarea>
                    </div>

                    {{-- Banner Image --}}
                    <div class="form-group">
                        <label class="form-label">
                            Banner Image
                        </label>
                        <input type="file" class="form-input" name="banner_image" id="banner_image" onchange="previewEditImage(event)" />
                        @if($service->banner_image)
                            <img id="editPreview" src="{{ Storage::url($service->banner_image) }}" alt="Preview" style="max-width: 200px; margin-top: 10px; display: block;" />
                        @else
                            <img id="editPreview" src="#" alt="Preview" style="max-width: 200px; margin-top: 10px; display: none;" />
                        @endif
                    </div>

                    {{-- Actions --}}
                    <div style="display:flex; justify-content:flex-end; gap:10px;
                                padding-top:16px; border-top:1px solid var(--border);">
                        <a href="{{ route('admin.services.index') }}" class="btn btn-outline">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Service
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<style>
.form-label   { display:block; font-size:13px; font-weight:700; margin-bottom:6px; color:#374151; }
.field-error  { display:block; font-size:12px; color:#dc2626; margin-top:4px; }
.is-invalid   { border-color:#dc2626 !important; }
.alert-error  { background:#fef2f2; border:1px solid #fecaca; color:#dc2626; border-radius:8px; padding:14px 16px; font-size:13px; }
textarea.form-input { height:auto !important; resize:vertical; }
.d-flex       { display:flex; }
</style>
<script>
function previewEditImage(event) {
    const reader = new FileReader();

    reader.onload = function() {
        const output = document.getElementById('editPreview');
        output.src = reader.result;
        output.style.display = 'block';
    }

    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection

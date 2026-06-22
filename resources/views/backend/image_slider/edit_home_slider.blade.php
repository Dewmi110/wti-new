@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')

<div class="page">
    <div class="section-block">
        <div class="card">

            {{-- Header --}}
            <div class="card-header" style="padding:18px 22px 0;">
                <div>
                    <div class="card-header-title">Edit Home Slider Item</div>
                    <div class="card-header-sub">Update the details of the home slider item</div>
                </div>
                <a href="{{ route('admin.image_sliders.index') }}" class="btn btn-outline btn-sm">
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

                <form action="{{ route('admin.image_sliders.update', $imageSlider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Image --}}
                    <div class="form-group" style="margin-bottom:18px;">
                        <label class="form-label">
                            Image
                            <span style="font-size:12px; color:#888; font-weight:400;">(leave blank to keep current)</span>
                        </label>

                        {{-- Current image preview --}}
                        @if($imageSlider->image_path)
                        <div style="margin-bottom:12px;">
                            <div style="font-size:12px; color:#888; margin-bottom:6px;">Current image:</div>
                            <img id="image-preview"
                                 src="{{ asset('storage/' . $imageSlider->image_path) }}"
                                 alt="{{ $imageSlider->title }}"
                                 style="max-width:100%; max-height:220px; border-radius:10px; object-fit:cover; border:0.5px solid #e5e3f0; display:block;">
                        </div>
                        @else
                        <div id="image-preview-wrap" style="display:none; margin-bottom:12px;">
                            <img id="image-preview" src="#" alt="Preview"
                                 style="max-width:100%; max-height:220px; border-radius:10px; object-fit:cover; border:0.5px solid #e5e3f0; display:block;">
                        </div>
                        @endif

                        <div class="input-icon-wrap">
                            <i class="fas fa-image input-icon"></i>
                            <input type="file"
                                   name="image"
                                   id="image-input"
                                   class="form-input {{ $errors->has('image') ? 'is-error' : '' }}"
                                   accept="image/*"
                                   onchange="previewImage(event)">
                        </div>
                        @error('image')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Header --}}
                    <div class="form-group" style="margin-bottom:18px;">
                        <label class="form-label">
                            Header
                        </label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-heading input-icon"></i>
                            <input type="text"
                                   name="header"
                                   class="form-input {{ $errors->has('header') ? 'is-error' : '' }}"
                                   value="{{ old('header', $imageSlider->header) }}"
                                   placeholder="Enter the header text">
                        </div>
                        @error('header')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Title --}}
                    <div class="form-group" style="margin-bottom:18px;">
                        <label class="form-label">
                            Title <span class="required">*</span>
                        </label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-heading input-icon"></i>
                            <input type="text"
                                   name="title"
                                   class="form-input {{ $errors->has('title') ? 'is-error' : '' }}"
                                   value="{{ old('title', $imageSlider->title) }}"
                                   placeholder="Enter the title"
                                   required>
                        </div>
                        @error('title')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="form-group" style="margin-bottom:18px;">
                        <label class="form-label">
                            Description
                        </label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-font input-icon"></i>
                            <textarea name="description"
                                      class="form-input {{ $errors->has('description') ? 'is-error' : '' }}"
                                      placeholder="Enter the description"
                                      rows="4">{{ old('description', $imageSlider->description) }}</textarea>
                        </div>
                        @error('description')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Actions --}}
                    <div style="display:flex; justify-content:flex-end; gap:10px;
                                padding-top:16px; border-top:1px solid var(--border);">
                        <a href="{{ route('admin.image_sliders.index') }}" class="btn btn-outline">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Home Slider Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const preview = document.getElementById('image-preview');
        preview.src = e.target.result;
        preview.style.display = 'block';
        const wrap = document.getElementById('image-preview-wrap');
        if (wrap) wrap.style.display = 'block';
    };
    reader.readAsDataURL(file);
}
</script>

@endsection
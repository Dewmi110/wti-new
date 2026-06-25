@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')

<div class="page">
    <div class="section-block">
        <div class="card">

            {{-- Header --}}
            <div class="card-header" style="padding:18px 22px 0;">
                <div>
                    <div class="card-header-title">Edit Contact Banner</div>
                    <div class="card-header-sub">Replace the contact page banner image</div>
                </div>
                <a href="{{ route('admin.contact_banners.index') }}" class="btn btn-outline btn-sm">
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

                <form action="{{ route('admin.contact_banners.update', $contactBanner) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Image --}}
                    <div class="form-group" style="margin-bottom:18px;">
                        <label class="form-label">
                            Image <span class="required">*</span>
                        </label>

                        {{-- Current image preview --}}
                        @if($contactBanner->banner_image)
                        <div style="margin-bottom:12px;">
                            <div style="font-size:12px; color:#888; margin-bottom:6px;">Current image:</div>
                            <img id="image-preview"
                                 src="{{ asset('storage/' . $contactBanner->banner_image) }}"
                                 alt="Contact banner"
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
                                   class="form-input {{ $errors->has('image') ? 'is-error' : '' }}"
                                   accept="image/*"
                                   onchange="previewImage(event)"
                                   required>
                        </div>
                        @error('image')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Actions --}}
                    <div style="display:flex; justify-content:flex-end; gap:10px;
                                padding-top:16px; border-top:1px solid var(--border);">
                        <a href="{{ route('admin.contact_banners.index') }}" class="btn btn-outline">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Contact Banner
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

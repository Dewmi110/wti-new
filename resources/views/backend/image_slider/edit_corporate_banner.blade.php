@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')

<div class="page">
    <div class="section-block">

        {{-- Breadcrumb --}}
        <div style="margin-bottom:18px; display:flex; align-items:center; gap:8px; font-size:13px; color:#888;">
            <a href="{{ route('admin.corporate_banners.index') }}" style="color:#6d5cce; text-decoration:none;">Corporate Banners</a>
            <i class="fas fa-chevron-right" style="font-size:10px;"></i>
            <span>Edit Banner</span>
        </div>

        <div class="card">
            <div class="card-header" style="padding:18px 22px 0;">
                <div>
                    <div class="card-header-title">Edit Corporate Banner</div>
                    <div class="card-header-sub">Update the corporate page banner details</div>
                </div>
                <a href="{{ route('admin.corporate_banners.index') }}" class="btn btn-sm"
                    style="border:0.5px solid #d0ccea; color:#6d5cce; background:transparent;">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

            <div class="card-body">
                @if($errors->any())
                <div class="alert alert-danger" style="margin-bottom:18px;">
                    <i class="fas fa-exclamation-circle alert-icon"></i>
                    <div class="alert-body">
                        <ul style="margin:0; padding-left:16px;">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <form action="{{ route('admin.corporate_banners.update', $corporateBanner) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Banner Image --}}
                    <div class="form-group" style="margin-bottom:22px;">
                        <label class="form-label" style="display:block; font-size:13px; font-weight:500; color:#444; margin-bottom:8px;">
                            Banner Image <span style="font-size:12px; color:#888; font-weight:400;">(leave blank to keep current)</span>
                        </label>

                        {{-- Current image --}}
                        @if($corporateBanner->banner_image)
                        <div style="margin-bottom:12px;">
                            <div style="font-size:12px; color:#888; margin-bottom:6px;">Current image:</div>
                            <img id="image-preview" src="{{ asset('storage/' . $corporateBanner->banner_image) }}"
                                alt="{{ $corporateBanner->title }}"
                                style="max-width:100%; max-height:220px; border-radius:10px; object-fit:cover; border:0.5px solid #e5e3f0;">
                        </div>
                        @else
                        <div id="image-preview-wrap" style="display:none; margin-bottom:12px;">
                            <img id="image-preview" src="#" alt="Preview"
                                style="max-width:100%; max-height:220px; border-radius:10px; object-fit:cover; border:0.5px solid #e5e3f0;">
                        </div>
                        @endif

                        <label for="banner_image"
                            style="display:flex;align-items:center;gap:10px;padding:14px 18px;border:1px dashed #c0bde0;border-radius:10px;cursor:pointer;background:#faf9fe;transition:border-color .2s;"
                            onmouseover="this.style.borderColor='#6d5cce'" onmouseout="this.style.borderColor='#c0bde0'">
                            <i class="fas fa-cloud-upload-alt" style="font-size:20px; color:#6d5cce;"></i>
                            <div>
                                <div style="font-size:14px; font-weight:500; color:#444;">Click to replace banner image</div>
                                <div style="font-size:12px; color:#888; margin-top:2px;">JPEG, PNG, GIF, WEBP — max 4MB</div>
                            </div>
                        </label>
                        <input type="file" id="banner_image" name="banner_image" accept="image/*"
                            style="display:none;" onchange="previewImage(event)">
                        @error('banner_image')
                        <div style="color:#e74c3c; font-size:12px; margin-top:6px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Title --}}
                    <div class="form-group" style="margin-bottom:18px;">
                        <label class="form-label" style="display:block; font-size:13px; font-weight:500; color:#444; margin-bottom:8px;">
                            Title <span style="color:#e74c3c;">*</span>
                        </label>
                        <input type="text" name="title" value="{{ old('title', $corporateBanner->title) }}"
                            class="form-control @error('title') is-invalid @enderror"
                            style="width:100%; padding:10px 14px; border:0.5px solid #d0ccea; border-radius:8px; font-size:14px; outline:none; box-sizing:border-box;">
                        @error('title')
                        <div style="color:#e74c3c; font-size:12px; margin-top:6px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Sub Title --}}
                    <div class="form-group" style="margin-bottom:18px;">
                        <label class="form-label" style="display:block; font-size:13px; font-weight:500; color:#444; margin-bottom:8px;">
                            Sub Title <span style="color:#e74c3c;">*</span>
                        </label>
                        <input type="text" name="sub_title" value="{{ old('sub_title', $corporateBanner->sub_title) }}"
                            class="form-control @error('sub_title') is-invalid @enderror"
                            style="width:100%; padding:10px 14px; border:0.5px solid #d0ccea; border-radius:8px; font-size:14px; outline:none; box-sizing:border-box;">
                        @error('sub_title')
                        <div style="color:#e74c3c; font-size:12px; margin-top:6px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="form-group" style="margin-bottom:26px;">
                        <label class="form-label" style="display:block; font-size:13px; font-weight:500; color:#444; margin-bottom:8px;">
                            Description <span style="color:#e74c3c;">*</span>
                        </label>
                        <textarea name="description" rows="4"
                            class="form-control @error('description') is-invalid @enderror"
                            style="width:100%; padding:10px 14px; border:0.5px solid #d0ccea; border-radius:8px; font-size:14px; outline:none; resize:vertical; box-sizing:border-box;">{{ old('description', $corporateBanner->description) }}</textarea>
                        @error('description')
                        <div style="color:#e74c3c; font-size:12px; margin-top:6px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Actions --}}
                    <div style="display:flex; gap:12px;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Banner
                        </button>
                        <a href="{{ route('admin.corporate_banners.index') }}"
                            class="btn btn-sm"
                            style="border:0.5px solid #d0ccea; color:#6d5cce; background:transparent; display:inline-flex; align-items:center; padding:8px 18px;">
                            Cancel
                        </a>
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

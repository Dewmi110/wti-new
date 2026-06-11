@extends('backend.components.layoutV2')
@section('main')

<div class="page">

    <div class="section-block">
        <div class="card">

            {{-- Card Header --}}
            <div class="card-header" style="padding: 18px 22px 0;">
                <div>
                    <div class="card-header-title">Create Blog</div>
                    <div class="card-header-sub">Fill in the details below to publish a new blog post</div>
                </div>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

            {{-- Card Body --}}
            <div class="card-body">
                <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Blog Title --}}
                    <div class="form-group" style="margin-bottom: 18px;">
                        <label class="form-label">
                            Blog Title <span class="required">*</span>
                        </label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-heading input-icon"></i>
                            <input
                                type="text"
                                name="name"
                                class="form-input {{ $errors->has('name') ? 'is-error' : '' }}"
                                placeholder="e.g. Top 10 Destinations in Asia"
                                value="{{ old('name') }}"
                            >
                        </div>
                        @error('name')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Blog Content --}}
                    <div class="form-group" style="margin-bottom: 18px;">
                        <label class="form-label">
                            Blog Content <span class="required">*</span>
                        </label>
                        <textarea
                            name="content"
                            class="form-textarea {{ $errors->has('content') ? 'is-error' : '' }}"
                            placeholder="Write your blog content here..."
                            style="min-height: 220px;"
                        >{{ old('content') }}</textarea>
                        @error('content')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                        <div class="form-hint">Supports plain text. Use clear paragraphs for readability.</div>
                    </div>

                    {{-- Featured Image --}}
                    <div class="form-group" style="margin-bottom: 18px;">
                        <label class="form-label">Featured Image</label>
                        <label class="file-upload" for="image-upload">
                            <input type="file" id="image-upload" name="image" accept="image/*" onchange="previewImage(event)">
                            <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                            <div class="upload-text">Click to upload featured image</div>
                            <div class="upload-hint">PNG, JPG, WEBP — max 5MB</div>
                        </label>
                        {{-- Preview --}}
                        <div id="image-preview-wrap" style="display:none; margin-top: 10px;">
                            <div style="position:relative; display:inline-block;">
                                <img id="image-preview" src="" alt="Preview"
                                    style="height: 100px; border-radius: 8px; border: 1px solid var(--border); object-fit: cover;">
                                <button type="button" onclick="clearImage()"
                                    style="position:absolute; top:4px; right:4px; width:20px; height:20px;
                                           background:var(--red); border:none; border-radius:50%; color:white;
                                           font-size:9px; cursor:pointer; display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        @error('image')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Status Toggle --}}
                    <div class="form-group" style="margin-bottom: 24px;">
                        <label class="form-label">Visibility</label>
                        <div class="toggle-wrap">
                            <label class="toggle">
                                <input type="checkbox" id="status" name="status" value="1"
                                    {{ old('status', '1') == '1' ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                            <span class="toggle-label" id="status-label">Published (visible to users)</span>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div style="display: flex; justify-content: flex-end; gap: 10px; padding-top: 8px; border-top: 1px solid var(--border);">
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check-circle"></i> Publish Blog
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
        reader.onload = e => {
            document.getElementById('image-preview').src = e.target.result;
            document.getElementById('image-preview-wrap').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }

    function clearImage() {
        document.getElementById('image-upload').value = '';
        document.getElementById('image-preview').src = '';
        document.getElementById('image-preview-wrap').style.display = 'none';
    }

    document.getElementById('status').addEventListener('change', function() {
        document.getElementById('status-label').textContent = this.checked
            ? 'Published (visible to users)'
            : 'Draft (hidden from users)';
    });
</script>
@endsection
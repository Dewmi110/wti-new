@extends('backend.components.layoutV2')

@section('main')

{{-- <main class="main"> --}}

    <div class="page">

        {{-- <div class="section-block">
            <div class="section-heading">
                Blog Edit
            </div>
        </div> --}}

        <div class="card">

            <div class="card-header">
                <div>
                    <div class="card-header-title">
                        Edit Blog
                    </div>
                    <div class="card-header-sub">
                        Update blog details
                    </div>
                </div>

                <a href="{{ route('admin.blogs.index') }}"
                   class="btn btn-outline btn-sm">
                    <i class="fas fa-arrow-left"></i>
                    Back
                </a>
            </div>

            <form action="{{ route('admin.blogs.update', $item) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- Blog Title --}}
                    <div class="form-group">
                        <label class="form-label">
                            Blog Title
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="name"
                               class="form-input"
                               value="{{ old('name', $item->name) }}"
                               placeholder="Enter blog title">

                        @error('name')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Blog Content --}}
                    <div class="form-group" style="margin-top:20px;">
                        <label class="form-label">
                            Blog Content
                        </label>

                        <textarea name="content"
                                  class="form-textarea"
                                  rows="8"
                                  placeholder="Write blog content here...">{{ old('content', $item->content) }}</textarea>

                        @error('content')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Current Image --}}
                    @if($item->image)
                    <div class="form-group" style="margin-top:20px;">
                        <label class="form-label">
                            Current Image
                        </label>

                        <div>
                            <img src="{{ asset('storage/'.$item->image) }}"
                                 alt="{{ $item->name }}"
                                 style="
                                    width:120px;
                                    height:120px;
                                    object-fit:cover;
                                    border-radius:10px;
                                    border:1px solid var(--border);
                                 ">
                        </div>
                    </div>
                    @endif

                    {{-- Upload Image --}}
                    <div class="form-group" style="margin-top:20px;">
                        <label class="form-label">
                            Change Image
                        </label>

                        <input type="file"
                               name="image"
                               class="form-input"
                               accept="image/*">

                        <div class="form-hint">
                            JPG, PNG, WEBP supported
                        </div>

                        @error('image')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="form-group" style="margin-top:20px;">

                        <div class="toggle-wrap">

                            <label class="toggle">

                                <input type="checkbox"
                                       name="status"
                                       value="1"
                                       {{ old('status', $item->status) ? 'checked' : '' }}>

                                <span class="toggle-slider"></span>

                            </label>

                            <span class="toggle-label">
                                Active
                            </span>

                        </div>

                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit"
                            class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Update Blog
                    </button>

                    <a href="{{ route('admin.blogs.index') }}"
                       class="btn btn-outline">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

{{-- </main> --}}

@endsection
@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')

<div class="page">
    <div class="section-block">
        <div class="card">

            {{-- Header --}}
            <div class="card-header" style="padding:18px 22px 0;">
                <div>
                    <div class="card-header-title">Create Home Slider Item</div>
                    <div class="card-header-sub">Add a new home slider item to the system</div>
                </div>
                <a href="{{ route('admin.image-sliders.index') }}" class="btn btn-outline btn-sm">
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

                <form action="{{ route('admin.image-sliders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Image --}}
                    <div class="form-group" style="margin-bottom:18px;">
                        <label class="form-label">
                            Image <span class="required">*</span>
                        </label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-image input-icon"></i>
                            <input type="file"
                                   name="image"
                                   class="form-input {{ $errors->has('image') ? 'is-error' : '' }}"
                                   accept="image/*"
                                   required>
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
                                   value="{{ old('header') }}"
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
                                   value="{{ old('title') }}"
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
                                      rows="4"></textarea>
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
                        <a href="{{ route('admin.image-sliders.index') }}" class="btn btn-outline">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Create Home Slider Item
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
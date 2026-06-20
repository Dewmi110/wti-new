@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')

<div class="page">
    <div class="section-block">
        <div class="card">

            {{-- Header --}}
            <div class="card-header" style="padding:18px 22px 0;">
                <div>
                    <div class="card-header-title">Create Destination Banner</div>
                    <div class="card-header-sub">Add a new destination banner to the system</div>
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

                    {{-- Title --}}
                    <div class="form-group" style="margin-bottom:18px;">
                        <label class="form-label" style="display:block; font-size:13px; font-weight:500; color:#444; margin-bottom:8px;">
                            Select Destination <span style="color:#e74c3c;">*</span>
                        </label>
                        <select name="destination" class="form-control @error('destination') is-invalid @enderror"
                            style="width:100%; padding:10px 14px; border:0.5px solid #d0ccea; border-radius:8px; font-size:14px; outline:none; box-sizing:border-box;">
                            <option value="">Select a destination</option>
                            @foreach($destinations as $destination)
                                <option value="{{ $destination->id }}" {{ old('destination') == $destination->id ? 'selected' : '' }}>
                                    {{ $destination->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('destination')
                        <div style="color:#e74c3c; font-size:12px; margin-top:6px;">{{ $message }}</div>
                        @enderror
                    </div>

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

                    {{-- Actions --}}
                    <div style="display:flex; justify-content:flex-end; gap:10px;
                                padding-top:16px; border-top:1px solid var(--border);">
                        <a href="{{ route('admin.image-sliders.index') }}" class="btn btn-outline">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Create Destination Banner
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
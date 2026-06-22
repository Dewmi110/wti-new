@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')

<div class="page">
    <div class="section-block">
        <div class="card">

            {{-- Header --}}
            <div class="card-header" style="padding:18px 22px 0;">
                <div>
                    <div class="card-header-title">
                        {{ $selectedTourType ? 'Edit Tour Banner' : 'Create Tour Banner' }}
                    </div>
                    <div class="card-header-sub">
                        @if($selectedTourType)
                            Update the banner image for <strong>{{ $selectedTourType->type_name }}</strong>
                        @else
                            Select a tour type and upload its banner image
                        @endif
                    </div>
                </div>
                <a href="{{ route('admin.tour_banners.index') }}" class="btn btn-outline btn-sm">
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

                <form action="{{ route('admin.tour_banners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Tour Type Selector --}}
                    <div class="form-group" style="margin-bottom:18px;">
                        <label class="form-label" style="display:block; font-size:13px; font-weight:500; color:#444; margin-bottom:8px;">
                            Tour Type <span style="color:#e74c3c;">*</span>
                        </label>

                        @if($selectedTourType)
                            {{-- Locked display: not editable, but value still submits via hidden input --}}
                            <div style="width:100%; padding:10px 14px; border:0.5px solid #e0ddee; border-radius:8px; font-size:14px; background:#f5f4fa; color:#555; box-sizing:border-box; display:flex; align-items:center; gap:8px;">
                                <i class="fas fa-lock" style="font-size:12px; color:#999;"></i>
                                {{ $selectedTourType->type_name }}
                            </div>
                            <input type="hidden" name="tour_type_id" value="{{ $selectedTourType->id }}">
                        @else
                            <select name="tour_type_id" class="form-control @error('tour_type_id') is-invalid @enderror"
                                style="width:100%; padding:10px 14px; border:0.5px solid #d0ccea; border-radius:8px; font-size:14px; outline:none; box-sizing:border-box;">
                                <option value="">Select a tour type</option>
                                @foreach($tourTypes as $tourType)
                                    <option value="{{ $tourType->id }}" {{ old('tour_type_id') == $tourType->id ? 'selected' : '' }}>
                                        {{ $tourType->type_name }}{{ $tourType->banner_image ? ' (has banner)' : '' }}
                                    </option>
                                @endforeach
                            </select>
                        @endif

                        @error('tour_type_id')
                        <div style="color:#e74c3c; font-size:12px; margin-top:6px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Current banner preview, when editing an existing one --}}
                    @if($selectedTourType && $selectedTourType->banner_image)
                    <div style="margin-bottom:18px;">
                        <div style="font-size:12px; color:#888; margin-bottom:6px;">Current banner:</div>
                        <img src="{{ asset('storage/' . $selectedTourType->banner_image) }}" alt="{{ $selectedTourType->type_name }}"
                            style="max-width:100%; max-height:200px; border-radius:10px; object-fit:cover; border:0.5px solid #e5e3f0;">
                    </div>
                    @endif

                    {{-- Image --}}
                    <div class="form-group" style="margin-bottom:18px;">
                        <label class="form-label">
                            Image <span class="required">*</span>
                            @if($selectedTourType && $selectedTourType->banner_image)
                            <span style="font-size:12px; color:#888; font-weight:400;">(uploading a new one replaces the current banner)</span>
                            @endif
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
                        <a href="{{ route('admin.tour_banners.index') }}" class="btn btn-outline">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            {{ $selectedTourType ? 'Update Tour Banner' : 'Create Tour Banner' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')

<div class="page">
    <div class="section-block">
        <div class="card">

            {{-- Header --}}
            <div class="card-header" style="padding:18px 22px 0;">
                <div>
                    <div class="card-header-title">Create Country</div>
                    <div class="card-header-sub">Add a new country to the system</div>
                </div>
                <a href="{{ route('admin.countries.index') }}" class="btn btn-outline btn-sm">
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

                <form action="{{ route('admin.countries.store') }}" method="POST">
                    @csrf

                    {{-- Country Name --}}
                    <div class="form-group" style="margin-bottom:18px;">
                        <label class="form-label">
                            Country Name <span class="required">*</span>
                        </label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-globe input-icon"></i>
                            <input type="text"
                                   name="name"
                                   class="form-input {{ $errors->has('name') ? 'is-error' : '' }}"
                                   value="{{ old('name') }}"
                                   placeholder="e.g. Sri Lanka, Thailand, Japan"
                                   required>
                        </div>
                        @error('name')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="form-group" style="margin-bottom:24px;">
                        <label class="form-label">Status</label>
                        <div class="toggle-wrap">
                            <label class="toggle">
                                <input type="checkbox" name="status" value="1"
                                    {{ old('status', 1) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                            <span class="toggle-label">Active (visible on site)</span>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div style="display:flex; justify-content:flex-end; gap:10px;
                                padding-top:16px; border-top:1px solid var(--border);">
                        <a href="{{ route('admin.countries.index') }}" class="btn btn-outline">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Create Country
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')

<div class="page">
    <div class="section-block">
        <div class="card">

            {{-- Header --}}
            <div class="card-header" style="padding:18px 22px 0;">
                <div>
                    <div class="card-header-title">Contact Details</div>
                    <div class="card-header-sub">Update the location, phone/WhatsApp, and email shown on the public Contact Us page</div>
                </div>
            </div>

            {{-- Body --}}
            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success" style="margin-bottom:18px;">
                        <i class="fas fa-check-circle alert-icon"></i>
                        <div class="alert-body">{{ session('success') }}</div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger" style="margin-bottom:18px;">
                        <i class="fas fa-times-circle alert-icon"></i>
                        <div class="alert-body">
                            <strong>Please fix the following errors:</strong>
                            {{ $errors->first() }}
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.contact_details.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Location --}}
                    <div class="form-group">
                        <label class="form-label">Location <span class="required">*</span></label>
                        <textarea name="location" class="form-input {{ $errors->has('location') ? 'is-error' : '' }}"
                            rows="3" placeholder="e.g. 321-4/1, 4th Floor Galle road, Colombo 03, Sri Lanka">{{ old('location', $contactDetail->location) }}</textarea>
                        @error('location')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-grid-2">
                        {{-- Phone --}}
                        <div class="form-group">
                            <label class="form-label">Phone <span class="required">*</span></label>
                            <div class="input-icon-wrap">
                                <i class="fas fa-phone input-icon"></i>
                                <input type="text" name="phone"
                                    class="form-input {{ $errors->has('phone') ? 'is-error' : '' }}"
                                    placeholder="+94 777 377 956" value="{{ old('phone', $contactDetail->phone) }}">
                            </div>
                            <div class="form-hint">Used for the "tel:" call link</div>
                            @error('phone')
                            <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        {{-- WhatsApp --}}
                        <div class="form-group">
                            <label class="form-label">WhatsApp Number</label>
                            <div class="input-icon-wrap">
                                <i class="fab fa-whatsapp input-icon"></i>
                                <input type="text" name="whatsapp_number"
                                    class="form-input {{ $errors->has('whatsapp_number') ? 'is-error' : '' }}"
                                    placeholder="94777377956" value="{{ old('whatsapp_number', $contactDetail->whatsapp_number) }}">
                            </div>
                            <div class="form-hint">Digits only, with country code, no + or spaces (e.g. 94777377956)</div>
                            @error('whatsapp_number')
                            <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label class="form-label">Email Address <span class="required">*</span></label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" name="email"
                                class="form-input {{ $errors->has('email') ? 'is-error' : '' }}"
                                placeholder="hello@wti.lk" value="{{ old('email', $contactDetail->email) }}">
                        </div>
                        @error('email')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Actions --}}
                    <div style="display:flex; justify-content:flex-end; gap:10px;
                                padding-top:16px; border-top:1px solid var(--border);">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
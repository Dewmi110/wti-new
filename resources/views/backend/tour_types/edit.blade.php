@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')
<div class="page">

    {{-- <div class="section-block"> --}}

        <div class="card">

            <div class="card-header">
                <div>
                    <h3 class="card-title">Edit Tour Type</h3>
                    <p class="card-subtitle">Update tour type information</p>
                </div>

                <a href="{{ route('admin.tour-types.index') }}"
                   class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i>
                    Back
                </a>
            </div>

            <div class="card-body">

                @if($errors->any())
                    <div class="alert alert-danger mb-4">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('admin.tour-types.update', $item) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">
                            Type Name
                        </label>

                        <input type="text"
                               name="type_name"
                               class="form-input"
                               value="{{ old('type_name', $item->type_name) }}"
                               placeholder="Enter tour type name">

                        @error('type_name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    {{-- <div class="form-group mt-4">

                        <label class="switch">

                            <input type="checkbox"
                                   name="status"
                                   value="1"
                                   {{ old('status', $item->status) ? 'checked' : '' }}>

                            <span class="slider"></span>

                        </label>

                        <span class="switch-label ms-2">
                            Active
                        </span>

                    </div> --}}

                    <div class="form-actions mt-4">

                        <a href="{{ route('admin.tour-types.index') }}"
                           class="btn btn-secondary">
                            Cancel
                        </a>

                        <button type="submit"
                                class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Update Type
                        </button>

                    </div>

                </form>

            </div>

        </div>

    {{-- </div> --}}

</div>

@endsection
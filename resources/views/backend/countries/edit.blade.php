@extends('backend.components.layoutV2')

@section('main')

<div class="page">

    <div class="page-header">
        <div>
            <h2 class="page-title">Edit Country</h2>
            <p class="page-subtitle">Update country information</p>
        </div>

        <a href="{{ route('admin.countries.index') }}"
           class="btn btn-outline">
            <i class="fas fa-arrow-left"></i>
            Back
        </a>
    </div>

    <div class="section-block">

        <div class="card">

            <div class="card-header">
                <h3>Edit Country</h3>
            </div>

            <div class="card-body">

                @if($errors->any())
                    <div class="alert alert-danger mb-4">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('admin.countries.update', $item) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">
                            Country Name
                        </label>

                        <input type="text"
                               name="name"
                               class="form-input"
                               value="{{ old('name', $item->name) }}"
                               placeholder="Enter country name"
                               required>
                    </div>

                    <div class="form-group mt-4">

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

                    </div>

                    <div class="form-actions mt-4">

                        <a href="{{ route('admin.countries.index') }}"
                           class="btn btn-secondary">
                            Cancel
                        </a>

                        <button type="submit"
                                class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Update Country
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
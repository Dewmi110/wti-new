@extends('backend.components.layoutV2')

@section('main')

<div class="page">

    <div class="section-block">

        <div class="card">

            <div class="card-header">
                <div>
                    <h3 class="card-title">Edit Theme</h3>
                    <p class="card-subtitle">Update tour theme details</p>
                </div>

                <a href="{{ route('admin.tour-themes.index') }}"
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

                <form method="POST"
                      action="{{ route('admin.tour-themes.update', $item) }}">

                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">
                            Theme Name
                        </label>

                        <input type="text"
                               name="theme_name"
                               class="form-input"
                               placeholder="Enter theme name"
                               value="{{ old('theme_name', $item->theme_name) }}"
                               required>
                    </div>

                    <div class="form-group mt-4">

                        <label class="switch">
                            <input type="checkbox"
                                   name="status"
                                   value="1"
                                   {{ $item->status ? 'checked' : '' }}>

                            <span class="switch-slider"></span>
                        </label>

                        <span class="ms-2">
                            Active
                        </span>

                    </div>

                    <div class="form-actions mt-4">

                        <a href="{{ route('admin.tour-themes.index') }}"
                           class="btn btn-secondary">
                            Cancel
                        </a>

                        <button type="submit"
                                class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Update Theme
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
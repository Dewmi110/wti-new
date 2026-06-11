@extends('backend.components.layoutV2')

@section('main')

<div class="page">

    <div class="section-block">

        <div class="card">

            <div class="card-header">
                <div>
                    <h3 class="card-title">Create Category</h3>
                    <p class="card-subtitle">Add a new tour category</p>
                </div>

                <a href="{{ route('admin.tour-categories.index') }}"
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
                      action="{{ route('admin.tour-categories.store') }}">

                    @csrf

                    <div class="form-group">
                        <label class="form-label">
                            Category Name
                        </label>

                        <input type="text"
                               name="category_name"
                               class="form-input"
                               placeholder="Enter category name"
                               value="{{ old('category_name') }}"
                               required>
                    </div>

                    <div class="form-group mt-4">

                        <label class="switch">
                            <input type="checkbox"
                                   name="status"
                                   value="1"
                                   checked>

                            <span class="switch-slider"></span>
                        </label>

                        <span class="ms-2">
                            Active
                        </span>

                    </div>

                    <div class="form-actions mt-4">

                        <a href="{{ route('admin.tour-categories.index') }}"
                           class="btn btn-secondary">
                            Cancel
                        </a>

                        <button type="submit"
                                class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Save Category
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
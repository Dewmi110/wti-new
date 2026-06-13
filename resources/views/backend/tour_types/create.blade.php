@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')
    <div class="page">

        <div class="section-block">
            <div class="section-heading">
                Tour Management
            </div>
        </div>

        <div class="card">

            <div class="card-header">

                <div>
                    <div class="card-header-title">
                        Create Tour Type
                    </div>

                    <div class="card-header-sub">
                        Add a new tour type
                    </div>
                </div>

                <a href="{{ route('admin.tour-types.index') }}"
                   class="btn btn-outline btn-sm">
                    <i class="fas fa-arrow-left"></i>
                    Back
                </a>

            </div>

            <form method="POST"
                  action="{{ route('admin.tour-types.store') }}">

                @csrf

                <div class="card-body">

                    @if($errors->any())
                        <div class="alert alert-danger" style="margin-bottom:20px;">
                            <div class="alert-body">
                                <strong>Error</strong>
                                {{ $errors->first() }}
                            </div>
                        </div>
                    @endif

                    {{-- Type Name --}}
                    <div class="form-group">

                        <label class="form-label">
                            Type Name
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="type_name"
                               class="form-input"
                               value="{{ old('type_name') }}"
                               placeholder="Enter tour type name">

                        @error('type_name')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Status --}}
                    <div class="form-group" style="margin-top:20px;">

                        <label class="form-label">
                            Status
                        </label>

                        <div class="toggle-wrap">

                            <label class="toggle">

                                <input type="checkbox"
                                       id="status"
                                       name="status"
                                       value="1"
                                       checked>

                                <span class="toggle-slider"></span>

                            </label>

                            <span class="toggle-label"
                                  id="status-label">
                                Active
                            </span>

                        </div>

                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit"
                            class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Save Type
                    </button>

                    <a href="{{ route('admin.tour-types.index') }}"
                       class="btn btn-outline">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const status = document.getElementById('status');
    const label = document.getElementById('status-label');

    function updateStatusLabel() {
        label.textContent = status.checked
            ? 'Active'
            : 'Inactive';
    }

    updateStatusLabel();

    status.addEventListener('change', updateStatusLabel);
});
</script>

@endsection
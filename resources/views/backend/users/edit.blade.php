@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')
<div class="page">

    <div class="section-block">
        <div class="section-heading">User Management</div>
    </div>

    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-header-title">Edit User</div>
                <div class="card-header-sub">Update user details</div>
            </div>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline btn-sm">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')
            <div class="card-body">

                @if($errors->any())
                    <div class="alert alert-danger" style="margin-bottom:20px;">
                        <div class="alert-body">
                            <strong>Error:</strong> {{ $errors->first() }}
                        </div>
                    </div>
                @endif

                {{-- Name --}}
                <div class="form-group">
                    <label class="form-label">User Name <span class="required">*</span></label>
                    <input type="text" name="name" class="form-input"
                           value="{{ old('name', $user->name) }}" placeholder="Enter user name">
                    @error('name')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label">User Email <span class="required">*</span></label>
                    <input type="email" name="email" class="form-input"
                           value="{{ old('email', $user->email) }}" placeholder="Enter user email">
                    @error('email')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                {{-- Password (optional on edit) --}}
                <div class="form-group">
                    <label class="form-label">New Password <span style="color:#888;font-weight:400;">(leave blank to keep current)</span></label>
                    <input type="password" name="password" class="form-input" placeholder="Enter new password">
                    @error('password')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-input" placeholder="Confirm new password">
                </div>

                {{-- Role --}}
                <div class="form-group">
                    <label class="form-label">User Role <span class="required">*</span></label>
                    <select name="role_id" class="form-input">
                        <option value="">-- Select Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="form-group" style="margin-top:20px;">
                    <label class="form-label">Status</label>
                    <div class="toggle-wrap">
                        <label class="toggle">
                            <input type="checkbox" id="status" name="status" value="1"
                                   {{ $user->status ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                        <span class="toggle-label" id="status-label">
                            {{ $user->status ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update User
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const status = document.getElementById('status');
    const label  = document.getElementById('status-label');
    const update = () => label.textContent = status.checked ? 'Active' : 'Inactive';
    status.addEventListener('change', update);
});
</script>
@endsection
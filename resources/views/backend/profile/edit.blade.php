@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')

<div class="page">
    <div class="section-block">

        {{-- ── Profile Information ── --}}
        <div class="card" style="margin-bottom:24px;">
            <div class="card-header" style="padding:18px 22px 0;">
                <div>
                    <div class="card-header-title">My Profile</div>
                    <div class="card-header-sub">Update your account details</div>
                </div>
                <div style="display:flex; align-items:center; gap:12px;">
                    <div style="width:42px; height:42px; border-radius:50%; background:var(--accent);
                                display:flex; align-items:center; justify-content:center;
                                font-size:1.1rem; color:#fff; font-weight:700; flex-shrink:0;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <div style="font-size:13px; font-weight:600; color:var(--text);">{{ Auth::user()->name }}</div>
                        <div style="font-size:11px; color:var(--text-muted);">{{ Auth::user()->role?->name ?? 'No Role' }}</div>
                    </div>
                </div>
            </div>

            <div class="card-body">

                @if(session('profile_success'))
                    <div class="alert alert-success" style="margin-bottom:18px;">
                        <i class="fas fa-check-circle alert-icon"></i>
                        <div class="alert-body">
                            <strong>Success</strong>
                            {{ session('profile_success') }}
                        </div>
                    </div>
                @endif

                @if($errors->hasBag('profile') && $errors->getBag('profile')->any())
                    <div class="alert alert-danger" style="margin-bottom:18px;">
                        <i class="fas fa-times-circle alert-icon"></i>
                        <div class="alert-body">
                            <strong>Error</strong>
                            {{ $errors->getBag('profile')->first() }}
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Full Name <span class="required">*</span></label>
                            <input type="text"
                                   class="form-input {{ $errors->hasBag('profile') && $errors->getBag('profile')->has('name') ? 'is-invalid' : '' }}"
                                   name="name"
                                   value="{{ old('name', $user->name) }}"
                                   required />
                            @if($errors->hasBag('profile') && $errors->getBag('profile')->has('name'))
                                <span class="field-error">{{ $errors->getBag('profile')->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email Address <span class="required">*</span></label>
                            <input type="email"
                                   class="form-input {{ $errors->hasBag('profile') && $errors->getBag('profile')->has('email') ? 'is-invalid' : '' }}"
                                   name="email"
                                   value="{{ old('email', $user->email) }}"
                                   required />
                            @if($errors->hasBag('profile') && $errors->getBag('profile')->has('email'))
                                <span class="field-error">{{ $errors->getBag('profile')->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="form-label">Role</label>
                            <input type="text"
                                   class="form-input"
                                   value="{{ $user->role?->name ?? '—' }}"
                                   disabled
                                   style="opacity:0.6; cursor:not-allowed;" />
                        </div>

                        {{-- <div class="form-group">
                            <label class="form-label">Member Since</label>
                            <input type="text"
                                   class="form-input"
                                   value="{{ $user->created_at?->format('d M Y') ?? '—' }}"
                                   disabled
                                   style="opacity:0.6; cursor:not-allowed;" />
                        </div> --}}
                    </div>

                    <div style="display:flex; justify-content:flex-end; gap:10px;
                                padding-top:16px; border-top:1px solid var(--border);">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ── Change Password ── --}}
        <div class="card">
            <div class="card-header" style="padding:18px 22px 0;">
                <div>
                    <div class="card-header-title">Change Password</div>
                    <div class="card-header-sub">Update your login password</div>
                </div>
            </div>

            <div class="card-body">

                @if(session('password_success'))
                    <div class="alert alert-success" style="margin-bottom:18px;">
                        <i class="fas fa-check-circle alert-icon"></i>
                        <div class="alert-body">
                            <strong>Success</strong>
                            {{ session('password_success') }}
                        </div>
                    </div>
                @endif

                @if($errors->hasBag('password') && $errors->getBag('password')->any())
                    <div class="alert alert-danger" style="margin-bottom:18px;">
                        <i class="fas fa-times-circle alert-icon"></i>
                        <div class="alert-body">
                            <strong>Error</strong>
                            {{ $errors->getBag('password')->first() }}
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label class="form-label">Current Password <span class="required">*</span></label>
                            <div class="password-wrap">
                                <input type="password"
                                       class="form-input {{ $errors->hasBag('password') && $errors->getBag('password')->has('current_password') ? 'is-invalid' : '' }}"
                                       name="current_password"
                                       id="current_password"
                                       required />
                                <button type="button" class="password-toggle" onclick="togglePassword('current_password', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @if($errors->hasBag('password') && $errors->getBag('password')->has('current_password'))
                                <span class="field-error">{{ $errors->getBag('password')->first('current_password') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="form-label">New Password <span class="required">*</span></label>
                            <div class="password-wrap">
                                <input type="password"
                                       class="form-input {{ $errors->hasBag('password') && $errors->getBag('password')->has('password') ? 'is-invalid' : '' }}"
                                       name="password"
                                       id="new_password"
                                       required />
                                <button type="button" class="password-toggle" onclick="togglePassword('new_password', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @if($errors->hasBag('password') && $errors->getBag('password')->has('password'))
                                <span class="field-error">{{ $errors->getBag('password')->first('password') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="form-label">Confirm New Password <span class="required">*</span></label>
                            <div class="password-wrap">
                                <input type="password"
                                       class="form-input"
                                       name="password_confirmation"
                                       id="confirm_password"
                                       required />
                                <button type="button" class="password-toggle" onclick="togglePassword('confirm_password', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div style="background:rgba(108,92,231,0.07); border-radius:8px; padding:12px 14px;
                                margin-bottom:16px; font-size:12px; color:var(--text-muted);">
                        <i class="fas fa-info-circle" style="color:var(--accent); margin-right:6px;"></i>
                        Password must be at least <strong>8 characters</strong> long.
                    </div>

                    <div style="display:flex; justify-content:flex-end; gap:10px;
                                padding-top:16px; border-top:1px solid var(--border);">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-key"></i> Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<style>
.form-label      { display:block; font-size:13px; font-weight:700; margin-bottom:6px; color:#374151; }
.field-error     { display:block; font-size:12px; color:#dc2626; margin-top:4px; }
.is-invalid      { border-color:#dc2626 !important; }
.form-grid       { display:grid; grid-template-columns:1fr 1fr; gap:0 20px; }
.password-wrap   { position:relative; }
.password-wrap .form-input { padding-right:40px; }
.password-toggle {
    position:absolute; right:10px; top:50%; transform:translateY(-50%);
    background:none; border:none; cursor:pointer;
    color:var(--text-muted); font-size:13px; padding:0;
}
.password-toggle:hover { color:var(--accent); }
@media (max-width:640px) { .form-grid { grid-template-columns:1fr; } }
</style>

<script>
function togglePassword(id, btn) {
    const input = document.getElementById(id);
    const icon  = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>

@endsection
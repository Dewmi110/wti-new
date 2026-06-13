<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WTI Admin — Sign In</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --purple:       #6c5ce7;
            --purple-light: #a29bfe;
            --purple-bg:    #f0eeff;
            --purple-dark:  #2d1f6e;
            --sidebar-bg:   #1a1040;
            --white:        #ffffff;
            --bg:           #f4f6fb;
            --text-dark:    #1a1a2e;
            --text-muted:   #8a8fa8;
            --text-light:   #b0b7c9;
            --border:       #e8ecf4;
            --green:        #00b894;
            --red:          #e17055;
            --radius:       14px;
            --radius-sm:    8px;
            --input-h:      44px;
            --transition:   0.18s ease;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--sidebar-bg);
            position: relative;
            overflow: hidden;
        }

        /* Background blobs */
        body::before {
            content: '';
            position: absolute;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(108,92,231,0.3) 0%, transparent 70%);
            top: -200px; left: -200px;
            pointer-events: none;
        }
        body::after {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(162,155,254,0.2) 0%, transparent 70%);
            bottom: -150px; right: -100px;
            pointer-events: none;
        }

        /* Floating shapes */
        .bg-shape {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }
        .bg-shape-1 {
            width: 300px; height: 300px;
            background: rgba(108,92,231,0.08);
            bottom: 10%; left: 5%;
        }
        .bg-shape-2 {
            width: 150px; height: 150px;
            background: rgba(162,155,254,0.1);
            top: 20%; right: 10%;
        }
        .bg-shape-3 {
            width: 80px; height: 80px;
            background: rgba(253,203,110,0.12);
            top: 60%; right: 25%;
        }

        /* Card */
        .login-card {
            background: white;
            border-radius: 20px;
            width: 100%;
            max-width: 420px;
            padding: 0;
            position: relative;
            z-index: 10;
            box-shadow: 0 25px 60px rgba(0,0,0,0.3), 0 0 0 1px rgba(255,255,255,0.05);
            overflow: hidden;
        }

        /* Card top banner */
        .login-banner {
            background: linear-gradient(135deg, var(--sidebar-bg) 0%, var(--purple-dark) 50%, var(--purple) 100%);
            padding: 36px 32px 32px;
            position: relative;
            overflow: hidden;
            text-align: center;
        }
        .login-banner::before {
            content: '';
            position: absolute;
            width: 200px; height: 200px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
            top: -80px; right: -60px;
        }
        .login-banner::after {
            content: '';
            position: absolute;
            width: 120px; height: 120px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
            bottom: -40px; left: -30px;
        }

        .login-logo {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }
        .login-logo .logo-icon {
            width: 36px; height: 36px;
            background: rgba(255,255,255,0.15);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; color: white;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        .login-logo span {
            font-size: 16px; font-weight: 700;
            color: white; letter-spacing: 0.5px;
        }

        .login-banner h1 {
            font-size: 22px; font-weight: 700;
            color: white; margin-bottom: 6px;
            position: relative; z-index: 1;
        }
        .login-banner p {
            font-size: 13px; color: rgba(255,255,255,0.6);
            position: relative; z-index: 1;
        }

        /* Card body */
        .login-body {
            padding: 32px;
        }

        /* Alert */
        .alert {
            display: flex; align-items: flex-start; gap: 10px;
            padding: 12px 14px; border-radius: var(--radius-sm);
            font-size: 13px; border-left: 3px solid;
            margin-bottom: 20px;
        }
        .alert-success { background: #e8f8f3; border-color: var(--green); color: #00774f; }
        .alert-danger  { background: #fff3f0; border-color: var(--red);   color: #b03010; }
        .alert i { font-size: 14px; flex-shrink: 0; margin-top: 1px; }

        /* Form */
        .form-group { margin-bottom: 18px; }
        .form-label {
            display: block; font-size: 12px; font-weight: 600;
            color: var(--text-dark); margin-bottom: 6px;
        }

        .input-icon-wrap { position: relative; }
        .input-icon-wrap .input-icon {
            position: absolute; left: 13px; top: 50%; transform: translateY(-50%);
            color: var(--text-muted); font-size: 13px; pointer-events: none;
        }
        .input-icon-wrap .input-icon-right {
            position: absolute; right: 13px; top: 50%; transform: translateY(-50%);
            color: var(--text-muted); font-size: 13px; cursor: pointer;
            background: none; border: none; padding: 0;
        }
        .input-icon-wrap .input-icon-right:hover { color: var(--purple); }

        .form-input {
            width: 100%; height: var(--input-h);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 0 14px 0 38px;
            font-size: 13.5px; font-family: 'Inter', sans-serif;
            color: var(--text-dark); background: white;
            outline: none;
            transition: border-color var(--transition), box-shadow var(--transition);
        }
        .form-input::placeholder { color: var(--text-light); }
        .form-input:hover  { border-color: var(--purple-light); }
        .form-input:focus  { border-color: var(--purple); box-shadow: 0 0 0 3px rgba(108,92,231,0.12); }
        .form-input.is-error { border-color: var(--red); }
        .form-input.is-error:focus { box-shadow: 0 0 0 3px rgba(225,112,85,0.12); }
        .form-input.has-right { padding-right: 38px; }

        .form-error {
            font-size: 11px; color: var(--red);
            margin-top: 5px; display: flex; align-items: center; gap: 4px;
        }

        /* Remember me */
        .form-check { display: flex; align-items: center; gap: 8px; cursor: pointer; }
        .form-check input[type="checkbox"] { display: none; }
        .check-box {
            width: 17px; height: 17px; border-radius: 4px;
            border: 1.5px solid var(--border); background: white;
            display: flex; align-items: center; justify-content: center;
            font-size: 9px; color: white;
            transition: all var(--transition); flex-shrink: 0;
        }
        .form-check input[type="checkbox"]:checked + .check-box {
            background: var(--purple); border-color: var(--purple);
        }
        .form-check input[type="checkbox"]:checked + .check-box::after {
            content: '\f00c'; font-family: 'Font Awesome 6 Free'; font-weight: 900;
        }
        .check-label { font-size: 13px; font-weight: 500; color: var(--text-dark); }

        /* Submit button */
        .btn-login {
            width: 100%; height: 46px;
            background: linear-gradient(135deg, var(--purple-dark), var(--purple));
            color: white; border: none; border-radius: var(--radius-sm);
            font-size: 14px; font-weight: 600; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: all var(--transition);
            box-shadow: 0 4px 15px rgba(108,92,231,0.35);
            margin-top: 24px;
        }
        .btn-login:hover {
            background: linear-gradient(135deg, var(--purple), var(--purple-light));
            box-shadow: 0 6px 20px rgba(108,92,231,0.45);
            transform: translateY(-1px);
        }
        .btn-login:active { transform: translateY(0); }

        /* Footer note */
        .login-footer {
            text-align: center; margin-top: 20px;
            font-size: 12px; color: var(--text-muted);
        }
        .login-footer a {
            color: var(--purple); font-weight: 600; text-decoration: none;
        }
        .login-footer a:hover { text-decoration: underline; }

        /* Divider */
        .divider {
            display: flex; align-items: center; gap: 12px;
            margin: 20px 0; font-size: 11px; color: var(--text-light);
        }
        .divider::before, .divider::after {
            content: ''; flex: 1; height: 1px; background: var(--border);
        }
    </style>
</head>
<body>

    {{-- Background decorative shapes --}}
    <div class="bg-shape bg-shape-1"></div>
    <div class="bg-shape bg-shape-2"></div>
    <div class="bg-shape bg-shape-3"></div>

    <div class="login-card">

        {{-- Banner --}}
        <div class="login-banner">
            <div class="login-logo">
                <div class="logo-icon"><i class="fas fa-map-marker-alt"></i></div>
                <span>WTI Dashboard</span>
            </div>
            <h1>Welcome Back</h1>
            <p>Sign in to manage your travel platform</p>
        </div>

        {{-- Body --}}
        <div class="login-body">

            {{-- Session status --}}
            @if(Session::has('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ Session::get('status') }}
                </div>
            @endif

            {{-- General error --}}
            @if($errors->has('email') && !$errors->has('password'))
                {{-- handled per field below --}}
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email"
                               name="email"
                               class="form-input {{ $errors->has('email') ? 'is-error' : '' }}"
                               value="{{ old('email') }}"
                               placeholder="admin@example.com"
                               autocomplete="email"
                               autofocus>
                    </div>
                    @error('email')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password"
                               id="passwordInput"
                               name="password"
                               class="form-input has-right {{ $errors->has('password') ? 'is-error' : '' }}"
                               placeholder="Enter your password"
                               autocomplete="current-password">
                        <button type="button" class="input-icon-right" onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Remember me --}}
                <label class="form-check">
                    <input type="checkbox" name="remember" value="1" id="rememberMe">
                    <span class="check-box"></span>
                    <span class="check-label">Remember me</span>
                </label>

                {{-- Submit --}}
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    Sign In
                </button>

            </form>

            <div class="login-footer">
                <a href="{{ route('frontend.index') }}">
                    <i class="fas fa-globe" style="font-size:11px;"></i>
                    Back to Website
                </a>
            </div>

        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('passwordInput');
            const icon  = document.getElementById('toggleIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>

</body>
</html>
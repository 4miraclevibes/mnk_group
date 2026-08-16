<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Agrasara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --ink: #1a1d21;
            --slate: #2f343a;
            --steel: #4a5058;
            --mist: #e8eaed;
            --ash: #6b7280;
        }
        body {
            background:
                radial-gradient(ellipse at 20% 20%, rgba(255, 255, 255, 0.06), transparent 50%),
                radial-gradient(ellipse at 80% 80%, rgba(255, 255, 255, 0.04), transparent 45%),
                linear-gradient(145deg, #1a1d21 0%, #2f343a 55%, #3d4450 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 24px 64px rgba(0, 0, 0, 0.45);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            display: flex;
        }
        .login-left {
            flex: 1;
            background:
                radial-gradient(circle at 30% 20%, rgba(255, 255, 255, 0.08), transparent 55%),
                linear-gradient(160deg, #111417 0%, #1f2429 50%, #2a3038 100%);
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #f3f4f6;
            text-align: center;
        }
        .login-left img {
            max-width: 200px;
            margin-bottom: 30px;
        }
        .login-left h2 {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .login-left p {
            font-size: 16px;
            opacity: 0.78;
            color: #d1d5db;
        }
        .login-right {
            flex: 1;
            padding: 60px 50px;
            background: #fafbfc;
        }
        .login-right h3 {
            font-size: 28px;
            font-weight: bold;
            color: var(--ink);
            margin-bottom: 10px;
        }
        .login-right p {
            color: var(--ash);
            margin-bottom: 30px;
        }
        .form-control {
            padding: 12px 15px;
            border-radius: 10px;
            border: 2px solid var(--mist);
            background: #fff;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: var(--steel);
            box-shadow: 0 0 0 0.2rem rgba(47, 52, 58, 0.15);
        }
        .form-label {
            font-weight: 600;
            color: var(--slate);
            margin-bottom: 8px;
        }
        .btn-login {
            background: linear-gradient(135deg, #2f343a 0%, #1a1d21 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(26, 29, 33, 0.35);
            color: white;
        }
        .forgot-password {
            color: var(--steel);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        .forgot-password:hover {
            color: var(--ink);
            text-decoration: underline;
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
            color: var(--ash);
            font-size: 14px;
        }
        .register-link a {
            color: var(--steel);
            text-decoration: none;
            font-weight: 600;
        }
        .register-link a:hover {
            color: var(--ink);
            text-decoration: underline;
        }
        .alert {
            border-radius: 10px;
            padding: 12px 15px;
            margin-bottom: 20px;
        }
        .form-check-input:checked {
            background-color: var(--slate);
            border-color: var(--slate);
        }
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            .login-left {
                padding: 40px 30px;
            }
            .login-right {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <img src="{{ asset('logoWithText.png') }}" alt="Agrasara Logo">
            <h2>Selamat Datang!</h2>
            <p>Silakan login untuk mengakses sistem ujian dan test kecermatan Bimbel Agrasara</p>
        </div>
        <div class="login-right">
            <h3>Login</h3>
            <p>Masukkan email dan password Anda</p>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Oops!</strong> Ada kesalahan pada input Anda.
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope me-2"></i>Email
                    </label>
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Masukkan email Anda"
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock me-2"></i>Password
                    </label>
                    <input
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        id="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Masukkan password Anda"
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                        <label class="form-check-label" for="remember_me">
                            Ingat Saya
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Masuk
                </button>

                <!-- Info -->
                <div class="register-link">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Belum punya akun? Silakan hubungi admin untuk pendaftaran.
                    </small>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

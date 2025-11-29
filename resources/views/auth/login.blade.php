<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Florent</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #D9EAFD 0%, #FFF2E0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .auth-card {
            width: 100%;
            max-width: 450px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
        }

        .auth-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .auth-logo img {
            width: 80px;
            height: 80px;
        }

        label {
            font-weight: 500;
            color: #333;
            margin-bottom: 5px;
        }

        input.form-control {
            border-radius: 12px;
            border: 1px solid #ccc;
            padding: 10px 14px;
            font-size: 14px;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        input:focus {
            outline: none;
            border-color: #64b5f6;
            box-shadow: 0 0 5px rgba(100, 181, 246, 0.5);
        }

        .btn-login {
            border-radius: 12px;
            background-color: #0891b2;
            border: none;
            font-weight: 600;
            color: #fff;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            transition: 0.3s ease;
        }

        .btn-login:hover {
            background-color: #155e75;
            box-shadow: 0 4px 12px rgba(8, 145, 178, 0.4);
        }

        .link-register {
            color: #0891b2;
            text-decoration: none;
            font-weight: 500;
        }

        .link-register:hover {
            text-decoration: underline;
            color: #0e7490;
        }
    </style>
</head>

<body>
    <div class="auth-card">
        <div class="auth-logo">
            <img src="{{ asset('images/favicon.png') }}" alt="Logo Florent">
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email">Email</label>
                <input 
                    type="text" 
                    id="email" 
                    name="email" 
                    class="form-control" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus 
                    autocomplete="email"
                    placeholder="Masukkan email kamu">
                @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-control" 
                    required 
                    autocomplete="current-password"
                    placeholder="Masukkan password">
                @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check m-0">
                    <input 
                        type="checkbox" 
                        class="form-check-input" 
                        id="remember_me" 
                        name="remember">
                    <label class="form-check-label" for="remember_me">Ingat saya</label>
                </div>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="link-register small text-decoration-none">
                        Lupa password?
                    </a>
                @endif
            </div>

            <button type="submit" class="btn-login">Login</button>

            <div class="text-center mt-3">
                <p class="mb-0">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="link-register">Daftar sekarang</a>
                </p>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!-- <x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input 
                type="text" 
                class="form-control" 
                id="username" 
                name="username" 
                value="{{ old('username') }}" 
                required 
                autofocus 
                autocomplete="username"
                placeholder="Masukkan username">
            @error('username')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input 
                type="password" 
                class="form-control" 
                id="password" 
                name="password" 
                required 
                autocomplete="current-password"
                placeholder="Masukkan password">
            @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-check mb-3">
            <input 
                type="checkbox" 
                class="form-check-input" 
                id="remember_me" 
                name="remember">
            <label class="form-check-label" for="remember_me">Ingat saya</label>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary w-100 py-2" style="border-radius: 10px; font-weight: 600;">
                Login
            </button>
        </div>
    </form>
</x-guest-layout> -->
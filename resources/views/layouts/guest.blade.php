<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Florent') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .auth-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
        }

        .auth-card:hover {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
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

        .auth-form label {
            font-weight: 500;
            color: #333;
            margin-bottom: 5px;
        }

        .auth-form input[type="text"],
        .auth-form input[type="password"] {
            border-radius: 12px;
            border: 1px solid #ccc;
            padding: 10px 14px;
            font-size: 14px;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
        }

        .auth-form input:focus {
            outline: none;
            border-color: #64b5f6;
            box-shadow: 0 0 5px rgba(100, 181, 246, 0.5);
        }

        .auth-form button {
            border-radius: 12px;
            background-color: #64b5f6;
            border: none;
            font-weight: 600;
            color: #fff;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            transition: 0.3s ease;
            text-align: center;
        }

        .auth-form button:hover {
            background-color: #42a5f5;
            box-shadow: 0 4px 12px rgba(66, 165, 245, 0.4);
        }

        .auth-form a {
            color: #64b5f6;
            text-decoration: none;
            font-weight: 500;
        }

        .auth-form a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="auth-logo">
            <img src="{{ asset('images/favicon.png') }}" alt="Logo Florent">
        </div>

        <div class="auth-form">
            {{ $slot }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

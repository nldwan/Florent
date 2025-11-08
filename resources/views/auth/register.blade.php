<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | Florent</title>
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
            max-width: 900px;
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

        input.form-control,
        select.form-select {
            border-radius: 12px;
            border: 1px solid #ccc;
            padding: 10px 14px;
            font-size: 14px;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #64b5f6;
            box-shadow: 0 0 5px rgba(100, 181, 246, 0.5);
        }

        .btn-register {
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

        .btn-register:hover {
            background-color: #155e75;
            box-shadow: 0 4px 12px rgba(8, 145, 178, 0.4);
        }

        .link-login {
            color: #0891b2;
            text-decoration: none;
            font-weight: 500;
        }

        .link-login:hover {
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
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="row g-4">
                <div class="col-md-6">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="col-md-6">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email" required>
                </div>

                <div class="col-md-6">
                    <label for="no_hp">Nomor HP</label>
                    <input type="text" id="no_hp" name="no_hp" class="form-control" placeholder="Masukkan nomor hp" required>
                </div>

                <div class="col-md-6">
                    <label for="kursus">Kursus</label>
                    <select id="kursus" name="kursus" class="form-select" required>
                        <option value="">Pilih Kursus</option>
                        <option value="kid">Kid Program</option>
                        <option value="teen">Teen & Youth Program</option>
                        <option value="toefl">TOEFL Preparation</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>

                <div class="col-md-6">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Masukkan passwrod" required>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <button type="submit" class="btn-register">Daftar Sekarang</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
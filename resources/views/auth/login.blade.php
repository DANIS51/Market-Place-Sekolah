<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Marketplace Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #FFFFFF;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #F9D342 0%, #F4E285 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.5rem;
            box-shadow: 0 4px 10px rgba(249, 211, 66, 0.3);
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .subtitle {
            color: #666;
            text-align: center;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .form-control {
            border: 2px solid #F4E285;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background-color: #FEFEFE;
        }

        .form-control:focus {
            border-color: #F9D342;
            box-shadow: 0 0 0 0.2rem rgba(249, 211, 66, 0.15);
            background-color: #FFFEF7;
        }

        .form-label {
            font-weight: 500;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .btn-login {
            background: linear-gradient(135deg, #F9D342 0%, #F4E285 100%);
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 600;
            color: #333;
            width: 100%;
            margin-top: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(249, 211, 66, 0.2);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #F4E285 0%, #F9D342 100%);
            box-shadow: 0 6px 15px rgba(249, 211, 66, 0.3);
            color: #333;
        }

        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
            font-size: 0.9rem;
        }

        .register-link a {
            color: #D4A017;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            text-decoration: underline;
            color: #B8941F;
        }

        .alert {
            border-radius: 8px;
            border: none;
            padding: 0.75rem 1rem;
        }

        .alert-danger {
            background: #FFF5F5;
            color: #E53E3E;
            border-left: 4px solid #FEB2B2;
        }

        .alert-success {
            background: #F0FFF4;
            color: #38A169;
            border-left: 4px solid #9AE6B4;
        }

        .footer {
            text-align: center;
            margin-top: 2rem;
            color: #999;
            font-size: 0.8rem;
        }

        @media (max-width: 480px) {
            .login-card {
                margin: 1rem;
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="" >
            <a href="{{ route('home') }}"><i class="fas fa-arrow-left" style="color: #D4A017;"></i></a>
        </div>
        <div class="logo-section">
            <div class="logo">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h2>Selamat Datang</h2>
            <p class="subtitle">Masukkan kredensial Anda untuk mengakses akun</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" placeholder="Masukkan username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn btn-login">Masuk</button>
        </form>

        <div class="register-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Marketplace Sekolah
        </div>
    </div>
</body>
</html>

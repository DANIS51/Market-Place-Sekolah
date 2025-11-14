<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Marketplace Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .register-card {
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.5rem;
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
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .form-label {
            font-weight: 500;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 600;
            color: white;
            width: 100%;
            margin-top: 1rem;
            transition: transform 0.2s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
            font-size: 0.9rem;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 8px;
            border: none;
            padding: 0.75rem 1rem;
        }

        .alert-info {
            background: #e3f2fd;
            color: #1976d2;
        }

        .footer {
            text-align: center;
            margin-top: 2rem;
            color: #999;
            font-size: 0.8rem;
        }

        @media (max-width: 480px) {
            .register-card {
                margin: 1rem;
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-card">
        <div class="logo-section">
            <div class="logo">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h2>Buat Akun</h2>
            <p class="subtitle">Bergabung dengan komunitas marketplace sekolah</p>
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

        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            Akun Anda akan diproses oleh admin. Anda akan mendapat konfirmasi setelah disetujui.
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="mb-3">
                <label for="kontak" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="kontak" name="kontak" value="{{ old('kontak') }}" placeholder="Masukkan nomor telepon" required>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" placeholder="Pilih username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Buat password" required>
            </div>

            <button type="submit" class="btn btn-register">Daftar</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Marketplace Sekolah
        </div>
    </div>
</body>
</html>

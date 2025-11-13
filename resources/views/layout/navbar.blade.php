<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NamaToko')</title>

    <!-- // Bootstrap Offline -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    <style>
        /* // Styling tambahan */
        .navbar {
            background-color: #ffffff; /* warna putih */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* efek bayangan */
        }
        .navbar-brand {
            font-weight: 700;
            color: #0d6efd;
        }
        .nav-link {
            color: #333;
            font-weight: 500;
            margin-left: 15px;
        }
        .nav-link:hover {
            color: #0d6efd;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="40" height="40" class="me-2 rounded-circle">
            NamaToko
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/produk') }}">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/toko') }}">Toko</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/kategori') }}">Kategori</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- // Tempat konten halaman -->
<div class="container mt-4">
    @yield('content')
</div>

<!-- // Bootstrap JS Offline -->
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>

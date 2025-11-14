<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace Sekolah - Jual Beli Kebutuhan Sekolah Mudah & Aman</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Google Fonts (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
     <style>
        :root {
            --primary-color: #6c757d;
            --accent-color: #ffc107;
            --light-bg: #f8f9fa;
            --border-color: #dee2e6;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            color: #333;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #ffffff !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 12px 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #333 !important;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .navbar-brand i {
            color: var(--accent-color);
        }

        .nav-link {
            font-weight: 500;
            color: #555 !important;
            margin: 0 5px;
            padding: 8px 15px !important;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: var(--light-bg);
            color: #333 !important;
        }

        .nav-link.text-warning {
            color: var(--accent-color) !important;
        }

        .input-group {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-radius: 50px;
            overflow: hidden;
            background-color: var(--light-bg);
        }

        .form-control {
            border: none;
            background-color: transparent;
            padding: 10px 20px;
        }

        .form-control:focus {
            box-shadow: none;
            background-color: transparent;
        }

        .btn-outline-secondary {
            border: none;
            background-color: transparent;
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .dropdown-menu {
            border: 1px solid var(--border-color);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
        }

        .dropdown-item {
            border-radius: 8px;
            margin: 2px 0;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: var(--light-bg);
            transform: translateX(5px);
        }

        /* Content Styles */
        .content-wrapper {
            min-height: calc(100vh - 280px);
            background-color: #ffffff;
        }

        /* Footer Styles */
        footer {
            background-color: #f8f9fa;
            color: #333;
            border-top: 1px solid var(--border-color);
            padding: 50px 0 20px;
        }

        footer h5 {
            font-weight: 600;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        footer h5::after {
            content: '';
            position: absolute;
            width: 40px;
            height: 3px;
            background-color: var(--accent-color);
            bottom: 0;
            left: 0;
        }

        footer ul {
            padding: 0;
            list-style: none;
        }

        footer ul li {
            margin-bottom: 10px;
            transition: transform 0.3s ease;
        }

        footer ul li:hover {
            transform: translateX(5px);
        }

        footer a {
            color: #666;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: var(--primary-color);
        }

        .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: #e9ecef;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            margin-right: 10px;
            transition: all 0.3s ease;
            color: #666 !important;
        }

        .social-icons a:hover {
            background-color: var(--accent-color);
            color: white !important;
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            padding-top: 20px;
            margin-top: 30px;
            border-top: 1px solid var(--border-color);
            color: #666;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-nav {
                margin-top: 20px;
            }

            .form-control {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>

    <!-- ==================== NAVBAR ==================== -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light shadow-sm sticky-top">
            <div class="container">
                <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('home') }}">
                    <i class="bi bi-bag-heart-fill text-warning me-2 fs-4"></i>
                    <span>SekoolMart</span>
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Search Form (Always Visible) -->
                <form class="d-flex me-3 d-lg-flex flex-grow-1 flex-lg-grow-0" role="search" style="max-width: 300px;">
                    <div class="input-group">
                        <input class="form-control border-end-0 rounded-start-pill" type="search" placeholder="Cari produk..." aria-label="Search">
                        <button class="btn btn-outline-secondary rounded-end-pill px-3" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Navigation Links -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link fw-medium {{ request()->routeIs('home') ? 'text-warning' : '' }}" href="{{ route('home') }}">
                                <i class="bi bi-house-door me-1"></i>Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="#produk">
                                <i class="bi bi-grid me-1"></i>Produk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="#toko">
                                <i class="bi bi-shop me-1"></i>Toko
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="#kategori">
                                <i class="bi bi-tags me-1"></i>Kategori
                            </a>
                        </li>
                    </ul>

                    <!-- User Actions -->
                    <ul class="navbar-nav">
                        @guest
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="{{ route('login') }}">
                                <i class="bi bi-person-circle me-1"></i>Masuk
                            </a>
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-medium d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                <div class="bg-light text-primary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 14px;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span class="d-none d-lg-inline">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                @if(Auth::user()->role === 'admin')
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard Admin</a></li>
                                @elseif(Auth::user()->role === 'member')
                                <li><a class="dropdown-item" href="{{ route('member.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('produk.index') }}"><i class="bi bi-box-seam me-2"></i>Kelola Produk</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                </a></li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="content-wrapper">
        @yield('conten-pengguna')
    </div>

    <!-- ==================== FOOTER ==================== -->
    <footer class="pt-5 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5><i class="bi bi-bag-heart-fill text-warning"></i> SekoolMart</h5>
                    <p>Marketplace terpercaya untuk memenuhi semua kebutuhan sekolah Anda dengan mudah, cepat, dan aman.</p>
                    <div class="social-icons mt-3">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <h6>Layanan</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">Cara Belanja</a></li>
                        <li><a href="#">Cara Jual</a></li>
                        <li><a href="#">Pembayaran</a></li>
                        <li><a href="#">Pengiriman</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h6>Bantuan</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Hubungi Kami</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h6>Download Aplikasi</h6>
                    <p>Dapatkan pengalaman belanja yang lebih baik dengan aplikasi mobile kami</p>
                    <div class="d-flex gap-2 mt-3">
                        <a href="#" class="btn btn-outline-secondary d-flex align-items-center">
                            <i class="bi bi-google-play me-2"></i> Google Play
                        </a>
                        <a href="#" class="btn btn-outline-secondary d-flex align-items-center">
                            <i class="bi bi-apple me-2"></i> App Store
                        </a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p class="mb-0">&copy; 2024 SekoolMart. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - AdminPanel</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom CSS -->
    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
            /* Warna putih bersih untuk sidebar dan topbar */
            --sidebar-bg: #ffffff;
            --sidebar-hover: #f8f9fa;
            /* Warna teks yang kontras dengan putih */
            --sidebar-text: #343a40;
            --sidebar-text-muted: #6c757d;
            /* Warna latar belakang utama yang lebih lembut (abu-abu sangat muda) */
            --main-bg: #f8f9fa;
            --topbar-bg: #ffffff;
            --border-color: #dee2e6;
            /* Warna aksen untuk item aktif */
            --sidebar-active: #e9ecef;
            --sidebar-active-text: #0d6efd;
            --transition-speed: 0.3s;
            --shadow-light: 0 2px 10px rgba(0, 0, 0, 0.05);
            --shadow-medium: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--main-bg);
            overflow-x: hidden;
            transition: all var(--transition-speed);
        }

        /* Wrapper untuk layout flexbox */
        .wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
            position: relative;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            transition: all var(--transition-speed) cubic-bezier(0.25, 0.8, 0.25, 1);
            z-index: 1000;
            overflow-y: auto;
            overflow-x: hidden;
            border-right: 1px solid var(--border-color);
            box-shadow: var(--shadow-light);
        }

        /* Custom scrollbar for sidebar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: var(--sidebar-bg);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: var(--sidebar-text-muted);
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid var(--border-color);
            position: relative;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        }

        .sidebar-header .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: bold;
            transition: all var(--transition-speed);
        }

        .sidebar-header .logo:hover {
            transform: scale(1.05);
        }

        .sidebar-header .logo i {
            font-size: 2rem;
            margin-right: 10px;
            color: var(--sidebar-active-text);
            transition: all var(--transition-speed);
        }

        .sidebar.collapsed .logo-text {
            display: none;
        }

        .sidebar.collapsed .logo i {
            margin-right: 0;
        }

        /* User Profile Section */
        .user-profile {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid var(--border-color);
            position: relative;
            transition: all var(--transition-speed);
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        }

        .user-profile .avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 4px solid var(--border-color);
            transition: all var(--transition-speed);
            cursor: pointer;
            box-shadow: var(--shadow-light);
        }

        .user-profile .avatar:hover {
            transform: scale(1.05);
            border-color: var(--sidebar-active-text);
            box-shadow: var(--shadow-medium);
        }

        .user-profile .info .name {
            font-weight: 600;
            margin: 0;
            color: var(--sidebar-text);
            font-size: 1.1rem;
            transition: all var(--transition-speed);
        }

        .user-profile .info .role {
            font-size: 0.9rem;
            color: var(--sidebar-text-muted);
            margin-top: 5px;
            display: inline-block;
            padding: 3px 10px;
            background-color: var(--sidebar-active);
            border-radius: 12px;
            transition: all var(--transition-speed);
        }

        .sidebar.collapsed .user-profile .info {
            display: none;
        }

        .sidebar.collapsed .user-profile .avatar {
            width: 45px;
            height: 45px;
            border-width: 3px;
        }

        /* Sidebar Navigation */
        .sidebar-nav {
            padding: 20px 0;
        }

        .sidebar-nav .nav-item {
            position: relative;
            margin-bottom: 8px;
        }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            padding: 16px 20px;
            color: var(--sidebar-text);
            text-decoration: none;
            transition: all var(--transition-speed);
            border-radius: 10px;
            margin: 0 12px;
            position: relative;
            overflow: hidden;
        }

        .sidebar-nav .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: var(--sidebar-active-text);
            transform: scaleY(0);
            transition: transform var(--transition-speed);
        }

        .sidebar-nav .nav-link:hover {
            background-color: var(--sidebar-hover);
            color: var(--sidebar-active-text);
            transform: translateX(5px);
            box-shadow: var(--shadow-light);
        }

        .sidebar-nav .nav-link:hover::before {
            transform: scaleY(1);
        }

        .sidebar-nav .nav-link i {
            font-size: 1.3rem;
            margin-right: 15px;
            width: 30px;
            text-align: center;
            color: var(--sidebar-text-muted);
            transition: all var(--transition-speed);
        }

        .sidebar-nav .nav-link:hover i {
            color: var(--sidebar-active-text);
            transform: scale(1.1);
        }

        .sidebar-nav .nav-link span {
            flex-grow: 1;
            font-weight: 500;
            transition: all var(--transition-speed);
        }

        .sidebar.collapsed .nav-link span {
            display: none;
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 16px;
        }

        .sidebar.collapsed .nav-link i {
            margin-right: 0;
        }

        .sidebar-nav .nav-link.active {
            background-color: var(--sidebar-active);
            color: var(--sidebar-active-text);
            font-weight: 600;
            box-shadow: var(--shadow-light);
        }

        .sidebar-nav .nav-link.active::before {
            transform: scaleY(1);
        }

        .sidebar-nav .nav-link.active i {
            color: var(--sidebar-active-text);
        }

        /* Tooltip for collapsed sidebar */
        .sidebar.collapsed .nav-item {
            position: relative;
        }

        .sidebar.collapsed .nav-item .nav-link::after {
            content: attr(data-tooltip);
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            margin-left: 10px;
            padding: 6px 12px;
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            border-radius: 6px;
            box-shadow: var(--shadow-medium);
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity var(--transition-speed);
            z-index: 1000;
            font-size: 0.9rem;
            border: 1px solid var(--border-color);
        }

        .sidebar.collapsed .nav-item:hover .nav-link::after {
            opacity: 1;
        }

        /* Main Content Area */
        .main {
            flex-grow: 1;
            margin-left: var(--sidebar-width);
            transition: margin-left var(--transition-speed) cubic-bezier(0.25, 0.8, 0.25, 1);
            display: flex;
            flex-direction: column;
        }

        .main.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Topbar */
        .topbar {
            background-color: var(--topbar-bg);
            padding: 18px 30px;
            box-shadow: var(--shadow-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .topbar .toggle-sidebar {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--sidebar-text);
            transition: all var(--transition-speed);
            border-radius: 8px;
            padding: 8px 12px;
        }

        .topbar .toggle-sidebar:hover {
            background-color: var(--sidebar-hover);
            transform: scale(1.1);
        }

        .topbar .search-bar {
            position: relative;
            width: 350px;
        }

        .topbar .search-bar input {
            width: 100%;
            padding: 10px 15px 10px 45px;
            border-radius: 25px;
            border: 1px solid var(--border-color);
            background-color: var(--main-bg);
            color: var(--sidebar-text);
            transition: all var(--transition-speed);
            font-size: 0.95rem;
        }

        .topbar .search-bar input:focus {
            outline: none;
            border-color: var(--sidebar-active-text);
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
            background-color: var(--sidebar-bg);
        }

        .topbar .search-bar i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--sidebar-text-muted);
            font-size: 1.1rem;
        }

        .topbar .topbar-nav {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .topbar .topbar-nav .nav-item {
            position: relative;
        }

        .topbar .topbar-nav .nav-link {
            color: var(--sidebar-text);
            font-size: 1.2rem;
            padding: 10px;
            border-radius: 8px;
            transition: all var(--transition-speed);
            position: relative;
        }

        .topbar .topbar-nav .nav-link:hover {
            background-color: var(--sidebar-hover);
            color: var(--sidebar-active-text);
            transform: translateY(-2px);
        }

        .notification-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            background-color: #dc3545;
            border-radius: 50%;
            border: 2px solid var(--topbar-bg);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
            }
        }

        /* Content */
        .content {
            padding: 30px;
            color: var(--sidebar-text);
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .content h1, .content h3 {
            color: var(--sidebar-text);
            margin-bottom: 20px;
            font-weight: 600;
        }

        .content p {
            color: var(--sidebar-text-muted);
            line-height: 1.6;
        }

        /* Card improvements */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--shadow-light);
            transition: all var(--transition-speed);
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-medium);
        }

        .card-body {
            padding: 25px;
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid var(--border-color);
            padding: 15px 25px;
            font-weight: 600;
        }

        /* Stat Cards */
        .stat-card {
            position: relative;
            overflow: hidden;
        }

        .stat-card .stat-icon {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 3rem;
            opacity: 0.1;
        }

        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-card .stat-label {
            color: var(--sidebar-text-muted);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-card .stat-change {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 10px;
        }

        .stat-change.positive {
            background-color: rgba(25, 135, 84, 0.1);
            color: #198754;
        }

        .stat-change.negative {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        /* Activity Feed */
        .activity-item {
            display: flex;
            align-items: flex-start;
            padding: 15px 0;
            border-bottom: 1px solid var(--border-color);
            transition: all var(--transition-speed);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-item:hover {
            background-color: var(--sidebar-hover);
            margin: 0 -25px;
            padding: 15px 25px;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .activity-content {
            flex-grow: 1;
        }

        .activity-title {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .activity-time {
            color: var(--sidebar-text-muted);
            font-size: 0.85rem;
        }

        /* Recent Orders Table */
        .table {
            margin-bottom: 0;
        }

        .table thead th {
            border-bottom: 2px solid var(--border-color);
            color: var(--sidebar-text);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 15px;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-color);
        }

        .table tbody tr:hover {
            background-color: var(--sidebar-hover);
        }

        .order-status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-pending {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        .status-processing {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }

        .status-completed {
            background-color: rgba(25, 135, 84, 0.1);
            color: #198754;
        }

        .status-cancelled {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        /* Quick Actions */
        .quick-action {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            transition: all var(--transition-speed);
            cursor: pointer;
            background-color: var(--sidebar-bg);
            border: 1px solid var(--border-color);
        }

        .quick-action:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-medium);
            background-color: var(--sidebar-hover);
        }

        .quick-action i {
            font-size: 2rem;
            color: var(--sidebar-active-text);
            margin-bottom: 10px;
        }

        .quick-action span {
            display: block;
            font-weight: 500;
        }

        /* Mobile Overlay */
        .mobile-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            z-index: 998;
            opacity: 0;
            transition: opacity var(--transition-speed);
        }

        .mobile-overlay.show {
            display: block;
            opacity: 1;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .topbar .search-bar {
                width: 250px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: -100%;
                box-shadow: none;
            }

            .sidebar.show {
                margin-left: 0;
                box-shadow: var(--shadow-medium);
            }

            .main {
                margin-left: 0;
            }

            .main.expanded {
                margin-left: 0;
            }

            .topbar {
                padding: 15px 20px;
            }

            .topbar .search-bar {
                display: none;
            }

            .content {
                padding: 20px;
            }

            .stat-card .stat-icon {
                font-size: 2rem;
            }

            .stat-card .stat-value {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <!-- Mobile Overlay -->
        <div class="mobile-overlay" id="mobileOverlay"></div>

        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="#" class="logo">
                    <i class="bi bi-layers-fill"></i>
                    <span class="logo-text">AdminPanel</span>
                </a>
            </div>

            <div class="user-profile">
                <img src="https://i.pravatar.cc/150?img={{ Auth::user()->id % 10 + 1 }}" alt="User Avatar" class="avatar" id="userAvatar">
                <div class="info">
                    <p class="name">{{ Auth::user()->nama }}</p>
                    <p class="role">{{ Auth::user()->role == 'admin' ? 'Administrator' : 'Member' }}</p>
                </div>
            </div>

            <nav class="sidebar-nav">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}" data-tooltip="Dashboard">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @if(Auth::user()->isAdmin())
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link {{ Route::currentRouteName() == 'users' ? 'active' : '' }}" data-tooltip="Pengguna">
                            <i class="bi bi-people"></i>
                            <span>Pengguna</span>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('toko.index') }}" class="nav-link {{ Route::currentRouteName() == 'toko' ? 'active' : '' }}" data-tooltip="Toko">
                            <i class="bi bi-shop"></i>
                            <span>Toko</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pengaturan.index') }}" class="nav-link {{ Route::currentRouteName() == 'pengaturan' ? 'active' : '' }}" data-tooltip="Pengaturan">
                            <i class="bi bi-gear"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline" id="logoutForm">
                            @csrf
                            <button
                                type="submit"
                                class="nav-link border-0 bg-transparent w-100 text-start"
                                data-tooltip="Keluar"
                                onclick="return confirm('Apakah Anda yakin ingin keluar?');"
                            >
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Keluar</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main" id="main">
            <div class="topbar">
                <button class="toggle-sidebar" id="toggleSidebar">
                    <i class="bi bi-list"></i>
                </button>

                <div class="search-bar">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Cari..." id="searchInput">
                </div>

                <div class="topbar-nav">
                    <div class="nav-item">
                        <a href="#" class="nav-link" id="notificationBtn">
                            <i class="bi bi-bell"></i>
                            <span class="notification-badge"></span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-envelope"></i>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-person-circle"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="content">
                <!-- Page Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="mb-1">Dashboard</h1>
                        <p class="text-muted">Selamat datang kembali, {{ Auth::user()->nama }}!</p>
                    </div>
                    <div>
                        <button class="btn btn-primary">
                            <i class="bi bi-download me-2"></i>Unduh Laporan
                        </button>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stat-card h-100">
                            <div class="card-body">
                                <i class="bi bi-people stat-icon text-primary"></i>
                                <div class="stat-value text-primary">{{ $totalUsers ?? 1,234 }}</div>
                                <div class="stat-label">Total Pengguna</div>
                                <div class="stat-change positive">
                                    <i class="bi bi-arrow-up"></i> 12% dari bulan lalu
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stat-card h-100">
                            <div class="card-body">
                                <i class="bi bi-shop stat-icon text-success"></i>
                                <div class="stat-value text-success">{{ $totalShops ?? 567 }}</div>
                                <div class="stat-label">Total Toko</div>
                                <div class="stat-change positive">
                                    <i class="bi bi-arrow-up"></i> 8% dari bulan lalu
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stat-card h-100">
                            <div class="card-body">
                                <i class="bi bi-box-seam stat-icon text-warning"></i>
                                <div class="stat-value text-warning">{{ $totalProducts ?? 8,901 }}</div>
                                <div class="stat-label">Total Produk</div>
                                <div class="stat-change positive">
                                    <i class="bi bi-arrow-up"></i> 23% dari bulan lalu
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stat-card h-100">
                            <div class="card-body">
                                <i class="bi bi-cart-check stat-icon text-danger"></i>
                                <div class="stat-value text-danger">{{ $totalOrders ?? 456 }}</div>
                                <div class="stat-label">Pesanan Bulan Ini</div>
                                <div class="stat-change negative">
                                    <i class="bi bi-arrow-down"></i> 5% dari bulan lalu
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts and Activity -->
                <div class="row mb-4">
                    <!-- Sales Chart -->
                    <div class="col-xl-8 mb-4">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Grafik Penjualan</h5>
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" class="btn btn-outline-secondary active">Minggu</button>
                                    <button type="button" class="btn btn-outline-secondary">Bulan</button>
                                    <button type="button" class="btn btn-outline-secondary">Tahun</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="salesChart" height="100"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="col-xl-4 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Aktivitas Terbaru</h5>
                            </div>
                            <div class="card-body">
                                <div class="activity-item">
                                    <div class="activity-icon bg-primary text-white">
                                        <i class="bi bi-person-plus"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-title">Pengguna baru mendaftar</div>
                                        <div class="activity-time">2 menit yang lalu</div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon bg-success text-white">
                                        <i class="bi bi-cart-plus"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-title">Pesanan baru #1234</div>
                                        <div class="activity-time">15 menit yang lalu</div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon bg-warning text-white">
                                        <i class="bi bi-exclamation-triangle"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-title">Stok produk hampir habis</div>
                                        <div class="activity-time">1 jam yang lalu</div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon bg-info text-white">
                                        <i class="bi bi-chat-dots"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-title">Komentar baru pada produk</div>
                                        <div class="activity-time">2 jam yang lalu</div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon bg-danger text-white">
                                        <i class="bi bi-x-circle"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-title">Pesanan #1230 dibatalkan</div>
                                        <div class="activity-time">3 jam yang lalu</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders and Quick Actions -->
                <div class="row">
                    <!-- Recent Orders -->
                    <div class="col-xl-8 mb-4">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Pesanan Terbaru</h5>
                                <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>ID Pesanan</th>
                                                <th>Pelanggan</th>
                                                <th>Toko</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#1234</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="https://i.pravatar.cc/30?img=1" class="rounded-circle me-2" width="30" height="30">
                                                        Ahmad Rizki
                                                    </div>
                                                </td>
                                                <td>Toko Sejahtera</td>
                                                <td>Rp 450.000</td>
                                                <td><span class="order-status status-processing">Diproses</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#1233</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="https://i.pravatar.cc/30?img=2" class="rounded-circle me-2" width="30" height="30">
                                                        Siti Nurhaliza
                                                    </div>
                                                </td>
                                                <td>Toko Maju Jaya</td>
                                                <td>Rp 320.000</td>
                                                <td><span class="order-status status-pending">Menunggu</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#1232</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="https://i.pravatar.cc/30?img=3" class="rounded-circle me-2" width="30" height="30">
                                                        Budi Santoso
                                                    </div>
                                                </td>
                                                <td>Toko Berkah</td>
                                                <td>Rp 675.000</td>
                                                <td><span class="order-status status-completed">Selesai</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#1231</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="https://i.pravatar.cc/30?img=4" class="rounded-circle me-2" width="30" height="30">
                                                        Diana Putri
                                                    </div>
                                                </td>
                                                <td>Toko Sejahtera</td>
                                                <td>Rp 210.000</td>
                                                <td><span class="order-status status-cancelled">Dibatalkan</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="col-xl-4 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Aksi Cepat</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-6">
                                        <div class="quick-action">
                                            <i class="bi bi-plus-circle"></i>
                                            <span>Tambah Produk</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="quick-action">
                                            <i class="bi bi-plus-circle"></i>
                                            <span>Tambah Toko</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="quick-action">
                                            <i class="bi bi-person-plus"></i>
                                            <span>Tambah User</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="quick-action">
                                            <i class="bi bi-file-earmark-text"></i>
                                            <span>Laporan</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="quick-action">
                                            <i class="bi bi-gear"></i>
                                            <span>Pengaturan</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="quick-action">
                                            <i class="bi bi-question-circle"></i>
                                            <span>Bantuan</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleSidebarBtn = document.getElementById('toggleSidebar');
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('main');
            const mobileOverlay = document.getElementById('mobileOverlay');
            const userAvatar = document.getElementById('userAvatar');
            const searchInput = document.getElementById('searchInput');
            const logoutForm = document.getElementById('logoutForm');

            // Toggle untuk sidebar di desktop dan mobile
            toggleSidebarBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                main.classList.toggle('expanded');

                // Untuk mobile, toggle class 'show' untuk menampilkan sidebar
                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('show');
                    mobileOverlay.classList.toggle('show');
                }
            });

            // Mobile overlay click to close sidebar
            mobileOverlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                mobileOverlay.classList.remove('show');
            });

            // User avatar click to show profile
            userAvatar.addEventListener('click', function() {
                // In a real application, this would navigate to the user profile page
                // or show a dropdown with profile options
                alert('Profil pengguna: ' + document.querySelector('.user-profile .info .name').textContent);
            });

            // Search functionality
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const navItems = document.querySelectorAll('.sidebar-nav .nav-item');

                navItems.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });

                // If search is cleared, show all items
                if (searchTerm === '') {
                    navItems.forEach(item => {
                        item.style.display = 'block';
                    });
                }
            });

            // Logout form confirmation
            logoutForm.addEventListener('submit', function(e) {
                if (!confirm('Apakah Anda yakin ingin keluar?')) {
                    e.preventDefault();
                }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    mobileOverlay.classList.remove('show');
                }
            });

            // Initialize Chart
            const ctx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                    datasets: [{
                        label: 'Penjualan',
                        data: [65, 78, 90, 81, 96, 105, 114],
                        borderColor: '#0d6efd',
                        backgroundColor: 'rgba(13, 110, 253, 0.1)',
                        tension: 0.4,
                        fill: true
                    }, {
                        label: 'Target',
                        data: [70, 80, 85, 90, 95, 100, 110],
                        borderColor: '#6c757d',
                        borderDash: [5, 5],
                        tension: 0.4,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Chart period buttons
            const chartPeriodBtns = document.querySelectorAll('.btn-group .btn');
            chartPeriodBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remove active class from all buttons
                    chartPeriodBtns.forEach(b => b.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');

                    // Update chart data based on period
                    // This is just a demo - in a real app, you would fetch different data
                    const period = this.textContent;
                    let labels, data1, data2;

                    if (period === 'Minggu') {
                        labels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
                        data1 = [65, 78, 90, 81, 96, 105, 114];
                        data2 = [70, 80, 85, 90, 95, 100, 110];
                    } else if (period === 'Bulan') {
                        labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
                        data1 = [320, 402, 380, 450];
                        data2 = [350, 400, 420, 440];
                    } else {
                        labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
                        data1 = [1200, 1400, 1100, 1600, 1500, 1800];
                        data2 = [1300, 1350, 1400, 1450, 1500, 1550];
                    }

                    salesChart.data.labels = labels;
                    salesChart.data.datasets[0].data = data1;
                    salesChart.data.datasets[1].data = data2;
                    salesChart.update();
                });
            });

            // Quick actions
            const quickActions = document.querySelectorAll('.quick-action');
            quickActions.forEach(action => {
                action.addEventListener('click', function() {
                    const actionText = this.querySelector('span').textContent;
                    console.log('Quick action clicked:', actionText);
                    // In a real app, this would navigate to the appropriate page
                });
            });
        });
    </script>
</body>
</html>

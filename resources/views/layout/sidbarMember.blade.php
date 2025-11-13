<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Member/Admin Bootstrap 5</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

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

            .content {
                padding: 20px;
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
                    <a href="{{ route('member.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'member.dashboard' ? 'active' : '' }}" data-tooltip="Dashboard">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if(Auth::user()->isAdmin())
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ Route::currentRouteName() == 'users.index' ? 'active' : '' }}" data-tooltip="Pengguna">
                        <i class="bi bi-people"></i>
                        <span>Pengguna</span>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('produk.index') }}" class="nav-link {{ Route::currentRouteName() == 'produk.index' ? 'active' : '' }}" data-tooltip="Produk">
                        <i class="bi bi-box-seam"></i>
                        <span>Produk</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('kategori.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['kategori.index','kategori.create','kategori.show','kategori.edit']) ? 'active' : '' }}" data-tooltip="Kategori">
                        <i class="bi bi-tags"></i>
                        <span>Kategori</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" data-tooltip="Pengaturan">
                        <i class="bi bi-gear"></i>
                        <span>Pengaturan</span>
                    </a>
                </li>

                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline" id="logoutForm">
                        @csrf
                        <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start" data-tooltip="Keluar" onclick="return confirm('Apakah Anda yakin ingin keluar?');">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main -->
    <main class="main" id="main">
        <div class="topbar">
            <button class="toggle-sidebar" id="toggleSidebar">
                <i class="bi bi-list"></i>
            </button>
            <div>
                <!-- Bisa tambahkan search bar, notifikasi, dll di sini -->
            </div>
        </div>
        <div class="content">
            @yield('content.member')
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleSidebarBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const main = document.getElementById('main');
    const mobileOverlay = document.getElementById('mobileOverlay');
    const userAvatar = document.getElementById('userAvatar');

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
        // In a real application, this would navigate to user profile page
        // or show a dropdown with profile options
        alert('Profil pengguna: ' + document.querySelector('.user-profile .info .name').textContent);
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            mobileOverlay.classList.remove('show');
        }
    });
});
</script>
</body>
</html>

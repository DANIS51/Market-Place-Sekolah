<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Admin Bootstrap 5</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

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
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--main-bg); /* Latar belakang halaman */
        }

        /* Wrapper untuk layout flexbox */
        .wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
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
            transition: all 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
            border-right: 1px solid var(--border-color); /* Border untuk memisahkan dari konten */
            box-shadow: 2px 0 5px rgba(0,0,0,0.05); /* Bayangan halus untuk kedalaman */
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-header .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .sidebar-header .logo i {
            font-size: 2rem;
            margin-right: 10px;
            color: var(--sidebar-active-text);
        }

        .sidebar.collapsed .logo-text {
            display: none;
        }

        /* User Profile Section */
        .user-profile {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid var(--border-color);
        }

        .user-profile .avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-bottom: 10px;
            border: 3px solid var(--sidebar-text-muted);
        }

        .user-profile .info .name {
            font-weight: 600;
            margin: 0;
            color: var(--sidebar-text);
        }

        .user-profile .info .role {
            font-size: 0.85rem;
            color: var(--sidebar-text-muted);
        }

        .sidebar.collapsed .user-profile .info {
            display: none;
        }

        /* Sidebar Navigation */
        .sidebar-nav {
            padding: 10px 0;
        }

        .sidebar-nav .nav-item {
            position: relative;
        }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: var(--sidebar-text);
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 4px; /* Tambahkan radius untuk tampilan lebih modern */
            margin: 2px 10px; /* Beri jarak di kiri dan kanan */
        }

        .sidebar-nav .nav-link:hover {
            background-color: var(--sidebar-hover);
            color: var(--sidebar-active-text);
        }

        .sidebar-nav .nav-link i {
            font-size: 1.2rem;
            margin-right: 15px;
            width: 25px;
            text-align: center;
            color: var(--sidebar-text-muted);
            transition: color 0.3s ease;
        }

        .sidebar-nav .nav-link:hover i {
            color: var(--sidebar-active-text);
        }

        .sidebar-nav .nav-link span {
            flex-grow: 1;
        }

        .sidebar.collapsed .nav-link span {
            display: none;
        }

        .sidebar-nav .nav-link.active {
            background-color: var(--sidebar-active);
            color: var(--sidebar-active-text);
            font-weight: 500;
        }

        .sidebar-nav .nav-link.active i {
            color: var(--sidebar-active-text);
        }

        /* Submenu Styles */
        .sidebar-nav .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            background-color: rgba(0,0,0,0.02);
        }

        .sidebar-nav .submenu.show {
            max-height: 500px;
        }

        .sidebar-nav .submenu .nav-link {
            padding-left: 60px;
            font-size: 0.9rem;
        }

        .sidebar.collapsed .submenu {
            display: none;
        }

        .sidebar-nav .has-submenu .arrow {
            transition: transform 0.3s;
            margin-left: auto; /* Dorong panah ke kanan */
        }

        .sidebar-nav .has-submenu.show .arrow {
            transform: rotate(90deg);
        }


        /* Main Content Area */
        .main {
            flex-grow: 1;
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .main.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Topbar */
        .topbar {
            background-color: var(--topbar-bg);
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
        }

        .topbar .toggle-sidebar {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--sidebar-text);
        }

        /* Content */
        .content {
            padding: 30px;
            color: var(--sidebar-text);
        }

        .content h1, .content h3 {
            color: var(--sidebar-text);
        }

        .content p {
            color: #495057; /* Warna teks yang sedikit lebih pudar untuk keterbacaan */
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -100%;
                box-shadow: none; /* Hilangkan bayangan di mobile */
            }

            .sidebar.show {
                margin-left: 0;
                box-shadow: 2px 0 5px rgba(0,0,0,0.05); /* Tampilkan saat terbuka */
            }

            .main {
                margin-left: 0;
            }

            .main.expanded {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="#" class="logo">
                    <i class="bi bi-layers-fill"></i>
                    <span class="logo-text">AdminPanel</span>
                </a>
            </div>

            <div class="user-profile">
                <img src="https://i.pravatar.cc/150?img={{ Auth::user()->id % 10 + 1 }}" alt="User Avatar" class="avatar">
                <div class="info">
                    <p class="name">{{ Auth::user()->nama }}</p>
                    <p class="role">{{ Auth::user()->role == 'admin' ? 'Administrator' : 'Member' }}</p>
                </div>
            </div>

            <nav class="sidebar-nav">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @if(Auth::user()->isAdmin())
                    <li class="nav-item">
                        <a href="{{ route('users') }}" class="nav-link {{ Route::currentRouteName() == 'users' ? 'active' : '' }}">
                            <i class="bi bi-people"></i>
                            <span>Pengguna</span>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('produk.index') }}" class="nav-link {{ ROute::currentRouteName() == 'produk.index' ? 'active' : '' }}">
                            <i class="bi bi-box-seam"></i>
                            <span>Produk</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kategori.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['kategori.index', 'kategori.create', 'kategori.show', 'kategori.edit']) ? 'active' : ''  }}">
                            <i class="bi bi-tags"></i>
                            <span>Kategori</span>
                        </a>
                    </li>
                    {{--  <li class="nav-item has-submenu">
                        <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['produk.index', 'produk.create', 'produk.show', 'produk.edit']) ? 'active' : '' }}">
                            <i class="bi bi-box-seam"></i>
                            <span>Produk</span>
                            <i class="bi bi-chevron-right arrow"></i>
                        </a>
                        <ul class="submenu nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('produk.index') }}" class="nav-link {{ Route::currentRouteName() == 'produk.index' ? 'active' : '' }}">Semua Produk</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('kategori.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['kategori.index', 'kategori.create', 'kategori.show', 'kategori.edit']) ? 'active' : '' }}">Kategori</a>
                            </li>
                        </ul>
                    </li>  --}}
                    <li class="nav-item">
                        <a href="{{ route('toko.index') }}" class="nav-link">
                            <i class="bi bi-shop"></i>
                            <span>Toko</span>
                        </a>
                    </li>



                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-gear"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
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
                <div>
                    <!-- Bisa tambahkan search bar, notifikasi, dll di sini -->
                </div>
            </div>

            @yield('content')

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

            // Toggle untuk sidebar di desktop dan mobile
            toggleSidebarBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                main.classList.toggle('expanded');

                // Untuk mobile, toggle class 'show' untuk menampilkan sidebar
                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('show');
                }
            });

            // Toggle untuk sub-menu
            const submenuToggles = document.querySelectorAll('.has-submenu > .nav-link');
            submenuToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const parentItem = this.parentElement;
                    const submenu = parentItem.querySelector('.submenu');

                    // Tutup submenu lain yang terbuka
                    document.querySelectorAll('.has-submenu').forEach(item => {
                        if (item !== parentItem) {
                            item.classList.remove('show');
                            item.querySelector('.submenu').classList.remove('show');
                        }
                    });

                    // Buka/tutup submenu yang diklik
                    parentItem.classList.toggle('show');
                    submenu.classList.toggle('show');
                });
            });
        });
    </script>
</body>
</html>

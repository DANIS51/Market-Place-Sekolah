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
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- ==================== NAVBAR ==================== -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
            <div class="container">
                <a class="navbar-brand fw-bold" href="#">
                    <i class="bi bi-bag-heart-fill text-primary"></i> SekoolMart
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" type="search" placeholder="Cari buku, seragam, alat tulis..." aria-label="Search">
                                <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="bi bi-person-circle fs-5"></i> Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="#">
                                <i class="bi bi-cart3 fs-5"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <!-- ==================== HERO SECTION ==================== -->
        <section id="hero" class="bg-primary text-white text-center py-5">
            <div class="container p-5">
                <h1 class="display-4 fw-bold">Jual Beli Kebutuhan Sekolah Jadi Lebih Mudah</h1>
                <p class="lead">Temukan segala perlengkapan sekolah dari buku, seragam, hingga alat tulis dengan harga terbaik.</p>
                <a href="#featured-products" class="btn btn-light btn-lg mt-3">Mulai Belanja</a>
            </div>
        </section>

        <!-- ==================== CATEGORIES ==================== -->
        <section id="categories" class="py-5">
            <div class="container">
                <h2 class="text-center mb-4">Kategori Produk</h2>
                <div class="row g-3">
                    <div class="col-6 col-md-3">
                        <div class="card category-card h-100 text-center p-3 shadow-sm">
                            <i class="bi bi-book display-4 text-primary"></i>
                            <div class="card-body">
                                <h5 class="card-title">Buku & Alat Tulis</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card category-card h-100 text-center p-3 shadow-sm">
                            <i class="bi bi-person-arms-up display-4 text-success"></i>
                            <div class="card-body">
                                <h5 class="card-title">Seragam & Atribut</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card category-card h-100 text-center p-3 shadow-sm">
                            <i class="bi bi-trophy display-4 text-warning"></i>
                            <div class="card-body">
                                <h5 class="card-title">Kebutuhan Pramuka</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card category-card h-100 text-center p-3 shadow-sm">
                            <i class="bi bi-music-note-beamed display-4 text-danger"></i>
                            <div class="card-body">
                                <h5 class="card-title">Alat Musik & Olahraga</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== FEATURED PRODUCTS ==================== -->
        <section id="featured-products" class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-4">Produk Unggulan</h2>
                <div class="row g-4">
                    <!-- Produk 1 -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 product-card shadow-sm">
                            <img src="https://via.placeholder.com/300x250?text=Gambar+Produk" class="card-img-top" alt="Produk 1">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Paket Alat Tulis SD</h5>
                                <p class="card-text text-muted flex-grow-1">Lengkap untuk tahun ajaran baru.</p>
                                <p class="price fw-bold">Rp 55.000</p>
                                <a href="#" class="btn btn-primary mt-auto">Tambah ke Keranjang</a>
                            </div>
                        </div>
                    </div>
                    <!-- Produk 2 -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 product-card shadow-sm">
                            <img src="https://via.placeholder.com/300x250?text=Gambar+Produk" class="card-img-top" alt="Produk 2">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Seragam SMP Putra</h5>
                                <p class="card-text text-muted flex-grow-1">Bahan adem dan nyaman dipakai.</p>
                                <p class="price fw-bold">Rp 120.000</p>
                                <a href="#" class="btn btn-primary mt-auto">Tambah ke Keranjang</a>
                            </div>
                        </div>
                    </div>
                    <!-- Produk 3 -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 product-card shadow-sm">
                            <img src="https://placehold.co/300x250/EFEFEFF/333333?text=Gambar+Produk" class="card-img-top" alt="Produk 3">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Buku Pelajaran Matematika Kelas 7</h5>
                                <p class="card-text text-muted flex-grow-1">Edisi revisi terbaru K13.</p>
                                <p class="price fw-bold">Rp 85.000</p>
                                <a href="#" class="btn btn-primary mt-auto">Tambah ke Keranjang</a>
                            </div>
                        </div>
                    </div>
                    <!-- Produk 4 -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 product-card shadow-sm">
                            <img src="https://placehold.co/300x250/EFEFEFF/333333?text=Gambar+Produk" class="card-img-top" alt="Produk 4">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Tas Ransel Anak Karakter</h5>
                                <p class="card-text text-muted flex-grow-1">Motif lucu, kuat, dan tahan air.</p>
                                <p class="price fw-bold">Rp 150.000</p>
                                <a href="#" class="btn btn-primary mt-auto">Tambah ke Keranjang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== HOW IT WORKS ==================== -->
        <section id="how-it-works" class="py-5">
            <div class="container">
                <h2 class="text-center mb-5">Bagaimana Cara Kerjanya?</h2>
                <div class="row text-center g-4">
                    <div class="col-md-4">
                        <i class="bi bi-search display-1 text-primary"></i>
                        <h4 class="mt-3">1. Cari Barang</h4>
                        <p>Gunakan fitur pencarian atau jelajahi kategori untuk menemukan produk yang Anda butuhkan.</p>
                    </div>
                    <div class="col-md-4">
                        <i class="bi bi-credit-card display-1 text-success"></i>
                        <h4 class="mt-3">2. Bayar Aman</h4>
                        <p>Pilih produk dan lakukan pembayaran dengan aman melalui berbagai metode pembayaran.</p>
                    </div>
                    <div class="col-md-4">
                        <i class="bi bi-truck display-1 text-warning"></i>
                        <h4 class="mt-3">3. Barang Dikirim</h4>
                        <p>Penjual akan segera memproses dan mengirimkan barang pesanan Anda.</p>
                    </div>
                </div>
            </div>
        </section>

         <section id="testimonials" class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-4">Apa Kata Mereka?</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <p class="card-text">"Harganya lebih murah dibanding toko lain dan pengirimannya cepat. Sangat membantu untuk persiapan sekolah anak!"</p>
                                <footer class="blockquote-footer mb-0">Ibu Sarah, <cite title="Source Title">Orang Tua Siswa</cite></footer>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <p class="card-text">"Akhirnya ada marketplace khusus kebutuhan sekolah. Jadi gampang cari buku dan alat tulis tanpa harus keliling kota."</p>
                                <footer class="blockquote-footer mb-0">Rizki, <cite title="Source Title">Siswa SMA</cite></footer>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <p class="card-text">"Platform yang bagus untuk para penjual di lingkungan sekolah. Mudah digunakan dan banyak pembelinya."</p>
                                <footer class="blockquote-footer mb-0">Pak Budi, <cite title="Source Title">Penjual</cite></footer>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- ==================== FOOTER ==================== -->
    <footer class="bg-dark text-white pt-5 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5><i class="bi bi-bag-heart-fill"></i> SekoolMart</h5>
                    <p>Marketplace terpercaya untuk memenuhi semua kebutuhan sekolah Anda dengan mudah, cepat, dan aman.</p>
                </div>
                <div class="col-md-2 mb-4">
                    <h6>Layanan</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50">Cara Belanja</a></li>
                        <li><a href="#" class="text-white-50">Cara Jual</a></li>
                        <li><a href="#" class="text-white-50">Pembayaran</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h6>Bantuan</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50">FAQ</a></li>
                        <li><a href="#" class="text-white-50">Hubungi Kami</a></li>
                        <li><a href="#" class="text-white-50">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h6>Ikuti Kami</h6>
                    <a href="#" class="text-white me-3 fs-4"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-3 fs-4"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white fs-4"><i class="bi bi-twitter"></i></a>
                </div>
            </div>
            <hr class="bg-white-50">
            <div class="text-center">
                <p class="mb-0">&copy; 2024 SekoolMart. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

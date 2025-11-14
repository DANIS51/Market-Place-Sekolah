@extends('layout.sidbarMember')
@section('content.member')
<div class="container-fluid mt-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Dashboard Member</h1>
                    <p class="text-muted">Selamat datang kembali, {{ $user->nama }}!</p>
                </div>
                <div class="d-flex align-items-center">
                    <small class="text-muted me-3">{{ now()->format('l, d F Y') }}</small>
                    <i class="bi bi-calendar-event text-primary"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Store Information Card -->
    @if($user->toko)
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-left-primary shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Toko</h6>
                    <a href="{{ route('toko.show', $user->toko->id) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-eye me-1"></i>Lihat Toko
                    </a>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center">
                            @if($user->toko->gambar)
                                <img src="{{ asset($user->toko->gambar) }}" alt="Toko" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                                <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                    <i class="bi bi-shop text-white fa-2x"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-10">
                            <h5 class="card-title">{{ $user->toko->nama_toko }}</h5>
                            <p class="card-text text-muted mb-2">{{ $user->toko->deskripsi ?? 'Belum ada deskripsi' }}</p>
                            <div class="row">
                                <div class="col-sm-3">
                                    <small class="text-muted">Status</small>
                                    <br>
                                    <span class="badge bg-{{ $user->toko->status == 'active' ? 'success' : 'warning' }}">
                                        {{ ucfirst($user->toko->status ?? 'pending') }}
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <small class="text-muted">Bergabung</small>
                                    <br>
                                    <span>{{ $user->toko->created_at->format('d/m/Y') }}</span>
                                </div>
                                <div class="col-sm-3">
                                    <small class="text-muted">Total Produk</small>
                                    <br>
                                    <span class="font-weight-bold">{{ $totalProducts }}</span>
                                </div>
                                <div class="col-sm-3">
                                    <small class="text-muted">Rating</small>
                                    <br>
                                    <span>⭐ 4.5 (120 ulasan)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <!-- My Products -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Produk Saya
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $totalProducts }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-box-seam fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Sales -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Penjualan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp {{ number_format($totalSales, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-cash fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders This Month -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Pesanan Bulan Ini
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $ordersThisMonth }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-receipt fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pesanan Pending
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $pendingOrders }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-clock fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Row -->
    <div class="row">
        <!-- Recent Products -->
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Produk Terbaru</h6>
                    <a href="{{ route('produk.index') }}" class="btn btn-primary btn-sm">Lihat Semua</a>
                </div>
                <div class="card-body">
                    @if($user->toko && $totalProducts > 0)
                        <div class="row">
                            @foreach($user->toko->produks->take(3) as $produk)
                            <div class="col-md-4 mb-3">
                                <div class="card h-100">
                                    @if($produk->gambar_produk->first())
                                        <img src="{{ asset('images/produk/' . $produk->gambar_produk->first()->nama_gambar) }}" class="card-img-top" alt="{{ $produk->nama_produk }}" style="height: 150px; object-fit: cover;">
                                    @else
                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                                            <i class="bi bi-image text-muted fa-2x"></i>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <h6 class="card-title">{{ Str::limit($produk->nama_produk, 30) }}</h6>
                                        <p class="card-text text-primary font-weight-bold">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                        <small class="text-muted">Stok: {{ $produk->stok ?? 'N/A' }}</small>
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-box-seam text-muted fa-3x mb-3"></i>
                            <h5 class="text-muted">Belum ada produk</h5>
                            <p class="text-muted">Mulai tambahkan produk pertama Anda</p>
                            <a href="{{ route('produk.create') }}" class="btn btn-primary">Tambah Produk</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions & Notifications -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <!-- Quick Actions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('produk.create') }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Produk
                        </a>
                        <a href="{{ route('produk.index') }}" class="btn btn-outline-success btn-sm">
                            <i class="bi bi-list me-2"></i>Kelola Produk
                        </a>
                        <a href="{{ route('kategori.index') }}" class="btn btn-outline-info btn-sm">
                            <i class="bi bi-tags me-2"></i>Kelola Kategori
                        </a>
                        <a href="#" class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-graph-up me-2"></i>Lihat Laporan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Notifications -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Notifikasi Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="notification-item mb-3 pb-3 border-bottom">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="bi bi-cart-check text-success"></i>
                            </div>
                            <div>
                                <small class="font-weight-bold">Pesanan Baru</small>
                                <div class="small text-muted">Pesanan #12345 telah dibuat</div>
                                <small class="text-muted">2 jam yang lalu</small>
                            </div>
                        </div>
                    </div>
                    <div class="notification-item mb-3 pb-3 border-bottom">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="bi bi-star text-warning"></i>
                            </div>
                            <div>
                                <small class="font-weight-bold">Ulasan Baru</small>
                                <div class="small text-muted">Produk Anda mendapat ulasan 5 bintang</div>
                                <small class="text-muted">5 jam yang lalu</small>
                            </div>
                        </div>
                    </div>
                    <div class="notification-item">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="bi bi-exclamation-triangle text-danger"></i>
                            </div>
                            <div>
                                <small class="font-weight-bold">Stok Menipis</small>
                                <div class="small text-muted">Produk "Baju Kemeja" stok tersisa 2</div>
                                <small class="text-muted">1 hari yang lalu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Chart Placeholder -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Penjualan Bulanan</h6>
                </div>
                <div class="card-body">
                    <div class="chart-placeholder text-center py-5">
                        <i class="bi bi-bar-chart text-muted fa-4x mb-3"></i>
                        <h5 class="text-muted">Grafik Penjualan</h5>
                        <p class="text-muted">Grafik penjualan bulanan akan ditampilkan di sini</p>
                        <small class="text-muted">Fitur ini akan segera hadir</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}
.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.text-primary {
    color: #5a5c69 !important;
}

.text-gray-800 {
    color: #5a5c69 !important;
}

.font-weight-bold {
    font-weight: 700 !important;
}

.shadow {
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

.chart-placeholder {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-radius: 10px;
}

.notification-item .bi {
    font-size: 1.2rem;
}
</style>

@endsection

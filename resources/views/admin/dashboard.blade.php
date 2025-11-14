@extends('layout.sidbar')
@section('content')
<div class="container-fluid mt-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
                    <p class="text-muted">Selamat datang kembali, {{ Auth::user()->nama }}!</p>
                </div>
                <div class="d-flex align-items-center">
                    <small class="text-muted me-3">{{ now()->format('l, d F Y') }}</small>
                    <i class="bi bi-calendar-event text-primary"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <!-- Total Users -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pengguna
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['totalUsers'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people-fill fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Stores -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Toko
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['totalStores'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-shop fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Produk
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['totalProducts'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-box-seam fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Categories -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Kategori Aktif
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['totalCategories'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-tags fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Row -->
    <div class="row">
        <!-- Recent Activities -->
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Aktivitas Terbaru</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">Lihat Semua</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Pengguna Baru Terdaftar</h6>
                                <p class="timeline-text">5 pengguna baru mendaftar dalam 24 jam terakhir</p>
                                <small class="text-muted">{{ now()->subHours(2)->format('H:i') }}</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Toko Baru Ditambahkan</h6>
                                <p class="timeline-text">3 toko baru telah disetujui dan aktif</p>
                                <small class="text-muted">{{ now()->subHours(4)->format('H:i') }}</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-info"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Produk Baru Diupload</h6>
                                <p class="timeline-text">12 produk baru ditambahkan ke marketplace</p>
                                <small class="text-muted">{{ now()->subHours(6)->format('H:i') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions & System Info -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <!-- Quick Actions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-people me-2"></i>Kelola Pengguna
                        </a>
                        <a href="{{ route('toko.index') }}" class="btn btn-outline-success btn-sm">
                            <i class="bi bi-shop me-2"></i>Kelola Toko
                        </a>
                        <a href="#" class="btn btn-outline-info btn-sm">
                            <i class="bi bi-graph-up me-2"></i>Lihat Laporan
                        </a>
                        <a href="#" class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-gear me-2"></i>Pengaturan Sistem
                        </a>
                    </div>
                </div>
            </div>

            <!-- System Status -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Status Sistem</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                            <i class="bi bi-server text-success fa-2x"></i>
                        </div>
                        <div>
                            <div class="font-weight-bold">Server Status</div>
                            <div class="text-success small">Online</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                            <i class="bi bi-database text-info fa-2x"></i>
                        </div>
                        <div>
                            <div class="font-weight-bold">Database</div>
                            <div class="text-success small">Terhubung</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-shield-check text-warning fa-2x"></i>
                        </div>
                        <div>
                            <div class="font-weight-bold">Keamanan</div>
                            <div class="text-success small">Aktif</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Users Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pengguna Terbaru</h6>
                    <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Tanggal Daftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentUsers as $user)
                                <tr>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        <span class="badge bg-{{ $user->role == 'admin' ? 'primary' : 'secondary' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $user->status == 'active' ? 'success' : 'warning' }}">
                                            {{ ucfirst($user->status ?? 'pending') }}
                                        </span>
                                    </td>
                                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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

.timeline {
    position: relative;
    padding: 20px 0;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 30px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
    padding-left: 60px;
}

.timeline-marker {
    position: absolute;
    left: 20px;
    top: 5px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 0 0 3px #e9ecef;
}

.timeline-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 5px;
    color: #5a5c69;
}

.timeline-text {
    color: #6c757d;
    margin-bottom: 5px;
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}
</style>

@endsection

@extends('layout.navbar')

@section('conten-pengguna')
<div class="container py-4">

    <!-- Judul Halaman -->
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold mb-3">Kategori Produk</h1>
        <p class="lead text-muted">Jelajahi berbagai kategori produk di marketplace sekolah kami</p>
    </div>

    <!-- Grid Kategori -->
    <div class="row g-4">
        @forelse($kategoris as $kategori)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden category-card">

                <!-- Header dengan ikon kategori -->
                <div class="card-header bg-gradient text-white text-center py-4">
                    <div class="category-icon mb-3">
                        <i class="bi bi-tag-fill fs-1"></i>
                    </div>
                    <h5 class="card-title fw-bold mb-1">{{ $kategori->nama_kategori }}</h5>
                </div>

                <!-- Body card -->
                <div class="card-body text-center d-flex flex-column">

                    <!-- Jumlah produk -->
                    <div class="mb-3">
                        <div class="bg-light rounded-pill py-2 px-3 d-inline-block">
                            <span class="fw-bold text-primary">{{ $kategori->produks_count ?? 0 }}</span>
                            <small class="text-muted">Produk</small>
                        </div>
                    </div>

                    <!-- Deskripsi kategori -->
                    <p class="card-text text-muted small mb-4 flex-grow-1">
                        Temukan berbagai produk dalam kategori {{ $kategori->nama_kategori }}
                    </p>

                    <!-- Tombol lihat produk -->
                    <div class="mt-auto">
                        <a href="{{ route('pengguna.kategori.show', Crypt::encrypt($kategori->id)) }}" class="btn btn-primary rounded-pill w-100">
                            <i class="bi bi-eye me-1"></i> Lihat Produk
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @empty
        <!-- Jika tidak ada kategori -->
        <div class="col-12 text-center py-5">
            <i class="bi bi-tags text-muted" style="font-size: 4rem;"></i>
            <h4 class="text-muted mt-3">Belum ada kategori tersedia</h4>
            <p class="text-muted">Kategori akan segera ditambahkan oleh admin.</p>
        </div>
        @endforelse
    </div>
</div>

@push('styles')
<style>
    /* Style card kategori */
    .category-card {
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    /* Gradient background untuk header */
    .bg-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* Icon kategori */
    .category-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }

    /* Style untuk jumlah produk */
    .bg-light {
        background-color: #f8f9fa !important;
    }

    /* Hover effect untuk tombol */
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(13, 110, 253, 0.3);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .category-card {
            margin-bottom: 1rem;
        }

        .category-icon {
            width: 50px;
            height: 50px;
        }

        .category-icon i {
            font-size: 1.5rem;
        }
    }
</style>
@endpush

@endsection

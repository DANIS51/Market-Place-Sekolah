@extends('layout.navbar')

@section('conten-pengguna')

<div class="container py-5">

    <!-- Judul Halaman -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">Kategori Produk</h2>
        <p class="text-muted">Temukan berbagai kategori produk menarik</p>
        <div class="underline mx-auto"></div>
    </div>

    <!-- Grid Kategori -->
    <div class="row g-4 justify-content-center">
        @forelse($kategoris as $kategori)
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
            <div class="card category-card border-0 shadow-sm rounded-4 overflow-hidden">

                <!-- Header Icon -->
                <div class="card-header category-header text-white text-center py-4">
                    <div class="category-icon mb-3">
                        <i class="bi bi-tag-fill fs-1"></i>
                    </div>
                    <h5 class="card-title fw-bold mb-0">{{ $kategori->nama_kategori }}</h5>
                </div>

                <!-- Body -->
                <div class="card-body text-center d-flex flex-column">

                    <!-- Jumlah Produk -->
                    <div class="mb-3">
                        <div class="info-chip d-inline-block px-3 py-2">
                            <span class="fw-bold">{{ $kategori->produks_count ?? 0 }}</span>
                            <small class="text-muted"> Produk</small>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <p class="text-muted small mb-4 flex-grow-1">
                        Jelajahi produk dalam kategori {{ $kategori->nama_kategori }}.
                    </p>

                    <!-- Button -->
                    <a href="{{ route('pengguna.kategori.show', Crypt::encrypt($kategori->id)) }}"
                        class="btn btn-primary rounded-pill w-100 py-2 btn-hover">
                        <i class="bi bi-eye me-1"></i> Lihat Produk
                    </a>
                </div>
            </div>
        </div>
        @empty

        <!-- Jika Kosong -->
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

    /* Garis kecil di bawah judul */
    .underline {
        width: 60px;
        height: 4px;
        border-radius: 10px;
        background: #0d6efd;
        margin-top: 5px;
    }

    /* CARD STYLE */
    .category-card {
        transition: all 0.3s ease;
        background: #ffffff;
        border-radius: 20px !important;
    }

    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 26px rgba(0, 0, 0, 0.12);
    }

    /* HEADER GRADIENT */
    .category-header {
        background: linear-gradient(135deg, #4e73df 0%, #6f42c1 100%);
    }

    /* ICON CATEGORY */
    .category-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.18);
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
        backdrop-filter: blur(6px);
    }

    /* INFO CHIP */
    .info-chip {
        background: #f1f3f5;
        border-radius: 30px;
        font-size: 15px;
    }

    /* HOVER BUTTON */
    .btn-hover {
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .btn-hover:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 14px rgba(13, 110, 253, 0.3);
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .category-icon {
            width: 55px;
            height: 55px;
        }

        .category-icon i {
            font-size: 1.4rem;
        }
    }

</style>
@endpush

@endsection

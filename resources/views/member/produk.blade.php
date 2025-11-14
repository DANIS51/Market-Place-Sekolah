@extends('layout.sidbarMember')

@section('content.member')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- Card utama -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <!-- Header -->
                <div class="card-header bg-white border-0 border-bottom py-3 rounded-top-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-semibold text-dark">
                            <i class="bi bi-box-seam me-2 text-muted"></i> Daftar Produk
                        </h5>
                        <a href="{{ route('produk.create') }}" class="btn btn-success btn-sm fw-semibold shadow-sm px-3">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Produk
                        </a>
                    </div>
                </div>

                <!-- Body -->
                <div class="card-body bg-light">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center rounded-3 shadow-sm" role="alert">
                            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                            <div>{{ session('success') }}</div>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Filter -->
                    <form action="{{ route('produk.index') }}" method="GET" class="row g-3 mb-4">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                                <input type="text" name="search" class="form-control border-start-0" placeholder="Cari produk..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="kategori" class="form-select">
                                <option value="">Semua Kategori</option>
                                <!-- Loop kategori -->
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="toko" class="form-select">
                                <option value="">Semua Toko</option>
                                <!-- Loop toko -->
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-secondary w-100"><i class="bi bi-funnel"></i></button>
                        </div>
                    </form>

                    <!-- Tabel -->
                    <div class="table-responsive rounded-3 overflow-hidden shadow-sm">
                        <table class="table align-middle mb-0">
                            <thead class="table-header text-secondary">
                                <tr>
                                    <th class="text-center py-3" style="width: 60px;">No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Kategori</th>
                                    <th>Toko</th>
                                    <th>Gambar</th>
                                    <th>Tanggal Upload</th>
                                    <th class="text-center" style="width: 180px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @forelse ($produks as $produk)
                                <tr class="table-row-hover">
                                    <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                                    <td class="fw-medium">{{ $produk->nama_produk }}</td>
                                    <td class="text-success fw-bold">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark">{{ $produk->kategori->nama_kategori ?? '-' }}</span>
                                    </td>
                                    <td>{{ $produk->toko->nama_toko ?? '-' }}</td>
                                    <td>
                                        @if($produk->gambar_produk && $produk->gambar_produk->count() > 0)
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('storage/images/produk/' . $produk->gambar_produk->first()->nama_gambar) }}" alt="Gambar Produk" class="rounded border me-2 product-img" style="width: 40px; height: 40px; object-fit: cover;">
                                                <small class="text-muted">{{ $produk->gambar_produk->count() }} gambar</small>
                                            </div>
                                        @else
                                            <small class="text-muted text-secondary">
                                                <i class="bi bi-image"></i> Tidak ada gambar
                                            </small>
                                        @endif
                                    </td>
                                    <td class="text-muted">{{ \Carbon\Carbon::parse($produk->tanggal_upload)->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('produk.show', $produk->id) }}" class="btn btn-icon btn-view" title="Lihat Produk">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-icon btn-edit" title="Edit Produk">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-icon btn-delete" title="Hapus Produk">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                        <h6 class="fw-semibold mb-0">Belum ada produk</h6>
                                        <small>Tambahkan produk pertama Anda.</small>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .table-header {
        background: rgba(245, 245, 245, 0.8);
        backdrop-filter: blur(4px);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e6e6e6;
    }

    .table-row-hover {
        transition: all 0.2s ease;
    }

    .table-row-hover:hover {
        background-color: #f9f9f9 !important;
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .table td, .table th {
        padding: 1rem;
        vertical-align: middle;
        border-color: #f0f0f0 !important;
    }

    .fw-medium {
        font-weight: 500;
    }

    .card {
        background-color: #ffffff;
    }

    .product-img {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .product-img:hover {
        transform: scale(1.05);
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    /* Tombol aksi */
    .btn-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        transition: all 0.2s ease;
        border: none;
    }

    .btn-icon:hover {
        transform: translateY(-2px);
        box-shadow: 0 3px 8px rgba(0,0,0,0.12);
    }

    .btn-view {
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
    }

    .btn-view:hover {
        background-color: #0d6efd;
        color: white;
    }

    .btn-edit {
        background-color: rgba(255, 193, 7, 0.15);
        color: #ffc107;
    }

    .btn-edit:hover {
        background-color: #ffc107;
        color: white;
    }

    .btn-delete {
        background-color: rgba(220, 53, 69, 0.15);
        color: #dc3545;
    }

    .btn-delete:hover {
        background-color: #dc3545;
        color: white;
    }

    /* Badge styling */
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
        font-size: 0.75rem;
    }

    /* Animasi untuk notifikasi */
    .alert {
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Efek hover pada input dan select */
    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
    }

    /* Styling untuk card header */
    .card-header {
        background: linear-gradient(to right, #ffffff, #f8f9fa);
    }

    /* Efek hover pada tombol tambah produk */
    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(25, 135, 84, 0.2);
    }

    /* Animasi untuk gambar produk */
    .product-img {
        position: relative;
    }

    .product-img::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.05);
        border-radius: 0.375rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .product-img:hover::after {
        opacity: 1;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.875rem;
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            font-size: 13px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animasi untuk tabel saat hover
        const tableRows = document.querySelectorAll('.table-row-hover');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transition = 'all 0.2s ease';
            });
        });

        // Animasi untuk tombol aksi
        const actionButtons = document.querySelectorAll('.btn-icon');
        actionButtons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });

            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Preview gambar saat diklik
        const productImages = document.querySelectorAll('.product-img');
        productImages.forEach(img => {
            img.addEventListener('click', function() {
                const src = this.getAttribute('src');
                // Membuat modal preview sederhana
                const modal = document.createElement('div');
                modal.className = 'modal fade show';
                modal.style.display = 'block';
                modal.style.backgroundColor = 'rgba(0,0,0,0.5)';
                modal.innerHTML = `
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Preview Gambar</h5>
                                <button type="button" class="btn-close" onclick="this.closest('.modal').remove()"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="${src}" class="img-fluid rounded" alt="Preview">
                            </div>
                        </div>
                    </div>
                `;
                document.body.appendChild(modal);

                // Tutup modal saat klik di luar
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        modal.remove();
                    }
                });
            });
        });

        // Animasi untuk form filter
        const filterForm = document.querySelector('form');
        if (filterForm) {
            filterForm.style.transition = 'all 0.3s ease';
        }

        // Menambahkan efek loading saat submit form
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function() {
                const submitButton = this.querySelector('button[type="submit"]');
                if (submitButton && !submitButton.classList.contains('btn-icon')) {
                    submitButton.disabled = true;
                    submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...';
                }
            });
        });

        // Animasi untuk card saat load
        const card = document.querySelector('.card');
        if (card) {
            card.style.animation = 'fadeIn 0.5s ease-out';
        }

        // Menambahkan animasi fadeIn
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
        `;
        document.head.appendChild(style);
    });
</script>
@endpush
@endsection

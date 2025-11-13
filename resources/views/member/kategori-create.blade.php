@extends('layout.sidbarMember')

@section('content.member')
<div class="container-fluid py-5" style="background: #f7f8fa; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden animate-fade">
                <!-- Header -->
                <div class="card-header bg-white border-0 py-4 px-4 d-flex align-items-center">
                    <div class="rounded-circle bg-gradient d-flex align-items-center justify-content-center me-3" style="width:45px; height:45px;">
                        <i class="bi bi-tags text-white fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-semibold mb-0">Tambah Kategori</h5>
                        <small class="text-muted">Buat kategori baru untuk produkmu</small>
                    </div>
                </div>

                <!-- Body -->
                <div class="card-body p-4">
                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf

                        <!-- Nama Kategori -->
                        <div class="mb-4">
                            <label for="nama_kategori" class="form-label fw-medium mb-1">Nama Kategori</label>
                            <input type="text"
                                class="form-control form-control-lg @error('nama_kategori') is-invalid @enderror"
                                id="nama_kategori"
                                name="nama_kategori"
                                value="{{ old('nama_kategori') }}"
                                placeholder="Contoh: Elektronik, Fashion, Makanan"
                                required>
                            @error('nama_kategori')
                                <div class="text-danger small mt-1">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                            <div class="d-flex justify-content-between mt-1">
                                <small class="text-muted">Minimal 3 karakter</small>
                                <small class="text-muted" id="charCounter">0 / 50</small>
                            </div>
                        </div>

                        <!-- Pilih Ikon -->
                     

                        <!-- Preview -->
                        <div class="mb-4">
                            <label class="form-label fw-medium mb-2">Preview</label>
                            <div class="preview-box p-3 d-flex align-items-center justify-content-between rounded-3 border">
                                <div class="d-flex align-items-center">
                                    <div class="preview-icon rounded-circle d-flex align-items-center justify-content-center me-3">
                                        <i class="bi bi-tag fs-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-semibold" id="previewName">Nama Kategori</h6>
                                        <small class="text-muted">Kategori produk</small>
                                    </div>
                                </div>
                                <span class="badge bg-soft-primary text-primary">0 Produk</span>
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('kategori.index') }}" class="btn btn-light px-4">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-check2-circle me-1"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Efek animasi lembut */
    .animate-fade {
        animation: fadeInUp 0.6s ease;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Warna gradien minimal */
    .bg-gradient {
        background: linear-gradient(135deg, #667eea, #5a67d8);
    }

    /* Input */
    .form-control {
        border-radius: 12px;
        border: 1.5px solid #e2e8f0;
        padding: 12px 15px;
        transition: all 0.2s ease;
        font-size: 0.95rem;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
    }

    /* Tombol */
    .btn {
        border-radius: 10px;
        transition: 0.3s ease;
        font-weight: 500;
    }

    .btn-primary {
        background: #667eea;
        border: none;
    }

    .btn-primary:hover {
        background: #5a67d8;
        transform: translateY(-2px);
    }

    .btn-light {
        background: #f8f9fa;
        border: 1px solid #e2e8f0;
    }

    .btn-light:hover {
        background: #edf2f7;
    }

    /* Icon selector */
    .icon-btn {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        border: 1.5px solid #e2e8f0;
        background-color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        font-size: 1.2rem;
        transition: all 0.25s ease;
    }

    .icon-btn:hover {
        color: #667eea;
        border-color: #667eea;
        background-color: #f8faff;
    }

    .icon-btn.active {
        background-color: #667eea;
        color: white;
        border-color: transparent;
    }

    /* Preview box */
    .preview-box {
        background: #fff;
        border: 1.5px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .preview-box:hover {
        border-color: #667eea;
        box-shadow: 0 3px 10px rgba(102,126,234,0.1);
    }

    .preview-icon {
        width: 42px;
        height: 42px;
        background: #667eea;
        color: white;
    }

    .badge.bg-soft-primary {
        background: rgba(102,126,234,0.1);
    }

    /* Typography */
    h5, h6 {
        letter-spacing: 0.2px;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const namaInput = document.getElementById('nama_kategori');
    const previewName = document.getElementById('previewName');
    const charCounter = document.getElementById('charCounter');
    const previewIcon = document.querySelector('.preview-icon i');
    let selectedIcon = 'bi-tag';

    // Icon selection
    document.querySelectorAll('.icon-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.icon-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            selectedIcon = this.dataset.icon;
            previewIcon.className = `bi ${selectedIcon} fs-5`;
        });
    });

    // Input kategori
    namaInput.addEventListener('input', function() {
        const val = this.value.trim();
        previewName.textContent = val || 'Nama Kategori';
        charCounter.textContent = `${this.value.length} / 50`;
        charCounter.classList.toggle('text-warning', this.value.length > 40);
    });

    namaInput.maxLength = 50;
});
</script>
@endpush
@endsection

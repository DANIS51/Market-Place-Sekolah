@extends('layout.sidbar')
@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <!-- Premium Card dengan animasi -->
            <div class="card border-0 shadow-xl rounded-4 overflow-hidden">
                <!-- Header dengan glassmorphism effect -->
                <div class="card-header bg-gradient text-white border-0 py-4 position-relative overflow-hidden">
                    <div class="position-absolute top-0 end-0 w-100 h-100 opacity-10">
                        <div class="position-absolute top-0 end-0 w-50 h-50 bg-white rounded-circle" style="transform: translate(30%, -30%);"></div>
                        <div class="position-absolute bottom-0 start-0 w-75 h-75 bg-white rounded-circle" style="transform: translate(-40%, 40%);"></div>
                    </div>
                    <div class="position-relative">
                        <div class="d-flex align-items-center">
                            <div class="bg-white bg-opacity-20 rounded-circle p-3 me-3 backdrop-blur-sm">
                                <i class="bi bi-person-plus-fill fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold">Buat Pengguna Baru</h5>
                                <p class="mb-0 opacity-75 small">Tambahkan anggota baru ke dalam sistem</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Body dengan desain premium -->
                <div class="card-body bg-white p-0">
                    <!-- Progress Steps -->
                    <div class="bg-light px-4 py-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="step-item active">
                                <div class="d-flex align-items-center">
                                    <div class="step-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2">1</div>
                                    <span class="fw-medium">Informasi Dasar</span>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="d-flex align-items-center">
                                    <div class="step-number bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-2">2</div>
                                    <span class="fw-medium">Detail Akun</span>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="d-flex align-items-center">
                                    <div class="step-number bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-2">3</div>
                                    <span class="fw-medium">Konfirmasi</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('users.store') }}" method="POST" class="p-4">
                        @csrf

                        <!-- Step 1: Informasi Dasar -->
                        <div class="form-section mb-4">
                            <div class="section-header mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="bi bi-person-badge text-primary fs-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark">Informasi Pribadi</h6>
                                        <small class="text-muted">Masukkan data identitas pengguna</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nama" class="form-label fw-semibold">
                                        Nama Lengkap <span class="text-danger">*</span>
                                    </label>
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" placeholder="John Doe" required>
                                        <label for="nama">Masukkan nama lengkap</label>
                                      
                                    </div>
                                    @error('nama')
                                        <div class="error-message mt-2">
                                            <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="kontak" class="form-label fw-semibold">
                                        Nomor Telepon <span class="text-danger">*</span>
                                    </label>
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('kontak') is-invalid @enderror" id="kontak" name="kontak" value="{{ old('kontak') }}" placeholder="+62 812-3456-7890" required>
                                        <label for="kontak">Masukkan nomor telepon</label>

                                    </div>
                                    @error('kontak')
                                        <div class="error-message mt-2">
                                            <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Informasi Akun -->
                        <div class="form-section mb-4">
                            <div class="section-header mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="bi bi-shield-lock text-success fs-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark">Informasi Akun</h6>
                                        <small class="text-muted">Atur kredensial login pengguna</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="username" class="form-label fw-semibold">
                                        Username <span class="text-danger">*</span>
                                    </label>
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" placeholder="johndoe" required>
                                        <label for="username">Pilih username unik</label>

                                    </div>
                                    @error('username')
                                        <div class="error-message mt-2">
                                            <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="password" class="form-label fw-semibold">
                                        Password <span class="text-danger">*</span>
                                    </label>
                                    <div class="form-floating">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="••••••••" required>
                                        <label for="password">Buat password aman</label>

                                    </div>
                                    @error('password')
                                        <div class="error-message mt-2">
                                            <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Role Selection -->
                        <div class="form-section mb-4">
                            <div class="section-header mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="bi bi-gear text-warning fs-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark">Hak Akses</h6>
                                        <small class="text-muted">Tentukan peran pengguna dalam sistem</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="role" class="form-label fw-semibold">
                                        Role Pengguna <span class="text-danger">*</span>
                                    </label>
                                    <div class="role-selection">
                                        <div class="form-check form-check-card p-3 border rounded-3 @error('role') is-invalid @enderror" onclick="selectRole('admin')">
                                            <input class="form-check-input" type="radio" name="role" id="role-admin" value="admin" {{ old('role') == 'admin' ? 'checked' : '' }} required>
                                            <label class="form-check-label w-100" for="role-admin">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-dark bg-opacity-10 rounded-circle p-2 me-3">
                                                        <i class="bi bi-shield-lock text-dark"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold">Administrator</div>
                                                        <small class="text-muted">Akses penuh ke sistem</small>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-card p-3 border rounded-3 mt-2 @error('role') is-invalid @enderror" onclick="selectRole('member')">
                                            <input class="form-check-input" type="radio" name="role" id="role-member" value="member" {{ old('role') == 'member' ? 'checked' : '' }} required>
                                            <label class="form-check-label w-100" for="role-member">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-secondary bg-opacity-10 rounded-circle p-2 me-3">
                                                        <i class="bi bi-person text-secondary"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold">Member</div>
                                                        <small class="text-muted">Akses terbatas ke sistem</small>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    @error('role')
                                        <div class="error-message mt-2">
                                            <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top">
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary rounded-3 px-4 py-2">
                                <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar
                            </a>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-light rounded-3 px-4 py-2">
                                    <i class="bi bi-x-circle me-2"></i> Batal
                                </button>
                                <button type="submit" class="btn btn-primary rounded-3 px-4 py-2">
                                    <i class="bi bi-check-circle me-2"></i> Simpan Pengguna
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Gradien untuk header */
    .bg-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* Card premium styling */
    .card {
        background-color: #ffffff;
        transition: all 0.3s ease;
        border: none;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
    }

    /* Progress Steps */
    .step-item {
        flex: 1;
        position: relative;
    }

    .step-item:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 50%;
        right: -50%;
        width: 100%;
        height: 2px;
        background: #e2e8f0;
        z-index: -1;
    }

    .step-item.active:not(:last-child)::after {
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    }

    .step-number {
        width: 30px;
        height: 30px;
        font-size: 0.875rem;
        font-weight: 600;
    }

    /* Form Floating dengan ikon */
    .form-floating {
        position: relative;
    }

    .form-floating .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 1rem 3rem 1rem 1rem;
        height: auto;
        transition: all 0.3s ease;
    }

    .form-floating .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.1);
    }

    .form-floating label {
        padding: 1rem;
        color: #64748b;
    }

    .input-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 1.125rem;
        pointer-events: none;
    }

    .password-toggle {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        z-index: 10;
    }

    .password-toggle:hover {
        color: #667eea;
    }

    /* Role Selection Cards */
    .form-check-card {
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid #e2e8f0 !important;
        background: #ffffff;
    }

    .form-check-card:hover {
        border-color: #667eea !important;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .form-check-card.selected {
        border-color: #667eea !important;
        background: rgba(102, 126, 234, 0.05);
    }

    .form-check-input {
        display: none;
    }

    .form-check-input:checked + .form-check-label {
        color: #667eea;
    }

    /* Section Headers */
    .section-header {
        position: relative;
    }

    /* Error Messages */
    .error-message {
        color: #ef4444;
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Buttons */
    .btn {
        border-radius: 12px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .btn:hover::before {
        left: 100%;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-outline-secondary {
        border: 2px solid #e2e8f0;
        color: #64748b;
        background: #ffffff;
    }

    .btn-outline-secondary:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        transform: translateY(-2px);
    }

    .btn-light {
        background: #f8fafc;
        color: #64748b;
    }

    .btn-light:hover {
        background: #e2e8f0;
        transform: translateY(-2px);
    }

    /* Form Labels */
    .form-label {
        color: #334155;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .step-item span {
            display: none;
        }

        .step-number {
            margin: 0 auto;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                const icon = this.querySelector('i');
                icon.classList.toggle('bi-eye');
                icon.classList.toggle('bi-eye-slash');
            });
        }

        // Form validation animations
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() !== '') {
                    this.classList.add('is-valid');
                }
            });

            input.addEventListener('focus', function() {
                this.classList.remove('is-valid');
            });
        });
    });

    // Role selection function
    function selectRole(role) {
        // Remove selected class from all cards
        document.querySelectorAll('.form-check-card').forEach(card => {
            card.classList.remove('selected');
        });

        // Add selected class to clicked card
        event.currentTarget.classList.add('selected');

        // Check the radio button
        document.getElementById('role-' + role).checked = true;
    }
</script>
@endpush
@endsection

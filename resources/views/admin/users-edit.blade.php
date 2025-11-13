@extends('layout.sidbar')
@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <!-- Premium Card dengan glassmorphism -->
            <div class="card border-0 shadow-xl rounded-4 overflow-hidden position-relative" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                <!-- Animated Background -->
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #f5576c); background-size: 400% 400%; animation: gradientShift 15s ease infinite; opacity: 0.05;"></div>

                <!-- Header dengan gradien -->
                <div class="card-header text-white border-0 py-4 position-relative overflow-hidden" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="position-absolute top-0 end-0 w-100 h-100">
                        <div class="floating-shape" style="position: absolute; border-radius: 50%; background: rgba(255, 255, 255, 0.1); animation: float 20s infinite ease-in-out; width: 100px; height: 100px; top: 20%; right: 10%; animation-delay: 0s;"></div>
                        <div class="floating-shape" style="position: absolute; border-radius: 50%; background: rgba(255, 255, 255, 0.1); animation: float 20s infinite ease-in-out; width: 60px; height: 60px; bottom: 30%; left: 15%; animation-delay: 5s;"></div>
                    </div>
                    <div class="position-relative">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="bg-white bg-opacity-20 rounded-circle p-3 me-3" style="backdrop-filter: blur(5px);">
                                    <i class="bi bi-pencil-square fs-4"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1 fw-bold">Edit Pengguna</h4>
                                    <p class="mb-0 opacity-75 small">Perbarui informasi pengguna</p>
                                </div>
                            </div>
                            <a href="{{ route('users.index') }}" class="btn btn-light btn-sm rounded-3 px-3">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Body dengan desain premium -->
                <div class="card-body bg-white p-0 position-relative">
                    <!-- User Profile Preview -->
                    <div class="bg-light px-5 py-4 border-bottom">
                        <div class="d-flex align-items-center">
                            <div class="position-relative me-4">
                                <div class="avatar-preview bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; transition: all 0.3s ease;">
                                    <span class="fw-bold fs-3 text-primary">{{ substr($user->nama, 0, 1) }}</span>
                                </div>
                                <div class="position-absolute bottom-0 end-0 bg-success rounded-circle" style="width: 20px; height: 20px; border: 3px solid white;"></div>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold">{{ $user->nama }}</h5>
                                <p class="mb-1 text-muted">@{{ $user->username }}</p>
                                <div class="d-flex align-items-center">
                                    <span class="badge rounded-pill bg-dark text-light px-3 py-2 me-2">
                                        <i class="bi bi-shield-lock me-1"></i> {{ $user->role == 'admin' ? 'Administrator' : 'Member' }}
                                    </span>
                                    <span class="text-muted small">
                                        <i class="bi bi-telephone me-1"></i> {{ $user->kontak }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form id="editUserForm" action="{{ route('users.update', $user) }}" method="POST" class="p-5">
                        @csrf
                        @method('PUT')

                        <!-- Informasi Pribadi -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="bi bi-person-badge text-primary fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">Informasi Pribadi</h6>
                                    <small class="text-muted">Perbarui data identitas pengguna</small>
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label d-flex align-items-center fw-semibold">
                                            <i class="bi bi-person me-2"></i>Nama Lengkap
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                   id="nama" name="nama" value="{{ old('nama', $user->nama) }}"
                                                   placeholder="Contoh: John Doe" required
                                                   style="padding: 0.875rem 1rem; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 1rem; transition: all 0.3s ease;">
                                            <div style="position: absolute; bottom: 0; left: 0; width: 0; height: 2px; background: linear-gradient(90deg, #667eea, #764ba2); transition: width 0.3s ease;"></div>
                                        </div>
                                        @error('nama')
                                            <div class="text-danger mt-2" style="font-size: 0.875rem; display: flex; align-items: center;">
                                                <i class="bi bi-exclamation-circle me-2"></i>
                                                <span>{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="kontak" class="form-label d-flex align-items-center fw-semibold">
                                            <i class="bi bi-telephone me-2"></i>Nomor Telepon
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control @error('kontak') is-invalid @enderror"
                                                   id="kontak" name="kontak" value="{{ old('kontak', $user->kontak) }}"
                                                   placeholder="Contoh: +62 812-3456-7890" required
                                                   style="padding: 0.875rem 1rem; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 1rem; transition: all 0.3s ease;">
                                            <div style="position: absolute; bottom: 0; left: 0; width: 0; height: 2px; background: linear-gradient(90deg, #667eea, #764ba2); transition: width 0.3s ease;"></div>
                                        </div>
                                        @error('kontak')
                                            <div class="text-danger mt-2" style="font-size: 0.875rem; display: flex; align-items: center;">
                                                <i class="bi bi-exclamation-circle me-2"></i>
                                                <span>{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Akun -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="bi bi-shield-lock text-success fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">Informasi Akun</h6>
                                    <small class="text-muted">Perbarui kredensial login pengguna</small>
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="username" class="form-label d-flex align-items-center fw-semibold">
                                            <i class="bi bi-at me-2"></i>Username
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                                   id="username" name="username" value="{{ old('username', $user->username) }}"
                                                   placeholder="Contoh: johndoe" required
                                                   style="padding: 0.875rem 1rem; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 1rem; transition: all 0.3s ease;">
                                            <div style="position: absolute; bottom: 0; left: 0; width: 0; height: 2px; background: linear-gradient(90deg, #667eea, #764ba2); transition: width 0.3s ease;"></div>
                                        </div>
                                        @error('username')
                                            <div class="text-danger mt-2" style="font-size: 0.875rem; display: flex; align-items: center;">
                                                <i class="bi bi-exclamation-circle me-2"></i>
                                                <span>{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label d-flex align-items-center fw-semibold">
                                            <i class="bi bi-lock me-2"></i>Password
                                            <small class="text-muted">(Kosongkan jika tidak diubah)</small>
                                        </label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                   id="password" name="password" placeholder="Masukkan password baru"
                                                   style="padding: 0.875rem 3rem 0.875rem 1rem; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 1rem; transition: all 0.3s ease;">
                                            <div style="position: absolute; bottom: 0; left: 0; width: 0; height: 2px; background: linear-gradient(90deg, #667eea, #764ba2); transition: width 0.3s ease;"></div>
                                            <button type="button" id="togglePassword" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #94a3b8; cursor: pointer; z-index: 10;">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        <div class="mt-2" id="passwordStrengthContainer" style="display: none;">
                                            <div style="width: 100%; height: 4px; background: #e2e8f0; border-radius: 2px; overflow: hidden;">
                                                <div class="strength-fill" style="height: 100%; width: 0; transition: all 0.3s ease; border-radius: 2px;"></div>
                                            </div>
                                            <small class="text-muted">Kekuatan password: <span id="strengthText">-</span></small>
                                        </div>
                                        @error('password')
                                            <div class="text-danger mt-2" style="font-size: 0.875rem; display: flex; align-items: center;">
                                                <i class="bi bi-exclamation-circle me-2"></i>
                                                <span>{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Role Selection -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="bi bi-gear text-warning fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">Hak Akses</h6>
                                    <small class="text-muted">Tentukan peran pengguna dalam sistem</small>
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="role-card position-relative" style="border: 2px solid #e2e8f0; border-radius: 16px; padding: 1.5rem; cursor: pointer; transition: all 0.3s ease; background: #ffffff;" onclick="selectRole(event, 'admin')">
                                        <input type="radio" name="role" id="role-admin" value="admin"
                                               {{ old('role', $user->role) == 'admin' ? 'checked' : '' }} required>
                                        <label for="role-admin" class="d-flex align-items-start cursor-pointer" style="margin: 0;">
                                            <div class="bg-dark bg-opacity-10 rounded-circle p-3 me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-shield-lock text-dark" style="font-size: 1.5rem;"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-1">Administrator</h5>
                                                <p class="mb-0 text-muted">Akses penuh ke sistem</p>
                                                <div class="d-flex flex-wrap gap-1 mt-2">
                                                    <span class="badge bg-light text-dark" style="font-size: 0.75rem;">Kelola Pengguna</span>
                                                    <span class="badge bg-light text-dark" style="font-size: 0.75rem;">Laporan Lengkap</span>
                                                    <span class="badge bg-light text-dark" style="font-size: 0.75rem;">Pengaturan Sistem</span>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="role-card position-relative" style="border: 2px solid #e2e8f0; border-radius: 16px; padding: 1.5rem; cursor: pointer; transition: all 0.3s ease; background: #ffffff;" onclick="selectRole(event, 'member')">
                                        <input type="radio" name="role" id="role-member" value="member"
                                               {{ old('role', $user->role) == 'member' ? 'checked' : '' }} required>
                                        <label for="role-member" class="d-flex align-items-start cursor-pointer" style="margin: 0;">
                                            <div class="bg-secondary bg-opacity-10 rounded-circle p-3 me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-person text-secondary" style="font-size: 1.5rem;"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-1">Member</h5>
                                                <p class="mb-0 text-muted">Akses terbatas ke sistem</p>
                                                <div class="d-flex flex-wrap gap-1 mt-2">
                                                    <span class="badge bg-light text-dark" style="font-size: 0.75rem;">Lihat Data</span>
                                                    <span class="badge bg-light text-dark" style="font-size: 0.75rem;">Edit Profil</span>
                                                    <span class="badge bg-light text-dark" style="font-size: 0.75rem;">Laporan Dasar</span>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            @error('role')
                                <div class="text-danger mt-2" style="font-size: 0.875rem; display: flex; align-items: center;">
                                    <i class="bi bi-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top">
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 12px; font-weight: 500;">
                                <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar
                            </a>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-light px-4 py-2" style="border-radius: 12px; font-weight: 500;" onclick="window.history.back()">
                                    <i class="bi bi-x-circle me-2"></i> Batal
                                </button>
                                <button type="submit" class="btn btn-primary px-4 py-2" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 12px; font-weight: 500;">
                                    <i class="bi bi-check-circle me-2"></i> Update Pengguna
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Keyframes */
@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
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

/* Form Controls */
.form-control:focus {
    border-color: #667eea !important;
    box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.1) !important;
    outline: none;
}

.form-control:focus + div {
    width: 100% !important;
}

/* Role Cards */
.role-card:hover {
    border-color: #667eea !important;
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.1) !important;
    transform: translateY(-3px) !important;
}

.role-card.selected {
    border-color: #667eea !important;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%) !important;
}

/* Buttons */
.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

/* Password Strength */
.strength-weak { background: #ef4444 !important; width: 33% !important; }
.strength-medium { background: #f59e0b !important; width: 66% !important; }
.strength-strong { background: #10b981 !important; width: 100% !important; }

/* Avatar Hover */
.avatar-preview:hover {
    transform: scale(1.05);
}

/* Error Animation */
.text-danger {
    animation: slideDown 0.3s ease;
}

/* Hide radio buttons */
.role-card input[type="radio"] {
    display: none;
}

/* Responsive */
@media (max-width: 768px) {
    .role-card .badge {
        display: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const passwordStrengthContainer = document.getElementById('passwordStrengthContainer');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            const icon = this.querySelector('i');
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        });

        // Show/hide password strength based on input
        passwordInput.addEventListener('input', function() {
            if (this.value.length > 0) {
                passwordStrengthContainer.style.display = 'block';
                checkPasswordStrength(this.value);
            } else {
                passwordStrengthContainer.style.display = 'none';
            }
        });
    }

    // Password strength checker
    function checkPasswordStrength(password) {
        const strengthFill = document.querySelector('.strength-fill');
        const strengthText = document.getElementById('strengthText');

        let strength = 0;
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;

        strengthFill.className = 'strength-fill';
        if (strength <= 1) {
            strengthFill.classList.add('strength-weak');
            strengthText.textContent = 'Lemah';
        } else if (strength === 2) {
            strengthFill.classList.add('strength-medium');
            strengthText.textContent = 'Sedang';
        } else {
            strengthFill.classList.add('strength-strong');
            strengthText.textContent = 'Kuat';
        }
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

    // Set initial selected role
    const selectedRole = '{{ old('role', $user->role) }}';
    if (selectedRole) {
        const selectedCard = document.querySelector(`#role-${selectedRole}`).closest('.role-card');
        if (selectedCard) {
            selectedCard.classList.add('selected');
        }
    }
});

// Role selection function
function selectRole(event, role) {
    // Remove selected class from all cards
    document.querySelectorAll('.role-card').forEach(card => {
        card.classList.remove('selected');
    });

    // Add selected class to clicked card
    event.currentTarget.classList.add('selected');

    // Check radio button
    document.getElementById('role-' + role).checked = true;
}
</script>
@endsection

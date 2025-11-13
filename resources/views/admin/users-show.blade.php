@extends('layout.sidbar')
@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <!-- Premium Card dengan glassmorphism -->
            <div class="card border-0 shadow-xl rounded-4 overflow-hidden position-relative">
                <!-- Animated Background -->
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-animated opacity-5"></div>

                <!-- Header dengan gradien -->
                <div class="card-header bg-gradient-premium text-white border-0 py-4 position-relative overflow-hidden">
                    <div class="position-absolute top-0 end-0 w-100 h-100">
                        <div class="floating-shape shape-1"></div>
                        <div class="floating-shape shape-2"></div>
                    </div>
                    <div class="position-relative">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="bg-white bg-opacity-20 rounded-circle p-3 me-3 backdrop-blur-sm">
                                    <i class="bi bi-person-lines-fill fs-4"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1 fw-bold">Detail Pengguna</h4>
                                    <p class="mb-0 opacity-75 small">Informasi lengkap pengguna sistem</p>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-light btn-sm rounded-3 px-3" title="Edit Pengguna">
                                    <i class="bi bi-pencil me-1"></i> Edit
                                </a>
                                <a href="{{ route('users.index') }}" class="btn btn-outline-light btn-sm rounded-3 px-3" title="Kembali">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Body dengan desain premium -->
                <div class="card-body bg-white p-0 position-relative">
                    <!-- User Profile Section -->
                    <div class="profile-section bg-light px-5 py-4 border-bottom">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center mb-4 mb-md-0">
                                <div class="position-relative d-inline-block">
                                    <div class="avatar-container">
                                        <img src="https://i.pravatar.cc/150?img={{ $user->id % 10 + 1 }}"
                                             alt="Avatar"
                                             class="rounded-circle border border-4 border-white shadow-lg"
                                             style="width: 150px; height: 150px; object-fit: cover;">
                                        <div class="status-indicator position-absolute bottom-0 end-0 bg-success rounded-circle" style="width: 30px; height: 30px; border: 4px solid white;"></div>
                                    </div>
                                    <div class="mt-3">
                                        <h4 class="fw-bold mb-1">{{ $user->nama }}</h4>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="badge bg-{{ $user->role == 'admin' ? 'primary' : 'secondary' }} rounded-pill px-3 py-2 me-2">
                                                <i class="bi bi-{{ $user->role == 'admin' ? 'shield-lock' : 'person' }} me-1"></i>
                                                {{ ucfirst($user->role) }}
                                            </span>
                                            <span class="text-muted small">
                                                <i class="bi bi-clock me-1"></i>
                                                {{ $user->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="info-cards">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="info-card bg-white rounded-3 p-3 shadow-sm">
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-box bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                        <i class="bi bi-person-badge text-primary fs-5"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 fw-semibold text-dark">ID Pengguna</h6>
                                                        <p class="mb-0 text-muted">{{ $user->id }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-card bg-white rounded-3 p-3 shadow-sm">
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-box bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                                        <i class="bi bi-telephone text-success fs-5"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 fw-semibold text-dark">Kontak</h6>
                                                        <p class="mb-0 text-muted">{{ $user->kontak }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-card bg-white rounded-3 p-3 shadow-sm">
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-box bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                                                        <i class="bi bi-at text-warning fs-5"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 fw-semibold text-dark">Username</h6>
                                                        <p class="mb-0 text-muted">{{ $user->username }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-card bg-white rounded-3 p-3 shadow-sm">
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-box bg-info bg-opacity-10 rounded-circle p-2 me-3">
                                                        <i class="bi bi-calendar text-info fs-5"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 fw-semibold text-dark">Bergabung</h6>
                                                        <p class="mb-0 text-muted">{{ $user->created_at->format('d M Y') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detailed Information Section -->
                    <div class="detail-section px-5 py-4">
                        <h5 class="mb-4 fw-bold text-dark">
                            <i class="bi bi-info-circle me-2 text-primary"></i> Informasi Lengkap
                        </h5>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label class="detail-label">Nama Lengkap</label>
                                    <div class="detail-value">{{ $user->nama }}</div>
                                </div>

                                <div class="detail-item">
                                    <label class="detail-label">Nomor Telepon</label>
                                    <div class="detail-value">{{ $user->kontak }}</div>
                                </div>

                                <div class="detail-item">
                                    <label class="detail-label">Username</label>
                                    <div class="detail-value">{{ $user->username }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label class="detail-label">Role</label>
                                    <div class="detail-value">
                                        <span class="badge bg-{{ $user->role == 'admin' ? 'primary' : 'secondary' }} rounded-pill px-3 py-2">
                                            <i class="bi bi-{{ $user->role == 'admin' ? 'shield-lock' : 'person' }} me-1"></i>
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <label class="detail-label">Dibuat</label>
                                    <div class="detail-value">{{ $user->created_at->format('d F Y, H:i') }}</div>
                                </div>

                                <div class="detail-item">
                                    <label class="detail-label">Diperbarui</label>
                                    <div class="detail-value">{{ $user->updated_at->format('d F Y, H:i') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Section -->
                    <div class="activity-section bg-light px-5 py-4 border-top">
                        <h5 class="mb-4 fw-bold text-dark">
                            <i class="bi bi-activity me-2 text-success"></i> Aktivitas Terkini
                        </h5>

                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1 fw-semibold">Pengguna dibuat</h6>
                                    <p class="mb-0 text-muted small">{{ $user->created_at->format('d F Y, H:i') }}</p>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1 fw-semibold">Terakhir diperbarui</h6>
                                    <p class="mb-0 text-muted small">{{ $user->updated_at->format('d F Y, H:i') }}</p>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-marker bg-warning"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1 fw-semibold">Login terakhir</h6>
                                    <p class="mb-0 text-muted small">{{ $user->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Animated Background */
    .bg-gradient-animated {
        background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #f5576c);
        background-size: 400% 400%;
        animation: gradientShift 15s ease infinite;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Premium Gradients */
    .bg-gradient-premium {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* Floating Shapes */
    .floating-shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: float 20s infinite ease-in-out;
    }

    .shape-1 {
        width: 100px;
        height: 100px;
        top: 20%;
        right: 10%;
        animation-delay: 0s;
    }

    .shape-2 {
        width: 60px;
        height: 60px;
        bottom: 30%;
        left: 15%;
        animation-delay: 5s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    /* Premium Card */
    .card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15) !important;
    }

    /* Avatar Container */
    .avatar-container {
        position: relative;
        transition: all 0.3s ease;
    }

    .avatar-container:hover {
        transform: scale(1.05);
    }

    .status-indicator {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
        }
    }

    /* Info Cards */
    .info-card {
        transition: all 0.3s ease;
        height: 100%;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .icon-box {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .info-card:hover .icon-box {
        transform: scale(1.1);
    }

    /* Detail Items */
    .detail-item {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .detail-label {
        font-weight: 600;
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        display: block;
    }

    .detail-value {
        font-weight: 500;
        color: #212529;
        font-size: 1rem;
        padding: 0.75rem 1rem;
        background: #f8f9fa;
        border-radius: 10px;
        border-left: 4px solid #667eea;
    }

    /* Timeline */
    .timeline {
        position: relative;
        padding-left: 30px;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 10px;
        top: 0;
        height: 100%;
        width: 2px;
        background: #e9ecef;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 2rem;
    }

    .timeline-marker {
        position: absolute;
        left: -25px;
        top: 5px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
    }

    .timeline-content {
        background: white;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .timeline-content:hover {
        transform: translateX(5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    /* Buttons */
    .btn {
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    /* Badge */
    .badge {
        font-weight: 500;
        padding: 0.5rem 1rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .timeline {
            padding-left: 20px;
        }

        .timeline-marker {
            left: -15px;
        }
    }
</style>
@endpush
@endsection

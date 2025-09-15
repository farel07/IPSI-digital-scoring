@extends('superadmin.app')

@section('title', 'Dashboard')

@section('content')
<!-- Breadcrumb -->
<nav class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><i class="bi bi-house-door-fill"></i> Dashboard</li>
    </ol>
</nav>

<!-- Kartu Statistik -->
<div class="row mb-4 g-4">
    <div class="col-md-3">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 bg-primary-subtle p-3 rounded">
                    <i class="bi bi-calendar2-event fs-2 text-primary"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <p class="mb-0 text-muted">Total Event</p>
                    <h4 class="mb-0 fw-bold">12</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 bg-success-subtle p-3 rounded">
                    <i class="bi bi-people-fill fs-2 text-success"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <p class="mb-0 text-muted">Total Pesilat</p>
                    <h4 class="mb-0 fw-bold">248</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 bg-info-subtle p-3 rounded">
                    <i class="bi bi-gavel fs-2 text-info"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <p class="mb-0 text-muted">Total Juri</p>
                    <h4 class="mb-0 fw-bold">36</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 bg-warning-subtle p-3 rounded">
                    <i class="bi bi-person-badge fs-2 text-warning"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <p class="mb-0 text-muted">Total Dewan</p>
                    <h4 class="mb-0 fw-bold">18</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Kartu Menu Aksi -->
<div class="row g-4">
    <div class="col-md-6">
        <div class="card text-center p-4 h-100">
            <div class="card-body d-flex flex-column">
                <i class="bi bi-trophy-fill fs-1 text-primary mb-3"></i>
                <h4 class="card-title fw-bold">Kelola Peserta</h4>
                <p class="card-text text-muted">Atur dan kelola semua event pertandingan pencak silat, termasuk data pesilat dalam kategori Pemasalan dan Prestasi.</p>
                <a href="/superadmin/kelola-peserta" class="btn btn-primary btn-lg mt-auto">
                    Masuk ke Kelola Peserta <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-center p-4 h-100">
            <div class="card-body d-flex flex-column">
                <i class="bi bi-person-plus-fill fs-1 text-success mb-3"></i>
                <h4 class="card-title fw-bold">Kelola Panitia</h4>
                <p class="card-text text-muted">Tambah dan atur panita dengan role Juri dan Dewan untuk setiap event pertandingan.</p>
                <a href="/superadmin/kelola-panitia" class="btn btn-success btn-lg mt-auto">
                    Masuk ke Kelola Panitia <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('superadmin.app')

@section('title', 'Kelola Peserta')

@section('content')
<!-- Breadcrumb -->
<nav class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/superadmin"><i class="bi bi-house-door-fill"></i> Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Kelola Peserta</li>
    </ol>
</nav>

<div class="card">
    <div class="card-body p-4">
        <div class="d-flex align-items-center mb-4">
            <i class="bi bi-trophy-fill fs-2 text-primary me-3"></i>
            <h3 class="mb-0 fw-bold">Kelola Peserta</h3>
        </div>

        <!-- Daftar Event 1 -->
        @foreach ($events as $event)
            
      
        <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-3 mb-3 border rounded">
            <div>
                <h5 class="mb-1 fw-semibold">{{ $event->name }}</h5>
                <p class="mb-1 text-muted">{{ $event->tgl_mulai_tanding }} sd {{ $event->tgl_selesai_tanding }} || {{ $event->lokasi }}</p>
            </div>
            <div class="d-flex align-items-center">
                <a href="/superadmin/atur-arena" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-gear-fill me-1"></i> Atur Arena
                </a>
                <a href="#" class="ms-3 text-secondary">
                    <i class="bi bi-chevron-right fs-4"></i>
                </a>
            </div>
        </div>
          @endforeach

    </div>
</div>
@endsection
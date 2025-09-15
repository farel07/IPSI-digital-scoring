@extends('superadmin.app')

@section('title', 'Detail Kejuaraan Nasional 2024')

@section('content')
<!-- Breadcrumb -->
<nav class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/superadmin"><i class="bi bi-house-door-fill"></i> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/superadmin/kelola-peserta">Kelola Peserta</a></li>
        <li class="breadcrumb-item active" aria-current="page">Kejuaraan Nasional 2024</li>
    </ol>
</nav>

<div class="card">
    <div class="card-body p-4">
        <!-- Card Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center">
                <i class="bi bi-trophy-fill fs-2 text-primary me-3"></i>
                <h3 class="mb-0 fw-bold">Kejuaraan Nasional 2024</h3>
            </div>
            <a href="#" class="btn btn-success">
                <i class="bi bi-plus-circle-fill me-2"></i> Tambah Pesilat
            </a>
        </div>

        <!-- Tab Kategori: Pemasalan & Prestasi -->
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-pemasalan-tab" data-bs-toggle="pill" data-bs-target="#pills-pemasalan" type="button" role="tab" aria-controls="pills-pemasalan" aria-selected="true"><i class="bi bi-people-fill me-2"></i>Pemasalan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-prestasi-tab" data-bs-toggle="pill" data-bs-target="#pills-prestasi" type="button" role="tab" aria-controls="pills-prestasi" aria-selected="false"><i class="bi bi-star-fill me-2"></i>Prestasi</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            {{-- TAB PEMASALAN --}}
            <div class="tab-pane fade show active" id="pills-pemasalan" role="tabpanel" aria-labelledby="pills-pemasalan-tab">
                 <p class="text-muted">Konten untuk kategori Pemasalan akan ditampilkan di sini.</p>
            </div>

            {{-- TAB PRESTASI --}}
            <div class="tab-pane fade" id="pills-prestasi" role="tabpanel" aria-labelledby="pills-prestasi-tab">
                
                <!-- Area Filter -->
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                    <h5 class="fw-semibold mb-0">Jadwal Pertandingan Prestasi</h5>
                    <div class="d-flex align-items-center">
                        <label for="arena-filter" class="form-label me-2 mb-0 fw-semibold">Filter Arena:</label>
                        <select class="form-select form-select-sm" id="arena-filter" style="width: 200px;">
                            <option value="all" selected>Tampilkan Semua</option>
                            {{-- [FIX 1] Tambahkan opsi untuk pertandingan tanpa arena --}}
                            <option value="unassigned">Belum Memiliki Arena</option>
                            @if(isset($arenas))
                                @foreach ($arenas as $arena)
                                    <option value="{{ $arena->id }}">{{ $arena->arena_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <!-- Konten Arena (Tabel) -->
                <div class="mt-4">
                    <div class="table-responsive-custom">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>Partai</th>
                                    <th>Tim Merah</th>
                                    <th>Tim Biru</th>
                                    <th>Kelas Tanding</th>
                                    <th>Babak</th>
                                    <th>Status</th>
                                    <th>Waktu</th>
                                    <th style="width: 180px;">Arena</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="prestasi-table-body">
                                @forelse ($daftar_pertandingan_prestasi as $pertandingan)
                                {{-- [FIX 2] Gunakan `or` operator untuk menangani arena null --}}
                                <tr data-arena-id="{{ $pertandingan->arena_id ?? 'unassigned' }}">
                                    <td class="fw-bold">PARTAI {{ $pertandingan->id }}</td>
                                    <td>
                                        @forelse ($pertandingan->pemain_unit_1 as $peserta)
                                            <div><span class="color-box bg-danger"></span>{{ $peserta->player?->name ?? 'N/A' }}<br><small class="text-muted d-block ms-4">{{ $peserta->player?->contingent?->name }}</small></div>
                                            @if(!$loop->last)<hr class="my-1">@endif
                                        @empty
                                            <span class="text-muted">-- Belum Ada --</span>
                                        @endforelse
                                    </td>
                                    <td>
                                        @forelse ($pertandingan->pemain_unit_2 as $peserta)
                                            <div><span class="color-box bg-primary"></span>{{ $peserta->player?->name ?? 'N/A' }}<br><small class="text-muted d-block ms-4">{{ $peserta->player?->contingent?->name }}</small></div>
                                            @if(!$loop->last)<hr class="my-1">@endif
                                        @empty
                                            <span class="text-muted">-- Belum Ada --</span>
                                        @endforelse
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $pertandingan->kelasPertandingan?->kelas?->nama_kelas ?? 'N/A' }}</div>
                                    </td>
                                    <td><span class="badge badge-warning-custom">{{ 'Babak ' . $pertandingan->round_number }}</span></td>
                                    <td><span>{{ ucwords(str_replace('_', ' ', $pertandingan->status)) }}</span></td>
                                    <td class="text-muted">--:--</td>
                                    <td>
                                        <select class="form-select form-select-sm arena-dropdown" data-id="{{ $pertandingan->id }}">
                                            {{-- [FIX 3] Tambahkan opsi placeholder jika arena_id null --}}
                                            <option value="" {{ is_null($pertandingan->arena_id) ? 'selected' : 'disabled' }}>
                                                Pilih Arena...
                                            </option>
                                            @if ($arenas->isEmpty())
                                                <option>Tidak ada arena</option>
                                            @else
                                                @foreach ($arenas as $arena)
                                                    <option value="{{ $arena->id }}" {{ $pertandingan->arena_id == $arena->id ? 'selected' : '' }}>
                                                        {{ $arena->arena_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </td>
                                    <td class="action-links">
                                        <a href="#" class="text-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                                        <a href="#" class="text-danger"><i class="bi bi-trash-fill"></i> Hapus</a>
                                        <a href="#" class="text-info"><i class="bi bi-arrow-left-right"></i> Pindah</a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">Tidak ada pertandingan yang dijadwalkan.</td>
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
@endsection

@push('scripts')
{{-- JavaScript tidak perlu diubah, biarkan sama persis --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const arenaDropdowns = document.querySelectorAll('.arena-dropdown');
    arenaDropdowns.forEach(dropdown => {
        dropdown.dataset.originalArena = dropdown.value;
        dropdown.addEventListener('change', function () {
            const pertandinganId = this.dataset.id;
            const newArenaId = this.value;
            // Pastikan URL di-generate dengan benar oleh Laravel
            const url = "{{ url('/superadmin/pindah-arena') }}/" + pertandinganId; 

            if (!confirm(`Anda yakin ingin memindahkan Partai #${pertandinganId} ke ${this.options[this.selectedIndex].text}?`)) {
                this.value = this.dataset.originalArena;
                return;
            }
            fetch(url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                body: JSON.stringify({ arena_id: newArenaId })
            })
            .then(response => response.json().then(data => ({ ok: response.ok, data })))
            .then(({ ok, data }) => {
                if (!ok) throw new Error(data.message || 'Gagal memindahkan arena.');
                alert(data.message);
                this.dataset.originalArena = newArenaId;
                // Update juga data-arena-id di <tr> setelah berhasil pindah
                this.closest('tr').dataset.arenaId = newArenaId;
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan: ' + error.message);
                this.value = this.dataset.originalArena;
            });
        });
    });

    // JavaScript UNTUK FILTER ARENA
    const arenaFilter = document.getElementById('arena-filter');
    const tableBody = document.getElementById('prestasi-table-body');
    const tableRows = tableBody.querySelectorAll('tr');

    arenaFilter.addEventListener('change', function() {
        const selectedArenaId = this.value;

        tableRows.forEach(row => {
            if (selectedArenaId === 'all' || row.dataset.arenaId === selectedArenaId) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});
</script>
@endpush
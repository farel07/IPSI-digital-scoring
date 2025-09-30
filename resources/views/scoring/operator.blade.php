@extends('main.main')

@section('styles')
{{-- [CSS BARU] Tambahkan blok style ini untuk warna dropdown --}}
<style>
    .status-dropdown {
        font-weight: 600;
        border-width: 2px;
        transition: all 0.2s ease-in-out;
    }
    .status-menunggu_peserta {
        border-color: #6c757d;
        color: #6c757d;
        background-color: #f8f9fa;
    }
    .status-siap_dimulai {
        border-color: #0d6efd;
        color: #0d6efd;
        background-color: #cfe2ff;
    }
    .status-berlangsung {
        border-color: #ffc107;
        color: #664d03;
        background-color: #fff3cd;
    }
    .status-selesai {
        border-color: #198754;
        color: #198754;
        background-color: #d1e7dd;
    }
    .status-ditunda {
        border-color: #dc3545;
        color: #dc3545;
        background-color: #f8d7da;
    }
</style>
@endsection

@section('content')
    <div class="container mt-2 mb-0 rounded-top pb-4 pt-3"
        style="background-color: rgb(216, 216, 216); border-bottom: 1px solid #c0c0c0">
        <div class="d-flex justify-content-center">
            <button class="btn btn-danger mx-3 text-light fs-5" type="button"
                style="width: 150px; height:50px;">Tanding</button>
            <button class="btn mx-3 text-light fs-5" type="button"
                style="width: 150px; height:50px; background-color:rgb(100, 100, 100)">Artistics</button>
            <button class="btn mx-3 text-light fs-5" type="button"
                style="width: 150px; height:50px; background-color:rgb(100, 100, 100)">Jurus Baku</button>
        </div>
    </div>
    <div class="container rounded-0 pb-4 pt-3" style="background-color: rgb(216, 216, 216); border-bottom: 1px solid #c0c0c0">
        <div class="d-flex justify-content-center">
            <button class="btn btn-light mx-3 fs-5" type="button" style="width: 300px; height:50px;">All Group</button>
            <button class="btn btn-light mx-3 fs-5" type="button" style="width: 300px; height:50px">All Class</button>
            <button class="btn btn-light mx-3 fs-5" type="button" style="width: 300px; height:50px">All Gender</button>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <button class="btn btn-light mx-3 fs-5" type="button" style="width: 300px; height:50px;">Monday, 2000 - 01 -
                01</button>
            <button class="btn btn-light mx-3 fs-5" type="button" style="width: 300px; height:50px">Session</button>
            <button class="btn btn-light mx-3 fs-5" type="button" style="width: 300px; height:50px">Undone</button>
        </div>
    </div>
    <div class="container rounded-bottom pb-4 pt-3" style="background-color: rgb(216, 216, 216);">
        
        <div class="table-responsive bg-white p-3 rounded">
            <h2 class="text-center mb-4">Jadwal Pertandingan Arena</h2>
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Kelas & Kategori</th>
                        <th scope="col">Babak</th>
                        <th scope="col" class="table-primary">Sudut Biru</th>
                        <th scope="col" class="table-danger">Sudut Merah</th>
                        <th scope="col" style="width: 180px;">Status</th>
                        <th scope="col" style="width: 180px;">Penilaian</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($daftar_pertandingan as $pertandingan)
                        <tr>
                            <th scope="row">{{ $pertandingan->id }}</th>
                            <td>
                                <strong>{{ $pertandingan->kelasPertandingan?->kelas?->nama_kelas ?? 'N/A' }}</strong><br>
                                <small class="text-muted">{{ $pertandingan->kelasPertandingan?->kategoriPertandingan?->nama_kategori ?? 'N/A' }}</small>
                            </td>
                            <td>
                                Babak {{ $pertandingan->round_number }} / Match {{ $pertandingan->match_number }}
                            </td>
                            <td>
                                @forelse ($pertandingan->pemain_unit_1 as $peserta)
                                    <div><strong>{{ $peserta->player?->name ?? 'N/A' }}</strong><br><small class="text-muted">{{ $peserta->player?->contingent?->name }}</small></div>
                                    @if(!$loop->last)<hr class="my-1">@endif
                                @empty
                                    <span class="text-muted">-- Belum Ada --</span>
                                @endforelse
                            </td>
                            <td>
                                @forelse ($pertandingan->pemain_unit_2 as $peserta)
                                    <div><strong>{{ $peserta->player?->name ?? 'N/A' }}</strong><br><small class="text-muted">{{ $peserta->player?->contingent?->name }}</small></div>
                                    @if(!$loop->last)<hr class="my-1">@endif
                                @empty
                                    <span class="text-muted">-- Belum Ada --</span>
                                @endforelse
                            </td>
                            <td>
                                @php
                                    $statusOptions = [
                                        'menunggu_peserta' => 'Menunggu Peserta',
                                        'siap_dimulai' => 'Siap Dimulai',
                                        'berlangsung' => 'Berlangsung',
                                        'selesai' => 'Selesai',
                                        'ditunda' => 'Ditunda',
                                    ];
                                @endphp
                                {{-- [PERUBAHAN KUNCI] Tambahkan class dinamis untuk warna awal --}}
                                <select class="form-select status-dropdown status-{{ $pertandingan->status }}" data-id="{{ $pertandingan->id }}">
                                    @foreach ($statusOptions as $value => $text)
                                        <option value="{{ $value }}" {{ $pertandingan->status == $value ? 'selected' : '' }}>
                                            {{ $text }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>

                            @if ($pertandingan->status == 'berlangsung')
                                <td>
                                    <a href="{{ url('scoring/penilaian/' . Auth::user()->id) }}" class="btn btn-info">Lihat Match</a>
                                </td>
                            @else
                                NaN  
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <h4>Tidak ada data pertandingan yang ditemukan di Arena ini.</h4>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const statusDropdowns = document.querySelectorAll('.status-dropdown');

    // [FUNGSI BARU] untuk mengubah warna dropdown
    function updateDropdownColor(dropdown) {
        // Hapus semua class warna yang mungkin ada
        dropdown.classList.remove('status-menunggu_peserta', 'status-siap_dimulai', 'status-berlangsung', 'status-selesai', 'status-ditunda');
        // Tambahkan class baru berdasarkan nilai yang dipilih
        dropdown.classList.add('status-' + dropdown.value);
    }

    statusDropdowns.forEach(dropdown => {
        // Simpan status awal untuk fitur "Batal"
        dropdown.dataset.originalStatus = dropdown.value;

        dropdown.addEventListener('change', function () {
            const pertandinganId = this.dataset.id;
            const newStatus = this.value;
            // [PERBAIKAN URL] Gunakan URL root agar konsisten
            const url = `update-status/${pertandinganId}`;

            if (!confirm(`Anda yakin ingin mengubah status pertandingan #${pertandinganId} menjadi "${this.options[this.selectedIndex].text}"?`)) {
                this.value = this.dataset.originalStatus;
                return;
            }

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    // Tambahkan header ini untuk penanganan error redirect yang lebih baik
                    'Accept': 'application/json' 
                },
                body: JSON.stringify({
                    status: newStatus
                })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw new Error(err.message || 'Gagal mengubah status.'); });
                }
                return response.json();
            })
            .then(data => {
                alert(data.message);
                // [PERBAIKAN] Panggil fungsi untuk update warna dan status original
                this.dataset.originalStatus = newStatus;
                updateDropdownColor(this);
                location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan: ' + error.message);
                // Kembalikan ke nilai dan warna awal jika gagal
                this.value = this.dataset.originalStatus;
                updateDropdownColor(this);
            });
        });
    });
});
</script>
@endpush
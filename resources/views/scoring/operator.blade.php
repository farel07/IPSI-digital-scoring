@extends('main.main')
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
                        <th scope="col">Partai</th>
                        <th scope="col">Kelas & Kategori</th>
                        <th scope="col">Babak</th>
                        <th scope="col" class="table-primary">Sudut Biru</th>
                        <th scope="col" class="table-danger">Sudut Merah</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- [FIX KUNCI] Loop setiap pertandingan dari daftar --}}
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
                                {{-- Menampilkan semua pemain dari accessor pemain_unit_1 --}}
                                @forelse ($pertandingan->pemain_unit_1 as $peserta)
                                    <div>
                                        <strong>{{ $peserta->player?->name ?? 'N/A' }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $peserta->player?->contingent?->name }}</small>
                                    </div>
                                    @if(!$loop->last)<hr class="my-1">@endif
                                @empty
                                    <span class="text-muted">-- Belum Ada --</span>
                                @endforelse
                            </td>
                            <td>
                                {{-- Menampilkan semua pemain dari accessor pemain_unit_2 --}}
                                @forelse ($pertandingan->pemain_unit_2 as $peserta)
                                    <div>
                                        <strong>{{ $peserta->player?->name ?? 'N/A' }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $peserta->player?->contingent?->name }}</small>
                                    </div>
                                    @if(!$loop->last)<hr class="my-1">@endif
                                @empty
                                    <span class="text-muted">-- Belum Ada --</span>
                                @endforelse
                            </td>
                            <td>
                                @php
                                    $statusText = ucwords(str_replace('_', ' ', $pertandingan->status));
                                    $badgeClass = 'bg-secondary';
                                    if ($pertandingan->status == 'siap_dimulai') $badgeClass = 'bg-primary';
                                    if ($pertandingan->status == 'selesai') $badgeClass = 'bg-success';
                                    if ($pertandingan->status == 'berlangsung') $badgeClass = 'bg-warning text-dark';
                                @endphp
                                <span class="badge fs-6 {{ $badgeClass }}">{{ $statusText }}</span>
                            </td>
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
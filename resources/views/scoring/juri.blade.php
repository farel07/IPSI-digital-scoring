@extends('main.main')
@section('content')

<style>
    .score-box {
        border-radius: 10px;
        white-space: nowrap; /* Mencegah teks turun ke baris baru */
        overflow-x: auto;   /* Memungkinkan scrolling, meskipun scrollbar disembunyikan */
        
        /* Menyembunyikan scrollbar di berbagai browser */
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }

    /* Menyembunyikan scrollbar untuk Chrome, Safari, dan Opera */
    .score-box::-webkit-scrollbar {
        display: none;
    }
</style>

<div id="match-data" 
    data-pertandingan-id="{{ $pertandingan->id }}" 
    data-juri-name="{{ $user->role->name }}"> {{-- Menambahkan nama juri --}}
</div>

    <div class="container mt-2 mb-2 rounded pb-4" style="background-color: rgb(216, 216, 216)">
        <div class="mb-3 text-center">
            <span class="badge bg-info text-dark fs-6">Juri: {{ $user->role->name }}</span>
        </div>
        <div class="container">
            {{-- title --}}
            <div class="d-flex justify-content-between">
                <div class="m-2">
                    {{-- Ganti dengan data dari accessor pemain_unit_1 (Tim Biru) --}}
                    <p class="text-start m-0">{{ $pertandingan->pemain_unit_1->first()?->player?->contingent?->name ?? 'Kontingen Biru' }}</p>
                    <h5 class="text-primary fw-bold">
                        {{-- Loop semua pemain di unit 1 --}}
                        @forelse ($pertandingan->pemain_unit_1 as $peserta)
                            {{ $peserta->player->name ?? '' }}{{ !$loop->last ? ', ' : '' }}
                        @empty
                            Pemain Biru
                        @endforelse
                    </h5>
                </div>
                <div class="m-2">
                    <p class="m-0 fw-bold">{{ $pertandingan->kelasPertandingan?->kelas?->nama_kelas ?? 'Nama Pertandingan' }}</p>
                    <p class="m-0 fw-bold">ARENA {{ $pertandingan->arena_id }}</p>
                </div>
                <div class="mt-2 me-2">
                    {{-- Ganti dengan data dari accessor pemain_unit_2 (Tim Merah) --}}
                    <p class="text-end m-0">{{ $pertandingan->pemain_unit_2->first()?->player?->contingent?->name ?? 'Kontingen Merah' }}</p>
                    <h5 class="text-end text-danger fw-bold">
                        {{-- Loop semua pemain di unit 2 --}}
                         @forelse ($pertandingan->pemain_unit_2 as $peserta)
                            {{ $peserta->player->name ?? '' }}{{ !$loop->last ? ', ' : '' }}
                        @empty
                            Pemain Merah
                        @endforelse
                    </h5>
                </div>
            </div>
            {{-- end title --}}

            <input type="hidden" id="juri_ket" value="{{ $user->role->name }}">

            {{-- score --}}
            <div class="row justify-content-between">

                {{-- team blue --}}
                <div class="col-4">
                    <div class="p-3 border bg-primary text-light text-center" style="border-radius: 10px">TEAM BLUE
                    </div>
                    <div id="total-point-blue-1" class="p-3 mt-3 border bg-light text-center score-box">.</div>
                    <div id="total-point-blue-2" class="p-3 mt-3 border bg-light text-center score-box">.</div>
                    <div id="total-point-blue-3" class="p-3 mt-3 border bg-light text-center score-box">.</div>
                    <div class="row d-flex flex-column">
                        <div class="col-6 mb-3">
                            <button class="mt-3 btn btn-primary w-100" type="button" value="1" onclick="kirimPukul('blue')"  id="btn_pukul_blue" 
                                style="border-radius: 10px; height: 100px"><img class="w-25 me-2"
                                    src="{{ asset('assets') }}/img/icon/logo-pukul.png" alt="Pukul">PUKUL</button>
                        </div>
                        {{-- <div class="col-6">
                            <button class="mt-3 btn w-100 text-light" type="button" onclick="kirimHapusPoint('blue')" id="btn_hapus_point_blue" disabled
                                style="border-radius: 10px; height: 100px; background-color:rgb(190, 0, 0)">HAPUS POINT
                                TERBARU</button>
                        </div> --}}
                        <div class="d-grid gap-2 col-6 me-auto">
                            <button class="btn btn-primary" id="btn_tendang_blue" type="button" style="border-radius: 10px; height: 100px" onclick="kirimTendang('blue')" value="2"><img
                                    class="w-25 me-1 mb-3" src="{{ asset('assets') }}/img/icon/logo-tendang.png"
                                    alt="Tendang">TENDANG</button>
                        </div>
                    </div>
                </div>
                {{-- end team blue --}}

                {{-- scoring --}}
                <div class="col-3">
                    <div class="p-3 border bg-warning text-light text-center" style="border-radius: 10px">SCORE</div>
                    <div id="round-box-1" class="p-3 mt-2 border {{ $pertandingan->current_round >= 1 ? 'bg-warning' : 'bg-light' }} text-center" style="border-radius: 10px; height:55px">I</div>
                    <div id="round-box-2" class="p-3 mt-2 border {{ $pertandingan->current_round >= 2 ? 'bg-warning' : 'bg-light' }} text-center" style="border-radius: 10px; height:55px">II</div>
                    @if ($pertandingan->kelasPertandingan?->kategoriPertandingan?->nama_kategori != 'Pemasalan')
                        <div id="round-box-3" class="p-3 mt-2 border {{ $pertandingan->current_round >= 3 ? 'bg-warning' : 'bg-light' }} text-center" style="border-radius: 10px; height:55px">III</div>
                    @endif
                </div>
                {{-- end scoring --}}

                {{-- team red --}}
                <div class="col-4">
                    <div class="p-3 border bg-danger text-light text-center" style="border-radius: 10px">TEAM RED</div>
                    <div id="total-point-red-1" class="p-3 mt-3 border bg-light text-center score-box">.</div>
                    <div id="total-point-red-2" class="p-3 mt-3 border bg-light text-center score-box">.</div>
                    <div id="total-point-red-3" class="p-3 mt-3 border bg-light text-center score-box">.</div>
                    <div class="d-flex flex-column align-items-end">
                        {{-- <div class="col-6">
                            <button class="mt-3 btn btn-danger w-100 text-light" type="button" onclick="kirimHapusPoint('red')" id="btn_hapus_point_red" disabled
                                style="border-radius: 10px; background-color:rgb(190, 0, 0); height: 100px">HAPUS POINT
                                TERBARU</button>
                        </div> --}}
                        <div class="col-6 mb-3">
                            <button class="mt-3 btn btn-danger w-100" type="button" onclick="kirimPukul('red')" id="btn_pukul_red"
                                style="border-radius: 10px; height:100px" value="1"><img class="w-25 me-1" 
                                    src="{{ asset('assets') }}/img/icon/logo-pukul.png" alt="Pukul"> PUKUL</button>
                        </div>
                        <div class="d-grid gap-2 col-6">
                            <button class="btn btn-danger" type="button" style="border-radius: 10px;height: 100px" onclick="kirimTendang('red')" id="btn_tendang_red" value="2"><img
                                    class="w-25 me-1 mb-3" src="{{ asset('assets') }}/img/icon/logo-tendang.png"
                                    alt="Tendang">TENDANG</button>
                        </div>
                    </div>
                </div>
                {{-- end team red --}}
            </div>
            {{-- end score --}}
        </div>
    </div>

    <div class="modal fade" id="juriVoteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="juriVoteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-warning border-3">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="juriVoteModalLabel">Permintaan Validasi Dewan</h5>
                </div>
                <div class="modal-body text-center">
                    <p class="lead">Dewan meminta validasi untuk:</p>
                    <h2 id="validation-type-display" class="fw-bold mb-4">...</h2>
                    <p>Silakan berikan penilaian Anda:</p>
                    <div class="d-grid gap-3">
                        <button type="button" class="btn btn-primary btn-lg" onclick="submitVote('biru')">Tim Biru</button>
                        <button type="button" class="btn btn-danger btn-lg" onclick="submitVote('merah')">Tim Merah</button>
                        <button type="button" class="btn btn-dark btn-lg" onclick="submitVote('invalid')">Invalid</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="{{ asset('assets') }}/js/listenEvents.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.2/dist/echo.iife.js"></script>
{{-- Letakkan di dalam file juri.blade.php, idealnya sebelum </body> --}}

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ambil elemen HTML yang menyimpan data dari server
    const juriMatchDataEl = document.getElementById('match-data');
    
    // Hentikan eksekusi jika tidak ada pertandingan aktif
    if (!juriMatchDataEl || !juriMatchDataEl.dataset.pertandinganId) {
        console.warn("JURI: Tidak ada data pertandingan, listener tidak diaktifkan.");
        return;
    }
    
    // Ambil data penting dari elemen HTML
    const pertandinganId = juriMatchDataEl.dataset.pertandinganId;
    const juriName = juriMatchDataEl.dataset.juriName;

    const juriVoteModalEl = document.getElementById('juriVoteModal');
    const juriVoteModal = new bootstrap.Modal(juriVoteModalEl);
    const validationTypeDisplay = document.getElementById('validation-type-display');

    // ======================================================================
    // LOGIKA SESSIONSTORAGE & MANAJEMEN RONDE
    // ======================================================================
    window.currentRound = {{ $pertandingan->current_round }};
    // 1. Buat kunci penyimpanan yang unik dan konsisten untuk juri ini
    const juriId = juriName.replace('-', ''); // Mengubah "juri-1" menjadi "juri1"
    const storageKey = juriScoreHistory_${juriId}_match${pertandinganId};

    // 2. Fungsi SIMPAN tetap menggunakan localStorage dengan kunci yang unik
    window.saveHistoryToSession = function() {
        const dataToSave = {
            pertandingan_id: pertandinganId,
            history: {
                blue: {
                    1: document.getElementById('total-point-blue-1').innerHTML,
                    2: document.getElementById('total-point-blue-2').innerHTML,
                    3: document.getElementById('total-point-blue-3').innerHTML
                },
                red: {
                    1: document.getElementById('total-point-red-1').innerHTML,
                    2: document.getElementById('total-point-red-2').innerHTML,
                    3: document.getElementById('total-point-red-3').innerHTML
                }
            }
        };
        // Simpan ke localStorage, bukan sessionStorage
        localStorage.setItem(storageKey, JSON.stringify(dataToSave));
        console.log(Riwayat skor Juri disimpan ke localStorage dengan kunci: ${storageKey});
    };

    // 3. Fungsi LOAD diperbaiki untuk membaca dari localStorage dengan kunci yang sama
    function loadHistoryFromStorage() {
        // Ganti sessionStorage.getItem menjadi localStorage.getItem
        const savedDataJSON = localStorage.getItem(storageKey); 
        
        if (savedDataJSON) {
            const savedData = JSON.parse(savedDataJSON);
            if (savedData.pertandingan_id == pertandinganId) {
                console.log('Memuat riwayat skor dari localStorage.');
                // Logika pemuatan data (tidak berubah)
                document.getElementById('total-point-blue-1').innerHTML = savedData.history.blue['1'] || '.';
                document.getElementById('total-point-blue-2').innerHTML = savedData.history.blue['2'] || '.';
                document.getElementById('total-point-blue-3').innerHTML = savedData.history.blue['3'] || '.';
                document.getElementById('total-point-red-1').innerHTML = savedData.history.red['1'] || '.';
                document.getElementById('total-point-red-2').innerHTML = savedData.history.red['2'] || '.';
                document.getElementById('total-point-red-3').innerHTML = savedData.history.red['3'] || '.';
            } else {
                localStorage.removeItem(storageKey);
            }
        }
    }

    // Panggil fungsi yang sudah diperbaiki
    loadHistoryFromStorage();
    
    // ======================================================================
    // ... KODE ECHO DAN PUSHER ANDA ...
    // ======================================================================

    const echo = new window.Echo({
        broadcaster: 'pusher',
        key: "{{ config('broadcasting.connections.pusher.key') }}",
        cluster: "{{ config('broadcasting.connections.pusher.options.cluster') }}",
        forceTLS: true
    });

    const channel = echo.private(pertandingan.${pertandinganId});
    
    console.log(JURI (${juriName}): Mencoba subscribe ke channel private-pertandingan.${pertandinganId});
    
    channel.error((error) => {
        console.error(JURI: Gagal terhubung ke channel, error otorisasi:, error);
        alert("JURI: Koneksi real-time GAGAL! Periksa console untuk detail.");
    });

    channel.listen('DewanRequestValidation', (data) => {
        console.log("JURI: Menerima request validasi dari Dewan", data);
        if (validationTypeDisplay) {
            validationTypeDisplay.textContent = data.jenisValidasi.toUpperCase();
        }
        juriVoteModal.show();
    });

    channel.listen('RoundUpdated', (data) => {
        console.log('Round Telah diubah oleh operator timer', data);
        // alert('Round telah diubah oleh operator timer');
        window.location.reload();
    });

    window.submitVote = function(vote) {
        fetch("{{ route('juri.submitVote') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                pertandingan_id: pertandinganId,
                juri_name: juriName,
                vote: vote
            })
        })
        .then(response => response.json())
        .then(result => {
            if(result.status === 'success') {
                juriVoteModal.hide();
            } else {
                alert('Gagal mengirim vote. Coba lagi.');
            }
        }).catch(error => {
            console.error('Error saat mengirim vote:', error);
            alert('Terjadi kesalahan jaringan saat mengirim vote.');
        });
    };
});
</script>


@endsection
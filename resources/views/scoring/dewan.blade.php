@extends('main.main')
@section('content')

<div id="match-data" 
    data-pertandingan-id="{{ $pertandingan->id }}" 
    data-current-round="{{ $pertandingan->current_round }}"
    data-kategori="{{ $pertandingan->kelasPertandingan?->kategoriPertandingan?->nama_kategori ?? 'Prestasi' }}">>
</div>

    <div class="container">
        {{-- Kita beri ID unik 'match-container' dan atribut data-pertandingan-id --}}
        <div id="match-container" class="container mt-2 mb-2 rounded" style="background-color: rgb(216, 216, 216)"
             @if(isset($pertandingan) && $pertandingan) data-pertandingan-id="{{ $pertandingan->id }}" @endif>
            
            @if (isset($pertandingan) && $pertandingan)
                {{-- Seluruh konten pertandingan Anda (title, score, dll.) masuk ke sini... --}}
                {{-- ... (Saya potong agar ringkas, isinya sama seperti yang Anda berikan) ... --}}
                <div class="container">
                    {{-- title --}}
                    <div class="d-flex justify-content-between">
                        <div class="m-2">
                            {{-- [FIX] Mengambil data dari accessor pemain_unit_1 (Tim Biru) --}}
                            <p class="text-start m-0">{{ $pertandingan->pemain_unit_1->first()?->player?->contingent?->name ?? 'Kontingen Biru' }}</p>
                            <h5 class="text-primary">
                                @forelse ($pertandingan->pemain_unit_1 as $peserta)
                                    {{ $peserta->player?->name ?? 'Pemain Biru' }}{{ !$loop->last ? ', ' : ''}}
                                @empty
                                    Pemain Biru Belum Ada
                                @endforelse
                            </h5>
                        </div>
                        <div class="m-2">
                            <p class="m-0 fw-bold">{{ $pertandingan->kelasPertandingan?->kelas?->nama_kelas ?? 'Nama Pertandingan' }}</p>
                            <p class="m-0 fw-bold">ARENA {{ $pertandingan->arena_id }}</p>
                        </div>
                        <div class="mt-2 me-2">
                            {{-- [FIX] Mengambil data dari accessor pemain_unit_2 (Tim Merah) --}}
                            <p class="text-end m-0">{{ $pertandingan->pemain_unit_2->first()?->player?->contingent?->name ?? 'Kontingen Merah' }}</p>
                            <h5 class="text-end text-danger">
                                @forelse ($pertandingan->pemain_unit_2 as $peserta)
                                    {{ $peserta->player?->name ?? 'Pemain Merah' }}{{ !$loop->last ? ', ' : ''}}
                                @empty
                                    Pemain Merah Belum Ada
                                @endforelse
                            </h5>
                        </div>
                    </div>
                    {{-- end title --}}

                    {{-- score --}}
                    <div class="row justify-content-between">
                        {{-- team blue --}}
                        <div class="col-5">
                            <div class="row justify-content-start">
                                <div class="col-3 pe-0"><div class="p-3 border bg-primary text-light text-center" style="font-size:14px; border-radius: 10px; width: 90px">BINA</div></div>
                                <div class="col-3 ps-0 pe-0" style="width: 98px"><div class="py-3 border bg-primary text-light text-center" style="font-size:14px; border-radius: 10px; width: 90px">TEGURAN</div></div>
                                <div class="col-3 ps-1 p-0" style="width: 98px"><div class="py-3 border bg-primary text-light text-center" style="font-size:14px;border-radius: 10px; width: 90px">PERINGATAN</div></div>
                                <div class="col-3 ps-2 p-0"><div class="p-3 border bg-primary text-light text-center" style="font-size:14px; border-radius: 10px; width: 90px">JATUH</div></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-3 pe-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-bina-blue-1">-</div></div>
                                <div class="col-3 ps-0 pe-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-teguran-blue-1">-</div></div>
                                <div class="col-3 ps-1 p-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px;border-radius: 10px; width: 90px" id="point-peringatan-blue-1">-</div></div>
                                <div class="col-3 ps-2 p-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-jatuh-blue-1">-</div></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-3 pe-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-bina-blue-2">-</div></div>
                                <div class="col-3 ps-0 pe-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-teguran-blue-2">-</div></div>
                                <div class="col-3 ps-1 p-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px;border-radius: 10px; width: 90px" id="point-peringatan-blue-2">-</div></div>
                                <div class="col-3 ps-2 p-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-jatuh-blue-2">-</div></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-3 pe-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-bina-blue-3">-</div></div>
                                <div class="col-3 ps-0 pe-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-teguran-blue-3">-</div></div>
                                <div class="col-3 ps-1 p-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px;border-radius: 10px; width: 90px" id="point-peringatan-blue-3">-</div></div>
                                <div class="col-3 ps-2 p-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-jatuh-blue-3">-</div></div>
                            </div>

                            <div class="row justify-content-between me-4">
                                <div class="col-6"><button id="btn_jatuh_blue" class="mt-3 btn btn-primary w-100" onclick="kirimJatuh('blue')" type="button" style="border-radius: 10px; height:100px" value="1">JATUH</button></div>
                                <div class="col-6"><button id="btn_binaan_blue" class="mt-3 btn btn-primary w-100" onclick="kirimBinaan('blue')" value="1" type="button" style="border-radius: 10px; height:100px">BINA</button></div>
                                <div class="col-6"><button id="btn_teguran_blue" class="mt-3 btn btn-primary w-100" onclick="kirimTeguran('blue')" value="1" type="button" style="border-radius: 10px; height:100px">TEGURAN</button></div>
                                <div class="col-6"><button id="btn_peringatan_blue" class="mt-3 btn btn-primary w-100" onclick="kirimPeringatan('blue')" value="1" type="button" style="border-radius: 10px; height:100px">PERINGATAN</button></div>
                                <div class="col-6"><button class="mt-3 btn btn-primary w-100 h-75" type="button" id="btn_hapus_jatuhan_blue" style="border-radius: 10px; background-color:rgb(190, 0, 0)" onclick="kirimHapus('jatuhan', 'blue')">HAPUS JATUHAN</button></div>
                                <div class="col-6"><button class="mt-3 btn btn-primary w-100 h-75" type="button" id="btn_hapus_pelanggaran_blue" style="border-radius: 10px; background-color:rgb(190, 0, 0)" onclick="kirimHapus('pelanggaran', 'blue')" value="0">HAPUS PELANGGARAN</button></div>
                            </div>
                        </div>
                        
                        {{-- scoring --}}
                        <div class="col-2">
                            <div class="p-3 border bg-success text-light text-center" style="border-radius: 10px; height:55px">SCORE</div>
                            <div id="round-box-1" class="p-3 mt-2 border {{ $pertandingan->current_round >= 1 ? 'bg-warning' : 'bg-light' }} text-center" style="border-radius: 10px; height:55px">I</div>
                            <div id="round-box-2" class="p-3 mt-2 border {{ $pertandingan->current_round >= 2 ? 'bg-warning' : 'bg-light' }} text-center" style="border-radius: 10px; height:55px">II</div>
                            @if ($pertandingan->kelasPertandingan?->kategoriPertandingan?->nama_kategori != 'Pemasalan')
                                <div id="round-box-3" class="p-3 mt-2 border {{ $pertandingan->current_round >= 3 ? 'bg-warning' : 'bg-light' }} text-center" style="border-radius: 10px; height:55px">III</div>
                            @endif
                            <div class="mt-5">
                                <button type="button" class="btn btn-warning text-light" data-bs-toggle="modal" data-bs-target="#validationModal">
                                    REQUEST VALIDATION
                                </button>

                                <!-- [PERUBAHAN] Mengubah DIV menjadi BUTTON dan menambahkan atribut pemicu modal -->
                                @php
                                    $kategori = $pertandingan->kelasPertandingan?->kategoriPertandingan?->nama_kategori;
                                    $currentRound = $pertandingan->current_round;
                                    $isDisabled = true;
                                    if ($kategori == 'Pemasalan' && $currentRound >= 2) {
                                        $isDisabled = false;
                                    } elseif ($kategori != 'Pemasalan' && $currentRound >= 3) {
                                        $isDisabled = false;
                                    }
                                @endphp
                                <button type="button" class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#modalTentukanPemenang" {{ $isDisabled ? 'disabled' : '' }}>
                                    TENTUKAN PEMENANG
                                </button>
                                <!-- [AKHIR PERUBAHAN] -->

                                <div class="border bg-dark p-2 mt-2 rounded-top"><p class="m-0 text-center text-light">LAST VALIDATION</p></div>
                                <div id="final-result-display" class="border bg-light p-2 mb-2 rounded-bottom"><p class="m-0 text-center">NO RESULT</p></div>
                            </div>
                        </div>

                        {{-- team red --}}
                        <div class="col-5">
                            <div class="row justify-content-end">
                                <div class="col-3 pe-0"><div class="p-3 border bg-danger text-light text-center" style="font-size:14px; border-radius: 10px; width: 90px">BINA</div></div>
                                <div class="col-3 ps-0 pe-0" style="width: 98px"><div class="py-3 border bg-danger text-light text-center" style="font-size:14px; border-radius: 10px; width: 90px">TEGURAN</div></div>
                                <div class="col-3 ps-1 p-0" style="width: 98px"><div class="py-3 border bg-danger text-light text-center" style="font-size:14px;border-radius: 10px; width: 90px">PERINGATAN</div></div>
                                <div class="col-3 ps-2 p-0"><div class="p-3 border bg-danger text-light text-center" style="font-size:14px; border-radius: 10px; width: 90px">JATUH</div></div>
                            </div>
                            <div class="row justify-content-end mt-2">
                                <div class="col-3 pe-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-bina-red-1">-</div></div>
                                <div class="col-3 ps-0 pe-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-teguran-red-1">-</div></div>
                                <div class="col-3 ps-1 p-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px;border-radius: 10px; width: 90px" id="point-peringatan-red-1">-</div></div>
                                <div class="col-3 ps-2 p-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-jatuh-red-1">-</div></div>
                            </div>
                            {{-- Baris point 2 & 3 untuk Merah --}}
                            <div class="row justify-content-end mt-2">
                                <div class="col-3 pe-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-bina-red-2">-</div></div>
                                <div class="col-3 ps-0 pe-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-teguran-red-2">-</div></div>
                                <div class="col-3 ps-1 p-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px;border-radius: 10px; width: 90px" id="point-peringatan-red-2">-</div></div>
                                <div class="col-3 ps-2 p-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-jatuh-red-2">-</div></div>
                            </div>
                            <div class="row justify-content-end mt-2">
                                <div class="col-3 pe-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-bina-red-3">-</div></div>
                                <div class="col-3 ps-0 pe-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-teguran-red-3">-</div></div>
                                <div class="col-3 ps-1 p-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px;border-radius: 10px; width: 90px" id="point-peringatan-red-3">-</div></div>
                                <div class="col-3 ps-2 p-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-jatuh-red-3">-</div></div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-6 ps-3"><button id="btn_jatuh_red" class="mt-3 btn btn-danger w-100" onclick="kirimJatuh('red')" type="button" style="border-radius: 10px; height:100px" value="1">JATUH</button></div>
                                <div class="col-6 pe-3"><button class="mt-3 btn btn-danger w-100" id="btn_binaan_red" type="button" style="border-radius: 10px; height:100px" onclick="kirimBinaan('red')" value="1" type="button">BINA</button></div>
                                <div class="col-6 ps-3"><button class="mt-3 btn btn-danger w-100" id="btn_teguran_red" type="button" style="border-radius: 10px; height:100px" onclick="kirimTeguran('red')" value="1" type="button">TEGURAN</button></div>
                                <div class="col-6 pe-3"><button class="mt-3 btn btn-danger w-100" id="btn_peringatan_red" type="button" style="border-radius: 10px; height:100px" onclick="kirimPeringatan('red')" value="1" type="button">PERINGATAN</button></div>
                                <div class="col-6"><button class="mt-3 btn btn-primary w-100 h-75" type="button" style="border-radius: 10px; background-color:rgb(190, 0, 0)" id="btn_hapus_jatuhan_red" onclick="kirimHapus('jatuhan', 'red')" >HAPUS JATUHAN</button></div>
                                <div class="col-6"><button class="mt-3 btn btn-primary w-100 h-75" type="button" style="border-radius: 10px; background-color:rgb(190, 0, 0)" id="btn_hapus_pelanggaran_red" onclick="kirimHapus('pelanggaran', 'red')" >HAPUS PELANGGARAN</button></div>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                <div class="text-center p-5"><h3>Tidak Ada Pertandingan Aktif</h3><p>Saat ini tidak ada pertandingan aktif yang ditugaskan kepada Dewan di Arena ini.</p></div>
            @endif
        </div>
    </div>


    {{-- modal request validation (kode tidak berubah) --}}
    <div class="modal fade" id="validationModal" tabindex="-1" aria-labelledby="validationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="validationModalLabel">Request Validasi Juri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="dewan-request-section">
                        <p class="text-center lead">Kirim permintaan validasi ke Juri untuk:</p>
                        <div class="d-grid gap-3">
                            <button type="button" class="btn btn-primary btn-lg" onclick="sendValidationRequest('Jatuhan')">Jatuhan</button>
                            <button type="button" class="btn btn-danger btn-lg" onclick="sendValidationRequest('Pelanggaran')">Pelanggaran</button>
                        </div>
                    </div>

                    <div id="dewan-vote-tracker-section" class="d-none mt-3">
                        <h5 class="text-center">Menunggu Vote dari Juri untuk: <strong id="requested-validation-type"></strong></h5>
                        <table class="table table-bordered text-center mt-3">
                            <thead>
                                <tr>
                                    <th>Juri 1</th>
                                    <th>Juri 2</th>
                                    <th>Juri 3</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span id="juri-1-vote" class="badge bg-secondary fs-6">Menunggu</span></td>
                                    <td><span id="juri-2-vote" class="badge bg-secondary fs-6">Menunggu</span></td>
                                    <td><span id="juri-3-vote" class="badge bg-secondary fs-6">Menunggu</span></td>
                                </tr>
                            </tbody>
                        </table>
                         <div class="d-grid mt-4">
                            <button class="btn btn-secondary" type="button" onclick="resetValidation()">Reset Validasi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- [KODE BARU] Modal untuk Menentukan Pemenang -->
   <div class="modal fade" id="modalTentukanPemenang" tabindex="-1" aria-labelledby="modalTentukanPemenangLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTentukanPemenangLabel">Pilih Pemenang Pertandingan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p>Pilih salah satu sudut sebagai pemenang untuk melanjutkan ke babak berikutnya.</p>
                
                <form id="formTentukanPemenang" method="POST" action="{{ route('pertandingan.setWinner', $pertandingan->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <input type="hidden" name="winner_unit_id" id="winner_id_input">

                    <div class="d-grid gap-3">
                        {{-- [PERBAIKAN] Menggunakan unit1_id --}}
                        <button type="button" class="btn btn-primary btn-lg btn-pilih-pemenang" 
                                data-winner-id="{{ $pertandingan->unit1_id }}"
                                data-winner-name="@forelse($pertandingan->pemain_unit_1 as $p){{ $p->player?->name ?? 'Pemain Biru' }}@if(!$loop->last), @endif @empty Pemain Biru @endforelse">
                            Pemenang Sudut BIRU <br>
                            <small>(@forelse ($pertandingan->pemain_unit_1 as $peserta)
                                {{ $peserta->player?->name ?? 'Pemain Biru' }}{{ !$loop->last ? ', ' : ''}}
                            @empty
                                Pemain Biru Belum Ada
                            @endforelse)</small>
                        </button>

                        {{-- [PERBAIKAN] Menggunakan unit2_id --}}
                        <button type="button" class="btn btn-danger btn-lg btn-pilih-pemenang" 
                                data-winner-id="{{ $pertandingan->unit2_id }}"
                                data-winner-name="@forelse($pertandingan->pemain_unit_2 as $p){{ $p->player?->name ?? 'Pemain Merah' }}@if(!$loop->last), @endif @empty Pemain Merah @endforelse">
                            Pemenang Sudut MERAH <br>
                            <small>(@forelse ($pertandingan->pemain_unit_2 as $peserta)
                                {{ $peserta->player?->name ?? 'Pemain Merah' }}{{ !$loop->last ? ', ' : ''}}
                            @empty
                                Pemain Merah Belum Ada
                            @endforelse)</small>
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
    <!-- [AKHIR KODE BARU] -->


<script>
document.addEventListener('DOMContentLoaded', function() {
    const dewanMatchDataEl = document.getElementById('match-data');
    if (!dewanMatchDataEl || !dewanMatchDataEl.dataset.pertandinganId) {
        console.warn("DEWAN: Tidak ada data pertandingan, sessionStorage tidak diaktifkan.");
        return;
    }

    const pertandinganId = dewanMatchDataEl.dataset.pertandinganId;
    const storageKey = `dewanScoreHistory_${pertandinganId}`;

    // Definisikan variabel ronde global agar bisa diakses oleh event.js
    window.currentRound = {{ $pertandingan->current_round }};

    /**
     * Menyimpan seluruh riwayat skor pelanggaran ke sessionStorage.
     */
    window.saveHistoryToSession = function() {
        const dataToSave = {
            pertandingan_id: pertandinganId,
            history: { blue: {}, red: {} }
        };

        const types = ['bina', 'teguran', 'peringatan', 'jatuh'];
        const colors = ['blue', 'red'];
        const rounds = [1, 2, 3];

        colors.forEach(color => {
            types.forEach(type => {
                dataToSave.history[color][type] = {};
                rounds.forEach(round => {
                    const elementId = `point-${type}-${color}-${round}`;
                    const element = document.getElementById(elementId);
                    if (element) {
                        dataToSave.history[color][type][round] = element.innerHTML;
                    }
                });
            });
        });

        sessionStorage.setItem(storageKey, JSON.stringify(dataToSave));
        console.log('Riwayat skor Dewan disimpan ke sessionStorage.');
    };

    /**
     * Memuat riwayat skor dari sessionStorage saat halaman dimuat.
     */
    function loadHistoryFromSession() {
        const savedDataJSON = sessionStorage.getItem(storageKey);
        if (!savedDataJSON) return;

        const savedData = JSON.parse(savedDataJSON);

        if (savedData.pertandingan_id == pertandinganId) {
            console.log('Memuat riwayat skor Dewan dari sessionStorage.');
            const types = ['bina', 'teguran', 'peringatan', 'jatuh'];
            const colors = ['blue', 'red'];
            const rounds = [1, 2, 3];

            colors.forEach(color => {
                types.forEach(type => {
                    rounds.forEach(round => {
                        const elementId = `point-${type}-${color}-${round}`;
                        const element = document.getElementById(elementId);
                        const savedValue = savedData.history?.[color]?.[type]?.[round];
                        if (element && savedValue) {
                            element.innerHTML = savedValue;
                        }
                    });
                });
            });
        } else {
            sessionStorage.removeItem(storageKey);
        }
    }

    // Panggil fungsi muat saat halaman pertama kali dibuka
    loadHistoryFromSession();
});
</script>

   {{-- Letakkan di dalam file dewan.blade.php, idealnya sebelum </body> --}}
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.2/dist/echo.iife.js"></script>
<script src="{{ asset('assets') }}/js/listenEvents.js"></script>

<script>
    var jenis_validation = '';
    document.addEventListener('DOMContentLoaded', function() {
        const dewanMatchDataEl = document.getElementById('match-data');
        if (!dewanMatchDataEl || !dewanMatchDataEl.dataset.pertandinganId) {
            return;
        }

        const pertandinganId = dewanMatchDataEl.dataset.pertandinganId;
        const kategori = dewanMatchDataEl.dataset.kategori;
        let votes = {};
        const requiredVotes = 2;
        const requestSection = document.getElementById('dewan-request-section');
        const trackerSection = document.getElementById('dewan-vote-tracker-section');
        const validationTypeEl = document.getElementById('requested-validation-type');
        const finalResultEl = document.getElementById('final-result-display').querySelector('p');
        const btnPemenang = document.getElementById('btn-tentukan-pemenang');
        const voteSpans = {
            'juri-1': document.getElementById('juri-1-vote'),
            'juri-2': document.getElementById('juri-2-vote'),
            'juri-3': document.getElementById('juri-3-vote'),
        };
        
        window.resetValidation = function() {
            votes = {};
            Object.values(voteSpans).forEach(span => {
                if(span) {
                    span.className = 'badge bg-secondary fs-6';
                    span.textContent = 'Menunggu';
                }
            });
            trackerSection.classList.add('d-none');
            requestSection.classList.remove('d-none');
            finalResultEl.textContent = 'NO RESULT';
            finalResultEl.className = 'm-0 text-center';
        };

        function checkVotes() {
            const voteCounts = { merah: 0, biru: 0, invalid: 0 };
            Object.values(votes).forEach(vote => {
                if(vote) voteCounts[vote]++;
            });

            for (const vote in voteCounts) {
                if (voteCounts[vote] >= requiredVotes) {
                    const resultText = vote.toUpperCase() + ' || ' + jenis_validation;
                    const colorClass = vote === 'merah' ? 'text-danger fw-bold' : (vote === 'biru' ? 'text-primary fw-bold' : '');
                    finalResultEl.innerHTML = resultText;
                    finalResultEl.className = `m-0 text-center ${colorClass}`;
                    return;
                } else {
                    const resultText = 'INVALID';
                    finalResultEl.innerHTML = resultText;
                }
            }
        }
        
        const echo = new window.Echo({
            broadcaster: 'pusher',
            key: "{{ config('broadcasting.connections.pusher.key') }}",
            cluster: "{{ config('broadcasting.connections.pusher.options.cluster') }}",
            forceTLS: true
        });

        const channel = echo.private(`pertandingan.${pertandinganId}`);
        channel.error(err => console.error("DEWAN: Gagal koneksi ke channel.", err));
        channel.listen('JuriVoteSubmitted', (data) => {
            if (voteSpans[data.juriName]) {
                votes[data.juriName] = data.vote;
                const span = voteSpans[data.juriName];
                span.textContent = data.vote.toUpperCase();
                if(data.vote === 'merah') span.className = 'badge bg-danger fs-6';
                else if (data.vote === 'biru') span.className = 'badge bg-primary fs-6';
                else span.className = 'badge bg-dark fs-6';
                checkVotes();
            }
        });
        channel.listen('RoundUpdated', (data) => {
            // alert('Round telah diubah oleh operator timer');
            window.location.reload();
        });
        
        window.sendValidationRequest = function(jenis) {
            jenis_validation = jenis;
            fetch("{{ route('dewan.requestValidation') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    pertandingan_id: pertandinganId,
                    jenis_validasi: jenis
                })
            })
            .then(res => res.json())
            .then(result => {
                if(result.status === 'success') {
                    resetValidation();
                    validationTypeEl.textContent = jenis;
                    requestSection.classList.add('d-none');
                    trackerSection.classList.remove('d-none');
                } else {
                    alert('Gagal mengirim request validasi.');
                }
            }).catch(err => console.error(err));
        }
    });
</script>

<!-- [KODE BARU] JavaScript untuk Modal Pemenang -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Cek jika modalnya ada di halaman
        const modalEl = document.getElementById('modalTentukanPemenang');
        if (modalEl) {
            const buttons = modalEl.querySelectorAll('.btn-pilih-pemenang');
            const form = document.getElementById('formTentukanPemenang');
            const winnerInput = document.getElementById('winner_id_input');
            
            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    const winnerId = this.getAttribute('data-winner-id');
                    const winnerName = this.getAttribute('data-winner-name');

                    // Validasi sederhana, jangan submit jika tidak ada ID pemenang
                    if (!winnerId) {
                        alert('Error: ID Pemenang tidak ditemukan. Pastikan kedua pemain sudah ada di slot pertandingan.');
                        return;
                    }

                    const confirmation = confirm(`Apakah Anda yakin ingin menetapkan ${winnerName} sebagai pemenang?`);
                    
                    if (confirmation) {
                        winnerInput.value = winnerId;
                        form.submit();
                    }
                });
            });
        }
    });
</script>
<!-- [AKHIR KODE BARU] -->

@endsection
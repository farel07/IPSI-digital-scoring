<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Penalti Tunggal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen p-2">
    <input type="hidden" id="filter" value="penilaian_tunggal_regu">
    <input type="hidden" id="user_id" value="{{ $user->id ?? '0' }}">

    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        @php
            // ==============================================================================
            // LOGIKA HYBRID UNTUK MENDUKUNG DATA LAMA & BARU
            // ==============================================================================
            $requestedUnitParam = request('unit', 'unit_1');

            // Cek apakah ini data format lama (Tanding)
            if ($pertandingan->unit1_id) {
                // Gunakan aksesor lama
                $unit1_peserta = $pertandingan->pemain_unit_1;
                $unit2_peserta = $pertandingan->pemain_unit_2;
                $selectedPeserta = ($requestedUnitParam == 'unit_1') ? $unit1_peserta : $unit2_peserta;
                $selectedUnitId = ($requestedUnitParam == 'unit_1') ? $pertandingan->unit1_id : $pertandingan->unit2_id;
            } else {
                // Gunakan logika baru untuk data Seni/Beregu
                $allPeserta = $pertandingan->grouped_peserta;
                preg_match('/(\d+)/', $requestedUnitParam, $matches);
                $requestedIndex = isset($matches[1]) ? (int)$matches[1] - 1 : 0;
                
                $unitIdArray = $allPeserta->keys()->values();
                $unitDataArray = $allPeserta->values();
                
                $selectedUnitId = $unitIdArray->get($requestedIndex);
                $selectedPeserta = $unitDataArray->get($requestedIndex, collect());
            }

            // Logika untuk waktu (tidak berubah)
            $waktu_tampil_detik = $penalti_terakhir->waktu_tampil ?? 0;
            $menit_tersimpan = floor($waktu_tampil_detik / 60);
            $sisa_detik = $waktu_tampil_detik % 60;
            $detik_puluhan_tersimpan = floor($sisa_detik / 10);
            $detik_satuan_tersimpan = $sisa_detik % 10;
        @endphp

        <!-- Header -->
        <div class="bg-white px-6 pb-4 pt-6 border-b border-gray-200">
            <div class="flex justify-between items-start">
                <div>
                    <input type="hidden" name="unit_id" id="unit_id" value="{{ $selectedUnitId }}">
                    
                    {{-- Loop ini sekarang bekerja untuk kedua jenis data --}}
                    @if(isset($selectedPeserta) && $selectedPeserta->isNotEmpty())
                        @foreach ($selectedPeserta as $peserta)
                            <h1 class="text-xl font-bold text-gray-800">{{ $peserta->player->name }}</h1>
                        @endforeach
                        <h1 class="text-2xl font-bold text-blue-500">{{ $selectedPeserta->first()->player->contingent->name }}</h1>
                    @else
                        <h1 class="text-xl font-bold text-gray-800">Peserta Tidak Ditemukan</h1>
                    @endif

                    {{-- Dropdown dinamis untuk data baru, atau statis untuk data lama --}}
                    <select name="unit" id="unit" class="mt-2 border-gray-300 rounded-md shadow-sm">
                        @if ($pertandingan->unit1_id)
                            {{-- Tampilkan opsi statis untuk data lama --}}
                            <option value="unit_1" {{ $requestedUnitParam == 'unit_1' ? 'selected' : '' }}>Unit 1</option>
                            <option value="unit_2" {{ $requestedUnitParam == 'unit_2' ? 'selected' : '' }}>Unit 2</option>
                        @else
                            {{-- Tampilkan opsi dinamis untuk data baru --}}
                            @foreach ($pertandingan->grouped_peserta as $unit_id => $peserta_list)
                                @php $loopIndex = $loop->iteration; @endphp
                                <option value="unit_{{ $loopIndex }}" {{ $requestedUnitParam == 'unit_'.$loopIndex ? 'selected' : '' }}>
                                    Unit {{ $loopIndex }}
                                </option>
                            @endforeach
                        @endif
                    </select>

                    <script>
                        document.getElementById('unit').addEventListener('change', function () {
                            const selected = this.value;
                            const currentUrl = new URL(window.location.href);
                            currentUrl.searchParams.set('unit', selected);
                            window.location.href = currentUrl.toString();
                        });
                    </script>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-600 font-medium">{{ $pertandingan->kelasPertandingan->kelas->nama_kelas }}</p>
                    <p>{{ $pertandingan->kelasPertandingan->kategoriPertandingan->nama_kategori }} 
                       {{ $pertandingan->kelasPertandingan->jenisPertandingan->nama_jenis }} 
                    </p>
                </div>
            </div>
        </div>

        {{-- Sisa dari file tidak perlu diubah, karena semua sudah mengacu pada --}}
        {{-- variabel $selectedUnitId dan $selectedPeserta yang sudah disiapkan di atas. --}}
        
        <!-- Penalty Table -->
        <div class="px-6 pb-6 pt-4">
            {{-- ... Konten tabel (tidak berubah) ... --}}
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 p-3 text-left font-semibold text-gray-700">Keterangan</th>
                            <th class="border border-gray-300 p-3 text-center font-semibold text-gray-700 w-48">Aksi</th>
                            <th class="border border-gray-300 p-3 text-center font-semibold text-gray-700 w-24">Nilai</th>
                        </tr>
                    </thead>
                    <tbody id="penaltyTableBody">
                        <tr class="bg-green-50">
                            <td class="border border-gray-300 p-3 text-sm font-semibold">WAKTU TAMPIL</td>
                            <td class="border border-gray-300 p-2 text-center">
                                <div class="flex items-center justify-center gap-1">
                                    <select id="menitSelect" class="border-gray-300 rounded-md shadow-sm">
                                        @for ($m = 0; $m <= 3; $m++)
                                            <option value="{{ $m }}" {{ $m == $menit_tersimpan ? 'selected' : '' }}>{{ sprintf('%02d', $m) }}</option>
                                        @endfor
                                    </select>
                                    <span class="font-bold">:</span>
                                    <select id="detikPuluhanSelect" class="border-gray-300 rounded-md shadow-sm">
                                        @for ($d = 0; $d <= 5; $d++)
                                            <option value="{{ $d }}" {{ $d == $detik_puluhan_tersimpan ? 'selected' : '' }}>{{ $d }}</option>
                                        @endfor
                                    </select>
                                    <select id="detikSatuanSelect" class="border-gray-300 rounded-md shadow-sm">
                                        @for ($d = 0; $d <= 9; $d++)
                                            <option value="{{ $d }}" {{ $d == $detik_satuan_tersimpan ? 'selected' : '' }}>{{ $d }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </td>
                            <td class="border border-gray-300 p-3 text-center font-medium">-</td>
                        </tr>
                        @php $nilai_waktu = $penalti_terakhir->waktu_terlampaui ?? 0.00; @endphp
                        <tr class="hover:bg-gray-50" data-type="waktu">
                            <td class="border border-gray-300 p-3 text-sm">PENALTI WAKTU</td>
                            <td class="border border-gray-300 p-2 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="clearPenalty(0)" class="bg-blue-500 hover:bg-blue-600 text-white px-10 py-3 rounded-lg font-bold text-sm transition-colors">Clear</button>
                                    <button onclick="applyPenalty(0)" class="bg-red-500 hover:bg-red-600 text-white px-10 py-3 rounded-lg font-bold text-sm transition-colors">-0.50</button>
                                </div>
                            </td>
                            <td class="border border-gray-300 p-3 text-center font-medium text-lg penalty-value" data-value="{{ number_format($nilai_waktu, 2, '.', '') }}">{{ number_format($nilai_waktu, 2) }}</td>
                        </tr>
                        @php $nilai_garis = $penalti_terakhir->keluar_garis ?? 0.00; @endphp
                        <tr class="hover:bg-gray-50" data-type="keluar_garis">
                            <td class="border border-gray-300 p-3 text-sm">SETIAP KALI KELUAR GARIS</td>
                            <td class="border border-gray-300 p-2 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="clearPenalty(1)" class="bg-blue-500 hover:bg-blue-600 text-white px-10 py-3 rounded-lg font-bold text-sm transition-colors">Clear</button>
                                    <button onclick="applyPenalty(1)" class="bg-red-500 hover:bg-red-600 text-white px-10 py-3 rounded-lg font-bold text-sm transition-colors">-0.50</button>
                                </div>
                            </td>
                            <td class="border border-gray-300 p-3 text-center font-medium text-lg penalty-value" data-value="{{ number_format($nilai_garis, 2, '.', '') }}">{{ number_format($nilai_garis, 2) }}</td>
                        </tr>
                        @php $nilai_pakaian = $penalti_terakhir->pakaian ?? 0.00; @endphp
                        <tr class="hover:bg-gray-50" data-type="pakaian">
                            <td class="border border-gray-300 p-3 text-sm">PAKAIAN TIDAK SEMPURNA</td>
                            <td class="border border-gray-300 p-2 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="clearPenalty(2)" class="bg-blue-500 hover:bg-blue-600 text-white px-10 py-3 rounded-lg font-bold text-sm transition-colors">Clear</button>
                                    <button onclick="applyPenalty(2)" class="bg-red-500 hover:bg-red-600 text-white px-10 py-3 rounded-lg font-bold text-sm transition-colors">-0.50</button>
                                </div>
                            </td>
                            <td class="border border-gray-300 p-3 text-center font-medium text-lg penalty-value" data-value="{{ number_format($nilai_pakaian, 2, '.', '') }}">{{ number_format($nilai_pakaian, 2) }}</td>
                        </tr>
                        @php $nilai_senjata = $penalti_terakhir->senjata_jatuh ?? 0.00; @endphp
                        <tr class="hover:bg-gray-50" data-type="senjata_jatuh">
                            <td class="border border-gray-300 p-3 text-sm">SETIAP KALI SENJATA JATUH</td>
                            <td class="border border-gray-300 p-2 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="clearPenalty(3)" class="bg-blue-500 hover:bg-blue-600 text-white px-10 py-3 rounded-lg font-bold text-sm transition-colors">Clear</button>
                                    <button onclick="applyPenalty(3)" class="bg-red-500 hover:bg-red-600 text-white px-10 py-3 rounded-lg font-bold text-sm transition-colors">-0.50</button>
                                </div>
                            </td>
                            <td class="border border-gray-300 p-3 text-center font-medium text-lg penalty-value" data-value="{{ number_format($nilai_senjata, 2, '.', '') }}">{{ number_format($nilai_senjata, 2) }}</td>
                        </tr>
                        @php $nilai_berhenti = $penalti_terakhir->stop ?? 0.00; @endphp
                        <tr class="hover:bg-gray-50" data-type="berhenti">
                            <td class="border border-gray-300 p-3 text-sm">ATLIT BERHENTI 5 DETIK DISETIAP GERAKAN</td>
                            <td class="border border-gray-300 p-2 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="clearPenalty(4)" class="bg-blue-500 hover:bg-blue-600 text-white px-10 py-3 rounded-lg font-bold text-sm transition-colors">Clear</button>
                                    <button onclick="applyPenalty(4)" class="bg-red-500 hover:bg-red-600 text-white px-10 py-3 rounded-lg font-bold text-sm transition-colors">-0.50</button>
                                </div>
                            </td>
                            <td class="border border-gray-300 p-3 text-center font-medium text-lg penalty-value" data-value="{{ number_format($nilai_berhenti, 2, '.', '') }}">{{ number_format($nilai_berhenti, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 flex justify-between items-center bg-white border border-gray-300 rounded-lg p-3">
                <button onclick="simpanWaktuTampil()" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg transition-colors">
                    Simpan Waktu Tampil
                </button>
                <div class="text-right">
                    <span class="text-lg font-bold text-gray-700">Total Penalty:</span>
                    <span id="totalScore" class="text-2xl font-bold text-red-500">0.00</span>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript tidak perlu diubah --}}
    <script>
        let isLoading = false;
        const user_id = document.getElementById("user_id").value;
        const filterValue = document.getElementById("filter").value;

        function toggleButtons(disabled) {
            isLoading = disabled;
            const buttons = document.querySelectorAll('.max-w-4xl button');
            buttons.forEach(button => {
                button.disabled = disabled;
                button.classList.toggle('opacity-50', disabled);
                button.classList.toggle('cursor-not-allowed', disabled);
            });
        }
        function kirimDataWaktu(total_detik) {
            if (isLoading) return;
            toggleButtons(true);
            fetch("/kirim-poin-seni/" + user_id, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    poin: total_detik,
                    type: 'waktu_tampil',
                    filter: filterValue,
                    unit_id: document.getElementById("unit_id").value,
                }),
            })
            .then(res => res.ok ? res.json() : Promise.reject('Network error'))
            .then(data => {
                console.log("Waktu tampil berhasil disimpan:", data);
                alert('Waktu tampil berhasil disimpan!');
            })
            .catch(error => {
                console.error("Fetch error:", error);
                alert("Terjadi kesalahan saat menyimpan waktu.");
            })
            .finally(() => toggleButtons(false));
        }
        function simpanWaktuTampil() {
            const menit = parseInt(document.getElementById('menitSelect').value);
            const detikPuluhan = parseInt(document.getElementById('detikPuluhanSelect').value);
            const detikSatuan = parseInt(document.getElementById('detikSatuanSelect').value);
            const totalDetik = (menit * 60) + (detikPuluhan * 10) + detikSatuan;
            kirimDataWaktu(totalDetik);
        }
        function kirimPoinSeni(dynamicType, poin) {
            if (isLoading) return;
            toggleButtons(true);
            fetch("/kirim-poin-seni/" + user_id, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    poin: parseFloat(poin),
                    type: dynamicType,
                    filter: filterValue,
                    unit_id: document.getElementById("unit_id").value,
                }),
            })
            .then(res => res.ok ? res.json() : Promise.reject('Network error'))
            .then(data => console.log("Data berhasil dikirim:", data))
            .catch(error => {
                console.error("Fetch error:", error);
                alert("Terjadi kesalahan saat mengirim data.");
            })
            .finally(() => toggleButtons(false));
        }
        function clearPenalty(rowIndex) {
            const penaltyRows = document.querySelectorAll('.penalty-value');
            const currentRow = penaltyRows[rowIndex]; 
            const currentValue = parseFloat(currentRow.dataset.value);
            if (currentValue >= 0) return;
            const newValue = currentValue + 0.5;
            currentRow.textContent = newValue.toFixed(2);
            currentRow.dataset.value = newValue.toString();
            updateTotal();
            const tableRows = document.querySelectorAll('#penaltyTableBody tr[data-type]');
            const penaltyType = tableRows[rowIndex].dataset.type;
            kirimPoinSeni('clear_' + penaltyType, 0.5);
        }
        function applyPenalty(rowIndex) {
            const penaltyRows = document.querySelectorAll('.penalty-value');
            const currentRow = penaltyRows[rowIndex];
            const currentValue = parseFloat(currentRow.dataset.value);
            const newValue = currentValue - 0.5;
            currentRow.textContent = newValue.toFixed(2);
            currentRow.dataset.value = newValue.toString();
            updateTotal();
            const tableRows = document.querySelectorAll('#penaltyTableBody tr[data-type]');
            const penaltyType = tableRows[rowIndex].dataset.type;
            kirimPoinSeni(penaltyType, -0.5);
        }
        function updateTotal() {
            const penaltyValues = document.querySelectorAll('.penalty-value');
            let total = 0;
            penaltyValues.forEach(cell => {
                total += parseFloat(cell.dataset.value);
            });
            const totalElement = document.getElementById('totalScore');
            if (totalElement) {
                totalElement.textContent = total.toFixed(2);
            }
        }
        document.addEventListener('DOMContentLoaded', () => {
            updateTotal();
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Penalti Tunggal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Meta Tag untuk CSRF Token (Penting untuk Laravel) -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen p-2">
    <!-- Input tersembunyi untuk dibaca oleh JavaScript -->
    <input type="hidden" id="filter" value="penilaian_tunggal_regu">

    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-white px-6 pb-4 pt-6 border-b border-gray-200">
            <div class="flex justify-between items-start">
                <div>
                    {{-- Logika untuk menampilkan nama dan kontingen --}}
                    @if(request('unit') == 'unit_1' || !request('unit'))
                        <input type="hidden" name="unit_id" id="unit_id" value="{{ $pertandingan->unit1_id }}">
                        @foreach ($pertandingan->pemain_unit_1 as $unit)
                            <h1 class="text-xl font-bold text-gray-800">{{ $unit->player->name }}</h1>
                            <h1 class="text-2xl font-bold text-blue-500">{{ $unit->player->contingent->name }}</h1>
                        @endforeach
                    @else
                        <input type="hidden" name="unit_id" id="unit_id" value="{{ $pertandingan->unit2_id }}">
                        @foreach ($pertandingan->pemain_unit_2 as $unit)
                            <h1 class="text-xl font-bold text-gray-800">{{ $unit->player->name }}</h1>
                            <h1 class="text-2xl font-bold text-blue-500">{{ $unit->player->contingent->name }}</h1>
                        @endforeach
                    @endif

                    {{-- Dropdown untuk memilih unit --}}
                    <select name="unit" id="unit" class="mt-2 border-gray-300 rounded-md shadow-sm">
                        <option value="unit_1" {{ request('unit', 'unit_1') == 'unit_1' ? 'selected' : '' }}>Unit 1</option>
                        <option value="unit_2" {{ request('unit') == 'unit_2' ? 'selected' : '' }}>Unit 2</option>
                    </select>

                    <script>
                        document.getElementById('unit').addEventListener('change', function () {
                            const selected = this.value;
                            // Membuat URL baru dengan parameter 'unit'
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

        <!-- Penalty Table -->
        <div class="px-6 pb-6 pt-4">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 p-3 text-left font-semibold text-gray-700">Penalty</th>
                            <th class="border border-gray-300 p-3 text-center font-semibold text-gray-700 w-48">Score</th>
                            <th class="border border-gray-300 p-3 text-center font-semibold text-gray-700 w-24">Nilai</th>
                        </tr>
                    </thead>
                    <tbody id="penaltyTableBody">
                        <!-- Baris 0: Waktu -->
                        @php $nilai_waktu = $penalti_terakhir->waktu_terlampaui ?? 0.00; @endphp
                        <tr class="hover:bg-gray-50" data-type="waktu">
                            <td class="border border-gray-300 p-3 text-sm">WAKTU</td>
                            <td class="border border-gray-300 p-2 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="clearPenalty(0)" class="bg-blue-500 hover:bg-blue-600 text-white px-10 py-3 rounded-lg font-bold text-sm transition-colors">Clear</button>
                                    <button onclick="applyPenalty(0)" class="bg-red-500 hover:bg-red-600 text-white px-10 py-3 rounded-lg font-bold text-sm transition-colors">-0.50</button>
                                </div>
                            </td>
                            <td class="border border-gray-300 p-3 text-center font-medium text-lg penalty-value" data-value="{{ number_format($nilai_waktu, 2, '.', '') }}">{{ number_format($nilai_waktu, 2) }}</td>
                        </tr>
                        
                        <!-- Baris 1: Keluar Garis -->
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
                        
                        <!-- Baris 2: Pakaian -->
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

                        <!-- Baris 3: Senjata Jatuh -->
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

                        <!-- Baris 4: Berhenti -->
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

            <!-- Footer Total -->
            <div class="mt-4 bg-white border border-gray-300 rounded-lg p-3">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-bold text-gray-700">Total Penalty:</span>
                    <span id="totalScore" class="text-2xl font-bold text-red-500">0.00</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // =====================================================================
        // KONFIGURASI & STATE
        // =====================================================================
        let isLoading = false;
        const id_user = window.location.pathname.split("/").pop();
        const filterValue = document.getElementById("filter").value;


        // =====================================================================
        // FUNGSI PENGIRIMAN DATA (ANTI-RACE CONDITION)
        // =====================================================================
        function toggleButtons(disabled) {
            isLoading = disabled;
            const buttons = document.querySelectorAll('#penaltyTableBody button');
            buttons.forEach(button => {
                button.disabled = disabled;
                button.classList.toggle('opacity-50', disabled);
                button.classList.toggle('cursor-not-allowed', disabled);
            });
        }

        function kirimPoinSeni(dynamicType, poin) {
            if (isLoading) {
                console.log("Request sedang diproses, mohon tunggu...");
                return;
            }
            toggleButtons(true);

            fetch("/kirim-poin-seni/" + id_user, {
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
            .then(res => {
                if (!res.ok) throw new Error('Network response was not ok');
                return res.json();
            })
            .then(data => {
                console.log("Data berhasil dikirim:", data);
            })
            .catch(error => {
                console.error("Fetch error:", error);
                alert("Terjadi kesalahan saat mengirim data. Silakan coba lagi.");
            })
            .finally(() => {
                toggleButtons(false);
            });
        }

        // =====================================================================
        // FUNGSI UTAMA UNTUK UI & LOGIKA SKOR
        // =====================================================================

        function clearPenalty(rowIndex) {
            const penaltyRows = document.querySelectorAll('.penalty-value');
            const currentRow = penaltyRows[rowIndex]; 
            const currentValue = parseFloat(currentRow.dataset.value);

            // Jangan lakukan apa pun jika nilai sudah 0 atau lebih
            if (currentValue >= 0) {
                console.log("Nilai sudah 0, tidak bisa dikurangi lagi.");
                return;
            }

            // DIUBAH: Menambahkan 0.5 untuk mengurangi penalti
            const newValue = currentValue + 0.5;

            currentRow.textContent = newValue.toFixed(2);
            currentRow.dataset.value = newValue.toString();
            
            updateTotal();

            const tableRows = document.querySelectorAll('#penaltyTableBody tr[data-type]');
            const penaltyType = tableRows[rowIndex].dataset.type;
            // Mengirim 0.5 untuk menetralkan di backend
            kirimPoinSeni('clear_' + penaltyType, 0.5);
        }


        function applyPenalty(rowIndex) {
            const penaltyRows = document.querySelectorAll('.penalty-value');
            const currentRow = penaltyRows[rowIndex];
            
            const currentValue = parseFloat(currentRow.dataset.value);
            // Menggunakan nilai 0.5
            const newValue = currentValue - 0.5;
            
            currentRow.textContent = newValue.toFixed(2);
            currentRow.dataset.value = newValue.toString();
            
            updateTotal();

            const tableRows = document.querySelectorAll('#penaltyTableBody tr[data-type]');
            const penaltyType = tableRows[rowIndex].dataset.type;
            // Mengirim -0.5
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

        // Inisialisasi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', () => {
            updateTotal();
        });
    </script>
</body>
</html>
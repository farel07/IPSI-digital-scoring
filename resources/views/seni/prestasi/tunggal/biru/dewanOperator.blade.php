<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencak Silat Scoreboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- META TAG UNTUK CSRF TOKEN (PENTING UNTUK LARAVEL) -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen p-2">

    @php $unit_id = $_GET['unit']  @endphp

    {{-- {{  }} --}}
    <!-- INPUT TERSEMBUNYI UNTUK DATA PENTING AGAR BISA DIAKSES JAVASCRIPT -->
    <input type="hidden" id="pertandingan_id" value="{{ $pertandingan->id }}">
    <input type="hidden" name="_unit_id" id="unit_id" value="{{ $unit_id }}">

    <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header Section (Dibuat Dinamis) -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-3">
            <div class="flex justify-between items-center">
                <div class="text-left">
                    @if ($unit_id == 'unit_1')
                       @foreach ($pertandingan->pemain_unit_1 as $unit)
                        
                    <div class="text-xs font-semibold">{{ $unit->player->contingent->name ?? 'KONTINGEN' }}</div>
                    <div class="text-sm font-semibold">{{ $unit->player->name ?? 'Nama Atlit' }}</div>
                    @endforeach
                        
                    @else
                    
                    @foreach ($pertandingan->pemain_unit_2 as $unit)
                        
                    <div class="text-xs font-semibold">{{ $unit->player->contingent->name ?? 'KONTINGEN' }}</div>
                    <div class="text-sm font-semibold">{{ $unit->player->name ?? 'Nama Atlit' }}</div>
                    @endforeach

                    @endif
                    
                </div>
                <div class="text-center flex-1">
                    <h1 class="text-xl font-bold">{{ $pertandingan->arena->arena_name ?? 'GELANGGANG' }}</h1>
                    <p class="text-blue-200 text-sm">{{ $pertandingan->kelasPertandingan->kategoriPertandingan->nama_kategori ?? 'KATEGORI' }} 
                        {{ $pertandingan->kelasPertandingan->jenisPertandingan->nama_jenis ?? 'JENIS' }}</p>
                </div>
               
            </div>
        </div>

        <!-- Main Scoring Table -->
        <div class="p-3">
            <div class="mb-4">
                <h2 class="text-lg font-bold text-gray-800 mb-2">Penilaian Juri</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 p-2 text-left font-semibold text-gray-700 text-sm">Kriteria</th>
                            @foreach($daftar_juri as $juri)
                                <th class="border border-gray-300 p-2 text-center font-semibold text-gray-700 text-sm" id="header-juri-{{$loop->iteration}}">Judge {{ $loop->iteration }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 p-2 font-medium text-gray-700 text-sm">Correctness Score</td>
                            @foreach($daftar_juri as $juri)
                                <td class="border border-gray-300 p-1 text-center text-sm" data-juri-id="{{$loop->iteration}}" data-kategori="correctness_score">9.90</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border border-gray-300 p-2 font-medium text-gray-700 text-sm">Flow / Stamina<br><span class="text-xs text-gray-500">(0.01-0.10)</span></td>
                            @foreach($daftar_juri as $juri)
                                <td class="border border-gray-300 p-1 text-center text-sm" data-juri-id="{{$loop->iteration}}" data-kategori="flow_stamina">0.00</td>
                            @endforeach
                        </tr>
                        <tr class="bg-blue-50">
                            <td class="border border-gray-300 p-2 font-bold text-gray-800 text-sm">Total Score</td>
                            @foreach($daftar_juri as $juri)
                                <td class="border border-gray-300 p-1 text-center text-base font-bold text-blue-600" id="total-juri-{{$loop->iteration}}">9.90</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Time Performance & Statistics -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
                <!-- Kiri: Statistik Skor Juri -->
                <div>
                    <h3 class="text-base font-bold text-gray-800 mb-2">Waktu & Statistik</h3>
                    <table class="w-full border-collapse border border-gray-300">
                        <tr>
                            <td class="border border-gray-300 p-2 font-medium text-gray-700 bg-gray-50 text-sm">Median</td>
                            <td class="border border-gray-300 p-1 text-center text-base font-bold text-green-600" id="median-value">0.00</td>
                        </tr>
                        <!-- BARIS BARU DITAMBAHKAN DI SINI -->
                        <tr>
                            <td class="border border-gray-300 p-2 font-medium text-gray-700 bg-gray-50 text-sm">Rata-rata Median</td>
                            <td class="border border-gray-300 p-1 text-center text-base font-bold text-green-600" id="median-average-value">0.00</td>
                        </tr>
                        <tr class="bg-green-50">
                            <td class="border border-gray-300 p-2 font-bold text-gray-800 text-sm">Final Score (Judge)</td>
                            <td class="border border-gray-300 p-1 text-center text-lg font-bold text-green-600" id="judge-final-score">0.00</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 p-2 font-medium text-gray-700 bg-gray-50 text-sm">Standard Deviation</td>
                            <td class="border border-gray-300 p-1 text-center text-sm" id="std-dev-value">0.00</td>
                        </tr>
                    </table>
                </div>

                <!-- Kanan: Tabel Penalti -->
                <div>
                    <h3 class="text-base font-bold text-gray-800 mb-2">Penalti</h3>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 p-2 text-left font-semibold text-gray-700 text-sm">Jenis Penalti</th>
                                <th class="border border-gray-300 p-2 text-center font-semibold text-gray-700 text-sm">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border border-gray-300 p-2 text-xs text-gray-700">Exceeded tolerance time</td>
                                <td class="border border-gray-300 p-1 text-center text-sm" id="penalty-waktu">0.00</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 p-2 text-xs text-gray-700">Exceeded 10m arena</td>
                                <td class="border border-gray-300 p-1 text-center text-sm" id="penalty-keluar_garis">0.00</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 p-2 text-xs text-gray-700">Weapon dropped</td>
                                <td class="border border-gray-300 p-1 text-center text-sm" id="penalty-senjata_jatuh">0.00</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 p-2 text-xs text-gray-700">Attire violation</td>
                                <td class="border border-gray-300 p-1 text-center text-sm" id="penalty-pakaian">0.00</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 p-2 text-xs text-gray-700">Static move >5 seconds</td>
                                <td class="border border-gray-300 p-1 text-center text-sm" id="penalty-berhenti">0.00</td>
                            </tr>
                            <tr class="bg-red-50">
                                <td class="border border-gray-300 p-2 font-bold text-gray-800 text-sm">Total Penalti</td>
                                <td class="border border-gray-300 p-1 text-center text-base font-bold text-red-600" id="total-penalty-value">0.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Final Result -->
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-4 rounded-lg">
                <div class="text-center">
                    <h2 class="text-lg font-bold mb-1">SKOR AKHIR</h2>
                    <div class="text-3xl font-bold mb-1" id="final-result-score">0.00</div>
                    <p class="text-green-100 text-sm" id="final-result-calculation">Final Score (0.00) - Total Penalti (0.00)</p>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT SECTION -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="/assets/js/listenEventsSeni.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const pertandingan_id = document.getElementById('pertandingan_id').value;
            if (pertandingan_id) {
                initializeListener(
                    "{{ config('broadcasting.connections.pusher.key') }}",
                    "{{ config('broadcasting.connections.pusher.options.cluster') }}",
                    pertandingan_id
                );
            } else {
                console.error("ID Pertandingan tidak ditemukan di HTML.");
            }
        });
    </script>
</body>
</html>
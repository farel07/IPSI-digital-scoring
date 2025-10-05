<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scoreboard: {{ $pertandingan->kelasPertandingan->kategoriPertandingan->nama_kategori ?? 'Tanding' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f9; }
        .custom-shadow { box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="min-h-screen">

    @php
        // Mengambil unit dari URL, default ke 'unit_1'
        $unit_id = $_GET['unit'] ?? 'unit_1';

        // Mengambil data pemain yang sesuai
        $pemainUnit = ($unit_id == 'unit_1') ? $pertandingan->pemain_unit_1->first() : $pertandingan->pemain_unit_2->first();

        // --- LOGIKA BARU UNTUK WARNA DINAMIS ---
        // Menentukan kelas warna berdasarkan unit
        if ($unit_id == 'unit_1') {
            $borderColor = 'border-blue-500';
            $textColor = 'text-blue-600';
            $bgColor = 'bg-blue-600';
        } else {
            $borderColor = 'border-red-500';
            $textColor = 'text-red-600';
            $bgColor = 'bg-red-600';
        }
    @endphp

    <!-- DATA PENTING UNTUK JAVASCRIPT -->
    <input type="hidden" id="pertandingan_id" value="{{ $pertandingan->id }}">
    <input type="hidden" id="unit_id" value="{{ $unit_id }}">

    <!-- Konten Utama -->
    <main class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Baris Atas: Info Atlet & Timer -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <div class="lg:col-span-2 bg-white rounded-xl custom-shadow p-6">
                <div class="flex items-center space-x-5">
                    <div class="flex-shrink-0">
                        <div class="w-11 h-8 bg-red-600 text-white font-bold text-sm rounded-md shadow-sm border border-gray-300 flex items-center justify-center">ID</div>
                    </div>
                    <div class="flex-shrink-0">
                        {{-- Menerapkan kelas border dinamis --}}
                        <div class="w-16 h-16 bg-gray-200 rounded-full border-2 {{ $borderColor }} flex items-center justify-center overflow-hidden">
                            <svg class="w-10 h-10 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-xl font-bold text-gray-800 mb-1">{{ $pemainUnit->player->contingent->name ?? 'INDONESIA' }}</h2>
                        {{-- Menerapkan kelas teks dinamis --}}
                        <p class="font-semibold text-base {{ $textColor }}">{{ $pemainUnit->player->name ?? 'BENNY G. SUMARSONO' }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl custom-shadow p-6 flex items-center justify-center">
                <div class="text-center">
                    <p class="text-sm text-gray-500 mb-1">Timer</p>
                    <div class="text-5xl font-bold text-gray-800" id="timer">00:00</div>
                </div>
            </div>
        </div>

        <!-- Layout Utama: Scoreboard di Kiri, Rincian di Kanan -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Kolom Kiri: Scoreboard Utama -->
            <div class="lg:col-span-2 bg-white rounded-xl custom-shadow p-6">
                <h3 class="text-lg font-bold text-gray-500 mb-6 text-center tracking-widest">SCOREBOARD</h3>
                <div class="grid grid-cols-5 md:grid-cols-10 gap-2 mb-2">
                    @foreach($daftar_juri as $juri)
                        <div class="bg-gray-100 text-gray-600 text-center py-2 rounded-md font-medium text-xs">{{ $loop->iteration }}</div>
                    @endforeach
                </div>
                <div class="grid grid-cols-5 md:grid-cols-10 gap-2">
                    @foreach($daftar_juri as $juri)
                        {{-- Menerapkan kelas background dinamis --}}
                        <div id="total-juri-{{$loop->iteration}}" class="text-white text-center py-3 rounded-md font-bold text-lg {{ $bgColor }}">9.90</div>
                    @endforeach
                </div>
                <div class="mt-8 text-center">
                    <div class="inline-block bg-gray-800 text-white px-8 py-3 rounded-lg shadow-lg">
                        <p class="text-xs text-gray-300 mb-1 tracking-widest">TOTAL SKOR</p>
                        <p class="text-4xl font-bold" id="final-result-score">0.00</p>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Rincian & Penalti -->
            <div class="lg:col-span-1 bg-white rounded-xl custom-shadow p-6">
                <h3 class="text-lg font-bold text-gray-500 mb-6 text-center tracking-widest">RINCIAN SKOR & PENALTI</h3>
                <div>
                    <h4 class="text-base font-semibold text-gray-700 mb-3">Statistik Skor Juri</h4>
                    <table class="w-full text-sm">
                        <tbody>
                            <tr class="border-b"><td class="py-2 font-medium text-gray-600">Median</td><td class="py-2 text-right font-bold text-green-600" id="median-value">0.00</td></tr>
                            <tr class="border-b"><td class="py-2 font-medium text-gray-600">Rata-rata Median</td><td class="py-2 text-right font-bold text-green-600" id="median-average-value">0.00</td></tr>
                            <tr class="border-b"><td class="py-2 font-medium text-gray-600">Final Score (Judge)</td><td class="py-2 text-right font-bold text-green-600" id="judge-final-score">0.00</td></tr>
                            <tr><td class="py-2 font-medium text-gray-600">Standard Deviation</td><td class="py-2 text-right font-medium text-gray-600" id="std-dev-value">0.00</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-6">
                    <h4 class="text-base font-semibold text-gray-700 mb-3">Penalti</h4>
                    <table class="w-full text-sm">
                        <tbody>
                            <tr class="border-b"><td class="py-1.5 text-gray-600">Exceeded tolerance time</td><td class="py-1.5 text-right font-medium" id="penalty-waktu">0.00</td></tr>
                            <tr class="border-b"><td class="py-1.5 text-gray-600">Exceeded 10m arena</td><td class="py-1.5 text-right font-medium" id="penalty-keluar_garis">0.00</td></tr>
                            <tr class="border-b"><td class="py-1.5 text-gray-600">Weapon dropped</td><td class="py-1.5 text-right font-medium" id="penalty-senjata_jatuh">0.00</td></tr>
                            <tr class="border-b"><td class="py-1.5 text-gray-600">Attire violation</td><td class="py-1.5 text-right font-medium" id="penalty-pakaian">0.00</td></tr>
                            <tr><td class="py-1.5 text-gray-600">Static move >5s</td><td class="py-1.5 text-right font-medium" id="penalty-berhenti">0.00</td></tr>
                            <tr class="bg-red-50 mt-2"><td class="pt-2 font-bold text-gray-800">Total Penalti</td><td class="pt-2 text-right font-bold text-red-600" id="total-penalty-value">0.00</td></tr>
                        </tbody>
                    </table>
                </div>
                 <p class="text-center text-xs text-gray-400 mt-4" id="final-result-calculation">Final Score (0.00) - Total Penalti (0.00)</p>
            </div>
        </div>
    </main>
    
    <!-- ELEMEN TERSEMBUNYI UNTUK LOGIKA JS -->
    <div class="hidden">
        <table>
            <thead><tr><th>Kriteria</th>@foreach($daftar_juri as $juri)<th id="header-juri-{{$loop->iteration}}">J{{$loop->iteration}}</th>@endforeach</tr></thead>
            <tbody>
                <tr><td>Correctness</td>@foreach($daftar_juri as $juri)<td data-juri-id="{{$loop->iteration}}" data-kategori="correctness_score">9.90</td>@endforeach</tr>
                <tr><td>Flow/Stamina</td>@foreach($daftar_juri as $juri)<td data-juri-id="{{$loop->iteration}}" data-kategori="flow_stamina">0.00</td>@endforeach</tr>
            </tbody>
        </table>
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
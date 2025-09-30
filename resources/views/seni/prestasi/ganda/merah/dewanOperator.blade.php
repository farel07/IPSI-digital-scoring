<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perhitungan Skor Pencak Silat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- TAMBAHKAN CSRF TOKEN & PUSHER SCRIPT -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
</head>
<body class="bg-gray-50 min-h-screen">

    <!-- TAMBAHKAN INPUT TERSEMBUNYI UNTUK ID PERTANDINGAN -->
    <input type="hidden" id="pertandingan_id" value="{{ $pertandingan->id }}">

    <div class="w-full h-screen p-6 bg-white overflow-auto">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Sistem Perhitungan Skor Pencak Silat</h1>
            <p class="text-gray-600">Panel Penilaian Juri - {{ count($daftar_juri) }} Juri</p>
        </div>

        <!-- Judge Panel Table -->
        <div class="mb-8">
            <table class="w-full border border-gray-300 text-center text-sm">
                <!-- Header Juri (Dibuat Dinamis) -->
                <thead>
                    <tr class="bg-gray-100 font-semibold">
                        <th class="px-4 py-3 border border-gray-300">Judge</th>
                        @foreach($daftar_juri as $juri)
                            <th class="px-3 py-3 border border-gray-300" id="header-juri-{{ $loop->iteration }}">Judge {{ $loop->iteration }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody id="scoreboard-body">
                    <!-- Kriteria 1 -->
                    <tr>
                        <td class="px-4 py-3 border border-gray-300 bg-gray-50 font-medium text-left">
                            TEKNIK SERANG BELA<br><span class="text-sm text-gray-500">(0.01-0.30)</span>
                        </td>
                        @foreach($daftar_juri as $juri)
                            <td class="px-3 py-3 border border-gray-300" data-juri-id="{{ $loop->iteration }}" data-kategori="teknik">0.00</td>
                        @endforeach
                    </tr>
                    
                    <!-- Kriteria 2 -->
                    <tr>
                        <td class="px-4 py-3 border border-gray-300 bg-gray-50 font-medium text-left">
                            KEMANTAPAN & KESERASIAN<br><span class="text-sm text-gray-500">(0.01-0.30)</span>
                        </td>
                        @foreach($daftar_juri as $juri)
                            <td class="px-3 py-3 border border-gray-300" data-juri-id="{{ $loop->iteration }}" data-kategori="kekuatan">0.00</td>
                        @endforeach
                    </tr>
                    
                    <!-- Kriteria 3 -->
                    <tr>
                        <td class="px-4 py-3 border border-gray-300 bg-gray-50 font-medium text-left">
                            PENGHAYATAN & PENJIWAAN<br><span class="text-sm text-gray-500">(0.01-0.30)</span>
                        </td>
                        @foreach($daftar_juri as $juri)
                            <td class="px-3 py-3 border border-gray-300" data-juri-id="{{ $loop->iteration }}" data-kategori="penampilan">0.00</td>
                        @endforeach
                    </tr>
                    
                    <!-- Total Score -->
                    <tr class="bg-blue-50 font-semibold">
                        <td class="px-4 py-3 border border-gray-300 bg-blue-100 font-bold">Total Score</td>
                        @foreach($daftar_juri as $juri)
                            <td class="px-3 py-3 border border-gray-300 font-mono" id="total-juri-{{ $loop->iteration }}">9.10</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Sorted Judge Card -->
        <div class="mb-8 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-5 shadow-sm">
            <h3 class="text-xl font-semibold text-blue-800 mb-4 text-center">Sorted Judge Scores</h3>
            <div id="sorted-scores-container" class="flex justify-center gap-3 mb-4 flex-wrap">
                <!-- Akan diisi oleh JavaScript -->
            </div>
            <div class="text-center text-sm text-blue-600">
                <span class="bg-yellow-200 px-3 py-1 rounded">Median Values</span> - Nilai tengah dari {{ count($daftar_juri) }} juri
            </div>

            <!-- Kanan: Tabel Penalti BARU -->
<div>
    <h3 class="text-base font-bold text-gray-800 mb-2">Penalti Ganda/Regu</h3>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 p-2 text-left font-semibold text-gray-700 text-sm">Jenis Penalti</th>
                <th class="border border-gray-300 p-2 text-center font-semibold text-gray-700 text-sm">Nilai</th>
            </tr>
        </thead>
        <tbody>
            <!-- ID unik untuk setiap nilai penalti -->
            <tr>
                <td class="border border-gray-300 p-2 text-xs text-gray-700">Waktu</td>
                <td class="border border-gray-300 p-1 text-center text-sm" id="penalty-ganda-waktu">0.00</td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2 text-xs text-gray-700">Keluar Garis</td>
                <td class="border border-gray-300 p-1 text-center text-sm" id="penalty-ganda-keluar_garis">0.00</td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2 text-xs text-gray-700">Jatuh Tdk Sesuai</td>
                <td class="border border-gray-300 p-1 text-center text-sm" id="penalty-ganda-senjata_jatuh_tidak_sesuai">0.00</td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2 text-xs text-gray-700">Tdk Jatuh Sesuai</td>
                <td class="border border-gray-300 p-1 text-center text-sm" id="penalty-ganda-senjata_tidak_jatuh">0.00</td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2 text-xs text-gray-700">Salam/Suara</td>
                <td class="border border-gray-300 p-1 text-center text-sm" id="penalty-ganda-salam_suara">0.00</td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2 text-xs text-gray-700">Baju/Senjata Rusak</td>
                <td class="border border-gray-300 p-1 text-center text-sm" id="penalty-ganda-baju_senjata_rusak">0.00</td>
            </tr>
            <tr class="bg-red-50">
                <td class="border border-gray-300 p-2 font-bold text-gray-800 text-sm">Total Penalti Ganda/Regu</td>
                <td class="border border-gray-300 p-1 text-center text-base font-bold text-red-600" id="total-penalty-ganda-value">0.00</td>
            </tr>
        </tbody>
    </table>
</div>
        </div>


        

        <!-- Results Section -->
        <div class="grid grid-cols-3 gap-8 ">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 text-center shadow-sm">
                <h4 class="text-lg font-semibold text-blue-800 mb-3">Median</h4>
                <div id="median-score" class="text-4xl font-mono text-blue-600 font-bold">0.00</div>
            </div>
            
            <div class="bg-green-50 border border-green-200 rounded-lg p-5 text-center shadow-sm">
                <h4 class="text-lg font-semibold text-green-800 mb-3">Final Score</h4>
                <div id="final-score" class="text-4xl font-mono text-gray-700 font-bold">0.00</div>
            </div>
            
            <div class="bg-orange-50 border border-orange-200 rounded-lg p-5 text-center shadow-sm">
                <h4 class="text-lg font-semibold text-orange-800 mb-3">Standard Deviation</h4>
                <div id="std-dev-score" class="text-2xl font-mono text-gray-700">0.00</div>
            </div>
        </div>
    </div>

    <!-- SCRIPT SECTION -->
    <script src="/assets/js/listenEventsSeniGanda.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const pertandingan_id = document.getElementById('pertandingan_id').value;
            if (pertandingan_id) {
                initializeListener(
                    "{{ config('broadcasting.connections.pusher.key') }}",
                    "{{ config('broadcasting.connections.pusher.options.cluster') }}",
                    pertandingan_id
                );
            }
        });
    </script>
</body>
</html>
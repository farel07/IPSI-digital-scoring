<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scoreboard: {{ $pertandingan->kelasPertandingan->kategoriPertandingan->nama_kategori ?? 'Ganda' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #e2e8f0; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .card { background-color: white; border-radius: 0.75rem; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1); }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="flex items-center justify-center min-h-screen p-4">

    @php
        $unit_id = $_GET['unit'] ?? 'unit_1';
        $pemainUnit = ($unit_id == 'unit_1') ? $pertandingan->pemain_unit_1 : $pertandingan->pemain_unit_2;
        $kontingen = $pemainUnit->first()->player->contingent ?? null;
    @endphp

    <!-- DATA PENTING UNTUK JAVASCRIPT -->
    <input type="hidden" id="pertandingan_id" value="{{ $pertandingan->id }}">

    <div class="w-full max-w-4xl mx-auto">
        <div class="card p-6 space-y-4">
            <!-- Header -->
            <div class="text-center border-b-2 border-blue-600 pb-4">
                <h1 class="text-4xl font-black text-gray-800">PENCAK SILAT</h1>
                <div class="flex justify-center items-center space-x-4 mt-2">
                    <span class="bg-blue-100 text-blue-800 text-sm font-bold px-3 py-1 rounded-full">{{ $pertandingan->arena->arena_name ?? 'Arena' }}</span>
                    <span class="bg-red-100 text-red-800 text-sm font-bold px-3 py-1 rounded-full">FINAL</span>
                    <span class="bg-green-100 text-green-800 text-sm font-bold px-3 py-1 rounded-full">{{ $pertandingan->kelasPertandingan->kategoriPertandingan->nama_kategori ?? 'Prestasi' }}</span>
                </div>
            </div>

            <!-- Info Kontingen -->
            <div class="card p-4">
                <h2 class="text-2xl font-bold text-gray-800">{{ $kontingen->name ?? 'Kontingen' }}</h2>
                <div class="mt-2 bg-gray-50 rounded-lg p-3 border border-gray-200">
                    @foreach($pemainUnit as $pemain)
                        <p class="font-semibold text-gray-700">| {{ $pemain->player->name ?? 'Nama Atlet' }}</p>
                    @endforeach
                </div>
            </div>

            <!-- Timer -->
            <div class="card p-4 text-center">
                <p class="text-sm font-semibold text-gray-500">TIMER</p>
                <p id="timer" class="text-5xl font-mono font-bold text-gray-800">00:00</p>
            </div>

            <!-- Scoreboard Juri -->
            <div class="card p-4">
                <table class="w-full text-center">
                    <thead>
                        <tr>
                            @foreach($daftar_juri as $juri)
                                <th class="bg-blue-600 text-white font-bold text-lg py-2 border-r border-blue-700 last:border-r-0 first:rounded-tl-lg last:rounded-tr-lg">{{ $loop->iteration }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach($daftar_juri as $juri)
                                <td id="total-juri-{{ $loop->iteration }}" class="bg-blue-500 text-white font-mono font-bold text-3xl py-3 border-r border-blue-600 last:border-r-0 first:rounded-bl-lg last:rounded-br-lg">9.10</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Hasil Akhir -->
            <div class="grid grid-cols-3 gap-4">
                <div class="card p-4 text-center">
                    <p class="text-sm font-bold text-gray-500">MEDIAN</p>
                    <p id="median-score" class="text-3xl font-mono font-bold text-blue-600 mt-1">0.00</p>
                </div>
                <div class="card p-4 text-center bg-red-50 border border-red-200">
                    <p class="text-sm font-bold text-red-600">TOTAL PENALTY</p>
                    <p id="total-penalty-ganda-value" class="text-3xl font-mono font-bold text-red-600 mt-1">0.00</p>
                </div>
                <div class="card p-4 text-center bg-green-50 border border-green-200">
                    <p class="text-sm font-bold text-green-600">FINAL SCORE</p>
                    <p id="final-score" class="text-3xl font-mono font-bold text-green-600 mt-1">0.00</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ===================================================================== -->
    <!--          BAGIAN INI ADALAH KUNCI PENYELESAIAN MASALAH ANDA             -->
    <!-- PASTIKAN BLOK INI ADA DAN LENGKAP SEPERTI DI BAWAH INI                 -->
    <!-- ===================================================================== -->
    <div class="hidden">
        <table>
            <thead id="header-juri-container">
                 @foreach($daftar_juri as $juri)
                    <th id="header-juri-{{ $loop->iteration }}">Judge {{ $loop->iteration }}</th>
                @endforeach
            </thead>
            <tbody id="scoreboard-body">
                <tr>
                    <td>Teknik</td>
                    @foreach($daftar_juri as $juri)
                        <td data-juri-id="{{ $loop->iteration }}" data-kategori="teknik">0.00</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Kekuatan</td>
                    @foreach($daftar_juri as $juri)
                        <td data-juri-id="{{ $loop->iteration }}" data-kategori="kekuatan">0.00</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Penampilan</td>
                    @foreach($daftar_juri as $juri)
                        <td data-juri-id="{{ $loop->iteration }}" data-kategori="penampilan">0.00</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
        
        <table>
             <tbody>
                <tr><td>Waktu</td><td id="penalty-ganda-waktu">0.00</td></tr>
                <tr><td>Keluar Garis</td><td id="penalty-ganda-keluar_garis">0.00</td></tr>
                <tr><td>Jatuh Tdk Sesuai</td><td id="penalty-ganda-senjata_jatuh_tidak_sesuai">0.00</td></tr>
                <tr><td>Tdk Jatuh Sesuai</td><td id="penalty-ganda-senjata_tidak_jatuh">0.00</td></tr>
                <tr><td>Salam/Suara</td><td id="penalty-ganda-salam_suara">0.00</td></tr>
                <tr><td>Baju/Senjata Rusak</td><td id="penalty-ganda-baju_senjata_rusak">0.00</td></tr>
            </tbody>
        </table>
        
        <div id="sorted-scores-container"></div>
        <div id="std-dev-score"></div>
    </div>

    <!-- SCRIPT SECTION -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
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
            } else {
                console.error("ID Pertandingan tidak ditemukan.");
            }
        });
    </script>
</body>
</html>
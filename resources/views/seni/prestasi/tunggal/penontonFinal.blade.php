<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Akhir Pertandingan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

    {{-- Pastikan ada penanganan jika tidak ada pertandingan yang berlangsung --}}
    @if($pertandingan)
        @php
            // --- LOGIKA JAUH LEBIH SEDERHANA ---
            
            // Variabel $hasilBiru dan $hasilMerah sekarang datang langsung dari Controller.
            // Kita hanya perlu melakukan kalkulasi akhir di sini.

            // Ambil data pemain dan kontingen untuk ditampilkan
            $pemainUnitBiru = $pertandingan->pemain_unit_1;
            $pemainUnitMerah = $pertandingan->pemain_unit_2;
            $kontingenBiru = $pemainUnitBiru->first()->player->contingent->name ?? 'Kontingen Biru';
            $kontingenMerah = $pemainUnitMerah->first()->player->contingent->name ?? 'Kontingen Merah';

            // Hitung Total Penalti
            // Gunakan null coalescing operator (??) untuk mencegah error jika hasil poin null
            $penaltyBiru = ($hasilBiru->waktu_terlampaui ?? 0) + ($hasilBiru->keluar_garis ?? 0) + ($hasilBiru->pakaian ?? 0) + ($hasilBiru->senjata_jatuh ?? 0) + ($hasilBiru->stop ?? 0);
            $penaltyMerah = ($hasilMerah->waktu_terlampaui ?? 0) + ($hasilMerah->keluar_garis ?? 0) + ($hasilMerah->pakaian ?? 0) + ($hasilMerah->senjata_jatuh ?? 0) + ($hasilMerah->stop ?? 0);

            // Hitung Winning Point
            $winningPointBiru = ($hasilBiru->poin_final_median ?? 0) + $penaltyBiru;
            $winningPointMerah = ($hasilMerah->poin_final_median ?? 0) + $penaltyMerah;

            // Tentukan Pemenang
            $winnerName = 'DRAW';
            $winnerColorClass = 'text-gray-600';
            if ($winningPointBiru > $winningPointMerah) {
                $winnerName = 'Blue';
                $winnerColorClass = 'text-blue-600';
            } elseif ($winningPointMerah > $winningPointBiru) {
                $winnerName = 'Red';
                $winnerColorClass = 'text-red-600';
            }
        @endphp

        <!-- Header -->
        <header class="bg-white border-b border-gray-200 px-6 py-4">
            <div class="max-w-6xl mx-auto flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z"/></svg>
                    </div>
                    <span class="bg-blue-600 text-white px-3 py-1 rounded font-bold">{{ $pertandingan->arena->arena_name ?? 'Arena' }}</span>
                </div>
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-gray-800">PENCAK SILAT</h1>
                    <p class="text-sm text-gray-600 mt-1">FINAL – {{ strtoupper($pertandingan->kelasPertandingan->kelas->nama_kelas ?? 'KATEGORI') }}</p>
                </div>
                <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z"/></svg>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-6xl mx-auto px-6 py-8">
            <div class="flex justify-between items-start mb-8 bg-white rounded-lg shadow-md p-6">
                <!-- Blue Corner (Kiri) -->
                <div class="flex items-center space-x-4 w-5/12">
                    <div class="w-24 h-24 rounded-full border-4 border-blue-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-16 h-16 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    </div>
                    <div>
                        <div class="space-y-1 mb-2">
                            @foreach($pemainUnitBiru as $pemain)
                                <h3 class="font-bold text-lg text-gray-800">{{ $pemain->player->name ?? 'Nama Atlet Biru' }}</h3>
                            @endforeach
                        </div>
                        <p class="text-blue-600 font-bold text-sm">{{ $kontingenBiru }}</p>
                    </div>
                </div>

                <div class="text-4xl font-bold text-gray-400 pt-8">VS</div>

                <!-- Red Corner (Kanan) -->
                <div class="flex items-center space-x-4 w-5/12 justify-end">
                    <div class="text-right">
                        <div class="space-y-1 mb-2">
                            @foreach($pemainUnitMerah as $pemain)
                                <h3 class="font-bold text-lg text-gray-800">{{ $pemain->player->name ?? 'Nama Atlet Merah' }}</h3>
                            @endforeach
                        </div>
                        <p class="text-red-600 font-bold text-sm">{{ $kontingenMerah }}</p>
                    </div>
                    <div class="w-24 h-24 rounded-full border-4 border-red-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-16 h-16 text-red-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    </div>
                </div>
            </div>

            <div class="text-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Winner: <span class="{{ $winnerColorClass }}">{{ $winnerName }}</span></h2>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="table-auto w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-6 py-3 text-left font-semibold text-gray-800">Detail Point</th>
                            <th class="border px-6 py-3 text-center font-semibold text-blue-600">Blue ({{ $kontingenBiru }})</th>
                            <th class="border px-6 py-3 text-center font-semibold text-red-600">Red ({{ $kontingenMerah }})</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-gray-50">
                            <td class="border px-6 py-3 font-medium text-gray-700">Standard Deviation</td>
                            <td class="border px-6 py-3 text-center text-blue-600 font-bold">{{ number_format($hasilBiru->poin_std ?? 0, 6) }}</td>
                            <td class="border px-6 py-3 text-center text-red-600 font-bold">{{ number_format($hasilMerah->poin_std ?? 0, 6) }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="border px-6 py-3 font-medium text-gray-700">Performance Score</td>
                            <td class="border px-6 py-3 text-center text-blue-600 font-bold">{{ number_format($hasilBiru->poin_final_median ?? 0, 2) }}</td>
                            <td class="border px-6 py-3 text-center text-red-600 font-bold">{{ number_format($hasilMerah->poin_final_median ?? 0, 2) }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="border px-6 py-3 font-medium text-gray-700">Penalty</td>
                            <td class="border px-6 py-3 text-center text-blue-600 font-bold">{{ number_format($penaltyBiru, 2) }}</td>
                            <td class="border px-6 py-3 text-center text-red-600 font-bold">{{ number_format($penaltyMerah, 2) }}</td>
                        </tr>
                        <tr class="bg-yellow-50 hover:bg-yellow-100">
                            <td class="border px-6 py-4 font-bold text-gray-800 text-lg">Winning Point</td>
                            <td class="border px-6 py-4 text-center text-blue-600 font-bold text-xl">{{ number_format($winningPointBiru, 2) }}</td>
                            <td class="border px-6 py-4 text-center text-red-600 font-bold text-xl">{{ number_format($winningPointMerah, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    @else
        {{-- Tampilan jika tidak ada pertandingan yang berlangsung --}}
        <div class="flex items-center justify-center h-screen">
            <div class="text-center p-6 bg-white rounded-lg shadow-md">
                <h1 class="text-2xl font-bold text-gray-700">Tidak Ada Pertandingan</h1>
                <p class="text-gray-500 mt-2">Saat ini tidak ada pertandingan yang sedang berlangsung di arena ini.</p>
            </div>
        </div>
    @endif
</body>
</html> 
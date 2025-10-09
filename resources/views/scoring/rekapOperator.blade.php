<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Juri - Partai {{ $pertandingan->id ?? 'N/A' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { box-sizing: border-box; }
        input:disabled { background-color: #f3f4f6; border-color: #e5e7eb; color: #1f2937; -webkit-text-fill-color: #1f2937; opacity: 1; }
    </style>
</head>
<body class="bg-gray-100 p-3 h-screen overflow-hidden">
    @if(isset($pertandingan))
    <div id="rekap-data" data-pertandingan-id="{{ $pertandingan->id }}" data-current-round="{{ $pertandingan->current_round }}"></div>

    <div class="max-w-full mx-auto h-full flex flex-col">
        <!-- Header -->
        <div class="text-center mb-4">
            <h1 class="text-2xl font-bold text-gray-800 mb-3">Rekap Juri Pertandingan Silat (Partai {{ $pertandingan->id }})</h1>
            
            <div class="grid grid-cols-2 gap-4 max-w-3xl mx-auto">
                <div class="bg-blue-50 rounded-lg p-3 border-2 border-blue-200">
                    <h2 class="text-lg font-bold text-blue-600 mb-1">TIM BIRU</h2>
                    <div class="space-y-1">
                        @forelse ($pertandingan->pemain_unit_1 as $peserta)
                            <p class="text-sm font-semibold text-gray-800">{{ $peserta->player?->name ?? 'N/A' }}</p>
                            <p class="text-xs text-gray-600">{{ $peserta->player?->contingent?->name ?? 'N/A' }}</p>
                        @empty
                            <p class="text-sm font-semibold text-gray-800">Nama Pemain Biru</p>
                        @endforelse
                    </div>
                </div>
                
                <div class="bg-red-50 rounded-lg p-3 border-2 border-red-200">
                    <h2 class="text-lg font-bold text-red-600 mb-1">TIM MERAH</h2>
                    <div class="space-y-1">
                       @forelse ($pertandingan->pemain_unit_2 as $peserta)
                            <p class="text-sm font-semibold text-gray-800">{{ $peserta->player?->name ?? 'N/A' }}</p>
                            <p class="text-xs text-gray-600">{{ $peserta->player?->contingent?->name ?? 'N/A' }}</p>
                        @empty
                            <p class="text-sm font-semibold text-gray-800">Nama Pemain Merah</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 grid grid-cols-4 gap-3">
            <div class="col-span-3 flex flex-col gap-3">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="bg-gray-50 px-3 py-2 border-b"><h2 class="text-lg font-semibold text-gray-800">Rekap Total Poin Juri (Semua Ronde)</h2></div>
                    <div class="p-3">
                        <table class="w-full border-collapse border border-gray-300 text-sm">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-2 py-1 text-left text-xs">Kategori</th>
                                    @for ($i = 1; $i <= 3; $i++)<th class="border border-gray-300 px-2 py-1 text-center text-xs text-blue-600 font-bold">J{{$i}} BIRU</th>@endfor
                                    @for ($i = 1; $i <= 3; $i++)<th class="border border-gray-300 px-2 py-1 text-center text-xs text-red-600 font-bold">J{{$i}} MERAH</th>@endfor
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border border-gray-300 px-2 py-1 font-medium text-xs">Total Pukulan</td>
                                    @for ($j = 1; $j <= 3; $j++)<td><input disabled type="text" id="biruPukul{{$j}}" class="w-full border-0 text-center text-xs" value="0"></td>@endfor
                                    @for ($j = 1; $j <= 3; $j++)<td><input disabled type="text" id="merahPukul{{$j}}" class="w-full border-0 text-center text-xs" value="0"></td>@endfor
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="border border-gray-300 px-2 py-1 font-medium text-xs">Total Tendangan</td>
                                    @for ($j = 1; $j <= 3; $j++)<td><input disabled type="text" id="biruTendang{{$j}}" class="w-full border-0 text-center text-xs" value="0"></td>@endfor
                                    @for ($j = 1; $j <= 3; $j++)<td><input disabled type="text" id="merahTendang{{$j}}" class="w-full border-0 text-center text-xs" value="0"></td>@endfor
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="bg-gray-50 px-3 py-2 border-b"><h2 class="text-lg font-semibold text-gray-800">Rekap Dewan</h2></div>
                    <div class="p-3">
                        <table class="w-full border-collapse border border-gray-300 text-sm">
                             <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-2 py-1 text-left text-xs">Kategori</th>
                                    <th class="border border-gray-300 px-2 py-1 text-center text-blue-600 font-bold text-xs">TIM BIRU</th>
                                    <th class="border border-gray-300 px-2 py-1 text-center text-red-600 font-bold text-xs">TIM MERAH</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border border-gray-300 px-2 py-1 font-medium text-xs">Jatuhan</td>
                                    <td><input disabled type="number" id="biruJatuh" class="w-full border-0 text-center text-xs" value="{{ $rekapDb['biru']['jatuh'] }}"></td>
                                    <td><input disabled type="number" id="merahJatuh" class="w-full border-0 text-center text-xs" value="{{ $rekapDb['merah']['jatuh'] }}"></td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="border border-gray-300 px-2 py-1 font-medium text-xs">Binaan</td>
                                    <td><input disabled type="number" id="biruBina" class="w-full border-0 text-center text-xs" value="{{ $rekapDb['biru']['bina'] }}"></td>
                                    <td><input disabled type="number" id="merahBina" class="w-full border-0 text-center text-xs" value="{{ $rekapDb['merah']['bina'] }}"></td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 px-2 py-1 font-medium text-xs">Teguran</td>
                                    <td><input disabled type="number" id="biruTegur" class="w-full border-0 text-center text-xs" value="{{ $rekapDb['biru']['tegur'] }}"></td>
                                    <td><input disabled type="number" id="merahTegur" class="w-full border-0 text-center text-xs" value="{{ $rekapDb['merah']['tegur'] }}"></td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="border border-gray-300 px-2 py-1 font-medium text-xs">Peringatan</td>
                                    <td><input disabled type="number" id="biruPeringat" class="w-full border-0 text-center text-xs" value="{{ $rekapDb['biru']['peringat'] }}"></td>
                                    <td><input disabled type="number" id="merahPeringat" class="w-full border-0 text-center text-xs" value="{{ $rekapDb['merah']['peringat'] }}"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden h-fit">
                <div class="bg-gray-50 px-3 py-2 border-b"><h2 class="text-lg font-semibold text-gray-800">Total Skor Akhir</h2></div>
                <div class="p-3 flex items-center" style="padding-top: 120px; padding-bottom:120px">
                    <table class="w-full border-collapse border border-gray-300">
                         <thead>
                            <tr class="bg-green-100">
                                <th class="border border-gray-300 px-2 py-2 text-center text-blue-600 font-bold text-sm">TIM BIRU</th>
                                <th class="border border-gray-300 px-2 py-2 text-center text-red-600 font-bold text-sm">TIM MERAH</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border border-gray-300 px-2 py-8 text-center text-blue-600 font-bold text-4xl" id="totalBiru">{{ $rekapDb['biru']['total'] }}</td>
                                <td class="border border-gray-300 px-2 py-8 text-center text-red-600 font-bold text-4xl" id="totalMerah">{{ $rekapDb['merah']['total'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="text-center p-5">
        <h3 class="text-2xl font-bold">Tidak Ada Pertandingan Berlangsung</h3>
        <p>Halaman rekap hanya bisa diakses saat ada pertandingan dengan status "Berlangsung".</p>
    </div>
    @endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dataElement = document.getElementById('rekap-data');
    // Jika tidak ada data pertandingan, hentikan eksekusi script
    if (!dataElement) {
        return;
    }

    const pertandinganId = dataElement.dataset.pertandinganId;
    const currentRound = dataElement.dataset.currentRound;

    function getStorageData(key) {
        const dataJSON = localStorage.getItem(key);
        if (dataJSON) {
            try { return JSON.parse(dataJSON); } 
            catch (e) { console.error(`Gagal parsing data dari localStorage (kunci: ${key}):`, e); return null; }
        }
        return null;
    }

    function countPoints(scoreString, pointValue) {
        if (!scoreString || scoreString === '.') return 0;
        return scoreString.split(' ').filter(p => p == pointValue).length;
    }

    function updateRekapJuri() {
        // Loop untuk setiap juri (J1, J2, J3)
        for (let i = 1; i <= 3; i++) {
            const juriStorageKey = `juriScoreHistory_juri${i}_match${pertandinganId}`;
            const juriData = getStorageData(juriStorageKey);
            
            // Siapkan variabel untuk menjumlahkan total dari semua ronde
            let totalBiruPukul = 0, totalBiruTendang = 0;
            let totalMerahPukul = 0, totalMerahTendang = 0;
            
            if (juriData) {
                // Loop melalui setiap ronde yang mungkin (1, 2, 3) di dalam data juri
                for (let ronde = 1; ronde <= 3; ronde++) {
                    const blueScores = juriData.history.blue[ronde] || '';
                    const redScores = juriData.history.red[ronde] || '';
                    
                    // Tambahkan jumlah poin dari ronde ini ke total
                    totalBiruPukul += countPoints(blueScores, 1);
                    totalBiruTendang += countPoints(blueScores, 2);
                    totalMerahPukul += countPoints(redScores, 1);
                    totalMerahTendang += countPoints(redScores, 2);
                }
            }

            // Setelah semua ronde dijumlahkan, update tampilan untuk juri ini
            document.getElementById(`biruPukul${i}`).value = totalBiruPukul;
            document.getElementById(`biruTendang${i}`).value = totalBiruTendang;
            document.getElementById(`merahPukul${i}`).value = totalMerahPukul;
            document.getElementById(`merahTendang${i}`).value = totalMerahTendang;
        }
    }
    
    // Panggil update saat halaman dimuat
    updateRekapJuri();

    // Set interval untuk terus memperbarui data JURI setiap 2 detik
    setInterval(updateRekapJuri, 2000);
});
</script>
</body>
</html>
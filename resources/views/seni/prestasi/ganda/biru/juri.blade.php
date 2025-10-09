<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Pertandingan Silat Ganda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: 'Inter', sans-serif; }
        button:disabled, select:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">

    @php
        // ==============================================================================
        // LOGIKA HYBRID UNTUK MENDUKUNG DATA LAMA & BARU
        // ==============================================================================
        $requestedUnitParam = request('unit', 'unit_1');

        // Cek apakah ini data format lama
        if ($pertandingan->unit1_id) {
            $unit1_peserta = $pertandingan->pemain_unit_1;
            $unit2_peserta = $pertandingan->pemain_unit_2;
            $selectedPeserta = ($requestedUnitParam == 'unit_1') ? $unit1_peserta : $unit2_peserta;
            $selectedUnitId = ($requestedUnitParam == 'unit_1') ? $pertandingan->unit1_id : $pertandingan->unit2_id;
        } else {
            // Gunakan logika baru
            $allPeserta = $pertandingan->grouped_peserta;
            preg_match('/(\d+)/', $requestedUnitParam, $matches);
            $requestedIndex = isset($matches[1]) ? (int)$matches[1] - 1 : 0;
            
            $unitIdArray = $allPeserta->keys()->values();
            $unitDataArray = $allPeserta->values();
            
            $selectedUnitId = $unitIdArray->get($requestedIndex);
            $selectedPeserta = $unitDataArray->get($requestedIndex, collect());
        }

        // Kondisi untuk menonaktifkan tombol (tidak berubah)
        $isSubmitted = ($detail_poin->is_dinilai ?? false) || ($detail_poin->status == 1);
    @endphp
    
    <!-- Input tersembunyi -->
    <input type="hidden" id="pertandingan_id" value="{{ $pertandingan->id ?? '0' }}">
    <input type="hidden" id="juri_id" value="{{ $user->id ?? '0' }}">
    <input type="hidden" id="role_juri" value="{{ $user->role->name ?? '0' }}">
    <input type="hidden" name="unit_id" id="unit_id" value="{{ $selectedUnitId }}">
    <input type="hidden" id="initial-teknik" value="{{ $detail_poin->teknik_dasar ?? 0.00 }}">
    <input type="hidden" id="initial-kekuatan" value="{{ $detail_poin->kekuatan_kecepatan ?? 0.00 }}">
    <input type="hidden" id="initial-penampilan" value="{{ $detail_poin->penampilan_gaya ?? 0.00 }}">

    <!-- Header -->
    <header class="bg-white border-b border-gray-200 p-4">
        <div class="flex justify-between items-center max-w-6xl mx-auto">
            <h1 class="text-center font-bold text-xl">Penilaian Seni Ganda</h1>
            <div class="text-right">
                @if(isset($selectedPeserta) && $selectedPeserta->isNotEmpty())
                    <div class="font-semibold">
                        @foreach($selectedPeserta as $peserta)
                            <span>{{ $peserta->player->name }}</span>{{ !$loop->last ? ' & ' : '' }}
                        @endforeach
                    </div>
                    <div class="text-sm text-gray-600">{{ $selectedPeserta->first()->player->contingent->name }}</div>
                @endif
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="h-[calc(100vh-80px)] p-4">
        <div class="grid grid-cols-3 gap-4 h-full">
            <!-- Scoring Categories -->
            <div class="col-span-2 grid grid-rows-3 gap-3">
                <!-- Kategori 1: Teknik Dasar -->
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center justify-between mb-3">
                        
                        {{-- Dropdown dengan logika hybrid --}}
                        <select name="unit" id="unit" class="border-gray-300 rounded-md shadow-sm">
                            @if ($pertandingan->unit1_id)
                                <option value="unit_1" {{ $requestedUnitParam == 'unit_1' ? 'selected' : '' }}>Unit 1</option>
                                <option value="unit_2" {{ $requestedUnitParam == 'unit_2' ? 'selected' : '' }}>Unit 2</option>
                            @else
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

                        <h3 class="font-bold text-gray-800">TEKNIK DASAR</h3>
                        <div class="text-right">
                            <div class="text-xs text-gray-500">SCORE</div>
                            <div class="text-xl font-bold text-blue-600" id="teknik-score">0.00</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-10 gap-1" id="teknik-buttons"></div>
                </div>

                {{-- Sisa kategori tidak berubah --}}
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-bold text-gray-800">KEKUATAN & KECEPATAN</h3>
                        <div class="text-right">
                            <div class="text-xs text-gray-500">SCORE</div>
                            <div class="text-xl font-bold text-blue-600" id="kekuatan-score">0.00</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-10 gap-1" id="kekuatan-buttons"></div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-bold text-gray-800">PENAMPILAN & GAYA</h3>
                        <div class="text-right">
                            <div class="text-xs text-gray-500">SCORE</div>
                            <div class="text-xl font-bold text-blue-600" id="penampilan-score">0.00</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-10 gap-1" id="penampilan-buttons"></div>
                </div>
            </div>

            <!-- Total Score -->
            <div class="bg-white rounded-lg shadow p-6 flex flex-col justify-center text-center">
                <h2 class="text-xl font-bold text-gray-800 mb-4">TOTAL SCORE</h2>
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-lg p-6 mb-4">
                    <div class="text-5xl font-bold" id="total-score">9.10</div>
                    <div class="text-blue-100 mt-1">/ 10.00</div>
                </div>
                
                <button id="submit-button" onclick="submitFinalScore({{ $detail_poin->id }})" 
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors"
                        {{ $isSubmitted ? 'disabled' : '' }}>
                    {{ $isSubmitted ? 'Telah Disubmit' : 'Submit Penilaian' }}
                </button>
            </div>
        </div>
    </main>

    {{-- JavaScript tidak perlu diubah --}}
    <script>
        const IS_SUBMITTED = {{ $isSubmitted ? 'true' : 'false' }};
        
        function submitFinalScore(detail_poin_id) {
            if (IS_SUBMITTED) {
                alert('Penilaian sudah disubmit dan tidak bisa diubah.');
                return;
            }
            if (confirm('Apakah anda yakin untuk submit nilai?')) {
                fetch(`/scoring/submit_penilaian_juri/${detail_poin_id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        tipe_penilaian: 'ganda',
                    })
                })
                .then(response => response.json())
                .then(data => {
                        alert('Nilai akhir berhasil disubmit!');
                        console.log(data); 
                        window.location.reload();
                });
            }
        }

        const BASE_SCORE=9.10;let isLoading=!1;const PERTANDINGAN_ID=document.getElementById("pertandingan_id").value,JURI_ID=document.getElementById("juri_id").value,ROLE_JURI=document.getElementById("role_juri").value;let scores={teknik:parseFloat(document.getElementById("initial-teknik").value)||0,kekuatan:parseFloat(document.getElementById("initial-kekuatan").value)||0,penampilan:parseFloat(document.getElementById("initial-penampilan").value)||0};function toggleAllButtons(e){if(IS_SUBMITTED)return;isLoading=e;document.querySelectorAll("button").forEach(t=>{t.disabled=e,t.classList.toggle("opacity-75",e),t.classList.toggle("cursor-wait",e)})}
        function kirimPoinSeni(e,t){if(IS_SUBMITTED)return;isLoading?console.log("Request sedang diproses, mohon tunggu..."):(toggleAllButtons(!0),fetch(`/kirim-poin-seni/${JURI_ID}`,{method:"POST",headers:{"X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content"),"Content-Type":"application/json"},body:JSON.stringify({poin:t,type:e,filter:"penilaian_ganda",pertandingan_id:PERTANDINGAN_ID,role:ROLE_JURI,unit_id:document.getElementById("unit_id").value})}).then(e=>e.ok?e.json():Promise.reject("Network response was not ok")).then(t=>console.log(`Data untuk ${e} berhasil dikirim:`,t)).catch(e=>{console.error("Fetch error:",e),alert("Terjadi kesalahan saat mengirim data. Silakan coba lagi.")}).finally(()=>toggleAllButtons(!1)))}
        function generateButtons(e,t){const n=document.getElementById(e);if(!n)return;n.innerHTML="";for(let l=1;l<=30;l++){const o=parseFloat((.01*l).toFixed(2)),s=document.createElement("button");s.textContent=o.toFixed(2),s.className=scores[t]===o?"w-8 h-8 border-2 border-blue-600 bg-blue-600 text-white rounded text-xs font-bold transition-colors focus:outline-none":"w-8 h-8 border border-gray-300 rounded text-xs font-medium hover:bg-blue-100 hover:border-blue-300 transition-colors focus:outline-none",s.onclick=()=>selectScore(t,o,s,e),IS_SUBMITTED&&(s.disabled=!0),n.appendChild(s)}}
        function selectScore(e,t,n,l){if(IS_SUBMITTED)return;document.getElementById(l).querySelectorAll("button").forEach(e=>{e.className="w-8 h-8 border border-gray-300 rounded text-xs font-medium hover:bg-blue-100 hover:border-blue-300 transition-colors focus:outline-none"}),n.className="w-8 h-8 border-2 border-blue-600 bg-blue-600 text-white rounded text-xs font-bold transition-colors focus:outline-none",scores[e]=t,document.getElementById(e+"-score").textContent=t.toFixed(2),updateTotal(),kirimPoinSeni(e,t)}
        function updateTotal(){const e=BASE_SCORE+scores.teknik+scores.kekuatan+scores.penampilan;document.getElementById("total-score").textContent=e.toFixed(2)}
        function initializeUI(){document.getElementById("teknik-score").textContent=scores.teknik.toFixed(2),document.getElementById("kekuatan-score").textContent=scores.kekuatan.toFixed(2),document.getElementById("penampilan-score").textContent=scores.penampilan.toFixed(2),generateButtons("teknik-buttons","teknik"),generateButtons("kekuatan-buttons","kekuatan"),generateButtons("penampilan-buttons","penampilan"),updateTotal()}
        document.addEventListener("DOMContentLoaded",initializeUI);
    </script>
</body>
</html>
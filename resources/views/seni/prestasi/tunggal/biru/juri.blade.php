<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Scoring Pencak Silat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="container mx-auto p-4 max-w-7xl">

        {{-- Input-input tersembunyi (tidak berubah) --}}
        <input type="hidden" id="total-jurus-value" value="{{ $total_jurus }}">
        <input type="hidden" name="filter" id="filter" value="penilaian_tunggal_regu">
        <input type="hidden" id="initial-total-kesalahan" value="{{ $detail_poin->total_kesalahan ?? 0.00 }}">
        <input type="hidden" id="initial-poin-stamina" value="{{ $detail_poin->poin_stamina ?? 0.00 }}">

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
                $requestedIndex = ($requestedUnitParam == 'unit_1') ? 0 : 1;
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
        @endphp

        <!-- Header -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                        AS
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Unit {{ $requestedIndex + 1 }}</h2>
                        <input type="hidden" name="unit_id" id="unit_id" value="{{ $selectedUnitId }}">

                        @if(isset($selectedPeserta) && $selectedPeserta->isNotEmpty())
                            @foreach($selectedPeserta as $peserta)
                                <p class="text-gray-600">{{ $peserta->player->name }}</p>
                            @endforeach
                            <p class="text-sm text-gray-500 mt-1">{{ $selectedPeserta->first()->player->contingent->name }}</p>
                        @endif
                    </div>
                </div>

                {{ $user->role->name }}

                <div class="text-right">
                     <select name="unit" id="unit" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mb-2">
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

                    <h1 class="text-2xl font-bold text-blue-600">{{ $pertandingan->kelasPertandingan->kelas->nama_kelas }}</h1>
                    <p class="text-gray-600">
                        {{ $pertandingan->kelasPertandingan->kategoriPertandingan->nama_kategori }} 
                        {{ $pertandingan->kelasPertandingan->jenisPertandingan->nama_jenis }} 
                    </p>
                </div>
            </div>
        </div>
        
        {{-- Sisa dari file tidak perlu diubah, karena semua sudah mengacu pada --}}
        {{-- variabel yang sudah disiapkan di atas. --}}
        
        <!-- Main Grid (3 columns) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Wrong Move Card -->
            <div class="bg-red-500 rounded-xl shadow-md p-8 flex flex-col items-center justify-center min-h-64">
                <button id="wrongMoveBtn" class="text-white font-bold py-8 px-12 text-3xl transition-colors duration-200 w-full h-full" onclick="kirimPoinSeni('wrong_move', -0.01)" {{ isset($detail_poin) && $detail_poin->status == 1 ? ' disabled' : '' }}>
                    <div class="text-6xl mb-4">✗</div>
                    Wrong Move
                </button>
            </div>

            <!-- Center Info Card -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="text-center mb-6">
                    <h3 class="text-3xl font-bold text-blue-600 mb-2">Jurus ke: <span id="currentMove">1</span></h3>
                    <p class="text-xl text-red-500 font-semibold">Kesalahan: <span id="currentErrors">0</span> (Jurus ini)</p>
                </div>
                <div class="mb-4">
                    <h4 class="text-lg font-semibold text-gray-700 mb-3">Kemantapan / Penghayatan / Stamina</h4>
                    <div class="grid grid-cols-5 gap-2" id="scoreButtons"></div>
                </div>
                <div class="text-center">
                    <p class="text-sm text-gray-600">Nilai Kategori: <span id="categoryScore" class="font-bold text-green-600">0.00</span></p>
                </div>
            </div>

            <!-- Next Move Card -->
            <div class="bg-green-500 rounded-xl shadow-md p-8 flex flex-col items-center justify-center min-h-64">
                <button id="nextMoveBtn" class="text-white font-bold py-8 px-12 text-3xl transition-colors duration-200 w-full h-full">
                    <div class="text-6xl mb-4">→</div>
                    Next Move
                </button>
            </div>
        </div>

        <!-- Bottom Grid (2 columns) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Total Errors Card -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Total Kesalahan</h3>
                <div class="text-center">
                    <div class="text-5xl font-bold text-red-500" id="totalErrors">0</div>
                    <p class="text-gray-600 mt-2">Kesalahan dari semua jurus</p>
                </div>
            </div>

            <div class="bg-yellow-500 rounded-xl shadow-md p-6">
                <button id="selesaiBtn" 
                        onclick="if(confirm('Apakah Anda yakin ingin submit nilai?')) submitFinalScore({{ $detail_poin->id ?? 'null' }})" 
                        class="text-white font-bold py-8 px-12 text-3xl transition-colors duration-200 w-full h-full" {{ isset($detail_poin) && $detail_poin->status == 1 ? ' disabled' : '' }}>
                    Submit
                </button>
            </div>

            <!-- Final Score Card -->
            <div class="bg-blue-500 rounded-xl shadow-md p-6">
                <h3 class="text-xl font-semibold text-white mb-4 text-center">TOTAL NILAI AKHIR</h3>
                <div class="text-center">
                    <div class="text-6xl font-bold text-white" id="finalScore">9.90</div>
                    <input type="hidden" id="nilaiAkhir" value="9.90">
                    <p class="text-red-100 mt-2">Nilai Final</p>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript tidak perlu diubah --}}
    <script>
        function submitFinalScore(detail_poin_id) {
            fetch(`/scoring/submit_penilaian_juri/${detail_poin_id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    tipe_penilaian: 'tunggal_regu',
                })
            })
            .then(response => response.json())
            .then(data => {
                    document.getElementById('selesaiBtn').disabled = true;
                    document.getElementById('wrongMoveBtn').disabled = true;
                    document.getElementById('wrongMoveBtn').classList.add('opacity-50', 'cursor-not-allowed');
                    document.getElementById('selesaiBtn').classList.add('opacity-50', 'cursor-not-allowed');    
                    console.log(data); 
            });
        }
        const TOTAL_JURUS = parseInt(document.getElementById('total-jurus-value').value) || 14;
        const initialTotalKesalahan = parseFloat(document.getElementById('initial-total-kesalahan').value) || 0;
        const initialPoinStamina = parseFloat(document.getElementById('initial-poin-stamina').value) || 0;
        let currentMove = 1;
        let moveErrors = {};
        let totalCategoryScore = initialPoinStamina;
        const penaltyPerError = 0.01;
        const baseScore = 9.90;
        const initialErrorClicks = Math.round(initialTotalKesalahan / penaltyPerError);
        moveErrors[currentMove] = initialErrorClicks;
        const currentMoveEl = document.getElementById('currentMove');
        const currentErrorsEl = document.getElementById('currentErrors');
        const totalErrorsEl = document.getElementById('totalErrors');
        const finalScoreEl = document.getElementById('finalScore');
        const categoryScoreEl = document.getElementById('categoryScore');
        const wrongMoveBtn = document.getElementById('wrongMoveBtn');
        const nextMoveBtn = document.getElementById('nextMoveBtn');
        const scoreButtonsContainer = document.getElementById('scoreButtons');
        function generateScoreButtons(){scoreButtonsContainer.innerHTML='';if(currentMove<=TOTAL_JURUS){for(let i=1;i<=10;i++){const score=(i*0.01).toFixed(2);const button=document.createElement('button');button.disabled={{ isset($detail_poin) && $detail_poin->status == 1 ? 'true' : 'false' }};if(totalCategoryScore===parseFloat(score)){button.className='px-3 py-2 rounded-full text-sm font-medium transition-colors duration-200 bg-green-500 hover:bg-green-600 text-white'}else{button.className='px-3 py-2 rounded-full text-sm font-medium transition-colors duration-200 bg-gray-200 hover:bg-gray-300 text-gray-700'}
        button.textContent=score;button.onclick=()=>{selectScore(button,parseFloat(score));kirimPoinSeni('flow_stamina',parseFloat(score))};scoreButtonsContainer.appendChild(button)}}else{const message=document.createElement('div');message.className='text-center text-gray-500 italic py-4';message.textContent=`Nilai kategori hanya untuk jurus 1-${TOTAL_JURUS}`;scoreButtonsContainer.appendChild(message)}}
        function selectScore(button,score){if(currentMove>TOTAL_JURUS){return}
        const buttons=scoreButtonsContainer.querySelectorAll('button');buttons.forEach(btn=>{btn.className='px-3 py-2 rounded-full text-sm font-medium transition-colors duration-200 bg-gray-200 hover:bg-gray-300 text-gray-700'});button.className='px-3 py-2 rounded-full text-sm font-medium transition-colors duration-200 bg-green-500 hover:bg-green-600 text-white';totalCategoryScore=score;categoryScoreEl.textContent=score.toFixed(2);updateDisplay()}
        function getTotalErrors(){return Object.values(moveErrors).reduce((sum,errors)=>sum+errors,0)}
        function updateDisplay(){currentMoveEl.textContent=currentMove;currentErrorsEl.textContent=moveErrors[currentMove]||0;const totalErrors=getTotalErrors();totalErrorsEl.textContent=totalErrors;const finalScore=Math.max(0,baseScore-(totalErrors*penaltyPerError)+totalCategoryScore);finalScoreEl.textContent=finalScore.toFixed(2);document.getElementById('nilaiAkhir').value=finalScore.toFixed(2);if(currentMove>=TOTAL_JURUS){nextMoveBtn.disabled=true;nextMoveBtn.classList.add('opacity-50','cursor-not-allowed')}else{nextMoveBtn.disabled=false;nextMoveBtn.classList.remove('opacity-50','cursor-not-allowed')}}
        wrongMoveBtn.addEventListener('click',()=>{if(currentMove>TOTAL_JURUS)return;if(!moveErrors[currentMove]){moveErrors[currentMove]=0}
        moveErrors[currentMove]++;updateDisplay();wrongMoveBtn.classList.add('scale-95');setTimeout(()=>wrongMoveBtn.classList.remove('scale-95'),150)});nextMoveBtn.addEventListener('click',()=>{if(currentMove>=TOTAL_JURUS)return;currentMove++;moveErrors[currentMove]=0;updateDisplay();generateScoreButtons();categoryScoreEl.textContent=totalCategoryScore.toFixed(2);nextMoveBtn.classList.add('scale-95');setTimeout(()=>nextMoveBtn.classList.remove('scale-95'),150)});generateScoreButtons();updateDisplay();
    </script>
    <script src="/assets/js/event_seni.js"></script>
</body>
</html>
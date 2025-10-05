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

        {{-- {{ $user->role->name }} --}}
        {{-- <input type="hidden" name="role_juri" id="role_juri" value="{{ $user->role->name }}"> --}}
        <input type="hidden" id="total-jurus-value" value="{{ $total_jurus }}">
        <input type="hidden" name="filter" id="filter" value="penilaian_tunggal_regu">



        {{-- detail poin --}}
        <input type="hidden" id="initial-total-kesalahan" value="{{ $detail_poin->total_kesalahan ?? 0.00 }}">
        <input type="hidden" id="initial-poin-stamina" value="{{ $detail_poin->poin_stamina ?? 0.00 }}">
        <!-- Header -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                        AS
                    </div>
                    <div>
                        {{ $_GET['unit'] == 'unit_1' ? 'Unit 1' : 'Unit 2' }}

                        @if($_GET['unit'] == 'unit_1')

                        <input type="hidden" name="unit_id" id="unit_id" value="{{ $pertandingan->unit1_id }}">
                        {{-- {{ $pertandingan->pemain_unit_1 }} --}}
                        @foreach($pertandingan->pemain_unit_1 as $unit)

                        <h2 class="text-xl font-bold text-gray-800">{{ $unit->player->name }}</h2>
                        <p class="text-gray-600">{{ $unit->player->contingent->name }}</p>

                        @endforeach

                        @else

                        <input type="hidden" name="unit_id" id="unit_id" value="{{ $pertandingan->unit2_id }}">
                        {{-- {{ $pertandingan->pemain_unit_2 }} --}}
                        @foreach($pertandingan->pemain_unit_2 as $unit)

                        <h2 class="text-xl font-bold text-gray-800">{{ $unit->player->name }}</h2>
                        <p class="text-gray-600">{{ $unit->player->contingent->name }}</p>
                        
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="text-right">
                     <select name="unit" id="unit">
    <option value="unit_1" {{ request('unit') == 'unit_1' ? 'selected' : '' }}>Unit 1</option>
    <option value="unit_2" {{ request('unit') == 'unit_2' ? 'selected' : '' }}>Unit 2</option>
</select>

     <script>
                    document.getElementById('unit').addEventListener('change', function () {
    const selected = this.value; // ambil value option
    // misalnya default path /1
    const newUrl = "?unit=" + encodeURIComponent(selected);
    window.location.href = newUrl; // redirect (otomatis refresh)
});
                </script>
                    <h1 class="text-2xl font-bold text-blue-600">{{ $pertandingan->kelasPertandingan->kelas->nama_kelas }}</h1>
                    <p class="text-gray-600">{{ $pertandingan->kelasPertandingan->kategoriPertandingan->nama_kategori }} 
                        {{ $pertandingan->kelasPertandingan->jenisPertandingan->nama_jenis }} 
                        
                    </p>
                </div>
            </div>
        </div>

        <!-- Main Grid (3 columns) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Wrong Move Card -->
            <div class="bg-red-500 rounded-xl shadow-md p-8 flex flex-col items-center justify-center min-h-64">
                <button id="wrongMoveBtn" class="text-white font-bold py-8 px-12 text-3xl transition-colors duration-200 w-full h-full" onclick="kirimPoinSeni('wrong_move', -0.01)">
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
                    <div class="grid grid-cols-5 gap-2" id="scoreButtons">
                        <!-- Score buttons will be generated by JavaScript -->
                    </div>
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
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Total Errors Card -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Total Kesalahan</h3>
                <div class="text-center">
                    <div class="text-5xl font-bold text-red-500" id="totalErrors">0</div>
                    <p class="text-gray-600 mt-2">Kesalahan dari semua jurus</p>
                </div>
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


  {{-- ... bagian HTML Anda ... --}}

<script>
    // =====================================================================
    // KONFIGURASI & STATE
    // =====================================================================
    
    // AMBIL NILAI DINAMIS DARI HTML
    const TOTAL_JURUS = parseInt(document.getElementById('total-jurus-value').value) || 14; // Default ke 14 jika tidak ada

     const initialTotalKesalahan = parseFloat(document.getElementById('initial-total-kesalahan').value) || 0;
    const initialPoinStamina = parseFloat(document.getElementById('initial-poin-stamina').value) || 0;

    let currentMove = 1;
    let moveErrors = {}; // Lacak kesalahan per jurus
    let totalCategoryScore = initialPoinStamina; // Skor Kategori Stamina
    const penaltyPerError = 0.01;
    const baseScore = 9.90;

    // Inisialisasi jurus pertama
    const initialErrorClicks = Math.round(initialTotalKesalahan / penaltyPerError);
    moveErrors[currentMove] = initialErrorClicks;
    // =====================================================================
    // SELEKSI ELEMEN DOM
    // =====================================================================
    const currentMoveEl = document.getElementById('currentMove');
    const currentErrorsEl = document.getElementById('currentErrors');
    const totalErrorsEl = document.getElementById('totalErrors');
    const finalScoreEl = document.getElementById('finalScore');
    const categoryScoreEl = document.getElementById('categoryScore');
    const wrongMoveBtn = document.getElementById('wrongMoveBtn');
    const nextMoveBtn = document.getElementById('nextMoveBtn');
    const scoreButtonsContainer = document.getElementById('scoreButtons');

    // =====================================================================
    // FUNGSI UTAMA
    // =====================================================================

    /**
     * Generate tombol skor (0.01 - 0.10).
     * Tombol hanya aktif jika jurus saat ini <= TOTAL_JURUS.
     */
    function generateScoreButtons() {
        scoreButtonsContainer.innerHTML = '';
        
        // DIUBAH: Gunakan TOTAL_JURUS sebagai batas
        if (currentMove <= TOTAL_JURUS) {
            for (let i = 1; i <= 10; i++) {
                const score = (i * 0.01).toFixed(2);
                const button = document.createElement('button');
                
                if (totalCategoryScore === parseFloat(score)) {
                    button.className = 'px-3 py-2 rounded-full text-sm font-medium transition-colors duration-200 bg-green-500 hover:bg-green-600 text-white';
                } else {
                    button.className = 'px-3 py-2 rounded-full text-sm font-medium transition-colors duration-200 bg-gray-200 hover:bg-gray-300 text-gray-700';
                }
                
                button.textContent = score;
                button.onclick = () => {
                    selectScore(button, parseFloat(score));
                    kirimPoinSeni('flow_stamina', parseFloat(score));
                };
                scoreButtonsContainer.appendChild(button);
            }
        } else {
            // Tampilkan pesan nonaktif jika sudah melewati batas jurus
            const message = document.createElement('div');
            message.className = 'text-center text-gray-500 italic py-4';
            message.textContent = `Nilai kategori hanya untuk jurus 1-${TOTAL_JURUS}`;
            scoreButtonsContainer.appendChild(message);
        }
    }

    /**
     * Fungsi saat tombol skor dipilih.
     */
    function selectScore(button, score) {
        // DIUBAH: Gunakan TOTAL_JURUS sebagai batas
        if (currentMove > TOTAL_JURUS) {
            return;
        }
        
        const buttons = scoreButtonsContainer.querySelectorAll('button');
        buttons.forEach(btn => {
            btn.className = 'px-3 py-2 rounded-full text-sm font-medium transition-colors duration-200 bg-gray-200 hover:bg-gray-300 text-gray-700';
        });
        
        button.className = 'px-3 py-2 rounded-full text-sm font-medium transition-colors duration-200 bg-green-500 hover:bg-green-600 text-white';
        
        totalCategoryScore = score;
        categoryScoreEl.textContent = score.toFixed(2);
        updateDisplay();
    }

    /**
     * Menghitung total kesalahan dari semua jurus.
     */
    function getTotalErrors() {
        return Object.values(moveErrors).reduce((sum, errors) => sum + errors, 0);
    }

    /**
     * Memperbarui semua tampilan di layar.
     */
    function updateDisplay() {
        currentMoveEl.textContent = currentMove;
        currentErrorsEl.textContent = moveErrors[currentMove] || 0;
        
        const totalErrors = getTotalErrors();
        totalErrorsEl.textContent = totalErrors;
        
        const finalScore = Math.max(0, baseScore - (totalErrors * penaltyPerError) + totalCategoryScore);
        finalScoreEl.textContent = finalScore.toFixed(2);
        document.getElementById('nilaiAkhir').value = finalScore.toFixed(2);

        // Nonaktifkan tombol 'Next Move' jika sudah mencapai jurus terakhir
        if (currentMove >= TOTAL_JURUS) {
            nextMoveBtn.disabled = true;
            nextMoveBtn.classList.add('opacity-50', 'cursor-not-allowed');
        } else {
            nextMoveBtn.disabled = false;
            nextMoveBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        }
    }

    // =====================================================================
    // EVENT LISTENERS
    // =====================================================================

    // Handler tombol "Wrong move"
    wrongMoveBtn.addEventListener('click', () => {
        // Hanya bisa menambah kesalahan jika belum melewati batas jurus
        if (currentMove > TOTAL_JURUS) return;

        if (!moveErrors[currentMove]) {
            moveErrors[currentMove] = 0;
        }
        moveErrors[currentMove]++;
        updateDisplay();
        
        wrongMoveBtn.classList.add('scale-95');
        setTimeout(() => wrongMoveBtn.classList.remove('scale-95'), 150);
    });

    // Handler tombol "Next move"
    nextMoveBtn.addEventListener('click', () => {
        // Pastikan tidak melewati batas
        if (currentMove >= TOTAL_JURUS) return;
        
        currentMove++;
        moveErrors[currentMove] = 0;
        
        // Panggil updateDisplay() SEBELUM generateScoreButtons()
        // agar tombol 'Next Move' bisa dinonaktifkan tepat pada jurus terakhir.
        updateDisplay(); 
        
        generateScoreButtons();
        categoryScoreEl.textContent = totalCategoryScore.toFixed(2);
        
        nextMoveBtn.classList.add('scale-95');
        setTimeout(() => nextMoveBtn.classList.remove('scale-95'), 150);
    });

    // =====================================================================
    // INISIALISASI
    // =====================================================================
    generateScoreButtons();
    updateDisplay();
</script>


{{-- ... sisa kode ... --}}
    <script src="/assets/js/event_seni.js"></script>


<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'97ac9dcc870e4112',t:'MTc1NzE0NzU1My4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>

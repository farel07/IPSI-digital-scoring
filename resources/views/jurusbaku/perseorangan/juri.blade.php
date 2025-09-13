<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Pencak Silat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen px-4 py-3">
    <div class="max-w-7xl mx-auto space-y-6">
        
        <!-- Bagian Utama (Scoring) -->
        <div class="space-y-2">
            
            <!-- Header Profil & Kategori -->
            <div class="bg-white rounded-2xl shadow-lg p-3">
                <div class="flex justify-between items-start mb-2">
                    <!-- Profil Atlet -->
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center text-white text-xl font-bold">
                            AS
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Ahmad Syahrul</h2>
                            <p class="text-gray-600">Kontingen DKI Jakarta</p>
                        </div>
                    </div>
                    
                    <!-- Kategori -->
                    <div class="text-right">
                        <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-semibold">
                            Dewasa Tunggal Putra
                        </span>
                    </div>
                </div>
                
                <!-- Layout 3 Kolom Utama -->
                <div class="grid grid-cols-3 gap-4 mb-3">
                    
                    <!-- Kiri - Wrong Move -->
                    <button id="wrongMoveBtn" class="bg-red-500 hover:bg-red-600 rounded-2xl text-center text-white transition-colors w-full">
                        <div class="text-4xl mb-2">❌</div>
                        <div class="text-lg font-bold">Wrong Move</div>
                    </button>
                    
                    <!-- Tengah - Info Jurus -->
                    <div class="bg-white border-2 border-gray-200 rounded-2xl p-6 text-center">
                        <div class="text-lg font-bold text-gray-800 mb-2">
                            Jurus ke: <span id="currentMove">1</span>
                        </div>
                        <div class="text-sm text-gray-600 mb-2">
                            Kesalahan: <span id="currentMoveErrors">0</span>
                        </div>
                        
                        <!-- Judul Tombol Nilai Kategori -->
                        <div class="text-xs font-semibold text-gray-700 mb-2 text-center">
                            Kemantapan / Penghayatan / Stamina
                        </div>
                        
                        <!-- Tombol Nilai Kategori -->
                        <div class="grid grid-cols-5 gap-1 mb-4">
                            <button class="score-btn bg-gray-200 hover:bg-blue-500 hover:text-white px-2 py-1 rounded text-xs transition-colors" data-score="0.01">0.01</button>
                            <button class="score-btn bg-gray-200 hover:bg-blue-500 hover:text-white px-2 py-1 rounded text-xs transition-colors" data-score="0.02">0.02</button>
                            <button class="score-btn bg-gray-200 hover:bg-blue-500 hover:text-white px-2 py-1 rounded text-xs transition-colors" data-score="0.03">0.03</button>
                            <button class="score-btn bg-gray-200 hover:bg-blue-500 hover:text-white px-2 py-1 rounded text-xs transition-colors" data-score="0.04">0.04</button>
                            <button class="score-btn bg-gray-200 hover:bg-blue-500 hover:text-white px-2 py-1 rounded text-xs transition-colors" data-score="0.05">0.05</button>
                            <button class="score-btn bg-gray-200 hover:bg-blue-500 hover:text-white px-2 py-1 rounded text-xs transition-colors" data-score="0.06">0.06</button>
                            <button class="score-btn bg-gray-200 hover:bg-blue-500 hover:text-white px-2 py-1 rounded text-xs transition-colors" data-score="0.07">0.07</button>
                            <button class="score-btn bg-gray-200 hover:bg-blue-500 hover:text-white px-2 py-1 rounded text-xs transition-colors" data-score="0.08">0.08</button>
                            <button class="score-btn bg-gray-200 hover:bg-blue-500 hover:text-white px-2 py-1 rounded text-xs transition-colors" data-score="0.09">0.09</button>
                            <button class="score-btn bg-gray-200 hover:bg-blue-500 hover:text-white px-2 py-1 rounded text-xs transition-colors" data-score="0.10">0.10</button>
                        </div>
                        
                        <div class="text-sm font-semibold text-gray-700">
                            Total Kategori: <span id="categoryTotal">0.00</span>
                        </div>
                    </div>
                    
                    <!-- Kanan - Next Move -->
                    <button id="nextMoveBtn" class="bg-green-500 hover:bg-green-600 rounded-2xl text-center text-white transition-colors w-full">
                        <div class="text-4xl mb-2">➡️</div>
                        <div class="text-lg font-bold">Next Move</div>
                    </button>
                </div>
                
                <!-- Total Kesalahan & Nilai Akhir -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-red-50 border-2 border-red-200 rounded-2xl p-1 text-center">
                        <div class="text-sm text-red-600 mb-1">Total Kesalahan</div>
                        <div class="text-2xl font-bold text-red-700" id="totalErrors">0</div>
                    </div>
                    <div class="bg-green-50 border-2 border-green-200 rounded-2xl p-1 text-center">
                        <div class="text-sm text-green-600 mb-1">Total Nilai Akhir</div>
                        <div class="text-2xl font-bold text-green-700" id="finalScore">9.90</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bagian Penalty Table -->
        <div class="bg-white rounded-2xl shadow-lg px-3 pt-3 pb-1" style="margin-top: 10px; !important">
            <h3 class="text-xl font-bold text-gray-800 mb-1">Penalty Table</h3>
            
            <div class="space-y-3">
                <!-- Penalty Items -->
                <div class="penalty-row grid grid-cols-3 gap-2 items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-700">WAKTU PERAGAAN LEBIH DARI 3 MENIT (MINUS) 1 PERDETIK</span>
                    <div class="flex gap-1">
                        <button class="penalty-clear bg-blue-500 hover:bg-blue-600 text-white px-10 py-8 rounded text-xs transition-colors" data-penalty="waktu">Clear</button>
                        <button class="penalty-minus bg-red-500 hover:bg-red-600 text-white px-10 py-8 rounded text-xs transition-colors" data-penalty="waktu" data-value="-0.50">-0.50</button>
                    </div>
                    <span class="penalty-value text-sm font-bold text-right" id="penalty-waktu">0.00</span>
                </div>
                
                <div class="penalty-row grid grid-cols-3 gap-2 items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-700">PAKAIAN TIDAK STANDAR</span>
                    <div class="flex gap-1">
                        <button class="penalty-clear bg-blue-500 hover:bg-blue-600 text-white px-10 py-8 rounded text-xs transition-colors" data-penalty="garis">Clear</button>
                        <button class="penalty-minus bg-red-500 hover:bg-red-600 text-white px-10 py-8 rounded text-xs transition-colors" data-penalty="garis" data-value="-0.50">-0.50</button>
                    </div>
                    <span class="penalty-value text-sm font-bold text-right" id="penalty-garis">0.00</span>
                </div>
                
                {{-- <div class="penalty-row grid grid-cols-3 gap-2 items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-700">PAKAIAN</span>
                    <div class="flex gap-1">
                        <button class="penalty-clear bg-blue-500 hover:bg-blue-600 text-white px-7 py-1 rounded text-xs transition-colors" data-penalty="pakaian">Clear</button>
                        <button class="penalty-minus bg-red-500 hover:bg-red-600 text-white px-7 py-1 rounded text-xs transition-colors" data-penalty="pakaian" data-value="-0.50">-0.50</button>
                    </div>
                    <span class="penalty-value text-sm font-bold text-right" id="penalty-pakaian">0.00</span>
                </div>
                
                <div class="penalty-row grid grid-cols-3 gap-2 items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-700">SENJATA JATUH</span>
                    <div class="flex gap-1">
                        <button class="penalty-clear bg-blue-500 hover:bg-blue-600 text-white px-7 py-1 rounded text-xs transition-colors" data-penalty="senjata">Clear</button>
                        <button class="penalty-minus bg-red-500 hover:bg-red-600 text-white px-7 py-1 rounded text-xs transition-colors" data-penalty="senjata" data-value="-0.50">-0.50</button>
                    </div>
                    <span class="penalty-value text-sm font-bold text-right" id="penalty-senjata">0.00</span>
                </div>
                
                <div class="penalty-row grid grid-cols-3 gap-2 items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-700">SIKAP TIDAK SOPAN</span>
                    <div class="flex gap-1">
                        <button class="penalty-clear bg-blue-500 hover:bg-blue-600 text-white px-7 py-1 rounded text-xs transition-colors" data-penalty="sikap">Clear</button>
                        <button class="penalty-minus bg-red-500 hover:bg-red-600 text-white px-7 py-1 rounded text-xs transition-colors" data-penalty="sikap" data-value="-0.50">-0.50</button>
                    </div>
                    <span class="penalty-value text-sm font-bold text-right" id="penalty-sikap">0.00</span>
                </div> --}}
            </div>
            
            <!-- Total Penalty -->
            <div class="mt-2 pt-1 border-t-2 border-gray-200">
                <div class="bg-red-50 border-2 border-red-200 rounded-xl p-1 text-center">
                    <div class="text-sm text-red-600 mb-1">Total Penalty</div>
                    <div class="text-xl font-bold text-red-700" id="totalPenalty">0.00</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // State variables
        let currentMove = 1;
        let totalErrors = 0;
        let categoryTotal = 0;
        let totalPenalty = 0;
        let moveErrors = {}; // Track errors per move
        let penalties = {
            waktu: 0,
            garis: 0,
            pakaian: 0,
            senjata: 0,
            sikap: 0
        };

        // Update displays
        function updateDisplay() {
            document.getElementById('currentMove').textContent = currentMove;
            document.getElementById('currentMoveErrors').textContent = moveErrors[currentMove] || 0;
            document.getElementById('totalErrors').textContent = totalErrors;
            document.getElementById('categoryTotal').textContent = categoryTotal.toFixed(2);
            document.getElementById('totalPenalty').textContent = totalPenalty.toFixed(2);
            
            // Calculate final score (9.90 base + category total - total penalty - total errors * 0.01)
            const errorDeduction = totalErrors * 0.01;
            const finalScore = Math.max(0, 9.90 + categoryTotal - totalPenalty - errorDeduction);
            document.getElementById('finalScore').textContent = finalScore.toFixed(2);
        }

        // Wrong Move button
        document.getElementById('wrongMoveBtn').addEventListener('click', function() {
            if (!moveErrors[currentMove]) {
                moveErrors[currentMove] = 0;
            }
            moveErrors[currentMove]++;
            totalErrors++;
            updateDisplay();
        });

        // Next Move button - limit to 14 moves
        document.getElementById('nextMoveBtn').addEventListener('click', function() {
            if (currentMove < 12) {
                currentMove++;
                
                // Reset score buttons for new move
                document.querySelectorAll('.score-btn').forEach(btn => {
                    btn.classList.remove('bg-blue-500', 'text-white');
                    btn.classList.add('bg-gray-200', 'hover:bg-blue-500', 'hover:text-white');
                    btn.disabled = false;
                });
                
                updateDisplay();
            }
            
            // Disable next button if at move 14
            if (currentMove >= 12) {
                this.classList.add('opacity-50', 'cursor-not-allowed');
                this.disabled = true;
            }
        });

        // Score buttons - can replace selection for current move
        let selectedScoreForMove = {}; // Track selected score per move
        
        document.querySelectorAll('.score-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const score = parseFloat(this.dataset.score);
                
                // If there's already a score for this move, subtract it first
                if (selectedScoreForMove[currentMove]) {
                    categoryTotal -= selectedScoreForMove[currentMove];
                }
                
                // Add the new score
                categoryTotal += score;
                selectedScoreForMove[currentMove] = score;
                
                // Reset all buttons to default state
                document.querySelectorAll('.score-btn').forEach(otherBtn => {
                    otherBtn.classList.remove('bg-blue-500', 'text-white');
                    otherBtn.classList.add('bg-gray-200', 'hover:bg-blue-500', 'hover:text-white');
                });
                
                // Set this button as active (permanently highlighted)
                this.classList.remove('bg-gray-200', 'hover:bg-blue-500', 'hover:text-white');
                this.classList.add('bg-blue-500', 'text-white');
                
                updateDisplay();
            });
        });

        // Penalty buttons
        document.querySelectorAll('.penalty-clear').forEach(btn => {
            btn.addEventListener('click', function() {
                const penaltyType = this.dataset.penalty;
                penalties[penaltyType] = 0;
                document.getElementById(`penalty-${penaltyType}`).textContent = '0.00';
                
                // Recalculate total penalty
                totalPenalty = Object.values(penalties).reduce((sum, val) => sum + val, 0);
                updateDisplay();
            });
        });

        document.querySelectorAll('.penalty-minus').forEach(btn => {
            btn.addEventListener('click', function() {
                const penaltyType = this.dataset.penalty;
                const penaltyValue = parseFloat(this.dataset.value);
                penalties[penaltyType] += Math.abs(penaltyValue);
                document.getElementById(`penalty-${penaltyType}`).textContent = penalties[penaltyType].toFixed(2);
                
                // Recalculate total penalty
                totalPenalty = Object.values(penalties).reduce((sum, val) => sum + val, 0);
                updateDisplay();
            });
        });

        // Initialize display
        updateDisplay();
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'97bdfed2147ace19',t:'MTc1NzMyOTc4NC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>

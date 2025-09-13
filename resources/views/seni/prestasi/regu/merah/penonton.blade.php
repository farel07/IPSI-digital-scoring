<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scoreboard Pencak Silat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <!-- Logo Kiri -->
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z"/>
                    </svg>
                </div>
                <div class="bg-red-600 text-white px-3 py-1 rounded font-bold text-sm">
                    A - 2
                </div>
            </div>

            <!-- Judul Tengah -->
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-800 tracking-wide">PENCAK SILAT</h1>
                <p class="text-sm text-gray-600 mt-1">FINAL TUNGGAL</p>
            </div>

            <!-- Logo Kanan -->
            <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z"/>
                </svg>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Informasi Atlet -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center space-x-6">
                    <!-- Bendera -->
                    <div class="flex-shrink-0">
                        <div class="w-12 h-8 bg-gradient-to-b from-red-500 to-white rounded shadow-sm border border-gray-300 flex items-center justify-center">
                            <span class="text-xs font-bold text-red-600">🇮🇩</span>
                        </div>
                    </div>

                    <!-- Foto Atlet -->
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-gray-200 rounded-full border-2 border-red-500 flex items-center justify-center overflow-hidden">
                            <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Info Atlet -->
                    <div class="flex-1">
                        <h2 class="text-base font-bold text-black mb-1">INDONESIA</h2>
                        <p class="text-red-600 font-medium cursor-pointer hover:text-red-800">
                            BENNY G. SUMARSONO
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-gray-200 rounded-full border-2 border-red-500 flex items-center justify-center overflow-hidden">
                            <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Info Atlet -->
                    <div class="flex-1">
                        <h2 class="text-base font-bold text-black mb-1">INDONESIA</h2>
                        <p class="text-red-600 font-medium cursor-pointer hover:text-red-800">
                            BENNY G. SUMARSONO
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-gray-200 rounded-full border-2 border-red-500 flex items-center justify-center overflow-hidden">
                            <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Info Atlet -->
                    <div class="flex-1">
                        <h2 class="text-base font-bold text-black mb-1">INDONESIA</h2>
                        <p class="text-red-600 font-medium cursor-pointer hover:text-red-800">
                            BENNY G. SUMARSONO
                        </p>
                    </div>
                </div>
            </div>

            <!-- Timer -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="text-center">
                    <p class="text-sm text-gray-600 mb-2">Timer</p>
                    <div class="text-4xl font-bold text-black" id="timer">00:00</div>
                    {{-- <div class="mt-4 flex space-x-2">
                        <button onclick="startTimer()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm font-medium">
                            Start
                        </button>
                        <button onclick="pauseTimer()" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded text-sm font-medium">
                            Pause
                        </button>
                        <button onclick="resetTimer()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm font-medium">
                            Reset
                        </button>
                    </div> --}}
                </div>
            </div>
        </div>

        <!-- Scoreboard -->
        <div class="mt-8 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6 text-center">SCOREBOARD</h3>
            
            <!-- Nomor Juri -->
            <div class="grid grid-cols-10 gap-1 mb-2">
                <div class="bg-gray-100 text-gray-700 text-center py-2 rounded-md font-medium text-sm">1</div>
                <div class="bg-gray-100 text-gray-700 text-center py-2 rounded-md font-medium text-sm">2</div>
                <div class="bg-gray-100 text-gray-700 text-center py-2 rounded-md font-medium text-sm">3</div>
                <div class="bg-gray-100 text-gray-700 text-center py-2 rounded-md font-medium text-sm">4</div>
                <div class="bg-gray-100 text-gray-700 text-center py-2 rounded-md font-medium text-sm">5</div>
                <div class="bg-gray-100 text-gray-700 text-center py-2 rounded-md font-medium text-sm">6</div>
                <div class="bg-gray-100 text-gray-700 text-center py-2 rounded-md font-medium text-sm">7</div>
                <div class="bg-gray-100 text-gray-700 text-center py-2 rounded-md font-medium text-sm">8</div>
                <div class="bg-gray-100 text-gray-700 text-center py-2 rounded-md font-medium text-sm">9</div>
                <div class="bg-gray-100 text-gray-700 text-center py-2 rounded-md font-medium text-sm">10</div>
            </div>

            <!-- Skor -->
            <div class="grid grid-cols-10 gap-1">
                <div class="bg-red-600 text-white text-center py-3 rounded-md font-bold text-lg cursor-pointer hover:bg-red-700 transition-colors" onclick="editScore(this)">9.90</div>
                <div class="bg-red-600 text-white text-center py-3 rounded-md font-bold text-lg cursor-pointer hover:bg-red-700 transition-colors" onclick="editScore(this)">9.90</div>
                <div class="bg-red-600 text-white text-center py-3 rounded-md font-bold text-lg cursor-pointer hover:bg-red-700 transition-colors" onclick="editScore(this)">9.90</div>
                <div class="bg-red-600 text-white text-center py-3 rounded-md font-bold text-lg cursor-pointer hover:bg-red-700 transition-colors" onclick="editScore(this)">9.90</div>
                <div class="bg-red-600 text-white text-center py-3 rounded-md font-bold text-lg cursor-pointer hover:bg-red-700 transition-colors" onclick="editScore(this)">9.90</div>
                <div class="bg-red-600 text-white text-center py-3 rounded-md font-bold text-lg cursor-pointer hover:bg-red-700 transition-colors" onclick="editScore(this)">9.90</div>
                <div class="bg-red-600 text-white text-center py-3 rounded-md font-bold text-lg cursor-pointer hover:bg-red-700 transition-colors" onclick="editScore(this)">9.90</div>
                <div class="bg-red-600 text-white text-center py-3 rounded-md font-bold text-lg cursor-pointer hover:bg-red-700 transition-colors" onclick="editScore(this)">9.90</div>
                <div class="bg-red-600 text-white text-center py-3 rounded-md font-bold text-lg cursor-pointer hover:bg-red-700 transition-colors" onclick="editScore(this)">9.90</div>
                <div class="bg-red-600 text-white text-center py-3 rounded-md font-bold text-lg cursor-pointer hover:bg-red-700 transition-colors" onclick="editScore(this)">9.90</div>
            </div>

            <!-- Total Skor -->
            <div class="mt-6 text-center">
                <div class="inline-block bg-gray-800 text-white px-8 py-4 rounded-lg">
                    <p class="text-sm text-gray-300 mb-1">TOTAL SKOR</p>
                    <p class="text-3xl font-bold" id="totalScore">99.00</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 border-t border-gray-200 px-6 py-4 mt-8">
        <div class="max-w-7xl mx-auto flex items-center justify-between text-sm text-gray-600">
            <div id="datetime"></div>
            <div class="font-medium">EventSilat.com – Pencak Silat for the World</div>
        </div>
    </footer>

    <script>
        // Timer functionality
        let timerInterval;
        let seconds = 0;
        let isRunning = false;

        function updateTimerDisplay() {
            const mins = Math.floor(seconds / 60);
            const secs = seconds % 60;
            document.getElementById('timer').textContent = 
                `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
        }

        function startTimer() {
            if (!isRunning) {
                isRunning = true;
                timerInterval = setInterval(() => {
                    seconds++;
                    updateTimerDisplay();
                }, 1000);
            }
        }

        function pauseTimer() {
            isRunning = false;
            clearInterval(timerInterval);
        }

        function resetTimer() {
            isRunning = false;
            clearInterval(timerInterval);
            seconds = 0;
            updateTimerDisplay();
        }

        // Score editing
        function editScore(element) {
            const currentScore = element.textContent;
            const newScore = prompt('Masukkan skor baru (0.00 - 10.00):', currentScore);
            
            if (newScore !== null && !isNaN(newScore) && newScore >= 0 && newScore <= 10) {
                element.textContent = parseFloat(newScore).toFixed(2);
                calculateTotal();
            }
        }

        function calculateTotal() {
            const scoreElements = document.querySelectorAll('.grid.grid-cols-10.gap-1:last-child > div');
            let total = 0;
            
            scoreElements.forEach(element => {
                total += parseFloat(element.textContent);
            });
            
            document.getElementById('totalScore').textContent = total.toFixed(2);
        }

        // Update datetime
        function updateDateTime() {
            const now = new Date();
            const options = { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            document.getElementById('datetime').textContent = now.toLocaleDateString('id-ID', options);
        }

        // Initialize
        updateTimerDisplay();
        updateDateTime();
        calculateTotal();
        
        // Update datetime every minute
        setInterval(updateDateTime, 60000);
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'972abb21f02ddd4a',t:'MTc1NTc4NTYwNS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>

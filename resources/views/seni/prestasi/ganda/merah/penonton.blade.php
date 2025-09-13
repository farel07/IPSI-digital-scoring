<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scoreboard Pencak Silat - Compact</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'display': ['Inter', 'system-ui', 'sans-serif'],
                        'mono': ['JetBrains Mono', 'Courier New', 'monospace']
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="h-screen bg-gradient-to-br from-slate-300 via-gray-300 to-slate-100 p-3 font-display overflow-hidden">
    <div class="h-full max-w-6xl mx-auto flex flex-col">
        
        <!-- Main Scoreboard Container -->
        <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl overflow-hidden border border-white/20 h-full flex flex-col">
            
            <!-- Header Section -->
            <div class="relative bg-gradient-to-r from-gray-100 via-gray-50 to-gray-100 px-6 py-4 border-b-2 border-red-600">
                <!-- Logo Kiri -->
                <div class="absolute left-4 top-3 w-10 h-10 bg-gradient-to-br from-red-600 to-red-700 rounded-full flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-sm">PS</span>
                </div>
                
                <!-- Logo Kanan -->
                <div class="absolute right-4 top-3 w-10 h-10 bg-gradient-to-br from-red-600 to-red-700 rounded-full flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-sm">PS</span>
                </div>
                
                <!-- Main Title -->
                <div class="text-center">
                    <h1 class="text-3xl font-black text-gray-800 tracking-wider mb-2">
                        PENCAK SILAT
                    </h1>
                    
                    <!-- Sub Header -->
                    <div class="flex justify-between items-center text-sm font-bold text-gray-700">
                        <span class="bg-red-100 px-3 py-1 rounded-lg border border-red-200">A - 3</span>
                        <span class="bg-red-100 px-4 py-1 rounded-lg border border-red-200 text-red-700">FINAL</span>
                        <span class="bg-green-100 px-3 py-1 rounded-lg border border-green-200 text-green-700">GANDA</span>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="flex gap-4 p-4 flex-1">
                
                <!-- Team Section -->
                <div class="flex-[2]">
                    <div class="bg-gradient-to-br from-red-50 to-indigo-50 rounded-xl p-4 border border-red-100 shadow-lg h-full">
                        
                        <!-- Team Info -->
                        <div class="flex items-center gap-4 mb-3">
                            <!-- Malaysia Flag -->
                            <div class="relative w-16 h-10 rounded-lg overflow-hidden shadow-lg border-2 border-white">
                                <div class="absolute inset-0 bg-gradient-to-b from-red-600 via-red-600 to-red-600" style="background: repeating-linear-gradient(to bottom, #dc2626 0%, #dc2626 7.7%, white 7.7%, white 15.4%)"></div>
                                <div class="absolute top-0 left-0 w-2/5 h-3/5 bg-red-800"></div>
                                <div class="absolute top-0.5 left-0.5 text-yellow-400 text-xs">☪</div>
                            </div>
                            
                            <!-- Athlete Photos -->
                            <div class="flex gap-2">
                                <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg border-2 border-white">
                                    MT
                                </div>
                                <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg border-2 border-white">
                                    SY
                                </div>
                            </div>
                        </div>
                        
                        <!-- Country Name -->
                        <div class="mb-3">
                            <h2 class="text-2xl font-black text-gray-800 tracking-wide">
                                MALAYSIA
                            </h2>
                        </div>
                        
                        <!-- Athlete Names -->
                        <div class="bg-white/70 rounded-lg p-3 border border-red-200">
                            <p class="text-sm font-semibold text-gray-700 leading-relaxed">
                                | MOHD TAQIYUDDIN BIN HAMID 
                            </p>
                            <p class="text-sm font-semibold text-gray-700 leading-relaxed">
                                | SAZZLAN BIN YUGA 
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Timer Section -->
                <div class="flex-1">
                    <div class="bg-gradient-to-br from-slate-50 to-gray-50 rounded-xl p-4 border border-gray-200 shadow-lg h-full flex flex-col justify-center">
                        <div class="text-center">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                                Timer
                            </p>
                            <div id="timer" class="text-4xl font-mono font-black text-gray-800 bg-white rounded-xl py-4 px-4 shadow-inner border-2 border-red-200 cursor-pointer hover:border-red-400 transition-all duration-300">
                                00:00
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Click: start/stop • Double: reset</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Score Section -->
            <div class="px-4 pb-4 flex-1">
                <div class="bg-gradient-to-r from-red-50 to-indigo-50 rounded-xl p-3 border border-red-100 shadow-lg h-full">
                    <div class="overflow-hidden">
                        <table class="w-full h-full">
                            <!-- Header Row -->
                            <thead>
                                <tr>
                                    <th class="bg-gradient-to-br from-red-600 to-red-700 text-white font-bold text-lg py-2 px-2 border border-red-800 first:rounded-tl-lg last:rounded-tr-lg">1</th>
                                    <th class="bg-gradient-to-br from-red-600 to-red-700 text-white font-bold text-lg py-2 px-2 border border-red-800">2</th>
                                    <th class="bg-gradient-to-br from-red-600 to-red-700 text-white font-bold text-lg py-2 px-2 border border-red-800">3</th>
                                    <th class="bg-gradient-to-br from-red-600 to-red-700 text-white font-bold text-lg py-2 px-2 border border-red-800">4</th>
                                    <th class="bg-gradient-to-br from-red-600 to-red-700 text-white font-bold text-lg py-2 px-2 border border-red-800">5</th>
                                    <th class="bg-gradient-to-br from-red-600 to-red-700 text-white font-bold text-lg py-2 px-2 border border-red-800">6</th>
                                    <th class="bg-gradient-to-br from-red-600 to-red-700 text-white font-bold text-lg py-2 px-2 border border-red-800">7</th>
                                    <th class="bg-gradient-to-br from-red-600 to-red-700 text-white font-bold text-lg py-2 px-2 border border-red-800">8</th>
                                    <th class="bg-gradient-to-br from-red-600 to-red-700 text-white font-bold text-lg py-2 px-2 border border-red-800">9</th>
                                    <th class="bg-gradient-to-br from-red-600 to-red-700 text-white font-bold text-lg py-2 px-2 border border-red-800 first:rounded-tl-lg last:rounded-tr-lg">10</th>
                                </tr>
                            </thead>
                            <!-- Score Row -->
                            <tbody>
                                <tr>
                                    <td class="bg-gradient-to-br from-red-500 to-red-600 text-white font-bold text-xl py-3 px-2 border border-red-700 cursor-pointer hover:from-red-400 hover:to-red-500 transition-all duration-300 first:rounded-bl-lg last:rounded-br-lg">9.10</td>
                                    <td class="bg-gradient-to-br from-red-500 to-red-600 text-white font-bold text-xl py-3 px-2 border border-red-700 cursor-pointer hover:from-red-400 hover:to-red-500 transition-all duration-300">9.10</td>
                                    <td class="bg-gradient-to-br from-red-500 to-red-600 text-white font-bold text-xl py-3 px-2 border border-red-700 cursor-pointer hover:from-red-400 hover:to-red-500 transition-all duration-300">9.10</td>
                                    <td class="bg-gradient-to-br from-red-500 to-red-600 text-white font-bold text-xl py-3 px-2 border border-red-700 cursor-pointer hover:from-red-400 hover:to-red-500 transition-all duration-300">9.10</td>
                                    <td class="bg-gradient-to-br from-red-500 to-red-600 text-white font-bold text-xl py-3 px-2 border border-red-700 cursor-pointer hover:from-red-400 hover:to-red-500 transition-all duration-300">9.10</td>
                                    <td class="bg-gradient-to-br from-red-500 to-red-600 text-white font-bold text-xl py-3 px-2 border border-red-700 cursor-pointer hover:from-red-400 hover:to-red-500 transition-all duration-300">9.10</td>
                                    <td class="bg-gradient-to-br from-red-500 to-red-600 text-white font-bold text-xl py-3 px-2 border border-red-700 cursor-pointer hover:from-red-400 hover:to-red-500 transition-all duration-300">9.10</td>
                                    <td class="bg-gradient-to-br from-red-500 to-red-600 text-white font-bold text-xl py-3 px-2 border border-red-700 cursor-pointer hover:from-red-400 hover:to-red-500 transition-all duration-300">9.10</td>
                                    <td class="bg-gradient-to-br from-red-500 to-red-600 text-white font-bold text-xl py-3 px-2 border border-red-700 cursor-pointer hover:from-red-400 hover:to-red-500 transition-all duration-300">9.10</td>
                                    <td class="bg-gradient-to-br from-red-500 to-red-600 text-white font-bold text-xl py-3 px-2 border border-red-700 cursor-pointer hover:from-red-400 hover:to-red-500 transition-all duration-300 first:rounded-bl-lg last:rounded-br-lg">9.10</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-4 py-2 border-t border-gray-200 flex justify-between items-center">
                <div class="font-mono text-xs text-gray-600 bg-white px-2 py-1 rounded border border-gray-200">
                    <span id="timestamp">2022-09-01 22:04:06</span>
                </div>
                <div class="text-xs text-gray-600 font-medium">
                    <span class="text-red-600 font-semibold">EventSilat.Com</span> - Pencak Silat for the World
                </div>
            </div>
        </div>
    </div>

    <script>
        // Timer functionality
        let seconds = 0;
        let timerInterval;
        let isRunning = false;
        
        const timerElement = document.getElementById('timer');
        
        function updateTimer() {
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = seconds % 60;
            const display = `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
            timerElement.textContent = display;
        }
        
        function startTimer() {
            if (!timerInterval) {
                isRunning = true;
                timerElement.classList.add('border-green-400', 'bg-green-50');
                timerElement.classList.remove('border-red-200');
                timerInterval = setInterval(() => {
                    seconds++;
                    updateTimer();
                }, 1000);
            }
        }
        
        function stopTimer() {
            if (timerInterval) {
                isRunning = false;
                timerElement.classList.remove('border-green-400', 'bg-green-50');
                timerElement.classList.add('border-red-400', 'bg-red-50');
                clearInterval(timerInterval);
                timerInterval = null;
                
                setTimeout(() => {
                    timerElement.classList.remove('border-red-400', 'bg-red-50');
                    timerElement.classList.add('border-red-200');
                }, 1500);
            }
        }
        
        function resetTimer() {
            stopTimer();
            seconds = 0;
            updateTimer();
        }
        
        // Timer event listeners
        timerElement.addEventListener('click', function() {
            if (isRunning) {
                stopTimer();
            } else {
                startTimer();
            }
        });
        
        timerElement.addEventListener('dblclick', function() {
            resetTimer();
        });
        
        // Make score cells editable
        document.querySelectorAll('tbody td').forEach(cell => {
            cell.addEventListener('click', function() {
                if (this.querySelector('input')) return;
                
                const currentValue = this.textContent;
                const input = document.createElement('input');
                input.type = 'text';
                input.value = currentValue;
                input.className = 'w-full bg-transparent border-none text-white text-center text-xl font-bold focus:outline-none';
                
                this.innerHTML = '';
                this.appendChild(input);
                input.focus();
                input.select();
                
                const finishEditing = () => {
                    const newValue = input.value || currentValue;
                    this.textContent = newValue;
                };
                
                input.addEventListener('blur', finishEditing);
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        finishEditing();
                    }
                });
            });
        });
        
        // Update timestamp
        function updateTimestamp() {
            const now = new Date();
            const timestamp = now.getFullYear() + '-' + 
                            String(now.getMonth() + 1).padStart(2, '0') + '-' + 
                            String(now.getDate()).padStart(2, '0') + ' ' + 
                            String(now.getHours()).padStart(2, '0') + ':' + 
                            String(now.getMinutes()).padStart(2, '0') + ':' + 
                            String(now.getSeconds()).padStart(2, '0');
            
            document.getElementById('timestamp').textContent = timestamp;
        }
        
        updateTimestamp();
        setInterval(updateTimestamp, 1000);
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'97415a96a7346cfd',t:'MTc1NjAyMjgyMy4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>

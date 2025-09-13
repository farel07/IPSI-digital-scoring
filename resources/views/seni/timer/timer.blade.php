<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competition Scoreboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 h-screen overflow-hidden p-2">
    <div class="h-full flex flex-col">
        <!-- Header Section -->
        <div class="bg-gray-300 rounded-lg p-3 mb-3 flex justify-between items-center flex-shrink-0">
            <div class="text-sm text-black">PARTAI 0</div>
            <div class="text-xl font-bold text-black">ARENA 1</div>
            <div class="text-sm text-black"></div>
        </div>

        <!-- Athlete & Match Info Cards -->
        <div class="grid grid-cols-3 gap-3 mb-3 flex-shrink-0">
            <!-- Athlete 1 Card -->
            <div class="bg-white rounded-lg shadow-md p-3 text-center">
                <div class="font-bold text-red-600 uppercase text-base mb-1">ATHLETE 1</div>
                <div class="text-black text-xs">CONTINGENT</div>
            </div>
            
            <!-- Athlete 2 Card -->
            {{-- <div class="bg-white rounded-lg shadow-md p-3 text-center">
                <div class="font-bold text-blue-600 uppercase text-base mb-1">ATHLETE 2</div>
                <div class="text-black text-xs">CONTINGENT</div>
            </div> --}}
            
            <!-- Gender Card -->
            <div class="bg-white rounded-lg shadow-md p-3 text-center">
                <div class="font-bold text-black uppercase text-base mb-1">MALE</div>
                <div class="text-black text-xs">Kids</div>
            </div>
            
            <!-- Match Stage Card -->
            <div class="bg-white rounded-lg shadow-md p-3 text-center">
                <div class="font-bold text-black uppercase text-base mb-1">1/4</div>
                <div class="text-black text-xs">Final</div>
            </div>
        </div>

        <!-- Timer Section - Stacked Vertically -->
        <div class="flex-1 flex flex-col gap-4 mb-4">
            <!-- Match Timer (Count Up to 3 minutes) - Top -->
            <div class="bg-white rounded-lg shadow-md p-8 text-center flex-1">
                <div class="text-2xl font-bold text-gray-700 mb-4">MATCH TIME</div>
                <div id="matchTimer" class="text-7xl md:text-8xl font-bold text-black mb-4">00:00</div>
                <div id="matchStatus" class="text-lg font-semibold text-gray-600"></div>
            </div>
            
            <!-- Performance Timer (Count Up Unlimited) - Bottom -->
            <div class="bg-white rounded-lg shadow-md p-8 text-center flex-1">
                <div class="text-2xl font-bold text-gray-700 mb-4">TIME PERFORMANCE</div>
                <div id="performanceTimer" class="text-7xl md:text-8xl font-bold text-black mb-4">00:00</div>
                <div id="performanceStatus" class="text-lg font-semibold text-gray-600"></div>
            </div>
        </div>

        <!-- Control Buttons Section -->
        <div class="grid grid-cols-3 gap-4 mb-4 flex-shrink-0">
            <button id="startBtn" class="bg-green-600 hover:bg-green-700 text-white font-bold uppercase py-6 px-8 rounded-lg text-2xl transition-colors duration-200">
                START
            </button>
            <button id="stopBtn" class="bg-red-600 hover:bg-red-700 text-white font-bold uppercase py-6 px-8 rounded-lg text-2xl transition-colors duration-200">
                STOP
            </button>
            <button id="resetBtn" class="bg-orange-600 hover:bg-orange-700 text-white font-bold uppercase py-6 px-8 rounded-lg text-2xl transition-colors duration-200">
                RESET
            </button>
        </div>

        <!-- Round Selection Section -->
        {{-- <div class="grid grid-cols-3 gap-4 flex-shrink-0">
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold uppercase py-6 px-8 rounded-lg shadow-md text-2xl transition-colors duration-200">
                ROUND 1
            </button>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold uppercase py-6 px-8 rounded-lg shadow-md text-2xl transition-colors duration-200">
                ROUND 2
            </button>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold uppercase py-6 px-8 rounded-lg shadow-md text-2xl transition-colors duration-200">
                ROUND 3
            </button>
        </div> --}}
    </div>

    <script>
        // Match Timer (Count Up from 0 to 3 minutes)
        let matchTime = 0; // starts at 0 seconds
        let matchInterval = null;
        
        // Performance Timer (Count Up unlimited)
        let performanceTime = 0; // starts at 0 seconds
        let performanceInterval = null;
        
        let isRunning = false;

        const performanceDisplay = document.getElementById('performanceTimer');
        const matchDisplay = document.getElementById('matchTimer');
        const performanceStatus = document.getElementById('performanceStatus');
        const matchStatus = document.getElementById('matchStatus');
        const startBtn = document.getElementById('startBtn');
        const stopBtn = document.getElementById('stopBtn');
        const resetBtn = document.getElementById('resetBtn');

        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = seconds % 60;
            return `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
        }

        function updateDisplays() {
            performanceDisplay.textContent = formatTime(performanceTime);
            matchDisplay.textContent = formatTime(matchTime);
        }

        function showMatchTimeAlert() {
            // Flash the match timer green when it reaches 3 minutes
            matchDisplay.classList.add('text-green-600');
            
            // Show status message
            matchStatus.textContent = "MATCH TIME COMPLETED!";
            matchStatus.classList.add('text-green-600', 'font-bold');
            
            // Flash effect
            let flashCount = 0;
            const flashInterval = setInterval(() => {
                if (flashCount < 6) {
                    matchDisplay.classList.toggle('bg-green-100');
                    flashCount++;
                } else {
                    clearInterval(flashInterval);
                }
            }, 300);
        }

        function clearAlerts() {
            performanceDisplay.classList.remove('text-red-600', 'bg-red-100');
            matchDisplay.classList.remove('text-green-600', 'bg-green-100');
            performanceStatus.textContent = "";
            performanceStatus.classList.remove('text-red-600', 'font-bold');
            matchStatus.textContent = "";
            matchStatus.classList.remove('text-green-600', 'font-bold');
        }

        function startTimers() {
            if (!isRunning) {
                isRunning = true;
                clearAlerts();
                
                // Start match timer (count up to 3 minutes)
                matchInterval = setInterval(() => {
                    if (matchTime < 30) { // Only count up to 3 minutes (180 seconds)
                        matchTime++;
                        updateDisplays();
                        
                        if (matchTime >= 30) { // Alert and stop at 3 minutes
                            showMatchTimeAlert();
                            clearInterval(matchInterval);
                            matchInterval = null;
                        }
                    }
                }, 1000);
                
                // Start performance timer (count up unlimited)
                performanceInterval = setInterval(() => {
                    performanceTime++;
                    updateDisplays();
                }, 1000);
            }
        }

        function stopTimers() {
            isRunning = false;
            if (performanceInterval) {
                clearInterval(performanceInterval);
                performanceInterval = null;
            }
            // if (matchInterval) {
            //     clearInterval(matchInterval);
            //     matchInterval = null;
            // }
        }

        function resetTimers() {
            stopTimers();
            performanceTime = 0; // Reset to 0
            matchTime = 0; // Reset to 0
            clearAlerts();
            updateDisplays();
        }

        // Event listeners
        startBtn.addEventListener('click', startTimers);
        stopBtn.addEventListener('click', stopTimers);
        resetBtn.addEventListener('click', resetTimers);

        // Initialize displays
        updateDisplays();
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'978d5be241bbea7b',t:'MTc1NjgxOTc5NC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>

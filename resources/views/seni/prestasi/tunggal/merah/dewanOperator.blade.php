<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencak Silat Scoreboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen p-2">
    <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-red-600 to-red-800 text-white p-3">
            <div class="flex justify-between items-center">
                <!-- Left Side - Country & Athlete -->
                <div class="text-left">
                    <div class=" text-xs font-semibold ">KONTINGEN</div>
                    <div class="text-sm font-semibold">Nama Atlit</div>
                </div>
                
                <!-- Center - Event Title -->
                <div class="text-center flex-1">
                    <h1 class="text-xl font-bold">TESTING EVENT</h1>
                    <p class="text-blue-200 text-sm">TUNGGAL-TUNGGAL @ Arena A Match 32</p>
                </div>
                
                <!-- Right Side - Arena Info -->
                <div class="text-right">
                    <div class="text-sm font-semibold">Arena A Match 32</div>
                    <div class="text-xs text-blue-200">TUNGGAL</div>
                </div>
            </div>
        </div>

        <!-- Main Scoring Table -->
        <div class="p-3">
            <div class="mb-4">
                <h2 class="text-lg font-bold text-gray-800 mb-2">Penilaian Juri</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 p-2 text-left font-semibold text-gray-700 text-sm">Kriteria</th>
                            <th class="border border-gray-300 p-2 text-center font-semibold text-gray-700 text-sm">Judge 1</th>
                            <th class="border border-gray-300 p-2 text-center font-semibold text-gray-700 text-sm">Judge 2</th>
                            <th class="border border-gray-300 p-2 text-center font-semibold text-gray-700 text-sm">Judge 3</th>
                            <th class="border border-gray-300 p-2 text-center font-semibold text-gray-700 text-sm">Judge 4</th>
                            <th class="border border-gray-300 p-2 text-center font-semibold text-gray-700 bg-yellow-200 text-orange-600 text-sm">Judge 5</th>
                            <th class="border border-gray-300 p-2 text-center font-semibold text-gray-700 bg-yellow-200 text-orange-600 text-sm">Judge 6</th>
                            <th class="border border-gray-300 p-2 text-center font-semibold text-gray-700 text-sm">Judge 7</th>
                            <th class="border border-gray-300 p-2 text-center font-semibold text-gray-700 text-sm">Judge 8</th>
                            <th class="border border-gray-300 p-2 text-center font-semibold text-gray-700 text-sm">Judge 9</th>
                            <th class="border border-gray-300 p-2 text-center font-semibold text-gray-700 text-sm">Judge 10</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr>
                            <td class="border border-gray-300 p-2 font-medium text-gray-700 text-sm">Movement</td>
                            <td class="border border-gray-300 p-1 text-center text-sm">8.5</td>
                            <td class="border border-gray-300 p-1 text-center text-sm">9.0</td>
                            <td class="border border-gray-300 p-1 text-center text-sm bg-yellow-100">8.8</td>
                            <td class="border border-gray-300 p-1 text-center text-sm">9.2</td>
                            <td class="border border-gray-300 p-1 text-center text-sm">8.7</td>
                        </tr> --}}
                        <tr>
                            <td class="border border-gray-300 p-2 font-medium text-gray-700 text-sm">Correctness Score</td>
                            <td class="border border-gray-300 p-1 text-center text-sm">9.17</td>
                            <td class="border border-gray-300 p-1 text-center text-sm">9.25</td>
                            <td class="border border-gray-300 p-1 text-center text-sm">9.10</td>
                            <td class="border border-gray-300 p-1 text-center text-sm">9.10</td>
                            <td class="border border-gray-300 p-1 text-center text-sm bg-yellow-100">9.30</td>
                            <td class="border border-gray-300 p-1 text-center text-sm bg-yellow-100">9.15</td>
                            <td class="border border-gray-300 p-1 text-center text-sm">9.15</td>
                            <td class="border border-gray-300 p-1 text-center text-sm">9.15</td>
                            <td class="border border-gray-300 p-1 text-center text-sm">9.15</td>
                            <td class="border border-gray-300 p-1 text-center text-sm">9.15</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 p-2 font-medium text-gray-700 text-sm">Flow / Stamina<br><span class="text-xs text-gray-500">(0.01-0.10)</span></td>
                            <td class="border border-gray-300 p-1 text-center text-sm">0.05</td>
                            <td class="border border-gray-300 p-1 text-center text-sm">0.08</td>
                            <td class="border border-gray-300 p-1 text-center text-sm">0.06</td>
                            <td class="border border-gray-300 p-1 text-center text-sm">0.06</td>
                            <td class="border border-gray-300 p-1 text-center text-sm bg-yellow-100">0.07</td>
                            <td class="border border-gray-300 p-1 text-center text-sm bg-yellow-100">0.07</td>
                            <td class="border border-gray-300 p-1 text-center text-sm">0.07</td>
                            <td class="border border-gray-300 p-1 text-center text-sm">0.07</td>
                            <td class="border border-gray-300 p-1 text-center text-sm">0.07</td>
                            <td class="border border-gray-300 p-1 text-center text-sm">0.04</td>
                        </tr>
                        <tr class="bg-blue-50">
                            <td class="border border-gray-300 p-2 font-bold text-gray-800 text-sm">Total Score</td>
                            <td class="border border-gray-300 p-1 text-center text-base font-bold text-blue-600">8.90</td>
                            <td class="border border-gray-300 p-1 text-center text-base font-bold text-blue-600">9.17</td>
                            <td class="border border-gray-300 p-1 text-center text-base font-bold text-blue-600">8.94</td>
                            <td class="border border-gray-300 p-1 text-center text-base font-bold text-blue-600">8.94</td>
                            <td class="border border-gray-300 p-1 text-center text-base font-bold bg-yellow-200 text-orange-600">9.27</td>
                            <td class="border border-gray-300 p-1 text-center text-base font-bold bg-yellow-200 text-orange-600">8.89</td>
                            <td class="border border-gray-300 p-1 text-center text-base font-bold text-blue-600">8.89</td>
                            <td class="border border-gray-300 p-1 text-center text-base font-bold text-blue-600">8.89</td>
                            <td class="border border-gray-300 p-1 text-center text-base font-bold text-blue-600">8.89</td>
                            <td class="border border-gray-300 p-1 text-center text-base font-bold text-blue-600">8.89</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Time Performance & Statistics -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
                <!-- Time Performance -->
                <div>
                    <h3 class="text-base font-bold text-gray-800 mb-2">Waktu & Statistik</h3>
                    <table class="w-full border-collapse border border-gray-300">
                        <tr>
                            <td class="border border-gray-300 p-2 font-medium text-gray-700 bg-gray-50 text-sm">Time Performance</td>
                            <td class="border border-gray-300 p-2">
                                <div class="flex items-center justify-center space-x-1">
                                    <input type="number" value="2" class="border border-gray-400 p-1 text-center w-10 rounded text-sm" min="0" max="59">
                                    <span class="text-gray-600 text-sm">:</span>
                                    <input type="number" value="45" class="border border-gray-400 p-1 text-center w-10 bg-yellow-200 rounded text-sm" min="0" max="59">
                                </div>
                            </td>
                        </tr>
                        {{-- <tr>
                            <td class="border border-gray-300 p-2 font-medium text-gray-700 bg-gray-50 text-sm">Sorted Judge</td>
                            <td class="border border-gray-300 p-1 text-center text-xs">8.89, 8.90, 8.94, 9.17, 9.27</td>
                        </tr> --}}
                        <tr>
                            <td class="border border-gray-300 p-2 font-medium text-gray-700 bg-gray-50 text-sm">Median</td>
                            <td class="border border-gray-300 p-1 text-center text-base font-bold text-green-600">8.94</td>
                        </tr>
                        <tr class="bg-green-50">
                            <td class="border border-gray-300 p-2 font-bold text-gray-800 text-sm">Final Score</td>
                            <td class="border border-gray-300 p-1 text-center text-lg font-bold text-green-600">9.03</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 p-2 font-medium text-gray-700 bg-gray-50 text-sm">Standard Deviation</td>
                            <td class="border border-gray-300 p-1 text-center text-sm">0.16</td>
                        </tr>
                    </table>
                </div>

                <!-- Penalties Section -->
                <div>
                    <h3 class="text-base font-bold text-gray-800 mb-2">Penalti</h3>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 p-2 text-left font-semibold text-gray-700 text-sm">Jenis Penalti</th>
                                <th class="border border-gray-300 p-2 text-center font-semibold text-gray-700 text-sm">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border border-gray-300 p-2 text-xs text-gray-700">Exceeded tolerance time</td>
                                <td class="border border-gray-300 p-1 text-center text-sm">0</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 p-2 text-xs text-gray-700">Exceeded 10m arena</td>
                                <td class="border border-gray-300 p-1 text-center text-sm">0</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 p-2 text-xs text-gray-700">Weapon dropped</td>
                                <td class="border border-gray-300 p-1 text-center text-sm text-red-600 font-bold">-0.50</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 p-2 text-xs text-gray-700">Attire violation</td>
                                <td class="border border-gray-300 p-1 text-center text-sm">0</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 p-2 text-xs text-gray-700">Static move >5 seconds</td>
                                <td class="border border-gray-300 p-1 text-center text-sm">0</td>
                            </tr>
                            <tr class="bg-red-50">
                                <td class="border border-gray-300 p-2 font-bold text-gray-800 text-sm">Total Penalti</td>
                                <td class="border border-gray-300 p-1 text-center text-base font-bold text-red-600">-0.50</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Final Result -->
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-4 rounded-lg">
                <div class="text-center">
                    <h2 class="text-lg font-bold mb-1">SKOR AKHIR</h2>
                    <div class="text-3xl font-bold mb-1">8.53</div>
                    <p class="text-green-100 text-sm">Final Score (9.03) - Total Penalti (0.50)</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-calculate final scores when input changes
        function updateCalculations() {
            const judges = [8.90, 9.17, 8.94, 9.27, 8.89];
            const penalties = -0.50;
            const median = 8.94;
            const finalScore = 9.03;
            const finalResult = finalScore + penalties;
            
            // Update display (this would be dynamic in a real application)
            console.log('Calculations updated');
        }

        // Add event listeners to time inputs
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('change', updateCalculations);
        });

        // Initialize calculations
        updateCalculations();
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'972ab1a1d7d9dd4a',t:'MTc1NTc4NTIxNi4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>

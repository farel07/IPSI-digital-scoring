<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scoreboard Pencak Silat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen p-2">
    <!-- Team Selection Buttons -->
        {{-- <div class="p-6 pb-0">
            <div class="flex justify-center gap-4 mb-6">
                <button id="redTeamBtn" onclick="selectTeam('red')" class="bg-red-500 hover:bg-red-600 text-white px-8 py-3 rounded-xl font-bold text-lg transition-colors border-4 border-red-700">
                    TIM MERAH
                </button>
                <button id="blueTeamBtn" onclick="selectTeam('blue')" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-xl font-bold text-lg transition-colors border-2 border-gray-300">
                    TIM BIRU
                </button>
            </div>
            <div class="text-center mb-4">
                <span class="text-xl font-bold text-gray-700">Skor untuk: </span>
                <span id="activeTeam" class="text-xl font-bold text-red-500">TIM MERAH</span>
            </div> --}}
        </div>
    <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-white px-6 pb-4 pt-6 border-b border-gray-200">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-1xl font-bold text-blue-500">Kontingen</h1>
                    <div class="flex items-stat gap-3">
                        <h1 class="text-2xl font-bold text-blue-500">Nama Atlit,</h1>
                        <h1 class="text-2xl font-bold text-blue-500">Nama Atlit,</h1>
                        <h1 class="text-2xl font-bold text-blue-500">Nama Atlit</h1>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm text-black font-medium">Arena A, Match 1</p>
                    <p class="text-sm text-black font-medium">TUNGGAL</p>
                </div>
            </div>
        </div>

        

        <!-- Penalty Table -->
        <div class="px-6 pb-6">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 p-4 text-left font-semibold text-gray-700">Penalty</th>
                            <th class="border border-gray-300 p-4 text-center font-semibold text-gray-700 w-48">Score</th>
                            <th class="border border-gray-300 p-4 text-center font-semibold text-gray-700 w-24">Nilai</th>
                        </tr>
                    </thead>
                    <tbody id="penaltyTableBody">
                        <tr class="bg-white hover:bg-gray-50">
                            <td class="border border-gray-300 p-2 text-sm">WAKTU</td>
                            <td class="border border-gray-300 p-2 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="clearPenalty(0)" class="bg-blue-500 hover:bg-blue-600 text-white px-20 py-7 rounded-xl font-bold text-sm transition-colors">
                                        Clear
                                    </button>
                                    <button onclick="applyPenalty(0)" class="bg-red-500 hover:bg-red-600 text-white px-20 py-7 rounded-xl font-bold text-sm min-w-[60px] transition-colors cursor-pointer">
                                        -0.50
                                    </button>
                                </div>
                            </td>
                            <td class="border border-gray-300 p-4 text-center font-medium penalty-value" data-value="-0.50">-0.50</td>
                        </tr>
                        <tr class="bg-white hover:bg-gray-50">
                            <td class="border border-gray-300 p-4 text-sm">SETIAP KALI KELUAR GARIS</td>
                            <td class="border border-gray-300 p-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="clearPenalty(1)" class="bg-blue-500 hover:bg-blue-600 text-white px-20 py-7 rounded-xl font-bold text-sm transition-colors">
                                        Clear
                                    </button>
                                    <button onclick="applyPenalty(1)" class="bg-red-500 hover:bg-red-600 text-white px-20 py-7 rounded-xl font-bold text-sm min-w-[60px] transition-colors cursor-pointer">
                                        -0.50
                                    </button>
                                </div>
                            </td>
                            <td class="border border-gray-300 p-4 text-center font-medium penalty-value" data-value="0">0</td>
                        </tr>
                        <tr class="bg-white hover:bg-gray-50">
                            <td class="border border-gray-300 p-4 text-sm">PAKAIAN TIDAK SEMPURNA</td>
                            <td class="border border-gray-300 p-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="clearPenalty(2)" class="bg-blue-500 hover:bg-blue-600 text-white px-20 py-7 rounded-xl font-bold text-sm transition-colors">
                                        Clear
                                    </button>
                                    <button onclick="applyPenalty(2)" class="bg-red-500 hover:bg-red-600 text-white px-20 py-7 rounded-xl font-bold text-sm min-w-[60px] transition-colors cursor-pointer">
                                        -0.50
                                    </button>
                                </div>
                            </td>
                            <td class="border border-gray-300 p-4 text-center font-medium penalty-value" data-value="0">0</td>
                        </tr>
                        <tr class="bg-white hover:bg-gray-50">
                            <td class="border border-gray-300 p-4 text-sm">SETIAP KALI SENJATA JATUH</td>
                            <td class="border border-gray-300 p-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="clearPenalty(3)" class="bg-blue-500 hover:bg-blue-600 text-white px-20 py-7 rounded-xl font-bold text-sm transition-colors">
                                        Clear
                                    </button>
                                    <button onclick="applyPenalty(3)" class="bg-red-500 hover:bg-red-600 text-white px-20 py-7 rounded-xl font-bold text-sm min-w-[60px] transition-colors cursor-pointer">
                                        -0.50
                                    </button>
                                </div>
                            </td>
                            <td class="border border-gray-300 p-4 text-center font-medium penalty-value" data-value="-0.50">-0.50</td>
                        </tr>
                        <tr class="bg-white hover:bg-gray-50">
                            <td class="border border-gray-300 p-4 text-sm">ATLIT BERHENTI 5 DETIK DISETIAP GERAKAN </td>
                            <td class="border border-gray-300 p-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="clearPenalty(3)" class="bg-blue-500 hover:bg-blue-600 text-white px-20 py-7 rounded-xl font-bold text-sm transition-colors">
                                        Clear
                                    </button>
                                    <button onclick="applyPenalty(3)" class="bg-red-500 hover:bg-red-600 text-white px-20 py-7 rounded-xl font-bold text-sm min-w-[60px] transition-colors cursor-pointer">
                                        -0.50
                                    </button>
                                </div>
                            </td>
                            <td class="border border-gray-300 p-4 text-center font-medium penalty-value" data-value="-0.50">-0.50</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Footer Total -->
            <div class="mt-4 bg-white border border-gray-300 rounded-lg p-4">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-bold text-gray-700">Total Penalty:</span>
                    <span id="totalScore" class="text-2xl font-bold text-red-500">-1.0</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentTeam = 'red';
        let teamScores = {
            red: [0, 0, 0, 0],
            blue: [0, 0, 0, 0]
        };

        function selectTeam(team) {
            // Save current scores before switching
            saveCurrentScores();
            
            currentTeam = team;
            
            // Update button styles
            const redBtn = document.getElementById('redTeamBtn');
            const blueBtn = document.getElementById('blueTeamBtn');
            const activeTeamLabel = document.getElementById('activeTeam');
            
            if (team === 'red') {
                redBtn.className = 'bg-red-500 hover:bg-red-600 text-white px-8 py-3 rounded-xl font-bold text-lg transition-colors border-4 border-red-700';
                blueBtn.className = 'bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-xl font-bold text-lg transition-colors border-2 border-gray-300';
                activeTeamLabel.textContent = 'TIM MERAH';
                activeTeamLabel.className = 'text-xl font-bold text-red-500';
            } else {
                blueBtn.className = 'bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-xl font-bold text-lg transition-colors border-4 border-blue-700';
                redBtn.className = 'bg-red-500 hover:bg-red-600 text-white px-8 py-3 rounded-xl font-bold text-lg transition-colors border-2 border-gray-300';
                activeTeamLabel.textContent = 'TIM BIRU';
                activeTeamLabel.className = 'text-xl font-bold text-blue-500';
            }
            
            // Load scores for selected team
            loadTeamScores();
        }

        function saveCurrentScores() {
            const penaltyRows = document.querySelectorAll('.penalty-value');
            penaltyRows.forEach((row, index) => {
                teamScores[currentTeam][index] = parseFloat(row.dataset.value);
            });
        }

        function loadTeamScores() {
            const penaltyRows = document.querySelectorAll('.penalty-value');
            penaltyRows.forEach((row, index) => {
                const value = teamScores[currentTeam][index];
                row.textContent = value.toFixed(2);
                row.dataset.value = value.toString();
            });
            updateTotal();
        }

        function clearPenalty(rowIndex) {
            const penaltyRows = document.querySelectorAll('.penalty-value');
            const currentRow = penaltyRows[rowIndex];
            
            // Clear penalty (set to 0)
            currentRow.textContent = '0';
            currentRow.dataset.value = '0';
            teamScores[currentTeam][rowIndex] = 0;
            
            updateTotal();
        }

        function applyPenalty(rowIndex) {
            const penaltyRows = document.querySelectorAll('.penalty-value');
            const currentRow = penaltyRows[rowIndex];
            
            // Add -0.50 to current penalty value
            const currentValue = parseFloat(currentRow.dataset.value);
            const newValue = currentValue - 0.50;
            
            currentRow.textContent = newValue.toFixed(2);
            currentRow.dataset.value = newValue.toString();
            teamScores[currentTeam][rowIndex] = newValue;
            
            updateTotal();
        }

        function updateTotal() {
            const penaltyValues = document.querySelectorAll('.penalty-value');
            let total = 0;
            
            penaltyValues.forEach(cell => {
                total += parseFloat(cell.dataset.value);
            });
            
            const totalElement = document.getElementById('totalScore');
            totalElement.textContent = total.toFixed(1);
            
            // Change color based on total
            if (total < 0) {
                totalElement.className = 'text-2xl font-bold text-red-500';
            } else {
                totalElement.className = 'text-2xl font-bold text-green-500';
            }
        }

        // Initialize on page load
        updateTotal();
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9727eb4ca2eaba25',t:'MTc1NTc1NjEyMS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>

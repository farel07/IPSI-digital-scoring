<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Penalti Pencak Silat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen p-5">
    <div class="max-w-6xl mx-auto bg-white shadow-lg">
        <!-- Header Atas -->
        <div class="bg-white border-b border-gray-200 px-6 py-4">
            <div class="flex justify-between items-start">
                <div>
                    <div class="text-blue-600 text-xs font-semibold uppercase tracking-wide">PELATIH</div>
                    <div class="text-blue-700 font-semibold text-sm mt-1">RISKA HERMAWAN, RIRIN RINASIH</div>
                </div>
                <div class="text-right">
                    <div class="text-gray-700 font-semibold text-sm">Arena A, Match 1</div>
                    <div class="text-gray-600 text-sm mt-1">GANDA</div>
                </div>
            </div>
        </div>

        <!-- Tabel Penalti -->
        <div class="p-6">
            <div class="border border-gray-300 rounded-md shadow-sm overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wide border-b border-gray-200">Penalty</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wide border-b border-gray-200 w-20">Button</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wide border-b border-gray-200 w-20">Score</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wide border-b border-gray-200 w-24">Current Total</th>
                        </tr>
                    </thead>
                    <tbody id="penaltyTable" class="bg-white divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-700">WAKTU</td>
                            <td class="px-4 py-3 text-center">
                                <button onclick="clearPenalty(0)" class="bg-blue-500 text-white px-9 py-5 rounded-md hover:bg-blue-600 text-xs font-medium transition-colors ">Clear</button>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button onclick="addPenalty(0)" class="bg-red-500 text-white px-9 py-5 rounded-md hover:bg-red-600 text-xs font-bold transition-colors ">-0.50</button>
                            </td>
                            <td class="px-4 py-3 text-center text-gray-700 font-semibold text-sm" id="total-0">0</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-700">SETIAP KALI KELUAR GARIS</td>
                            <td class="px-4 py-3 text-center">
                                <button onclick="clearPenalty(1)" class="bg-blue-500 text-white px-9 py-5 rounded-md hover:bg-blue-600 text-xs font-medium transition-colors ">Clear</button>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button onclick="addPenalty(1)" class="bg-red-500 text-white px-9 py-5 rounded-md hover:bg-red-600 text-xs font-bold transition-colors ">-0.50</button>
                            </td>
                            <td class="px-4 py-3 text-center text-gray-700 font-semibold text-sm" id="total-1">0</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-700">SETIAP KALI SENJATA JATUH TIDAK SESUAI DESKRIPSI</td>
                            <td class="px-4 py-3 text-center">
                                <button onclick="clearPenalty(2)" class="bg-blue-500 text-white px-9 py-5 rounded-md hover:bg-blue-600 text-xs font-medium transition-colors">Clear</button>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button onclick="addPenalty(2)" class="bg-red-500 text-white px-9 py-5 rounded-md hover:bg-red-600 text-xs font-bold transition-colors">-0.50</button>
                            </td>
                            <td class="px-4 py-3 text-center text-gray-700 font-semibold text-sm" id="total-2">0</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-700">SENJATA TIDAK JATUH SESUAI DESKRIPSI</td>
                            <td class="px-4 py-3 text-center">
                                <button onclick="clearPenalty(3)" class="bg-blue-500 text-white px-9 py-5 rounded-md hover:bg-blue-600 text-xs font-medium transition-colors">Clear</button>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button onclick="addPenalty(3)" class="bg-red-500 text-white px-9 py-5 rounded-md hover:bg-red-600 text-xs font-bold transition-colors">-0.50</button>
                            </td>
                            <td class="px-4 py-3 text-center text-gray-700 font-semibold text-sm" id="total-3">0</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-700">TIDAK ADA SALAM & SETIAP KALI MENGELUARKAN SUARA</td>
                            <td class="px-4 py-3 text-center">
                                <button onclick="clearPenalty(3)" class="bg-blue-500 text-white px-9 py-5 rounded-md hover:bg-blue-600 text-xs font-medium transition-colors">Clear</button>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button onclick="addPenalty(3)" class="bg-red-500 text-white px-9 py-5 rounded-md hover:bg-red-600 text-xs font-bold transition-colors">-0.50</button>
                            </td>
                            <td class="px-4 py-3 text-center text-gray-700 font-semibold text-sm" id="total-3">0</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-700">BAJU / SENJATA TIDAK SESUAI (PATAH)</td>
                            <td class="px-4 py-3 text-center">
                                <button onclick="clearPenalty(3)" class="bg-blue-500 text-white px-9 py-5 rounded-md hover:bg-blue-600 text-xs font-medium transition-colors">Clear</button>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button onclick="addPenalty(3)" class="bg-red-500 text-white px-9 py-5 rounded-md hover:bg-red-600 text-xs font-bold transition-colors">-0.50</button>
                            </td>
                            <td class="px-4 py-3 text-center text-gray-700 font-semibold text-sm" id="total-3">0</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Bagian Total -->
            <div class="mt-4 flex justify-between items-center bg-gray-50 px-4 py-3 rounded-md border">
                <div class="text-lg font-bold text-gray-700">Total</div>
                <div class="text-red-600 text-xl font-bold" id="grandTotal">-0.5</div>
            </div>
        </div>

        <!-- Footer -->
        {{-- <div class="px-6 pb-4">
            <div class="text-center text-xs text-gray-500 italic">
                EventSilat.Com - Pencak Silat for the World
            </div>
        </div> --}}
    </div>

    <script>
        // Data penalti dengan status aktif/tidak aktif
        let penalties = [
            { active: false, value: -0.50 },
            { active: false, value: -0.50 },
            { active: false, value: -0.50 },
            { active: false, value: -0.50 }
        ];

        function addPenalty(index) {
            // Aktifkan penalti
            penalties[index].active = true;
            
            // Update tampilan baris
            const row = document.querySelector(`#penaltyTable tr:nth-child(${index + 1})`);
            const totalCell = document.getElementById(`total-${index}`);
            
            // Penalti aktif - tampilkan dengan highlight merah
            row.classList.add('bg-red-50');
            totalCell.textContent = penalties[index].value.toFixed(2);
            totalCell.classList.add('text-red-600', 'font-bold');
            totalCell.classList.remove('text-gray-700');
            
            // Update total keseluruhan
            updateGrandTotal();
        }

        function clearPenalty(index) {
            // Nonaktifkan penalti
            penalties[index].active = false;
            
            // Update tampilan baris
            const row = document.querySelector(`#penaltyTable tr:nth-child(${index + 1})`);
            const totalCell = document.getElementById(`total-${index}`);
            
            // Penalti tidak aktif - tampilan normal
            row.classList.remove('bg-red-50');
            totalCell.textContent = '0';
            totalCell.classList.remove('text-red-600', 'font-bold');
            totalCell.classList.add('text-gray-700');
            
            // Update total keseluruhan
            updateGrandTotal();
        }

        function updateGrandTotal() {
            const total = penalties.reduce((sum, penalty) => {
                return penalty.active ? sum + penalty.value : sum;
            }, 0);
            
            document.getElementById('grandTotal').textContent = total.toFixed(1);
        }

        // Inisialisasi tampilan saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            updateGrandTotal();
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'97417ec844bd6d21',t:'MTc1NjAyNDMwNi4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Pencak Silat Scoreboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 px-6 py-4">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <!-- Logo Kiri -->
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z"/>
                    </svg>
                </div>
                <span class="bg-blue-600 text-white px-3 py-1 rounded font-bold">A - 2</span>
            </div>
            
            <!-- Judul Tengah -->
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-800">PENCAK SILAT</h1>
                <p class="text-sm text-gray-600 mt-1">FINAL – TUNGGAL</p>
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
    <main class="max-w-6xl mx-auto px-6 py-8">
        <!-- Informasi Atlet -->
        <div class="flex justify-between items-center mb-8 bg-white rounded-lg shadow-md p-6">
            <!-- Blue Corner (Kiri) -->
            <div class="flex items-center space-x-4">
                <div class="w-24 h-24 rounded-full border-4 border-blue-600 overflow-hidden bg-blue-100 flex items-center justify-center">
                    <svg class="w-16 h-16 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
                <div>
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-6 bg-red-500 mr-2 rounded-sm flex items-center justify-center">
                            <div class="w-6 h-4 bg-white rounded-sm"></div>
                        </div>
                        <span class="text-sm text-gray-600">🇮🇩</span>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800">BENNY G. SUMARSONO</h3>
                    <p class="text-blue-600 font-bold text-sm">INDONESIA</p>
                </div>
            </div>

            <!-- VS di tengah -->
            <div class="text-4xl font-bold text-gray-400">VS</div>

            <!-- Red Corner (Kanan) -->
            <div class="flex items-center space-x-4">
                <div>
                    <div class="flex items-center justify-end mb-2">
                        <span class="text-sm text-gray-600 mr-2">🇸🇬</span>
                        <div class="w-8 h-6 bg-red-500 rounded-sm">
                            <div class="w-4 h-3 bg-white"></div>
                        </div>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 text-right">SHEIK ALAUDDIN</h3>
                    <p class="text-red-600 font-bold text-sm text-right">SINGAPORE</p>
                </div>
                <div class="w-24 h-24 rounded-full border-4 border-red-600 overflow-hidden bg-red-100 flex items-center justify-center">
                    <svg class="w-16 h-16 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Winner Label -->
        <div class="text-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Winner: <span class="text-blue-600">Blue</span></h2>
        </div>

        <!-- Tabel Score Result -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="table-auto w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-6 py-3 text-left font-semibold text-gray-800">Detail Point</th>
                        <th class="border border-gray-300 px-6 py-3 text-center font-semibold text-blue-600">Blue (Indonesia)</th>
                        <th class="border border-gray-300 px-6 py-3 text-center font-semibold text-red-600">Red (Singapore)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-6 py-3 font-medium text-gray-700">Standard Deviation</td>
                        <td class="border border-gray-300 px-6 py-3 text-center text-blue-600 font-bold">8.75</td>
                        <td class="border border-gray-300 px-6 py-3 text-center text-red-600 font-bold">8.25</td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-6 py-3 font-medium text-gray-700">Performance Time</td>
                        <td class="border border-gray-300 px-6 py-3 text-center text-blue-600 font-bold">9.20</td>
                        <td class="border border-gray-300 px-6 py-3 text-center text-red-600 font-bold">8.90</td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-6 py-3 font-medium text-gray-700">Penalty</td>
                        <td class="border border-gray-300 px-6 py-3 text-center text-blue-600 font-bold">-0.25</td>
                        <td class="border border-gray-300 px-6 py-3 text-center text-red-600 font-bold">-0.50</td>
                    </tr>
                    <tr class="bg-yellow-50 hover:bg-yellow-100">
                        <td class="border border-gray-300 px-6 py-4 font-bold text-gray-800 text-lg">Winning Point</td>
                        <td class="border border-gray-300 px-6 py-4 text-center text-blue-600 font-bold text-xl">17.70</td>
                        <td class="border border-gray-300 px-6 py-4 text-center text-red-600 font-bold text-xl">16.65</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 border-t border-gray-200 px-6 py-4 mt-12">
        <div class="max-w-6xl mx-auto flex justify-between items-center text-sm text-gray-600">
            <div>
                <p>📅 Sabtu, 14 Desember 2024 | ⏰ 15:30 WIB</p>
            </div>
            <div class="text-center">
                <p class="font-semibold">EventSilat.com – Pencak Silat for the World</p>
            </div>
            <div>
                <!-- Space for additional info -->
            </div>
        </div>
    </footer>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'972af87dc563ce85',t:'MTc1NTc4ODExOS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>

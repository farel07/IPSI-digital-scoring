<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencak Silat Final - Ganda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 h-screen overflow-hidden">
    <div class="container mx-auto px-6 py-4 h-full flex flex-col">
        <!-- Header -->
        <div class="text-center mb-4">
            <h1 class="text-3xl font-bold text-gray-800">PENCAK SILAT</h1>
            <h2 class="text-xl font-bold text-gray-600">FINAL – GANDA</h2>
        </div>

        <!-- Card 1: Blue Corner & Red Corner Combined -->
        <div class="bg-white rounded-xl shadow-md p-4 mb-4">
            <div class="grid grid-cols-2 gap-6">
                <!-- Blue Corner -->
                <div class="border-l-4 border-blue-400 pl-4">
                    <div class="text-center mb-3">
                        <h3 class="text-lg font-bold text-blue-600">🇮🇩 INDONESIA</h3>
                        <span class="text-blue-600 text-sm font-semibold">Blue Corner</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center mb-2">
                                <span class="text-blue-600 font-bold text-sm">BG</span>
                            </div>
                            <h4 class="font-bold text-gray-800 text-xs text-center">BENNY G. SUMARSONO</h4>
                        </div>
                        
                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center mb-2">
                                <span class="text-blue-600 font-bold text-sm">AP</span>
                            </div>
                            <h4 class="font-bold text-gray-800 text-xs text-center">ANDI PRATAMA</h4>
                        </div>
                    </div>
                </div>

                <!-- Red Corner -->
                <div class="border-l-4 border-red-400 pl-4">
                    <div class="text-center mb-3">
                        <h3 class="text-lg font-bold text-red-600">🇸🇬 SINGAPORE</h3>
                        <span class="text-red-600 text-sm font-semibold">Red Corner</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 bg-red-200 rounded-full flex items-center justify-center mb-2">
                                <span class="text-red-600 font-bold text-sm">SA</span>
                            </div>
                            <h4 class="font-bold text-gray-800 text-xs text-center">SHEIK ALAUDDIN</h4>
                        </div>
                        
                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 bg-red-200 rounded-full flex items-center justify-center mb-2">
                                <span class="text-red-600 font-bold text-sm">TW</span>
                            </div>
                            <h4 class="font-bold text-gray-800 text-xs text-center">TAN WEI MING</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Hasil Pertandingan -->
        <div class="bg-white rounded-xl shadow-md p-4 mb-4 text-center">
            <h3 class="text-lg font-bold mb-3 text-gray-700">Hasil Pertandingan</h3>
            <div class="text-3xl font-bold text-blue-600">
                Winner: <span class="bg-blue-100 px-4 py-2 rounded-lg">BLUE</span>
            </div>
            <p class="text-gray-600 mt-2 text-sm">Indonesia berhasil meraih kemenangan!</p>
        </div>

        <!-- Card 3: Detail Penilaian -->
        <div class="bg-white rounded-xl shadow-md p-4 flex-1">
            <h3 class="text-lg font-bold text-center mb-4 text-gray-700">Detail Penilaian</h3>
            
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b-2 border-gray-200">
                        <th class="text-left py-3 px-4 font-bold text-gray-700">Kategori</th>
                        <th class="text-center py-3 px-4 font-bold text-blue-600">Indonesia (Blue)</th>
                        <th class="text-center py-3 px-4 font-bold text-red-600">Singapore (Red)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="py-3 px-4 font-semibold text-gray-700">Standard Deviation</td>
                        <td class="py-3 px-4 text-center text-blue-600 font-semibold">8.5</td>
                        <td class="py-3 px-4 text-center text-red-600 font-semibold">7.8</td>
                    </tr>
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="py-3 px-4 font-semibold text-gray-700">Performance Time</td>
                        <td class="py-3 px-4 text-center text-blue-600 font-semibold">2:45</td>
                        <td class="py-3 px-4 text-center text-red-600 font-semibold">2:52</td>
                    </tr>
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="py-3 px-4 font-semibold text-gray-700">Penalty</td>
                        <td class="py-3 px-4 text-center text-blue-600 font-semibold">-0.5</td>
                        <td class="py-3 px-4 text-center text-red-600 font-semibold">-1.0</td>
                    </tr>
                    <tr class="bg-yellow-100 border-b border-yellow-200">
                        <td class="py-3 px-4 font-bold text-gray-800">Winning Point</td>
                        <td class="py-3 px-4 text-center text-blue-600 font-bold text-lg">92.5</td>
                        <td class="py-3 px-4 text-center text-red-600 font-bold text-lg">89.2</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'97b3da66a4afce19',t:'MTc1NzIyMzQzNS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>

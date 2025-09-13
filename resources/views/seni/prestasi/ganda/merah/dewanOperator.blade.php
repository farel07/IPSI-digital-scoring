<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perhitungan Skor Pencak Silat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="w-full h-screen p-6 bg-white overflow-auto">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Sistem Perhitungan Skor Pencak Silat</h1>
            <p class="text-gray-600">Panel Penilaian Juri - 10 Juri</p>
        </div>

        <!-- Judge Panel Table -->
        <div class="mb-8">
            <table class="w-full border border-gray-300 text-center text-sm">
                <!-- Header -->
                <thead>
                    <tr class="bg-gray-100 font-semibold">
                        <th class="px-4 py-3 border border-gray-300">Judge</th>
                        <th class="px-3 py-3 border border-gray-300">1</th>
                        <th class="px-3 py-3 border border-gray-300">2</th>
                        <th class="px-3 py-3 border border-gray-300">3</th>
                        <th class="px-3 py-3 border border-gray-300">4</th>
                        <th class="px-3 py-3 border border-gray-300">5</th>
                        <th class="px-3 py-3 border border-gray-300">6</th>
                        <th class="px-3 py-3 border border-gray-300">7</th>
                        <th class="px-3 py-3 border border-gray-300">8</th>
                        <th class="px-3 py-3 border border-gray-300">9</th>
                        <th class="px-3 py-3 border border-gray-300">10</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Attack Defense Technique -->
                    <tr>
                        <td class="px-4 py-3 border border-gray-300 bg-gray-50 font-medium text-left">
                            ATTACK DEFENSE TECHNIQUE<br><span class="text-sm text-gray-500">(0.01-0.30)</span>
                        </td>
                        <td class="px-3 py-3 border border-gray-300 bg-yellow-200">0.16</td>
                        <td class="px-3 py-3 border border-gray-300">0.28</td>
                        <td class="px-3 py-3 border border-gray-300">0.14</td>
                        <td class="px-3 py-3 border border-gray-300 bg-yellow-200">0.15</td>
                        <td class="px-3 py-3 border border-gray-300">0.15</td>
                        <td class="px-3 py-3 border border-gray-300">0.14</td>
                        <td class="px-3 py-3 border border-gray-300">0.17</td>
                        <td class="px-3 py-3 border border-gray-300 bg-yellow-200">0.19</td>
                        <td class="px-3 py-3 border border-gray-300">0.13</td>
                        <td class="px-3 py-3 border border-gray-300">0.18</td>
                    </tr>
                    
                    <!-- Firmness & Harmony -->
                    <tr>
                        <td class="px-4 py-3 border border-gray-300 bg-gray-50 font-medium text-left">
                            FIRMNESS & HARMONY<br><span class="text-sm text-gray-500">(0.01-0.30)</span>
                        </td>
                        <td class="px-3 py-3 border border-gray-300">0.22</td>
                        <td class="px-3 py-3 border border-gray-300 bg-yellow-200">0.25</td>
                        <td class="px-3 py-3 border border-gray-300">0.24</td>
                        <td class="px-3 py-3 border border-gray-300">0.23</td>
                        <td class="px-3 py-3 border border-gray-300 bg-yellow-200">0.21</td>
                        <td class="px-3 py-3 border border-gray-300">0.22</td>
                        <td class="px-3 py-3 border border-gray-300">0.26</td>
                        <td class="px-3 py-3 border border-gray-300">0.20</td>
                        <td class="px-3 py-3 border border-gray-300 bg-yellow-200">0.27</td>
                        <td class="px-3 py-3 border border-gray-300">0.24</td>
                    </tr>
                    
                    <!-- Soulfulness -->
                    <tr>
                        <td class="px-4 py-3 border border-gray-300 bg-gray-50 font-medium text-left">
                            SOULFULNESS<br><span class="text-sm text-gray-500">(0.01-0.30)</span>
                        </td>
                        <td class="px-3 py-3 border border-gray-300">0.18</td>
                        <td class="px-3 py-3 border border-gray-300">0.19</td>
                        <td class="px-3 py-3 border border-gray-300 bg-yellow-200">0.17</td>
                        <td class="px-3 py-3 border border-gray-300">0.20</td>
                        <td class="px-3 py-3 border border-gray-300">0.16</td>
                        <td class="px-3 py-3 border border-gray-300 bg-yellow-200">0.18</td>
                        <td class="px-3 py-3 border border-gray-300">0.21</td>
                        <td class="px-3 py-3 border border-gray-300">0.15</td>
                        <td class="px-3 py-3 border border-gray-300">0.19</td>
                        <td class="px-3 py-3 border border-gray-300 bg-yellow-200">0.22</td>
                    </tr>
                    
                    <!-- Total Score -->
                    <tr class="bg-blue-50 font-semibold">
                        <td class="px-4 py-3 border border-gray-300 bg-blue-100 font-bold">Total Score</td>
                        <td class="px-3 py-3 border border-gray-300 font-mono">9.54</td>
                        <td class="px-3 py-3 border border-gray-300 font-mono bg-yellow-200">9.91</td>
                        <td class="px-3 py-3 border border-gray-300 font-mono">9.74</td>
                        <td class="px-3 py-3 border border-gray-300 font-mono">9.58</td>
                        <td class="px-3 py-3 border border-gray-300 font-mono">9.25</td>
                        <td class="px-3 py-3 border border-gray-300 font-mono bg-yellow-200">9.41</td>
                        <td class="px-3 py-3 border border-gray-300 font-mono">9.67</td>
                        <td class="px-3 py-3 border border-gray-300 font-mono">9.32</td>
                        <td class="px-3 py-3 border border-gray-300 font-mono bg-yellow-200">9.83</td>
                        <td class="px-3 py-3 border border-gray-300 font-mono">9.76</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Sorted Judge Card -->
        <div class="mb-8 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-5 shadow-sm">
            <h3 class="text-xl font-semibold text-blue-800 mb-4 text-center">Sorted Judge Scores</h3>
            <div class="flex justify-center gap-3 mb-4 flex-wrap">
                <span class="px-4 py-3 bg-white border border-gray-300 rounded-lg font-mono text-sm shadow-sm">9.25</span>
                <span class="px-4 py-3 bg-white border border-gray-300 rounded-lg font-mono text-sm shadow-sm">9.32</span>
                <span class="px-4 py-3 bg-white border border-gray-300 rounded-lg font-mono text-sm shadow-sm">9.41</span>
                <span class="px-4 py-3 bg-white border border-gray-300 rounded-lg font-mono text-sm shadow-sm">9.54</span>
                <span class="px-4 py-3 bg-yellow-200 border border-yellow-400 rounded-lg font-mono text-sm font-bold shadow-sm">9.58</span>
                <span class="px-4 py-3 bg-yellow-200 border border-yellow-400 rounded-lg font-mono text-sm font-bold shadow-sm">9.67</span>
                <span class="px-4 py-3 bg-white border border-gray-300 rounded-lg font-mono text-sm shadow-sm">9.74</span>
                <span class="px-4 py-3 bg-white border border-gray-300 rounded-lg font-mono text-sm shadow-sm">9.76</span>
                <span class="px-4 py-3 bg-white border border-gray-300 rounded-lg font-mono text-sm shadow-sm">9.83</span>
                <span class="px-4 py-3 bg-white border border-gray-300 rounded-lg font-mono text-sm shadow-sm">9.91</span>
            </div>
            <div class="text-center text-sm text-blue-600">
                <span class="bg-yellow-200 px-3 py-1 rounded">Median Values</span> - Nilai tengah dari 10 juri
            </div>
        </div>

        <!-- Results Section -->
        <div class="grid grid-cols-3 gap-8 ">
            <!-- Median -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 text-center shadow-sm">
                <h4 class="text-lg font-semibold text-blue-800 mb-3">Median</h4>
                <div class="text-4xl font-mono text-blue-600 font-bold">9.625</div>
            </div>
            
            <!-- Final Score -->
            <div class="bg-green-50 border border-green-200 rounded-lg p-5 text-center shadow-sm">
                <h4 class="text-lg font-semibold text-green-800 mb-3">Final Score</h4>
                <div class="text-4xl font-mono text-gray-700 font-bold">9.625</div>
            </div>
            
            <!-- Standard Deviation -->
            <div class="bg-orange-50 border border-orange-200 rounded-lg p-5 text-center shadow-sm">
                <h4 class="text-lg font-semibold text-orange-800 mb-3">Standard Deviation</h4>
                <div class="text-2xl font-mono text-gray-700">0.021847</div>
            </div>
        </div>
    </div>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9741b1cf8379ea87',t:'MTc1NjAyNjM5Ni4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penilaian Pencak Silat - Tim Biru & Tim Merah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .penalty-counter {
            counter-reset: penalty-counter;
        }
        .penalty-item {
            counter-increment: penalty-counter;
        }
        .penalty-text::before {
            content: counter(penalty-counter) ". ";
            font-weight: 600;
            color: #dc2626;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen p-5">
    <!-- Team Selector Card -->
    <div class="max-w-2xl mx-auto mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            {{-- <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Pilih Tim</h2> --}}
            <div class="flex gap-4 justify-center">
                <button class="team-btn px-8 py-4 bg-blue-600 text-white text-xl font-bold rounded-xl cursor-pointer transition-all duration-300 hover:opacity-90 border-4 border-blue-800 shadow-lg" onclick="showTeam('blue')">TIM BIRU</button>
                <button class="team-btn px-8 py-4 bg-red-600 text-white text-xl font-bold rounded-xl cursor-pointer transition-all duration-300 hover:opacity-90 shadow-lg" onclick="showTeam('red')">TIM MERAH</button>
            </div>
        </div>
    </div>

    <!-- Dashboard Tim Biru -->
    <div class="dashboard max-w-7xl mx-auto block" id="blue-team">
        <!-- Header Card -->
        <div class="bg-white rounded-xl shadow-lg mb-6 overflow-hidden">
            <div class="bg-blue-600 text-white p-8 text-center">
                <div class="bg-white bg-opacity-20 px-5 py-2 rounded-full text-lg font-semibold mb-5 inline-block">🔵 TIM BIRU</div>
                <h1 class="text-4xl font-bold mb-5 tracking-widest">DEWAN WASIT JURI</h1>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4 flex justify-between items-center">
                        <span class="font-semibold text-gray-700">Nama:</span>
                        <span class="text-gray-900">Friska Maulidya Zahrotus Sitah / Siti Andara Mel</span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 flex justify-between items-center">
                        <span class="font-semibold text-gray-700">Kontingen:</span>
                        <span class="text-gray-900">Jawa Tengah</span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 flex justify-between items-center">
                        <span class="font-semibold text-gray-700">Partai:</span>
                        <span class="text-gray-900">136</span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 flex justify-between items-center">
                        <span class="font-semibold text-gray-700">Kategori Kelas:</span>
                        <span class="text-gray-900">Ganda Remaja Putri</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scoring Card -->
        {{-- <div class="bg-white rounded-xl shadow-lg mb-6 overflow-hidden">
            <div class="bg-blue-600 text-white p-4 font-bold text-xl text-center">KRITERIA PENILAIAN</div>
            <div class="p-6 overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="bg-blue-600 text-white border border-gray-300 p-3 text-center text-sm font-semibold rounded-tl-lg">Kriteria</th>
                            <th class="bg-blue-600 text-white border border-gray-300 p-2 text-center text-sm font-semibold">Juri 1</th>
                            <th class="bg-blue-600 text-white border border-gray-300 p-2 text-center text-sm font-semibold">Juri 2</th>
                            <th class="bg-blue-600 text-white border border-gray-300 p-2 text-center text-sm font-semibold">Juri 3</th>
                            <th class="bg-blue-600 text-white border border-gray-300 p-2 text-center text-sm font-semibold">Juri 4</th>
                            <th class="bg-blue-600 text-white border border-gray-300 p-2 text-center text-sm font-semibold">Juri 5</th>
                            <th class="bg-blue-600 text-white border border-gray-300 p-2 text-center text-sm font-semibold">Juri 6</th>
                            <th class="bg-blue-600 text-white border border-gray-300 p-2 text-center text-sm font-semibold">Juri 7</th>
                            <th class="bg-blue-600 text-white border border-gray-300 p-2 text-center text-sm font-semibold">Juri 8</th>
                            <th class="bg-blue-600 text-white border border-gray-300 p-2 text-center text-sm font-semibold">Juri 9</th>
                            <th class="bg-blue-600 text-white border border-gray-300 p-2 text-center text-sm font-semibold rounded-tr-lg">Juri 10</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bg-gray-50 font-semibold text-left pl-4 border border-gray-300 p-3 text-sm">Teknik Serang Bela (0,01 – 0,30)</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.28</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.29</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.27</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.30</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.28</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.29</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.28</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.30</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.29</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.28</td>
                        </tr>
                        <tr>
                            <td class="bg-gray-50 font-semibold text-left pl-4 border border-gray-300 p-3 text-sm">Kemantapan & Kekompakan (0,01 – 0,30)</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.29</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.28</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.30</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.29</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.30</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.28</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.29</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.28</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.30</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.29</td>
                        </tr>
                        <tr>
                            <td class="bg-gray-50 font-semibold text-left pl-4 border border-gray-300 p-3 text-sm">Keserasian Penghayatan (0,01 – 0,30)</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.30</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.29</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.28</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.28</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.29</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.30</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.30</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.29</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.28</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.30</td>
                        </tr>
                        <tr class="bg-yellow-100">
                            <td class="bg-yellow-200 font-bold text-left pl-4 border border-gray-300 p-3 text-sm rounded-bl-lg">TOTAL SKOR</td>
                            <td class="border border-gray-300 p-2 text-center text-sm font-bold">0.87</td>
                            <td class="border border-gray-300 p-2 text-center text-sm font-bold">0.86</td>
                            <td class="border border-gray-300 p-2 text-center text-sm font-bold">0.85</td>
                            <td class="border border-gray-300 p-2 text-center text-sm font-bold">0.87</td>
                            <td class="border border-gray-300 p-2 text-center text-sm font-bold">0.87</td>
                            <td class="border border-gray-300 p-2 text-center text-sm font-bold">0.87</td>
                            <td class="border border-gray-300 p-2 text-center text-sm font-bold">0.87</td>
                            <td class="border border-gray-300 p-2 text-center text-sm font-bold">0.87</td>
                            <td class="border border-gray-300 p-2 text-center text-sm font-bold">0.87</td>
                            <td class="border border-gray-300 p-2 text-center text-sm font-bold rounded-br-lg">0.87</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> --}}

        <!-- Median & Time Cards -->
        {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                <h3 class="text-xl font-bold text-gray-800 mb-4">MEDIAN</h3>
                <div class="bg-blue-50 rounded-lg p-6">
                    <div class="text-5xl font-bold text-blue-600" id="blue-median">9,93</div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">WAKTU TAMPILAN</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <table class="w-full">
                        <tr>
                            <th class="bg-gray-700 text-white p-2 text-center rounded-tl-lg">Penulisan</th>
                            <th class="bg-gray-700 text-white p-2 text-center">Menit</th>
                            <th class="bg-gray-700 text-white p-2 text-center">Detik</th>
                            <th class="bg-gray-700 text-white p-2 text-center rounded-tr-lg">Total Detik</th>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 p-2 text-center bg-white">256</td>
                            <td class="border border-gray-300 p-2 text-center bg-white">2</td>
                            <td class="border border-gray-300 p-2 text-center bg-white">56</td>
                            <td class="border border-gray-300 p-2 text-center bg-white">176</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div> --}}

        <!-- Penalty Card -->
        <div class="bg-white rounded-xl shadow-lg mb-6">
            <div class="bg-blue-600 text-white p-4 rounded-t-xl">
                <h3 class="text-xl font-bold text-center">HUKUMAN - TIM BIRU</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2">
                        <div class="penalty-counter space-y-4">
                            <div class="penalty-item bg-gray-50 rounded-lg p-4 border-l-4 border-red-500 flex flex-col md:flex-row justify-between items-center gap-3">
                                <span class="penalty-text font-medium">Waktu</span>
                                <div class="flex items-center gap-3">
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-4 rounded-lg font-semibold transition-all duration-300 shadow-md hover:shadow-lg" onclick="addPenalty('blue', 0)">PENALTY</button>
                                    <span class="bg-yellow-200 px-6 py-4 rounded-lg border border-yellow-400 font-bold min-w-10 text-center" id="blue-penalty-0">0</span>
                                </div>
                            </div>
                            <div class="penalty-item bg-gray-50 rounded-lg p-4 border-l-4 border-red-500 flex flex-col md:flex-row justify-between items-center gap-3">
                                <span class="penalty-text font-medium">Setiap kali keluar garis</span>
                                <div class="flex items-center gap-3">
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-4 rounded-lg font-semibold transition-all duration-300 shadow-md hover:shadow-lg" onclick="addPenalty('blue', 1)">PENALTY</button>
                                    <span class="bg-yellow-200 px-6 py-4 rounded-lg border border-yellow-400 font-bold min-w-10 text-center" id="blue-penalty-1">0</span>
                                </div>
                            </div>
                            <div class="penalty-item bg-gray-50 rounded-lg p-4 border-l-4 border-red-500 flex flex-col md:flex-row justify-between items-center gap-3">
                                <span class="penalty-text font-medium">Setiap kali senjata jatuh tidak sesuai deskripsi</span>
                                <div class="flex items-center gap-3">
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-4 rounded-lg font-semibold transition-all duration-300 shadow-md hover:shadow-lg" onclick="addPenalty('blue', 2)">PENALTY</button>
                                    <span class="bg-yellow-200 px-6 py-4 rounded-lg border border-yellow-400 font-bold min-w-10 text-center" id="blue-penalty-2">0</span>
                                </div>
                            </div>
                            <div class="penalty-item bg-gray-50 rounded-lg p-4 border-l-4 border-red-500 flex flex-col md:flex-row justify-between items-center gap-3">
                                <span class="penalty-text font-medium">Senjata tidak jatuh sesuai deskripsi</span>
                                <div class="flex items-center gap-3">
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-4 rounded-lg font-semibold transition-all duration-300 shadow-md hover:shadow-lg" onclick="addPenalty('blue', 3)">PENALTY</button>
                                    <span class="bg-yellow-200 px-6 py-4 rounded-lg border border-yellow-400 font-bold min-w-10 text-center" id="blue-penalty-3">0</span>
                                </div>
                            </div>
                            <div class="penalty-item bg-gray-50 rounded-lg p-4 border-l-4 border-red-500 flex flex-col md:flex-row justify-between items-center gap-3">
                                <span class="penalty-text font-medium">Tidak ada salam & setiap kali mengeluarkan suara</span>
                                <div class="flex items-center gap-3">
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-4 rounded-lg font-semibold transition-all duration-300 shadow-md hover:shadow-lg" onclick="addPenalty('blue', 4)">PENALTY</button>
                                    <span class="bg-yellow-200 px-6 py-4 rounded-lg border border-yellow-400 font-bold min-w-10 text-center" id="blue-penalty-4">0</span>
                                </div>
                            </div>
                            <div class="penalty-item bg-gray-50 rounded-lg p-4 border-l-4 border-red-500 flex flex-col md:flex-row justify-between items-center gap-3">
                                <span class="penalty-text font-medium">Baju / senjata tidak sesuai (patah)</span>
                                <div class="flex items-center gap-3">
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-4 rounded-lg font-semibold transition-all duration-300 shadow-md hover:shadow-lg" onclick="addPenalty('blue', 5)">PENALTY</button>
                                    <span class="bg-yellow-200 px-6 py-4 rounded-lg border border-yellow-400 font-bold min-w-10 text-center" id="blue-penalty-5">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <table class="w-full">
                                <tr><th class="bg-gray-700 text-white p-3 text-center rounded-t-lg">Nilai Hukuman</th></tr>
                                <tr><td class="border border-gray-300 p-3 text-center bg-white rounded-b-lg font-semibold">0.50</td></tr>
                            </table>
                        </div>
                        <div class="bg-yellow-200 rounded-lg p-6 border-2 border-yellow-400 text-center">
                            <div class="text-lg font-bold text-gray-800">Jumlah Hukuman</div>
                            <div class="text-2xl font-bold text-red-600 mt-2" id="blue-total-penalty">0,00</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Final Score Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-blue-600 text-white p-8 text-center">
                <h2 class="text-2xl font-bold mb-4">TOTAL NILAI</h2>
                <div class="bg-white bg-opacity-20 rounded-lg p-6">
                    <div class="text-6xl font-bold" id="blue-final-score">9,93</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Tim Merah -->
    <div class="dashboard max-w-7xl mx-auto hidden" id="red-team">
        <!-- Header Card -->
        <div class="bg-white rounded-xl shadow-lg mb-6 overflow-hidden">
            <div class="bg-red-600 text-white p-8 text-center">
                <div class="bg-white bg-opacity-20 px-5 py-2 rounded-full text-lg font-semibold mb-5 inline-block">🔴 TIM MERAH</div>
                <h1 class="text-4xl font-bold mb-5 tracking-widest">DEWAN WASIT JURI</h1>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4 flex justify-between items-center">
                        <span class="font-semibold text-gray-700">Nama:</span>
                        <span class="text-gray-900">Ahmad Rizki Pratama / Dedi Setiawan</span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 flex justify-between items-center">
                        <span class="font-semibold text-gray-700">Kontingen:</span>
                        <span class="text-gray-900">Jawa Barat</span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 flex justify-between items-center">
                        <span class="font-semibold text-gray-700">Partai:</span>
                        <span class="text-gray-900">137</span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 flex justify-between items-center">
                        <span class="font-semibold text-gray-700">Kategori Kelas:</span>
                        <span class="text-gray-900">Ganda Remaja Putra</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scoring Card -->
        <div class="bg-white rounded-xl shadow-lg mb-6 overflow-hidden">
            <div class="bg-red-600 text-white p-4 font-bold text-xl text-center">KRITERIA PENILAIAN</div>
            <div class="p-6 overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="bg-red-600 text-white border border-gray-300 p-3 text-center text-sm font-semibold rounded-tl-lg">Kriteria</th>
                            <th class="bg-red-600 text-white border border-gray-300 p-2 text-center text-sm font-semibold">Juri 1</th>
                            <th class="bg-red-600 text-white border border-gray-300 p-2 text-center text-sm font-semibold">Juri 2</th>
                            <th class="bg-red-600 text-white border border-gray-300 p-2 text-center text-sm font-semibold">Juri 3</th>
                            <th class="bg-red-600 text-white border border-gray-300 p-2 text-center text-sm font-semibold">Juri 4</th>
                            <th class="bg-red-600 text-white border border-gray-300 p-2 text-center text-sm font-semibold">Juri 5</th>
                            <th class="bg-red-600 text-white border border-gray-300 p-2 text-center text-sm font-semibold">Juri 6</th>
                            <th class="bg-red-600 text-white border border-gray-300 p-2 text-center text-sm font-semibold">Juri 7</th>
                            <th class="bg-red-600 text-white border border-gray-300 p-2 text-center text-sm font-semibold">Juri 8</th>
                            <th class="bg-red-600 text-white border border-gray-300 p-2 text-center text-sm font-semibold">Juri 9</th>
                            <th class="bg-red-600 text-white border border-gray-300 p-2 text-center text-sm font-semibold rounded-tr-lg">Juri 10</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bg-gray-50 font-semibold text-left pl-4 border border-gray-300 p-3 text-sm">Teknik Serang Bela (0,01 – 0,30)</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.27</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.28</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.26</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.29</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.27</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.28</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.27</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.29</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.28</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.27</td>
                        </tr>
                        <tr>
                            <td class="bg-gray-50 font-semibold text-left pl-4 border border-gray-300 p-3 text-sm">Kemantapan & Kekompakan (0,01 – 0,30)</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.28</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.27</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.29</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.28</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.29</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.27</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.28</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.27</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.29</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.28</td>
                        </tr>
                        <tr>
                            <td class="bg-gray-50 font-semibold text-left pl-4 border border-gray-300 p-3 text-sm">Keserasian Penghayatan (0,01 – 0,30)</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.29</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.28</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.27</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.27</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.28</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.29</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.29</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.28</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.27</td>
                            <td class="border border-gray-300 p-2 text-center text-sm">0.29</td>
                        </tr>
                        <tr class="bg-yellow-100">
                            <td class="bg-yellow-200 font-bold text-left pl-4 border border-gray-300 p-3 text-sm rounded-bl-lg">TOTAL SKOR</td>
                            <td class="border border-gray-300 p-2 text-center text-sm font-bold">0.84</td>
                            <td class="border border-gray-300 p-2 text-center text-sm font-bold">0.83</td>
                            <td class="border border-gray-300 p-2 text-center text-sm font-bold">0.82</td>
                            <td class="border border-gray-300 p-2 text-center text-sm font-bold">0.84</td>
                            <td class="border border-gray-300 p-2 text-center text-sm font-bold">0.84</td>
                            <td class="border border-gray-300 p-2 text-center text-sm font-bold">0.84</td>
                            <td class="border border-gray-300 p-2 text-center text-sm font-bold">0.84</td>
                            <td class="border border-gray-300 p-2 text-center text-sm font-bold">0.84</td>
                            <td class="border border-gray-300 p-2 text-center text-sm font-bold">0.84</td>
                            <td class="border border-gray-300 p-2 text-center text-sm font-bold rounded-br-lg">0.84</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Median & Time Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                <h3 class="text-xl font-bold text-gray-800 mb-4">MEDIAN</h3>
                <div class="bg-red-50 rounded-lg p-6">
                    <div class="text-5xl font-bold text-red-600" id="red-median">9,68</div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">WAKTU TAMPILAN</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <table class="w-full">
                        <tr>
                            <th class="bg-gray-700 text-white p-2 text-center rounded-tl-lg">Penulisan</th>
                            <th class="bg-gray-700 text-white p-2 text-center">Menit</th>
                            <th class="bg-gray-700 text-white p-2 text-center">Detik</th>
                            <th class="bg-gray-700 text-white p-2 text-center rounded-tr-lg">Total Detik</th>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 p-2 text-center bg-white">248</td>
                            <td class="border border-gray-300 p-2 text-center bg-white">2</td>
                            <td class="border border-gray-300 p-2 text-center bg-white">48</td>
                            <td class="border border-gray-300 p-2 text-center bg-white">168</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Penalty Card -->
        <div class="bg-white rounded-xl shadow-lg mb-6">
            <div class="bg-red-600 text-white p-4 rounded-t-xl">
                <h3 class="text-xl font-bold text-center">HUKUMAN - TIM MERAH</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2">
                        <div class="penalty-counter space-y-4">
                            <div class="penalty-item bg-gray-50 rounded-lg p-4 border-l-4 border-red-500 flex flex-col md:flex-row justify-between items-center gap-3">
                                <span class="penalty-text font-medium">Waktu</span>
                                <div class="flex items-center gap-3">
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-4 rounded-lg font-semibold transition-all duration-300 shadow-md hover:shadow-lg" onclick="addPenalty('red', 0)">PENALTY</button>
                                    <span class="bg-yellow-200 px-6 py-4 rounded-lg border border-yellow-400 font-bold min-w-10 text-center" id="red-penalty-0">0</span>
                                </div>
                            </div>
                            <div class="penalty-item bg-gray-50 rounded-lg p-4 border-l-4 border-red-500 flex flex-col md:flex-row justify-between items-center gap-3">
                                <span class="penalty-text font-medium">Setiap kali keluar garis</span>
                                <div class="flex items-center gap-3">
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-4 rounded-lg font-semibold transition-all duration-300 shadow-md hover:shadow-lg" onclick="addPenalty('red', 1)">PENALTY</button>
                                    <span class="bg-yellow-200 px-6 py-4 rounded-lg border border-yellow-400 font-bold min-w-10 text-center" id="red-penalty-1">0</span>
                                </div>
                            </div>
                            <div class="penalty-item bg-gray-50 rounded-lg p-4 border-l-4 border-red-500 flex flex-col md:flex-row justify-between items-center gap-3">
                                <span class="penalty-text font-medium">Setiap kali senjata jatuh tidak sesuai deskripsi</span>
                                <div class="flex items-center gap-3">
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-4 rounded-lg font-semibold transition-all duration-300 shadow-md hover:shadow-lg" onclick="addPenalty('red', 2)">PENALTY</button>
                                    <span class="bg-yellow-200 px-6 py-4 rounded-lg border border-yellow-400 font-bold min-w-10 text-center" id="red-penalty-2">0</span>
                                </div>
                            </div>
                            <div class="penalty-item bg-gray-50 rounded-lg p-4 border-l-4 border-red-500 flex flex-col md:flex-row justify-between items-center gap-3">
                                <span class="penalty-text font-medium">Senjata tidak jatuh sesuai deskripsi</span>
                                <div class="flex items-center gap-3">
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-4 rounded-lg font-semibold transition-all duration-300 shadow-md hover:shadow-lg" onclick="addPenalty('red', 3)">PENALTY</button>
                                    <span class="bg-yellow-200 px-6 py-4 rounded-lg border border-yellow-400 font-bold min-w-10 text-center" id="red-penalty-3">0</span>
                                </div>
                            </div>
                            <div class="penalty-item bg-gray-50 rounded-lg p-4 border-l-4 border-red-500 flex flex-col md:flex-row justify-between items-center gap-3">
                                <span class="penalty-text font-medium">Tidak ada salam & setiap kali mengeluarkan suara</span>
                                <div class="flex items-center gap-3">
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-4 rounded-lg font-semibold transition-all duration-300 shadow-md hover:shadow-lg" onclick="addPenalty('red', 4)">PENALTY</button>
                                    <span class="bg-yellow-200 px-6 py-4 rounded-lg border border-yellow-400 font-bold min-w-10 text-center" id="red-penalty-4">0</span>
                                </div>
                            </div>
                            <div class="penalty-item bg-gray-50 rounded-lg p-4 border-l-4 border-red-500 flex flex-col md:flex-row justify-between items-center gap-3">
                                <span class="penalty-text font-medium">Baju / senjata tidak sesuai (patah)</span>
                                <div class="flex items-center gap-3">
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-4 rounded-lg font-semibold transition-all duration-300 shadow-md hover:shadow-lg" onclick="addPenalty('red', 5)">PENALTY</button>
                                    <span class="bg-yellow-200 px-6 py-4 rounded-lg border border-yellow-400 font-bold min-w-10 text-center" id="red-penalty-5">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <table class="w-full">
                                <tr><th class="bg-gray-700 text-white p-3 text-center rounded-t-lg">Nilai Hukuman</th></tr>
                                <tr><td class="border border-gray-300 p-3 text-center bg-white rounded-b-lg font-semibold">0.50</td></tr>
                            </table>
                        </div>
                        <div class="bg-yellow-200 rounded-lg p-6 border-2 border-yellow-400 text-center">
                            <div class="text-lg font-bold text-gray-800">Jumlah Hukuman</div>
                            <div class="text-2xl font-bold text-red-600 mt-2" id="red-total-penalty">0,00</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Final Score Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-red-600 text-white p-8 text-center">
                <h2 class="text-2xl font-bold mb-4">TOTAL NILAI</h2>
                <div class="bg-white bg-opacity-20 rounded-lg p-6">
                    <div class="text-6xl font-bold" id="red-final-score">9,68</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Team data storage
        const teamData = {
            blue: {
                penalties: [0, 0, 0, 0, 0, 0],
                baseScore: 9.93,
                totalPenalty: 0
            },
            red: {
                penalties: [0, 0, 0, 0, 0, 0],
                baseScore: 9.68,
                totalPenalty: 0
            }
        };

        function showTeam(team) {
            // Update button states
            document.querySelectorAll('.team-btn').forEach(btn => {
                btn.classList.remove('border-4', 'border-blue-800', 'border-red-800');
            });
            
            if (team === 'blue') {
                document.querySelector('.team-btn.bg-blue-600').classList.add('border-4', 'border-blue-800');
            } else {
                document.querySelector('.team-btn.bg-red-600').classList.add('border-4', 'border-red-800');
            }

            // Show/hide dashboards
            document.querySelectorAll('.dashboard').forEach(dashboard => {
                dashboard.classList.add('hidden');
                dashboard.classList.remove('block');
            });
            document.getElementById(`${team}-team`).classList.remove('hidden');
            document.getElementById(`${team}-team`).classList.add('block');
        }

        function addPenalty(team, penaltyIndex) {
            // Increment penalty count
            teamData[team].penalties[penaltyIndex]++;
            
            // Update display
            document.getElementById(`${team}-penalty-${penaltyIndex}`).textContent = 
                teamData[team].penalties[penaltyIndex];
            
            // Calculate total penalty
            teamData[team].totalPenalty = teamData[team].penalties.reduce((sum, count) => sum + (count * 0.5), 0);
            
            // Update total penalty display
            document.getElementById(`${team}-total-penalty`).textContent = 
                teamData[team].totalPenalty.toFixed(2).replace('.', ',');
            
            // Calculate and update final score
            const finalScore = teamData[team].baseScore - teamData[team].totalPenalty;
            document.getElementById(`${team}-final-score`).textContent = 
                finalScore.toFixed(2).replace('.', ',');
            
            // Add visual feedback
            const button = event.target;
            button.style.transform = 'scale(0.95)';
            setTimeout(() => {
                button.style.transform = '';
            }, 150);
        }

        // Initialize with blue team
        showTeam('blue');
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'97026e44b2a54f50',t:'MTc1NTM2MzAyNy4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>

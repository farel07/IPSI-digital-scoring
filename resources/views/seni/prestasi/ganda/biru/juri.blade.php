<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Pertandingan Silat Ganda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- META TAG UNTUK CSRF TOKEN -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">

    @php 
        // Menentukan unit yang sedang aktif dari URL, default ke 'unit_1'
        $unit_param = request('unit', 'unit_1');
        $current_unit_id = ($unit_param == 'unit_1') ? ($pertandingan->unit1_id ?? '0') : ($pertandingan->unit2_id ?? '0');
    @endphp
    
    <!-- INPUT TERSEMBUNYI UNTUK DATA PENTING -->
    <input type="hidden" id="pertandingan_id" value="{{ $pertandingan->id ?? '0' }}">
    <input type="hidden" id="juri_id" value="{{ $user->id ?? '0' }}">
    <input type="hidden" id="role_juri" value="{{ $user->role->name ?? '0' }}">

    
    <input type="hidden" name="unit_id" id="unit_id" value="{{ $current_unit_id }}">
    
    <!-- DATA AWAL DARI DATABASE UNTUK JAVASCRIPT -->
    <input type="hidden" id="initial-teknik" value="{{ $detail_poin->teknik_dasar ?? 0.00 }}">
    <input type="hidden" id="initial-kekuatan" value="{{ $detail_poin->kekuatan_kecepatan ?? 0.00 }}">
    <input type="hidden" id="initial-penampilan" value="{{ $detail_poin->penampilan_gaya ?? 0.00 }}">

    <!-- Header -->
    <header class="bg-white border-b border-gray-200 p-4">
        {{-- Anda bisa mengisi konten header di sini jika perlu --}}
        <h1 class="text-center font-bold text-xl">Penilaian Seni Ganda</h1>
    </header>

    <!-- Main Content -->
    <main class="h-[calc(100vh-80px)] p-4">
        <div class="grid grid-cols-3 gap-4 h-full">
            <!-- Scoring Categories -->
            <div class="col-span-2 grid grid-rows-3 gap-3">
                <!-- Kategori 1: Teknik Dasar -->
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center justify-between mb-3">
                        {{-- Dropdown Unit --}}
                        <select name="unit" id="unit" class="border-gray-300 rounded-md shadow-sm">
                            <option value="unit_1" {{ $unit_param == 'unit_1' ? 'selected' : '' }}>Unit 1</option>
                            <option value="unit_2" {{ $unit_param == 'unit_2' ? 'selected' : '' }}>Unit 2</option>
                        </select>
                        <script>
                            document.getElementById('unit').addEventListener('change', function () {
                                const selected = this.value;
                                const currentUrl = new URL(window.location.href);
                                currentUrl.searchParams.set('unit', selected);
                                window.location.href = currentUrl.toString();
                            });
                        </script>
                        {{-- Judul Kategori --}}
                        <h3 class="font-bold text-gray-800">TEKNIK DASAR</h3>
                        {{-- Tampilan Skor --}}
                        <div class="text-right">
                            <div class="text-xs text-gray-500">SCORE</div>
                            <div class="text-xl font-bold text-blue-600" id="teknik-score">0.00</div>
                        </div>
                    </div>
                    {{-- Kontainer untuk Tombol Skor --}}
                    <div class="grid grid-cols-10 gap-1" id="teknik-buttons">
                        <!-- Tombol akan dibuat oleh JavaScript di sini -->
                    </div>
                </div>

                <!-- Kategori 2: Kekuatan & Kecepatan -->
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-bold text-gray-800">KEKUATAN & KECEPATAN</h3>
                        <div class="text-right">
                            <div class="text-xs text-gray-500">SCORE</div>
                            <div class="text-xl font-bold text-blue-600" id="kekuatan-score">0.00</div>
                        </div>
                    </div>
                    {{-- Kontainer untuk Tombol Skor --}}
                    <div class="grid grid-cols-10 gap-1" id="kekuatan-buttons">
                        <!-- Tombol akan dibuat oleh JavaScript di sini -->
                    </div>
                </div>

                <!-- Kategori 3: Penampilan & Gaya -->
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-bold text-gray-800">PENAMPILAN & GAYA</h3>
                        <div class="text-right">
                            <div class="text-xs text-gray-500">SCORE</div>
                            <div class="text-xl font-bold text-blue-600" id="penampilan-score">0.00</div>
                        </div>
                    </div>
                    {{-- Kontainer untuk Tombol Skor --}}
                    <div class="grid grid-cols-10 gap-1" id="penampilan-buttons">
                        <!-- Tombol akan dibuat oleh JavaScript di sini -->
                    </div>
                </div>
            </div>

            <!-- Total Score -->
            <div class="bg-white rounded-lg shadow p-6 flex flex-col justify-center text-center">
                <h2 class="text-xl font-bold text-gray-800 mb-4">TOTAL SCORE</h2>
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-lg p-6 mb-4">
                    <div class="text-5xl font-bold" id="total-score">9.10</div>
                    <div class="text-blue-100 mt-1">/ 10.00</div>
                </div>
                <button id="submit-button" onclick="submitScores()" 
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors">
                    Submit Penilaian
                </button>
            </div>
        </div>
    </main>

    <script>
        // =====================================================================
        // KONFIGURASI & STATE
        // =====================================================================
        const BASE_SCORE = 9.10;
        let isLoading = false;

        const PERTANDINGAN_ID = document.getElementById('pertandingan_id').value;
        const JURI_ID = document.getElementById('juri_id').value;
        const ROLE_JURI = document.getElementById('role_juri').value;

        // Inisialisasi state dengan data dari input hidden (dari database)
        let scores = {
            teknik: parseFloat(document.getElementById('initial-teknik').value) || 0,
            kekuatan: parseFloat(document.getElementById('initial-kekuatan').value) || 0,
            penampilan: parseFloat(document.getElementById('initial-penampilan').value) || 0
        };
        
        // =====================================================================
        // FUNGSI PENGIRIMAN DATA (ANTI-RACE CONDITION)
        // =====================================================================
        
        function toggleAllButtons(disabled) {
            isLoading = disabled;
            const allButtons = document.querySelectorAll('button');
            allButtons.forEach(button => {
                button.disabled = disabled;
                button.classList.toggle('opacity-75', disabled);
                button.classList.toggle('cursor-wait', disabled,);
            });
        }

        function kirimPoinSeni(type, poin) {
            if (isLoading) {
                console.log("Request sedang diproses, mohon tunggu...");
                return;
            }
            toggleAllButtons(true);

            fetch(`/kirim-poin-seni/${JURI_ID}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    poin: poin,
                    type: type,
                    filter: 'penilaian_ganda',
                    pertandingan_id: PERTANDINGAN_ID,
                    role: ROLE_JURI,
                    unit_id: document.getElementById('unit_id').value,
                }),
            })
            .then(res => res.ok ? res.json() : Promise.reject('Network response was not ok'))
            .then(data => console.log(`Data untuk ${type} berhasil dikirim:`, data))
            .catch(error => {
                console.error("Fetch error:", error);
                alert("Terjadi kesalahan saat mengirim data. Silakan coba lagi.");
            })
            .finally(() => toggleAllButtons(false));
        }
        
        // =====================================================================
        // FUNGSI UI
        // =====================================================================

        function generateButtons(containerId, category) {
            const container = document.getElementById(containerId);
            if (!container) return; // Pengaman jika elemen tidak ditemukan
            container.innerHTML = '';
            
            for (let i = 1; i <= 30; i++) {
                const value = parseFloat((i * 0.01).toFixed(2));
                const button = document.createElement('button');
                button.textContent = value.toFixed(2);
                
                // Cek apakah nilai tombol ini adalah skor yang sedang aktif
                if (scores[category] === value) {
                    button.className = 'w-8 h-8 border-2 border-blue-600 bg-blue-600 text-white rounded text-xs font-bold transition-colors focus:outline-none';
                } else {
                    button.className = 'w-8 h-8 border border-gray-300 rounded text-xs font-medium hover:bg-blue-100 hover:border-blue-300 transition-colors focus:outline-none';
                }
                
                button.onclick = () => selectScore(category, value, button, containerId);
                container.appendChild(button);
            }
        }

        function selectScore(category, value, selectedButton, containerId) {
            const container = document.getElementById(containerId);
            const buttons = container.querySelectorAll('button');
            buttons.forEach(btn => {
                btn.className = 'w-8 h-8 border border-gray-300 rounded text-xs font-medium hover:bg-blue-100 hover:border-blue-300 transition-colors focus:outline-none';
            });

            selectedButton.className = 'w-8 h-8 border-2 border-blue-600 bg-blue-600 text-white rounded text-xs font-bold transition-colors focus:outline-none';

            scores[category] = value;
            document.getElementById(category + '-score').textContent = value.toFixed(2);
            
            updateTotal();
            kirimPoinSeni(category, value);
        }

        function updateTotal() {
            const total = BASE_SCORE + scores.teknik + scores.kekuatan + scores.penampilan;
            document.getElementById('total-score').textContent = total.toFixed(2);
        }

        function submitScores() {
            const total = BASE_SCORE + scores.teknik + scores.kekuatan + scores.penampilan;
            alert(`Penilaian berhasil disubmit!\n\nTotal Score: ${total.toFixed(2)}`);
        }
        
        function initializeUI() {
            // Set teks skor untuk setiap kategori
            document.getElementById('teknik-score').textContent = scores.teknik.toFixed(2);
            document.getElementById('kekuatan-score').textContent = scores.kekuatan.toFixed(2);
            document.getElementById('penampilan-score').textContent = scores.penampilan.toFixed(2);

            // Generate tombol (logika di dalamnya akan menyorot tombol yang benar)
            generateButtons('teknik-buttons', 'teknik');
            generateButtons('kekuatan-buttons', 'kekuatan');
            generateButtons('penampilan-buttons', 'penampilan');

            // Hitung dan tampilkan total skor awal
            updateTotal();
        }

        // Initialize UI on page load
        document.addEventListener('DOMContentLoaded', initializeUI);
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Penalti Pencak Silat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen p-5">

    @php $unit_id = $_GET['unit']; @endphp
    <input type="hidden" id="pertandingan_id" value="{{ $pertandingan->id ?? '0' }}">
    <input type="hidden" id="user_id" value="{{ $user->id ?? '0' }}">
    <input type="hidden" id="role" value="dewan">

     @if ($unit_id == 'unit_1')
        
    <input type="hidden" name="unit_id" id="unit_id" value="{{ $pertandingan->unit1_id ?? '0' }}">

    @else
    <input type="hidden" name="unit_id" id="unit_id" value="{{ $pertandingan->unit2_id ?? '0' }}">    

    @endif


    <div class="max-w-6xl mx-auto bg-white shadow-lg">
        <div class="bg-white border-b border-gray-200 px-6 py-4">
            <div class="flex justify-between items-start">
                <div>
                    <div class="text-red-600 text-xs font-semibold uppercase tracking-wide">PELATIH</div>
                    <div class="text-red-700 font-semibold text-sm mt-1">NAMA PELATIH</div>
                </div>
                <div class="text-right">
                    <div class="text-gray-700 font-semibold text-sm">Arena A, Match 1</div>
                    <div class="text-gray-600 text-sm mt-1">GANDA</div>
                </div>
            </div>
        </div>

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
                        <tr class="hover:bg-gray-50" data-type="waktu">
                            <td class="px-4 py-3 text-sm text-gray-700">WAKTU</td>
                            <td class="px-4 py-3 text-center"><button onclick="clearPenalty(0)" class="bg-blue-500 text-white px-9 py-5 rounded-md hover:bg-blue-600 text-xs font-medium transition-colors">Clear</button></td>
                            <td class="px-4 py-3 text-center"><button onclick="addPenalty(0)" class="bg-red-500 text-white px-9 py-5 rounded-md hover:bg-red-600 text-xs font-bold transition-colors">-0.50</button></td>
                            <td class="px-4 py-3 text-center text-gray-700 font-semibold text-sm" id="total-0">0.00</td>
                        </tr>
                        <tr class="hover:bg-gray-50" data-type="keluar_garis">
                            <td class="px-4 py-3 text-sm text-gray-700">SETIAP KALI KELUAR GARIS</td>
                            <td class="px-4 py-3 text-center"><button onclick="clearPenalty(1)" class="bg-blue-500 text-white px-9 py-5 rounded-md hover:bg-blue-600 text-xs font-medium transition-colors">Clear</button></td>
                            <td class="px-4 py-3 text-center"><button onclick="addPenalty(1)" class="bg-red-500 text-white px-9 py-5 rounded-md hover:bg-red-600 text-xs font-bold transition-colors">-0.50</button></td>
                            <td class="px-4 py-3 text-center text-gray-700 font-semibold text-sm" id="total-1">0.00</td>
                        </tr>
                        <tr class="hover:bg-gray-50" data-type="senjata_jatuh_tidak_sesuai">
                            <td class="px-4 py-3 text-sm text-gray-700">SETIAP KALI SENJATA JATUH TIDAK SESUAI DESKRIPSI</td>
                            <td class="px-4 py-3 text-center"><button onclick="clearPenalty(2)" class="bg-blue-500 text-white px-9 py-5 rounded-md hover:bg-blue-600 text-xs font-medium transition-colors">Clear</button></td>
                            <td class="px-4 py-3 text-center"><button onclick="addPenalty(2)" class="bg-red-500 text-white px-9 py-5 rounded-md hover:bg-red-600 text-xs font-bold transition-colors">-0.50</button></td>
                            <td class="px-4 py-3 text-center text-gray-700 font-semibold text-sm" id="total-2">0.00</td>
                        </tr>
                        <tr class="hover:bg-gray-50" data-type="senjata_tidak_jatuh">
                            <td class="px-4 py-3 text-sm text-gray-700">SENJATA TIDAK JATUH SESUAI DESKRIPSI</td>
                            <td class="px-4 py-3 text-center"><button onclick="clearPenalty(3)" class="bg-blue-500 text-white px-9 py-5 rounded-md hover:bg-blue-600 text-xs font-medium transition-colors">Clear</button></td>
                            <td class="px-4 py-3 text-center"><button onclick="addPenalty(3)" class="bg-red-500 text-white px-9 py-5 rounded-md hover:bg-red-600 text-xs font-bold transition-colors">-0.50</button></td>
                            <td class="px-4 py-3 text-center text-gray-700 font-semibold text-sm" id="total-3">0.00</td>
                        </tr>
                        <tr class="hover:bg-gray-50" data-type="salam_suara">
                            <td class="px-4 py-3 text-sm text-gray-700">TIDAK ADA SALAM & SETIAP KALI MENGELUARKAN SUARA</td>
                            <td class="px-4 py-3 text-center"><button onclick="clearPenalty(4)" class="bg-blue-500 text-white px-9 py-5 rounded-md hover:bg-blue-600 text-xs font-medium transition-colors">Clear</button></td>
                            <td class="px-4 py-3 text-center"><button onclick="addPenalty(4)" class="bg-red-500 text-white px-9 py-5 rounded-md hover:bg-red-600 text-xs font-bold transition-colors">-0.50</button></td>
                            <td class="px-4 py-3 text-center text-gray-700 font-semibold text-sm" id="total-4">0.00</td>
                        </tr>
                        <tr class="hover:bg-gray-50" data-type="baju_senjata_rusak">
                            <td class="px-4 py-3 text-sm text-gray-700">BAJU / SENJATA TIDAK SESUAI (PATAH)</td>
                            <td class="px-4 py-3 text-center"><button onclick="clearPenalty(5)" class="bg-blue-500 text-white px-9 py-5 rounded-md hover:bg-blue-600 text-xs font-medium transition-colors">Clear</button></td>
                            <td class="px-4 py-3 text-center"><button onclick="addPenalty(5)" class="bg-red-500 text-white px-9 py-5 rounded-md hover:bg-red-600 text-xs font-bold transition-colors">-0.50</button></td>
                            <td class="px-4 py-3 text-center text-gray-700 font-semibold text-sm" id="total-5">0.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 flex justify-between items-center bg-gray-50 px-4 py-3 rounded-md border">
                <div class="text-lg font-bold text-gray-700">Total</div>
                <div class="text-red-600 text-xl font-bold" id="grandTotal">0.00</div>
            </div>
        </div>
    </div>

    <script>
        let penalties = [
            { active: false, value: -0.50 }, { active: false, value: -0.50 },
            { active: false, value: -0.50 }, { active: false, value: -0.50 },
            { active: false, value: -0.50 }, { active: false, value: -0.50 }
        ];
        let isLoading = false;
        const PERTANDINGAN_ID = document.getElementById('pertandingan_id').value;
        const USER_ID = document.getElementById('user_id').value;
        const ROLE = document.getElementById('role').value;
        
        function toggleAllButtons(disabled) {
            isLoading = disabled;
            document.querySelectorAll('#penaltyTable button').forEach(b => {
                b.disabled = disabled;
                b.classList.toggle('opacity-50', disabled);
            });
        }
        
        function kirimPoinSeni(type, poin) {
            if (isLoading) return;
            toggleAllButtons(true);

            fetch(`/kirim-poin-seni/${USER_ID}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    poin: poin,
                    type: type,
                    filter: 'penilaian_hukuman_ganda',
                    pertandingan_id: PERTANDINGAN_ID,
                    role: ROLE,
                    unit_id: document.getElementById('unit_id').value,
                }),
            })
            .then(res => res.ok ? res.json() : Promise.reject('Network response was not ok'))
            .then(data => console.log("Data berhasil dikirim:", data))
            .catch(error => {
                console.error("Fetch error:", error);
                alert("Terjadi kesalahan saat mengirim data.");
            })
            .finally(() => toggleAllButtons(false));
        }

        function addPenalty(index) {
            if (penalties[index].active) return;
            penalties[index].active = true;
            
            const penaltyType = document.querySelector(`#penaltyTable tr:nth-child(${index + 1})`).dataset.type;
            kirimPoinSeni(penaltyType, penalties[index].value);
            updateUI();
        }

        function clearPenalty(index) {
            if (!penalties[index].active) return;
            penalties[index].active = false;
            
            const penaltyType = document.querySelector(`#penaltyTable tr:nth-child(${index + 1})`).dataset.type;
            kirimPoinSeni('clear_' + penaltyType, Math.abs(penalties[index].value));
            updateUI();
        }

        function updateUI() {
            let grandTotal = 0;
            penalties.forEach((penalty, index) => {
                const row = document.querySelector(`#penaltyTable tr:nth-child(${index + 1})`);
                const totalCell = document.getElementById(`total-${index}`);
                
                if (penalty.active) {
                    row.classList.add('bg-red-50');
                    totalCell.textContent = penalty.value.toFixed(2);
                    totalCell.classList.add('text-red-600');
                    grandTotal += penalty.value;
                } else {
                    row.classList.remove('bg-red-50');
                    totalCell.textContent = '0.00';
                    totalCell.classList.remove('text-red-600');
                }
            });
            document.getElementById('grandTotal').textContent = grandTotal.toFixed(2);
        }

        document.addEventListener('DOMContentLoaded', updateUI);
    </script>
</body>
</html>
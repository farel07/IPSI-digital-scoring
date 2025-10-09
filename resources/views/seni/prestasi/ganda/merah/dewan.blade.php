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

    @php
        // ==============================================================================
        // LOGIKA HYBRID UNTUK MENDUKUNG DATA LAMA & BARU
        // ==============================================================================
        $requestedUnitParam = request('unit', 'unit_1');

        // Cek apakah ini data format lama
        if ($pertandingan->unit1_id) {
            // Gunakan aksesor lama
            $unit1_peserta = $pertandingan->pemain_unit_1;
            $unit2_peserta = $pertandingan->pemain_unit_2;
            $selectedPeserta = ($requestedUnitParam == 'unit_1') ? $unit1_peserta : $unit2_peserta;
            $selectedUnitId = ($requestedUnitParam == 'unit_1') ? $pertandingan->unit1_id : $pertandingan->unit2_id;
            $requestedIndex = ($requestedUnitParam == 'unit_1') ? 0 : 1;
        } else {
            // Gunakan logika baru
            $allPeserta = $pertandingan->grouped_peserta;
            preg_match('/(\d+)/', $requestedUnitParam, $matches);
            $requestedIndex = isset($matches[1]) ? (int)$matches[1] - 1 : 0;
            
            $unitIdArray = $allPeserta->keys()->values();
            $unitDataArray = $allPeserta->values();
            
            $selectedUnitId = $unitIdArray->get($requestedIndex);
            $selectedPeserta = $unitDataArray->get($requestedIndex, collect());
        }

        // Logika untuk waktu (tidak berubah)
        $waktu_tampil_detik = $penalti_terakhir->waktu_tampil ?? 0;
        $menit_tersimpan = floor($waktu_tampil_detik / 60);
        $sisa_detik = $waktu_tampil_detik % 60;
        $detik_puluhan_tersimpan = floor($sisa_detik / 10);
        $detik_satuan_tersimpan = $sisa_detik % 10;
    @endphp

    <input type="hidden" id="pertandingan_id" value="{{ $pertandingan->id ?? '0' }}">
    <input type="hidden" id="user_id" value="{{ $user->id ?? '0' }}">
    <input type="hidden" id="role" value="dewan">
    <input type="hidden" name="unit_id" id="unit_id" value="{{ $selectedUnitId }}">

    <div class="max-w-6xl mx-auto bg-white shadow-lg">
        <div class="bg-white border-b border-gray-200 px-6 py-4">
            <div class="flex justify-between items-start">
                <div>
                    @if(isset($selectedPeserta) && $selectedPeserta->isNotEmpty())
                        <div class="text-red-600 text-xs font-semibold uppercase tracking-wide">UNIT {{ $requestedIndex + 1 }}</div>
                        <div class="text-red-700 font-semibold text-sm mt-1">
                            @foreach($selectedPeserta as $peserta)
                                <span>{{ $peserta->player->name }}</span>{{ !$loop->last ? ' & ' : '' }}
                            @endforeach
                        </div>
                        <div class="text-sm text-gray-600">{{ $selectedPeserta->first()->player->contingent->name }}</div>
                    @endif
                </div>
                <div class="text-right">
                    <div class="text-gray-700 font-semibold text-sm">{{ $pertandingan->arena->arena_name ?? 'Arena' }}, Match {{ $pertandingan->match_number }}</div>
                    <div class="text-gray-600 text-sm mt-1">{{ $pertandingan->kelasPertandingan->kategoriPertandingan->nama_kategori }}</div>
                </div>
            </div>
        </div>
        
        <div class="p-6">
            <div class="border border-gray-300 rounded-md shadow-sm overflow-hidden">
                <div class="p-4 border-b">
                    <div class="flex justify-between items-center">
                        <div class="w-1/3">
                            <label for="unit" class="block text-sm font-medium text-gray-700 mb-1">Pilih Unit:</label>
                            
                            {{-- Dropdown dengan logika hybrid --}}
                            <select name="unit" id="unit" class="border-gray-300 rounded-md shadow-sm w-full">
                                @if ($pertandingan->unit1_id)
                                    {{-- Tampilkan opsi statis untuk data lama --}}
                                    <option value="unit_1" {{ $requestedUnitParam == 'unit_1' ? 'selected' : '' }}>Unit 1</option>
                                    <option value="unit_2" {{ $requestedUnitParam == 'unit_2' ? 'selected' : '' }}>Unit 2</option>
                                @else
                                    {{-- Tampilkan opsi dinamis untuk data baru --}}
                                    @foreach ($pertandingan->grouped_peserta as $unit_id => $peserta_list)
                                        @php $loopIndex = $loop->iteration; @endphp
                                        <option value="unit_{{ $loopIndex }}" {{ $requestedUnitParam == 'unit_'.$loopIndex ? 'selected' : '' }}>
                                            Unit {{ $loopIndex }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        
                        <div class="w-2/3 text-center">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Tampil (M:DS)</label>
                            <div class="flex items-center justify-center gap-1">
                                <select id="menitSelect" class="border-gray-300 rounded-md shadow-sm">
                                    @for ($m = 0; $m <= 3; $m++)
                                        <option value="{{ $m }}" {{ $m == $menit_tersimpan ? 'selected' : '' }}>{{ sprintf('%02d', $m) }}</option>
                                    @endfor
                                </select>
                                <span class="font-bold">:</span>
                                <select id="detikPuluhanSelect" class="border-gray-300 rounded-md shadow-sm">
                                    @for ($d = 0; $d <= 5; $d++)
                                        <option value="{{ $d }}" {{ $d == $detik_puluhan_tersimpan ? 'selected' : '' }}>{{ $d }}</option>
                                    @endfor
                                </select>
                                <select id="detikSatuanSelect" class="border-gray-300 rounded-md shadow-sm">
                                    @for ($d = 0; $d <= 9; $d++)
                                        <option value="{{ $d }}" {{ $d == $detik_satuan_tersimpan ? 'selected' : '' }}>{{ $d }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById('unit').addEventListener('change', function () {
                        const selected = this.value;
                        const currentUrl = new URL(window.location.href);
                        currentUrl.searchParams.set('unit', selected);
                        window.location.href = currentUrl.toString();
                    });
                </script>

                <table class="w-full">
                    {{-- ... Bagian tabel lainnya tidak berubah ... --}}
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
                <button onclick="simpanWaktuTampil()" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg transition-colors">
                    Simpan Waktu
                </button>
                <div class="text-right">
                    <span class="text-lg font-bold text-gray-700">Total:</span>
                    <span class="text-red-600 text-xl font-bold" id="grandTotal">0.00</span>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript tidak perlu diubah --}}
    <script>
        let penalties=[{value:-.5,total:0},{value:-.5,total:0},{value:-.5,total:0},{value:-.5,total:0},{value:-.5,total:0},{value:-.5,total:0}];let isLoading=!1;const PERTANDINGAN_ID=document.getElementById("pertandingan_id").value,USER_ID=document.getElementById("user_id").value,ROLE=document.getElementById("role").value;
        function toggleAllButtons(e){isLoading=e;document.querySelectorAll(".max-w-6xl button").forEach(t=>{t.disabled=e,t.classList.toggle("opacity-50",e)})}
        function kirimDataWaktu(total_detik) {
            if (isLoading) return;
            toggleAllButtons(true);
            fetch(`/kirim-poin-seni/${USER_ID}`, {
                method: "POST",
                headers: {"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"), "Content-Type": "application/json"},
                body: JSON.stringify({
                    poin: total_detik,
                    type: 'waktu_tampil_ganda',
                    filter: 'penilaian_hukuman_ganda',
                    pertandingan_id: PERTANDINGAN_ID,
                    role: ROLE,
                    unit_id: document.getElementById("unit_id").value,
                }),
            })
            .then(res => res.ok ? res.json() : Promise.reject('Network error'))
            .then(data => {
                console.log("Waktu berhasil dikirim:", data);
                alert('Waktu tampil berhasil disimpan!');
            })
            .catch(error => {
                console.error("Fetch error:", error);
                alert("Terjadi kesalahan saat menyimpan waktu.");
            })
            .finally(() => toggleAllButtons(false));
        }
        function simpanWaktuTampil() {
            const menit = parseInt(document.getElementById('menitSelect').value);
            const detikPuluhan = parseInt(document.getElementById('detikPuluhanSelect').value);
            const detikSatuan = parseInt(document.getElementById('detikSatuanSelect').value);
            const totalDetik = (menit * 60) + (detikPuluhan * 10) + detikSatuan;
            kirimDataWaktu(totalDetik);
        }
        function kirimPoinSeni(e,t){isLoading||(toggleAllButtons(!0),fetch(`/kirim-poin-seni/${USER_ID}`,{method:"POST",headers:{"X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content"),"Content-Type":"application/json"},body:JSON.stringify({poin:t,type:e,filter:"penilaian_hukuman_ganda",pertandingan_id:PERTANDINGAN_ID,role:ROLE,unit_id:document.getElementById("unit_id").value})}).then(e=>e.ok?e.json():Promise.reject("Network response was not ok")).then(e=>console.log("Data berhasil dikirim:",e)).catch(e=>{console.error("Fetch error:",e),alert("Terjadi kesalahan saat mengirim data.")}).finally(()=>toggleAllButtons(!1)))}
        function addPenalty(e){penalties[e].total+=penalties[e].value;const t=document.querySelector(`#penaltyTable tr:nth-child(${e+1})`).dataset.type;kirimPoinSeni(t,penalties[e].value),updateUI()}
        function clearPenalty(e){if(0===penalties[e].total)return;penalties[e].total=0;const t=document.querySelector(`#penaltyTable tr:nth-child(${e+1})`).dataset.type;kirimPoinSeni("clear_"+t,0),updateUI()}
        function updateUI(){let e=0;penalties.forEach((t,n)=>{const l=document.querySelector(`#penaltyTable tr:nth-child(${n+1})`),o=document.getElementById(`total-${n}`);o.textContent=t.total.toFixed(2),e+=t.total,t.total<0?(l.classList.add("bg-red-50"),o.classList.add("text-red-600")):(l.classList.remove("bg-red-50"),o.classList.remove("text-red-600"))}),document.getElementById("grandTotal").textContent=e.toFixed(2)}
        document.addEventListener("DOMContentLoaded",()=>{const e=@json($penalti_terakhir);if(e){const t={waktu_terlampaui:0,keluar_garis:1,senjata_jatuh:2,senjata_tidak_jatuh:3,tidak_ada_salam:4,baju_senjata:5};for(const[n,l]of Object.entries(t))penalties[l].total=parseFloat(e[n])||0}
        updateUI()});
    </script>
</body>
</html>
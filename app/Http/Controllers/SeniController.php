<?php

namespace App\Http\Controllers;

// ... (use statement lainnya)
use App\Models\User;
use App\Models\Pertandingan;
use App\Models\HasilPoinSeniTunggalRegu;   // <-- PASTIKAN INI ADA
use App\Models\DetailPoinSeniJuriTunggalRegu; // <-- PASTIKAN INI ADA
use App\Models\HasilPoinSeniGanda;
use App\Models\DetailPoinSeniJuriGanda;
use Illuminate\Http\Request;
use App\Events\KirimPoinSeni;

class SeniController extends Controller
{
    public function kirim_poin_seni(User $user, Request $request){
        $arenaId = $user->user_arena->first()->arena_id ?? null;
        $poin = $request->poin;
        $filter = $request->filter;
        $type = $request->type;
        $role = $user->role->name; 
        $unit_id = $request->unit_id;

       

        if (!$arenaId) {
            abort(404, 'Juri ini tidak ditugaskan ke arena manapun.');
        }

        $pertandingan = Pertandingan::with('kelasPertandingan.kelas')
            ->where('arena_id', $arenaId)
            ->where('status', 'berlangsung')
            ->first();

        if (!$pertandingan) {
            abort(404, 'Tidak ada pertandingan yang sedang berlangsung di arena ini.');
        }

       if($request->filter == 'penilaian_ganda' || $request->filter == 'penilaian_hukuman_ganda'){
            
           // Logika untuk pertandingan ganda
           if($role == 'dewan'){

            $baseType = str_replace('clear_', '', $type);

    // Peta dari 'type' frontend ke nama kolom database
    $columnMap = [
        'waktu' => 'waktu_terlampaui',
        'keluar_garis' => 'keluar_garis',
        'senjata_jatuh_tidak_sesuai' => 'senjata_jatuh', // Perhatikan, ini mungkin perlu disesuaikan
        'senjata_tidak_jatuh' => 'senjata_tidak_jatuh',
        'salam_suara' => 'tidak_ada_salam',
        'baju_senjata_rusak' => 'baju_senjata',
        'time_performance' => 'performance_time',
    ];
    $columnToUpdate = $columnMap[$baseType] ?? null;

    // return response()->json([
    //     'columnToUpdate' => $columnMap[$baseType]
    // ]);


    if ($columnToUpdate) {
        $hasilPoin = HasilPoinSeniGanda::firstOrCreate(
            [
                'pertandingan_id' => $pertandingan->id,
                'unit_id' => $unit_id, // Anda perlu memastikan unit_id dikirim
            ]
        );

        if($columnMap[$baseType] == 'performance_time'){
            // Ubah format poin dari detik ke waktu (HH:MM:SS)
            $hours = floor($poin / 3600);
            $minutes = floor(($poin % 3600) / 60);
            $seconds = $poin % 60;
            $formattedTime = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
            $hasilPoin->{$columnToUpdate} = $formattedTime;
        } else {
            // Operasi penambahan/pengurangan
            $hasilPoin->{$columnToUpdate} += $poin;
        }
        $hasilPoin->save();

        return response()->json([
'status' => 'berhasil'
        ]);
        
    }


           } else {

            $detail_poin = DetailPoinSeniJuriGanda::firstOrCreate(
                    [
                        'pertandingan_id' => $pertandingan->id,
                        'user_id' => $user->id,
                        'unit_id' => $unit_id,
                    ]
                );
                

                // Tentukan kolom mana yang akan diupdate berdasarkan 'type' dari request
                $columnMap = [
                    'teknik'     => 'teknik_dasar',
                    'kekuatan'   => 'kekuatan_kecepatan',
                    'penampilan' => 'penampilan_gaya',
                ];
                $columnToUpdate = $columnMap[$type] ?? null;

                if ($columnToUpdate) {
                    // Langkah 1: Update kolom yang sesuai dengan nilai poin baru
                    $detail_poin->{$columnToUpdate} = $poin;


                    // Langkah 2: Hitung ulang total skor dengan skor dasar 9.10
                    $detail_poin->total_skor = 9.10 
                                            + $detail_poin->teknik_dasar 
                                            + $detail_poin->kekuatan_kecepatan 
                                            + $detail_poin->penampilan_gaya;
                    

                    // Langkah 3: Simpan semua perubahan
                    $detail_poin->save();

                }

                $this->kalkulasiDanSimpanHasilAkhirGanda($pertandingan->id, $unit_id);

           }
       } else {

         if ($role == 'dewan'){
            // ==========================================================
            // === LOGIKA UNTUK DEWAN JURI (PENALTI) ===
            // ==========================================================
            $nama_kolom = null;
            $tipe_dasar = str_replace('clear_', '', $type);

            switch ($tipe_dasar) {
                case 'waktu': $nama_kolom = 'waktu_terlampaui'; break;
                case 'keluar_garis': $nama_kolom = 'keluar_garis'; break;
                case 'pakaian': $nama_kolom = 'pakaian'; break;
                case 'senjata_jatuh': $nama_kolom = 'senjata_jatuh'; break;
                case 'berhenti': $nama_kolom = 'stop'; break;
                case 'performance_time': $nama_kolom = 'performance_time'; break;
            }
            // return response()->json(['nama_kolom' => $nama_kolom, 'poin' => $poin]);
            if ($nama_kolom) {
                $hasil_poin = HasilPoinSeniTunggalRegu::firstOrCreate(
                    ['pertandingan_id' => $pertandingan->id, 'unit_id' => $unit_id]
                );
                if($nama_kolom == 'performance_time'){
                    // Ubah format poin dari detik ke waktu (HH:MM:SS)
                    $hours = floor($poin / 3600);
                    $minutes = floor(($poin % 3600) / 60);
                    $seconds = $poin % 60;
                    $formattedTime = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                    $hasil_poin->{$nama_kolom} = $formattedTime;
                } else {
                    $hasil_poin->{$nama_kolom} += $poin;
                }

                // return response()->json(['nama_kolom' => $nama_kolom, 'poin' => $hasil_poin->{$nama_kolom}]);
                // $hasil_poin->{$nama_kolom} += $poin;
                $hasil_poin->save();
            }

        } else {

              
            // ==========================================================
            // === LOGIKA UNTUK JURI TEKNIK (SKORING) ===
            // ==========================================================
            
            // Cari record, atau buat baru dengan nilai default yang benar
            $detail_poin = DetailPoinSeniJuriTunggalRegu::firstOrCreate(
                [
                    'pertandingan_id' => $pertandingan->id,
                    'user_id' => $user->id,
                    'unit_id' => $unit_id,
                ],
                [
                    // Nilai default ini hanya akan diisi jika record BARU dibuat
                    'total_kesalahan' => 0.00,
                    'poin_stamina'    => 0.00,
                    'poin_benar'      => 9.90, // 9.90 - 0.00
                    'total_skor'      => 9.90, // 9.90 + 0.00
                ]
            );

            // Langkah 1: Ubah nilai dasar berdasarkan input
            if ($type == 'wrong_move') {
                $detail_poin->total_kesalahan += 0.01;
            } else if ($type == 'flow_stamina') {
                $detail_poin->poin_stamina = $poin;
            }

            // Langkah 2: Lakukan kalkulasi ulang SEMUA nilai terkait
            $detail_poin->poin_benar = 9.90 - $detail_poin->total_kesalahan;
            $detail_poin->total_skor = $detail_poin->poin_benar + $detail_poin->poin_stamina;

            // Langkah 3: Simpan hasil akhir ke database
            $detail_poin->save();

            
        }

         $this->kalkulasiDanSimpanHasilAkhir($pertandingan->id, $unit_id);

       }
            
       


         event(new KirimPoinSeni($poin, $filter, $pertandingan->id, $type, $role, $unit_id));

        // event(new KirimPoinSeni($poin, $filter, $pertandingan->id, $type, $role)); // Sesuaikan event jika perlu
        return response()->json([
            'status' => 'berhasil', 
            'request' => $request->all(), 
            'pertandingan' => $pertandingan->id, 
            'role' => $role,
        ]);
    }



    private function kalkulasiDanSimpanHasilAkhirGanda(int $pertandinganId, int $unitId)
    {
        // 1. Ambil semua total skor dari semua juri untuk pertandingan & unit ini
        $scores = DetailPoinSeniJuriGanda::where('pertandingan_id', $pertandinganId)
            ->where('unit_id', $unitId)
            ->pluck('total_skor');

        if ($scores->isEmpty()) {
            return;
        }

        $median = 0;
        $std_dev = 0;

        // 2. Hitung Median (Rata-rata Median untuk jumlah genap)
        $sortedScores = $scores->sort()->values();
        $count = $sortedScores->count();
        $midIndex = floor($count / 2);

        if ($count > 0 && $count % 2 == 0) {
            $mid1 = $sortedScores[$midIndex - 1];
            $mid2 = $sortedScores[$midIndex];
            $median = ($mid1 + $mid2) / 2;
        } else if ($count > 0) {
            $median = $sortedScores[$midIndex];
        }

        // 3. Hitung Standar Deviasi
        if ($count > 0) {
            $mean = $scores->avg();
            $variance = $scores->map(function ($score) use ($mean) {
                return pow($score - $mean, 2);
            })->sum() / $count;
            $std_dev = sqrt($variance);
        }

        // 4. Simpan hasil kalkulasi ke tabel 'hasil_poin_seni_ganda'
        HasilPoinSeniGanda::updateOrCreate(
            [
                'pertandingan_id' => $pertandinganId,
                'unit_id' => $unitId,
            ],
            [
                'poin_final_median' => $median,
                'poin_std' => $std_dev,
            ]
        );
    }




    private function kalkulasiDanSimpanHasilAkhir(int $pertandinganId, int $unitId)
    {
        // 1. Ambil semua total skor dari semua juri untuk pertandingan & unit ini
        $scores = DetailPoinSeniJuriTunggalRegu::where('pertandingan_id', $pertandinganId)
            ->where('unit_id', $unitId)
            ->pluck('total_skor');

        // Jika tidak ada skor sama sekali, jangan lakukan apa-apa
        if ($scores->isEmpty()) {
            return;
        }

        $median = 0;
        $std_dev = 0;

        // 2. Hitung Median (Rata-rata Median untuk jumlah genap)
        $sortedScores = $scores->sort()->values();
        $count = $sortedScores->count();
        $midIndex = floor($count / 2);

        if ($count % 2 == 0) {
            // Genap: rata-rata dari dua nilai tengah
            $mid1 = $sortedScores[$midIndex - 1];
            $mid2 = $sortedScores[$midIndex];
            $median = ($mid1 + $mid2) / 2;
        } else {
            // Ganjil: nilai tengah
            $median = $sortedScores[$midIndex];
        }

        // 3. Hitung Standar Deviasi
        if ($count > 0) {
            $mean = $scores->avg();
            $variance = $scores->map(function ($score) use ($mean) {
                return pow($score - $mean, 2);
            })->sum() / $count;
            $std_dev = sqrt($variance);
        }

        // 4. Simpan hasil kalkulasi ke tabel 'hasil_poin_seni_tunggal_regu'
        HasilPoinSeniTunggalRegu::updateOrCreate(
            [
                'pertandingan_id' => $pertandinganId,
                'unit_id' => $unitId,
            ],
            [
                'poin_final_median' => $median,
                'poin_std' => $std_dev,
            ]
        );
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\HasilPoinSeniGanda;
use Illuminate\Http\Request;
use App\Models\Pertandingan;
use App\Models\User;
use Illuminate\Validation\Rule;
use App\Models\HasilPoinSeniTunggalRegu;
use App\Models\DetailPointTanding;

class operatorController extends Controller
{
    public function index(User $user)
    {
        $userArena = $user->user_arena->first();
        $arenaId = $userArena->arena_id ?? null;

        if (!$arenaId) {
            abort(404, 'Operator ini tidak ditugaskan ke arena manapun.');
        }

        $daftar_pertandingan = Pertandingan::with([
            'kelasPertandingan.kelas',
            'kelasPertandingan.kategoriPertandingan',
            'kelasPertandingan.jenisPertandingan',
        ])
            ->where('arena_id', $arenaId)
            ->orderBy('id', 'asc')
            ->get();

        $arena = $userArena->arena ?? null;

        return view("scoring.operator", [
            'daftar_pertandingan' => $daftar_pertandingan,
            'arena' => $arena,
        ]);
    }

    public function updateStatus(Request $request, Pertandingan $pertandingan)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['menunggu_peserta', 'siap_dimulai', 'berlangsung', 'selesai', 'ditunda']),],
        ]);

        $pertandingan->status = $validated['status'];
        $pertandingan->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status pertandingan berhasil diperbarui!',
            'new_status' => $validated['status']
        ]);
    }

    public function viewPenontonFinal(User $user)
    {
       $arenaId = $user->user_arena->first()->arena_id ?? null;

        // 2. Tangani jika juri tidak punya arena
        if (!$arenaId) {
            abort(404, 'Juri ini tidak ditugaskan ke arena manapun.');
        }

        

        // 3. Cari satu pertandingan yang aktif di arena tersebut.
        // Kita tidak perlu lagi `with()` yang kompleks di sini.
        $pertandingan = Pertandingan::with('kelasPertandingan.kelas') // Cukup muat info kelas
            ->where('arena_id', $arenaId)
            ->where('status', 'berlangsung')
            ->first();

            $jumlah_pemain = $pertandingan->kelasPertandingan->kelas->jumlah_pemain;

            if ($pertandingan->kelasPertandingan->jenisPertandingan->id == 2 && ($jumlah_pemain == 1 || $jumlah_pemain == 3) && $pertandingan->kelasPertandingan->kelas->nama_kelas != "Tunggal Bebas"){

                $hasil_poin = HasilPoinSeniTunggalRegu::where('pertandingan_id', $pertandingan->id)->get();
            } else if($pertandingan->kelasPertandingan->jenisPertandingan->id == 2 && ($jumlah_pemain == 2 || ($jumlah_pemain == 1 && $pertandingan->kelasPertandingan->kelas->nama_kelas == "Tunggal Bebas"))){
               $hasil_poin = HasilPoinSeniGanda::where('pertandingan_id', $pertandingan->id)->get(); 
            }

            $hasil_poinBiru = $hasil_poin->where('unit_id', $pertandingan->unit1_id)->first();
            $hasil_poinMerah = $hasil_poin->where('unit_id', $pertandingan->unit2_id)->first();

            // return $hasil_poinBiru;

            // return $hasil_poin;

        return view('seni.prestasi.tunggal.penontonFinal', [
            'pertandingan' => $pertandingan,
            'hasil_poin' => $hasil_poin,
            'hasilBiru' => $hasil_poinBiru,
            'hasilMerah' => $hasil_poinMerah,
        ]);
    }

    public function showRekap(User $user)
    {
        // 1. Cari pertandingan yang sedang berlangsung untuk operator ini (logika yang sama dengan 'index')
        $userArena = $user->user_arena->first();
        $arenaId = $userArena->arena_id ?? null;
        if (!$arenaId) {
            abort(404, 'Operator ini tidak ditugaskan ke arena manapun.');
        }

        $pertandingan = Pertandingan::with('kelasPertandingan.kelas')
            ->where('arena_id', $arenaId)
            ->where('status', 'berlangsung')
            ->first();

        // Jika tidak ada pertandingan berlangsung, tampilkan pesan
        if (!$pertandingan) {
            return "Tidak ada pertandingan yang sedang berlangsung di arena Anda untuk direkap.";
        }

        // 2. Ambil semua detail poin dari semua ronde untuk pertandingan ini
        $allRoundsData = DetailPointTanding::where('pertandingan_id', $pertandingan->id)->get();

        // 3. Siapkan array untuk menampung total data dari database
        $rekapDb = [
            'biru' => ['jatuh' => 0, 'bina' => 0, 'tegur' => 0, 'peringat' => 0, 'total' => 0],
            'merah' => ['jatuh' => 0, 'bina' => 0, 'tegur' => 0, 'peringat' => 0, 'total' => 0]
        ];

        // 4. Loop dan jumlahkan semua poin pelanggaran dari setiap ronde
        foreach ($allRoundsData as $roundData) {
            $rekapDb['biru']['jatuh'] += $roundData->fall_point_1;
            $rekapDb['biru']['bina'] += $roundData->binaan_point_1;
            $rekapDb['biru']['tegur'] += $roundData->teguran_1;
            $rekapDb['biru']['peringat'] += $roundData->peringatan_1;

            $rekapDb['merah']['jatuh'] += $roundData->fall_point_2;
            $rekapDb['merah']['bina'] += $roundData->binaan_point_2;
            $rekapDb['merah']['tegur'] += $roundData->teguran_2;
            $rekapDb['merah']['peringat'] += $roundData->peringatan_2;

            // Ambil total poin HANYA dari ronde yang sedang berlangsung
            if ($roundData->round == $pertandingan->current_round) {
                $rekapDb['biru']['total'] = $roundData->total_point_1 ?? 0;
                $rekapDb['merah']['total'] = $roundData->total_point_2 ?? 0;
            }
        }

        // 5. Kirim data ke view
        return view('scoring.rekapOperator', [
            'pertandingan' => $pertandingan,
            'rekapDb'      => $rekapDb, // Kirim data yang sudah dihitung
        ]);
    }
}
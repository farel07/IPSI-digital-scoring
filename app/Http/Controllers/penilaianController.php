<?php

namespace App\Http\Controllers;

// Import model yang BENAR
use Illuminate\Http\Request;
use App\Models\Pertandingan;
use App\Models\User; // Digunakan untuk menerima juri/penilai dari URL
use App\Models\UserArena;

class penilaianController extends Controller
{
    /**
     * [DIPERBARUI TOTAL] - Menampilkan halaman penilaian untuk seorang Penilai (User).
     * Logika ini SAMA PERSIS dengan juriController Anda yang sudah bekerja.
     *
     * @param User $user Menerima objek Penilai (User) dari URL melalui Route Model Binding.
     */
    public function index(User $user)
    {
        if ($user->role->id !== 6) {
            abort(403, 'Akses ditolak. User ini bukan operator.');
        }
        // 1. Dapatkan arena ID milik Penilai/Juri ini.
        $arenaId = $user->user_arena->first()->arena_id ?? null;

        // 2. Tangani jika Penilai tidak punya arena.
        if (!$arenaId) {
            abort(404, 'Pengguna ini tidak ditugaskan ke arena manapun.');
        }

        // 3. Cari satu pertandingan yang aktif di arena tersebut.
        // [MODIFIKASI] Menambahkan 'detailPointTanding' untuk efisiensi di view.
        $pertandingan = Pertandingan::with([
            'kelasPertandingan.kelas',
            'kelasPertandingan.kategoriPertandingan',
            'detailPointTanding'
        ])
            ->where('arena_id', $arenaId)
            ->where('status', 'berlangsung')
            ->first();

               $daftar_juri = UserArena::with('user')
            ->where('arena_id', $arenaId)
            ->whereHas('user', function ($query) {
                $query->whereIn('role_id', [4, 7, 8, 10]); // Role ID 4 untuk Juri
            })
            ->get()
            ->pluck('user');

        // 4. Tangani jika TIDAK ADA pertandingan aktif di arena tersebut.
        if (!$pertandingan) {
            return "Saat ini belum ada pertandingan aktif di Arena Anda.";
        }

        $jumlah_pemain = $pertandingan->kelasPertandingan->kelas->jumlah_pemain;


        if($pertandingan->kelasPertandingan->jenisPertandingan->id == 2 && ($jumlah_pemain == 1 || $jumlah_pemain == 3)){
            return view('seni.prestasi.tunggal.biru.penonton', compact('user', 'pertandingan', 'daftar_juri'));
        } else if($pertandingan->kelasPertandingan->jenisPertandingan->id == 2 && $jumlah_pemain == 2){
            return view('seni.prestasi.ganda.biru.penonton', compact('user', 'pertandingan', 'daftar_juri'));
        }
        else {

            // 5. Kirim objek pertandingan yang ditemukan ke view 'scoring.penilaian'.
            return view("scoring.penilaian", [
                'pertandingan' => $pertandingan,
            ]);
        }

    }
}

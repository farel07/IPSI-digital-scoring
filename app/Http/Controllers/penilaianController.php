<?php

namespace App\Http\Controllers;

// Import model yang BENAR
use Illuminate\Http\Request;
use App\Models\Pertandingan;
use App\Models\User; // Digunakan untuk menerima juri/penilai dari URL

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
            ->where('status', 'siap_dimulai')
            ->first();

        // 4. Tangani jika TIDAK ADA pertandingan aktif di arena tersebut.
        if (!$pertandingan) {
            return "Saat ini belum ada pertandingan aktif di Arena Anda.";
        }

        // 5. Kirim objek pertandingan yang ditemukan ke view 'scoring.penilaian'.
        return view("scoring.penilaian", [
            'pertandingan' => $pertandingan,
        ]);
    }
}

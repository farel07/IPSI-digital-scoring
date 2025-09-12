<?php

namespace App\Http\Controllers;

// Import model yang BENAR
use Illuminate\Http\Request;
use App\Models\Pertandingan;
use App\Models\User;

// Hapus model lama yang tidak terpakai
// use App\Models\Matches;
// use App\Models\UserMatch;

class dewanController extends Controller
{
    /**
     * [DIPERBARUI TOTAL] Menampilkan halaman Dewan untuk seorang User.
     * Logika ini SAMA PERSIS dengan controller lain yang sudah bekerja.
     *
     * @param User $user Menerima objek Dewan (User) dari URL melalui Route Model Binding.
     */
    public function index(User $user)
    {

        if ($user->role->id !== 5) {
            abort(403, 'Akses ditolak. User ini bukan dewan.');
        }

        // 1. Dapatkan arena ID milik Dewan ini.
        $arenaId = $user->user_arena->first()->arena_id ?? null;

        // 2. Tangani jika Dewan tidak punya arena.
        if (!$arenaId) {
            abort(404, 'Dewan ini tidak ditugaskan ke arena manapun.');
        }

        // 3. Cari satu pertandingan aktif di arena tersebut dan muat semua relasi yang diperlukan.
        // Accessor di model `Pertandingan` akan menangani pengambilan data pemain.
        $pertandingan = Pertandingan::with('kelasPertandingan.kelas') // Cukup muat info kelas
            ->where('arena_id', $arenaId)
            ->where('status', 'siap_dimulai')
            ->first();

            if (!$pertandingan) {
            // return view("scoring.juri_menunggu", ['user' => $user]);
            return "belum ada pertandingan aktif di arena Anda.";
        }

        // 4. Kirim objek pertandingan (atau null jika tidak ada) ke view.
        return view("scoring.dewan", [
            'pertandingan' => $pertandingan,
        ]);
    }
}
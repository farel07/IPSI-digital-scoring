<?php

namespace App\Http\Controllers;

// Import model yang BENAR
use Illuminate\Http\Request;
use App\Models\Pertandingan;
use App\Models\User; // Digunakan untuk menerima juri/penilai dari URL

// Hapus model lama jika tidak digunakan lagi di file ini
// use App\Models\Matches;
// use App\Models\UserMatch;

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
        // Asumsi seorang user hanya ditugaskan pada satu arena.
        $arenaId = $user->user_arena->first()->arena_id ?? null;

        // 2. Tangani jika Penilai tidak punya arena.
        if (!$arenaId) {
            // Memberikan pesan error yang jelas jika tidak ada arena yang ditugaskan.
            abort(404, 'Pengguna ini tidak ditugaskan ke arena manapun.');
        }

        // 3. Cari satu pertandingan yang aktif di arena tersebut.
        // Kita menggunakan `with()` untuk memuat relasi dasar agar lebih efisien di view.
        // Relasi pemain akan dihandle oleh Accessor di Model.
        $pertandingan = Pertandingan::with('kelasPertandingan.kelas', 'kelasPertandingan.kategoriPertandingan')
            ->where('arena_id', $arenaId)
            ->where('status', 'siap_dimulai')
            ->first(); // Mengambil hanya SATU pertandingan yang siap.

        // 4. Tangani jika TIDAK ADA pertandingan aktif di arena tersebut.
        if (!$pertandingan) {
            // Alih-alih menampilkan halaman kosong yang bisa error,
            // kita berikan pesan yang jelas atau view khusus "menunggu".
            return "Saat ini belum ada pertandingan aktif di Arena Anda.";
            // Atau jika Anda punya view "menunggu":
            // return view("scoring.penilaian_menunggu", ['user' => $user]);
        }
        
        // 5. Kirim objek pertandingan yang ditemukan ke view 'scoring.penilaian'.
        return view("scoring.penilaian", [
            'pertandingan' => $pertandingan,
        ]);
    }
}
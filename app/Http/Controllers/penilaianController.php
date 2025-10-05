<?php

namespace App\Http\Controllers;

// Import model yang BENAR
use App\Models\Pertandingan;
use Illuminate\Http\Request;
use App\Models\DetailPointTanding;
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
        if ($user->role->id !== 6) {
            abort(403, 'Akses ditolak. User ini bukan operator.');
        }

        $arenaId = $user->user_arena->first()->arena_id ?? null;
        if (!$arenaId) {
            abort(404, 'Pengguna ini tidak ditugaskan ke arena manapun.');
        }

        $pertandingan = Pertandingan::with([
            'kelasPertandingan.kategoriPertandingan',
            'kelasPertandingan.kelas',
        ])
            ->where('arena_id', $arenaId)
            ->where('status', 'berlangsung')
            ->first();

        if (!$pertandingan) {
            return view("scoring.penilaian", [
                'pertandingan' => null, // Kirim null agar view menampilkan pesan "tidak ada pertandingan"
            ]);
        }

        // [PERUBAHAN UTAMA UNTUK MENGATASI ERROR 'NULL']

        // 1. Coba cari detail poin untuk ronde yang sedang aktif.
        $detailPoint = DetailPointTanding::where('pertandingan_id', $pertandingan->id)
            ->where('round', $pertandingan->current_round)
            ->first();

        // 2. Jika TIDAK ADA data poin untuk ronde ini (misal, pertandingan baru mulai ronde 1),
        //    buat objek DetailPointTanding baru yang kosong.
        if (!$detailPoint) {
            // `new` hanya membuat objek di memori, tidak menyimpannya ke database.
            // Objek ini akan memiliki semua nilai default (0) dari migrasi Anda.
            $detailPoint = new DetailPointTanding([
                'pertandingan_id' => $pertandingan->id,
                'round' => $pertandingan->current_round,
            ]);
        }

        // 3. Pasangkan objek $detailPoint (baik yang dari database atau yang baru dibuat)
        //    ke dalam relasi di objek $pertandingan.
        $pertandingan->setRelation('detailPointTanding', $detailPoint);

        // Kirim data ke view. Sekarang dijamin `$pertandingan->detailPointTanding` tidak akan pernah null.
        return view("scoring.penilaian", [
            'pertandingan' => $pertandingan,
        ]);
    }
}

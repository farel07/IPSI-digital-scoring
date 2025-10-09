<?php

namespace App\Http\Controllers;

// Import model yang BENAR
use App\Models\Pertandingan;
use Illuminate\Http\Request;
use App\Models\DetailPointTanding;
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


        if ($pertandingan->kelasPertandingan->jenisPertandingan->id == 2 && ($jumlah_pemain == 1 || $jumlah_pemain == 3)  && $pertandingan->kelasPertandingan->kelas->nama_kelas != "Tunggal Bebas") {
            return view('seni.prestasi.tunggal.biru.penonton', compact('user', 'pertandingan', 'daftar_juri'));
        } else if($pertandingan->kelasPertandingan->jenisPertandingan->id == 2 && ($jumlah_pemain == 2 || ($jumlah_pemain == 1 && $pertandingan->kelasPertandingan->kelas->nama_kelas == "Tunggal Bebas"))){
            return view('seni.prestasi.ganda.biru.penonton', compact('user', 'pertandingan', 'daftar_juri'));
        } else {
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

            // 5. Kirim objek pertandingan yang ditemukan ke view 'scoring.penilaian'.
            return view("scoring.penilaian", [
                'pertandingan' => $pertandingan,
            ]);
        }
    }
}

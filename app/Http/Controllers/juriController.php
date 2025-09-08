<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matches;
use App\Models\User;
use App\Models\UserMatch;
use App\Models\Pertandingan;

class juriController extends Controller
{
    public function index(User $user)
    {

        // 1. Dapatkan arena ID milik juri.
        $arenaId = $user->user_arena->first()->arena_id ?? null;

        // 2. Tangani jika juri tidak punya arena
        if (!$arenaId) {
            abort(404, 'Juri ini tidak ditugaskan ke arena manapun.');
        }

        // 3. Cari satu pertandingan yang aktif di arena tersebut.
        // Kita tidak perlu lagi `with()` yang kompleks di sini.
        $pertandingan = Pertandingan::with('kelasPertandingan.kelas') // Cukup muat info kelas
            ->where('arena_id', $arenaId)
            ->where('status', 'siap_dimulai')
            ->first();

        // 4. Tangani jika tidak ada pertandingan aktif
        if (!$pertandingan) {
            // return view("scoring.juri_menunggu", ['user' => $user]);
            return "belum ada pertandingan aktif di arena Anda.";
        }
        
        // 5. Kirim objek pertandingan ke view.
        // Data pemain akan diambil secara otomatis oleh Accessor saat dipanggil di view.
        return view("scoring.juri", [
            'pertandingan' => $pertandingan,
        ]);
    }
}

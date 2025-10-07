<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pertandingan;
use App\Models\UserArena;

class dewanOperatorController extends Controller
{
    //
    public function index(User $user){
        if ($user->role->id !== 5) {
            abort(403, 'Akses ditolak. User ini bukan dewan.');
        }

        // 1. Dapatkan arena ID milik Dewan ini.
        $arenaId = $user->user_arena->first()->arena_id ?? null;

        // 2. Tangani jika Dewan tidak punya arena.
        if (!$arenaId) {
            abort(404, 'Dewan ini tidak ditugaskan ke arena manapun.');
        }

        $daftar_juri = UserArena::with('user')
            ->where('arena_id', $arenaId)
            ->whereHas('user', function ($query) {
                $query->whereIn('role_id', [4, 7, 8, 10]); // Role ID 4 untuk Juri
            })
            ->get()
            ->pluck('user');
        // return $juri;

        // 3. Cari satu pertandingan aktif di arena tersebut dan muat semua relasi yang diperlukan.
        // Accessor di model `Pertandingan` akan menangani pengambilan data pemain.
        $pertandingan = Pertandingan::with('kelasPertandingan.kelas') // Cukup muat info kelas
            ->where('arena_id', $arenaId)
            ->where('status', 'berlangsung')
            ->first();

            if (!$pertandingan) {
            // return view("scoring.juri_menunggu", ['user' => $user]);
            return "belum ada pertandingan aktif di arena Anda.";
        }

            $jumlah_pemain = $pertandingan->kelasPertandingan->kelas->jumlah_pemain;
        // return $jumlah_pemain;

        if($pertandingan->kelasPertandingan->jenisPertandingan->id == 1){
            return view("scoring.dewan", [
                'pertandingan' => $pertandingan,
                'user' => $user
            ]);
        } else if($pertandingan->kelasPertandingan->jenisPertandingan->id == 2 && ($jumlah_pemain == 1 || $jumlah_pemain == 3) && $pertandingan->kelasPertandingan->kelas->nama_kelas != "Tunggal Bebas"){
                    return view('seni.prestasi.tunggal.biru.dewanOperator', compact('user', 'pertandingan', 'daftar_juri'));

        } else if($pertandingan->kelasPertandingan->jenisPertandingan->id == 2 && ($jumlah_pemain == 2 || $jumlah_pemain == 1)  && $pertandingan->kelasPertandingan->kelas->nama_kelas == "Tunggal Bebas"){
                    return view('seni.prestasi.ganda.merah.dewanOperator', compact('user', 'pertandingan', 'daftar_juri'));
           
        } else {
            return "Jenis pertandingan tidak dikenali.";
        }

    }
}

<?php

namespace App\Http\Controllers;

use App\Events\KirimPoinSeni;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pertandingan;

class SeniController extends Controller
{
    public function kirim_poin_seni(User $user, Request $request){
        $arenaId = $user->user_arena->first()->arena_id ?? null;
        $poin = $request->poin;
        $filter = $request->filter;
        $type = $request->type;
        $role = $user->role->id; 

        if (!$arenaId) {
            abort(404, 'Juri ini tidak ditugaskan ke arena manapun.');
        }

        // if ($request->count < 1 || $request->count > 2) {
        //     return response()->json(['status' => 'gagal', 'message' => 'Count harus antara 1 dan 2']);
        // }

        $pertandingan = Pertandingan::with('kelasPertandingan.kelas') // Cukup muat info kelas
            ->where('arena_id', $arenaId)
            ->where('status', 'siap_dimulai')
            ->first();

            // return response()->json($pertandingan);
        event(new KirimPoinSeni($poin, $filter, $pertandingan->id, $type, $role));
        return response()->json(['status' => 'berhasil']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Matches;
use App\Models\UserMatch;
use App\Models\Pertandingan;
use Illuminate\Http\Request;
use App\Events\JuriVoteSubmitted;
use App\Models\SkorJuriTanding;
use Illuminate\Support\Facades\DB;
use App\Models\DetailPoinSeniJuriGanda;
use App\Models\DetailPoinSeniJuriTunggalRegu;
use Illuminate\Support\Facades\Redis;

class juriController extends Controller
{

    public function index(User $user, Request $request)
    {
        if ($user->role->id !== 4 && $user->role->id !== 7 && $user->role->id !== 8 && $user->role->id !== 10) { // Pastikan role juri
            abort(403, 'Akses ditolak. User ini bukan juri.');
        }
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
            ->where('status', 'berlangsung')
            ->first();

        $jumlah_pemain = $pertandingan->kelasPertandingan->kelas->jumlah_pemain;

        // 4. Tangani jika tidak ada pertandingan aktif
        if (!$pertandingan) {
            // return view("scoring.juri_menunggu", ['user' => $user]);
            return "belum ada pertandingan aktif di arena Anda.";
        }

        // return $pertandingan->kelasPertandingan->jenisPertandingan->id;
        // return $pertandingan->kelasPertandingan->kelas->nama_kelas;


      if ($pertandingan->kelasPertandingan->jenisPertandingan->id == 1) {
    return view("scoring.juri", [
        'pertandingan' => $pertandingan,
        'user' => $user
    ]);
} 
else if ($pertandingan->kelasPertandingan->jenisPertandingan->id == 2 && ($jumlah_pemain == 1 || $jumlah_pemain == 3) && $pertandingan->kelasPertandingan->kelas->nama_kelas != "Tunggal Bebas") {

    if($request->unit == 'unit_1'){
        $unit_id = $pertandingan->unit1_id;
    } else if ($request->unit == 'unit_2'){
        $unit_id = $pertandingan->unit2_id;
    } 

    $detail_poin = DetailPoinSeniJuriTunggalRegu::where('pertandingan_id', $pertandingan->id)
        ->where('user_id', $user->id)
        ->where('unit_id', $unit_id)
        ->first();

    $total_jurus = ($jumlah_pemain == 1) ? 14 : 12;

    return view("seni.prestasi.tunggal.biru.juri", [
        'pertandingan' => $pertandingan,
        'user' => $user,
        'total_jurus' => $total_jurus,
        'detail_poin' => $detail_poin
    ]);
} 
else if ($pertandingan->kelasPertandingan->jenisPertandingan->id == 2 && ($jumlah_pemain == 2 || $jumlah_pemain == 1) && $pertandingan->kelasPertandingan->kelas->nama_kelas == "Tunggal Bebas") {

    if($request->unit == 'unit_1'){
        $unit_id = $pertandingan->unit1_id;
    } else if ($request->unit == 'unit_2'){
        $unit_id = $pertandingan->unit2_id;
    } 

    $detail_poin = DetailPoinSeniJuriGanda::where('pertandingan_id', $pertandingan->id)
        ->where('user_id', $user->id)
        ->where('unit_id', $unit_id)
        ->first();

    return view("seni.prestasi.ganda.biru.juri", [
        'pertandingan' => $pertandingan,
        'user' => $user,
        'detail_poin' => $detail_poin
    ]);
} 
else {
    return "jenis pertandingan tidak dikenali.";
}


        // 5. Kirim objek pertandingan ke view.
        // Data pemain akan diambil secara otomatis oleh Accessor saat dipanggil di view.
        // return view("scoring.juri", [
        //     'pertandingan' => $pertandingan,
        //     'user' => $user
        // ]);
    }

    public function submitVote(Request $request)
    {
        $validated = $request->validate([
            'pertandingan_id' => 'required|integer|exists:pertandingan,id',
            'juri_name'       => 'required|string',
            'vote'            => 'required|string|in:merah,biru,invalid',
        ]);

        broadcast(new JuriVoteSubmitted(
            $validated['pertandingan_id'],
            $validated['juri_name'],
            $validated['vote']
        ))->toOthers();

        return response()->json(['status' => 'success', 'message' => 'Vote Anda telah dikirim ke dewan.']);
    }
}

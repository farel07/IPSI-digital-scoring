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
use App\Models\BracketPeserta;
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

        // return $pertandingan->kelasPertandingan->kategoriPertandingan->id;

        if ($pertandingan->kelasPertandingan->kategoriPertandingan->id == 1 && $pertandingan->kelasPertandingan->jenisPertandingan->id == 2) {
            // return $pertandingan->grouped_peserta;
        }

      if ($pertandingan->kelasPertandingan->jenisPertandingan->id == 1) {
    return view("scoring.juri", [
        'pertandingan' => $pertandingan,
        'user' => $user
    ]);
} 
else if ($pertandingan->kelasPertandingan->jenisPertandingan->id == 2 && ($jumlah_pemain == 1 || $jumlah_pemain == 3) && $pertandingan->kelasPertandingan->kelas->nama_kelas != "Tunggal Bebas") {

    if ($pertandingan->kelasPertandingan->kategoriPertandingan->id == 1) {
    
    // Ambil SEMUA unit_id yang terkait dengan pertandingan ini dari tabel relasi.
    // Kita urutkan berdasarkan 'unit_id' untuk memastikan urutannya selalu konsisten
    // (misal: 'unit_1' akan selalu merujuk pada unit_id terkecil, dst).
    $unitIds = $pertandingan->unitPemasalanSeni()->orderBy('unit_id', 'asc')->pluck('unit_id');

    // Validasi input dari request untuk memastikan formatnya 'unit_X' dimana X adalah angka.
    // Ini untuk keamanan dan menghindari error.
    if (preg_match('/^unit_(\d+)$/', $request->unit, $matches)) {
        // Ambil angka dari request, misal 'unit_3' -> $matches[1] akan berisi '3'
        $unitNumber = (int)$matches[1];

        // Pastikan angka valid (bukan 'unit_0')
        if ($unitNumber > 0) {
            // Ubah menjadi indeks array (0-based). 'unit_1' -> indeks 0, 'unit_2' -> indeks 1, dst.
            $unitIndex = $unitNumber - 1;

            // Ambil unit_id dari koleksi berdasarkan indeksnya.
            // Metode ->get() aman digunakan, akan mengembalikan null jika indeks tidak ada,
            // sehingga tidak akan menyebabkan error "undefined offset".
            $unit_id = $unitIds->get($unitIndex);
        }
        // return $unit_id;
    }

    } else {
        if($request->unit == 'unit_1'){
            $unit_id = $pertandingan->unit1_id;
        } else if ($request->unit == 'unit_2'){
            $unit_id = $pertandingan->unit2_id;
        } else {
            $unit_id = $pertandingan->unit1_id;
        }

        $detail_poin = DetailPoinSeniJuriTunggalRegu::where('pertandingan_id', $pertandingan->id)
            ->where('user_id', $user->id)
            ->where('unit_id', $unit_id)
            ->first();

            // return $pertandingan->kelasPertandingan->kelas->nama_kelas;
    
        if ($jumlah_pemain == 1 && $pertandingan->kelasPertandingan->kelas->nama_kelas == 'Tunggal') {
            $total_jurus = 14;
            // return $total_jurus;
        } else if ($jumlah_pemain == 3) {
            $total_jurus = 12;
        } else if (($jumlah_pemain == 1 && ($pertandingan->kelasPertandingan->kelas->nama_kelas == 'Tunggal Bersenjata' || $pertandingan->kelasPertandingan->kelas->nama_kelas == 'Tunggal Tangan Kosong'))) {
            $total_jurus = 7;
        } else {
            return "jumlah pemain tidak sesuai untuk jenis pertandingan ini.";
        }
    
        return view("seni.prestasi.tunggal.biru.juri", [
            'pertandingan' => $pertandingan,
            'user' => $user,
            'total_jurus' => $total_jurus,
            'detail_poin' => $detail_poin
        ]);
    }

} 
else if ($pertandingan->kelasPertandingan->jenisPertandingan->id == 2 && ($jumlah_pemain == 2 || ($jumlah_pemain == 1 && $pertandingan->kelasPertandingan->kelas->nama_kelas == "Tunggal Bebas"))) {
 if ($pertandingan->kelasPertandingan->kategoriPertandingan->id == 1) {
    
    // Ambil SEMUA unit_id yang terkait dengan pertandingan ini dari tabel relasi.
    // Kita urutkan berdasarkan 'unit_id' untuk memastikan urutannya selalu konsisten
    // (misal: 'unit_1' akan selalu merujuk pada unit_id terkecil, dst).
    $unitIds = $pertandingan->unitPemasalanSeni()->orderBy('unit_id', 'asc')->pluck('unit_id');

    // Validasi input dari request untuk memastikan formatnya 'unit_X' dimana X adalah angka.
    // Ini untuk keamanan dan menghindari error.
    if (preg_match('/^unit_(\d+)$/', $request->unit, $matches)) {
        // Ambil angka dari request, misal 'unit_3' -> $matches[1] akan berisi '3'
        $unitNumber = (int)$matches[1];

        // Pastikan angka valid (bukan 'unit_0')
        if ($unitNumber > 0) {
            // Ubah menjadi indeks array (0-based). 'unit_1' -> indeks 0, 'unit_2' -> indeks 1, dst.
            $unitIndex = $unitNumber - 1;

            // Ambil unit_id dari koleksi berdasarkan indeksnya.
            // Metode ->get() aman digunakan, akan mengembalikan null jika indeks tidak ada,
            // sehingga tidak akan menyebabkan error "undefined offset".
            $unit_id = $unitIds->get($unitIndex);
        }
        // return $unit_id;
    }

    } else {
        if($request->unit == 'unit_1'){
            $unit_id = $pertandingan->unit1_id;
        } else if ($request->unit == 'unit_2'){
            $unit_id = $pertandingan->unit2_id;
        } else {
            $unit_id = $pertandingan->unit1_id;
            // default ke unit_1 jika tidak ada di request
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

} 
else {
    // return $pertandingan;
    return $pertandingan;
    return "jenis pertandingan tidak dikenali.";
    
}


        // 5. Kirim objek pertandingan ke view.
        // Data pemain akan diambil secara otomatis oleh Accessor saat dipanggil di view.
        // return view("scoring.juri", [
        //     'pertandingan' => $pertandingan,
        //     'user' => $user
        // ]);
    }

    public function submit_penilaian_juri(Request $request, $id)
    {
        if($request->tipe_penilaian == 'tunggal_regu'){
            $detail_poin = DetailPoinSeniJuriTunggalRegu::find($id);
            if ($detail_poin) {
            $detail_poin->status = 1;
            $detail_poin->save();
            }
        } else if ($request->tipe_penilaian == 'ganda'){
            $detail_poin = DetailPoinSeniJuriGanda::find($id);
            if ($detail_poin) {
            $detail_poin->status = 1;
            $detail_poin->save();
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Tipe penilaian tidak valid.']);
        }
        return response()->json(['status' => 'success', 'message' => 'Penilaian juri telah disubmit.']);
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

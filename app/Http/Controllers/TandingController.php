<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPointTanding;
use App\Models\Pertandingan;
use App\Models\User;
use Illuminate\Support\Facades\DB;

// Import semua Event Anda
use App\Events\KirimBinaan;
use App\Events\KirimPeringatan;
use App\Events\KirimTeguran;
use App\Events\KirimJatuh;
use App\Events\kirimPukul;
use App\Events\kirimTendang;
use App\Events\hapusPelanggaran;
use App\Events\JuryVoteSubmitted;
use App\Events\hapusPoint;
use App\Events\RequestValidation;

class TandingController extends Controller
{
    // --- FUNGSI DEWAN ---

    public function kirim_binaan(Request $request, User $user)
    {
        $arenaId = $user->user_arena->first()->arena_id ?? null;

        if (!$arenaId) {
            abort(404, 'Juri ini tidak ditugaskan ke arena manapun.');
        }

        if ($request->count < 1 || $request->count > 2) {
            return response()->json(['status' => 'gagal', 'message' => 'Count harus antara 1 dan 3']);
        }



        $pertandingan = Pertandingan::with('kelasPertandingan.kelas') // Cukup muat info kelas
            ->where('arena_id', $arenaId)
            ->where('status', 'siap_dimulai')
            ->first();


        // Panggil helper dengan kolom 'binaan_point', nilai dari 'count', dan filter
        $this->updateOrCreatePoint($pertandingan, 'binaan_point', $request->filter, $request->count);

        if ($request->count == 2) {
            $this->updateOrCreatePoint($pertandingan, 'teguran', $request->filter, 1);
        }

        event(new KirimBinaan($request->count, $request->filter, $pertandingan->id));
        return response()->json(['status' => 'berhasil', 'data' => $request->all()]);
    }

    public function kirim_peringatan(Request $request, User $user)
    {
        $arenaId = $user->user_arena->first()->arena_id ?? null;

        if (!$arenaId) {
            abort(404, 'Juri ini tidak ditugaskan ke arena manapun.');
        }

        if ($request->count < 1 || $request->count > 3) {
            return response()->json(['status' => 'gagal', 'message' => 'Count harus antara 1 dan 3']);
        }

        $pertandingan = Pertandingan::with('kelasPertandingan.kelas') // Cukup muat info kelas
            ->where('arena_id', $arenaId)
            ->where('status', 'siap_dimulai')
            ->first();

        $this->updateOrCreatePoint($pertandingan, 'peringatan', $request->filter, $request->count);

        event(new KirimPeringatan($request->count, $request->filter, $pertandingan->id));
        return response()->json(['status' => 'berhasil']);
    }

    public function kirim_teguran(Request $request, User $user)
    {
        $arenaId = $user->user_arena->first()->arena_id ?? null;


        if (!$arenaId) {
            abort(404, 'Juri ini tidak ditugaskan ke arena manapun.');
        }

        if ($request->count < 1 || $request->count > 2) {
            return response()->json(['status' => 'gagal', 'message' => 'Count harus antara 1 dan 2']);
        }

        $pertandingan = Pertandingan::with('kelasPertandingan.kelas') // Cukup muat info kelas
            ->where('arena_id', $arenaId)
            ->where('status', 'siap_dimulai')
            ->first();

        $this->updateOrCreatePoint($pertandingan, 'teguran', $request->filter, $request->count);

        event(new KirimTeguran($request->count, $request->filter, $pertandingan->id));
        return response()->json(['status' => 'berhasil']);
    }

    public function kirim_jatuh(Request $request, User $user)
    {
        $arenaId = $user->user_arena->first()->arena_id ?? null;

        if (!$arenaId) {
            abort(404, 'Juri ini tidak ditugaskan ke arena manapun.');
        }

        $pertandingan = Pertandingan::with('kelasPertandingan.kelas') // Cukup muat info kelas
            ->where('arena_id', $arenaId)
            ->where('status', 'siap_dimulai')
            ->first();
        $this->updateOrCreatePoint($pertandingan, 'fall_point', $request->filter, $request->count);

        event(new KirimJatuh($request->count, $request->filter, $pertandingan->id));
        return response()->json(['status' => 'berhasil']);
    }

    // --- FUNGSI JURI ---

    public function kirim_pukul(Request $request, User $user)
    {
        $arenaId = $user->user_arena->first()->arena_id ?? null;

        if (!$arenaId) {
            abort(404, 'Juri ini tidak ditugaskan ke arena manapun.');
        }

        $pertandingan = Pertandingan::with('kelasPertandingan.kelas') // Cukup muat info kelas
            ->where('arena_id', $arenaId)
            ->where('status', 'siap_dimulai')
            ->first();
        // Panggil helper dengan kolom 'punch_point', nilai tetap '1', dan filter
        // $this->updateOrCreatePoint($pertandingan, 'punch_point', $request->filter, 1);

        // Asumsi event butuh juri_ket, kirim dari request
        event(new kirimPukul($request->filter, $request->juri_ket, $pertandingan->id));
        return response()->json(['status' => 'berhasil']);
    }


    public function kirim_pukul_insert(Request $request, User $user)
    {
        $arenaId = $user->user_arena->first()->arena_id ?? null;

        if (!$arenaId) {
            abort(404, 'Juri ini tidak ditugaskan ke arena manapun.');
        }

        $pertandingan = Pertandingan::with('kelasPertandingan.kelas') // Cukup muat info kelas
            ->where('arena_id', $arenaId)
            ->where('status', 'siap_dimulai')
            ->first();
        // Panggil helper dengan kolom 'punch_point', nilai tetap '1', dan filter
        $this->updateOrCreatePoint($pertandingan, 'punch_point', $request->filter, 1);

        return response()->json(['status' => 'berhasil']);
    }


    public function kirim_tendang_insert(Request $request, User $user)
    {
        $arenaId = $user->user_arena->first()->arena_id ?? null;

        if (!$arenaId) {
            abort(404, 'Juri ini tidak ditugaskan ke arena manapun.');
        }

        $pertandingan = Pertandingan::with('kelasPertandingan.kelas') // Cukup muat info kelas
            ->where('arena_id', $arenaId)
            ->where('status', 'siap_dimulai')
            ->first();
        // Panggil helper dengan kolom 'kick_point', nilai tetap '1', dan filter
        $this->updateOrCreatePoint($pertandingan, 'kick_point', $request->filter, 2);

        return response()->json(['status' => 'berhasil']);
    }

    public function kirim_tendang(Request $request, User $user)
    {
        $arenaId = $user->user_arena->first()->arena_id ?? null;

        if (!$arenaId) {
            abort(404, 'Juri ini tidak ditugaskan ke arena manapun.');
        }

        $pertandingan = Pertandingan::with('kelasPertandingan.kelas') // Cukup muat info kelas
            ->where('arena_id', $arenaId)
            ->where('status', 'siap_dimulai')
            ->first();
        // Panggil helper dengan kolom 'kick_point', nilai tetap '2', dan filter
        // $this->updateOrCreatePoint($pertandingan, 'kick_point', $request->filter, 2);

        event(new kirimTendang($request->filter, $request->juri_ket, $pertandingan->id));
        return response()->json(['status' => 'berhasil']);
    }

    // --- FUNGSI HAPUS (Dibiarkan kosong sesuai permintaan) ---

    public function hapus_pelanggaran(Request $request, User $user)
    {

        $arenaId = $user->user_arena->first()->arena_id ?? null;

        if (!$arenaId) {
            abort(404, 'Juri ini tidak ditugaskan ke arena manapun.');
        }

        $pertandingan = Pertandingan::with('kelasPertandingan.kelas') // Cukup muat info kelas
            ->where('arena_id', $arenaId)
            ->where('status', 'siap_dimulai')
            ->first();


        if ($request->type == 'binaan-1' || $request->type == 'binaan-2') {
            $type = 'binaan_point';
            $point = -1;
        } else if ($request->type == 'peringatan-1' || $request->type == 'peringatan-2' || $request->type == 'peringatan-3') {
            $type = 'peringatan';
            $point = -1;
        } else if ($request->type == 'teguran-1' || $request->type == 'teguran-2') {
            $type = 'teguran';
            $point = -1;
        } else if ($request->type == 'jatuhan') {
            $type = 'fall_point';
            $point = -1;
        } else {
            return response()->json(['status' => 'gagal', 'message' => 'Tipe tidak valid']);
        }

        $this->updateOrCreatePoint($pertandingan, $type, $request->filter, $point);


        event(new hapusPelanggaran($request->count, $request->filter, $pertandingan->id));
        return response()->json(['status' => 'berhasil', 'data' => $type]);
    }

    public function submitVote(Request $request)
    {
        // 1. Validasi data yang dikirim oleh juri
        $validated = $request->validate([
            'pertandingan_id' => 'required|integer|exists:pertandingan,id',
            'user_id' => 'required|integer|exists:users,id',
            'vote' => 'required|string|in:setuju,tolak',
            
            // Sertakan juga data original request untuk konteks
            'original_request' => 'required|array',
            'original_request.sudut' => 'required|string',
            'original_request.jenis_poin' => 'required|string',
        ]);

        // 2. Siarkan keputusan juri ini ke semua listener (termasuk Dewan)
        event(new JuryVoteSubmitted($validated));

        // 3. Kirim respons kembali ke juri yang mengirim vote
        return response()->json(['status' => 'sukses', 'message' => 'Vote Anda telah terkirim.']);
    }

    public function request_validation(Request $request, User $user)
{
    // 1. Validasi data yang masuk dari frontend. Ini adalah langkah keamanan penting.
    $validated = $request->validate([
        'pertandingan_id' => 'required|integer|exists:pertandingan,id',
        'sudut' => 'required|string|in:merah,biru',
        'jenis_poin' => 'required|string|in:tendangan,jatuhan',
        'nilai' => 'required|integer|min:1',
    ]);

    // 2. Temukan pertandingan berdasarkan ID yang dikirim.
    // Ini lebih andal daripada mencoba menebak pertandingan berdasarkan status.
    $pertandingan = Pertandingan::findOrFail($validated['pertandingan_id']);
    
    // 3. Panggil event dengan data yang sudah bersih dan terstruktur.
    // Event Anda sekarang menerima array yang jelas, bukan string `filter`.
    event(new RequestValidation($validated));

    // 4. Berikan respons yang jelas ke frontend.
    return response()->json([
        'status' => 'berhasil', 
        'message' => 'Permintaan validasi telah dikirim ke juri.',
        'data' => $validated // Kirim kembali data yang divalidasi sebagai konfirmasi
    ]);
}


    public function get_point(Request $request, user $user)
    {
        $arenaId = $user->user_arena->first()->arena_id ?? null;

        if (!$arenaId) {
            abort(404, 'Juri ini tidak ditugaskan ke arena manapun.');
        }

        $pertandingan = Pertandingan::where('arena_id', $arenaId)
            ->where('status', 'siap_dimulai')
            ->first();

        $points = DetailPointTanding::where('pertandingan_id', $pertandingan->id)->get();
        return response()->json(['status' => 'berhasil', 'data' => $points]);
    }

    /**
     * [FUNGSI HELPER PRIBADI]
     * Fungsi cerdas untuk mencari/membuat record point dan menambahkan nilai.
     *
     * @param Pertandingan $pertandingan Objek pertandingan saat ini.
     * @param string $baseColumn Nama kolom dasar (misal: 'punch_point', 'teguran').
     * @param string $filter 'blue' atau 'red'.
     * @param int $value Nilai yang akan ditambahkan.
     */
    private function updateOrCreatePoint(Pertandingan $pertandingan, string $baseColumn, string $filter, int $value)
    {
        // 1. Tentukan side (1 untuk biru, 2 untuk merah) berdasarkan filter
        $side = ($filter === 'blue') ? 1 : 2;

        // 2. Bangun nama kolom yang lengkap, contoh: 'punch_point_1' atau 'teguran_2'
        $fullColumnName = $baseColumn . '_' . $side;

        // 3. Ambil nomor babak saat ini langsung dari tabel pertandingan
        $currentRound = $pertandingan->current_round;

        if ($fullColumnName == 'peringatan_1' || $fullColumnName == 'peringatan_2' || $fullColumnName == 'peringatan_3' || $fullColumnName == 'teguran_1' || $fullColumnName == 'teguran_2' || $fullColumnName == 'binaan_point_1' || $fullColumnName == 'binaan_point_2') {

            if ($value < 0) {

                DetailPointTanding::updateOrCreate(
                    // Kriteria pencarian
                    ['pertandingan_id' => $pertandingan->id, 'round' => $currentRound],
                    // Nilai untuk di-update atau dibuat
                    [$fullColumnName => DB::raw("GREATEST(0, $fullColumnName + $value)")]
                );
            } else {
                DetailPointTanding::updateOrCreate(
                    // Kriteria pencarian
                    ['pertandingan_id' => $pertandingan->id, 'round' => $currentRound],
                    // Nilai untuk di-update atau dibuat
                    [$fullColumnName => DB::raw("$value")]
                );
            }
        } else {

            // 4. Logika utama: Cari atau buat record, lalu increment kolom yang sesuai dengan nilai yang diberikan.
            DetailPointTanding::updateOrCreate(
                // Kriteria pencarian
                ['pertandingan_id' => $pertandingan->id, 'round' => $currentRound],
                // Nilai untuk di-update atau dibuat
                [$fullColumnName => DB::raw("$fullColumnName + $value")]
            );
        }

        $this->countTotalPoint($pertandingan);
    }

    public function countTotalPoint(Pertandingan $pertandingan)
    {

        $currentRound = $pertandingan->current_round;
        $point = DetailPointTanding::firstOrNew(
            ['pertandingan_id' => $pertandingan->id, 'round' => $currentRound]
        );

        $punch_point_1 = $point->punch_point_1 ?? 0;
        $punch_point_2 = $point->punch_point_2 ?? 0;
        $kick_point_1 = $point->kick_point_1 ?? 0;
        $kick_point_2 = $point->kick_point_2 ?? 0;

        $fall_point_1 = $point->fall_point_1 * 2;
        $fall_point_2 = $point->fall_point_2 * 2;

        // $point_teguran_1 = $point->teguran_1 ?? 0;

        if ($point->teguran_1 == 1) {
            $teguran_1 = -1;
        } else if ($point->teguran_1 == 2) {
            $teguran_1 = -1 - 2;
        } else {

            $teguran_1 = 0;
        }

        if ($point->teguran_2 == 1) {
            $teguran_2 = -1;
        } else if ($point->teguran_2 == 2) {
            $teguran_2 = -1 - 2;
        } else {
            $teguran_2 = 0;
        }

        if ($point->peringatan_1 == 1) {
            $peringatan_1 = -5;
        } else if ($point->peringatan_1 == 2) {
            $peringatan_1 = -5 - 10;
        } else if ($point->peringatan_1 == 3) {
            $peringatan_1 = -5 - 10 - 15;
        } else {
            $peringatan_1 = 0;
        }

        if ($point->peringatan_2 == 1) {
            $peringatan_2 = -5;
        } else if ($point->peringatan_2 == 2) {
            $peringatan_2 = -5 - 10;
        } else if ($point->peringatan_2 == 3) {
            $peringatan_2 = -5 - 10 - 15;
        } else {
            $peringatan_2 = 0;
        }

        $total_point_1 = $punch_point_1 + $kick_point_1 + $fall_point_1 + $teguran_1 + $peringatan_1;
        $total_point_2 = $punch_point_2 + $kick_point_2 + $fall_point_2 + $teguran_2 + $peringatan_2;

        $point->total_point_1 = $total_point_1;
        $point->total_point_2 = $total_point_2;
        $point->save();

        return response()->json(['status' => 'berhasil', 'total_point_1' => $total_point_1, 'total_point_2' => $total_point_2]);
    }

    public function getTotalPoints(Pertandingan $pertandingan)
    {
        $point_details = DetailPointTanding::where('pertandingan_id', $pertandingan->id)
            ->where('round', $pertandingan->current_round) // Pastikan Anda memiliki kolom `current_round` di tabel pertandingan
            ->first();

        // Siapkan nilai default jika belum ada data poin sama sekali
        $total_point_1 = $point_details->total_point_1 ?? 0;
        $total_point_2 = $point_details->total_point_2 ?? 0;

        // [TAMBAHAN] Ambil juga poin pukulan dan tendangan
        $punch_point_1 = $point_details->punch_point_1 ?? 0;
        $punch_point_2 = $point_details->punch_point_2 ?? 0;
        $kick_point_1 = $point_details->kick_point_1 ?? 0;
        $kick_point_2 = $point_details->kick_point_2 ?? 0;
        $fall_point_1 = $point_details->fall_point_1 ?? 0;
        $fall_point_2 = $point_details->fall_point_2 ?? 0;

        // Kirim kembali semua data yang diperlukan sebagai JSON
        return response()->json([
            'status' => 'berhasil',
            'total_point_1' => $total_point_1,
            'total_point_2' => $total_point_2,
            'punch_point_1' => $punch_point_1,
            'punch_point_2' => $punch_point_2,
            'kick_point_1'  => $kick_point_1,
            'kick_point_2'  => $kick_point_2,
            'fall_point_1'  => $fall_point_1,  // <-- Kirim data jatuhan biru
            'fall_point_2'  => $fall_point_2,  // <-- Kirim data jatuhan merah

        ]);
    }

    public function getUserRole(User $user)
    {
        return response()->json(['role_id' => $user->role_id]);
    }

}

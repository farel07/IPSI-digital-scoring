<?php

namespace App\Http\Controllers;

use App\Models\Arena;
use App\Models\UserArena;
use App\Events\TimerUpdated;
use App\Models\Pertandingan;
use Illuminate\Http\Request;
use App\Models\BracketPeserta;
use App\Models\KelasPertandingan;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailPointTanding;
use App\Events\RoundUpdated;

class timerController extends Controller
{
    public function index()
    {
        // 1. Dapatkan user yang sedang login
        $user = Auth::user();

        // 2. Cari arena yang ditugaskan kepada user tersebut
        $userArena = UserArena::where('user_id', $user->id)->first();

        // Jika user tidak ditugaskan ke arena manapun, tampilkan pesan.
        if (!$userArena) {
            // Anda bisa membuat view khusus untuk ini atau redirect dengan pesan error.
            return view('scoring.timer', ['error' => 'Timer ini tidak ditugaskan di arena manapun.']);
        }

        $arena = Arena::find($userArena->arena_id);

        // 3. Cari pertandingan yang sedang berlangsung, jika tidak ada, cari yang siap dimulai.
        $pertandingan = Pertandingan::where('arena_id', $arena->id)
            ->where('status', 'berlangsung')
            ->first();

        if (!$pertandingan) {
            $pertandingan = Pertandingan::where('arena_id', $arena->id)
                ->where('status', 'siap_dimulai')
                ->orderBy('match_number', 'asc')
                ->first();
        }

        $peserta1 = null;
        $peserta2 = null;
        $kelasInfo = null;
        $roundName = null;

        // 4. Jika ada pertandingan yang ditemukan, ambil detailnya
        if ($pertandingan) {
            // Ambil detail kelas pertandingan (untuk info gender, usia, dll)
            $kelasInfo = KelasPertandingan::with(['kelas.rentangUsia', 'jenisPertandingan'])->find($pertandingan->kelas_pertandingan_id);

            // Ambil detail peserta 1 (sudut merah)
            $peserta1 = null;
            if ($pertandingan->unit1_id) {
                // Mengambil data bracket beserta relasi ke pemain dan kontingennya
                $peserta1 = BracketPeserta::with('player.contingent')
                    ->where('kelas_pertandingan_id', $pertandingan->kelas_pertandingan_id)
                    ->where('unit_id', $pertandingan->unit1_id)
                    ->first();
            }

            // Ambil detail peserta 2 (sudut biru)
            $peserta2 = null;
            if ($pertandingan->unit2_id) {
                $peserta2 = BracketPeserta::with('player.contingent')
                    ->where('kelas_pertandingan_id', $pertandingan->kelas_pertandingan_id)
                    ->where('unit_id', $pertandingan->unit2_id)
                    ->first();
            }

            // Konversi nomor ronde menjadi teks
            $roundName = $this->getRoundName($pertandingan->round_number);

            return view('scoring.timer', compact('arena', 'pertandingan', 'kelasInfo', 'peserta1', 'peserta2', 'roundName'));
        }

        // Jika tidak ada pertandingan yang siap/berlangsung
        return view('scoring.timer', [
            'arena' => $arena,
            'pertandingan' => null // Kirim null agar view bisa menanganinya
        ]);
    }

    public function broadcastEvent(Request $request)
    {
        $validated = $request->validate([
            'pertandingan_id' => 'required|integer',
            'state'           => 'required|string|in:playing,paused,reset',
            'current_time'    => 'required|integer',
            'total_duration'  => 'required|integer',
        ]);

        // Kirim event ke Pusher. `.toOthers()` mencegah event dikirim kembali ke tab pengirim.
        broadcast(new TimerUpdated(
            $validated['pertandingan_id'],
            $validated['state'],
            $validated['current_time'],
            $validated['total_duration']
        ))->toOthers();

        return response()->json(['status' => 'success']);
    }

    public function updateRound(Request $request)
    {
        $validated = $request->validate([
            'pertandingan_id' => 'required|integer|exists:pertandingan,id',
            'round_number'    => 'required|integer|in:1,2,3',
        ]);

        $pertandinganId = $validated['pertandingan_id'];
        $newRoundNumber = $validated['round_number'];

        // 1. Ambil data pertandingan yang sedang berlangsung
        $pertandingan = Pertandingan::find($pertandinganId);
        if (!$pertandingan) {
            return response()->json(['status' => 'error', 'message' => 'Pertandingan tidak ditemukan.'], 404);
        }

        $currentRoundNumber = $pertandingan->current_round;

        // Mencegah update jika ronde baru lebih kecil atau sama dengan ronde saat ini
        if ($newRoundNumber <= $currentRoundNumber) {
            return response()->json([
                'status' => 'info',
                'message' => 'Tidak ada perubahan, ronde sudah berada di atau melewati target.',
                'current_round' => $currentRoundNumber
            ]);
        }

        // 2. Cari baris detail point berdasarkan pertandingan DAN ronde saat ini
        $detailPoint = DetailPointTanding::where('pertandingan_id', $pertandinganId)
            ->where('round', $currentRoundNumber)
            ->first();

        // 3. Jika baris detail untuk ronde saat ini ditemukan, UPDATE ronde-nya
        if ($detailPoint) {
            $detailPoint->round = $newRoundNumber;
            $detailPoint->save();
        } else {
            // Sebagai pengaman, jika tidak ada entri untuk ronde saat ini, buat entri baru untuk ronde BARU.
            // Ini menangani kasus jika ronde 1 belum pernah dimulai secara formal.
            DetailPointTanding::create([
                'pertandingan_id' => $pertandinganId,
                'round'           => $newRoundNumber,
                // Inisialisasi poin ke 0 jika diperlukan oleh skema database Anda
                'punch_point_1' => 0,
                'kick_point_1' => 0,
                'fall_point_1' => 0,
                'fall_point_2' => 0,
                'binaan_point_1' => 0,
                'binaan_point_2' => 0,
                'teguran_point_1' => 0,
                'teguran_point_2' => 0,
                'peringatan_point_1' => 0,
                'peringatan_point_2' => 0,
                'punch_point_2' => 0,
                'kick_point_2' => 0,
                'total_point_1' => 0,
                'total_point_2' => 0,
            ]);
        }

        // 4. Update field 'current_round' di tabel pertandingan utama
        $pertandingan->current_round = $newRoundNumber;
        $pertandingan->save();

        // -->> LOGIKA BARU: BROADCAST EVENT PERUBAHAN RONDE <<--
        broadcast(new RoundUpdated($pertandinganId, $newRoundNumber))->toOthers();

        // 5. Kirim response berhasil
        return response()->json([
            'status' => 'success',
            'message' => 'Ronde berhasil diperbarui menjadi ' . $newRoundNumber,
            'current_round' => $newRoundNumber,
        ]);
    }

    /**
     * Helper function untuk mengubah nomor ronde menjadi nama babak.
     */
    private function getRoundName($roundNumber)
    {
        switch ($roundNumber) {
            case 4:
                return 'Final';
            case 3:
                return 'Semi Final';
            case 2:
                return 'Perempat Final';
            case 1:
                return 'Penyisihan';
            default:
                if ($roundNumber > 4) {
                    return 'Final';
                }
                return 'Penyisihan';
        }
    }
}

<?php

namespace App\Http\Controllers;

// Import model yang BENAR
use App\Models\User;
use App\Models\Pertandingan;
use Illuminate\Http\Request;
use App\Events\DewanRequestValidation;
use App\Models\HasilPoinSeniGanda;
use App\Models\HasilPoinSeniTunggalRegu;

// Hapus model lama yang tidak terpakai
// use App\Models\Matches;
// use App\Models\UserMatch;

class dewanController extends Controller
{
    /**
     * [DIPERBARUI TOTAL] Menampilkan halaman Dewan untuk seorang User.
     * Logika ini SAMA PERSIS dengan controller lain yang sudah bekerja.
     *
     * @param User $user Menerima objek Dewan (User) dari URL melalui Route Model Binding.
     */
    public function index(User $user, Request $request)
    {

        if ($user->role->id !== 5) {
            abort(403, 'Akses ditolak. User ini bukan dewan.');
        }

        // 1. Dapatkan arena ID milik Dewan ini.
        $arenaId = $user->user_arena->first()->arena_id ?? null;

        // 2. Tangani jika Dewan tidak punya arena.
        if (!$arenaId) {
            abort(404, 'Dewan ini tidak ditugaskan ke arena manapun.');
        }

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


        if ($pertandingan->kelasPertandingan->jenisPertandingan->id == 1) {
            return view("scoring.dewan", [
                'pertandingan' => $pertandingan,
                'user' => $user
            ]);
        } else if ($pertandingan->kelasPertandingan->jenisPertandingan->id == 2 && ($jumlah_pemain == 1 || $jumlah_pemain == 3)  && $pertandingan->kelasPertandingan->kelas->nama_kelas != "Tunggal Bebas") {

            if ($request->unit == 'unit_1') {
                $unit_id = $pertandingan->unit1_id;
            } else if ($request->unit == 'unit_2') {
                $unit_id = $pertandingan->unit2_id;
            }

            $hasil_poin = HasilPoinSeniTunggalRegu::where('pertandingan_id', $pertandingan->id)->where('unit_id', $unit_id)->first();

            // return $hasil_poin;


            // return $hasil_poin;

            return view("seni.prestasi.tunggal.biru.dewan", [
                'pertandingan' => $pertandingan,
                'user' => $user,
                'penalti_terakhir' => $hasil_poin
            ]);
        } else if ($pertandingan->kelasPertandingan->jenisPertandingan->id == 2 && ($jumlah_pemain == 2 || $jumlah_pemain == 1)  && $pertandingan->kelasPertandingan->kelas->nama_kelas == "Tunggal Bebas") {

            if ($request->unit == 'unit_1') {
                $unit_id = $pertandingan->unit1_id;
            } else if ($request->unit == 'unit_2') {
                $unit_id = $pertandingan->unit2_id;
            }

            $hasil_poin = HasilPoinSeniGanda::where('pertandingan_id', $pertandingan->id)->where('unit_id', $unit_id)->first();

            // return $hasil_poin;

            return view("seni.prestasi.ganda.merah.dewan", [
                'pertandingan' => $pertandingan,
                'user' => $user,
                'penalti_terakhir' => $hasil_poin
            ]);
        } else {
            return "jenis pertandingan tidak dikenali.";
        }

        // 4. Kirim objek pertandingan (atau null jika tidak ada) ke view.
        //     
    }

    public function sendValidationRequest(Request $request)
    {
        $validated = $request->validate([
            'pertandingan_id' => 'required|integer|exists:pertandingan,id',
            'jenis_validasi'  => 'required|string|in:Jatuhan,Pelanggaran',
        ]);

        broadcast(new DewanRequestValidation(
            $validated['pertandingan_id'],
            $validated['jenis_validasi']
        ))->toOthers();

        return response()->json(['status' => 'success', 'message' => 'Request validasi terkirim ke para juri.']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\HasilPoinSeniGanda;
use Illuminate\Http\Request;
use App\Models\Pertandingan;
use App\Models\User;
use Illuminate\Validation\Rule;
use App\Models\HasilPoinSeniTunggalRegu;

class operatorController extends Controller
{
    /**
     * [FINAL & BENAR] - Menampilkan halaman Operator dengan DAFTAR pertandingan.
     *
     * @param User $user Menerima objek Operator (User) dari URL.
     */
    public function index(User $user)
    {
        // 1. Dapatkan arena ID milik Operator ini.
        $arenaId = $user->user_arena->first()->arena_id ?? null;

        // return $user->user_arena;;

        // 2. Tangani jika Operator tidak punya arena.
        if (!$arenaId) {
            abort(404, 'Operator ini tidak ditugaskan ke arena manapun.');
        }

        // 3. Ambil SEMUA pertandingan di arena tersebut dan muat semua relasinya.
        // Kita menggunakan `get()` untuk mendapatkan sebuah DAFTAR (koleksi).
        $daftar_pertandingan = Pertandingan::with([
                'kelasPertandingan.kelas',
                'kelasPertandingan.kategoriPertandingan',
            ])
            ->where('arena_id', $arenaId)
            // Anda bisa menambahkan filter lain di sini jika perlu, contoh:
            // ->where('status', '!=', 'selesai')
            ->orderBy('id', 'asc') // Urutkan berdasarkan ID atau waktu
            ->get();


            // return $daftar_pertandingan;

        // 4. Kirim DAFTAR pertandingan tersebut ke view.
        return view("scoring.operator", [
            'daftar_pertandingan' => $daftar_pertandingan,
        ]);
    }

    public function updateStatus(Request $request, Pertandingan $pertandingan)
    {
        // return response()->json(['status' => 'sukses', 'message' => 'Fungsi ini belum diimplementasikan.']);
        // 1. Validasi input: pastikan status yang dikirim adalah salah satu dari nilai yang diizinkan.
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in(['menunggu_peserta', 'siap_dimulai', 'berlangsung', 'selesai', 'ditunda']),
            ],
        ]);

        // 2. Update status pertandingan di database.
        $pertandingan->status = $validated['status'];
        $pertandingan->save();

        // 3. Kirim respons sukses kembali ke JavaScript.
        return response()->json([
            'status' => 'success',
            'message' => 'Status pertandingan berhasil diperbarui!',
            'new_status' => $validated['status']
        ]);
    }

    public function viewPenontonFinal(User $user)
    {
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

            if ($pertandingan->kelasPertandingan->jenisPertandingan->id == 2 && ($jumlah_pemain == 1 || $jumlah_pemain == 3) && $pertandingan->kelasPertandingan->kelas->nama_kelas != "Tunggal Bebas"){

                $hasil_poin = HasilPoinSeniTunggalRegu::where('pertandingan_id', $pertandingan->id)->get();
            } else if($pertandingan->kelasPertandingan->jenisPertandingan->id == 2 && ($jumlah_pemain == 2 || ($jumlah_pemain == 1 && $pertandingan->kelasPertandingan->kelas->nama_kelas == "Tunggal Bebas"))){
               $hasil_poin = HasilPoinSeniGanda::where('pertandingan_id', $pertandingan->id)->get(); 
            }

            $hasil_poinBiru = $hasil_poin->where('unit_id', $pertandingan->unit1_id)->first();
            $hasil_poinMerah = $hasil_poin->where('unit_id', $pertandingan->unit2_id)->first();

            // return $hasil_poinBiru;

            // return $hasil_poin;

        return view('seni.prestasi.tunggal.penontonFinal', [
            'pertandingan' => $pertandingan,
            'hasil_poin' => $hasil_poin,
            'hasilBiru' => $hasil_poinBiru,
            'hasilMerah' => $hasil_poinMerah,
        ]);
    }
}
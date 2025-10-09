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

        // if(isset($request->unit)){
        //    return 'ada';
        // } else {
        //     return 'tidak'; // default ke unit_1 jika tidak ada di request
        // }

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


        if($pertandingan->kelasPertandingan->jenisPertandingan->id == 1){
            return view("scoring.dewan", [
                'pertandingan' => $pertandingan,
                'user' => $user
            ]);
        } else if($pertandingan->kelasPertandingan->jenisPertandingan->id == 2 && ($jumlah_pemain == 1 || $jumlah_pemain == 3)  && $pertandingan->kelasPertandingan->kelas->nama_kelas != "Tunggal Bebas"){

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
            $unit_id = 'unit_1'; // default ke unit_1 jika tidak ada di request
        }

    }

            $hasil_poin = HasilPoinSeniTunggalRegu::where('pertandingan_id', $pertandingan->id)->where('unit_id', $unit_id)->first();

            // return $hasil_poin;


            // return $hasil_poin;

            return view("seni.prestasi.tunggal.biru.dewan", [
                'pertandingan' => $pertandingan,
                'user' => $user,
                'penalti_terakhir' => $hasil_poin
            ]);
           
        } else if($pertandingan->kelasPertandingan->jenisPertandingan->id == 2 && ($jumlah_pemain == 2 || ($jumlah_pemain == 1 &&$pertandingan->kelasPertandingan->kelas->nama_kelas == "Tunggal Bebas") )){

            if($request->unit == 'unit_1'){
                $unit_id = $pertandingan->unit1_id;
            } else if ($request->unit == 'unit_2'){
                $unit_id = $pertandingan->unit2_id;
            } else {
                $unit_id = 'unit_1'; // default ke unit_1 jika tidak ada di request
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

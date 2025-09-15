<?php

namespace App\Http\Controllers;

use App\Models\Arena;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\Pertandingan;
use App\Models\UserArena;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SuperAdminController extends Controller
{
    //
    public function dashboard()
    {
        return view('superadmin.dashboard');
    }

    public function kelola_peserta()
    {
        $events = Event::all();
        return view('superadmin.kelola_peserta', compact('events'));
    }

    public function atur_arena()
    {
       // Query untuk Kategori PRESTASI (ID = 2)
$daftar_pertandingan_prestasi = Pertandingan::with([
        'kelasPertandingan.kelas',
        'kelasPertandingan.kategoriPertandingan',
        'arena',
    ])
    ->where('status', 'menunggu_peserta')
    ->whereRelation('kelasPertandingan', 'kategori_pertandingan_id', 2) // <-- Lebih ringkas
    ->orderBy('id', 'asc')
    ->get();


// Query untuk Kategori PEMASALAN (ID = 1)
$daftar_pertandingan_pemasalan = Pertandingan::with([
        'kelasPertandingan.kelas',
        'kelasPertandingan.kategoriPertandingan',
        'arena',
    ])
    ->where('status', 'menunggu_peserta')
    ->whereRelation('kelasPertandingan', 'kategori_pertandingan_id', 1) // <-- Lebih ringkas
    ->orderBy('id', 'asc')
    ->get();

    $arenas = Arena::all();

    // return $daftar_pertandingan_prestasi;

        return view('superadmin.atur_arena', compact('daftar_pertandingan_prestasi', 'daftar_pertandingan_pemasalan', 'arenas'));
    }


    /**
     * [METODE BARU] - Menangani permintaan AJAX untuk memindahkan arena pertandingan.
     *
     * @param Request $request
     * @param Pertandingan $pertandingan - Diterima dari URL
     * @return \Illuminate\Http\JsonResponse
     */
    public function pindahArena(Request $request, Pertandingan $pertandingan)
    {
        // 1. Validasi input: pastikan arena_id yang dikirim ada di tabel arenas.
        $validated = $request->validate([
            'arena_id' => 'required|exists:arena,id',
        ]);

        // 2. Update arena_id pertandingan di database.
        $pertandingan->arena_id = $validated['arena_id'];
        $pertandingan->save();

        // 3. Kirim respons sukses kembali ke JavaScript.
        return response()->json([
            'status' => 'success',
            'message' => 'Pertandingan berhasil dipindahkan ke arena baru!',
            'new_arena_id' => $validated['arena_id']
        ]);
    }

    public function kelola_panitia()
    {
        // 1. Ambil semua user panitia beserta relasi arena mereka.
        $panitia = User::whereIn('role_id', [4,5, 6, 7, 8]) // Sesuaikan role_id jika perlu
            ->with('user_arena.arena')
            ->orderBy('nama_lengkap', 'asc')
            ->get();

        $roles = Role::whereIn('id', ['4', '5', '6', '7', '8'])->get();


        // 2. Ambil SEMUA arena yang ada untuk mengisi pilihan dropdown.
        $semua_arena = Arena::all();

        // 3. Kirim kedua data tersebut ke view.
        return view('superadmin.kelola_panitia', [
            'daftar_panitia' => $panitia,
            'semua_arena' => $semua_arena,
            'roles' => $roles,
        ]);
    }

    /**
     * [METODE BARU] Menangani permintaan AJAX untuk mengubah arena panitia.
     */
    public function updateArena(Request $request, User $user)
    {
        // 1. Validasi: pastikan arena_id yang dikirim valid.
        $validated = $request->validate([
            'arena_id' => 'required|exists:arena,id',
        ]);

        // 2. Gunakan updateOrCreate untuk menangani kasus panitia baru atau lama.
        // Ini akan mencari UserArena berdasarkan user_id.
        // Jika ada, arena_id akan di-update.
        // Jika tidak ada (panitia baru), record baru akan dibuat.
        UserArena::updateOrCreate(
            ['user_id' => $user->id],
            ['arena_id' => $validated['arena_id']]
        );

        // 3. Kirim respons sukses.
        return response()->json([
            'status' => 'success',
            'message' => 'Arena untuk ' . $user->nama_lengkap . ' berhasil diperbarui!'
        ]);
    }


     public function store(Request $request)
    {
        // 1. Validasi semua input dari form, termasuk arena_id
        $validated = $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:8',
            'alamat'        => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir'  => 'required|string',
            'tanggal_lahir' => 'required|date',
            'negara'        => 'required|string',
            'no_telp'       => 'required|string',
            'status'        => 'required|boolean',
            'role_id'       => 'required|exists:roles,id',
            'arena_id'      => 'nullable|exists:arena,id', // 'nullable' berarti boleh kosong
        ]);

        // Gunakan DB Transaction untuk memastikan kedua operasi (buat user & tugaskan arena) berhasil.
        DB::transaction(function () use ($validated) {
            // 2. Buat user baru di database
            $newUser = User::create([
                'nama_lengkap'  => $validated['nama_lengkap'],
                'email'         => $validated['email'],
                'password'      => Hash::make($validated['password']),
                'alamat'        => $validated['alamat'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'tempat_lahir'  => $validated['tempat_lahir'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'negara'        => $validated['negara'],
                'no_telp'       => $validated['no_telp'],
                'status'        => $validated['status'],
                'role_id'       => $validated['role_id'],
            ]);

            // 3. JIKA arena_id dipilih, buat entri di tabel user_arena
            if (!empty($validated['arena_id'])) {
                UserArena::create([
                    'user_id' => $newUser->id,
                    'arena_id' => $validated['arena_id'],
                    // Anda mungkin perlu menambahkan field lain yang wajib diisi di tabel UserArena
                ]);
            }
        });

        // 4. Redirect kembali ke halaman kelola panitia dengan pesan sukses
        return redirect()->route('superadmin.kelola-panitia')->with('success', 'Panitia baru berhasil ditambahkan!');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password'      => 'nullable|string|min:8', // Password opsional saat update
            'alamat'        => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir'  => 'required|string',
            'tanggal_lahir' => 'required|date',
            'negara'        => 'required|string',
            'no_telp'       => 'required|string',
            'status'        => 'required|boolean',
            'role_id'       => 'required|exists:roles,id',
        ]);

        // Siapkan data untuk diupdate
        $updateData = $validated;
        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        } else {
            unset($updateData['password']); // Hapus password dari array jika kosong
        }

        $user->update($updateData);

        return redirect()->route('superadmin.kelola-panitia')->with('success', 'Data panitia berhasil diperbarui!');
    }


    public function destroy(User $user)
    {
        try {
            // Hapus penugasan arena terlebih dahulu jika ada
            UserArena::where('user_id', $user->id)->delete();
            // Hapus user
            $user->delete();
            return redirect()->route('superadmin.kelola-panitia')->with('success', 'Panitia berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('superadmin.kelola-panitia')->with('error', 'Gagal menghapus panitia: ' . $e->getMessage());
        }
    }
}

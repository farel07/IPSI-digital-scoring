<?php

use Illuminate\Support\Facades\Route;
use App\Events\NotifikasiDikirim;
use App\Events\NotifikasiDikirim2;
use App\Http\Controllers\AuthController;
// use App\Events\KirimBinaan;
// use App\Events\KirimPeringatan;
// use App\Events\KirimTeguran;
// use App\Events\KirimJatuh;
// use App\Events\kirimPukul;
// use App\Events\hapusPelanggaran;
// use App\Events\kirimTendang;
// use App\Events\hapusPoint;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\dewanController;
use App\Http\Controllers\juriController;
use App\Http\Controllers\operatorController;
use App\Http\Controllers\penilaianController;
use App\Http\Controllers\timerController;
use App\Http\Controllers\TandingController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('scoring.home');
});

Route::view('/kirim-notifikasi', 'kirim');
Route::view('/dashboard', 'dashboard');
Route::view('/dashboard2', 'dashboard2');

// Menampilkan halaman login
Route::get('/login', [AuthController::class, 'index'])->name('login');

// Memproses form login
Route::post('/login', [AuthController::class, 'authenticate']);

Route::post('/kirim-notifikasi', function (Request $request) {
    event(new NotifikasiDikirim($request->judul, $request->pesan));
    return response()->json(['status' => 'berhasil']);
});
Route::post('/kirim-notifikasi_2', function (Request $request) {
    event(new NotifikasiDikirim2($request->judul, $request->pesan));
    return response()->json(['status' => 'berhasil']);
});


Route::post('/kirim-binaan/{user}', [TandingController::class, 'kirim_binaan']);
Route::post('/kirim-peringatan/{user}', [TandingController::class, 'kirim_peringatan']);
Route::post('/kirim-teguran/{user}', [TandingController::class, 'kirim_teguran']);
Route::post('/kirim-jatuh/{user}', [TandingController::class, 'kirim_jatuh']);
Route::post('/kirim-hapus-pelanggaran/{user}', [TandingController::class, 'hapus_pelanggaran']);


Route::post('/kirim-pukul/{user}', [TandingController::class, 'kirim_pukul']);
Route::post('/kirim-pukul-insert/{user}', [TandingController::class, 'kirim_pukul_insert']);
Route::post('/kirim-tendang-insert/{user}', [TandingController::class, 'kirim_tendang_insert']);
Route::post('/kirim-tendang/{user}', [TandingController::class, 'kirim_tendang']);
Route::post('/kirim-hapus-point/{user}', [TandingController::class, 'hapus_point']);

Route::post('/get_point/{user}', [TandingController::class, 'get_point']);


// get user role
Route::post('user-role/{user}', [TandingController::class, 'getUserRole']);

// total points
Route::get('/get-total-points/{pertandingan}', [TandingController::class, 'getTotalPoints']);

// route scoring
Route::prefix('scoring')->group(function () {
    Route::get('/dewan/{user}', [dewanController::class, 'index']);

    // Route::get('/juri/{id}', [juriController::class, 'index']);
    Route::get('/juri/{user}', [juriController::class, 'index'])->name('scoring.juri');

    Route::get('/operator/{user}', [operatorController::class, 'index']);
    Route::post('/operator/update-status/{pertandingan}', [OperatorController::class, 'updateStatus'])->name('operator.updateStatus');

    Route::get('/penilaian/{user}', [penilaianController::class, 'index']);

    Route::get('/timer', [timerController::class, 'index']);


    // seni & jurus baku
    Route::get('/seni/prestasi/tunggal/biru/juri', function () {
        return view('seni.prestasi.tunggal.biru.juri');
    });
    Route::get('/seni/prestasi/tunggal/biru/dewan', function () {
        return view('seni.prestasi.tunggal.biru.dewan');
    });
    Route::get('/seni/prestasi/tunggal/biru/dewanOperator', function () {
        return view('seni.prestasi.tunggal.biru.dewanOperator');
    });
    Route::get('/seni/prestasi/tunggal/biru/penonton', function () {
        return view('seni.prestasi.tunggal.biru.penonton');
    });
    Route::get('/seni/prestasi/tunggal/biru/penontonfinal', function () {
        return view('seni.prestasi.tunggal.biru.penontonFinal');
    });
    Route::get('/seni/prestasi/tunggal/merah/juri', function () {
        return view('seni.prestasi.tunggal.merah.juri');
    });
    Route::get('/seni/prestasi/tunggal/merah/dewan', function () {
        return view('seni.prestasi.tunggal.merah.dewan');
    });
    Route::get('/seni/prestasi/tunggal/merah/dewanOperator', function () {
        return view('seni.prestasi.tunggal.merah.dewanOperator');
    });
    Route::get('/seni/prestasi/tunggal/merah/penonton', function () {
        return view('seni.prestasi.tunggal.merah.penonton');
    });
    Route::get('/seni/prestasi/tunggal/penontonfinal', function () {
        return view('seni.prestasi.tunggal.penontonFinal');
    });
    Route::get('/seni/prestasi/ganda/penontonfinal', function () {
        return view('seni.prestasi.ganda.penontonFinal');
    });
    Route::get('/seni/prestasi/regu/penontonfinal', function () {
        return view('seni.prestasi.regu.penontonFinal');
    });

    Route::get('/seni/prestasi/ganda/biru/juri', function () {
        return view('seni.prestasi.ganda.biru.juri');
    });
    Route::get('/seni/prestasi/ganda/biru/dewan', function () {
        return view('seni.prestasi.ganda.biru.dewan');
    });
    Route::get('/seni/prestasi/ganda/biru/dewan2', function () {
        return view('seni.prestasi.ganda.biru.dewan2');
    });
    Route::get('/seni/prestasi/ganda/biru/penonton', function () {
        return view('seni.prestasi.ganda.biru.penonton');
    });
    Route::get('/seni/prestasi/ganda/merah/dewanOperator', function () {
        return view('seni.prestasi.ganda.merah.dewanOperator');
    });
    Route::get('/seni/prestasi/ganda/merah/juri', function () {
        return view('seni.prestasi.ganda.merah.juri');
    });
    Route::get('/seni/prestasi/ganda/merah/dewan', function () {
        return view('seni.prestasi.ganda.merah.dewan');
    });
    Route::get('/seni/prestasi/ganda/merah/dewan2', function () {
        return view('seni.prestasi.ganda.merah.dewan2');
    });
    Route::get('/seni/prestasi/ganda/merah/penonton', function () {
        return view('seni.prestasi.ganda.merah.penonton');
    });
    Route::get('/seni/prestasi/ganda/merah/dewanOperator', function () {
        return view('seni.prestasi.ganda.merah.dewanOperator');
    });
    Route::get('/seni/prestasi/regu/biru/juri', function () {
        return view('seni.prestasi.regu.biru.juri');
    });
    Route::get('/seni/prestasi/regu/biru/dewan', function () {
        return view('seni.prestasi.regu.biru.dewan');
    });
    Route::get('/seni/prestasi/regu/biru/penonton', function () {
        return view('seni.prestasi.regu.biru.penonton');
    });
    Route::get('/seni/prestasi/regu/merah/juri', function () {
        return view('seni.prestasi.regu.merah.juri');
    });
    Route::get('/seni/prestasi/regu/merah/dewan', function () {
        return view('seni.prestasi.regu.merah.dewan');
    });
    Route::get('/seni/prestasi/regu/merah/penonton', function () {
        return view('seni.prestasi.regu.merah.penonton');
    });
    Route::get('/seni/pemasalan/tunggal/juri', function () {
        return view('seni.pemasalan.tunggal.juri');
    });
    Route::get('/seni/pemasalan/tunggal/dewan', function () {
        return view('seni.pemasalan.tunggal.dewan');
    });
    Route::get('/seni/pemasalan/tunggal/dewanOperator', function () {
        return view('seni.pemasalan.tunggal.dewanOperator');
    });
    Route::get('/seni/pemasalan/tunggal/penonton', function () {
        return view('seni.pemasalan.tunggal.penonton');
    });
    Route::get('/seni/pemasalan/ganda/juri', function () {
        return view('seni.pemasalan.ganda.juri');
    });
    Route::get('/seni/pemasalan/ganda/dewan', function () {
        return view('seni.pemasalan.ganda.dewan');
    });
    Route::get('/seni/pemasalan/ganda/dewanOperator', function () {
        return view('seni.pemasalan.ganda.dewanOperator');
    });
    Route::get('/seni/pemasalan/ganda/penonton', function () {
        return view('seni.pemasalan.ganda.penonton');
    });
    Route::get('/seni/pemasalan/regu/juri', function () {
        return view('seni.pemasalan.regu.juri');
    });
    Route::get('/seni/pemasalan/regu/dewan', function () {
        return view('seni.pemasalan.regu.dewan');
    });
    Route::get('/seni/pemasalan/regu/penonton', function () {
        return view('seni.pemasalan.regu.penonton');
    });
    Route::get('/seni/timer', function () {
        return view('seni.timer.timer');
    });
    Route::get('/seni/juri/tangankosong', function () {
        return view('seni.tangankosong.juri');
    });
    Route::get('/seni/juri/bersenjata', function () {
        return view('seni.bersenjata.juri');
    });
    Route::get('/jurusbaku/perseorangan/juri', function () {
        return view('jurusbaku.perseorangan.juri');
    });
    Route::get('/jurusbaku/berpasangan/juri', function () {
        return view('jurusbaku.berpasangan.juri');
    });
    Route::get('/jurusbaku/berkelompok/juri', function () {
        return view('jurusbaku.berkelompok.juri');
    });
    // id card
    // Route::get('/idcard', function () {
    //     return view('idcard.idcard');
    // });
    // Route::get('/idcard2', function () {
    //     return view('idcard.idcard2');
    // });
});

Route::get('/superadmin', [SuperAdminController::class, 'dashboard']);
Route::get('/superadmin/kelola-peserta', [SuperAdminController::class, 'kelola_peserta']);
Route::get('/superadmin/atur-arena',[SuperAdminController::class, 'atur_arena']);
Route::get('/superadmin/example', function () {
    return view('superadmin.superadmin');
});
Route::get('/superadmin/kelola-panitia', [SuperAdminController::class, 'kelola_panitia'])->name('superadmin.kelola-panitia');
// [ROUTE BARU] Route untuk menangani update arena via AJAX
Route::post('/superadmin/update-arena/{user}', [SuperAdminController::class, 'updateArena'])->name('panitia.updateArena');
// [ROUTE BARU] Route untuk menyimpan panitia baru dari modal
Route::post('/superadmin/store', [SuperAdminController::class, 'store'])->name('panitia.store');

// [ROUTE BARU] Route untuk meng-update data panitia
Route::put('/superadmin/update/{user}', [SuperAdminController::class, 'update'])->name('panitia.update');
// [ROUTE BARU] Route untuk menghapus panitia
Route::delete('/superadmin/destroy/{user}', [SuperAdminController::class, 'destroy'])->name('panitia.destroy');

Route::post('/superadmin/pindah-arena/{pertandingan}', [SuperAdminController::class, 'pindahArena'])->name('pertandingan.pindahArena');

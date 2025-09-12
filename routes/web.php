<?php

use Illuminate\Support\Facades\Route;
use App\Events\NotifikasiDikirim;
use App\Events\NotifikasiDikirim2;
use App\Events\KirimBinaan;
use App\Events\KirimPeringatan;
use App\Events\KirimTeguran;
use App\Events\KirimJatuh;
use App\Events\kirimPukul;
use App\Events\hapusPelanggaran;
use App\Events\kirimTendang;
use App\Events\hapusPoint;
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
Route::post('kirim-tendang/{user}', [TandingController::class, 'kirim_tendang']);
Route::post('kirim-hapus-point/{user}', [TandingController::class, 'hapus_point']);

Route::post('get_point/{user}', [TandingController::class, 'get_point']);

// route scoring
Route::prefix('scoring')->group(function () {
    Route::get('/dewan/{user}', [dewanController::class, 'index']);

    // Route::get('/juri/{id}', [juriController::class, 'index']);
    Route::get('/juri/{user}', [juriController::class, 'index'])->name('scoring.juri');

    Route::get('/operator/{user}', [operatorController::class, 'index']);

    Route::get('/penilaian/{user}', [penilaianController::class, 'index']);

    Route::get('/timer', [timerController::class, 'index']);
});

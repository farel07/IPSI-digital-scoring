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
use App\Http\Controllers\dewanController;
use App\Http\Controllers\juriController;
use App\Http\Controllers\operatorController;
use App\Http\Controllers\penilaianController;
use App\Http\Controllers\timerController;
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


Route::post('/kirim-binaan', function (Request $request) {
    event(new KirimBinaan($request->count, $request->filter));
    return response()->json(['status' => 'berhasil']);
});
Route::post('/kirim-peringatan', function (Request $request) {
    event(new KirimPeringatan($request->count, $request->filter));
    return response()->json(['status' => 'berhasil']);
});
Route::post('/kirim-teguran', function (Request $request) {
    event(new KirimTeguran($request->count, $request->filter));
    return response()->json(['status' => 'berhasil']);
});
Route::post('/kirim-jatuh', function (Request $request) {
    event(new KirimJatuh($request->count, $request->filter));
    return response()->json(['status' => 'berhasil']);
});
Route::post('/kirim-hapus-pelanggaran', function (Request $request) {
    event(new hapusPelanggaran($request->type, $request->filter));
    return response()->json(['status' => 'berhasil']);
});
Route::post('/kirim-pukul/{id}', function (Request $request, $id) {
    event(new kirimPukul($request->count, $request->filter, $request->juri_ket, $id));
    return response()->json(['status' => 'berhasil']);
});
Route::post('kirim-tendang/{id}', function (Request $request, $id) {
    event(new kirimTendang($request->count, $request->filter, $request->juri_ket, $id));
    return response()->json(['status' => 'berhasil']);
});

// route scoring
Route::prefix('scoring')->group(function () {
    Route::get('/dewan/{id}', [dewanController::class, 'index']);

    Route::get('/juri/{id}', [juriController::class, 'index']);

    Route::get('/operator/{id}', [operatorController::class, 'index']);

    Route::get('/penilaian/{id}', [penilaianController::class, 'index']);

    Route::get('/timer', [timerController::class, 'index']);
});

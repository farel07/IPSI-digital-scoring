<?php

use Illuminate\Support\Facades\Route;
use App\Events\NotifikasiDikirim;
use App\Events\NotifikasiDikirim2;
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
    return view('welcome');
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

// route scoring
Route::prefix('scoring')->group(function () {
    Route::get('/dewan', function () {
        return view('scoring.dewan');
    });
    Route::get('/juri', function () {
        return view('scoring.juri');
    });
    Route::get('operator', function(){
        return view('scoring.operator');
    });
    Route::get('/penilaian', function () {
        return view('scoring.penilaian');
    }); 
    Route::get('/timer', function () {
        return view('scoring.timer');
    });
    Route::get('/home', function () {
        return view('scoring.home');
    });
});
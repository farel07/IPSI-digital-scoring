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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\KirimBinaan;
use App\Events\KirimPeringatan;
use App\Events\KirimTeguran;
use App\Events\KirimJatuh;
use App\Events\kirimPukul;
use App\Events\hapusPelanggaran;
use App\Events\kirimTendang;
use App\Events\hapusPoint;

class TandingController extends Controller
{
    //
    public function kirim_binaan(Request $request)
    {
        event(new KirimBinaan($request->count, $request->filter));
        return response()->json(['status' => 'berhasil']);
    }

    public function kirim_peringatan(Request $request)
    {
        event(new KirimPeringatan($request->count, $request->filter));
    return response()->json(['status' => 'berhasil']);
    }

    public function kirim_teguran(Request $request)
    {
        event(new KirimTeguran($request->count, $request->filter));
        return response()->json(['status' => 'berhasil']);
    }

    public function kirim_jatuh(Request $request)
    {
        event(new KirimJatuh($request->count, $request->filter));
        return response()->json(['status' => 'berhasil']);
    }

    public function kirim_pukul(Request $request)
    {
        event(new kirimPukul($request->count, $request->filter));
        return response()->json(['status' => 'berhasil']);
    }

    public function hapus_pelanggaran(Request $request)
    {
        event(new hapusPelanggaran($request->count, $request->filter));
        return response()->json(['status' => 'berhasil']);
    }

    
}

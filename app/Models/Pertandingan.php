<?php

namespace App\Models;

use App\Models\DetailPointTanding;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pertandingan extends Model
{
    use HasFactory;

    protected $table = 'pertandingan';

    /**
     * Menggunakan $guarded = [] adalah cara cepat untuk mengizinkan semua field diisi.
     * Ini aman selama Anda melakukan validasi yang benar di controller.
     */
    protected $guarded = ['id'];

    // --- Relasi-relasi yang dibutuhkan ---

    public function kelasPertandingan()
    {
        return $this->belongsTo(KelasPertandingan::class, 'kelas_pertandingan_id');
    }

    // Kita tidak lagi menggunakan relasi ini, tapi tidak apa-apa jika masih ada.
    // public function player1() ...
    // public function player2() ...
    // public function winner() ...

    public function nextMatch()
    {
        return $this->belongsTo(Pertandingan::class, 'next_match_id');
    }

    public function arena()
    {
        return $this->belongsTo(Arena::class, 'arena_id');
    }

    public function getPemainUnit1Attribute()
    {
        return BracketPeserta::where('kelas_pertandingan_id', $this->kelas_pertandingan_id)
            ->where('unit_id', $this->unit1_id)
            ->with('player.contingent') // Eager load relasi dari BracketPeserta
            ->get();
    }

    /**
     * [SOLUSI] Membuat 'kolom' virtual bernama 'pemainUnit2'.
     */
    public function getPemainUnit2Attribute()
    {
        return BracketPeserta::where('kelas_pertandingan_id', $this->kelas_pertandingan_id)
            ->where('unit_id', $this->unit2_id)
            ->with('player.contingent') // Eager load relasi dari BracketPeserta
            ->get();
    }


     public function unitPemasalanSeni()
    {
        return $this->hasMany(UnitPemasalanSeni::class, 'pertandingan_id');
    }


     public function getGroupedPesertaAttribute()
    {
        // KONDISI 1: Ini adalah pertandingan standar (Tanding / 2 unit)
        // Kita deteksi dengan memeriksa apakah unit1_id tidak null.
        if ($this->unit1_id) {
            
            // Ambil unit_id yang ada isinya (untuk menangani kasus "bye" dimana unit2_id bisa null)
            $unitIds = collect([$this->unit1_id, $this->unit2_id])->filter();

            if ($unitIds->isEmpty()) {
                return collect(); // Tidak ada peserta sama sekali
            }

            // Ambil semua data BracketPeserta untuk unit-unit tersebut
            return BracketPeserta::whereIn('unit_id', $unitIds)
                ->with('player.contingent') // Eager load relasi
                ->get()
                ->groupBy('unit_id'); // Kelompokkan hasilnya berdasarkan unit_id

        } 
        // KONDISI 2: Ini adalah pertandingan non-standar (Seni / Beregu > 2 unit)
        else {

            // Ambil semua unit_id dari tabel relasi 'unit_pemasalan_seni'
            $unitIds = $this->unitPemasalanSeni()->pluck('unit_id');
            
            if ($unitIds->isEmpty()) {
                return collect(); // Tidak ada peserta
            }

            // Ambil semua data BracketPeserta untuk unit-unit tersebut
            return BracketPeserta::whereIn('unit_id', $unitIds)
                ->with('player.contingent') // Eager load relasi
                ->get()
                ->groupBy('unit_id'); // Kelompokkan hasilnya berdasarkan unit_id
        }
    }


    public function detailPointTanding()
    {
        return $this->hasOne(DetailPointTanding::class, 'pertandingan_id', 'id');
    }
}

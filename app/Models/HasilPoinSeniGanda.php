<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilPoinSeniGanda extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     *
     * @var string
     */
    protected $table = 'hasil_poin_seni_ganda';

    /**
     * Kolom yang bisa diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pertandingan_id',
        'unit_id',
        'poin_final_median',
        'poin_std',
        'waktu_terlampaui',
        'keluar_garis',
        'senjata_jatuh',
        'senjata_tidak_jatuh',
        'tidak_ada_salam',
        'baju_senjata',
    ];

    /**
     * Mendefinisikan relasi ke model Pertandingan.
     */
    public function pertandingan(): BelongsTo
    {
        return $this->belongsTo(Pertandingan::class);
    }
}
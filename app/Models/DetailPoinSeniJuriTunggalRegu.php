<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPoinSeniJuriTunggalRegu extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     *
     * @var string
     */
    protected $table = 'detail_poin_seni_juri_tunggal_regu';

    /**
     * Kolom yang bisa diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pertandingan_id',
        'unit_id',
        'user_id', // ID juri yang memberikan skor
        'poin_benar',
        'total_kesalahan',
        'poin_stamina',
        'total_skor',
    ];

    /**
     * Mendefinisikan relasi ke model Pertandingan.
     */
    public function pertandingan(): BelongsTo
    {
        return $this->belongsTo(Pertandingan::class);
    }

    /**
     * Mendefinisikan relasi ke model User (Juri).
     */
    public function juri(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
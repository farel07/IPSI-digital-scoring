<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkorJuriTanding extends Model
{
    use HasFactory;

    protected $fillable = [
        'pertandingan_id',
        'user_id',
        'round',
        'skor_biru',
        'skor_merah',
    ];
}

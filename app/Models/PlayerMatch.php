<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerMatch extends Model
{
    use HasFactory;
    protected $table = 'player_match';
    protected $fillable = [
        'match_id',
        'player_id',
        'side',
        'round',
        'punch_point',
        'kick_point',
        'fall_point',
        'binaan_point',
        'teguran',
        'peringatan',
        'total_point',
        'is_winner',
    ];

    public function match()
    {
        return $this->belongsTo(Matches::class, 'match_id', 'id');
    }

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id', 'id');
    }
}

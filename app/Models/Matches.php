<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;
    protected $table = 'matches';
    protected $fillable = [
        'name',
        'arena_id',
        'date',
        'status',
        'bracket_id',
        'player_id',
    ];

    public function arena()
    {
        return $this->belongsTo(Arena::class, 'arena_id', 'id');
    }

    public function bracket()
    {
        return $this->belongsTo(Bracket::class, 'bracket_id', 'id');
    }

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id', 'id');
    }

    public function playerMatches()
    {
        return $this->hasMany(PlayerMatch::class, 'match_id', 'id');
    }

    public function userMatch()
    {
        return $this->hasMany(UserMatch::class, 'match_id', 'id');
    }
}

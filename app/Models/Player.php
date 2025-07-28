<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    protected $table = 'players';
    protected $fillable = [
        'name',
        'contigent',
        'player_category_id',
        'gender',
        'status'
    ];

    public function playerCategory()
    {
        return $this->belongsTo(PlayerCategory::class, 'player_category_id', 'id');
    }

    public function matches()
    {
        return $this->hasMany(Matches::class, 'player_id', 'id');
    }

    public function playerMatch(){
        return $this->hasMany(PlayerMatch::class, 'player_id', 'id');
    }
    
}     

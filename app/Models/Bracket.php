<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bracket extends Model
{
    use HasFactory;
    protected $table = 'bracket';
    protected $fillable = [
        'player_category_id',
        'name'
    ];

    public function matches()
    {
        return $this->hasMany(Matches::class, 'bracket_id', 'id');
    }

    public function playerCategory()
    {
        return $this->belongsTo(PlayerCategory::class, 'player_category_id', 'id');
    }
}

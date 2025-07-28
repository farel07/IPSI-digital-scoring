<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arena extends Model
{
    use HasFactory;

    protected $table = 'arena';
    protected $fillable = [
        'arena_name'
    ];

    public function arenaMatches()
    {
        return $this->hasMany(Matches::class, 'arena_id', 'id');
    }
}

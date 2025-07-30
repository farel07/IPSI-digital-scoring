<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arena extends Model
{
    use HasFactory;

    protected $table = 'arena';
    protected $fillable = [
        'arena_name',
        'user_id'
    ];

    public function arenaMatches()
    {
        return $this->hasMany(Matches::class, 'arena_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

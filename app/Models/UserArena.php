<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserArena extends Model
{
    use HasFactory;
    protected $table = 'user_arena';
    protected $fillable = ['user_id', 'arena_id'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function arena()
    {
        return $this->belongsTo(Arena::class, 'arena_id', 'id');
    }
}

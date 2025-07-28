<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMatch extends Model
{
    use HasFactory;
    protected $table = 'user_match';
    protected $fillable = [
        'user_id',
        'match_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function match()
    {
        return $this->belongsTo(Matches::class, 'match_id', 'id');
    }
}

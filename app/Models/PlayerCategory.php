<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerCategory extends Model
{
    use HasFactory;
    protected $table = 'player_categories';
    protected $fillable = [
        'category',
        'range',
        'class_category_id'
    ];

    public function players()
    {
        return $this->hasMany(Player::class, 'player_category_id', 'id');
    }

    public function classCategory()
    {
        return $this->belongsTo(ClassCategory::class, 'class_category_id', 'id');
    }

    public function brackets()
    {
        return $this->hasMany(Bracket::class, 'player_category_id', 'id');
    }
}

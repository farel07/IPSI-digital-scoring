<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassCategory extends Model
{
    use HasFactory;
    protected $table = 'class_categories';
    protected $fillable = [
        'name',
        'gender',
    ];
    
    public function playerCategory()
    {
        return $this->hasMany(Player::class, 'player_category_id', 'id');
    }

}

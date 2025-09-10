<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'name',
        'slug',
        // 'penyelenggara',
        'image',
        'desc',
        // 'berkas',
        // 'kegiatan',
        'type',
        'month',
        'harga_contingent',
        'harga_peserta',
        'kotaOrKabupaten',
        'lokasi',
        'tgl_mulai_tanding',
        'tgl_selesai_tanding',
        'tgl_batas_pendaftaran',
        'status',
        'cp',
        'juknis',
        'total_hadiah',
        'surat_rekom'
    ];

    public function classCategories()
    {
        return $this->hasMany(ClassCategory::class, 'event_id', 'id');
    }

    public function admins()
    {
        return $this->belongsToMany(User::class, 'user_event', 'event_id', 'user_id');
    }

    public function eventRoles()
    {
        return $this->hasMany(EventRole::class, 'event_id', 'id');
    }

    public function kelasPertandingan()
    {
        return $this->hasMany(KelasPertandingan::class, 'event_id', 'id');
    }

    // relasi ini memberitahu Laravel untuk mencari Player melalui model Contingent
    public function players()
    {
        return $this->hasManyThrough(Player::class, Contingent::class);
    }
}

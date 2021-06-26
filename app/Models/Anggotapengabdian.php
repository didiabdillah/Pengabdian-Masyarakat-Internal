<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggotapengabdian extends Model
{
    protected $table = 'anggota_pengabdian';
    protected $primaryKey = 'anggota_pengabdian_id';

    protected $fillable = [
        'anggota_pengabdian_user_id',
        'anggota_pengabdian_pengabdian_id',
        'anggota_pengabdian_role',
        'anggota_pengabdian_tugas',
    ];

    public function usulanpengabdian()
    {
        return $this->belongsTo('App\Models\Usulanpengabdian', 'anggota_pengabdian_pengabdian_id');
    }
}

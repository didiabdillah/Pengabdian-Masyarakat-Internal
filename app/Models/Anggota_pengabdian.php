<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota_pengabdian extends Model
{
    protected $table = 'pkm_anggota_pengabdian';
    protected $primaryKey = 'anggota_pengabdian_id';

    protected $fillable = [
        'anggota_pengabdian_user_id',
        'anggota_pengabdian_pengabdian_id',
        'anggota_pengabdian_role',
        'anggota_pengabdian_role_position',
        'anggota_pengabdian_tugas',
    ];

    public function usulan_pengabdian()
    {
        return $this->belongsTo('App\Models\Usulan_pengabdian', 'anggota_pengabdian_pengabdian_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Luaran_usulan extends Model
{
    protected $table = 'usulan_luaran';
    protected $primaryKey = 'usulan_luaran_id';

    protected $fillable = [
        'usulan_luaran_pengabdian_id',
        'usulan_luaran_pengabdian_urutan',
        'usulan_luaran_pengabdian_tipe',
        'usulan_luaran_pengabdian_tahun',
        'usulan_luaran_pengabdian_kategori',
        'usulan_luaran_pengabdian_jenis',
        'usulan_luaran_pengabdian_rencana',
        'usulan_luaran_pengabdian_status',
    ];

    public function usulan_pengabdian()
    {
        return $this->belongsTo('App\Models\Usulan_pengabdian', 'usulan_luaran_pengabdian_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usulan_luaran extends Model
{
    protected $table = 'pkm_usulan_luaran';
    protected $primaryKey = 'usulan_luaran_id';

    protected $fillable = [
        'usulan_luaran_pengabdian_id',
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

    public function laporan_luaran()
    {
        return $this->hasOne('App\Models\Laporan_luaran', 'laporan_luaran_luaran_id');
    }
}

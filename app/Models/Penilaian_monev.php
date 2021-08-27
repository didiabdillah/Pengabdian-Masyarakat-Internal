<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian_monev extends Model
{
    protected $table = 'pkm_penilaian_monev';
    protected $primaryKey = 'penilaian_monev_id';

    protected $fillable = [
        'penilaian_monev_pengabdian_id',
        'penilaian_monev_lock',
        'penilaian_monev_catatan',
        'penilaian_monev_skor',
        'penilaian_monev_nilai',
        'penilaian_monev_justifikasi',
        'penilaian_monev_tanda_tangan',
    ];

    public function capaian_kegiatan()
    {
        return $this->hasMany('App\Models\Capaian_kegiatan', 'capaian_kegiatan_monev_id');
    }

    public function usulan_pengabdian()
    {
        return $this->belongsTo('App\Models\Usulan_pengabdian', 'penilaian_monev_pengabdian_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capaian_kegiatan extends Model
{
    protected $table = 'capaian_kegiatan';
    protected $primaryKey = 'capaian_kegiatan_id';

    protected $fillable = [
        'capaian_kegiatan_pengabdian_id',
        'capaian_kegiatan_urutan',
        'capaian_kegiatan_jawaban',
        // 'capaian_kegiatan_kategori',
    ];

    public function usulan_pengabdian()
    {
        return $this->belongsTo('App\Models\Usulan_pengabdian', 'capaian_kegiatan_pengabdian_id');
    }
}

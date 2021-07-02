<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usulanpengabdian extends Model
{
    protected $table = 'usulan_pengabdian';
    protected $primaryKey = 'usulan_pengabdian_id';
    public $incrementing = false;

    protected $fillable = [
        'usulan_pengabdian_id',
        'usulan_pengabdian_judul',
        'usulan_pengabdian_kategori',
        'usulan_pengabdian_skema_id',
        'usulan_pengabdian_bidang_id',
        'usulan_pengabdian_lama_kegiatan',
        'usulan_pengabdian_mahasiswa_terlibat',
        'usulan_pengabdian_submit',
        'usulan_pengabdian_status',
        'usulan_pengabdian_tahun',
        'usulan_pengabdian_komentar',
    ];

    public function anggotapengabdian()
    {
        return $this->hasMany('App\Models\Anggotapengabdian', 'anggota_pengabdian_pengabdian_id');
    }

    public function dokumenusulan()
    {
        return $this->hasMany('App\Models\Dokumenusulan', 'dokumen_usulan_pengabdian_id');
    }

    public function dokumen_rab()
    {
        return $this->hasMany('App\Models\Dokumen_rab', 'dokumen_rab_pengabdian_id');
    }
}

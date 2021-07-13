<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usulan_pengabdian extends Model
{
    protected $table = 'usulan_pengabdian';
    protected $primaryKey = 'usulan_pengabdian_id';
    public $incrementing = false;

    protected $fillable = [
        'usulan_pengabdian_id',
        'usulan_pengabdian_reviewer_id',
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

    public function anggota_pengabdian()
    {
        return $this->hasMany('App\Models\Anggota_pengabdian', 'anggota_pengabdian_pengabdian_id');
    }

    public function luaran_usulan()
    {
        return $this->hasMany('App\Models\Luaran_usulan', 'usulan_luaran_pengabdian_id');
    }

    public function dokumen_usulan()
    {
        return $this->hasOne('App\Models\Dokumen_usulan', 'dokumen_usulan_pengabdian_id');
    }

    public function dokumen_rab()
    {
        return $this->hasOne('App\Models\Dokumen_rab', 'dokumen_rab_pengabdian_id');
    }

    public function mitra_sasaran()
    {
        return $this->hasMany('App\Models\Mitra_sasaran', 'mitra_sasaran_pengabdian_id');
    }

    public function penilaian_usulan()
    {
        return $this->hasOne('App\Models\Penilaian_usulan', 'penilaian_usulan_pengabdian_id');
    }
}

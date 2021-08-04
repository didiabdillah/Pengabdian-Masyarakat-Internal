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
        // 'usulan_pengabdian_kategori',
        'usulan_pengabdian_skema_id',
        'usulan_pengabdian_bidang_id',
        'usulan_pengabdian_lama_kegiatan',
        'usulan_pengabdian_mahasiswa_terlibat',
        'usulan_pengabdian_submit',
        'usulan_pengabdian_status',
        'usulan_pengabdian_tahun',
        'usulan_pengabdian_unlock_pass',
        // 'usulan_pengabdian_komentar',
    ];

    public function anggota_pengabdian()
    {
        return $this->hasMany('App\Models\Anggota_pengabdian', 'anggota_pengabdian_pengabdian_id');
    }

    public function usulan_luaran()
    {
        return $this->hasMany('App\Models\Usulan_luaran', 'usulan_luaran_pengabdian_id');
    }

    public function dokumen_usulan()
    {
        return $this->hasOne('App\Models\Dokumen_usulan', 'dokumen_usulan_pengabdian_id');
    }

    public function dokumen_rab()
    {
        return $this->hasOne('App\Models\Dokumen_rab', 'dokumen_rab_pengabdian_id');
    }

    public function logbook()
    {
        return $this->hasMany('App\Models\Logbook', 'logbook_pengabdian_id');
    }

    public function logbook_berkas()
    {
        return $this->hasMany('App\Models\Logbook_berkas', 'logbook_berkas_pengabdian_id');
    }

    public function laporan_akhir()
    {
        return $this->hasOne('App\Models\Laporan_akhir', 'laporan_akhir_pengabdian_id');
    }

    public function mitra_sasaran()
    {
        return $this->hasMany('App\Models\Mitra_sasaran', 'mitra_sasaran_pengabdian_id');
    }

    public function penilaian_usulan()
    {
        return $this->hasOne('App\Models\Penilaian_usulan', 'penilaian_usulan_pengabdian_id');
    }

    public function penilaian_monev()
    {
        return $this->hasOne('App\Models\Penilaian_monev', 'penilaian_monev_pengabdian_id');
    }

    public function capaian_kegiatan()
    {
        return $this->hasMany('App\Models\Capaian_kegiatan', 'capaian_kegiatan_pengabdian_id');
    }

    public function laporan_kemajuan()
    {
        return $this->hasMany('App\Models\Laporan_kemajuan', 'laporan_kemajuan_pengabdian_id');
    }
}

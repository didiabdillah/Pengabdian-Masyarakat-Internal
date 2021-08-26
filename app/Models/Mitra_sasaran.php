<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mitra_sasaran extends Model
{
    protected $table = 'pkm_mitra_sasaran';
    protected $primaryKey = 'mitra_sasaran_id';

    protected $fillable = [
        'mitra_sasaran_pengabdian_id',
        'mitra_sasaran_tipe_mitra',
        'mitra_sasaran_jenis_mitra',
        'mitra_sasaran_nama_pimpinan_mitra',
        'mitra_sasaran_jabatan_pimpinan_mitra',
        'mitra_sasaran_nama_mitra',
        'mitra_sasaran_alamat_mitra',
        'mitra_sasaran_provinsi_mitra',
        'mitra_sasaran_kota_mitra',
        'mitra_sasaran_kecamatan_mitra',
        'mitra_sasaran_desa_mitra',
        'mitra_sasaran_jarak_mitra',
        'mitra_sasaran_bidang_masalah_mitra',
        'mitra_sasaran_kontribusi_pendanaan_mitra',
    ];

    public function mitra_file()
    {
        return $this->hasMany('App\Models\Mitra_file', 'mitra_file_mitra_sasaran_id');
    }

    public function usulan_pengabdian()
    {
        return $this->belongsTo('App\Models\Usulan_pengabdian', 'mitra_sasaran_pengabdian_id');
    }
}

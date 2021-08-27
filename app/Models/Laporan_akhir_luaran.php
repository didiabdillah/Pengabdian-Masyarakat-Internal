<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan_akhir_luaran extends Model
{
    public $table = 'pkm_laporan_akhir_luaran';
    protected $primaryKey = 'laporan_akhir_luaran_id';

    protected $fillable = [
        'laporan_akhir_luaran_luaran_id',
        'laporan_akhir_luaran_nama_publikasi',
        'laporan_akhir_luaran_judul',
        'laporan_akhir_luaran_link',
        'laporan_akhir_luaran_date',
        'laporan_akhir_luaran_tipe',
        'laporan_akhir_luaran_original_name',
        'laporan_akhir_luaran_hash_name',
        'laporan_akhir_luaran_base_name',
        'laporan_akhir_luaran_file_size',
        'laporan_akhir_luaran_extension',
    ];

    public function usulan_luaran()
    {
        return $this->belongsTo('App\Models\Usulan_luaran', 'laporan_akhir_luaran_luaran_id');
    }
}

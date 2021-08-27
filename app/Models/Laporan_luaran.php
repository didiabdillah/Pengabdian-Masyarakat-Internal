<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan_luaran extends Model
{
    public $table = 'pkm_laporan_luaran';
    protected $primaryKey = 'laporan_luaran_id';

    protected $fillable = [
        'laporan_luaran_luaran_id',
        'laporan_luaran_nama_publikasi',
        'laporan_luaran_judul',
        'laporan_luaran_link',
        'laporan_luaran_date',
        'laporan_luaran_tipe',
        'laporan_luaran_original_name',
        'laporan_luaran_hash_name',
        'laporan_luaran_base_name',
        'laporan_luaran_file_size',
        'laporan_luaran_extension',
    ];

    public function usulan_luaran()
    {
        return $this->belongsTo('App\Models\Usulan_luaran', 'laporan_luaran_luaran_id');
    }
}

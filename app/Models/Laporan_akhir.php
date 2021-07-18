<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan_akhir extends Model
{
    protected $primaryKey = 'laporan_akhir_pengabdian_id';
    public $table = 'laporan_akhir';

    protected $fillable = [
        'laporan_akhir_pengabdian_id',
        'laporan_akhir_date',
        'laporan_akhir_original_name',
        'laporan_akhir_hash_name',
        'laporan_akhir_base_name',
        'laporan_akhir_file_size',
        'laporan_akhir_extension',
    ];

    public function usulan_pengabdian()
    {
        return $this->belongsTo('App\Models\Usulan_pengabdian', 'laporan_akhir_pengabdian_id');
    }
}

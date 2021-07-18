<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan_kemajuan extends Model
{
    protected $primaryKey = 'laporan_kemajuan_pengabdian_id';
    public $table = 'laporan_kemajuan';

    protected $fillable = [
        'laporan_kemajuan_pengabdian_id',
        'laporan_kemajuan_date',
        'laporan_kemajuan_original_name',
        'laporan_kemajuan_hash_name',
        'laporan_kemajuan_base_name',
        'laporan_kemajuan_file_size',
        'laporan_kemajuan_extension',
    ];

    public function usulan_pengabdian()
    {
        return $this->belongsTo('App\Models\Usulan_pengabdian', 'laporan_kemajuan_pengabdian_id');
    }
}

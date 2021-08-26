<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen_usulan extends Model
{
    protected $table = 'pkm_dokumen_usulan';
    protected $primaryKey = 'dokumen_usulan_id';

    protected $fillable = [
        'dokumen_usulan_pengabdian_id',
        'dokumen_usulan_original_name',
        'dokumen_usulan_hash_name',
        'dokumen_usulan_base_name',
        'dokumen_usulan_file_size',
        'dokumen_usulan_extension',
    ];

    public function usulan_pengabdian()
    {
        return $this->belongsTo('App\Models\Usulan_pengabdian', 'dokumen_usulan_pengabdian_id');
    }
}

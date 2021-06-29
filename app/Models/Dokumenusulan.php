<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumenusulan extends Model
{
    protected $table = 'dokumen_usulan';
    protected $primaryKey = 'dokumen_usulan_id';

    protected $fillable = [
        'dokumen_usulan_pengabdian_id',
        'dokumen_usulan_original_name',
        'dokumen_usulan_hash_name',
        'dokumen_usulan_base_name',
        'dokumen_usulan_file_size',
        'dokumen_usulan_extension',
    ];

    public function usulanpengabdian()
    {
        return $this->belongsTo('App\Models\Usulanpengabdian', 'dokumen_usulan_pengabdian_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen_rab extends Model
{
    protected $table = 'dokumen_rab';
    protected $primaryKey = 'dokumen_rab_id';

    protected $fillable = [
        'dokumen_rab_pengabdian_id',
        'dokumen_rab_original_name',
        'dokumen_rab_hash_name',
        'dokumen_rab_base_name',
        'dokumen_rab_file_size',
        'dokumen_rab_extension',
    ];

    public function usulanpengabdian()
    {
        return $this->belongsTo('App\Models\Usulanpengabdian', 'dokumen_rab_pengabdian_id');
    }
}

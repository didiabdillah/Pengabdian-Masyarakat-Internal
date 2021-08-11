<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilayah_desa extends Model
{
    protected $table = 'wilayah_desa';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'kecamatan_id',
        'nama',
    ];
}

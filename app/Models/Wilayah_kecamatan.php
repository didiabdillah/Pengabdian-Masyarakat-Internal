<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilayah_kecamatan extends Model
{
    protected $table = 'wilayah_kecamatan';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'kabupaten_id',
        'nama',
    ];
}

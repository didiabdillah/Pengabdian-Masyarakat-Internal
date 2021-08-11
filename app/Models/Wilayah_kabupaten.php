<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilayah_kabupaten extends Model
{
    protected $table = 'wilayah_kabupaten';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'provinsi_id',
        'nama',
    ];
}

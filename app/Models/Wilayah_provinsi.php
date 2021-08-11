<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilayah_provinsi extends Model
{
    protected $table = 'wilayah_provinsi';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'nama',
    ];
}

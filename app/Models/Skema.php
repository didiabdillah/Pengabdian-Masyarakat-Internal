<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skema extends Model
{
    protected $table = 'skema_pengabdian';
    protected $primaryKey = 'skema_id';

    protected $fillable = [
        'skema_label',
    ];
}

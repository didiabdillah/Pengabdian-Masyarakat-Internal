<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $primaryKey = 'user_id';
    public $incrementing = false;

    protected $fillable = [
        'user_id', 'user_nama', 'user_email', 'user_password', 'user_role', 'user_nidn', 'user_image'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    protected $primaryKey = 'biodata_id';
    public $table = 'biodata';

    protected $fillable = [
        'biodata_user_id',
        'biodata_sex',
        'biodata_college',
        'biodata_study_program',
        'biodata_position',
        'biodata_birthplace',
        'biodata_birthdate',
        'biodata_ktp_number',
        'biodata_hp_number',
        'biodata_telephone_number',
        'biodata_address',
        'biodata_personal_web',
        'biodata_image',
    ];
}

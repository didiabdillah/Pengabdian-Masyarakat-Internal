<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    protected $primaryKey = 'logbook_id';
    public $table = 'logbook';

    protected $fillable = [
        'logbook_pengabdian_id',
        'logbook_date',
        'logbook_uraian_kegiatan',
        'logbook_presentase',
    ];

    public function usulan_pengabdian()
    {
        return $this->belongsTo('App\Models\Usulan_pengabdian', 'logbook_pengabdian_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LHPMemorizationsModel extends Model
{
    use HasFactory;

    protected $table = 'lhp_memorizations';

    protected $fillable =[
        'lhp_id',
        'type',
        'create_number',
        'create_type',
        'size',
        'series',
        'series_init',
        'series_total',
        'series_type',
        'tps_merah',
        'tps_hijau',
        'lock_seal',
        'thread_seal',
    ];

    public function lhp()
    {
        return $this->belongsTo(LsModel::class, 'lhp_id');
    }
}

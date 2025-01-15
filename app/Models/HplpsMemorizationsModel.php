<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HplpsMemorizationsModel extends Model
{
    use HasFactory;
    protected $table = 'hplps_memorizations';
    protected $fillable =[
        'hplps_id',
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

    public function hplps()
    {
        return $this->belongsTo(HplpsModel::class,'hplps_id');
    }

}

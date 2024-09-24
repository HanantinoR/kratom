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
        'tm_series',
        'tm_init',
        'tm_final',
        'th_series',
        'th_init',
        'th_final',
        'ts_series',
        'ts_init',
        'ts_final'
    ];

    public function hplps_id()
    {
        return $this->belongsTo(HplpsModel::class,'hplps_id');
    }

}

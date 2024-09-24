<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BcopsUsageModel extends Model
{
    use HasFactory;

    protected $table = 'bcops_usage';
    protected $fillable = [
        'hplps_id',
        'type',
        'series',
        'series_init',
        'series_final',
    ];

    public function hplps()
    {
        return $this->belongsTo(HplpsModel::class, 'hplps_id');
    }
}

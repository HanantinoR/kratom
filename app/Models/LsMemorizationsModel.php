<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LsMemorizationsModel extends Model
{
    use HasFactory;

    protected $table = 'ls_memorizations';

    protected $fillable =[
        'ls_id',
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

    public function ls()
    {
        return $this->belongsTo(LsModel::class, 'ls_id');
    }
}

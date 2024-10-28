<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BcopsGreenSealModel extends Model
{
    use HasFactory;

    protected $table = 'bcops_green_seal';

    protected $fillable =
    [
        'seal_series',
        'seal_init',
        'seal_total',
        'seal_finish'
    ];
}

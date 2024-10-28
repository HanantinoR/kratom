<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BcopsRedSealModel extends Model
{
    use HasFactory;

    protected $table = 'bcops_red_seal';

    protected $fillable =
    [
        'seal_series',
        'seal_init',
        'seal_total',
        'seal_finish'
    ];

}

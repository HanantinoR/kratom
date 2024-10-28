<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BcopsLockSealModel extends Model
{
    use HasFactory;

    protected $table = 'bcops_lock_seal';

    protected $fillable =
    [
        'seal_series',
        'seal_init',
        'seal_total',
        'seal_finish'
    ];
}

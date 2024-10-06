<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KantorCabang extends Model
{
    use HasFactory;
    protected $table = 'moffices';

    protected $fillable = [
        'code',
        'name',
        'type',
        'city_id',
        'users_id',
        'is_active',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabupatenKota extends Model
{
    use HasFactory;
    protected $table = 'mdistricts';

    protected $fillable = [
        'code',
        'name',
        'province_id',
        'users_id',
        'is_active',
    ];
}

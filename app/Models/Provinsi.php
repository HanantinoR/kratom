<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    protected $table = 'mprovinces';

    protected $fillable = [
        'code',
        'name',
        'users_id',
        'is_active',
    ];
}

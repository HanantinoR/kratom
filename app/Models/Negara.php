<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negara extends Model
{
    use HasFactory;
    protected $table = 'mcountries';

    protected $fillable = [
        'code',
        'name',
        'type',
        'users_id',
        'is_active',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KotaCabang extends Model
{
    use HasFactory;
    protected $table = 'mcities';

    protected $fillable = [
        'code',
        'name',
        'users_id',
        'is_active',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelabuhanTujuan extends Model
{
    use HasFactory;
    protected $table = 'mdestination_ports';

    protected $fillable = [
        'code',
        'name',
        'country_id',
        'users_id',
        'is_active',
    ];
}

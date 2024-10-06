<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelabuhanMuat extends Model
{
    use HasFactory;
    protected $table = 'mloading_ports';

    protected $fillable = [
        'code',
        'name',
        'code_office',
        'short_office_name',
        'users_id',
        'status',
    ];
}

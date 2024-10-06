<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisPemeriksaan extends Model
{
    use HasFactory;
    protected $table = 'minspection_analysis';

    protected $fillable = [
        'code',
        'description',
        'users_id',
        'is_active',
    ];
}

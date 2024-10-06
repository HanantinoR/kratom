<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KesimpulanPemeriksaan extends Model
{
    use HasFactory;
    protected $table = 'mexamination_conclusions';

    protected $fillable = [
        'code',
        'conclusion',
        'is_active',
    ];
}

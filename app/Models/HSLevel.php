<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HSLevel extends Model
{
    use HasFactory;

    protected $table = 'mprocessed_levels';
    protected $fillable = [
        'hs',
        'detail',
        'is_active',
    ];

}

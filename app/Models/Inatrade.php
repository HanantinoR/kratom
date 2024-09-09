<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inatrade extends Model
{
    use HasFactory;
    protected $table = 'inatrade';
    protected $fillable = [
        'ls_number',
        'ppbe_number',
        'ls_publish_date',
        'ppbe_publish_date',
        'status',
        'company_name',
    ];

}

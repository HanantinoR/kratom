<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerijinanHistoryModel extends Model
{
    use HasFactory;

    protected $table = 'company_history';
    protected $fillable = [
        'company_id',
        'field',
        'old_value',
        'new_value'
    ];
}

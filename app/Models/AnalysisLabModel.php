<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalysisLabModel extends Model
{
    use HasFactory;

    protected $table = 'analysis_lab';

    protected $fillable = [
        'ppbe_id',
        'analysis_result',
        'request_by'
    ];
}

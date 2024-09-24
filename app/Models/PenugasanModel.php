<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenugasanModel extends Model
{
    use HasFactory;

    protected $table = 'ppbe_assignment';

    protected $fillable = [
        "surveyor_id",
        "intervention_type",
        "letter_number",
        "ppbe_id",
        "created_by",
        "updated_by"
    ];
}

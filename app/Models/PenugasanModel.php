<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenugasanModel extends Model
{
    use HasFactory;

    protected $table = 'penugasan_assignment';

    protected $fillable = [
        "surveyor_id", //
        "invervention_type",
        "letter_number",
        "ppbe_id"
    ];
}

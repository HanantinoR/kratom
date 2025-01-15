<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestBookingModel extends Model
{
    use HasFactory;
    protected $table = 'request_booking_ppbe';

    protected $fillable = [
        'ppbe_id',
        'request_result',
        'request_by'
    ];
}

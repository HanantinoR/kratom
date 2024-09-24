<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HplpsGoodsModel extends Model
{
    use HasFactory;

    protected $table = 'hplps_goods';
    protected $fillable =[
        'hplps_id',
        'processed_level_id',
        'description',
        'quantity_kg',
        'fob_value',
    ];

}

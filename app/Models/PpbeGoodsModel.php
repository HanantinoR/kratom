<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpbeGoodsModel extends Model
{
    use HasFactory;

    protected $table = 'ppbe_goods';
    protected $fillable = [
        'ppbe_id',
        'processed_level_id',
        'description',
        'quantity_kg',
        'fob_value',
        'per_kilogram',
    ];

    public function ppbe()
    {
        return $this->belongsTo(PPBEModel::class,'ppbe_id');
    }

    public function hs()
    {
        return $this->belongsTo(HSLevel::class,'processed_level_id');
    }

}

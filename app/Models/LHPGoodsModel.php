<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LHPGoodsModel extends Model
{
    use HasFactory;

    protected $table = 'lhp_goods';

    protected $fillable =[
        'lhp_id',
        'processed_level_id',
        'description',
        'quantity_kg',
        'fob_value',
    ];

    public function lhp()
    {
        return $this->belongsTo(LsModel::class, 'lhp_id');
    }

    public function hs()
    {
        return $this->belongsTo(HSLevel::class,'processed_level_id');
    }
}

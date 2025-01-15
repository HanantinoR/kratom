<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LsGoodsModel extends Model
{
    use HasFactory;

    protected $table = 'ls_goods';

    protected $fillable =[
        'ls_id',
        'processed_level_id',
        'description',
        'quantity_kg',
        'fob_value',
    ];

    public function ls()
    {
        return $this->belongsTo(LsModel::class, 'ls_id');
    }

    public function hs()
    {
        return $this->belongsTo(HSLevel::class,'processed_level_id');
    }
}

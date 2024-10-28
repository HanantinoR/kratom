<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataUang extends Model
{
    use HasFactory;
    protected $table = 'mcurrencies';

    protected $fillable = [
        'code',
        'description',
        'users_id',
        'is_active',
    ];

    public function ppbe(){
        return $this->belongsTo(PPBEModel::class, 'id');
    }
}

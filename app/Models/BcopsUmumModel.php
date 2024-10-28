<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BcopsUmumModel extends Model
{
    use HasFactory;

    protected $table = 'bcops_umum';

    protected $fillable =
    [
        'red_seal_id',
        'green_seal_id',
        'lock_seal_id',
        'thread_seal_id',
        'date_seal'
    ];

    public function red()
    {
        return $this->belongsTo(BcopsRedSealModel::class, 'red_seal_id');
    }

    public function green()
    {
        return $this->belongsTo(BcopsGreenSealModel::class, 'green_seal_id');
    }
    public function lock()
    {
        return $this->belongsTo(BcopsLockSealModel::class, 'lock_seal_id');
    }
    public function thread()
    {
        return $this->belongsTo(BcopsThreadSealModel::class, 'thread_seal_id');
    }
}

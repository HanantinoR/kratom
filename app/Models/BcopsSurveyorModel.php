<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BcopsSurveyorModel extends Model
{
    use HasFactory;
    protected $table = 'bcops_surveyor';
    protected $fillable =
    [
        'bcops_id',
        'surveyor_id'
    ];

    public function bcops_umum()
    {
        return $this->belongsTo(BcopsUmumModel::class, 'bcops_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'surveyor_id');
    }
}

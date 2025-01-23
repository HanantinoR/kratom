<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerijinanPEModel extends Model
{
    use HasFactory;

    protected $table = 'company_pe';
    protected $fillable = [
        'company_id',
        'nomor_pe',
        'result_pe',
        'file_pe',
        'created_by',
        'updated_by',
        'permit_date',
        'date_start',
        'date_end',
        'status'
    ];

    public function pe_detail()
    {
        return $this->hasMany(PerijinanPEDetailModel::class,'pe_id');
    }

    public function company()
    {
        return $this->belongsTo(PerijinanModel::class,'pe_id');
    }
}

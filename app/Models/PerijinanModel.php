<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerijinanModel extends Model
{
    use HasFactory;

    protected $table = 'company';
    protected $fillable = [
        'nib',
        'nomor_et',
        'nomor_pe',
        'date_nib',
        'date_et',
        'date_pe',
        'company_name',
        'company_quota',
        'company_provincy',
        'company_city',
        'company_address',
        'company_factory',
        'company_inspection_office',
        'company_pic',
        'company_position',
        'company_npwp',
        'company_telp',
        'company_hp',
        'company_email',
        'status',
        'file_et',
        'file_pe',
    ];

    public function histories()
    {
        return $this->hasMany(PerijinanHistoryModel::class);
    }

}

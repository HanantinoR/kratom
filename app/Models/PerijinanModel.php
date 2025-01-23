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
        'npwp',
        'nomor_et',
        'date_nib',
        'date_et',
        'name',
        'quota',
        'province_id',
        'city_id',
        'company_address',
        'factory_address',
        'branch_office',
        'pic',
        'position',
        'status',
        'file_et',
        'file_pe',
        'file_nib',
        'file_npwp',
        'file_ktp',
        'created_by',
        'updated_by',
        'result_et'
    ];

    public function histories()
    {
        return $this->hasMany(PerijinanHistoryModel::class,'company_id');
    }

    public function pe()
    {
        return $this->hasMany(PerijinanPEModel::class,'company_id');
    }

}


//PR dinamis PE menggunakan modal dimana isinya Nomor PE, Tanggal PE, Kuota, File PE
//PR history PE yang isinya Nomor PE tanggal PE Kuota, Kuota Pemakaian, Kuota Sisa, status (aktif, expired, pengurangan),keterangan (awal, update, pengajuan - Nomor ppbe - tanggal)
//created_by dan updated_by pada table company_pe

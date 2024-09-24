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
        'file_nib',
        'file_npwp',
        'file_ktp',
        'created_by',
        'updated_by',
    ];

    public function histories()
    {
        return $this->hasMany(PerijinanHistoryModel::class,'company_id');
    }

    public function kuota()
    {
        return $this->hasMany(HistoryQuotaModel::class,'company_id');
    }

}


//PR dinamis PE menggunakan modal dimana isinya Nomor PE, Tanggal PE, Kuota, File PE
//PR history PE yang isinya Nomor PE tanggal PE Kuota, Kuota Pemakaian, Kuota Sisa, status (aktif, expired, pengurangan),keterangan (awal, update, pengajuan - Nomor ppbe - tanggal)
//created_by dan updated_by pada table company_pe

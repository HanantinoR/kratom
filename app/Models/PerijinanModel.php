<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerijinanModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'nib',
        'nama_perusahaan',
        'provinsi',
        'kota',
        'jenis_usaha',
        'kategori_ijin',
        'tanggal_nib',
        'status_ijin',
    ];
}

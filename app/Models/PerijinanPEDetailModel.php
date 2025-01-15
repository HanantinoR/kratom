<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerijinanPEDetailModel extends Model
{
    use HasFactory;

    protected $table = 'company_pe_detail';
    protected $fillable = [
        'pe_id',
        'hs',
        'detail',
        'volume_total',
        'volume_sisa',
        'volume_tersedia',
        'tgl_berlaku',
        'terpakai_ls',
        'terpakai_ppbe'
    ];
}

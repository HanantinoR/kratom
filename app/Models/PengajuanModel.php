<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanModel extends Model
{
    use HasFactory;
    protected $table = 'pengajuan';
    protected $fillable = [
        'pengajuan_code',
        'pengajuan_date',
        'status',
        'company_name',
        'office_inspection',
    ];
}

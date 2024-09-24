<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryQuotaModel extends Model
{
    use HasFactory;
    protected $table = 'history_quota';

    protected $fillable = [
        'ppbe_id',
        'ls_id',
        'company_id',
        'nomor_pe',
        'date_pe',
        'company_quota',
        'company_quota_remaining',
        'company_quota_used',
        'status_quota',
        'notes'
    ];

    public function company()
    {
        return $this->belongsTo(PerijinanModel::class);
    }

}

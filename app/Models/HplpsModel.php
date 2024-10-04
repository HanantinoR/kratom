<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HplpsModel extends Model
{
    use HasFactory;

    protected $table = 'hplps';
    protected $fillable = [
        'ppbe_id',
        'date',
        'surveyor_id',
        'inspection_date_start',
        'inspection_date_end',
        'hpl_notes',
        'stuffing_date_start',
        'stuffing_date_end',
        'analysis_result',
        'checker_list',
        'status',
        'packaging_total',
        'packaging_unit',
        'inpsection_address',
        'fob_total_hpl',
        'fob_currency_hpl',
        'hpl_feedback_reason',
        'hpl_feedback_file',
        'request_id',
        'verify_id',
    ];

    protected $appends = [
        'status_name',
        'submitted_date',
        'verify_date',
        'verify_signed_date'
    ];

    public function getStatusNameAttribute()
    {
        $status_name = 'Pengajuan';
        switch($this->status){
            case 'hpl_submitted':
                $status_name = 'Pengajuan';
                break;
            case 'verify':
                $status_name = 'Verifikasi';
                break;
            case 'verify_ls':
                $status_name = 'Verifikasi LS';
                break;
        }
    }

    public function ppbe()
    {
        return $this->belongsTo(PPBEModel::class, 'ppbe_id');
    }

    public function goods()
    {
        return $this->hasMany(HplpsGoodsModel::class,'hplps_id');
    }

    public function memory()
    {
        return $this->hasMany(HplpsMemorizationsModel::class,'hplps_id');
    }

    public function usage()
    {
        return $this->hasMany(BcopsUsageModel::class,'hplps_id');
    }

    public function hpl_history()
    {
        return $this->hasMany(HplpsHistoryModel::class,'ppbe_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LHPModel extends Model
{
    use HasFactory;
    protected $table = 'lhp';

    protected $fillable = [
        'ppbe_id',
        'hplps_id',
        'code',
        'code_below_lhp',
        'code_above_lhp',
        'code_date',
        'nib',
        'nomor_et',
        'date_nib',
        'date_et',
        'destination_port_id',
        'loading_port_id',
        'origin_port_id',
        'country_id',
        'company_name',
        'company_address',
        'company_npwp',
        'inspection_office_id',
        'inspection_date',
        'inspection_address',
        'fob_total',
        'fob_currency',
        'invoice_number',
        'invoice_date',
        'packing_list_number',
        'packing_list_date',
        'buyer_name',
        'buyer_address',
        'merk',
        'hpl_notes',
        'packing_total',
        'packing_type',
        'signer_ls_id',
        'is_canceled',
        'canceled_reason',
        'file_cancel',
        'is_perubahan',
        'mexamination_conclusions_id',
        'status',
        'surveyor_reports_id',
    ];

    public function ppbe()
    {
        return $this->belongsTo(PPBEModel::class, 'ppbe_id');
    }

    public function hplps()
    {
        return $this->belongsTo(HplpsModel::class, 'hplps_id');
    }

    public function goods()
    {
        return $this->hasMany(LHPGoodsModel::class,'lhp_id');
    }

    public function memorys()
    {
        return $this->hasMany(LHPMemorizationsModel::class,'lhp_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LsModel extends Model
{
    use HasFactory;

    protected $table = 'ls';

    protected $fillable = [
        'ppbe_id',
        'hplps_id',
        'code',
        'code_below',
        'code_above',
        'code_date',
        'nib',
        'nomor_et',
        'nomor_pe',
        'date_nib',
        'date_et',
        'date_pe',
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
        return $this->hasMany(LsGoodsModel::class,'ls_id');
    }

    public function memorys()
    {
        return $this->hasMany(LsMemorizationsModel::class,'ls_id');
    }
}

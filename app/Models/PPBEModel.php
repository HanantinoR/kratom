<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPBEModel extends Model
{
    use HasFactory;
    protected $table = 'ppbe';
    protected $fillable = [
        'code',
        'date',
        'company_id',
        'merk',
        'packing_number',
        'packing_total',
        'fob_total',
        'fob_currency',
        'invoice_number',
        'invoice_date',
        'packing_list_number',
        'packing_list_date',
        'buyer_name',
        'buyer_address',
        'country_id',
        'country_destination_id',
        'destination_port_id',
        'loading_port_id',
        'goods_storage',
        'inspection_office_id',
        'inspection_date',
        'inspection_timezone',
        'inspection_address',
        'inspection_province_id',
        'inspection_city_id',
        'inspection_pic_name',
        'inspection_pic_phone',
        'stuffing_office_id',
        'stuffing_date',
        'stuffing_timezone',
        'stuffing_address',
        'status',
        'memorize_type',
        'memorize_feet',
        'memorize_total',
        'memorize_skenario',
        'file_nib',
        'file_invoice',
        'file_packing_list',
        'notes',
    ];
}

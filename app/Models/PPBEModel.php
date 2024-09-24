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
        'packing_total',
        'packing_type',
        'fob_total',
        'fob_currency',
        'invoice_number',
        'invoice_date',
        'packing_list_number',
        'packing_list_date',
        'buyer_name',
        'buyer_address',
        'origin_port_id',
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
        'checkbox_data',
        'memorize_type',
        'memorize_size',
        'memorize_total',
        'memorize_skenario',
        'file_nib',
        'file_invoice',
        'file_packing_list',
        'notes',
        'created_by',
        'updated_by',

    ];

    protected $appends = [
        'status_name',
        'submitted_date',
        'approved_date',
        'assignment_date'
    ];

    public function getStatusNameAttribute()
    {
        $status_name = 'Pengajuan';
        switch($this->status){
            case 'submitted':
                $status_name = 'Pengajuan';
                break;
            case 'draft':
                $status_name = 'Draft';
                break;
            case 'approved':
                $status_name = 'Terverifikasi';
                break;
            case 'assignment' :
                $status_name = 'Penugasan';
                break;
        }
    }

    public function getSubmittedDateAttribute()
    {
        $result = null;
        if (in_array($this->status, ['submitted', 'approved', 'pending', 'pending_process', 'verified', 'print_assignment_letter', 'assignment'])) {
            $result = date("d-m-Y H:i:s", strtotime($this->created_at));
        }

        return $result;
    }

    public function getApprovedDateAttribute()
    {
        $result = null;
        if (in_array($this->status, ['approved', 'verified', 'print_assignment_letter', 'assignment'])) {
            $log = PpbeHistoryModel::where('ppbe_id', $this->id)->whereIn('status', ['approved'])->orderBy('id', 'desc')->first();
            if ($log) $result = date("d-m-Y H:i:s", strtotime($log->created_at));
        }

        return $result;
    }

    public function getAssignmentDateAttribute()
    {
        $result = null;
        if (in_array($this->status, ['print_assignment_letter', 'assignment'])) {
            $assignment = PenugasanModel::where('ppbe_id', $this->id)->orderBy('id', 'desc')->first();
            if ($assignment) $result = date("d-m-Y H:i:s", strtotime($assignment->created_at));
        }

        return $result;
    }

    public function goods()
    {
        return $this->hasMany(PpbeGoodsModel::class,'ppbe_id');
    }

    public function company()
    {
        return $this->belongsTo(PerijinanModel::class,'company_id');
    }

    public function ppbe_history()
    {
        return $this->hasMany(PpbeHistoryModel::class,'ppbe_id');
    }

    public function assignments()
    {
        return $this->hasMany(PenugasanModel::class,'ppbe_id');
    }

    public function hplps()
    {
        return $this->hasOne(HplpsModel::class, 'ppbe_id', 'id');
    }
}

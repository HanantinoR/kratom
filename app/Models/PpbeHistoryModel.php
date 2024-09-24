<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpbeHistoryModel extends Model
{
    use HasFactory;

    protected $table = 'ppbe_history';
    protected $fillable =   [
        'ppbe_id',
        'request_id',
        'approver_id',
        'status',
        'status_description',
        'new_status',
        'reason',
    ];

    public function ppbe() {
		return $this->belongsTo(PPBEModel::class, 'ppbe_id');
	}
}

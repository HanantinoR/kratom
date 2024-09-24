<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HplpsHistoryModel extends Model
{
    use HasFactory;
    protected $table = 'hplps_history';
    protected $fillable = [
        'hplps_id',
        'field',
        'old_value',
        'new_value',
        'notes'
    ];

    public function hplps() {
		return $this->belongsTo(HplpsModel::class, 'hplps_id');
	}
}

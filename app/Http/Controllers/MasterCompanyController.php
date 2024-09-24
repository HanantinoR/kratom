<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerijinanModel;
use App\Models\HistoryQuotaModel;

class MasterCompanyController extends Controller
{
    public function getCompany($id)
    {
        // dd($id);
        $company = PerijinanModel::where('id',$id)->first();
        $check_kuota = HistoryQuotaModel::where('company_id',$id)->orderBy('created_at','desc')->first();

        return response()->json([
            'company' => $company,
            'quota' => $check_kuota
        ],200);
    }
}

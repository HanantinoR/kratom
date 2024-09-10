<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerijinanModel;
use App\Models\PengajuanModel;

class MasterCompanyController extends Controller
{
    public function getCompany($id)
    {
        // dd($id);
        $company = PerijinanModel::where('id',$id)->first();
        // dd($company->id);
        $pengajuan_perusahaan = PengajuanModel::query()->where('company_id',$company);
        if(!empty($pengajuan_perusahaan)){
            $quota_used = $pengajuan_perusahaan->join('pengajuan_barang','PPBE.id','=','pengajuan_barang.pengajuan_id')
                                        ->sum('pengajuan_baran.total');
        } else {
            $quota_used = 0;
        }
        return response()->json([
            'company' => $company,
            'quota_used' => $quota_used
        ],200);
    }
}

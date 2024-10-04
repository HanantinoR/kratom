<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\AuthHelper;
use App\DataTables\LSDataTable;
use App\Models\PpbeGoodsModel;
use App\Models\PPBEModel;
use App\Models\HplpsModel;
use App\Models\HplpsGoodsModel;
use App\Models\HplpsMemorizationsModel;
use App\Models\LsModel;
use App\Models\LsGoodsModel;
use App\Models\LsMemorizationsModel;
use App\Models\BcopsUsageModel;
use DB;

class LsController extends Controller
{
    public function index(LSDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('ls.title')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table','ls_list'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add UserS</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets'));
    }

    public function save(Request $request)
    {
        DB::beginTransaction();
        $auth_user = AuthHelper::authSession();
        $hplps = HplpsModel::with('ppbe','ppbe.goods','memory','goods','usage')->findOrFail($request->hplps_id);

        try{
            // get office_code_id  $office_code
            $no_ls = $this->generateCodeAbove($hplps); //seharusnya pake office_code
            $code_letter = $this->generateCodeBelow($hplps); //seharusnya pake office_code
            DB::commit();
            return redirect()->route('ls.index')->with('success', 'Pengajuan berhasil Dirubah.');
        } catch(\Exception $e) {
            DB::Rollback();
        }

    }

    public function generateCodeAbove($hplps)
    {

    }

    public function generateCodeBelow()
    {

    }
}

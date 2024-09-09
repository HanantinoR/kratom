<?php

namespace App\Http\Controllers;

use App\Models\Inatrade;
use Illuminate\Http\Request;
use App\Helpers\AuthHelper;
use App\DataTables\InatradeDataTable;


class InatradeController extends Controller
{
    public function daftar(InatradeDatatable $dataTable){
        $pageTitle = trans('global-message.list_form_title',['form' => trans('inatrade.title')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table','inatrade_list'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add UserS</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets'));
    }

    public function edit(){
        return view('inatrade.edit');
    }

    public function store(Request $request){

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\BcopsDataTable;
use App\Helpers\AuthHelper;

class BcopsController extends Controller
{
    public function daftar(BcopsDataTable $dataTable){
        $pageTitle = trans('global-message.list_form_title',['form' => trans('bcops.title')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table','bcops_list'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add UserS</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets'));
    }

    public function tambah(Request $request){
        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\AuthHelper;
use App\DataTables\LSDataTable;

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
}

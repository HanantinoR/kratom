<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\AuthHelper;
use App\DataTables\PenugasanDataTable;

class PenugasanController extends Controller
{
    public function index(PenugasanDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('penugasan.title')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table','penugasan_list'];
        $headerAction = '<a href="" class="btn btn-sm btn-primary me-2" role="button">Print Penugasan</a><a class="btn btn-sm btn-warning me-2" role="button">Print Surat Tugas</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets','headerAction'));
    }
}

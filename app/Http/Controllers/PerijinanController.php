<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\PerijinanDataTable;
use Spatie\Permission\Models\Role;

class PerijinanController extends Controller
{
    public function daftar(PerijinanDataTable $dataTable){
        $pageTitle = trans('global-message.list_form_title',['form' => trans('perijinan.title')] );
        $assets = ['data-table'];
        $headerAction = '<a href="#" class="btn btn-sm btn-primary" role="button">Add Perijinan</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','assets', 'headerAction'));
    }

    public function tambah(){
        $roles = Role::where('status',1)->get()->pluck('title', 'id');

        return view('perijinan.tambah', compact('roles'));
    }

    public function store(Request $request){
        
    }
}

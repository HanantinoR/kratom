<?php

namespace App\Http\Controllers;

use App\Models\Inatrade;
use App\Models\LsModel;
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

    public function edit($id){

        $ls = LsModel::with('ppbe','hplps','ppbe.company','goods','memorys','goods.hs')
                    ->leftjoin("mloading_ports as port_1", "ls.origin_port_id","=","port_1.id")
                    ->leftjoin("mloading_ports as port_2", "ls.loading_port_id","=","port_2.id")
                    ->leftjoin("mdestination_ports","mdestination_ports.id","=","ls.destination_port_id")
                    ->leftjoin("mcountries as country_1","ls.country_id","=","country_1.id")
                    ->leftjoin("mcurrencies","mcurrencies.id","=","ls.fob_currency")
                    // ->leftjoin('moffices','moffices.id','=','ls.inspection_office_id')
                    ->select('ls.*','port_1.code as origin_port','port_2.code as loading_port','mdestination_ports.code as destination_port',
                    'country_1.code as country_code','mcurrencies.code as currency_code')
        ->findOrFail($id);
        // dd($ls);
        $assets = ['data-table','inatrade_list'];
        return view('inatrade.edit',compact('ls','assets'));
    }

    public function store(Request $request){

    }
}

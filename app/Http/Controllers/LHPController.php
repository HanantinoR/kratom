<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LHPModel;
use App\Models\LHPGoodsModel;
use App\Models\LHPMemorizationsModel;
use App\Helpers\AuthHelper;
use App\DataTables\LHPDataTable;
use DB;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class LHPController extends Controller
{
    public function index(LHPDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('lhp.title')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table','lhp_list','ppbe_search','company_search','lhp_search'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add UserS</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets'));
    }

    public function export_pdf($code_above_lhp, Request $request){
        $auth_user = AuthHelper::authSession();
        // dd($auth_user);
        $lhp = LHPModel::with(['goods','memorys','goods.hs'])
        ->join('mdestination_ports',"lhp.destination_port_id","=","mdestination_ports.id")
        ->join('mloading_ports',"lhp.loading_port_id","=","mloading_ports.id")
        ->join('mcountries','lhp.country_id',"=","mcountries.id")
        ->join('moffices','lhp.inspection_office_id','=','moffices.id')
        ->select("lhp.*","mdestination_ports.code as code_pelabuhan_tujuan","mdestination_ports.name as nama_pelabuhan_tujuan",
        "mloading_ports.code as code_pelabuhan_muat","mloading_ports.name as nama_pelabuhan_muat", "mcountries.name as nama_negara",
        "moffices.name as kantor_cabang")
        ->where('code_above_lhp',$code_above_lhp)->first();

        // $lhp->update(['status'=> 'print_ls']);

        // $qr_code = $this->generateQRCode($lhp, $request);
        $data =[
            'title' => 'LAPORAN HASIL PEMERIKSAAN',
            'content' =>'coba',
            'lhp' => $lhp,
            'user' => $auth_user,
            // 'qr_code' => $qr_code
        ];
        $documentPDF = View::make('lhp.pdf',['data'=>$data])->render();
        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($documentPDF);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        return $dompdf->stream('ls.pdf',['Attachment'=>false]);
    }
}

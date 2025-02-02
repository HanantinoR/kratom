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
use App\Models\KantorCabang;
use App\Models\PelabuhanMuat;
use App\Models\PelabuhanTujuan;
use App\Models\Negara;
use App\Models\HSLevel;
use App\Models\KabupatenKota;
use App\Models\Provinsi;
use App\Models\MataUang;
use App\Models\LsModel;
use App\Models\LsGoodsModel;
use App\Models\LsMemorizationsModel;
use App\Models\BcopsUsageModel;
use App\Models\User;
use DB;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class LsController extends Controller
{
    public function index(LSDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('ls.title')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table','ls_list','ppbe_search','company_search','ls_search'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add UserS</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets'));
    }

    public function save(Request $request)
    {
        DB::beginTransaction();
        $auth_user = AuthHelper::authSession();
        $hplps = HplpsModel::with('ppbe','ppbe.goods','ppbe.company','memory','goods','usage')->findOrFail($request->hplps_id);
        // dd($request);
        // dd($hplps->ppbe->company->npwp);
        try{
            // get office_code_id  $office_code
            $no_ls = $this->generateCodeAbove($hplps); //seharusnya pake office_code
            $code_letter = $this->generateCodeBelow($hplps); //seharusnya pake office_code
            // dd($no_ls,$code_letter);
            $ls = LsModel::create([
                'ppbe_id'=> $hplps->ppbe_id,
                'hplps_id'=> $hplps->id,
                'code'=> $hplps->ppbe->code,
                'code_above'=> $no_ls,
                'code_below'=> $code_letter,
                'code_date'=> $hplps->ppbe->date_ppbe,
                'nib'=> $hplps->ppbe->company->nib,
                'nomor_et'=> $hplps->ppbe->company->nomor_et,
                'date_nib'=> $hplps->ppbe->company->date_nib,
                'date_et'=> $hplps->ppbe->company->date_et,
                'destination_port_id'=> $hplps->ppbe->country_destination_id,
                'loading_port_id'=> $hplps->ppbe->loading_port_id,
                'origin_port_id'=> $hplps->ppbe->origin_port_id,
                'country_id'=> $hplps->ppbe->country_id,
                'company_name'=> $hplps->ppbe->company->name,
                'company_address'=> $hplps->ppbe->company->company_address,
                'company_npwp'=> $hplps->ppbe->company->npwp,
                'inspection_office_id'=> $hplps->ppbe->inspection_office_id,
                'inspection_date'=> $hplps->inspection_date_start,
                'inspection_address'=> $hplps->inpsection_address,
                'fob_total'=> $hplps->fob_total_hpl,
                'fob_currency'=> $hplps->fob_currency_hpl,
                'invoice_number'=> $hplps->ppbe->invoice_number,
                'invoice_date'=> $hplps->ppbe->invoice_date,
                'packing_list_number'=> $hplps->ppbe->packing_list_number,
                'packing_list_date'=> $hplps->ppbe->packing_list_date,
                'buyer_name'=> $hplps->ppbe->buyer_name,
                'buyer_address'=> $hplps->ppbe->buyer_address,
                'merk'=> $hplps->ppbe->merk,
                'hpl_notes'=> $hplps->hpl_notes,
                'packing_total'=> $hplps->ppbe->packing_total,
                'packing_type'=> $hplps->ppbe->packing_type,
                'signer_ls_id'=> $auth_user->id,
                // 'is_canceled'=> "0",
                // 'canceled_reason'=> ,
                // 'file_cancel'=> $hplps,
                // 'is_perubahan'=> $hplps,
                'mexamination_conclusions_id'=> 1,
                'status'=> "verify_ls",
                // 'notes'=> $request->hplps_reason,
            ]);

            foreach ($hplps->goods as $index => $value) {
                $good = LsGoodsModel::create([
                    'ls_id'=> $ls->id,
                    'processed_level_id'=> $value['processed_level_id'],
                    'description'=> $value['description'],
                    'quantity_kg'=> $value['quantity_kg'],
                    'fob_value'=> $value['fob_value'],
                ]);
            }

            foreach ($hplps->memory as $index => $value) {
                $memory = LsMemorizationsModel::create([
                    'ls_id' => $ls->id ,
                    'type' =>$value['type'] ,
                    'create_number' =>$value['create_number'] ,
                    'create_type' =>$value['create_type'] ,
                    'size' =>$value['size'] ,
                    'series' =>isset($value['series']) ? $value['series']:null  ,
                    'series_init' =>isset($value['series_init']) ? $value['series_init']:null,
                    'series_total' =>$value['series_total'] ,
                    'series_type' =>$value['series_type'] ,
                    'tps_merah' =>$value['tps_merah'] ,
                    'tps_hijau' =>$value['tps_hijau'] ,
                    'thread_seal' =>$value['thread_seal'] ,
                ]);
            }

            $data_update = [
                "status" => "verified_signed_ls"
            ];

            $hplps->update($data_update);
            DB::commit();
            return redirect()->route('ls.daftar')->with('success', 'LS berhasil Di verifikasi.');
        } catch(\Exception $e) {
            DB::rollback();
            // dd($e);
            // return redirect()->route('ls.daftar')->with('error', 'Terdapat kesalahan pada input.');
        }

    }

    public function show($id){
        $assets = ['ls_list'];
        $ls = LsModel::findOrFail($id);
        $hs_levels = HSLevel::get();
        // $data_company = PerijinanModel::get();
        $office_branch = KantorCabang::get();
        $provinces = Provinsi::get();
        $destination_port = PelabuhanTujuan::get();
        $loading_port = PelabuhanMuat::get();
        $cities = KabupatenKota::get();
        $countries = Negara::get();
        $currencies = MataUang::get();
        return view('ls.detail',compact('assets','ls','hs_levels','cities', 'countries', 'office_branch', 'provinces', 'destination_port', 'loading_port', 'currencies'));
    }

    public function generateCodeBelow($hplps)
    {
        $yearSubs = substr(date('Y'), 2);
        $office_id = $hplps->ppbe->inspection_office_id;
        $office = KantorCabang::where('id', $office_id)->first();
        $code = str_pad($office->code, 2, '0', STR_PAD_LEFT) . '.' . str_pad($office->code, 2, '0', STR_PAD_LEFT) . '.' . str_pad($office->code, 2, '0', STR_PAD_LEFT) . '.' . str_pad($office->code, 2, '0', STR_PAD_LEFT) . ' A1 ' . $yearSubs . date('m') . date('d') . date('H') . date('i') . date('s');
        // $code = '23.23.23.23 A1 ' . $yearSubs . date('m') . date('d') . date('H') . date('i') . date('s');

        return $code;
    }

    public function generateCodeAbove($hplps)
    {
        // dd($hplps->ppbe->inspection_office_id);
        $yearSubs = substr(date('Y'), 2);
        $office_id = $hplps->ppbe->inspection_office_id;
        $office = KantorCabang::where('id', $office_id)->first();
        // dd($office);
        $last_ls = LsModel::whereNotNull('code_above')->orderBy('code_above', 'desc')->first();
        // $getNumberByOfficeId = $this->Master_number_LS->get_by_office_id($officeId, 1);


        if (!$last_ls) $startNumber = 1;
        else {
            $arrYear = explode('.', $last_ls->code_above);
            $yearLS = $arrYear[2];
            if($yearSubs == $yearLS)
            {
            $arrCode = explode('.', $last_ls->code_above);
            $sequenceNo =  $arrCode[3];
            $startNumber = intval($sequenceNo) + 1;
            } else {
                $startNumber = 1;
            }
        }

        // if (!empty($getNumberByOfficeId) && intval($getNumberByOfficeId->lock_status) === 1) {
        //     if ($startNumber < intval($getNumberByOfficeId->start_number)) {
        //         $startNumber = intval($getNumberByOfficeId->start_number);
        //     }
        // }
        $code = $office->code . '.' . '1' . '.' . $yearSubs . '.' . str_pad($startNumber, 5, '0', STR_PAD_LEFT)."-K"    ;
        // $code = '23.' . '1' . '.' . $yearSubs . '.' . str_pad($startNumber, 5, '0', STR_PAD_LEFT);;

        return $code;
    }

    public function export_pdf($code_above, Request $request){
        $auth_user = AuthHelper::authSession();
        $ls = LsModel::with(['goods','memorys','goods.hs'])
        ->join('mdestination_ports',"ls.destination_port_id","=","mdestination_ports.id")
        ->join('mloading_ports',"ls.loading_port_id","=","mloading_ports.id")
        ->join('mcountries','ls.country_id',"=","mcountries.id")
        ->join('moffices','ls.inspection_office_id','=','moffices.id')
        ->select("ls.*","mdestination_ports.code as code_pelabuhan_tujuan","mdestination_ports.name as nama_pelabuhan_tujuan",
        "mloading_ports.code as code_pelabuhan_muat","mloading_ports.name as nama_pelabuhan_muat", "mcountries.name as nama_negara",
        "moffices.name as kantor_cabang")
        ->where('code_above',$code_above)->first();

        $koordinator = User::where('branch_office',$ls->inspection_office_id)->where('user_type','koordinator_cabang')->first();

        $ls->update(['status'=> 'print_ls']);

        $qr_code = $this->generateQRCode($ls, $request);
        // dd($qr_code);
        $data =[
            'title' => 'LAPORAN SURVEYOR',
            'content' =>'coba',
            'ls' => $ls,
            'user' => $auth_user,
            'qr_code' => $qr_code,
            'koordinator' => $koordinator
        ];
        $documentPDF = View::make('ls.pdf',['data'=>$data])->render();
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


    public function generateQRCode($ls, $request){
        $link = $request->url();
        // return $serverName;
        // dd($ls);
         $postfield = '{
            "doc_header" : {
                "Nomor Sertifikat": "'.$ls->code_above.'",
                "Nomor Order": "'.$ls->code.'",
                "Perihal" :"Laporan Surveyor Verifikasi Ekspor Produk Kratom",
                "Tanggal TTD": "'.$ls->created_at.'",
                "Penandatangan": "Admin"
            },
            "use_passcode" : "0",
            "doc_type" : "kratom",
            "link_doc": "'.$link.'",
            "is_view": "1"
        }';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apidev.sucofindo.co.id/verdoc2/generator/generateQR_v2',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postfield,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '. base64_encode("Kratom:Sucofindo25"),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $result = json_decode($response);
        // dd($result);
        return $result->data->qr;
    }
}

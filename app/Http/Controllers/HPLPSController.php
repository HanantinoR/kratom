<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\AuthHelper;
use App\DataTables\HPLPSDataTable;
use App\Models\PerijinanModel;
use App\Models\PpbeGoodsModel;
use App\Models\PPBEModel;
use App\Models\HplpsModel;
use App\Models\HplpsGoodsModel;
use App\Models\HplpsMemorizationsModel;
use App\Models\BcopsUsageModel;
use App\Models\PpbeHistoryModel;
use App\Models\HistoryQuotaModel;
use Illuminate\Support\Facades\Validator;


class HPLPSController extends Controller
{
    public function index(HPLPSDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('ppbe.title')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table','hplps_list'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add UserS</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets'));
    }

    public function edit($id)
    {
        $assets = ['hplps','file'];
        $data = PPBEModel::with('goods','ppbe_history','company','assignments')->findOrFail($id);
        $data_company = PerijinanModel::where('id',$data->company_id)->get();
        $history_quota = HistoryQuotaModel::where('id',$data->company_id)->orderBy('created_at','desc')->first();
        // dd($ppbe);
        return view('hplps.edit',compact('assets','data','data_company','id','history_quota'));
    }

    public function save(Request $request)
    {


        // dd($request, $checker_list);
        $auth_user = AuthHelper::authSession();
        $validate = Validator::make($request->all(),[
            'barang.*.nomor_hs' => "required",
            'barang.*.uraian' => "required",
            'barang.*.jumlah_total' => "required",
            'barang.*.nilai_fob' => "required",
            "origin_port_id" => "required",
            "loading_port_id" => "required",
            "destination_port_id" => "required",
            "country_destination_id" => "required",
            "packing_list_number" => "required",
            "packing_list_date" => "required",
            "invoice_number" => "required",
            "invoice_date" => "required",
            "buyer_name" => "required",
            "buyer_address" => "required",
            "country_id" => "required",
            "merk" => "required",
            "packing_total" => "required",
            "packing_type" => "required",
            "inspection_date_start" => "required",
            "inspection_date_end" => "required",
            "inspection_office_id" => "required",
            "inspection_address" => "required",
            "inspection_province_id" => "required",
            "inspection_city_id" => "required",
            "fob_total_hpl" => "required",
            "fob_currency_hpl" => "required",
            "memorize_type" => "required",
            "memorize_size" => "required",
            "memorize_total" => "required",
            "memorize_skenario" => "required",
            "usage.*.type" => "required",
            "usage.*.series" => "required",
            "usage.*.init" => "required",
            "usage.*.final" => "required",
            "hpl_notes" => "required",
            "stuffing_date_start" => "required",
            "stuffing_date_end" => "required",
            "stuffing_office_id" => "required",
            "stuffing_address" => "required",
            "memorizations.*.type.*" => "required",
            "memorizations.*.create_number.*" => "required",
            "memorizations.*.create_type.*" => "required",
            "memorizations.*.size.*" => "required",
            // "memorizations.*.seires_total.*" => "required",
        ]);

        if($validate->fails())
        {
            // dd($validate->errors());
            return redirect()->route('hplps.edit',$request->ppbe_id)
                ->withErrors($validate)
                ->withInput();
        }

        $checker_list = json_encode([
            'merk_checked' => $request->check_merk,
            'check_packing'=> $request->check_packing,
            'check_inspection' => $request->check_inspection
        ]);

        $data_update = [
            "origin_port_id" => $request->origin_port_id,
            "loading_port_id" => $request->loading_port_id,
            "destination_port_id" => $request->destination_port_id,
            "country_destination_id" => $request->country_destination_id,
            "packing_list_number" => $request->packing_list_number,
            "packing_list_date" => $request->packing_list_date,
            "invoice_number" => $request->invoice_number,
            "invoice_date" => $request->invoice_date,
            "buyer_name" => $request->buyer_name,
            "buyer_address" => $request->buyer_address,
            "country_id" => $request->country_id,
            "merk" => $request->merk,
            "packing_total" => $request->packing_total,
            "packing_type" => $request->packing_type,
        ];

        try {
            PPBEModel::where('id',$request->ppbe_id)->update($data_update);
            $hplps = HplpsModel::create([
                'ppbe_id'=> $request->ppbe_id ,
                'surveyor_id'=> $request->npp,
                'inspection_date_start'=> $request->inspection_date_start ,
                'inspection_date_end'=> $request->inspection_date_end ,
                'hpl_notes'=> $request->hpl_notes,
                'stuffing_date_start'=> $request->stuffing_date_start ,
                'stuffing_date_end'=> $request->stuffing_date_end ,
                // 'analysis_result'=> $request-> ,
                // 'checker_list'=> $request-> ,
                'status'=> "hpl_submitted" ,
                'packaging_total'=> $request->packing_total,
                'packaging_unit'=> $request->packing_type,
                'inpsection_address'=> $request->inspection_address,
                'fob_total_hpl'=> $request->fob_total_hpl,
                'fob_currency_hpl'=> $request->fob_currency_hpl,
                'request_id'=> $auth_user->id,
                // 'verify_id'=> $request-> ,
            ]);

            if(!empty($request->barang)) {
                $hplps_goods = HplpsGoodsModel::where('hplps_id',$hplps->id)->delete();
                foreach($request->barang as $value){
                    $hplps_goods = HplpsGoodsModel::create([
                        'hplps_id'=> $hplps->id,
                        'processed_level_id'=> $value['nomor_hs'],
                        'description'=> $value['uraian'],
                        'quantity_kg'=> $value['jumlah_total'],
                        'fob_value'=> $value['nilai_fob'],
                    ]);
                }
            }

            if(!empty($request->memorizations)){
                $memorizations = HplpsMemorizationsModel::where('hplps_id',$hplps->id)->delete();
                foreach ($request->memorizations as $value) {
                    // dd($value['series_total'], $request->memorizations);
                    $memorizations = HplpsMemorizationsModel::create([
                        'hplps_id'=> $hplps->id,
                        'type'=> $value['type'],
                        'create_number'=> $value['create_number'],
                        'create_type'=> $value['create_type'],
                        'size'=> $value['size'],
                        'series'=> isset($value['series']) ? $value['series']:null,
                        'series_init'=> isset($value['series_init']) ? $value['series_init']:null,
                        'series_total'=> $value['series_total'],
                        'series_type'=> $value['series_type'],
                        // 'tm_series'
                        // 'tm_init'
                        // 'tm_final'
                        // 'th_series'
                        // 'th_init'
                        // 'th_final'
                        // 'ts_series'
                        // 'ts_init'
                        // 'ts_final'
                    ]);
                }
            }

            if(!empty($request->usage)){
                $bcops_usage = BcopsUsageModel::where('hplps_id',$hplps->id)->delete();
                foreach ($request->usage as $value) {
                    $bcops_usage = BcopsUsageModel::create([
                        'hplps_id' => $hplps->id,
                        'type' => $value['type'],
                        'series' => $value['series'],
                        'series_init' => $value['init'],
                        'series_final' => $value['final'],
                    ]);
                }
            }

            return redirect()->route('ppbe.index')->with('success', 'Pengajuan berhasil Kirim.');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function uploadFile(Request $request)
    {
     // Validate the request
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        // Handle the file upload
        if ($request->file('file')) {
            $path = $request->file('file')->store('ppbe_file', 'local');
            // $file1->storeAs($path, $file1Name, 'local');
            return response()->json(['success' => 'File uploaded successfully', 'path' => $path]);
        }

        return response()->json(['error' => 'File upload failed'], 422);
    }
}

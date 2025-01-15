<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\AuthHelper;
use App\DataTables\HPLPSDataTable;
use App\Models\PerijinanModel;
use App\Models\PpbeGoodsModel;
use App\Models\PPBEModel;
use App\Models\User;
use App\Models\HplpsModel;
use App\Models\HplpsGoodsModel;
use App\Models\HplpsMemorizationsModel;
use App\Models\LHPModel;
use App\Models\LHPGoodsModel;
use App\Models\LHPMemorizationsModel;
use App\Models\BcopsUsageModel;
use App\Models\PpbeHistoryModel;
use App\Models\HistoryQuotaModel;
use App\Models\KantorCabang;
use App\Models\PelabuhanMuat;
use App\Models\PelabuhanTujuan;
use App\Models\Negara;
use App\Models\HSLevel;
use App\Models\KabupatenKota;
use App\Models\Provinsi;
use App\Models\MataUang;
use App\Models\RequestBookingModel;
use App\Models\AnalysisLabModel;
use Illuminate\Support\Facades\Validator;
use DB;


class HPLPSController extends Controller
{
    public function index(HPLPSDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('ppbe.title')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table','hplps_list','ppbe_search','company_search'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add UserS</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets'));
    }

    public function show($state,$id)
    {
        // dd($state,$id);
        $assets = ['hplps','file','ls_verify'];
        // dd('a');
        if($state === "verified" ){
            $hpl = HPLPSModel::findOrFail($id);
            // dd($hpl->ppbe_id);
            $data = PPBEModel::with('goods','ppbe_history','company','assignments','hplps','hplps.goods','hplps.memory','hplps.usage')
                ->where('id',$hpl->ppbe_id)
                ->first();
        } else {
            $data = PPBEModel::with('goods','ppbe_history','company','assignments','hplps','hplps.goods','hplps.memory','hplps.usage')->findOrFail($id);
        }

        $data_company = PerijinanModel::where('id',$data->company_id)->get();
        $hs_levels = HSLevel::get();
        $surveyor = User::where('id',$data->assignments->surveyor_id)->first();
        $office_branch = KantorCabang::get();
        $provinces = Provinsi::get();
        $destination_port = PelabuhanTujuan::get();
        $loading_port = PelabuhanMuat::get();
        $cities = KabupatenKota::get();
        $countries = Negara::get();
        $currencies = MataUang::get();
        // $history_quota = HistoryQuotaModel::where('id',$data->company_id)->orderBy('created_at','desc')->first();

        return view('hplps.detail',compact('assets','data','data_company','id','hs_levels','surveyor','state','office_branch','provinces','destination_port','loading_port','cities','countries','currencies'));
    }

    public function edit($id)
    {
        $assets = ['hplps','hplps_edit','file'];
        $data = PPBEModel::with('goods','ppbe_history','company','assignments','hplps','hplps.goods','hplps.memory','hplps.usage')->findOrFail($id);
        $data_company = PerijinanModel::where('id',$data->company_id)->get();
        $hs_levels = HSLevel::get();
        // $history_quota = HistoryQuotaModel::where('id',$data->company_id)->orderBy('created_at','desc')->first();
        $office_branch = KantorCabang::get();
        $provinces = Provinsi::get();
        $destination_port = PelabuhanTujuan::get();
        $loading_port = PelabuhanMuat::get();
        $cities = KabupatenKota::get();
        $countries = Negara::get();
        $currencies = MataUang::get();
        $surveyor = User::where('id',$data->assignments->surveyor_id)->first();
        // dd($surveyor);
        return view('hplps.edit',compact('assets','data','data_company','id', 'hs_levels','cities', 'countries', 'office_branch', 'provinces', 'destination_port', 'loading_port', 'currencies','surveyor'));
    }

    public function save(Request $request)
    {
        // 172.16.100.219
        // dd($request);

        $data_hplps = HplpsModel::where('ppbe_id',$request->ppbe_id)->count();
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
            'files_doc_hpl.*' => 'mimes:jpg,jpeg,png,pdf|max:5120',
            'files_foto_pemeriksaan.*' => 'mimes:jpg,jpeg,png,pdf|max:5120',
            'files_foto_pengawasan.*' => 'mimes:jpg,jpeg,png,pdf|max:10240',
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

            if($data_hplps === 0) {
                $status = "";
            } else {
                $status = "hpl_submitted";
            }

            PPBEModel::where('id',$request->ppbe_id)->update($data_update);
            $path = 'hplps_file';
            $file_name_hpl =[];
            $file_name_pemeriksaan =[];
            $file_name_pengawasan =[];

            if($request->hasFile('files_doc_hpl'))
            {
                $file_hpl = $request->file('files_doc_hpl');
                foreach ($file_hpl as $key => $hpl) {
                    // dd($hpl->getClientOriginalName());
                    $file1Name = time() . '_file_doc_hpl_'. $key+1 . '-' . $hpl->getClientOriginalName();
                    $file1Path = $hpl->storeAs($path, $file1Name, 'local');

                    $file_name_hpl[] = $file1Name;
                }
            }
            if($request->hasFile('files_foto_pemeriksaan'))
            {
                $file_pemeriksaan = $request->file('files_foto_pemeriksaan');
                foreach ($file_pemeriksaan as $key => $pemeriksaan) {
                    // dd($hpl->getClientOriginalName());
                    $file1Name = time() . '_file_foto_pemeriksaan_' . $key+1 . '-' . $pemeriksaan->getClientOriginalName();
                    $file1Path = $pemeriksaan->storeAs($path, $file1Name, 'local');

                    $file_name_pemeriksaan[] = $file1Name;
                }
            }

            if($request->hasFile('files_foto_pengawasan'))
            {
                $file_pengawasan = $request->file('files_foto_pengawasan');
                foreach ($file_pengawasan as $key => $pengawasan) {
                    // dd($hpl->getClientOriginalName());
                    $file1Name = time() . '_file_foto_pengawasan_'. $key+1 . '-' . $pengawasan->getClientOriginalName();
                    $file1Path = $pengawasan->storeAs($path, $file1Name, 'local');

                    $file_name_pengawasan[] = $file1Name;
                }
            }
            $hplps =  HplpsModel::updateOrCreate(
                ['ppbe_id'=> $request->ppbe_id],
                ['surveyor_id'=> $request->npp,
                'inspection_date_start'=> $request->inspection_date_start ,
                'inspection_date_end'=> $request->inspection_date_end ,
                'hpl_notes'=> $request->hpl_notes,
                'stuffing_date_start'=> $request->stuffing_date_start ,
                'stuffing_date_end'=> $request->stuffing_date_end ,
                // 'analysis_result'=> $request-> ,
                'checker_list'=> $checker_list ,
                'status'=> $status,
                'packaging_total'=> $request->packing_total,
                'packaging_unit'=> $request->packing_type,
                'inpsection_address'=> $request->inspection_address,
                'fob_total_hpl'=> $request->fob_total_hpl,
                'fob_currency_hpl'=> $request->fob_currency_hpl,
                'request_id'=> $auth_user->id,
                'files_doc_hpl' => json_encode($file_name_hpl),
                'files_foto_pemeriksaan' => json_encode($file_name_pemeriksaan),
                'files_foto_pengawasan' => json_encode($file_name_pengawasan)
                ]
            );
            // $hplps = HplpsModel::create([
            //     'ppbe_id'=> $request->ppbe_id ,
                // 'surveyor_id'=> $request->npp,
                // 'inspection_date_start'=> $request->inspection_date_start ,
                // 'inspection_date_end'=> $request->inspection_date_end ,
                // 'hpl_notes'=> $request->hpl_notes,
                // 'stuffing_date_start'=> $request->stuffing_date_start ,
                // 'stuffing_date_end'=> $request->stuffing_date_end ,
                // // 'analysis_result'=> $request-> ,
                // 'checker_list'=> $checker_list ,
                // 'status'=> "hpl_submitted" ,
                // 'packaging_total'=> $request->packing_total,
                // 'packaging_unit'=> $request->packing_type,
                // 'inpsection_address'=> $request->inspection_address,
                // 'fob_total_hpl'=> $request->fob_total_hpl,
                // 'fob_currency_hpl'=> $request->fob_currency_hpl,
                // 'request_id'=> $auth_user->id,
            //     // 'verify_id'=> $request-> ,
            // ]);

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
            $merah = "";
            $hijau = "";
            $seal = "";
            $lock = "";

            if(!empty($request->memorizations)){
                $memorizations = HplpsMemorizationsModel::where('hplps_id',$hplps->id)->delete();
                foreach ($request->memorizations as $memorization) {
                    if(isset($memorization['red_series'])){
                        foreach ($memorization['red_series'] as $key => $value) {
                            $tps_merah[] = [
                                'series' => $value,
                                'red_init' => $memorization['red_init'][$key],
                                'red_final' => $memorization['red_final'][$key]
                            ];

                            $tps_hijau[] = [
                                'series' => $memorization['green_series'][$key],
                                'green_init' => $memorization['green_init'][$key],
                                'green_final' => $memorization['green_init'][$key]
                            ];

                            $lock_seal[] = [
                                'series' => $memorization['lock_seal_series'][$key],
                                'lock_seal_init' => $memorization['lock_seal_init'][$key],
                                'lock_seal_final' => $memorization['lock_seal_init'][$key]
                            ];

                            $thread_seal[] = [
                                'series' => $memorization['thread_seal_series'][$key],
                                'thread_seal_init' => $memorization['thread_seal_init'][$key],
                                'thread_seal_final' => $memorization['thread_seal_init'][$key]
                            ];

                            $merah = json_encode($tps_merah);
                            $hijau = json_encode($tps_hijau);
                            $lock = json_encode($lock_seal);
                            $seal = json_encode($thread_seal);


                        }
                    }
                    $memorizations = HplpsMemorizationsModel::create([
                        'hplps_id'=> $hplps->id,
                        'type'=> $memorization['type'],
                        'create_number'=> $memorization['create_number'],
                        'create_type'=> $memorization['create_type'],
                        'size'=> $memorization['size'],
                        'series'=> isset($memorization['series']) ? $memorization['series']:null,
                        'series_init'=> isset($memorization['series_init']) ? $memorization['series_init']:null,
                        'series_total'=> $memorization['series_total'],
                        'series_type'=> $memorization['series_type'],
                        'tps_merah' => $merah,
                        'tps_hijau' => $hijau,
                        'lock_seal' => $lock,
                        'thread_seal' => $seal
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

            return redirect()->route('hplps.daftar')->with('success', 'Pengajuan berhasil Kirim.');
        } catch (\Exception $e) {
            dd($e);
            DB::Rollback();
        }
    }

    public function verify($id)
    {
        // dd('a');
        $assets = ['hplps','hplps_verify','file'];
        $data = PPBEModel::with('goods','ppbe_history','company','assignments','hplps','hplps.goods','hplps.memory','hplps.usage')->findOrFail($id);
        $data_company = PerijinanModel::where('id',$data->company_id)->get();
        // $history_quota = HistoryQuotaModel::where('id',$data->company_id)->orderBy('created_at','desc')->first();
        $hs_levels = HSLevel::get();
        $office_branch = KantorCabang::get();
        $provinces = Provinsi::get();
        $destination_port = PelabuhanTujuan::get();
        $loading_port = PelabuhanMuat::get();
        $cities = KabupatenKota::get();
        $countries = Negara::get();
        $currencies = MataUang::get();
        $surveyor = User::where('id',$data->assignments->surveyor_id)->first();

        return view('hplps.verify',compact('assets','data','data_company','id','hs_levels','cities', 'countries', 'office_branch', 'provinces', 'destination_port', 'loading_port', 'currencies','surveyor'));
    }

    public function update(Request $request,$id)
    {
        $auth_user = AuthHelper::authSession();
        $hplps = HplpsModel::where('ppbe_id',$request->ppbe_id)->first();
        // dd($hplps);
        $path = 'hplps_verify_file';

        try {
            $data_update = [
                'hpl_feedback_reason' => $request->hplps_reason,
                'verify_id' => $auth_user->id
            ];

            if($request->hpl_new_status == "1")
            {
                $status = "verified";
                $data_update['status'] = $status;
            } else {
                $status = "reject";
                $data_update['status'] = $status;
                $data_hplps = HplpsModel::with('ppbe','ppbe.goods','ppbe.company','memory','goods','usage')->findOrFail($hplps->id);

                $no_lhp = $this->generateCodeAbove($data_hplps);
                // dd($no_lhp);
                $code_letter = $this->generateCodeBelow($data_hplps);
                $lhp = LHPModel::create([
                    'ppbe_id'=> $data_hplps->ppbe_id,
                    'hplps_id'=> $data_hplps->id,
                    'code'=> $data_hplps->ppbe->code,
                    'code_above_lhp'=> $no_lhp,
                    'code_below_lhp'=> $code_letter,
                    'code_date'=> $data_hplps->ppbe->date_ppbe,
                    'nib'=> $data_hplps->ppbe->company->nib,
                    'nomor_et'=> $data_hplps->ppbe->company->nomor_et,
                    'date_nib'=> $data_hplps->ppbe->company->date_nib,
                    'date_et'=> $data_hplps->ppbe->company->date_et,
                    'destination_port_id'=> $data_hplps->ppbe->country_destination_id,
                    'loading_port_id'=> $data_hplps->ppbe->loading_port_id,
                    'origin_port_id'=> $data_hplps->ppbe->origin_port_id,
                    'country_id'=> $data_hplps->ppbe->country_id,
                    'company_name'=> $data_hplps->ppbe->company->name,
                    'company_address'=> $data_hplps->ppbe->company->company_address,
                    'company_npwp'=> $data_hplps->ppbe->company->npwp,
                    'inspection_office_id'=> $data_hplps->ppbe->inspection_office_id,
                    'inspection_date'=> $data_hplps->inspection_date_start,
                    'inspection_address'=> $data_hplps->inpsection_address,
                    'fob_total'=> $data_hplps->fob_total_hpl,
                    'fob_currency'=> $data_hplps->fob_currency_hpl,
                    'invoice_number'=> $data_hplps->ppbe->invoice_number,
                    'invoice_date'=> $data_hplps->ppbe->invoice_date,
                    'packing_list_number'=> $data_hplps->ppbe->packing_list_number,
                    'packing_list_date'=> $data_hplps->ppbe->packing_list_date,
                    'buyer_name'=> $data_hplps->ppbe->buyer_name,
                    'buyer_address'=> $data_hplps->ppbe->buyer_address,
                    'merk'=> $data_hplps->ppbe->merk,
                    'hpl_notes'=> $data_hplps->hpl_notes,
                    'packing_total'=> $data_hplps->ppbe->packing_total,
                    'packing_type'=> $data_hplps->ppbe->packing_type,
                    'signer_ls_id'=> $auth_user->id,
                    // 'is_canceled'=> "0",
                    // 'canceled_reason'=> ,
                    // 'file_cancel'=> $hplps,
                    // 'is_perubahan'=> $hplps,
                    'mexamination_conclusions_id'=> 1,
                    'status'=> "verify_lhp",
                    // 'notes'=> $request->hplps_reason,
                ]);

                foreach ($hplps->goods as $index => $value) {
                    $good = LHPGoodsModel::create([
                        'lhp_id'=> $lhp->id,
                        'processed_level_id'=> $value['processed_level_id'],
                        'description'=> $value['description'],
                        'quantity_kg'=> $value['quantity_kg'],
                        'fob_value'=> $value['fob_value'],
                    ]);
                }

                foreach ($hplps->memory as $index => $value) {
                    $memory = LHPMemorizationsModel::create([
                        'lhp_id' => $lhp->id ,
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
            }

            if($request->hasFile('hpl_feedback_file'))
            {
                $file1 = $request->file('hpl_feedback_file');
                $file1Name = time() . '_hpl_feedback_file_' . $file1->getClientOriginalName();
                $file1Path = $file1->storeAs($path, $file1Name, 'local');

                $data_update['hplps_feedback_file'] = $file1Name;
            }

            $hplps->update($data_update);

            return redirect()->route('hplps.daftar')->with('success', 'Pengajuan berhasil diverifikasi.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('hplps.daftar')->with('error', $th);
        }
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'files' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        // Handle the file upload
        if ($request->file('files')) {
            $path = $request->file('files')->store('ppbe_file', 'local');
            // $file1->storeAs($path, $file1Name, 'local');
            return response()->json(['success' => 'File uploaded successfully', 'path' => $path]);
        }

        // dd($request->all());
        return response()->json(['error' => 'File upload failed'], 422);
    }

    public function data_request_booking($id)
    {
        // $data_request = DB::table('ppbe')
        //         ->join('ppbe_goods','ppbe_goods.ppbe_id','=','ppbe.id')
        //         ->join('mprocessed_levels','mprocessed_levels.id','=','ppbe_goods.processed_level_id')
        //         ->join('company','company.id','=','ppbe.company_id')
        //         ->join('company_pe','company_pe.id','=','ppbe.company_pe_id')
        //         ->where('ppbe.id',$id)
        //         ->select('ppbe.code','company.nib','company.npwp','company_pe.nomor_pe','company_pe.permit_date','mprocessed_levels.hs','ppbe_goods.quantity_kg')
        //         ->get();

        $data_request = PPBEModel::with([
            'goods' =>function($query){
                $query->select('id','ppbe_id','processed_level_id','quantity_kg');
            },
            'goods.hs' => function($query){
                $query->select('id','hs');
            },
            'company' => function($query){
                $query->select('id','nib','npwp');
            },
            'pe'=>function($query){
                $query->select('id','nomor_pe','permit_date');
            }])
            ->where('id',$id)
            ->select('id','code','company_id','company_pe_id')
            ->first();
        return response()->json([
            'data' => $data_request,
        ],200);
    }

    public function request_alokasi_booking(Request $request)
    {
        $curl = curl_init();
        $auth_user = AuthHelper::authSession();
        $ppbe_id = PPBEModel::where('code',$request->code)->pluck('id')->first();
        $ppbe = $request->code;
        $nib = preg_replace('/[[:space:]\xA0]+/', '',$request->nib);
		$npwp = preg_replace('/[^0-9]/s','', $request->npwp);
        $no_pe = $request->no_pe;
        $date_pe = $request->pe_permit_date;
        $type = $request->req_type;

        if($type == null){

            return response()->json([
                "message" => "Harap Pilih Jenis Permintaan"
            ],400);
        }

        $json_goods = array();
        $no=1;
        foreach ($request->goods['hs'] as $key => $value) {
            $json_isian['seri_izin'] =$no;
            $json_isian['pos_tarif'] = str_replace('.','',$value);
            $json_isian['jml_volume'] = $request->goods['total_hs'][$key];
            $json_isian['jns_satuan'] = $request->goods['satuan_hs'][$key];
		    $json_goods[] = $json_isian;
            $no++;
        }

        $data_json = [
            "header"=> [
                "no_permohonan"=>$ppbe,
                "nib"=> $nib,
                "npwp"=> $npwp,
                "no_izin"=> $no_pe,
                "tgl_izin"=> $date_pe,
                "jns_permintaan"=>"1"
            ],
            "komoditas"=>$json_goods,
            "username"=> "superintending"
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://services.kemendag.go.id/surveyor/v1.0.dev/req_alokasi',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>json_encode($data_json),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'x-Gateway-APIKey: d55c6de7-ee74-4da5-8da8-3ec9cd8f22d8'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response);
        $kode = "A01";

        // if($result->status != "A01")
        if($kode != "A01")
        {
            dd($kode);
            return response()->json([
                'data' => $result->keterangan,
            ],400);

        }

        // dd('a');
        $request = RequestBookingModel::create([
            'ppbe_id' => $ppbe_id,
            'request_result' => $response,
            'request_by'=> $auth_user->id
        ]);

        $ppbe = PPBEModel::where('id',$ppbe_id)->update([
            'is_request' =>$request->id
        ]);

        return response()->json([
            'data' => $result->keterangan,
        ],200);
    }

    public function data_lab (Request $request)
    {
        // 41010124000746
        // dd($request);
        $curl = curl_init();
        $auth_user = AuthHelper::authSession();


        $erp = preg_replace('/[[:space:]\xA0]+/', '',$request->data_erp);

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://apps.sucofindo.co.id/sciapimob/index.php/simlab2/get_order_esertifikat_hasil_iwo',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('no_order' => $erp),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response);

        if($result->code != "200")
        {
            return response()->json([
                'data' => $result->message,
            ],400);
        }

        $lab = AnalysisLabModel::create([
            'ppbe_id' => $request->data_ppbe_id,
            'analysis_result' => $response,
            'request_by'=> $auth_user->id
        ]);

        return response()->json([
            'data' => $result->message,
        ],200);
    }

    public function detail_lab ($id)
    {
        $assets = ['hplps'];
        $data = PPBEModel::join('analysis_lab','analysis_lab.ppbe_id','=','ppbe.id')
                        ->join('company','company.id','=','ppbe.company_id')
                        ->where('ppbe.id',$id)
                        ->first();

        $lab_json = json_decode($data->analysis_result);
        return view('hplps.detail_lab',compact('assets','data','lab_json'));
    }

    public function generateCodeAbove($data_hplps)
    {
        // dd($hplps->ppbe->inspection_office_id);
        $yearSubs = substr(date('Y'), 2);
        $office_id = $data_hplps->ppbe->inspection_office_id;
        $office = KantorCabang::where('id', $office_id)->first();
        // dd($office);
        $last_lhp = LHPModel::whereNotNull('code_above_lhp')->orderBy('code_above_lhp', 'desc')->first();
        // $getNumberByOfficeId = $this->Master_number_LS->get_by_office_id($officeId, 1);


        if (!$last_lhp) $startNumber = 1;
        else {
            $arrYear = explode('.', $last_lhp->code_above_lhp);
            $yearLS = $arrYear[2];
            if($yearSubs == $yearLS)
            {
            $arrCode = explode('.', $last_lhp->code_above_lhp);
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
        $code = $office->code . '.' . '2' . '.' . $yearSubs . '.' . str_pad($startNumber, 5, '0', STR_PAD_LEFT);;
        // $code = '23.' . '1' . '.' . $yearSubs . '.' . str_pad($startNumber, 5, '0', STR_PAD_LEFT);;

        return $code;
    }


    public function generateCodeBelow($data_hplps)
    {
        $yearSubs = substr(date('Y'), 2);
        $office_id = $data_hplps->ppbe->inspection_office_id;
        $office = KantorCabang::where('id', $office_id)->first();
        $code = str_pad($office->code, 2, '0', STR_PAD_LEFT) . '.' . str_pad($office->code, 2, '0', STR_PAD_LEFT) . '.' . str_pad($office->code, 2, '0', STR_PAD_LEFT) . '.' . str_pad($office->code, 2, '0', STR_PAD_LEFT) . ' A1 ' . $yearSubs . date('m') . date('d') . date('H') . date('i') . date('s');
        // $code = '23.23.23.23 A1 ' . $yearSubs . date('m') . date('d') . date('H') . date('i') . date('s');

        return $code;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\AuthHelper;
use Spatie\Permission\Models\Role;
use App\DataTables\PPBEDataTable;
use App\Models\PerijinanModel;
use App\Models\PerijinanPEModel;
use App\Models\PpbeGoodsModel;
use App\Models\PPBEModel;
use App\Models\PpbeHistoryModel;
use App\Models\CompanyModel;
use App\Models\KantorCabang;
use App\Models\PelabuhanMuat;
use App\Models\PelabuhanTujuan;
use App\Models\Negara;
use App\Models\HSLevel;
use App\Models\KabupatenKota;
use App\Models\Provinsi;
use App\Models\MataUang;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PPBEController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PPBEDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('ppbe.title')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table','ppbe_list','ppbe_search','company_search'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add UserS</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth_user = AuthHelper::authSession();
        // dd($auth_user);
        if($auth_user->user_type === "user")
        {
            $data_company = PerijinanModel::with(['pe' => function($query){
                            $query->where('status',"aktif")
                            ->latest('created_at');
                        }])
                        ->where('id',$auth_user->company_id)->first();
            if($data_company->pe->count() == 0)
            {
                return redirect()->route('ppbe.index')->withError(__('ppbe.pe_failed'));
            }
        } else {
            $data_company = PerijinanModel::get();
        }
        $assets = ['ppbe','file'];
        $hs_levels = HSLevel::get();
        $roles = Role::where('status',1)->get()->pluck('title', 'id');
        $office_branch = KantorCabang::get();
        $provinces = Provinsi::get();
        $cities = KabupatenKota::get();
        $destination_port = PelabuhanTujuan::get();
        $loading_port = PelabuhanMuat::get();
        $countries = Negara::get();
        $currencies = MataUang::get();

        return view('ppbe.tambah',compact('roles','assets','hs_levels','data_company', 'cities', 'countries', 'office_branch', 'provinces', 'destination_port', 'loading_port', 'currencies','auth_user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // dd($request);
        $auth_user = AuthHelper::authSession();
        $validate = Validator::make($request->all(),[
            'barang.*.nomor_hs' => "required",
            'barang.*.uraian' => "required",
            'barang.*.jumlah_total' => "required",
            'barang.*.nilai_fob' => "required",
            'barang.*.per_kilogram' => "required",
            'date_ppbe' => "required",
            'company_id' => "required",
            'merk' => "required",
            'packing_total' => "required",
            'packing_type' => "required",
            'fob_total' => "required",
            'fob_currency' => "required",
            'invoice_number' => "required",
            'invoice_date' => "required",
            'packing_list_number' => "required",
            'packing_list_date' => "required",
            'buyer_name' => "required",
            'buyer_address' => "required",
            'country_id' => "required",
            'country_destination_id' => "required",
            'destination_port_id' => "required",
            'loading_port_id' => "required",
            'goods_storage' => "required",
            'inspection_office_id' => "required",
            'inspection_date' => "required",
            'inspection_timezone' => "required",
            'inspection_address' => "required",
            'inspection_province_id' => "required",
            'inspection_city_id' => "required",
            'inspection_pic_name' => "required",
            'inspection_pic_phone' => "required",
            'stuffing_office_id' => "required",
            'stuffing_date' => "required",
            'stuffing_timezone' => "required",
            'stuffing_address' => "required",
            'memorize_type' => "required",
            'memorize_size' => "required",
            'memorize_total' => "required",
            'memorize_skenario' => "required",
            "file_nib"=> "required|file|mimes:jpg,png,pdf|max:2048",
            "file_invoice"=> "required|file|mimes:jpg,png,pdf|max:2048",
            "file_packing_list"=> "required|file|mimes:jpg,png,pdf|max:2048",
        ]);
        // dd($validate);
        if($validate->fails())
        {
            // dd($validate->errors());
            return redirect()->route('ppbe.create')
                ->withErrors($validate)
                ->withInput();
        }

        if($request->save_btn == ""){
            $status = "submitted";
            $status_descript = "Pengajuan PPBE";
        } else {
            $status = "draft";
            $status_descript = "Pengajuan sebagai Draft";
        }

        $path = 'ppbe_file';

        if($request->hasFile('file_nib'))
        {
            $file1 = $request->file('file_nib');
            $file1Name = time() . '_file_nib_' . $file1->getClientOriginalName();
            $file1Path = $file1->storeAs($path, $file1Name, 'local');
        }

        if($request->hasFile('file_invoice'))
        {
            $file2 = $request->file('file_invoice');
            $file2Name = time() . '_file_invoice_' . $file2->getClientOriginalName();
            $file2Path = $file2->storeAs($path, $file2Name, 'local');
        }

        if($request->hasFile('file_packing_list'))
        {
            $file3 = $request->file('file_packing_list');
            $file3Name = time() . '_file_packing_list_' . $file3->getClientOriginalName();
            $file3Path = $file3->storeAs($path, $file3Name, 'local');
        }

        $ppbe = PPBEModel::create([
                    'code' => null,
                    'date_ppbe' => $request->date_ppbe,
                    'company_id' => $request->company_id ,
                    'company_pe_id' => $request->pe_id ,
                    'merk' => $request->merk ,
                    'packing_total'=> $request->packing_total,
                    'packing_type' => $request->packing_type,
                    'fob_total' => $request->fob_total ,
                    'fob_currency' => $request->fob_currency ,
                    'invoice_number' => $request->invoice_number ,
                    'invoice_date' => $request->invoice_date ,
                    'packing_list_number' => $request->packing_list_number ,
                    'packing_list_date' => $request->packing_list_date ,
                    'buyer_name' => $request->buyer_name ,
                    'buyer_address' => $request->buyer_address ,
                    'country_id' => $request->country_id ,
                    'country_destination_id' => $request->country_destination_id ,
                    'destination_port_id' => $request->destination_port_id ,
                    'loading_port_id' => $request->loading_port_id ,
                    'origin_port_id' => $request->origin_port_id ,
                    'goods_storage' => $request->goods_storage ,
                    'inspection_office_id' => $request->inspection_office_id ,
                    'inspection_date' => $request->inspection_date ,
                    'inspection_timezone' => $request->inspection_timezone ,
                    'inspection_address' => $request->inspection_address ,
                    'inspection_province_id' => $request->inspection_province_id ,
                    'inspection_city_id' => $request->inspection_city_id ,
                    'inspection_pic_name' => $request->inspection_pic_name ,
                    'inspection_pic_phone' => $request->inspection_pic_phone ,
                    'stuffing_office_id' => $request->stuffing_office_id ,
                    'stuffing_date' => $request->stuffing_date ,
                    'stuffing_timezone' => $request->stuffing_timezone ,
                    'stuffing_address' => $request->stuffing_address ,
                    'status' => $status,
                    'memorize_type' => $request->memorize_type,
                    'memorize_size' => $request->memorize_size,
                    'memorize_total' => $request->memorize_total,
                    'memorize_skenario' => $request->memorize_skenario,
                    'file_nib' => $file1Name,
                    'file_invoice' => $file2Name,
                    'file_packing_list' => $file3Name,
                    'notes' => $request->other_reason,
                    'created_by' => $auth_user->id
        ]);

        foreach ($request->barang as $value) {
            $ppbe_goods = PpbeGoodsModel::create([
                'ppbe_id'=> $ppbe->id,
                'processed_level_id'=> $value['nomor_hs'],
                'description'=> $value['uraian'],
                'quantity_kg'=> $value['jumlah_total'],
                'fob_value'=> $value['nilai_fob'],
                'per_kilogram'=> $value['per_kilogram'],
            ]);
        }

        $ppbe_history = PpbeHistoryModel::create([
            'ppbe_id'=> $ppbe->id,
            'request_id'=> $auth_user->id,
            // 'approver_id'=> $request->,
            'status'=> $status,
            'status_description'=> $status_descript,
            // 'new_status'=> $request->,
            // 'reason'=> $request->,
        ]);

        return redirect()->route('ppbe.index')->with('success', 'Pengajuan berhasil Kirim.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function verify_ppbe($id)
    {
        // dd($id);
        $assets = ['file','ppbe_verify'];
        $data = PPBEModel::with('goods','ppbe_history','company')->findOrFail($id);
        // $data_company = PerijinanModel::where('id',$data->company_id)->get();
        $hs_levels = HSLevel::get();
        $data_company = PerijinanModel::get();
        $data_pe = PerijinanPEModel::where('status','aktif')->get();
        $office_branch = KantorCabang::get();
        $provinces = Provinsi::get();
        $destination_port = PelabuhanTujuan::get();
        $loading_port = PelabuhanMuat::get();
        $cities = KabupatenKota::get();
        $countries = Negara::get();
        $currencies = MataUang::get();
        // dd($ppbe);
        return view('ppbe.verify',compact('assets','data','data_company','data_pe','hs_levels','id','cities', 'countries', 'office_branch', 'provinces', 'destination_port', 'loading_port', 'currencies'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $assets = ['ppbe','file'];
        $data = PPBEModel::with('goods','ppbe_history','company','company.pe')->findOrFail($id);
        // $data_company = PerijinanModel::where('id',$data->company_id)->get();
        $hs_levels = HSLevel::get();
        $data_company = PerijinanModel::get();
        $data_pe = PerijinanPEModel::where('status','aktif')->get();
        $office_branch = KantorCabang::get();
        $provinces = Provinsi::get();
        $destination_port = PelabuhanTujuan::get();
        $loading_port = PelabuhanMuat::get();
        $cities = KabupatenKota::get();
        $countries = Negara::get();
        $currencies = MataUang::get();
        return view('ppbe.edit',compact('assets','data','data_company','data_pe','id','hs_levels','cities', 'countries', 'office_branch', 'provinces', 'destination_port', 'loading_port', 'currencies'));

        //buat 1 lagi untuk verifikasi

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $auth_user = AuthHelper::authSession();
        $dataPPBE = PPBEModel::with('goods','company')->findOrFail($id);
        $path = 'ppbe_file';

        try{
            //check update Status PPBE
            if(isset($dataPPBE->code) ||$dataPPBE == ""){
                //kalo PPBE sudah ada Nomornya
                $code = $dataPPBE->code;
                $status = $dataPPBE->status;
                $status_descript = "Perubahan Data";
            } else {
                // Check Apakah pengajuan atau draft
                if($request->ppbe_new_status == null || !isset($request->ppbe_new_status))
                {
                    if($request->update_status_value === "submitted") {
                        $status = $request->update_status_value;
                        $status_descript = "Pengajuan Pemeriksaan Barang Eksport";
                        $code = null;
                    } else if($request->update_status_value === "draft") {
                        $status = $request->update_status_value;
                        $status_descript = "Pengajuan sebagai Draft";
                        $code = null ;
                    } else {
                        $status = $dataPPBE->status;
                        $status_descript = "Perubahan Data pada Form Permintaan Pemeriksaan Barang Eksport";
                        $code = null;
                    }

                    $validate = Validator::make($request->all(),[
                        'barang.*.nomor_hs' => "required",
                        'barang.*.uraian' => "required",
                        'barang.*.jumlah_total' => "required",
                        'barang.*.nilai_fob' => "required",
                        'date_ppbe' => "required",
                        'company_id' => "required",
                        'merk' => "required",
                        'packing_total' => "required",
                        'packing_type' => "required",
                        'fob_total' => "required",
                        'fob_currency' => "required",
                        'invoice_number' => "required",
                        'invoice_date' => "required|before:date_ppbe",
                        'packing_list_number' => "required",
                        'packing_list_date' => "required|before:date_ppbe",
                        'buyer_name' => "required",
                        'buyer_address' => "required",
                        'country_id' => "required",
                        'country_destination_id' => "required",
                        'destination_port_id' => "required",
                        'loading_port_id' => "required",
                        'goods_storage' => "required",
                        'inspection_office_id' => "required",
                        'inspection_date' => "required",
                        'inspection_timezone' => "required",
                        'inspection_address' => "required",
                        'inspection_province_id' => "required",
                        'inspection_city_id' => "required",
                        'inspection_pic_name' => "required",
                        'inspection_pic_phone' => "required",
                        'stuffing_office_id' => "required",
                        'stuffing_date' => "required",
                        'stuffing_timezone' => "required",
                        'stuffing_address' => "required",
                        'memorize_type' => "required",
                        'memorize_size' => "required",
                        'memorize_total' => "required",
                        'memorize_skenario' => "required",
                        // "file_nib"=> "required|file|mimes:jpg,png,pdf|max:2048",
                        // "file_invoice"=> "required|file|mimes:jpg,png,pdf|max:2048",
                        // "file_packing_list"=> "required|file|mimes:jpg,png,pdf|max:2048",
                    ]);

                    if($validate->fails())
                    {
                        return redirect()->route('ppbe.edit',$id)
                            ->withErrors($validate)
                            ->withInput();
                    }

                    $data_update = [
                        'code' => $code,
                        'date_ppbe' => $request->date_ppbe,
                        'company_id' => $request->company_id ,
                        'merk' => $request->merk ,
                        'packing_total'=> $request->packing_total,
                        'packing_type' => $request->packing_type,
                        'fob_total' => $request->fob_total ,
                        'fob_currency' => $request->fob_currency ,
                        'invoice_number' => $request->invoice_number ,
                        'invoice_date' => $request->invoice_date ,
                        'packing_list_number' => $request->packing_list_number ,
                        'packing_list_date' => $request->packing_list_date ,
                        'buyer_name' => $request->buyer_name ,
                        'buyer_address' => $request->buyer_address ,
                        'country_id' => $request->country_id ,
                        'country_destination_id' => $request->country_destination_id ,
                        'destination_port_id' => $request->destination_port_id ,
                        'loading_port_id' => $request->loading_port_id ,
                        'goods_storage' => $request->goods_storage ,
                        'inspection_office_id' => $request->inspection_office_id ,
                        'inspection_date' => $request->inspection_date ,
                        'inspection_timezone' => $request->inspection_timezone ,
                        'inspection_address' => $request->inspection_address ,
                        'inspection_province_id' => $request->inspection_province_id ,
                        'inspection_city_id' => $request->inspection_city_id ,
                        'inspection_pic_name' => $request->inspection_pic_name ,
                        'inspection_pic_phone' => $request->inspection_pic_phone ,
                        'stuffing_office_id' => $request->stuffing_office_id ,
                        'stuffing_date' => $request->stuffing_date ,
                        'stuffing_timezone' => $request->stuffing_timezone ,
                        'stuffing_address' => $request->stuffing_address ,
                        'status' => $status,
                        'memorize_type' => $request->memorize_type,
                        'memorize_size' => $request->memorize_size,
                        'memorize_total' => $request->memorize_total,
                        'memorize_skenario' => $request->memorize_skenario,
                        'notes' => $request->other_reason,
                        'updated_by' =>$auth_user->id
                    ];
                }
                //Check untuk Verifikasi
                else if($request->ppbe_new_status === "Disetujui")
                {
                    $status = "approved";
                    $status_descript = "Pengajuan Diverifikasi";
                    $code = $this->generateCode($dataPPBE);

                    $data_update['status'] = $status;
                    $data_update['notes'] = $status_descript;
                    $data_update['code'] = $code;
                    $data_update['checkbox_data'] = $request->checkbox_data;
                    // $data_quota = HistoryQuotaModel::where('company_id',$dataPPBE->company_id)->orderBy("created_at",'desc')->first();
                    $data_goods = $dataPPBE->goods;
                    $quota_used = 0;
                    foreach ($data_goods as $good) {
                        $quota_used += $good['quantity_kg'];
                    }

                    $validate = Validator::make($request->all(),[
                        'ppbe_id' => "required",
                        'checkbox_data' => "required",
                        'ppbe_new_status' => "required",
                    ]);

                    if($validate->fails())
                    {
                        return redirect()->route('ppbe.edit',$id)
                            ->withErrors($validate)
                            ->withInput();
                    }

                }
                //check untuk tolak
                else if($request->ppbe_new_status === "Tolak") {
                    $status = "rejected";
                    $status_descript = "Pengajuan Ditolak";
                    $data_update['status'] = $status;
                }

                if($request->hasFile('file_nib'))
                {
                    $file1 = $request->file('file_nib');
                    $file1Name = time() . '_file_nib_' . $file1->getClientOriginalName();
                    $file1Path = $file1->storeAs($path, $file1Name, 'local');
                    $data_update['file_nib'] = $file1Name;
                }

                if($request->hasFile('file_invoice'))
                {
                    $file2 = $request->file('file_invoice');
                    $file2Name = time() . '_file_invoice_' . $file2->getClientOriginalName();
                    $file2Path = $file2->storeAs($path, $file2Name, 'local');
                    $data_update['file_invoice'] = $file2Name;
                }

                if($request->hasFile('file_packing_list'))
                {
                    $file3 = $request->file('file_packing_list');
                    $file3Name = time() . '_file_packing_list_' . $file3->getClientOriginalName();
                    $file3Path = $file3->storeAs($path, $file3Name, 'local');
                    $data_update['file_packing_list'] = $file3Name;
                }

                $dataPPBE->update($data_update);

                if(!empty($request->barang)) {
                    $ppbe_goods = PpbeGoodsModel::where('ppbe_id',$id)->delete();
                    foreach($request->barang as $value){
                        $ppbe_goods = PpbeGoodsModel::create([
                            'ppbe_id'=> $dataPPBE->id,
                            'processed_level_id'=> $value['nomor_hs'],
                            'description'=> $value['uraian'],
                            'quantity_kg'=> $value['jumlah_total'],
                            'fob_value'=> $value['nilai_fob'],
                        ]);
                    }
                }

                $ppbe_history = PpbeHistoryModel::create([
                    'ppbe_id'=> $dataPPBE->id,
                    'request_id'=> $auth_user->id,
                    // 'approver_id'=> $auth->id,
                    'status'=> $status,
                    'status_description'=> $status_descript,
                    // 'new_status'=> $request->,
                    // 'reason'=> $request->,
                ]);

                if($status === "approved"){
                    PpbeHistoryModel::where('id',$ppbe_history->id)->update([
                        "approver_id"=>$auth_user->id,
                    ]);

                    // $quota_history = HistoryQuotaModel::create([
                    //     'ppbe_id' => $dataPPBE->id,
                    //     'company_id' => $dataPPBE->company_id,
                    //     'nomor_pe' => $dataPPBE->company->nomor_pe,
                    //     'date_pe' => $dataPPBE->company->date_pe,
                    //     'company_quota' => $dataPPBE->company->company_quota,
                    //     'company_quota_remaining' => $quota_remaining,
                    //     'company_quota_used' =>  $quota_used,//(cek apakah dia kurang atau nambah jika ada revisi)
                    //     'status_quota' => "Pengajuan",
                    //     'notes' => "Pengjuan PPBE"
                    // ]);
                    DB::commit();
                    return redirect()->route('ppbe.index')->with('success', 'Pengajuan berhasil Diverifikasi.');
                }

                DB::commit();
                return redirect()->route('ppbe.index')->with('success', 'Pengajuan berhasil Dirubah.');
            }


        } catch (\Exception $e) {
            dd($e);
            DB::Rollback();
        }
    }

    public function generateCode($dataPPBE)
    {

        $yearSubs = substr(date('Y'), 2);
        $office_id = $dataPPBE->inspection_office_id;
        $office = KantorCabang::where('id', $office_id)->first();
        $last_ppbe = PPBEModel::whereIn('status',['approved', 'assignment', 'print_assignment_letter'])->where('inspection_office_id',$dataPPBE->inspection_office_id)->orderBy('code','desc')->first();
        // $generateCode = $office->code . '.' . $yearSubs . '.' . str_pad($startNumber, 5, '0', STR_PAD_LEFT);
        // dd($last_ppbe);

        if (!$last_ppbe) $startNumber = 1;
        else {
            $arrCode = explode('.', $last_ppbe->code);
            $yearPPBE = $arrCode[1];
            if($yearSubs == $yearPPBE)
            {
                $sequenceNo =  $arrCode[2];
                $startNumber = intval($sequenceNo) + 1;
            } else {
                $startNumber = 1;
            }
        }
        $generateCode = $office->code . '.' . $yearSubs . '.' . str_pad($startNumber, 5, '0', STR_PAD_LEFT)."-K";
        return $generateCode;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //
    }

    public function ppbe($id){
        $data =[
            'title' => 'PERMINTAAN PEMERIKSAAN BARANG EKSPOR (PPBE)',
            'content' =>'ISIPPBE'
        ];

        $data_ppbe = PPBEModel::where('id', $id)->first();
        $data_company = CompanyModel::where('id', $data_ppbe->company_id)->first();
        $data_ppbe_goods = PPBEGoodsModel::where('ppbe_id', $data_ppbe->id)->get();
        // dd($data_ppbe_goods);
        $documentPDF = View::make('ppbe.export',['data'=>$data, 'data_ppbe' => $data_ppbe, 'data_company' => $data_company, 'data_ppbe_goods' => $data_ppbe_goods])->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($documentPDF);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        return $dompdf->stream('ppbe.export',['Attachment'=>false]);
    }

    public function pdf_export($id)
    {
        $data =[
            'title' => 'test',
            'content' =>'coba'
        ];
        $documentPDF = View::make('ppbe.pdf',['data'=>$data])->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($documentPDF);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        return $dompdf->stream('ppbe.pdf',['Attachment'=>false]);

    }

    public function draft_pdf($id)
    {
        $data =[
            'title' => 'Print Out Rekaman PPBE',
            'content' =>'Draft PPBE'
        ];
        $data_ppbe = PPBEModel::with(['goods','company'])
                    ->leftjoin("mcurrencies","mcurrencies.id","=","ppbe.fob_currency")
                    ->leftjoin("mloading_ports as port_1", "ppbe.origin_port_id","=","port_1.id")
                    ->leftjoin("mloading_ports as port_2", "ppbe.loading_port_id","=","port_2.id")
                    ->leftjoin("mdestination_ports","mdestination_ports.id","=","ppbe.destination_port_id")
                    ->leftjoin("mcountries as country_1","ppbe.country_id","=","country_1.id")
                    ->leftjoin("mcountries as country_2","ppbe.country_destination_id","=","country_2.id")
                    ->select('ppbe.*','mcurrencies.code as currency_code', 'mcurrencies.description as currency_description','port_1.name as origin_name','port_2.name as loading_name',
                        'mdestination_ports.name as destination_name','country_1.name as country_name','country_2.name as country_destination_name')
                    ->where('ppbe.id', $id)->first();
        $data_company = CompanyModel::where('id', $data_ppbe->company_id)->first();
        $data_ppbe_goods = PPBEGoodsModel::where('ppbe_id', $data_ppbe->id)->get();
        // dd($data_ppbe_goods);
        $documentPDF = View::make('ppbe.draft',['data'=>$data, 'data_ppbe' => $data_ppbe, 'data_company' => $data_company, 'data_ppbe_goods' => $data_ppbe_goods])->render();


        $dompdf = new Dompdf();
        $dompdf->loadHtml($documentPDF);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        return $dompdf->stream('ppbe.draft',['Attachment'=>false]);
    }

    public function getDestination($id)
    {
        $destination_port = PelabuhanTujuan::where('country_id',$id)->get(['id','code','name']);
        return response()->json($destination_port);
    }

    public function getcity($id)
    {
        $city = KabupatenKota::where('province_id',$id)
            ->where('is_active', 1)
            ->select("id","code","name","province_id")
            ->get();

        return response()->json($city);
    }

    public function cancel_ppbe(Request $request)
    {
        DB::beginTransaction();
        $ppbe_id = $request->ppbe_id_reject;
        $data_ppbe = PPBEModel::findOrFail($ppbe_id);

        $validate = Validator::make($request->all(),[
            "cancel_notes" => 'required'
        ],[
            "cancel_notes.required" => "Alasan masih perlu di isi"
        ]);

        if($validate->fails())
        {
            // dd($validate->errors());
            return redirect()->route('ppbe.index')
                ->withErrors($validate)
                ->withInput();
        }

        $data_ppbe->update([
            "notes" => $request->cancel_notes,
            "status" => "cancel"
        ]);

        DB::commit();
        return redirect()->route('ppbe.index')->with('success', 'PPBE Berhasil di Batalkan.');
        // dd($request);
    }
}

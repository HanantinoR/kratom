<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerijinanModel;
use App\Models\PerijinanPEModel;
use App\Models\HistoryQuotaModel;
use App\Models\PerijinanHistoryModel;
use App\Models\KantorCabang;
use App\DataTables\PerijinanDataTable;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\KabupatenKota;
use App\Models\Provinsi;
use App\Helpers\AuthHelper;
use App\Models\HSLevel;

class PerijinanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PerijinanDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('perijinan.title')] );
        $assets = ['data-table','perijinan_list','company_search'];
        $headerAction = "<a href=".route('perijinan.create')." class='btn btn-sm btn-primary' role='button'>Add Perijinan</a>";
        return $dataTable->render('global.datatable', compact('pageTitle','assets', 'headerAction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        $auth_user = AuthHelper::authSession();

        $assets = ['perijinan','file'];

        $office_branch = KantorCabang::get();

        $provinces = Provinsi::get();

        $cities = KabupatenKota::get();

        $roles = Role::where('status',1)->get()->pluck('title', 'id');

        return view('perijinan.tambah', compact('roles','assets','office_branch','provinces','cities','auth_user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $auth_user = AuthHelper::authSession();
        // dd($auth_user);
        $validatedData = Validator::make($request->all(),[
            'province_id' => 'required|not_in:0|min:1',
            'city_id' => 'required|not_in:0|min:1',
            'file_et' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'file_nib' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'file_npwp' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'file_ktp' => 'required|file|mimes:jpg,png,pdf|max:2048',
        ], [
            'province_id.not_in' => 'tolong pilih provinsi broo',
            'city_id.not_in' => 'tolong pilih City broo',
            'file_et' => 'Harap Masukan File ET',
            'file_nib' => 'Harap Masukan File NIB',
            'file_npwp' => 'Harap Masukan File NPWP',
            'file_ktp' => 'Harap Masukan File KTP',
        ]);

            // dd($validatedData);
        if($validatedData->fails())
        {
            // dd($validatedData->errors());
            return redirect()->route('perijinan.create')
                ->withErrors($validatedData)
                ->withInput();
        }
        $path = 'perijinan_file';

        if($request->hasFile('file_et'))
        {
            // dd('a');
            $file1 = $request->file('file_et');
            $file1Name = time() . '_file_et_' . $file1->getClientOriginalName();
            $file1Path = $file1->storeAs($path, $file1Name, 'local');
        }
        if($request->hasFile('file_nib'))
        {
            // dd('b');
            $file3 = $request->file('file_nib');
            $file3Name = time() . '_file_nib_' . $file3->getClientOriginalName();
            $file3Path = $file3->storeAs($path, $file3Name, 'local');
        }
        if($request->hasFile('file_npwp'))
        {
            // dd('b');
            $file4 = $request->file('file_npwp');
            $file4Name = time() . '_file_npwp_' . $file4->getClientOriginalName();
            $file4Path = $file4->storeAs($path, $file4Name, 'local');
        }
        if($request->hasFile('file_ktp'))
        {
            // dd('b');
            $file5 = $request->file('file_ktp');
            $file5Name = time() . '_file_ktp_' . $file5->getClientOriginalName();
            $file5Path = $file5->storeAs($path, $file5Name, 'local');
        }
        // dd('b');
        $perijinan = PerijinanModel::updateOrCreate(
            ['nomor_et'=> $request->nomor_et],
            [
            'province_id'=> $request->province_id,
            'city_id'=> $request->city_id,
            'company_address'=> $request->company_address,
            'factory_address'=> $request->factory_address,
            'branch_office'=> $request->branch_office,
            'pic'=> $request->pic,
            'position'=> $request->position,
            'status'=> $request->status,
            'file_et'=> $file1Name,
            'file_nib'=> $file3Name,
            'file_npwp'=> $file4Name,
            'file_ktp'=> $file5Name,
            'created_by'=> $auth_user->id
        ]);
        return redirect()->route('perijinan.index')->with('success', 'Perijinan berhasil Disimpan.');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $assets = ['perijinan','file'];

        $data = PerijinanModel::with('pe')->findOrFail($id);

        $data_history = PerijinanHistoryModel::where('company_id',$id)->get();

        $office_branch = KantorCabang::get();

        $provinces = Provinsi::get();

        $cities = KabupatenKota::get();

        $auth_user = AuthHelper::authSession();

        return view('perijinan.tambah', compact('data','id','assets','data_history','office_branch','provinces','cities','auth_user'));
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
        $validatedData = Validator::make($request->all(),[
            "nib" => 'required',
            "nomor_et" => 'required',
            "date_nib" => 'required',
            "date_et" => 'required',
            "npwp" => 'required',
            "name" => 'required',
            "province_id" => 'required|not_in:0|min:1',
            "city_id" => 'required|not_in:0|min:1',
            "company_address" => 'required',
            "factory_address" => 'required',
            "branch_office" => 'required',
            "pic" => 'required',
            "position" => 'required',
            "status" => 'required',
            'file_et' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'file_pe' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'file_nib' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'file_npwp' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'file_ktp' => 'required|file|mimes:jpg,png,pdf|max:2048',
        ] , [
            'province_id.not_in' => 'tolong pilih provinsi broo',
            'city_id.not_in' => 'tolong pilih City broo',
        ]);

        $oldData = PerijinanModel::findOrFail($id);
        $path = 'perijinan_file';

        if(!$oldData){
            return redirect()->route('perijinan.index')->with('info', 'Data tidak ditemukan.');
        }
        //rincian data baru tanpa file
        $newData = $request->except(['file_et','file_pe','file_nib','file_npwp','file_ktp','_method','_token','perijinan_notes']);
        //check apakah data berubah
        $changes=[];
        $data=[];

        foreach($newData as $field => $newValue)
        {

            $oldValue = $oldData->$field;
            if($oldValue != $newValue){
                $changes[] = [
                    'field_name' => $field,
                    'old_value' => $oldValue,
                    'new_value' => $newValue
                ];
                $oldData->$field = $newValue;
                $data[$field] = $newValue;
            }

        }

        $newDataFile = ['file_et','file_pe','file_nib','file_npwp','file_ktp'];
        foreach ($newDataFile as $fileField) {
            if($request->hasFile($fileField))
            {
                if(Storage::exists($path."/").$oldData->$fileField){
                    Storage::delete($path.'/' . $oldData->$fileField);
                }
                $file = $request->file($fileField);
                $filename = time()."_".$fileField."_".$file->getClientOriginalName();
                $file->storeAs($path, $filename);

                //update data
                $changes[] = [
                    'field_name' => $fileField,
                    'old_value' => $oldData->$fileField,
                    'new_value' => $filename
                ];

                $data[$fileField] = $filename;
            }
        }

        if(empty($changes)){
            return redirect()->route('perijinan.index')->with('info', 'Tidak ada data yang berubah.');
        }
        foreach ($changes as $change) {
            if($change['field_name'] === "branch_office")
            {
                $kantor_cabang = KantorCabang::whereIn('id',[$change['old_value'],$change['new_value']])->pluck('name','id')->toArray();
                $change['old_value'] = $kantor_cabang[$change['old_value']];
                $change['new_value'] = $kantor_cabang[$change['new_value']];
            }

            PerijinanHistoryModel::create([
                'company_id' => $oldData->id,
                'field' => $change['field_name'],
                'old_value' => $change['old_value'],
                'new_value' => $change['new_value'],
                'notes' => $request->perijinan_notes
            ]);

        }
        $oldData->update($data);


        return redirect()->route('perijinan.index')->with('success', 'Perijinan berhasil Dirubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $perijinan = PerijinanModel::findOrFail($id);
        $perijinan->delete();

        return response()->json([
            'status' => 200,
            'message' =>"data berhasil dihapus"
        ]);

    }

    public function modal_update(Request $request)
    {
        dd($request);
    }

    public function detail_pe($id)
    {
        $data_pe = PerijinanPEModel::with('pe_detail')->findOrFail($id);
        return view('perijinan.pe_detail',compact('data_pe'));
    }


    public function check_hs_pe($id,$company)
    {

        $hs_levels = HSLevel::where('id',$id)->first();
        $hs = str_replace(".","",$hs_levels->hs);
        $pe = PerijinanPEModel::with('pe_detail')->where('company_id',$company)->get();

        dd($id,$company,$pe);
    }
}

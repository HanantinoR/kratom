<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerijinanModel;
use App\Models\PerijinanHistoryModel;
use App\DataTables\PerijinanDataTable;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
        $assets = ['data-table','perijinan_list'];
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
        $assets = ['perijinan'];
        $roles = Role::where('status',1)->get()->pluck('title', 'id');

        return view('perijinan.tambah', compact('roles','assets'));
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
        $validatedData = Validator::make($request->all(),[
            // 'name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:users,email',
            // 'password' => 'required|string|min:8|confirmed',
            'company_provincy' => 'required|not_in:0|min:1',
            'company_city' => 'required|not_in:0|min:1',
            'file_et' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'file_pe' => 'required|file|mimes:jpg,png,pdf|max:2048'
        ], [
            // 'name.required' => 'The name field is mandatory.',
            // 'email.email' => 'The email address is not valid.',
            // 'password.confirmed' => 'The password confirmation does not match.',
            'company_provincy.not_in' => 'tolong pilih provinsi broo',
            'company_city.not_in' => 'tolong pilih City broo',
            'file_et' => 'kurang broo',
            'file_pe' => 'mana neeeeh'
        ]);

        if($validatedData->fails())
        {
            // dd($validatedData->errors());
            return redirect()->route('perijinan.create')
                ->withErrors($validatedData)
                ->withInput();
        }
        $path = 'perijinan';

        if($request->hasFile('file_et'))
        {
            // dd('a');
            $file1 = $request->file('file_et');
            $file1Name = time() . '_file_et.' . $file1->getClientOriginalName();
            $file1Path = $file1->storeAs($path, $file1Name, 'local');
        }
        if($request->hasFile('file_pe'))
        {
            // dd('b');
            $file2 = $request->file('file_pe');
            $file2Name = time() . '_file_pe.' . $file2->getClientOriginalName();
            $file2Path = $file2->storeAs($path, $file2Name, 'local');
        }

        PerijinanModel::create([
            'nib'=> $request->nib,
            'nomor_et'=> $request->nomor_et,
            'nomor_pe'=> $request->nomor_pe,
            'date_nib'=> $request->date_nib,
            'date_et'=> $request->date_et,
            'date_pe'=> $request->date_pe,
            'company_name'=> $request->company_name,
            'company_quota'=> $request->company_quota,
            'company_provincy'=> $request->company_provincy,
            'company_city'=> $request->company_city,
            'company_address'=> $request->company_address,
            'company_factory'=> $request->company_factory,
            'company_inspection_office'=> $request->company_inspection_office,
            'company_pic'=> $request->company_pic,
            'company_position'=> $request->company_position,
            'company_npwp'=> $request->company_npwp,
            'company_telp'=> $request->company_telp,
            'company_hp'=> $request->company_hp,
            'company_email'=> $request->company_email,
            'status'=> $request->status,
            'file_et'=> $file1Name,
            'file_pe'=> $file2Name,
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
        $assets = ['perijinan'];
        $data = PerijinanModel::findOrFail($id);

        $filePath1 = 'perijinan/'. $data->file_et;
        // $dataFile = Storage::response($filePath1);
        // dd($dataFile);
        return view('perijinan.tambah', compact('data','id','assets'));
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
            "nomor_pe" => 'required',
            "date_nib" => 'required',
            "date_et" => 'required',
            "date_pe" => 'required',
            "company_name" => 'required',
            "company_quota" => 'required',
            "company_provincy" => 'required',
            "company_city" => 'required',
            "company_address" => 'required',
            "company_factory" => 'required',
            "company_inspection_office" => 'required',
            "company_pic" => 'required',
            "company_position" => 'required',
            "company_npwp" => 'required',
            "company_telp" => 'required',
            "company_hp" => 'required',
            "company_email" => 'required',
            "status" => 'required',
            "file_et" => 'required',
            "file_pe" => 'required',
            "created_at" => 'required',
            "updated_at" => 'required'
        ]);

        $oldData = PerijinanModel::findOrFail($id);

        if(!$oldData){
            return redirect()->route('perijinan.index')->with('info', 'Data tidak ditemukan.');
        }
        //rincian data baru tanpa file
        $newData = $request->except(['file_et','file_pe','_method','_token']);
        //check apakah data berubah
        $changes=[];
        foreach($newData as $field => $newValue)
        {
            $oldValue = $oldData->$field;
            if($oldValue !== $newValue){
                $changes[] = [
                    'field_name' => $field,
                    'old_value' => $oldValue,
                    'new_value' => $newValue
                ];
                $oldData->$field = $newValue;
                // dd($oldData->$field);
            }

        }

        if(empty($changes)){
            return redirect()->route('perijinan.index')->with('info', 'Tidak ada data yang berubah.');
        }
        foreach ($changes as $change) {
            dd($change);
            PerijinanHistoryModel::create([
                'company_id' => $oldData->id,
                'field' => $change['field'],
                'old_value' => $change['old_value'],
                'new_value' => $change['new_value'],
            ]);
        }
        $oldData->update($newData);

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
}

<?php

namespace App\Http\Controllers;

use App\Models\BcopsRedSealModel;
use App\Models\BcopsGreenSealModel;
use App\Models\BcopsLockSealModel;
use App\Models\BcopsThreadSealModel;
use App\Models\BcopsUmumModel;
use App\Models\BcopsSurveyorModel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\AuthHelper;
use App\DataTables\BcopsUmumDataTable;
use App\DataTables\BcopsSurveyorDataTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illumintae\Validaation\ValidationException;

class BcopsController extends Controller
{
    public function daftar_umum(BcopsUmumDataTable $dataTable){
        $pageTitle = trans('global-message.list_form_title',['form' => trans('bcops.title')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table','bcops','bcops_umum'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add UserS</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets'));
    }

    public function tambah_umum(Request $request)
    {
        DB::beginTransaction();
        $auth_user = AuthHelper::authSession();

        try {
            $request->validate([
                "red_series" => "nullable|string",
                "red_init" => "required_with:red_series",
                "red_total" => "required_with:red_series",
                "red_status"=> "required_with:red_series",
                "green_series" => "nullable|string",
                "green_init" => "required_with:green_series",
                "green_total" => "required_with:green_series",
                "green_status"=> "required_with:green_series",
                "lock_seal_series" => "nullable|string",
                "lock_seal_init" => "required_with:lock_seal_series",
                "lock_seal_total" => "required_with:lock_seal_series",
                "lock_seal_status"=> "required_with:lock_seal_series",
                "thread_series" => "nullable|string",
                "thread_init" => "required_with:thread_series",
                "thread_total" => "required_with:thread_series",
                "thread_status"=> "required_with:thread_series",
            ]);
            $models = [
                    "red" => BcopsRedSealModel::class,
                    "green"=>BcopsGreenSealModel::class,
                    "lock_seal" => BcopsLockSealModel::class,
                    "thread" => BcopsThreadSealModel::class
            ];
            $id=[];
            $seals = ["red","green","lock_seal","thread"];
            foreach ($seals as $index => $seal) {
                if($request->{$seal.'_status'} === "success")
                {
                    $series = $request->{$seal.'_series'};
                    $initial = $request->{$seal.'_init'};
                    $finish = $request->{$seal.'_init'} + $request->{$seal.'_total'} -1;
                    $check = $this->check_database($seal,$series,$initial,$finish,$models);

                    if($check !== "") {
                        DB::rollback();
                        return redirect()->route('bcops.umum_daftar')->with('error', 'BCOPS Sudah Ada.');
                    }

                    $seal_data_id = $models[$seal]::create([
                        'seal_series' => $request->{$seal.'_series'},
                        'seal_init' => $request->{$seal.'_init'},
                        'seal_total' => $request->{$seal.'_total'},
                        'seal_finish' => $finish
                    ])->id;

                    if($seal === "lock_seal")
                    {
                        $seal = "lock";
                    }
                    $id[$seal."_seal_id"] = $seal_data_id;
                }
            }

            $id['date_seal'] = $request->bcops_date;
            BcopsUmumModel::Create($id);
            DB::commit();
            return redirect()->route('bcops.umum_daftar')->with('success', 'BCOPS berhasil tersimpan.');
        } catch (\validationException $e) {
            DB::rollback();
            return redirect()->route('bcops.umum_daftar',$id)
            ->withErrors($e);
        }
    }

    function check_umum(Request $request)
    {
        $seal = $request->seal_type;
        $series = $request->seal_series;
        $initial = $request->seal_init;
        $finish = $request->seal_final;

        $models = [
            "red" => BcopsRedSealModel::class,
            "green"=>BcopsGreenSealModel::class,
            "lock_seal" => BcopsLockSealModel::class,
            "thread" => BcopsThreadSealModel::class
        ];
        $result_data = $this->check_database($seal,$series,$initial,$finish,$models);

        if($result_data != "")
        {
            return response()->json([
                'message' => 'BCOPS sudah terdaftar!',
                'result' => 'error'
            ],400);
        }

        return response()->json([
            'message' => 'BCOPS belum terdaftar!',
            'result' => 'success'
        ],200);
    }

    public function daftar_surveyor(BcopsSurveyorDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('bcops.title')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table','bcops','bcops_surveyor'];
        $users = User::where('status','active')->get();
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add UserS</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets','users'));
    }

    public function tambah_surveyor(Request $request)
    {
        DB::beginTransaction();
        $auth_user = AuthHelper::authSession();

        try {
            $request->validate([
                "surveyor_id"=>"required",
                "red_series" => "nullable|string",
                "red_init" => "required_with:red_series",
                "red_total" => "required_with:red_series",
                "red_status"=> "required_with:red_series",
                "green_series" => "nullable|string",
                "green_init" => "required_with:green_series",
                "green_total" => "required_with:green_series",
                "green_status"=> "required_with:green_series",
                "lock_seal_series" => "nullable|string",
                "lock_seal_init" => "required_with:lock_seal_series",
                "lock_seal_total" => "required_with:lock_seal_series",
                "lock_seal_status"=> "required_with:lock_seal_series",
                "thread_series" => "nullable|string",
                "thread_init" => "required_with:thread_series",
                "thread_total" => "required_with:thread_series",
                "thread_status"=> "required_with:thread_series",
            ]);
            $models = [
                    "red" => BcopsRedSealModel::class,
                    "green"=>BcopsGreenSealModel::class,
                    "lock_seal" => BcopsLockSealModel::class,
                    "thread" => BcopsThreadSealModel::class
            ];
            $id=[];
            $seals = ["red","green","lock_seal","thread"];
            foreach ($seals as $index => $seal) {
                if($request->{$seal.'_status'} === "success")
                {
                    $series = $request->{$seal.'_series'};
                    $initial = $request->{$seal.'_init'};
                    $finish = $request->{$seal.'_init'} + $request->{$seal.'_total'} -1;
                    $check = $this->check_database($seal,$series,$initial,$finish,$models);
                    $bcops_lebih = $this->check_lebih($check);
                    if($check === "") {
                        DB::rollback();
                        return redirect()->route('bcops.surveyor_daftar')->with('error', 'BCOPS Belum Ada.');
                    }

                    // $seal_data_id = $models[$seal]::create([
                    //     'seal_series' => $request->{$seal.'_series'},
                    //     'seal_init' => $request->{$seal.'_init'},
                    //     'seal_total' => $request->{$seal.'_total'},
                    //     'seal_finish' => $finish
                    // ])->id;

                    if($seal === "lock_seal")
                    {
                        $seal = "lock";
                    }
                    $id[$seal."_seal_id"] = $seal_data_id;
                }
            }
            dd($id);
            $id['date_seal_surveyor'] = $request->bcops_date;
            BcopsSurveyorModel::Create($id);
            DB::commit();
            return redirect()->route('bcops.umum_daftar')->with('success', 'BCOPS berhasil tersimpan.');
        } catch (\validationException $e) {
            DB::rollback();
            return redirect()->route('bcops.umum_daftar',$id)
            ->withErrors($e);
        }
    }

    function check_surveyor(Request $request)
    {
        $seal = $request->seal_type;
        $series = $request->seal_series;
        $initial = $request->seal_init;
        $finish = $request->seal_final;
        $surveyor = $request->surveyor_id;
        if(!$surveyor)
        {
            return response()->json([
                'message' => 'Mohon Pilih surveyor',
                'result' => 'error'
            ],400);
        }
        $models = [
            "red" => BcopsRedSealModel::class,
            "green"=>BcopsGreenSealModel::class,
            "lock_seal" => BcopsLockSealModel::class,
            "thread" => BcopsThreadSealModel::class
        ];
        $result = $this->check_database($seal,$series,$initial,$finish,$models);
        dd($result, $finish);
        if($result == "")
        {
            return response()->json([
                'message' => 'BCOPS tidak ditemukan, mohon input BCOPS Umum terlebih dahulu',
                'result' => 'error'
            ],400);
        }
        if($seal === "lock_seal")
        {
            $seal = "lock";
        }
        $check = BcopsSurveyorModel::where($seal."_seal_id",$result)->first();
        // $check_lebih = $this->check_lebih($seal,$series,$initial,$finish);
        if($check_lebih == null)
        {
            return response()->json([
                'message' => 'Masih terdapat BCOPS yang belum terdaftar',
                'result' => 'error'
            ],400);
        }
        if(isset($check))
        {
            return response()->json([
                'message' => 'BCOPS pada Surveyor Sudah dipakai',
                'result' => 'error'
            ],400);
        }
        return response()->json([
            'message' => 'BCOPS pada Surveyor belum dipakai',
            'result' => 'success'
        ],200);
    }

    private function check_database($seal,$series,$initial,$finish,$models)
    {
        $seals_type = ["red","green","lock_seal","thread"];
        foreach ($seals_type as $type) {
            if($seal === $type)
            {
               $get_id = $models[$seal]::where('seal_series', '=' ,$series)
                    ->where('seal_init',"<=",(int)$initial)
                    ->where('seal_finish',">=",(int)$finish)
                    ->orWhereBetween('seal_init',[$initial,$finish])
                    ->orWhereBetween('seal_finish',[$initial,$finish])
                    // ->where(function($query)use($key,$query)){
                    //     ->where('seal_init', '<=', (int)$finish)
                    //     ->Where('seal_finish', '>=',(int)$initial)
                    // }
                    ->first();
                dd($get_id);
                if(!isset($get_id)){
                    $exists = '';
                }
                else{
                    $exists = $get_id->id;
                }
            }
        }
        return $exists;
        //  $key = ['seal_series','seal_init','seal_finish'];
        // $id = BcopsRedSealModel::where(function($query) use ($key,$initial,$finish,$series){
        //     $query->where(function($query2) use ($key,$initial,$finish,$series){
        //         $query2->where($key[1],'>=',(int)$initial)
        //             ->where($key[1],'<=',(int)$finish);
        //         if(isset($key[0])){
        //             $query2->where(function($query2) use ($key,$initial,$finish,$series){
        //                 $query2->where($key[0], $series);
        //             });
        //         }
        //     })
        //         ->orWhere(function($query2) use ($key,$initial,$finish,$series){
        //             $query2->where($key[2],'>=',(int)$initial)
        //                 ->where($key[2],'<=',(int)$finish);
        //             if(isset($key[0])){
        //                 $query2->where(function($query2) use ($key,$initial,$finish,$series){
        //                     $query2->where($key[0], $series);
        //                 });
        //             }
        //         })
        //         ->orWhere(function($query2) use ($key,$initial,$finish,$series){
        //             $query2->where($key[1],'<=',(int)$initial)
        //                 ->where($key[2],'>=',(int)$finish);
        //             if(isset($key[0])){
        //                 $query2->where(function($query2) use ($key,$initial,$finish,$series){
        //                     $query2->where($key[0], $series);
        //                 });
        //             }
        //         });
        // })
    }

    private function check_lebih($seal,$series,$initial,$finish)
    {
        // dd($seal);
        // $check = BcopsSurveyorModel::leftjoin('bcops_red_seal','bcops_red_seal.id','=','bcops_surveyor.red_seal_id')
        //                     ->leftjoin('bcops_green_seal','bcops_green_seal.id','=','bcops_surveyor.green_seal_id')
        //                     ->leftjoin('bcops_lock_seal','bcops_lock_seal.id','=','bcops_surveyor.lock_seal_id')
        //                     ->leftjoin('bcops_thread_seal','bcops_thread_seal.id','=','bcops_surveyor.thread_seal_id')
        //                     ->select('bcops_red_seal.seal_finish','bcops_green_seal.seal_finish','bcops_lock_seal.seal_finish','bcops_thread_seal.seal_finish');
        // $query = $check->newQuery();
        // if($seal === "lock_seal")
        // {
        //     $seal = "lock";
        // }
        // $seals_type = ["red","green","lock_seal","thread"];
        // // foreach ($seals_type as  $type) {
        //     if(in_array($seal, $seals_type))
        //     {
        //         $query->where('bcops_'.$seal.'_seal.seal_series',"=",$series);
        //         // $query->where('bcops_'.$seal.'_seal.seal_finish',"<=",$finish);
        //     }
        // // }
        // $result = $query->get();
        // dd($result);

        dd($seal,$series);
        return $result;
    }
}

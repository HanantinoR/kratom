<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerijinanModel;
use App\Models\PerijinanPEModel;
use App\Models\PerijinanPEDetailModel;
use App\Models\HistoryQuotaModel;
use App\Http\Requests\PerijinanRequest;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use App\Helpers\AuthHelper;

class MasterCompanyController extends Controller
{
    public function getCompany($company_id)
    {
        // dd($company_id);
        $company = PerijinanModel::with(['pe'=>function($query){
            $query->where('status','aktif');
        }])->where('id',$company_id)->first();

        return response()->json([
            'company' => $company,
        ],200);
    }

    public function check_et_pe (Request $request)
    {
        $auth_user = AuthHelper::authSession();
        // $validatorData = Validator::make($request->all(),[
        //     'nib' => "required",
        //     'date_nib' => "required",
        //     'date_et' => "required",
        //     'npwp' => "required"
        // ],[
        //     'nib' => 'masih kosong broo',
        //     'date_nib' => 'masih kosong broo',
        //     'date_et' => 'masih kosong broo',
        //     'npwp' => 'masih kosong broo',
        // ]);
        // // dd(json_decode($validatorData->errors()));

        // if($validatorData->fails())
        // {
        //     return response()->json([
        //         'result' => 'error',
        //         'title' => 'Error',
        //         'message' => $validatorData->errors()
        //     ], 422);
        // }

        $nib = $request->nib;
        $npwp = $request->npwp;
        $izin = $request->izin;
        $date_nib = $request->date_nib;

        $result_data = $this->check_izin($nib,$npwp,$izin);
        $result_json = $result_data->getBody()->getContents();
        $json_data = json_decode($result_json);
        // dd($json_data->kepatuhan);
        if ($json_data !== null )
        {
            if (isset($json_data->kepatuhan) && $json_data->kepatuhan->kode === "A01")
            // if($kode === "A01")
            {

                //untuk ET
                if(strpos($izin,"ET") !== false) {

                    $date_et = $request->date_et;
                    $company_data = PerijinanModel::where('nomor_et',$izin)->count();
                    if($company_data > 0) {
                        return response()->json([
                            'message' => 'Data Sudah Pernah dilakukan Pengecekan Harap Check List Perijinan',
                            'result' => 'error',
                            'title' => 'Error'
                        ],400);
                    }
                    // dd('c');

                    $company = PerijinanModel::create([
                        'nib'=> $nib,
                        'npwp'=> $npwp,
                        'nomor_et'=> $izin,
                        'date_et' => $date_et,
                        'date_nib'=> $date_nib,
                        'name'=> $json_data->header->nama_perusahaan,
                        // 'name'=> "PT Cipta Alam",
                        'status' => "pending",
                        'result_et' => $result_json
                    ]);

                    $type_izin =  "et";
                } else {
                    //untuk PE
                    $company_data = PerijinanModel::where('nib',$nib)->first();
                    $company_pe_data = PerijinanPEModel::where('nomor_pe',$izin)->count();
                    if($company_pe_data > 0)
                    {
                        return response()->json([
                            'message' => 'Data PE sudah terdaftar, Silahkan Cek Detail',
                            'result' => 'warning',
                            'title' => 'Error'
                        ],400);
                    }

                    if($request->hasFile('file_pe'))
                    {
                        $path = 'pe_file';
                        $file1 = $request->file('file_pe');
                        $file1Name = time() . '_file_pe_' . $file1->getClientOriginalName();
                        $file1Path = $file1->storeAs($path, $file1Name, 'local');
                    }

                    $company_pe = PerijinanPEModel::create([
                        'company_id'=> $company_data->id,
                        'nomor_pe'=> $izin,
                        'result_pe'=>$result_json,
                        'file_pe'=>$file1Name,
                        'created_by'=>$auth_user->id,
                        'permit_date' => $json_data->header->tgl_izin,
                        'date_start' => $json_data->header->tgl_awal,
                        'date_end' => $json_data->header->tgl_akhir,
                        'status' => "aktif"
                    ]);


                    foreach ($json_data->komoditas as $key => $value) {
                        $company_pe_detail = PerijinanPEDetailModel::create([
                            'pe_id' => $company_pe->id,
                            'hs' => $value->pos_tarif,
                            'detail' => $value->ur_barang,
                            'volume_total' => $value->jml_volume,
                            'volume_sisa' => $value->sisa_volume,
                            'volume_tersedia' => $value->avail_volume,
                            'tgl_berlaku' => $value->tgl_berlaku,
                            'terpakai_ls' => $value->terpakai_ls,
                            'booking_ls' => $value->terpakai_booking
                        ]);
                    }

                    $type_izin =  "pe";
                }
                //saving ET or PE
                return response()->json([
                    'type' => $type_izin,
                    // 'message' => 'Success',
                    'message' => $json_data->kepatuhan,
                    'result' => 'success',
                    'title' => 'Success'
                ],200);
            } else if (isset($json_data->kepatuhan) && ($json_data->kepatuhan->kode === "B01" || $json_data->kepatuhan->kode === 'B02')) {
                return response()->json([
                    'kode' => $json_data->kepatuhan->kode,
                    'message' => $json_data->kepatuhan->keterangan,
                    'result' => 'error',
                    'title' => 'Error'
                ],400);
            } else if($json_data->kode === "A02")
            {
                return response()->json([
                    'kode' => $json_data->kode,
                    'message' => $json_data->error[0]->elemen.' '.$json_data->error[0]->keterangan,
                    'result' => 'error',
                    'title' => 'Error'
                ],400);
            } else if($json_data->kode === "R99" )
            {
                return response()->json([
                    'kode' => $json_data->kode,
                    'message' => $json_data->keterangan,
                    'result' => 'error',
                    'title' => 'Error'
                ],400);
            }
        } else {
            return response()->json([
                'kode' => 400,
                'message' => "Terdapat Error, Harap Hubungi Admin",
                'result' => 'error',
                'title' => 'Error'
            ],400);
        }
    }

    function check_izin($nib,$npwp,$izin)
    {

        // $curl = curl_init();
        $url_prod = 'https://services.kemendag.go.id/surveyor/1.0/';
        $url_dev = 'https://services.kemendag.go.id/surveyor/v1.0.dev/';
        // // dd($url.'check_izin');
        // curl_setopt_array($curl, array(
        // CURLOPT_URL => $url_prod.'check_izin',
        // CURLOPT_RETURNTRANSFER => true,
        // CURLOPT_ENCODING => '',
        // CURLOPT_MAXREDIRS => 10,
        // CURLOPT_TIMEOUT => 0,
        // CURLOPT_FOLLOWLOCATION => true,
        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        // CURLOPT_CUSTOMREQUEST => 'POST',
        // CURLOPT_POSTFIELDS =>'{
        //     "nib": "'.$nib.'",
        //     "npwp": "'.$npwp.'",
        //     "no_izin": "'.$izin.'",
        //     "flProbis": "E",
        //     "username": "superintending"
        // }',
        // CURLOPT_HTTPHEADER => array(
        //     'Content-Type: application/json',
        //     'x-Gateway-APIKey: d55c6de7-ee74-4da5-8da8-3ec9cd8f22d8',
        // ),
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);

        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'x-Gateway-APIKey' => 'd55c6de7-ee74-4da5-8da8-3ec9cd8f22d8',
        ];

        $body = json_encode([
            "nib" => $nib,
            "npwp" => $npwp,
            "no_izin" => $izin,
            "flProbis" => 'E',
            "username" => 'superintending'
        ]);

        $response = $client->post($url_prod.'check_izin', [
            'headers' => $headers,
            'body' => $body,
        ]);
        // dd($response);
        return $response;
    }



}

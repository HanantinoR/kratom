<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\AuthHelper;
use App\DataTables\PenugasanDataTable;
use Illuminate\Support\Facades\Validator;
use App\Models\PPBEModel;
use App\Models\PenugasanModel;
use App\Models\PpbeHistoryModel;
use Illuminate\Support\Facades\View;
use Dompdf\Dompdf;

class PenugasanController extends Controller
{
    public function index(PenugasanDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('penugasan.title')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table','penugasan_list'];
        $headerAction = '<a href="surat-penugasan" class="btn btn-sm btn-primary me-2" role="button">Print Surat Penugasan</a><a href="surat-tugas" class="btn btn-sm btn-warning me-2" role="button">Print Surat Tugas</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets','headerAction'));
    }

    public function save(Request $request)
    {

        $auth_user = AuthHelper::authSession();
        // dd($request,$auth_user);

        $validator = Validator::make($request->all(),[
            'ppbe_id'=> 'required|',
            'surveyor_id'=> 'required|',
            'intervention_type'=> 'required|',
            'letter_number'=> 'required|',
            'penugasan_date'=> 'required|',
        ]);

        if ($validator->fails()) {
            return redirect()->route('penugasan.index')
                ->withErrors($validator)
                ->withInput();
        }
        $ppbe = PPBEModel::findOrFail($request->ppbe_id);

        $penugasan = PenugasanModel::updateOrCreate(
            ['ppbe_id' => $request->ppbe_id],
            [
                'surveyor_id' => $request->surveyor_id,
                'intervention_type' => $request->intervention_type,
                'letter_number' => $request->letter_number,
                'penugasan_date' => $request->penugasan_date,
                'created_by' => $auth_user->id
            ]
        );

        $ppbe->update([
            'status' => 'assignment',
            'updated_by' => $auth_user->id,
        ]);

        $history = PpbeHistoryModel::create([
            "ppbe_id" => $request->ppbe_id,
            "request_id" => $auth_user->id,
            "status" => 'assignment',
            "status_description" =>"Pengajuan Sudah dilakukan Penugasan"

        ]);

        return redirect()->route('penugasan.index')->with('success', 'Penugasan berhasil di Ajukan.');
    }

    public function edit($id)
    {
        dd($id);
    }

    public function update($id)
    {
        dd($id);
    }

    public function getDataPpbe($id)
    {
        $ppbe = PenugasanModel::where('ppbe_id',$id)->first();

        return response()->json([
            'ppbe' => $ppbe,
        ],200);
    }
    
    public function surat_tugas(){
        $data =[
            'title' => 'Surat Tugas',
            'content' =>'Penugasan'
        ];
        $documentPDF = View::make('penugasan.surat-tugas',['data'=>$data])->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($documentPDF);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        return $dompdf->stream('penugasan.surat-tugas',['Attachment'=>false]);
    }

    public function surat_penugasan(){
        $data =[
            'title' => 'Surat Penugasan',
            'content' =>'Penugasan'
        ];
        $documentPDF = View::make('penugasan.surat-penugasan',['data'=>$data])->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($documentPDF);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        return $dompdf->stream('penugasan.surat-penugasan',['Attachment'=>false]);
    }
}

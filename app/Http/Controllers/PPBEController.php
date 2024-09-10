<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\AuthHelper;
use Spatie\Permission\Models\Role;
use App\DataTables\PPBEDataTable;
use App\Models\PerijinanModel;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

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
        $assets = ['data-table','ppbe_list'];
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
        $assets = ['ppbe','file'];
        $roles = Role::where('status',1)->get()->pluck('title', 'id');
        $data_company = PerijinanModel::get();
        return view('ppbe.tambah',compact('roles','assets','data_company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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

    public function pdf_export($id)
    {
        $data =[
            'title' => 'test',
            'contetnt' =>'coba'
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
}

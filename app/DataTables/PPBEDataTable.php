<?php

namespace App\DataTables;

use Illuminate\Http\Request;
use App\Models\PPBEModel;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PPBEDataTable extends DataTable
{
        /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query, Request $request)
    {

        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('date_ppbe',function($query){
                return date('d F Y', strtotime($query->date_ppbe));
            })
            ->editColumn('code', function($row) {
                return  '<a href="'.route('ppbe.edit',$row->id).'" class="btn btn-soft-primary">'.$row->code.'</a>' ?? "-";
            })
            // ->editColumn('userProfile.country', function($query) {
            //     return $query->userProfile->country ?? '-';
            // })
            // ->editColumn('userProfile.company_name', function($query) {
            //     return $query->userProfile->company_name ?? '-';
            // })
            ->editColumn('status', function($query) {
                // dd($query);
                $status =$query->status  ;
                $status_draft = '';
                $status_submitted = '';
                $status_verified = '';
                $merk_status="";


                $info = '<span class="text-capitalize badge bg-info mb-2">';
                $success = '<span class="text-capitalize badge bg-success mb-2">';
                $secondary = '<span class="text-capitalize badge bg-secondary mb-2">';
                $info_icon =    '<i class="icon me-2">'.
                                    '<svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">'.
                                        '<path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'.
                                        '<path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'.
                                        '<path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>'.
                                    '</svg>'.
                                '</i>';

                $success_icon = '<i class="icon me-2">'.
                                    '<svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">'.
                                        '<path fill-rule="evenodd" clip-rule="evenodd" d="M16.3345 2.75024H7.66549C4.64449 2.75024 2.75049 4.88924 2.75049 7.91624V16.0842C2.75049 19.1112 4.63549 21.2502 7.66549 21.2502H16.3335C19.3645 21.2502 21.2505 19.1112 21.2505 16.0842V7.91624C21.2505 4.88924 19.3645 2.75024 16.3345 2.75024Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'.
                                        '<path d="M8.43994 12.0002L10.8139 14.3732L15.5599 9.6272" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'.
                                    '</svg> '.
                                '</i>';

                if($status == 'rejected'){
                    $status_reject =    '<span class="text-capitalize badge bg-danger mb-2">'.
                                            '<i class="icon me-2">'.
                                                '<svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">'.
                                                    '<path opacity="0.4" d="M16.34 1.99976H7.67C4.28 1.99976 2 4.37976 2 7.91976V16.0898C2 19.6198 4.28 21.9998 7.67 21.9998H16.34C19.73 21.9998 22 19.6198 22 16.0898V7.91976C22 4.37976 19.73 1.99976 16.34 1.99976Z" fill="currentColor"></path>'.
                                                    '<path d="M15.0158 13.7703L13.2368 11.9923L15.0148 10.2143C15.3568 9.87326 15.3568 9.31826 15.0148 8.97726C14.6728 8.63326 14.1198 8.63426 13.7778 8.97626L11.9988 10.7543L10.2198 8.97426C9.87782 8.63226 9.32382 8.63426 8.98182 8.97426C8.64082 9.31626 8.64082 9.87126 8.98182 10.2123L10.7618 11.9923L8.98582 13.7673C8.64382 14.1093 8.64382 14.6643 8.98582 15.0043C9.15682 15.1763 9.37982 15.2613 9.60382 15.2613C9.82882 15.2613 10.0518 15.1763 10.2228 15.0053L11.9988 13.2293L13.7788 15.0083C13.9498 15.1793 14.1728 15.2643 14.3968 15.2643C14.6208 15.2643 14.8448 15.1783 15.0158 15.0083C15.3578 14.6663 15.3578 14.1123 15.0158 13.7703Z" fill="currentColor"></path>'.
                                                '</svg>'.
                                            '</i>'.
                                        'Reject '.date("d-m-Y H:i:s", strtotime($query['created_at'])).'</span><br>';
                    $merk_status .= $status_reject;
                }else if($status == 'draft'){
                    $status_draft = '<span class="text-capitalize badge bg-warning mb-2">'.
                                    '<i class="icon me-2">'.
                                        '<svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">'.
                                            '<path fill-rule="evenodd" clip-rule="evenodd" d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'.
                                            '<path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>'.
                                            '<path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>'.
                                        '</svg>'.
                                    '</i>'.
                                    'Draft '.date("d-m-Y H:i:s", strtotime($query['created_at'])).'</span><br>';
                    $merk_status .= $status_draft;
                } else {
                    if(!empty($query->submitted_date))
                    {
                        $status_submitted = 'Pengajuan '.date("d-m-Y", strtotime($query->submitted_date));
                        $merk_status .= $info.$info_icon.$status_submitted.'</span><br>';
                    }

                    if(!empty($query->approved_date))
                    {
                        $status_verified = 'Pengajuan Terverifikasi '.date("d-m-Y", strtotime($query->approved_date));
                        $merk_status .= $success.$success_icon.$status_verified.'</span><br>';
                    } else if($query->status != 'rejected') {
                        $status_verified = 'Menunggu Verifikasi oleh Pendok';
                        $merk_status .= $secondary.$info_icon.$status_verified.'</span><br>';
                    }

                    if(!empty($query->assignment_date))
                    {
                        $status_assignment = 'Pengajuan Penugasan '.date("d-m-Y", strtotime($query->assignment_date));
                        $merk_status .= $success.$success_icon.$status_assignment.'</span><br>';
                    }else {
                        $status_assignment = 'Menunggu Penugasan oleh Pendok';
                        $merk_status .=  $secondary.$info_icon.$status_assignment.'</span><br>';
                    }

                    if(!empty($query->hpl_date))
                    {
                        $status_assignment = 'Sudah Dilakukan pemeriksaan '.date("d-m-Y", strtotime($query->hpl_date));
                        $merk_status .= $success.$success_icon.$status_assignment.'</span><br>';
                    }else {
                        $status_assignment = 'Menunggu Pemeriksaan oleh Petugas';
                        $merk_status .=  $secondary.$info_icon.$status_assignment.'</span><br>';
                    }

                    if(!empty($query->ls_date))
                    {
                        $status_assignment = 'LS Sudah Di Verifikasi '.date("d-m-Y", strtotime($query->ls_date));
                        $merk_status .= $success.$success_icon.$status_assignment.'</span><br>';
                    }else {
                        $status_assignment = 'Menunggu Verifikasi LS';
                        $merk_status .=  $secondary.$info_icon.$status_assignment.'</span><br>';
                    }
                }

                    // dd($merk_status);
                return $merk_status;
            })
            ->editColumn('pengajuan_date', function($query) {
                return date('Y/m/d',strtotime($query['pengajuan_date']));
            })
            ->filterColumn('ppbe.code',function($query,$keyword){
                return $query->where('ppbe.code','like',"%{$keyword}%");
            })
            // ->filterColumn('full_name', function($query, $keyword) {
            //     $sql = "CONCAT(users.first_name,' ',users.last_name)  like ?";
            //     return $query->whereRaw($sql, ["%{$keyword}%"]);
            // })
            // ->filterColumn('userProfile.company_name', function($query, $keyword) {
            //     return $query->orWhereHas('userProfile', function($q) use($keyword) {
            //         $q->where('company_name', 'like', "%{$keyword}%");
            //     });
            // })
            // ->filterColumn('userProfile.country', function($query, $keyword) {
            //     return $query->orWhereHas('userProfile', function($q) use($keyword) {
            //         $q->where('country', 'like', "%{$keyword}%");
            //     });
            // })
            // ->addColumn('action', 'ppbe.action')
            ->addColumn('action',function($query){
                return view('ppbe.action',[
                    'id' => $query->id,
                    'status' => $query->status,
                    'user_type' => auth()->user()->user_type
                ]);
            })
            ->rawColumns(['action','status','code']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $model = PPBEModel::join('company','company.id','=','ppbe.company_id')
                        ->leftjoin('hplps','hplps.ppbe_id','=','ppbe.id')
                        ->leftjoin('ls','ls.ppbe_id','=','ppbe.id')
                        ->leftjoin('moffices','moffices.id','=','ppbe.inspection_office_id')
                        ->select('ppbe.id','ppbe.code','ppbe.date_ppbe','ppbe.company_id','company.id as company_id','company.name','ppbe.inspection_office_id',
                            'ppbe.status as status','ppbe.created_at','hplps.status as hplps_status','ls.status as ls_status','moffices.name as inspection_office');
        $query = $model->newQuery();
        if ($search = request()->get('ppbe_search')) {
            $query->where('ppbe.code', 'like', "%{$search}%");
        }

        if ($search = request()->get('company_name_search')) {
            $query->where('company.name', 'like', "%{$search}%");
        }

        if(auth()->user()->user_type === "user")
        {
            // $model->where('branch_office',auth()->user()->branch_office);
            $query->where('ppbe.company_id',auth()->user()->company_id);
        }

        if(auth()->user()->user_type === "koordinator_cabang")
        {
            $query->where('ppbe.inspection_office_id',auth()->user()->branch_office);
        }
        // return $query;
        return $this->applyScopes($model);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('dataTable')
                    ->columns($this->getColumns())
                    // ->addAction(['width' => '60px'])
                    ->ajax([
                        'url' => route('ppbe.index'),
                        'type' => 'GET',
                        'data' => 'function(d) {
                            d.ppbe_search = $("#ppbe_search").val();
                            d.company_name_search  = $("#company_name_search").val();
                        }', // Add custom data here
                    ])
                    ->minifiedAjax()
                    ->dom('<"row align-items-center"<"col-md-2" l><"col-md-6" B><"col-md-4"f>><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" i><"col-md-6" p>><"clear">')
                    ->parameters([
                        "processing" => true,
                        "autoWidth" => false,
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status','searchable'=>false],
            ['data' => 'code', 'name' => 'code', 'title' => 'Nomor PPBE'],
            ['data' => 'date_ppbe', 'name' => 'date_ppbe', 'title' => 'Tanggal PPBE','searchable'=>false],
            ['data' => 'name', 'name' => 'name', 'title' => 'Perusahaan','orderable' => false],
            ['data' => 'inspection_office', 'name' => 'inspection_office', 'title' => 'Kantor Cabang','searchable'=>false],
            // ['data' => 'userProfile.company_name', 'name' => 'userProfile.company_name', 'title' => 'Company'],
            // ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Join Date'],
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->searchable(false)
                  ->width(60)
                  ->addClass('text-center hide-search'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'PPBE_' . date('YmdHis');
    }
}

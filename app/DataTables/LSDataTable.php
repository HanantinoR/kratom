<?php

namespace App\DataTables;

use Illuminate\Http\Request;
use App\Models\PPBEModel;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LSDataTable extends DataTable
{
        /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {

        return datatables()
            ->eloquent($query)
            ->editColumn('code', function($row) {
                return '<a href="'.route('ppbe.edit',$row->id).'" class="btn btn-soft-primary">'.$row->code.'</a>';
            })
            // ->editColumn('userProfile.company_name', function($query) {
            //     return $query->userProfile->company_name ?? '-';
            // })
            ->editColumn('status', function($query) {
                $status = $query->hplps_status;
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

                if(!isset($status))
                {
                    $status_submit = 'Menunggu Pengajuan Pemeriksaan';
                    $merk_status .=  $secondary.$info_icon.$status_submit.'</span><br>';
                    $status_verified = 'Menunggu Verifikasi Pemeriksaan';
                    $merk_status .=  $secondary.$info_icon.$status_verified.'</span><br>';
                    $status_signed_ls = 'Menunggu Verifikasi Tanda Tangan';
                    $merk_status .=  $secondary.$info_icon.$status_signed_ls.'</span><br>';
                } else {
                    if(in_array($status,['verified','verified_signed_ls','print_ls','accepted_ls']))
                    {
                        $status_submitted = 'Verifikasi Pengajuan Pemeriksaan ';
                        $merk_status .= $success.$success_icon.$status_submitted.'</span><br>';
                    } else {
                        $status_submitted = 'Menunggu Verifikasi Pemeriksaan';
                        $merk_status .=  $secondary.$info_icon.$status_submit.'</span><br>';
                    }

                    if(in_array($status,['verified_signed_ls','print_ls','accepted_ls']))
                    {
                        $status_verified = 'Sudah Verifikasi LS';
                        $merk_status .= $success.$success_icon.$status_verified.'</span><br>';
                    } else {
                        $status_verified = 'Menunggu Verifikasi LS';
                        $merk_status .=  $secondary.$info_icon.$status_verified.'</span><br>';
                    }

                    if(in_array($status,['print_ls','accepted_ls'])) {
                        $status_signed_ls = 'LS Terbit';
                        $merk_status .=  $success.$success_icon.$status_signed_ls.'</span><br>';
                    } else {
                        $status_signed_ls = 'Menunggu LS Terbit';
                        $merk_status .=  $secondary.$info_icon.$status_signed_ls.'</span><br>';
                    }
                }
                return $merk_status;
            })
            ->editColumn('pengajuan_date', function($query) {
                return date('Y/m/d',strtotime($query['pengajuan_date']));
            })
            ->filterColumn('pengajuan_code',function($query,$keyword){
                return $query->where('pengajuan_code','like',"%{$keyword}%");
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
            ->addColumn('action',function($query){
                return view('ls.action',[
                    'id' => $query->hplps->id,
                    'status' => $query->hplps_status
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
                        ->select('ppbe.id','ppbe.code','ppbe.date','company.company_name','ppbe.inspection_office_id','ppbe.status as ppbe_status','ppbe.created_at','hplps.status as hplps_status')
                        ->whereIn('hplps.status',array('verified', 'verified_signed_ls','print_ls','accepted_ls'));
        $query = $model->newQuery();
        if ($search = request()->get('ppbe_search')) {
            $query->where('ppbe.code', 'like', "%{$search}%");
        }

        if ($search = request()->get('company_name_search')) {
            $query->where('company.company_name', 'like', "%{$search}%");
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
            ['data' => 'id', 'name' => 'id', 'title' => 'id','orderable' => false],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status','searchable'=>false],
            ['data' => 'code', 'name' => 'code', 'title' => 'Nomor PPBE'],
            ['data' => 'date', 'name' => 'date', 'title' => 'Tanggal PPBE','searchable'=>false],
            ['data' => 'company_name', 'name' => 'company_name', 'title' => 'Perusahaan','orderable' => false],
            ['data' => 'inspection_office_id', 'name' => 'inspection_office_id', 'title' => 'Kantor Cabang','searchable'=>false],
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

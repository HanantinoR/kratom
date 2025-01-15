<?php

namespace App\DataTables;

use Illuminate\Http\Request;
use App\Models\PPBEModel;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LHPDataTable extends DataTable
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
            ->addIndexColumn()
            ->editColumn('code', function($row) {
                return '<a href="'.route('ppbe.edit',$row->id).'" class="btn btn-soft-primary">'.$row->code.'</a>';
            })
            // ->editColumn('code_above', function($row) {
                // dd($row);
                // return '<a href="'.route('ls.detail',$row->ls_id).'" class="btn btn-soft-primary">'.$row->code_above.'</a>';
            // })
            // ->editColumn('userProfile.company_name', function($query) {
            //     return $query->userProfile->company_name ?? '-';
            // })
            ->editColumn('status', function($query) {
                $status = $query->hplps_status;
                $status_draft = '';
                $status_submitted = '';
                $status_verified = '';
                $merk_status="";

                $danger = '<span class="text-capitalize badge bg-danger mb-2">';

                $cancel_icon = '<svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">'.
                                    '<path opacity="0.4" d="M16.34 1.99976H7.67C4.28 1.99976 2 4.37976 2 7.91976V16.0898C2 19.6198 4.28 21.9998 7.67 21.9998H16.34C19.73 21.9998 22 19.6198 22 16.0898V7.91976C22 4.37976 19.73 1.99976 16.34 1.99976Z" fill="currentColor"></path>'.
                                    '<path d="M15.0158 13.7703L13.2368 11.9923L15.0148 10.2143C15.3568 9.87326 15.3568 9.31826 15.0148 8.97726C14.6728 8.63326 14.1198 8.63426 13.7778 8.97626L11.9988 10.7543L10.2198 8.97426C9.87782 8.63226 9.32382 8.63426 8.98182 8.97426C8.64082 9.31626 8.64082 9.87126 8.98182 10.2123L10.7618 11.9923L8.98582 13.7673C8.64382 14.1093 8.64382 14.6643 8.98582 15.0043C9.15682 15.1763 9.37982 15.2613 9.60382 15.2613C9.82882 15.2613 10.0518 15.1763 10.2228 15.0053L11.9988 13.2293L13.7788 15.0083C13.9498 15.1793 14.1728 15.2643 14.3968 15.2643C14.6208 15.2643 14.8448 15.1783 15.0158 15.0083C15.3578 14.6663 15.3578 14.1123 15.0158 13.7703Z" fill="currentColor"></path>'.
                                '</svg>';

                if($status === "reject")
                {
                    $status_cancel = 'Pengajuan Ditolak';
                    $merk_status .=  $danger.$cancel_icon.$status_cancel.'</span><br>';
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
                return view('lhp.action',[
                    'id' => $query->hplps->id,
                    'status' => $query->hplps_status,
                    'code_above_lhp' => $query->code_above_lhp,
                    'lhp_id' => $query->lhp_id
                ]);
            })
            ->rawColumns(['action','status','code','code_above']);
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
                        ->leftjoin('lhp','lhp.hplps_id','=','hplps.id')
                        ->leftjoin('moffices','moffices.id','=','ppbe.inspection_office_id')
                        ->select('ppbe.id','hplps.id as hplps_id','lhp.id as lhp_id','ppbe.code','ppbe.date_ppbe','company.name','ppbe.inspection_office_id',
                            'ppbe.status as ppbe_status','ppbe.created_at','hplps.status as hplps_status','lhp.status as lhp_status',
                            'lhp.code_above_lhp','moffices.name as kantor_cabang')
                        ->where('hplps.status','reject');
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
            ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status','searchable'=>false],
            ['data' => 'code_above_lhp', 'name' => 'code_above_lhp', 'title' => 'Nomor LHP'],
            ['data' => 'code', 'name' => 'code', 'title' => 'Nomor PPBE'],
            ['data' => 'date_ppbe', 'name' => 'date_ppbe', 'title' => 'Tanggal PPBE','searchable'=>false],
            ['data' => 'name', 'name' => 'name', 'title' => 'Perusahaan','orderable' => false],
            ['data' => 'kantor_cabang', 'name' => 'kantor_cabang', 'title' => 'Kantor Cabang','searchable'=>false],
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

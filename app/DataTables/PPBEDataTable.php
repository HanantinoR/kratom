<?php

namespace App\DataTables;

use Illuminate\Http\Request;
use App\Models\PPBEModel;
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
        // dd($request->all());
        return datatables()
            ->eloquent($query)
            // ->editColumn('userProfile.country', function($query) {
            //     return $query->userProfile->country ?? '-';
            // })
            // ->editColumn('userProfile.company_name', function($query) {
            //     return $query->userProfile->company_name ?? '-';
            // })
            ->editColumn('status', function($query) {
                $status = 'warning';
                switch ($query['status']) {
                    case 'active':
                        $status = 'primary';
                        break;
                    case 'inactive':
                        $status = 'danger';
                        break;
                    // case 'banned':
                    //     $status = 'dark';
                    //     break;
                }
                return '<span class="text-capitalize badge bg-'.$status.'">'.$query['status'].'</span>';
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
            ->addColumn('action', 'ppbe.action')
            ->rawColumns(['action','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $model = PPBEModel::query();
        $query = $model->newQuery();
        if ($search = request()->get('pengajuan_code_search')) {
            $query->where('pengajuan_code', 'like', "%{$search}%");
        }

        if ($search = request()->get('company_name_search')) {
            $query->where('company_name', 'like', "%{$search}%");
        }


        return $query;
        // return $this->applyScopes($model);
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
                            d.pengajuan_code_search = $("#pengajuan_code_search").val();
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
            ['data' => 'pengajuan_code', 'name' => 'pengajuan_code', 'title' => 'Nomor'],
            ['data' => 'company_name', 'name' => 'company_name', 'title' => 'Perusahaan','orderable' => false],
            ['data' => 'pengajuan_date', 'name' => 'pengajuan_date', 'title' => 'Tanggal PPBE','searchable'=>false],
            ['data' => 'office_inspection', 'name' => 'office_inspection', 'title' => 'Kantor Cabang','searchable'=>false],
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

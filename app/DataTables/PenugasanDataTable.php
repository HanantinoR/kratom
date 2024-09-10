<?php

namespace App\DataTables;

// use App\Models\Inatrade;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PenugasanDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        // dd($request->all());
        return datatables()
            ->eloquent($query)
            ->editColumn('status', function($query) {
                $status = 'warning';
                switch ($query['status']) {
                    case 'active':
                        $status = 'primary';
                        break;
                    case 'inactive':
                        $status = 'danger';
                        break;
                }
                return '<span class="text-capitalize badge bg-'.$status.'">'.$query['status'].'</span>';
            })
            ->filterColumn('company_name', function($query, $keyword){
                return $query->where('company_name', 'like', "%{$keyword}%");
            })
            ->filterColumn('ppbe_code',function($query,$keyword){
                return $query->where('ppbe_code','like',"%{$keyword}%");
            })
            ->filterColumn('ls_code', function($query, $keyword){
                return $query->where('ls_code', 'like', "{$keyword}");
            })
            ->addColumn('action', 'inatrade.action')
            ->rawColumns(['action','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Inatrade $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Inatrade $model)
    {
        $model = Inatrade::query();
        $query = $model->newQuery();

        if ($search = request()->get('ppbe_search')) {
            $query->where('ppbe_number', 'like', "%{$search}%");
        }

        if ($search = request()->get('company_name_search')) {
            $query->where('company_name', 'like', "%{$search}%");
        }

        if($search = request()->get('ls_search')){
            $query->where('ls_number', 'like', "%{$search}%");
        }

        // if($search = request()->get('status_search')){
        //     $query->where('status', 'like', "%{$search}%");
        // }

        return $query;
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
                        'url' => route('inatrade.daftar'),
                        'type' => 'GET',
                        'data' => 'function(d) {
                            d.ls_number = $("#ls_search").val();
                            d.ppbe_number  = $("#ppbe_search").val();
                            d.company_name_search = $(#"company_name_search").val();
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
            ['data' => 'id', 'name' => 'id', 'title' => 'NO','orderable' => false],
            ['data' => 'ls_number', 'name' => 'ls_number', 'title' => 'Nomor PPBE'],
            ['data' => 'ls_number', 'name' => 'ls_number', 'title' => 'Tanggal PPBE'],
            ['data' => 'company_name', 'name' => 'company_name', 'title' => 'Nama Surveyor'],
            ['data' => 'company_name', 'name' => 'company_name', 'title' => 'Jenis Intervensi'],
            ['data' => 'ls_number', 'name' => 'ls_number', 'title' => 'Eksportir'],
            ['data' => 'ls_number', 'name' => 'ls_number', 'title' => 'Lokasi Pemeriksaan'],
            ['data' => 'ls_number', 'name' => 'ls_number', 'title' => 'Tanggal Pemeriksaan'],
            Column::computed('Aksi')
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
        return 'Penugasan_' . date('YmdHis');
    }
}

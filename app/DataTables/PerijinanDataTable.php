<?php

namespace App\DataTables;

use Illuminate\Http\Request;
use App\Models\Perijinan;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\PerijinanModel;
use App\Models\PerijinanPEModel;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PerijinanDataTable extends DataTable
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
        ->editColumn('status', function($query) {
            $statusColor = 'warning';
            switch ($query['status']) {
                case '1':
                    $statusColor = 'primary';
                    break;
                case '0':
                    $statusColor = 'danger';
                    break;
            }
            switch($query['status']){
                case '1':
                    $status = "Aktif";
                    break;
                case '0';
                    $status = "Tidak Aktif";
                    break;
            }
            return '<span class="text-capitalize badge bg-'.$statusColor.'">'.$status.'</span>';
        })
        ->editColumn('pengajuan_date', function($query) {
            return date('Y/m/d',strtotime($query['pengajuan_date']));
        })
        ->filterColumn('pengajuan_code',function($query,$keyword){
            return $query->where('pengajuan_code','like',"%{$keyword}%");
        })
        ->addColumn('action', 'perijinan.action')
        ->rawColumns(['action', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Perijinan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $model = PerijinanModel::query();
        $query = $model->newQuery();

        if ($search = request()->get('company_name_search')) {
            $query->where('company_name', 'like', "%{$search}%");
        }


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
            ['data' => 'id', 'name' => 'id', 'title' => 'Number'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status Perijinan', 'orderable' => false],
            ['data' => 'nib', 'name' => 'nib', 'title' => 'NIB'],
            ['data' => 'company_name', 'name' => 'company_name', 'title' => 'Nama Perusahaan'],
            ['data' => 'nomor_et', 'name' => 'nomor_et', 'title' => 'Nomor ET'],
            ['data' => 'nomor_pe', 'name' => 'nomor_pe', 'title' => 'Nomor PE'],
            ['data' => 'company_npwp', 'name' => 'company_npwp', 'title' => 'NPWP'],
            ['data' => 'date_nib', 'name' => 'date_nib', 'title' => 'Tanggal NIB'],
            ['data' => 'company_email', 'name' => 'company_email', 'title' => 'E-mail'],
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
        return 'Perijinan_' . date('YmdHis');
    }
}

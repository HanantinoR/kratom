<?php

namespace App\DataTables;

use App\Models\Bcop;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BcopsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query);
            // ->addColumn('action', 'bcops.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Bcops $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return collect([
            ['id' => 1, 'status' => 'Penerimaan Dari Umum', 'surveyor' => 'Bangjago', 'tps_merah' => '.21', 'tps_hijau' => '0-0', 'lock_seal' => 'SCI 0-1', 'thread_seal'=> 'SCI--w'],
            ['id' => 2, 'status' => 'Penerimaan Dari Umum', 'surveyor' => 'Bangjago', 'tps_merah' => '.21', 'tps_hijau' => '0-0', 'lock_seal' => 'SCI 0-1', 'thread_seal'=> 'SCI--w'],
            ['id' => 3, 'status' => 'Penerimaan Dari Umum', 'surveyor' => 'Bangjago', 'tps_merah' => '.21', 'tps_hijau' => '0-0', 'lock_seal' => 'SCI 0-1', 'thread_seal'=> 'SCI--w'],
        ]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('bcops-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'status',
            'surveyor',
            'tps_merah',
            'tps_hijau',
            'lock_seal',
            'thread_seal',

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Bcops_' . date('YmdHis');
    }
}

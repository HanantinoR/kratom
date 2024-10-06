<?php

namespace App\DataTables;

use App\Models\PelabuhanMuat;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PelabuhanMuatDataTable extends DataTable
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
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return collect([
            ['id' => 1, 'kode' => 'BDG', 'nama_pelabuhan_muat' => 'JEPAR', 'kode_kantor' => '060300', 'nama_pendek_kantor' => 'KKPBC TMC SUCI', 'status' => 'Aktif', 'tanggal_update' => 'Hari Ini', 'aksi' => 'Placeholder'],
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
                    ->setTableId('pelabuhan_muat_list')
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
            'kode',
            'nama_pelabuhan_muat',
            'kode_kantor',
            'nama_pendek_kantor',
            'status',
            'tanggal_update',
            'aksi',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'PelabuhanMuat_' . date('YmdHis');
    }
}

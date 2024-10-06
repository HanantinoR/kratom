<?php

namespace App\DataTables;

use App\Models\KesimpulanPemeriksaan;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KesimpulanPemeriksaanDataTable extends DataTable
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
            ['id' => 1, 'kode' => 'SKK Terima', 'kesimpulan' => 'DAPAT DIEKSPOR SESUAI DENGAN KETENTUAN PERATURAN MENTERI PERDAGANGAN RI NO 23 TAHUN 2023 BESERTA PERUBAHANNYA', 'status' => 'Aktif', 'tanggal_update' => 'Hari Ini', 'aksi' => 'Placeholder'],
            ['id' => 2, 'kode' => 'SKK Tolak', 'kesimpulan' => 'TIDAK DAPAT DIEKSPOR SESUAI DENGAN KETENTUAN PERATURAN MENTERI PERDAGANGAN RI NO 23 TAHUN 2023', 'status' => 'Aktif', 'tanggal_update' => 'Hari Ini', 'aksi' => 'Placeholder'],
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
                    ->setTableId('kesimpulan_pemeriksaan_list')
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
            'kesimpulan',
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
        return 'KesimpulanPemeriksaan_' . date('YmdHis');
    }
}

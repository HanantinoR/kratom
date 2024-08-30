<?php

namespace App\DataTables;

use App\Models\Perijinan;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
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
    public function dataTable($query)
    {
        return datatables($query)
        ->editColumn('status', function($query) {
            $stutas = 'warning';
            switch ($query['status']) {
                case 'aktif':
                    $stutas = 'primary';
                    break;
                case 'tidak aktif':
                    $stutas = 'danger';
                    break;
            }
            return '<span class="text-capitalize badge bg-'.$stutas.'">'.$query['status'].'</span>';
        })
        ->addColumn('action', function($row) {
            return '<a href="#" class="btn btn-sm btn-primary">Edit</a>';
        })
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
        return collect([
            ['id' => 1, 'status' => 'aktif', 'nib' => '324877849', 'nama_perusahaan' => 'Wadidaw', 'provinsi' => 'Jawa Timur', 'kota' => 'Surabaya', 'jenis_usaha' => 'Kecil AF', 'kategori' => 'WF', 'tanggal_nib' => '12-07-2002', 'history' => 'Datataes'],
            ['id' => 2, 'status' => 'aktif', 'nib' => '128309183', 'nama_perusahaan' => 'Wadadiw', 'provinsi' => 'Jawa Barat', 'kota' => 'Banten', 'jenis_usaha' => 'Biasa aja', 'kategori' => 'GB', 'tanggal_nib' => '12-08-2022', 'history' => 'Kurang Aseli'],
            ['id' => 3, 'status' => 'tidak aktif', 'nib' => '724389827', 'nama_perusahaan' => 'Wadudiw', 'provinsi' => 'Jawa Tengah', 'kota' => 'Semarang', 'jenis_usaha' => 'Gede AF', 'kategori' => 'BI', 'tanggal_nib' => '21-01-2012', 'history' => 'Penyelundupan Illegal'],
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
                    ->setTableId('dataTable')
                    ->columns($this->getColumns())
                    ->addAction(['width' => '60px'])
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
            ['data' => 'id', 'name' => 'id', 'title' => 'id'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status Perijinan', 'orderable' => false],
            ['data' => 'nama_perusahaan', 'name' => 'nama_perusahaan', 'title' => 'Nama Perusahaan'],
            ['data' => 'provinsi', 'name' => 'provinsi', 'title' => 'Provinsi'],
            ['data' => 'kota', 'name' => 'kota', 'title' => 'Kota'],
            ['data' => 'jenis_usaha', 'name' => 'jenis_usaha', 'title' => 'Jenis Usaha'],
            ['data' => 'kategori', 'name' => 'kategori', 'title' => 'Kategori Ijin'],
            ['data' => 'tanggal_nib', 'name' => 'tanggal_nib', 'title' => 'Tanggal NIB'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status Ijin'],
            // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->searchable(false)
            //       ->width(60)
            //       ->addClass('text-center hide-search'),
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

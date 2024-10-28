<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\BcopsRedSealModel;
use App\Models\BcopsGreenSealModel;
use App\Models\BcopsLockSealModel;
use App\Models\BcopsThreadSealModel;
use App\Models\BcopsSurveyorModel;
// use App\Models\PPBEModel;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BcopsSurveyorDataTable extends DataTable
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
        ->addIndexColumn()
        ->editColumn('date_seal',function($row){
            // dd($row);
            return Carbon::parse($row->date_seal)->format('d M Y');
        })
        // ->addColumn('action',function($query){
            // return view('ls.action',[
                // 'id' => $query->hplps->id,
                // 'status' => $query->hplps_status,
                // 'code_above' => $query->code_above,
                // 'ls_id' => $query->ls_id
            // ]);
        // })
        // ->rawColumns(['action']);
            // ->addColumn('action', 'bcops.action')
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Bcops $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $model = BcopsSurveyorModel::leftjoin("bcops_red_seal","bcops_red_seal.id","=","bcops_surveyor.red_seal_id")
                                ->leftjoin("bcops_green_seal","bcops_green_seal.id","=","bcops_surveyor.green_seal_id")
                                ->leftjoin("bcops_lock_seal","bcops_lock_seal.id","=","bcops_surveyor.lock_seal_id")
                                ->leftjoin("bcops_thread_seal","bcops_thread_seal.id","=","bcops_surveyor.thread_seal_id")
                                ->join("users",'users.id','=','bcops_surveyor.surveyor_id')
                                ->select("bcops_surveyor.date_seal_surveyor","users.first_name",'users.last_name')
                                ->selectRaw("CONCAT(
                                    CASE
                                        WHEN bcops_red_seal.seal_series IS NULL OR bcops_red_seal.seal_series = '' THEN ''
                                        ELSE bcops_red_seal.seal_series
                                    END,
                                    ' ',
                                    CASE
                                        WHEN bcops_red_seal.seal_init IS NULL OR bcops_red_seal.seal_init = '' THEN '0'
                                        ELSE bcops_red_seal.seal_init
                                    END,
                                    '-',
                                    CASE
                                        WHEN bcops_red_seal.seal_finish IS NULL OR bcops_red_seal.seal_finish ='' THEN '0'
                                        ELSE bcops_red_seal.seal_finish
                                    END
                                    ) as red_seal")
                                ->selectRaw("CONCAT(
                                    CASE
                                        WHEN bcops_green_seal.seal_series IS NULL OR bcops_green_seal.seal_series = '' THEN ''
                                        ELSE bcops_green_seal.seal_series
                                    END,
                                    ' ',
                                    CASE
                                        WHEN bcops_green_seal.seal_init IS NULL OR bcops_green_seal.seal_init = '' THEN '0'
                                        ELSE bcops_green_seal.seal_init
                                    END,
                                    '-',
                                    CASE
                                        WHEN bcops_green_seal.seal_finish IS NULL OR bcops_green_seal.seal_finish ='' THEN '0'
                                        ELSE bcops_green_seal.seal_finish
                                    END
                                    )as green_seal")
                                ->selectRaw("CONCAT(
                                    CASE
                                        WHEN bcops_lock_seal.seal_series IS NULL OR bcops_lock_seal.seal_series = '' THEN ''
                                        ELSE bcops_lock_seal.seal_series
                                    END,
                                    ' ',
                                    CASE
                                        WHEN bcops_lock_seal.seal_init IS NULL OR bcops_lock_seal.seal_init = '' THEN '0'
                                        ELSE bcops_lock_seal.seal_init
                                    END,
                                    '-',
                                    CASE
                                        WHEN bcops_lock_seal.seal_finish IS NULL OR bcops_lock_seal.seal_finish ='' THEN '0'
                                        ELSE bcops_lock_seal.seal_finish
                                    END
                                    )as lock_seal")
                                ->selectRaw("CONCAT(
                                    CASE
                                        WHEN bcops_thread_seal.seal_series IS NULL OR bcops_thread_seal.seal_series = '' THEN ''
                                        ELSE bcops_thread_seal.seal_series
                                    END,
                                    ' ',
                                    CASE
                                        WHEN bcops_thread_seal.seal_init IS NULL OR bcops_thread_seal.seal_init = '' THEN '0'
                                        ELSE bcops_thread_seal.seal_init
                                    END,
                                    '-',
                                    CASE
                                        WHEN bcops_thread_seal.seal_finish IS NULL OR bcops_thread_seal.seal_finish ='' THEN '0'
                                        ELSE bcops_thread_seal.seal_finish
                                    END
                                    )as thread_seal")
                                ->selectRaw("CONCAT(users.first_name, '' ,users.last_name) as surveyor")
                                ->orderBy("bcops_surveyor.created_at","desc")
                                // ->selectRaw("DATE_FORMAT(bcops_umum.date_seal, '%d %b %Y') as date_seal")
                                ;
                $query = $model->newQuery();

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
            ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
            ['data' => 'surveyor', 'name' => 'surveyor', 'title' => 'Surveyor', 'searchable' => false],
            ['data' => 'date_seal_surveyor', 'name' => 'date_seal_surveyor', 'title' => 'Tanggal','searchable'=>false],
            ['data' => 'red_seal', 'name' => 'red_seal', 'title' => 'TPS Merah','searchable'=>false],
            ['data' => 'green_seal', 'name' => 'green_seal', 'title' => 'TPS Hijau','searchable'=>false],
            ['data' => 'lock_seal', 'name' => 'lock_seal', 'title' => 'Lock Seal','searchable'=>false],
            ['data' => 'thread_seal', 'name' => 'thread_seal', 'title' => 'Thread Seal','searchable'=>false],
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
        return 'Bcops_' . date('YmdHis');
    }
}


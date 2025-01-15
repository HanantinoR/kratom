<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            ->editColumn('full_name',function($query){
                // dd($query);
                return $query->first_name." ".$query->last_name;
            })
            ->editColumn('company.name', function($query) {
                return $query->name ?? '-';
            })
            ->editColumn('status', function($query) {
                // dd($query);
                $status = 'warning';
                switch ($query->status) {
                    case 'active':
                        $name = "Aktif";
                        $status = 'primary';
                        break;
                    case '1':
                        $name = "Aktif";
                        $status = "primary";
                        break;
                    case '0':
                        $name = "Tidak Aktif";
                        $status = "danger";
                        break;
                    case 'inactive':
                        $status = 'danger';
                        break;
                    case 'banned':
                        $status = 'dark';
                        break;
                }
                return '<span class="text-capitalize badge bg-'.$status.'">'.$name.'</span>';
            })
            // ->filterColumn('full_name', function($query, $keyword) {
            //     dd($query,$keyword);
            //     $sql = "CONCAT(users.first_name,' ',users.last_name)  like ?";
            //     return $query->whereRaw($sql, ["%{$keyword}%"]);
            // })
            // ->filterColumn('company.name', function($query, $keyword) {
            //     return $query->orWhereHas('userProfile', function($q) use($keyword) {
            //         $q->where('company_name', 'like', "%{$keyword}%");
            //     });
            // })
            // ->addColumn('action', 'users.action')
            ->addColumn('action',function($query){
                // dd($query);
                return view('users.action',[
                    'id' => $query->user_id,
                    'status' => $query->status
                ]);
            })
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
        // $model = User::query();

        $model = User::leftjoin('roles','roles.name',"=","users.user_type")
                    ->leftjoin('company','company.id',"=","users.company_id")
                    ->select('users.id as user_id','roles.id as role_id','roles.Title as user_role', 'users.email','users.status',
                        'company.name','users.first_name','users.last_name');
        // dd($model);
        $query = $model->newQuery();

        // if(auth()->user()->user_type !== "admin")
        // {
        //     // $model->where('branch_office',auth()->user()->branch_office);
        //     dd('a');
        // }
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
            ['data' => 'full_name', 'name' => 'full_name', 'title' => 'FULL NAME', 'orderable' => false],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'user_role', 'name' => 'user_role', 'title' => 'Role'],
            ['data' => 'company.name', 'name' => 'company.name', 'title' => 'Company'],
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
        return 'Users_' . date('YmdHis');
    }
}

<?php

namespace App\DataTables;

use App\Models\Role;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
{
    public function dataTable($query)
    {
        $datatable = datatables()->eloquent($query);
        $datatable = $datatable->addColumn('action', function ($query) {
            if(auth()->user()->can('permission-edit')) {
                    return '<a class="btn-sm btn-primary" href="' . route('roles.edit',  $query->id) . '"><i class="text-white far fa-edit"></i></a>'; 
                }
            });
        $datatable = $datatable->rawColumns(['action']);
        return $datatable;
    }

    public function query(Role $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('role-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0, 'asc')
                    ->paging(false)
                    ->searching(false)
                    ->selectStyleSingle();
    }

    protected function getColumns()
    {
        return [
            Column::make('id')->title('ID')->width(100),
            Column::make('name')->title(trans('Name')),
            Column::computed('action', trans('Action'))
                  ->exportable(false)
                  ->printable(false)
                  ->width(100)
                  ->addClass('text-center')
        ];
    }
}

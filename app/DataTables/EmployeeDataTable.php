<?php

namespace App\DataTables;

use App\Models\UserDetail;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;


class EmployeeDataTable extends DataTable
{
    public $modal_type;

    public function setModaltype($modal_type = '') { $this->modal_type = $modal_type; }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $column = new EloquentDataTable($query);
        $rawcolumns[] = 'status';
        $column = $column->addColumn('status', function ($query) {
            if ($query->status == 1) return '<div class="text-success">Active</div>';
            return '<div class="text-danger"> Deactive</div>';
        });
        
        $rawcolumns[] = 'created_at';
        $column = $column->addColumn('created_at', function ($query) {
            return $query->created;
        });
        $rawcolumns[] = 'action';
        $column = $column->addColumn('action', function ($query) {
            $tag = '';
            // if(auth()->user()->can('investment-edit')) {
                $tag .= '<a class="btn-sm btn-primary mr-1" href="' . route('employee.edit', $query->id) . '"><i class="far fa-edit"></i></a>';
            // }
            // if(auth()->user()->can('investment-view')) {
                $tag .= '<a class="btn-sm btn-primary showmodal text-white mr-1" data-toggle="modal" data-target="#'.$this->modal_type.'Id" data-link="' . route('employee.show', $query->id) . '"><i class="far fa-eye"></i></a>';
            // }
            return $tag;
        });
        return $column->rawColumns($rawcolumns);
    }

    public function query(UserDetail $model): QueryBuilder 
    {
        return $model->where('role', 7)->newQuery(); //role = employee from roles table
    }

    public function html(): HtmlBuilder
    {
        $html = $this->builder()->setTableId('employee-table')->scrollX(true)->columns($this->getColumns())->minifiedAjax()->orderBy(0)->selectStyleSingle();
        $html = $html->dom('Bfrtip')->buttons(
            Button::make('create')->text('<i class="fa fa-plus"></i>&nbsp;Create')->action("window.location = '".route('employee.create')."';")
        );
        return $html;
    }

    public function getColumns(): array
    {
        $column[] = Column::make('name')->title('Name')->width('275px')->orderable(true);
        $column[] = Column::make('occupation')->title('Designation')->width('275px')->orderable(true);
        $column[] = Column::make('phone')->title('Phone')->width('275px')->orderable(true);
        $column[] = Column::make('status')->title('Status')->width('275px')->orderable(false);
        $column[] = Column::make('created_at')->title('Register Date')->width('275px')->orderable(true);
        $column[] = Column::make('action')->title('Action')->width('200px')->orderable(false);
        return $column;
    }

    protected function filename(): string
    {
        return 'Employee_' . date('YmdHis');
    }
}

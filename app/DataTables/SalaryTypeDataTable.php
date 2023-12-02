<?php

namespace App\DataTables;

use App\Models\SalaryType;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SalaryTypeDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query) {
                if(auth()->user()->can('salary-type-edit')) {
                    $tag = '<a class="btn-sm btn-primary mr-1" href="' . route('type-salary.edit', $query->id) . '"><i class="far fa-edit"></i></a>';
                }
                if(auth()->user()->can('salary-type-delete')) {
                    $tag .= '<a class="btn-sm btn-danger mr-1 deleteSalaryType text-white" data-toggle="modal" data-target="#deleteSalaryTypeId" data-link="' . route('type-salary.delete-form', $query->id) . '"><i class="fa fa-trash"></i></a>';
                }
                return $tag;
            })
            ->addColumn('created_at', function ($query) {
                return $query->created;
            })
            ->addColumn('status', function ($query) {
                if ($query->status == 1) return '<div class="text-success">Active</div>';
                return '<div class="text-danger"> Deactive</div>';
            })
            ->rawColumns(['status', 'action', 'created_at']);

    }

    public function query(SalaryType $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        $html = $this->builder()->setTableId('salarytype-table')->columns($this->getColumns())->minifiedAjax()->orderBy(0)->selectStyleSingle();
        if(auth()->user()->can('new-salary-type')) {
            $html = $html->dom('Bfrtip')->buttons(
                Button::make('create')->text('<i class="fa fa-plus"></i>&nbsp;Create')
            );
        }
        return $html;
    }

    public function getColumns(): array
    {
        $column[] = Column::make('title')->title('Title')->width('200px');
        $column[] = Column::make('created_at')->title('Created At')->width('200px');
        $column[] = Column::make('status')->title('Status')->width('200px')->orderable(false);
        if(auth()->user()->canany(['salary-type-delete', 'salary-type-edit'])) {
            $column[] = Column::make('action')->title('Action')->width('200px')->orderable(false);
        }
        return $column;
    }

    protected function filename(): string
    {
        return 'SalaryType_' . date('YmdHis');
    }
}

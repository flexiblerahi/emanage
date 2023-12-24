<?php

namespace App\DataTables;

use App\Models\ExpenseItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ExpenseItemDataTable extends DataTable
{
    public $modal_type;

    public function setModaltype($modal_type = '')
    {
        $this->modal_type = $modal_type;
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
                ->addColumn('created_at', function ($query) {
                    return $query->created;
                })
                ->addColumn('action', function($query) {
                    $tag = '';
                    if(auth()->user()->can('expense-type-edit')) {
                        $tag .= '<a class="btn-sm btn-primary mr-1 editExpenseItem text-white" data-toggle="modal" data-target="#editExpenseId" data-link="' . route('expense-item.edit', $query->id) . '"><i class="text-white far fa-edit"></i></a>';
                    }
                    if(auth()->user()->can('expense-type-delete')) {
                        if($query->status == 0) {
                            $tag .= '<a class="btn-sm btn-danger mr-1 deleteExpenseItem text-white" data-toggle="modal" data-target="#deleteExpenseId" data-link="' . route('expense-item.delete-form', $query->id) . '"><i class="text-white fa fa-trash"></i></a>';
                        }
                    }
                    return $tag;
                })
                ->rawColumns(['created_at', 'action', 'entry']);
    }

    public function query(ExpenseItem $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        $builder =  $this->builder()
                    ->setTableId('expenseitem-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0)
                    ->selectStyleSingle();
        if(auth()->user()->can('new-expense-type')) {
            $builder = $builder->dom('Bfrtip')->buttons([ Button::make('create')->text('<i class="text-white fa fa-plus"></i>&nbsp;Create') ]);
        }
        return $builder;
    }

    public function getColumns(): array
    {
        $columns = [
            Column::make('id'),
            Column::make('title'),
            Column::make('created_at'),
        ];
        if(auth()->user()->canany(['bank-info-delete', 'bank-info-edit'])) {
            $columns[] = Column::make('action')->width('100px')->orderable(false);
        }
        return $columns;
    }

    protected function filename(): string
    {
        return 'ExpenseItem_' . date('YmdHis');
    }
}

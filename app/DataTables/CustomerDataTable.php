<?php

namespace App\DataTables;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CustomerDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $column = new EloquentDataTable($query);
        $rawcolumns[] = 'account_id';
        $column = $column->addColumn('account_id', function ($query) {
                    if(is_null($query->account_id)) {
                        return '<p class="text-danger">Not Entry Yet.</p>';
                    }
                    return '<p>'.$query->account_id.'</p>';
                });
        $rawcolumns[] = 'created_at';
        $column = $column->addColumn('created_at', function ($query) {
                    return '<p>'.$query->created.'</p>';
                });
        $rawcolumns[] = 'status';
        $column = $column->addColumn('status', function ($query) {
                    return ($query->status == 1) ? '<div class="text-success">Active</div>' : '<div class="text-danger"> Deactive</div>';
                });
        if(auth()->user()->canany(['customer-view', 'customer-edit'])) {
            $rawcolumns[] = 'action';
            $column = $column->addColumn('action', function ($query) {
                        $tag = '';
                        if(auth()->user()->can('customer-view')) {
                            $tag .= '<a class="btn-sm btn-primary showmodal text-white mr-1" data-role="customer" data-toggle="modal" data-target="#customerId" data-link="' . route('customer.show', $query->id) . '"><i class="far fa-eye"></i></a>';
                        }
                        if(auth()->user()->can('customer-edit')) {
                            $tag .= '<a class="btn-sm btn-primary" href="' . route('customer.edit', $query->id) . '"><i class="far fa-edit"></i></a>';
                        }
                        return $tag;
                    });
        }
        return $column->rawColumns($rawcolumns);
    }

    public function query(Customer $model): QueryBuilder
    {
        return $model->latest();
    }

    public function html(): HtmlBuilder
    {
        $html = $this->builder()->setTableId('customer-table')->scrollX(true)->columns($this->getColumns())->minifiedAjax()->orderBy(5)->selectStyleSingle();
        if(auth()->user()->can('new-customer')) {
            $html = $html->dom('Bfrtip')->buttons(
                Button::make('create')->text('<i class="fa fa-plus"></i>&nbsp;Create')
            );
        }
        return $html;
    }

    public function getColumns(): array
    {
        $column[] = Column::make('id')->title('ID')->orderable(true);
        $column[] = Column::make('account_id')->title('Account Id')->width('200px')->orderable(true);
        $column[] = Column::make('name')->title('Name')->orderable(true);
        $column[] = Column::make('phone')->width('200px')->orderable(false);
        $column[] = Column::make('status')->width('100px')->orderable(false);
        $column[] = Column::make('created_at')->title('Register Date')->width('200px')->orderable(false);
        if(auth()->user()->canany(['customer-view', 'customer-edit'])) {
            $column[] = Column::make('action')->title('Action')->width('200px')->orderable(false);
        }
        return $column;
    }

    protected function filename(): string
    {
        return 'Customer_' . date('YmdHis');
    }
}

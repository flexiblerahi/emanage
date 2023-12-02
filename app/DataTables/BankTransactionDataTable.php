<?php

namespace App\DataTables;

use App\Models\BankTransaction;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BankTransactionDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('updated_at', function ($query) {
                return \Carbon\Carbon::parse($query->updated_at)->format('d M Y');
            })
        ->rawColumns(['created_at']);
    }

    public function query(BankTransaction $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        $builder = $this->builder()
                    ->setTableId('banktransaction-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle();
        $builder = $builder->dom('Bfrtip')
                    ->buttons([
                        Button::make('create')->text('<i class="fa fa-plus"></i>&nbsp;Create')
                    ]);

        return $builder;
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('account_id'),
            Column::make('created_at'),
            Column::make('updated_at')
        ];
    }

    protected function filename(): string
    {
        return 'BankTransaction_' . date('YmdHis');
    }
}

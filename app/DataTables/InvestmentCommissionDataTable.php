<?php

namespace App\DataTables;

use App\Models\InvestmentCommission;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class InvestmentCommissionDataTable extends DataTable
{
    public $id;

    public function setId($id = '') {
        $this->id = $id;
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('created_at', function ($query) {
                return $query->created;
            })
            ->addColumn('amount', function ($query) {
                return tk($query->amount);
            })
            ->filterColumn('amount', function($query, $keyword) {
                $query->whereRaw("amount like ?", ["%{$keyword}%"]);
            })
            ->addColumn('invest_at', function ($query) {
                return getdateformat($query->investment->invest_at);
            })
            ->rawColumns(['created_at', 'invest_at', 'amount']);
    }

    public function query(InvestmentCommission $model): QueryBuilder
    {
        return $model->where('investment_id', $this->id);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('investmentcommission-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->searchPanes(false)
                    // ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('amount')->name('amount')->title('Amount')->searchable(true),
            Column::make('created_at')->title('Interest at')->orderable(false)
        ];
    }

    protected function filename(): string
    {
        return 'InvestmentCommission_' . date('YmdHis');
    }
}

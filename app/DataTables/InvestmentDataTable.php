<?php

namespace App\DataTables;

use App\Models\Investment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class InvestmentDataTable extends DataTable
{
    public $modal_type;

    public function setModaltype($modal_type = '')
    {
        $this->modal_type = $modal_type;
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

        return (new EloquentDataTable($query))
                ->addColumn('amount', function ($query) {
                    return tk($query->bank_transaction->amount);
                })
                ->addColumn('invest_at', function ($query) {
                    return getdateformat($query->invest_at);
                })
                ->addColumn('action', function($query) {
                    $tag = '';
                    if(auth()->user()->can('investment-edit')) {
                        $tag .= '<a class="btn-sm btn-primary mr-1" href="' . route('investment.edit', $query->id) . '"><i class="far fa-edit"></i></a>';
                    }
                    if(auth()->user()->can('investment-view')) {
                        $tag .= '<a class="btn-sm btn-primary showmodal text-white mr-1" data-toggle="modal" data-target="#'.$this->modal_type.'Id" data-link="' . route('investment.show', $query->id) . '"><i class="far fa-eye"></i></a>';
                    }
                    return $tag;
                })
                ->addColumn('rate', function($query) {
                    return '<p>'. $query->rate.' %</p>';
                })
                ->addColumn('name', function($query) {
                    return '<p>'.$query->investor->name.'</p>';
                })
                ->addColumn('phone', function($query) {
                    return '<p>'.$query->investor->phone.'</p>';
                })
                ->addColumn('commission', function($query) {
                    return '<a class="btn btn-primary" href="'.route('investment-base.commission', $query->id).'">'.$query->account_id.'</a>';
                })
                ->rawColumns(['action', 'invest_at', 'amount', 'name', 'phone', 'rate', 'commission']);
    }

    public function query(Investment $model): QueryBuilder
    {
        return $model->with('investor', 'bank_transaction')->latest();
    }

    public function html(): HtmlBuilder
    {
        $build = $this->builder()
                        ->setTableId('investment-table')
                        ->columns($this->getColumns())
                        ->minifiedAjax()
                        ->orderBy(1)
                        ->selectStyleSingle();
        if(auth()->user()->can('new-investment')) {
            $build = $build->dom('Bfrtip')->buttons([ Button::make('create')->text('<i class="fa fa-plus"></i>&nbsp;Create') ]);
        }
        return $build;
    }

    public function getColumns(): array
    {
        $columns =  [
            Column::make('id'),
            Column::make('rate'),
            Column::make('amount')->name('bank_transaction.amount')->title('Amount')->orderable(false),
            Column::make('name')->name('investor.name')->title('Investor Name')->orderable(false),
            Column::make('phone')->name('investor.phone')->orderable(false),
            Column::make('invest_at')->title('Invest at'),
        ];
        if(auth()->user()->canany(['investment-view', 'investment-edit'])) {
            $columns[] = Column::make('action')->orderable(false);
        }
        $columns[] = Column::make('commission')->title('Commissions');
        return $columns;
    }

    protected function filename(): string
    {
        return 'Investment_' . date('YmdHis');
    }
}

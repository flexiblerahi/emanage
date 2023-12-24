<?php

namespace App\DataTables;

use App\Models\Deposit;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DepositDataTable extends DataTable
{
    public $modal_type;

    public function setModaltype($modal_type = '') { $this->modal_type = $modal_type; }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
                ->addColumn('amount', function ($query) {
                    return tk($query->bank_transaction->amount);
                })
                ->addColumn('date', function ($query) {
                    return getdateformat($query->bank_transaction->date);
                })
                ->addColumn('other', function($query) {
                    return is_null($query->other) ? '<p class="text-danger">No Info Added!</p>' : $query->other;
                })
                ->addColumn('action', function($query) {
                    $tag = '';
                    if(auth()->user()->can('other-deposit-edit')) {
                        $tag .= '<a class="btn-sm btn-primary mr-1" href="' . route('deposit-other.edit', $query->id) . '"><i class="text-white far fa-edit"></i></a>';
                    }
                    if(auth()->user()->can('other-deposit-view')) {
                        $tag .= '<a class="btn-sm btn-primary showmodal text-white mr-1" data-toggle="modal" data-target="#'.$this->modal_type.'Id" data-link="' . route('deposit-other.show', $query->id) . '"><i class="text-white far fa-eye"></i></a>';
                    }
                    return $tag;
                })
                ->rawColumns(['action', 'date', 'amount', 'other']);
    }

    public function query(Deposit $model): QueryBuilder
    {
        return $model->with('bank_transaction')->latest();
    }

    public function html(): HtmlBuilder
    {
        $build = $this->builder()
                        ->setTableId('otherdeposit-table')
                        ->columns($this->getColumns())
                        ->minifiedAjax()
                        ->orderBy(1)
                        ->selectStyleSingle();
        if(auth()->user()->can('new-other-deposit')) {
            $build = $build->dom('Bfrtip')->buttons([ Button::make('create')->text('<i class="text-white fa fa-plus"></i>&nbsp;New Deposit') ]);
        }
        return $build;
    }

    public function getColumns(): array
    {
        $columns =  [
            Column::make('account_id')->orderable(true),
            Column::make('other')->title('Other Info')->orderable(true),
            Column::make('amount')->name('bank_transaction.amount')->title('Amount')->orderable(false),
            Column::make('date')->name('bank_transaction.date')->title('Deposit at')->orderable(false),
        ];
        if(auth()->user()->canany(['other-deposit-view', 'other-deposit-edit'])) {
            $columns[] = Column::make('action')->orderable(false);
        }
        return $columns;
    }

    protected function filename(): string
    {
        return 'OtherDeposit_' . date('YmdHis');
    }
}

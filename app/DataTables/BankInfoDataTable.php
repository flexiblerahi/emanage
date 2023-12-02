<?php

namespace App\DataTables;

use App\Models\BankInfo;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BankInfoDataTable extends DataTable
{
    public $modal_type;

    public function setModaltype($modal_type = '') {
        $this->modal_type = $modal_type;
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('created_at', function ($query) {
                return $query->created;
            })
            ->addColumn('name', function ($query) {
                return '<p>'.$query->bankname->name.'</p>';
            })
            ->addColumn('action', function($query) {
                $tag = '';
                if(auth()->user()->can('bank-info-edit') && ($query->bank_name_id != 1)) {
                    $tag .= '<a class="btn-sm btn-primary mr-1" href="' . route('bank-info.edit', $query->id) . '"><i class="far fa-edit"></i></a>';
                }
                if(auth()->user()->can('bank-info-view')) {
                    $tag .= '<a class="btn-sm btn-primary showmodal text-white mr-1" data-toggle="modal" data-target="#'.$this->modal_type.'Id" data-link="' . route('bank-info.show', $query->id) . '"><i class="far fa-eye"></i></a>';
                }
                return $tag;
            })
            ->addColumn('status', function($query) {
                return setStatus($query->status);
            })
            ->addColumn('amount', function($query) {
                return tk($query->amount);
            })
            ->rawColumns(['created_at', 'amount', 'action', 'status']);
    }

    public function query(BankInfo $model): QueryBuilder
    {
        return $model->with('bankname')->newQuery();
    }

    public function html(): HtmlBuilder
    {
        $builder = $this->builder()
                    ->setTableId('bank-info-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0)
                    ->selectStyleSingle();
        if(auth()->user()->can('new-bank-info')) {
            $builder = $builder->dom('Bfrtip')->buttons([ Button::make('create')->text('<i class="fa fa-plus"></i>&nbsp;Create') ]);
        }
        return $builder;
    }

    public function getColumns(): array
    {
        $columns = [
            Column::make('id'),
            Column::make('account_id'),
            Column::make('bankname.name')->title('Name')->orderable(false),
            Column::make('amount'),
            Column::make('created_at'),
            Column::make('status')->orderable(false)
        ];
        if(auth()->user()->canany(['bank-info-view', 'bank-info-edit'])) {
            $columns[] = Column::make('action')->orderable(false);
        }
        return $columns;
    }

    protected function filename(): string
    {
        return 'BankInfo_' . date('YmdHis');
    }
}

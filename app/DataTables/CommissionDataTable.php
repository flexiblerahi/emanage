<?php

namespace App\DataTables;

use App\Models\Commission;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CommissionDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('type', function($query) {
                return \App\Models\Commission::NAMES[$query->type];
            })
            ->addColumn('user', function($query) {
                return $query->user_detail->name;
            })
            ->addColumn('action', function ($query) {
                $tag = '';
                if(auth()->user()->can('commission-edit')) {
                    $tag .= '<a class="btn-sm btn-primary mr-1" href="' . route('commission.edit',  $query->id) . '"><i class="far fa-edit"></i></a>';
                }
                if(auth()->user()->can('commission-view')) {
                    $tag .= '<a class="btn-sm btn-primary commission text-white" data-toggle="modal" data-target="#commissionId" data-link="' . route('commission.show',  $query->id) . '"><i class="far fa-eye"></i></a>';
                }
                return $tag;
            })
            ->addColumn('created_at', function ($query) {
                return $query->created;
            })
            ->addColumn('updated_at', function ($query) {
                return $query->updated;
            })
             ->skipPaging()
            ->setRowId('id');
    }

    public function query(Commission $model): QueryBuilder
    {
        return $model->with('user_detail');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('commission-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->paging(false)
                    ->searching(false)
                    ->selectStyleSingle()
                    ->buttons(
                        Button::make('create')->text('<i class="fa fa-plus"></i>&nbsp;Create')
                    );
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->title('Sl No.')->orderable(false),
            Column::make('type')->title('Type')->orderable(false),
            Column::make('user')->title('User Name')->orderable(false),
            Column::make('created_at')->width('200px')->orderable(false),
            Column::make('updated_at')->width('200px')->orderable(false),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')->width('100px')->orderable(false),
        ];
    }

    protected function filename(): string
    {
        return 'Commission_' . date('YmdHis');
    }
}

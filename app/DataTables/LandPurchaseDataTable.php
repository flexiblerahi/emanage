<?php

namespace App\DataTables;

use App\Models\LandPurchase;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LandPurchaseDataTable extends DataTable
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
            ->addColumn('updated_at', function ($query) {
                return $query->updated;
            })
            ->addColumn('amount', function ($query) {
                return tk($query->amount);
            })
            ->addColumn('entry', function($query) {
                return '<p>'.$query->entrier->name.'('.$query->entrier->account_id.')</p>';
            })
            ->addColumn('action', function($query) {
                $tag = '';
                if(auth()->user()->can('land-purchase-edit')) {
                    $tag .= '<a class="btn-sm btn-primary mr-1" href="' . route('land-purchase.edit', $query->id) . '"><i class="far fa-edit"></i></a>';
                }
                if(auth()->user()->can('land-purchase-view')) {
                    $tag .= '<a class="btn-sm btn-primary showmodal text-white mr-1" data-toggle="modal" data-target="#'.$this->modal_type.'Id" data-link="' . route('land-purchase.show', $query->id) . '"><i class="far fa-eye"></i></a>';
                }
                return $tag;
            })
            ->rawColumns(['created_at', 'updated_at', 'amount', 'action', 'entry']);
    }

    public function query(LandPurchase $model): QueryBuilder
    {
        return $model->with('entrier:id,name,account_id')->latest();
    }

    public function html(): HtmlBuilder
    {
        $builder = $this->builder()
                    ->setTableId('landpurchase-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle();
        if(auth()->user()->can('new-land-purchase')) {
            $builder = $builder->dom('Bfrtip')->buttons([
                Button::make('create')->text('<i class="fa fa-plus"></i>&nbsp;Create'),
            ]);
        }
        return $builder;
    }

    public function getColumns(): array
    {
        $columns =  [
            Column::make('id'),
            Column::make('land'),
            Column::make('amount'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::make('entry')->width('100px')->orderable(false),
        ];
        if(auth()->user()->canany(['land-purchase-view', 'land-purchase-edit'])) {
            $columns[] = Column::make('action')->orderable(false);
        }
        return $columns;
    }

    protected function filename(): string
    {
        return 'LandPurchase_' . date('YmdHis');
    }
}

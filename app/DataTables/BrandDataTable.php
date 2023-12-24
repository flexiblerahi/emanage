<?php

namespace App\DataTables;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BrandDataTable extends DataTable
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
                return \Carbon\Carbon::parse($query->created_at)->format('d M Y');
            })
            ->addColumn('action', function($query) {
                $tag = '';
                // if(auth()->user()->can('investment-edit')) {
                    $tag .= '<a class="btn-sm btn-success mr-1 editbrand text-white" data-toggle="modal" data-target="#createBrandId" data-link="' . route('brand.edit', $query->id) . '"><i class="text-white far fa-edit"></i></a>';
                // }
                // if(auth()->user()->can('investment-view')) {
                    $tag .= '<a class="btn-sm btn-primary showmodal text-white mr-1" data-toggle="modal" data-target="#'.$this->modal_type.'Id" data-link="' . route('brand.show', $query->id) . '"><i class="text-white far fa-eye"></i></a>';
                // }
                return $tag;
            })
            ->rawColumns(['action', 'created_at', 'status']);
    }

    public function query(Brand $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        $html = $this->builder()->setTableId('brand-table')->columns($this->getColumns())->minifiedAjax()->orderBy(0)->selectStyleSingle();
        // if(in_array($this->user, ['agent', 'customer']) && auth()->user()->can('new-'.$this->user)) {
            $html = $html->dom('Bfrtip')->buttons(
                Button::make('create')->text('<i class="text-white fa fa-plus"></i>&nbsp;Create')->action('function() { $("#createBrandId").modal("show"); }')
            );
        // }
        return $html;
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('created_at'),
            Column::computed('action')->orderable(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Brand_' . date('YmdHis');
    }
}

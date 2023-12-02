<?php

namespace App\DataTables;

use App\Models\BankName;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BankNameDataTable extends DataTable
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
            ->addColumn('status', function ($query) {
                return setStatus($query->status);
            })
            ->addColumn('action', function($query) {
                $tag = '';
                // if(auth()->user()->can('investment-edit')) {
                    $tag .= '<a class="btn-sm btn-success mr-1 editbank text-white" data-toggle="modal" data-target="#createBankId" data-link="' . route('bank-name.edit', $query->id) . '"><i class="far fa-edit"></i></a>';
                // }
                // if(auth()->user()->can('investment-view')) {
                    $tag .= '<a class="btn-sm btn-primary showmodal text-white mr-1" data-toggle="modal" data-target="#'.$this->modal_type.'Id" data-link="' . route('bank-name.show', $query->id) . '"><i class="far fa-eye"></i></a>';
                // }
                return $tag;
            })
            ->rawColumns(['action', 'created_at', 'status']);
    }

    public function query(BankName $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        $html = $this->builder()->setTableId('bankname-table')->columns($this->getColumns())->minifiedAjax()->orderBy(0)->selectStyleSingle();
        // if(in_array($this->user, ['agent', 'customer']) && auth()->user()->can('new-'.$this->user)) {
            $html = $html->dom('Bfrtip')->buttons(
                Button::make('create')->text('<i class="fa fa-plus"></i>&nbsp;Create')->action('function() { $("#createBankId").modal("show"); }')
            );
        // }
        return $html;
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('status')->orderable(false),
            Column::make('created_at'),
            Column::computed('action')->orderable(false),
        ];
    }

    protected function filename(): string
    {
        return 'BankName_' . date('YmdHis');
    }
}

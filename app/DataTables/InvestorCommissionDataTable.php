<?php

namespace App\DataTables;

use App\Models\InvestmentCommission;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class InvestorCommissionDataTable extends DataTable
{
    public $id;
    public $modal_type;

    public function setModaltype($modal_type = '')
    {
        $this->modal_type = $modal_type;
    }

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
            ->addColumn('invest_at', function ($query) {
                return getdateformat($query->investment->invest_at);
            })
            ->addColumn('action', function($query) {
                $tag = '';
                if(auth()->user()->can('investment-view')) {
                    $tag .= '<a class="btn-sm btn-primary showmodal text-white mr-1" data-toggle="modal" data-target="#'.$this->modal_type.'Id" data-link="' . route('investment.show', $query->investment->id) . '">Investment Details</a>';
                }
                return $tag;
            })
            ->rawColumns(['created_at', 'invest_at', 'amount', 'action']);
    }

    public function query(InvestmentCommission $model): QueryBuilder
    {
        return $model->with('investment')->where('investor_id', $this->id);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('investorcommission-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('amount')->title('Amount'),
            Column::make('created_at')->title('Interest at'),
            Column::make('investment.account_id')->name('investment.account_id')->title('Investment Account No.')->orderable(false),
            Column::make('invest_at')->name('investment.invest_at')->title('Invest at')->orderable(false),
            Column::make('action')->title('Action')->orderable(false),
        ];
    }

    protected function filename(): string
    {
        return 'InvestorCommission_' . date('YmdHis');
    }
}

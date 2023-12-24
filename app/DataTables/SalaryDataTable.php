<?php

namespace App\DataTables;

use App\Models\Salary;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SalaryDataTable extends DataTable
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
                return tk(abs($query->bank_transaction->amount));
            })
            ->addColumn('phone', function ($query) {
                return $query->user->phone;
            })
            ->addColumn('type', function ($query) {
                return (is_null($query->type_id)) ? 'Salary' : $query->type->title;
            })
            ->addColumn('created_at', function ($query) {
                return $query->created;
            })
            ->addColumn('action', function($query) {
                $tag = '';
                if(auth()->user()->can('salary-edit')) {
                    $tag .= '<a class="btn-sm btn-primary mr-1" href="' . route('salary.edit', $query->id) . '"><i class="text-white far fa-edit"></i></a>';
                }
                if(auth()->user()->can('salary-view')) {
                    $tag .= '<a class="btn-sm btn-primary showmodal text-white mr-1" data-toggle="modal" data-target="#'.$this->modal_type.'Id" data-link="' . route('salary.show', $query->id) . '"><i class="text-white far fa-eye"></i></a>';
                }
                return $tag;
            })
            ->rawColumns(['action', 'user_details_id', 'created_at', 'amount']);
    }

    public function query(Salary $model): QueryBuilder
    {
        return $model->with('type', 'bank_transaction', 'user')->latest();
    }

    public function html(): HtmlBuilder
    {
        $builder = $this->builder()
                    ->setTableId('salary-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0)
                    ->selectStyleSingle();
        // if(auth()->user()->can('new-withdraw')) {
            $builder = $builder->dom('Bfrtip')->buttons([Button::make('create')]);
        // }
        return $builder;
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('created_at'),
            Column::make('type')->name('type.title')->title('Type')->orderable(false),
            Column::make('amount')->name('bank_transaction.amount')->title('Amount')->orderable(false),
            Column::make('phone')->name('user.phone')->title('Phone No.')->orderable(false),
            Column::computed('action')->orderable(false),
        ];
    }

    protected function filename(): string
    {
        return 'Salary_' . date('YmdHis');
    }
}

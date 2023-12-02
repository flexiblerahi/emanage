<?php

namespace App\DataTables;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PaymentDataTable extends DataTable
{
    private $sale;
    
    public function __construct() {
        $this->sale = request()->get('sale');
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('commission_type', function($query) {
            return '<p>'. str_replace("_", " ", ucwords($query->commission_type, "_")) .'</p>';
        })
        ->addColumn('action', function($query) {
            $tag = '';
            if(auth()->user()->can('old-payment-edit')) {
                $tag .= '<a class="btn-sm btn-primary mr-1" href="' . route('deposit-payment.edit', $query->id) . '"><i class="far fa-edit"></i></a>';
            }
            return $tag;
        })
        ->addColumn('amount', function($query) {
            return '<p>'. $query->bank_transaction->amount . '</p>';
        })
        ->addColumn('pay_at', function($query) {
            return '<p>'. $query->bank_transaction->date . '</p>';
        })
        ->addColumn('created_at', function ($query) {
            return $query->created;
        })
        ->rawColumns(['action', 'amount', 'created_at', 'pay_at', 'commission_type']);
    }

    public function query(Payment $model): QueryBuilder
    {
        return $model->with('bank_transaction:model_id,model_type,amount,date')->where('sale_id', $this->sale)->latest();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('payment-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('commission_type')->title('Commission Type'),
            Column::make('amount')->name('bank_transaction.amount')->title('Amount')->orderable(false),
            Column::make('pay_at')->name('bank_transaction.date')->title('Pay at')->orderable(false),
            Column::make('created_at')->title('Created at'),
            Column::computed('action'),
        ];
    }

    protected function filename(): string
    {
        return 'Payment_' . date('YmdHis');
    }
}

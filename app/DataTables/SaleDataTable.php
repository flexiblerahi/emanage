<?php

namespace App\DataTables;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SaleDataTable extends DataTable
{
    public $modal_type;

    public function setModaltype($modal_type = '') {
        $this->modal_type = $modal_type;
    }
    
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('field_details', function($query) {
                $tag = '<p><b>Sector:</b>'. $query->sector;
                $tag .= ', <b>Block:</b>'.$query->block;
                $tag .= ', <b>Road:</b>'. $query->road;
                $tag .= ', <b>Price:</b>'. $query->price;
                $tag .= ', <b>Katha:</b>'. $query->kata;
                $tag .= ', <b>Plot:</b>'.$query->plot. '</p>';
                return $tag;
            })
            ->filterColumn('field_details', function($query, $keyword) {
                $query->whereRaw("CONCAT(sector, ' ', block, ' ', road, ' ', plot) like ?", ["%{$keyword}%"]);
            })
            ->addColumn('customer', function($query) {
                $customer = $query->customer;
                return '<p><b>Name: </b>'. $customer->name.'<br><b>Phone: </b>'. $customer->phone.'</p>';
            })
            ->addColumn('shareholder', function($query) {
                $shareholder = $query->shareholder;
                return '<p><b>Name: </b>'. $shareholder->name.'<br><b>Phone: </b>'. $shareholder->phone.'</p>';
            })
            
            ->addColumn('agent', function($query) {
                $agent = $query->agent;
                return is_null($agent) ? '' : '<p><b>Name: </b>'. $agent->name.'<br><b>Phone: </b>'. $agent->phone.'</p>';
            })
            ->addColumn('action', function($query) {
                $tag = '';
                if(str_contains(url()->current(), 'payment')) {
                    if(auth()->user()->can('new-payment')) {
                        $tag .= '<a class="btn-sm btn-success text-white mr-1" href="'.route('deposit-payment.create', ['sale' => $query->uuid]).'">New</a>';
                    }
                    if(auth()->user()->can('old-payment-list')) {
                        $tag .= '<a class="btn-sm btn-primary text-white" href="'.route('old-payment', ['sale' => $query->id]).'">History</a>';
                    }
                } else {
                    if(auth()->user()->can('sale-view')) {
                        $tag .= '<a class="btn-sm btn-success showmodal text-white mr-1" data-toggle="modal" data-role="sale" data-target="#saleId" data-link="'.route('sale.show', $query->id).'"><i class="far fa-eye"></i></a>';
                    }
                    if(auth()->user()->can('sale-edit')) {
                        $tag .= '<a class="btn-sm btn-primary mr-1" href="' . route('sale.edit', $query->id) . '"><i class="far fa-edit"></i></a>';
                    }
                }
                return $tag;
            }) 
            ->rawColumns(['field_details', 'customer', 'shareholder', 'agent', 'action']);
    }

    public function query(Sale $model): QueryBuilder
    {
        return $model->with('customer', 'shareholder', 'agent')->latest()->newQuery();
    }

    public function html(): HtmlBuilder
    {
        $builder = $this->builder()->setTableId('sale-table')->columns($this->getColumns())->minifiedAjax()->scrollX(true)->orderBy(0)->selectStyleSingle();
        if(str_contains(url()->current(), 'sale')) {
            if(auth()->user()->can('new-sale')) {
                $buttons[] = Button::make('create')->text('<i class="fa fa-plus"></i>&nbsp;Create Sale'); }
            if(auth()->user()->can('report-sale-total')) {
                $buttons[] = Button::make('pdf')->addClass('btn btn-primary')->text('Total Sale Report')->name('pdf')->attr(['data-toggle' => 'modal','data-target' => '#shareholderId'])->action('function(){}');
            }
            if(auth()->user()->canany(['new-sale', 'report-sale-total'])) {
                $builder = $builder->dom('Bfrtip')->buttons($buttons);
            }
        } else {
            if(auth()->user()->can('report-sale-total')) {
                $builder = $builder->dom('Bfrtip')->buttons([
                    Button::make('pdf')
                        ->addClass('btn btn-primary')
                        ->text('Total Deposit Report')
                        ->name('pdf')
                        ->attr([
                            'data-toggle' => 'modal',
                            'data-target' => '#depositId',
                        ])
                        ->action('function(){}')
                ]);
            }
        }
        return $builder;
    }

    public function getColumns(): array
    {
        $columns[] = Column::make('id');
        $columns[] = Column::make('field_details')->title('Description of land')->orderable(false);
        $columns[] = Column::make('customer')->name('customer.phone')->title('Customer')->orderable(false);
        $columns[] = Column::make('shareholder')->name('shareholder.phone')->title('Master Agent')->orderable(false);
        $columns[] = Column::make('agent')->name('agent.phone')->title('Agent')->orderable(false);
        if(str_contains(url()->current(), 'payment')) {
            $columns[] = Column::make('action')->title('Payment')->width('120px')->orderable(false);
        } else {
            $columns[] = Column::make('action')->title('Action')->width('70px')->orderable(false);
        }
        return $columns;
    }

    protected function filename(): string
    {
        return 'Sale_' . date('YmdHis');
    }
}

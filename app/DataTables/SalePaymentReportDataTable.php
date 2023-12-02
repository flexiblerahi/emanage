<?php

namespace App\DataTables;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SalePaymentReportDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $columns = [];
        $sections = (new EloquentDataTable($query));
        $columns[] = 'field_details';
        $sections = $sections->addColumn('field_details', function($query) {
            $tag = '<p><b>Sector:</b>'. $query->sector;
            $tag .= ', <b>Block:</b>'.$query->block;
            $tag .= ', <b>Road:</b>'. $query->road;
            $tag .= ', <b>Price:</b>'. $query->price;
            $tag .= ', <b>Katha:</b>'. $query->kata;
            $tag .= ', <b>Plot:</b>'.$query->plot. '</p>';
            return $tag;
        })->filterColumn('field_details', function($query, $keyword) {
            $query->whereRaw("CONCAT(sector, ' ', block, ' ', road, ' ', plot) like ?", ["%{$keyword}%"]);
        });
        
        $columns[] = 'customer';
        $sections = $sections->addColumn('customer', function($query) {
            $customer = $query->customer;
            return '<p><b>Name: </b>'. $customer->name.'<br><b>Phone: </b>'. $customer->phone.'</p>';
        });
        
        $columns[] = 'shareholder';
        $sections = $sections->addColumn('shareholder', function($query) {
            $shareholder = $query->shareholder;
            return '<p><b>Name: </b>'. $shareholder->name.'<br><b>Phone: </b>'. $shareholder->phone.'</p>';
        });

        $columns[] = 'agent';
        $sections = $sections->addColumn('agent', function($query) {
            $agent = $query->agent;
            return is_null($agent) ? '' : '<p><b>Name: </b>'. $agent->name.'<br><b>Phone: </b>'. $agent->phone.'</p>';
        });
        
        $columns[] = 'action';
        $sections = $sections->addColumn('action', function($query) {
            $tag = '';
            $tag .= '<a class="btn-sm btn-primary mr-1" href="'.route('report.sale-payment.report', $query->id).'">Report</a>';
             
            return $tag;
        });

        // $columns[] = '';
        // $sections = $sections->;

        return $sections->rawColumns($columns);   
    }

    public function query(Sale $model): QueryBuilder
    {
        return $model->with('customer', 'shareholder', 'agent')->latest()->newQuery();
    }

    public function html(): HtmlBuilder
    {
        $builder = $this->builder()->setTableId('salepaymentreport-table')->columns($this->getColumns())->minifiedAjax()->scrollX(true)->orderBy(0)->selectStyleSingle();
        return $builder;
    }

    public function getColumns(): array
    {
        $columns[] = Column::make('id');
        $columns[] = Column::make('field_details')->title('Description of land')->orderable(false);
        $columns[] = Column::make('customer')->name('customer.phone')->title('Customer')->orderable(false);
        $columns[] = Column::make('shareholder')->name('shareholder.phone')->title('Master Agent')->orderable(false);
        $columns[] = Column::make('agent')->name('agent.phone')->title('Agent')->orderable(false);
        $columns[] = Column::make('action')->title('Action')->width('70px')->orderable(false);
        return $columns;
    }

    protected function filename(): string
    {
        return 'SalePaymentReport_' . date('YmdHis');
    }
}

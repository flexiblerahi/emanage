<?php

namespace App\DataTables;

use App\Models\Agent;
use App\Models\UserDetail;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AgentDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $column = new EloquentDataTable($query);
        $rawcolumns[] = 'status';
        $column = $column->addColumn('status', function ($query) {
                    if ($query->status == 1) return '<div class="text-success font-weight-bold">Active</div>';
                    return '<div class="text-danger  font-weight-bold"> Deactive</div>';
                });
        if(auth()->user()->canany(['agent-view', 'agent-edit'])) {
            $rawcolumns[] = 'action';
            $column = $column->addColumn('action', function ($query) {
                        $tag = '';
                        if(auth()->user()->can('agent-view')) {
                            $tag .= '<a class="btn-sm btn-primary showmodal text-white mr-1" data-role="agent" data-toggle="modal" data-target="#agentId" data-link="' . route('agent.show', [$query->id, 'user' => $this->user]) . '"><i class="far fa-eye"></i></a>';
                        }
                        if(auth()->user()->can('agent-edit')) {
                            $tag .= '<a class="btn-sm btn-primary" href="' . route('agent.edit',  $query->id) . '"><i class="far fa-edit"></i></a>';
                        }
                        return $tag;
                    });
            
        }
       
        $rawcolumns[] = 'account_id';
        $column = $column->addColumn('account_id', function ($query) {
                    return (is_null($query->account_id)) ?  '<p class="text-danger">Not Entry Yet</p>' : $query->account_id;
                });
        $column = $column->filterColumn('account_id', function($query, $keyword) {
            $query->whereRaw("account_id like ?", ["%{$keyword}%"]);
        });
        $rawcolumns[] = 'created_at';
        $column = $column->addColumn('created_at', function ($query) {
                    return $query->created;
                });
        $rawcolumns[] = 'income';
        $column = $column->addColumn('income', function ($query) {
                    return tk($query->income);
                });
        return $column->rawColumns($rawcolumns);
    }

    public function query(UserDetail $model): QueryBuilder
    {
        return $model->where('role', 4)->newQuery();
    }

    public function html(): HtmlBuilder
    {
        $html = $this->builder()->setTableId('userdetails-table')->scrollX(true)->columns($this->getColumns())->minifiedAjax()->orderBy(0)->selectStyleSingle();
        if(auth()->user()->can('new-agent')) {
            $html = $html->dom('Bfrtip')->buttons(
                Button::make('create')->text('<i class="fa fa-plus"></i>&nbsp;Create')
            );
        }
        return $html;
    }

    public function getColumns(): array
    {
        $column[] = Column::make('name')->title('Name')->width('275px')->orderable(true);
        $column[] = Column::make('account_id')->title('Account Id')->searchable(true)->orderable(true)->width('200px');
        $column[] = Column::make('total_kata')->title('Total Katha')->orderable(false);
        $column[] = Column::make('income')->title('Current Balance')->orderable(false);
        $column[] = Column::make('phone')->width('200px')->orderable(false);
        $column[] = Column::make('status')->width('100px')->orderable(false);
        $column[] = Column::make('created_at')->title('Register Date')->width('200px')->orderable(true);
        if(auth()->user()->canany(['agent-view', 'agent-edit'])) {
            $column[] = Column::make('action')->title('Action')->width('200px')->orderable(false);
        }
        return $column;
    }
    
    protected function filename(): string
    {
        return 'Agent_' . date('YmdHis');
    }
}

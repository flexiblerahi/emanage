<?php

namespace App\DataTables;

use App\Models\UserDetail;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDetailDataTable extends DataTable
{
    private $user;
    
    public function __construct() {
        $this->user = request()->get('user');
    }
    
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $column = new EloquentDataTable($query);
        $rawcolumns[] = 'status';
        $column = $column->addColumn('status', function ($query) {
                    if ($query->status == 1) return '<div class="text-success font-weight-bold">Active</div>';
                    return '<div class="text-danger  font-weight-bold"> Deactive</div>';
                });
        // if(in_array($this->user, ['shareholder', 'accountant'])) {   
        //     $rawcolumns[] = 'email';
        //     $column = $column->addColumn('email', function($query) {
        //         return "<p><a href='mailto:".$query->user->email."'>".$query->user->email."</a></p>";
        //     });
        // }
        if(auth()->user()->canany([$this->user.'-view', $this->user.'-edit'])) {
            $rawcolumns[] = 'action';
            $column = $column->addColumn('action', function ($query) {
                        $role = array_flip(UserDetail::USER);
                        $tag = '';
                        if(auth()->user()->can($this->user.'-view')) {
                            $tag .= '<a class="btn-sm btn-primary showmodal text-white mr-1" data-role="'.$this->user.'" data-toggle="modal" data-target="#'.$this->user.'Id" data-link="' . route('user-detail.show', [$query->id, 'user' => $this->user]) . '"><i class="far fa-eye"></i></a>';
                        }
                        if(auth()->user()->can($this->user.'-edit')) {
                            if(in_array($role[$query->role], ['agent', 'customer'])) $tag .= '<a class="btn-sm btn-primary" href="' . route('user-detail.edit',  [$query->id, 'user' => $role[$query->role]]) . '"><i class="far fa-edit"></i></a>';
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
        if($this->user == 'shareholder') {
            $rawcolumns[] = 'income';
            $column = $column->addColumn('income', function ($query) {
                        return tk($query->income);
                    });
        }
        return $column->rawColumns($rawcolumns);
    }

    public function query(UserDetail $model): QueryBuilder
    {
        $model = $model->where('role', UserDetail::USER[$this->user])->with('user');
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        $html = $this->builder()->setTableId('userdetails-table')->scrollX(true)->columns($this->getColumns())->minifiedAjax()->orderBy(0)->selectStyleSingle();
        return $html;
    }

    public function getColumns(): array
    {
        $column[] = Column::make('account_id')->title('Account Id')->orderable(true)->width('200px');
        $column[] = Column::make('name')->title('Name')->width('275px')->orderable(true);
        if(in_array($this->user, ['shareholder', 'accountant'])) $column[] = Column::make('user.email')->name('user.email')->title('Email')->orderable(true);
        if($this->user == 'shareholder') $column[] = Column::make('total_kata')->title('Total Katha')->orderable(false);
        if($this->user == 'shareholder') $column[] = Column::make('income')->title('Current Balance')->orderable(false);
        $column[] = Column::make('phone')->width('200px')->orderable(false);
        $column[] = Column::make('status')->width('100px')->orderable(false);
        $column[] = Column::make('created_at')->title('Register Date')->width('200px')->orderable(true);
        if(auth()->user()->canany([$this->user.'-view', $this->user.'-edit'])) {
            $column[] = Column::make('action')->title('Action')->width('200px')->orderable(false);
        }
        return $column;
    }

    protected function filename(): string
    {
        return ucfirst($this->user).'_' . date('YmdHis');
    }
}

<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
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
                    return $query->created;
                })
                ->addColumn('action', function($query) {
                    $tag = '';
                    // if(auth()->user()->can('category-type-edit')) {
                        $tag .= '<a class="btn-sm btn-primary mr-1 editCategoryItem text-white" data-toggle="modal" data-target="#editCategoryId" data-link="' . route('category.edit', $query->id) . '"><i class="text-white far fa-edit"></i></a>';
                    // }
                    // if(auth()->user()->can('category-type-delete')) {
                        if($query->status == 0) {
                            $tag .= '<a class="btn-sm btn-danger mr-1 deleteCategoryItem text-white" data-toggle="modal" data-target="#deleteCategoryId" data-link="' . route('category.delete-form', $query->id) . '"><i class="text-white fa fa-trash"></i></a>';
                        }
                    // }
                    return $tag;
                })
                ->rawColumns(['created_at', 'action', 'entry']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        $builder =  $this->builder()
                    ->setTableId('categoryitem-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0)
                    ->selectStyleSingle();
        $builder = $builder->dom('Bfrtip')->buttons([ Button::make('create')->text('<i class="text-white fa fa-plus"></i>&nbsp;Create') ]);
        
        return $builder;
    }

    public function getColumns(): array
    {
        $columns = [
            Column::make('id'),
            Column::make('name'),
            Column::make('created_at'),
        ];
        $columns[] = Column::make('action')->width('100px')->orderable(false);
        
        return $columns;
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Category_' . date('YmdHis');
    }
}

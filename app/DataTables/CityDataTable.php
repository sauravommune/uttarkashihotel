<?php

namespace App\DataTables;

use App\Models\City;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CityDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

        return (new EloquentDataTable($query))
            ->editColumn('name', function ($data) {
                return ucwords($data->name??'');
            })
           
            ->addColumn('state_name', function($data){
                return ucwords($data->state->name??'');
            })
            
            ->addColumn('status', function ($q) {
                  return '<div class="form-check form-switch">
                          <input class="form-check-input custom-pointer changeStatus" type="checkbox" role="switch" id="flexSwitchCheckChecked" data_id = "'.$q->id.'" data-url = "'.route('update.city.status').'" '.($q->status ==1 ? "checked" : "").'>
                         </div>';
            })
            ->addColumn('actions', function ($data) {
                $string = '<div class="d-flex align-items-center gap-3">';
                $string .= '<a href="' . route('add.city', ['id' => encode($data->id)]) . '" class="btn btn-sm btn-clean btn-icon" title="Edit details">
                <span class="material-symbols-outlined text-color-secondary fs-2">edit</span>
                </a>';
                $string .= '<a href="#" data-url="' . route('delete.city', ['id' => encode($data->id)]) . '" class="btn btn-sm btn-clean btn-icon delete-item" title="Delete details"> <span class="material-symbols-outlined text-color-secondary fs-2">delete</span></a>';
                $string .= '</div>';


                return $string;
            })
            ->rawColumns(['status','actions']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(City $model): QueryBuilder
    {
        return $model->newQuery()->with(['state:id,name']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('room-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            // Column::make('id'),
            Column::make('name'),
            Column::make('state_name')->title('State'),
             Column::make('status')->title('status'),
            Column::make('meta_title')->title('Meta Title'),
            Column::make('meta_description')->title('Meta Description'),
            Column::computed('actions')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Room_' . date('YmdHis');
    }
}
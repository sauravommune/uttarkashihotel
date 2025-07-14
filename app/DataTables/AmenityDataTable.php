<?php

namespace App\DataTables;

use App\Models\Amenity;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Helpers\general_helper;

class AmenityDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

        return (new EloquentDataTable($query))
        ->addColumn('actions', function ($data) {
            $string = '<div class="d-flex align-items-center gap-3">';
            $string .= '<a href="'.route('amenities.save',encode($data->id)).'" class="btn btn-sm btn-clean btn-icon" title="Edit details"><span class="material-symbols-outlined text-color-secondary fs-2">edit</span></a>';
            $string .= '<a href="javascript:void(0)" data-url="' . route('delete.amenity', ['id' => $data->id]) . '" class="btn btn-sm btn-clean btn-icon delete-item" title="Delete details"><span class="material-symbols-outlined text-color-secondary fs-2">delete</span></a>';
            $string .= '</div>';
            return $string;
        })
        ->addColumn('name', function ($data) {
            return ucwords($data->name??0);
        })
        ->addColumn('type', function ($data) {
            return ucwords($data->type??0);
        })

        ->addColumn('amenity_type', function ($data) {
            return ucwords(str_replace('_', ' ', $data->amenity_type));
        })
        ->filter(function ($query) {
            if (request()->has('search.value')) {
                $query->where('name', 'like', '%' . request('search.value') . '%');
            }
        })
        ->rawColumns(['actions']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Amenity $model): QueryBuilder
    {
        return $model->orderBy('id','desc')->newQuery();

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
                    ->dom('frtip')
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
            Column::make('name'),
            Column::make('type'),
            Column::make('amenity_type'),
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

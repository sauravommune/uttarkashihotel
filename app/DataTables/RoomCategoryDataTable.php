<?php

namespace App\DataTables;

use App\Models\RoomCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RoomCategoryDataTable extends DataTable
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
            $string .= '<a href="' . route('add.room_category', ['id' => encode($data->id)]) . '" class="btn btn-sm btn-clean btn-icon" title="Edit details"><span class="material-symbols-outlined text-color-secondary fs-2">edit</span></a>';
            $string .= '<a href="#" data-url="' . route('delete.room_category', ['id' => encode($data->id)]) . '" class="btn btn-sm btn-clean btn-icon delete-item" title="Delete details"><span class="material-symbols-outlined text-color-secondary fs-2">delete</span></a>';
            $string .= '</div>';
            

            return $string;
        })
        ->addColumn('name', function ($data) {
            return ucwords($data->name??'');
        })
        ->addColumn('status', function ($query) {
            $checked = $query->status == 'active' ? 'checked' : '';
            return "<div class='form-check form-switch'>
                    <input class='form-check-input changeStatus' type='checkbox' role='switch' data_id='{$query->id}' $checked data-url =".route('room.category.changeStatus').">
                    <label class='form-check-label' for='statusSwitch{$query->id}'>

                    </label>
                </div>";
        })
        ->rawColumns(['actions','status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(RoomCategory $model): QueryBuilder
    {
        return $model->newQuery();

    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('roomcategory-table')
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
            Column::make('status'),
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

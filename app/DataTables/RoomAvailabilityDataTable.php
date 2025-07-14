<?php

namespace App\DataTables;

use App\Models\RoomAvailability;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RoomAvailabilityDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('hotel', function($query){
                return ucwords($query->hotel->name);
            })
            ->addColumn('room_type',function($query){
                
                return ucwords($query->room->roomType->name);
            })
            ->addColumn('total_room',function($query){
                
                return $query->room->total_room;
            })
            ->addColumn('available_room',function($query){
                
                return $query->available_rooms;
            })
            ->addColumn('available_from',function($query){
                return Carbon::parse($query->available_from)->format('d M,Y ');
            })

            ->addColumn('available_to',function($query){
                return Carbon::parse($query->available_to)->format('d M,Y ');
            })

            ->addColumn('action', function ($data) {
                $string = '<a href="' . route('rooms.availability', [encode($data->id),'type'=>'edit']) . '" class="btn box-32 btn-clean btn-icon me-4" title="Update Availability" data-bs-toggle ="modal" data-bs-target="#global_modal" data-bs-whatever="Update Room Availability"><span class="material-symbols-outlined text-color-secondary fs-2">edit</span></a>';
               
                return $string;
            })

            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(RoomAvailability $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('roomavailability-table')
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
            
            Column::make('hotel'),
            Column::make('room_type'),
            Column::make('total_room'),
            Column::make('available_room'),
            Column::make('available_from'),
            Column::make('available_to'),
            Column::computed('action')
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
        return 'RoomAvailability_' . date('YmdHis');
    }
}

<?php

namespace App\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use App\Models\Booking;
use Carbon\Carbon;


class BookingDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()

            ->editColumn('booking_id', function ($query) {
                return $query->booking_id;
            })
            ->editColumn('hotel', function ($query) {
                return ucwords($query->hotel->name);
            })
            ->addColumn('Room', function ($query) {
                return ucwords($query->Room?->roomType->name);
            })
            ->addColumn('amount', function ($query) {
                return $query;
            })
            ->addColumn('break_fast_type', function ($query) {
                return $query->break_fast_type;
            })
            ->addColumn('check_in_date', function ($query) {
                return Carbon::parse($query->check_in_date)->format('d M y');

            })
            ->addColumn('check_out_date', function ($query) {
                return Carbon::parse($query->check_out_date)->format('d M y');
            })
            ->addColumn('status', function ($query) {
               return $query->status;
            })

            ->addColumn('date', function ($query) {
                return $query->created_at;
            })
            // ->addColumn('actions', function ($query) {

            // })
            ;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Booking $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('booking-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'Desc')
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
            Column::computed('DT_RowIndex')
                ->title('S No')
                ->searchable(false)
                ->orderable(false)
                ->width(60),
            Column::make('booking_id')->title('booking id'),
            Column::make('hotel')->title('hotel'),
            Column::make('Room')->title('room type'),
            Column::make('total_room')->title('total room'),
            Column::make('total_price')->title('amount'),
            Column::make('break_fast_type')->title('type'),
            Column::make('check_in_date')->title('check in'),
            Column::make('check_out_date')->title('check out'),
            Column::make('status')->title('status'),
            Column::make('date')->title('booking date'),


            // Column::computed('actions')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(60)
            //     ->addClass('text-center'),
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
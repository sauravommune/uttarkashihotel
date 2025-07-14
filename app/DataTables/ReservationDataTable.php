<?php

namespace App\DataTables;

use App\Models\Reservations;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class ReservationDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $string = "
                <div class='d-flex align-items-center gap-4'>
                    <a class='btn btn-light d-flex text-color' 
                        href='" . route('reservations.details', $query->id) . "'> 
                        <span class='material-symbols-outlined fs-3 me-2 text-color'>edit</span>                        
                        <span class='text-color'>Details</span>
                    </a>                    
                </div>";
                return $string;
            })
            ->editColumn('Booked_status', function ($query) {
                $class = '';
                switch ($query->Booked_status) {
                    case 'Confirmed':
                        $class = 'reservation_booking';
                        break;
                    case 'Check In':
                        $class = 'reservation_checkin';
                        break;
                    case 'Check Out':
                        $class = 'reservation_checkout';
                        break;
                    case 'Pending':
                        $class = 'reservation_pending';
                        break;
                    case 'Cancelled':
                        $class = 'reservation_cancel';
                        break;
                }

                return "<span class='$class'>{$query->Booked_status}</span>";
            })
            ->rawColumns(['Booked_status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Reservations $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('reservation-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'asc')
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
            Column::make('id'),
            Column::make('Booking_ID')->title('Booking ID'),
            Column::make('Guest_name')->title('Guest Name'),
            Column::make('room_type')->title('Room Type'),
            Column::make('room')->title('Room'),
            Column::make('check_in')->title('Check In'),
            Column::make('check_out')->title('Check Out'),
            Column::make('Stay_nights')->title('Stay Nights'),
            Column::make('Booked_on')->title('Booked On'),
            Column::make('Booked_status')->title('Booking Status'),
            Column::make('price')->title('Price'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-left'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Reservation_' . date('YmdHis');
    }
}

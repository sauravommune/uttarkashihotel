<?php

namespace App\DataTables;

use App\Models\Manager;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;


class ManagerDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                $editUrl = route('hotelmanager.edit', $row->id); // Adjust route as necessary
                return '<a href="' . $editUrl . '" class="btn btn-sm btn-light d-flex align-items-center gap-1 fs-7">
                    <span class="material-symbols-outlined fs-1">edit</span>Details</a>';
            })
            ->editColumn('status', function ($query) {
                $class = '';
                switch ($query->status) {
                    case 'Booked':
                        $class = 'reservation_booking';
                        break;
                    case 'Checked-In':
                        $class = 'reservation_checkin';
                        break;
                    case 'Checked-Out':
                        $class = 'reservation_checkout';
                        break;
                    case 'Pending':
                        $class = 'reservation_pending';
                        break;
                    case 'Cancelled':
                        $class = 'reservation_cancel';
                        break;
                }

                return "<span class='$class'>{$query->status}</span>";
            })
            ->rawColumns(['status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Manager $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('manager-table')
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

            Column::make('id')
                  ->title('Booking ID'),
            Column::make('guest')
                  ->title('Guest'),
            Column::make('room_type')
                  ->title('Room Type'),
            Column::make('rooms')
                  ->title('Rooms'),
            Column::make('check_in')
                  ->title('Check In'),
            Column::make('check_out')
                  ->title('Check Out'),
            Column::make('price')
                  ->title('Price'),
            Column::make('status')
                  ->title('Status'),
            // Column::make('created_at')
            //       ->title('Created At'),
                  Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-left'),
            // Column::make('updated_at')
            //       ->title('Updated At'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Manager_' . date('YmdHis');
    }
}

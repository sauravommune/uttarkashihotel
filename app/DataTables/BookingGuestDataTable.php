<?php

namespace App\DataTables;

use App\Models\TravellerDetails;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BookingGuestDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($row) {
                $html = '';
                if( !in_array($row?->status, ['captured', 'authorized']) ){
                    $html .= '<a href="' . Route('lead.guest', [$row?->booking_id, encode($row?->id)]) . '" data-bs-toggle="modal" data-bs-target="#global_modal" data-bs-whatever="Edit Guest">
                        <span class="fa fa-edit"></span>
                    </a>';
                }
                return $html;
            })
            ->editColumn('gender', function($row) {
                return ucfirst($row?->gender);
            })
            ->editColumn('dob', function($row) {
                return formatDateMdY($row?->dob);
            })
            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(TravellerDetails $model): QueryBuilder
    {
        $bookingId = request('bookingId');
        return $model->newQuery()->where('booking_id', $bookingId);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('bookingguest-table')
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
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'BookingGuest_' . date('YmdHis');
    }
}

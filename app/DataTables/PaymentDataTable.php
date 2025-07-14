<?php

namespace App\DataTables;

use App\Models\Payment;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class PaymentDataTable extends DataTable
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
            ->editColumn('status', function ($query) {
                $class = '';
                switch ($query->status) {
                    case 'Paid':
                        $class = 'reservation_booking';
                        break;
                    case 'Pending':
                        $class = 'reservation_pending';
                        break;
                    case 'Failed':
                        $class = 'reservation_cancel';
                        break;
                    default:
                        $class = 'reservation_checkout';
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
    public function query(Payment $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the HTML builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('payment-table')
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
            Column::make('id')->title('Transaction ID'),
            Column::make('amount_paid')->title('Amount Paid'),
            Column::make('amount_due')->title('Amount Due'),
            Column::make('status')->title('Status'),
            Column::make('payment_date')->title('Payment Date'),
            Column::make('mode')->title('Mode'),
            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(60)
            //     ->addClass('text-left'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Payment_' . date('YmdHis');
    }
}
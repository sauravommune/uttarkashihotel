<?php

namespace App\DataTables;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BookingTransactionsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($row){
                $html = '';
                if ($row && $row->mode == 'manual'){
                    $html .= '<a href="' . Route('lead.transactions', [$row?->booking_id, encode($row?->id)]) . '" data-bs-toggle="modal" data-bs-target="#global_modal" data-bs-whatever="Edit Transaction">
                        <span class="fa fa-edit"></span>
                    </a>'; 
                }elseif( $row->is_payment_link ){
                    $html .= '<a href="'. $row->payment_link .'" target="_blank" title="View Payment">
                        <span class="material-symbols-outlined fs-4">link</span>
                    </a>';
                }
                if( $row?->status == 'pending' ){
                    $html .= '<a href="javascript:void(0)" data-url="' . Route('lead.transaction.destroy', encode($row->id)) . '" class="delete-item" title="Delete Transaction"><span class="material-symbols-outlined fs-4 text-danger">delete</span></a>';
                }
                return $html;
            })
            ->editColumn('payment_id', function($row){
                return '<small>Order Id: ' . $row?->order_id . '</small> <br/>
                <small>Payment Id: ' . $row?->payment_id . '</small>';
            })
            ->addColumn('payment_date', function($row){
                return formatDateMdY($row?->created_at);
            })
            ->editColumn('amount', function($row){
                return '₹'._nf($row?->amount);
            })
            ->editColumn('status', function($row){
                $badgeClass = match ($row?->status) {
                    'captured',    => 'success',
                    'authorized',  => 'primary',
                    'failed',      => 'danger',
                    'refunded',    => 'secondary',
                    'pending',     => 'warning',
                    'expired',     => 'danger',
                    'cancelled'    => 'danger',
                    default        => 'warning',
                };
                $status = '';
                if( $row->status == 'authorized' ){
                    $route = Route('lead.transaction.capture', encode($row?->id));
                    $status .= "<a href='". $route ."' class='btn btn-primary btn-sm mt-3 py-2 px-4 capture-payment'>Capture Payment</a>";
                }

                return '<span class="badge badge-light-' . $badgeClass . '">' . $row?->status . '</span> <br/>'.$status;
            })
            ->addColumn('medium', function($row){
                return $row?->mode . '<br/><small class="badge badge-secondary">' . $row?->payment_method . '</small>';
            })
            ->rawColumns(['action', 'payment_id', 'status', 'medium']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Payment $model): QueryBuilder
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
                    ->setTableId('bookingtrasactions-table')
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
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'BookingTrasactions_' . date('YmdHis');
    }
}

<?php

namespace App\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use App\Models\Payment;
use Carbon\Carbon;

class TransactionsDataTable extends DataTable
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
            ->addColumn('client', function ($query) {
                $string = 'Name: '.ucwords($query->contactInformation->name?? 'N/A').'<br/>';
                $string .= 'Mobile: '.$query->contactInformation->mobile.'<br/>';
                $string .= 'Email: '.$query->contactInformation->email?? 'N/A';
                return $string;
            })
            ->addColumn('booking_id', function ($query) {
                return "<a class='text-info' href = '" . route('lead.detail', $query->booking_id) . "' target='_blank'>" . ucwords($query->booking_id) . "</a>";
            })
            ->addColumn('payment_id', function ($query) {
                return 'Order Id: '.($query->order_id??'-').'<br/>Payment Id: '.($query->payment_id??'-').'<br>Method: '.strtoupper($query->payment_method??'-');
            })
            ->editColumn('gateway_fee', function ($query) {
                return _nf($query->gateway_fee - $query->gateway_tax);
            })
            ->editColumn('gateway_tax', function ($query) {
                return _nf($query->gateway_tax);
            })
            ->addColumn('gateway_charges', function ($data) {
                return _nf($data->gateway_fee);
            })
            ->addColumn('customer_paid', function ($query) {
                return '₹ '._nf($query->amount);
            })
            ->addColumn('vendor_paid', function ($query) {
                return '₹ '._nf($query->cost);
            })
            ->editColumn('markup', function ($query) {
                return '₹ '._nf($query->amount - $query->cost);
            })
            ->addColumn('markup_tax', function ($query) {
                $markup = $query->amount - $query->cost;
                $gst = $markup - ($markup * (100 / 118));
                return _nf($gst <= 0 ? 0 : $gst);
            })
            ->addColumn('net_markup_profit', function ($query) {
                $markup = $query->amount - $query->cost;
                $gst = $markup - ($markup * (100 / 118));
                return _nf($markup - $gst);
            })
            ->addColumn('net_gst_input', function ($query) {
                $markup = $query->amount - $query->cost;
                $gatewayGst = $query->gateway_tax;
                $gst = $markup - ($markup * (100 / 118));
                return _nf($gatewayGst - $gst);
            })
            ->addColumn('status', function ($query) {
                $badgeClass = match ($query?->status) {
                    'captured',    => 'success',
                    'authorized',  => 'primary',
                    'failed',      => 'danger',
                    'refunded',    => 'secondary',
                    'pending',     => 'warning',
                    'expired',     => 'danger',
                    'cancelled'    => 'danger',
                    default        => 'warning',
                };
                return '<span class="badge badge-light-' . $badgeClass . '">' . $query?->status . '</span>';
            })
            ->addColumn('payment_date', function ($query) {
                return formatDateMdYHiA($query->updated_at);
            })
            ->rawColumns(['booking_id', 'payment_id', 'client', 'status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Payment $model): QueryBuilder
    {
        return $model->newQuery()->with([
            'booking:id,booking_id',
            'contactInformation',
        ])->whereIn('status', ['captured', 'authorized'])->orderBy('updated_at', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('transactions-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'desc')
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
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Transactions_' . date('YmdHis');
    }
}

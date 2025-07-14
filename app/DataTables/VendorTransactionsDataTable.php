<?php

namespace App\DataTables;

use App\Models\VendorTransaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorTransactionsDataTable extends DataTable
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
            ->addColumn('booking_id', function ($data) {
                return "<a class='text-info' href = '" . route('lead.detail', $data->booking->booking_id) . "' target='_blank'>" . ucwords($data?->booking->booking_id) . "</a>";
            })
            ->addColumn('hotel', function ($data) {
                return $data?->hotel?->name;
            })
            ->editColumn('amount', function ($data) {
                return '₹ ' . _nf($data?->amount);
            })
            ->editColumn('receipt', function ($data) {
                if ($data?->receipt) {
                    return '<a href="' . asset('storage/' . $data?->receipt) . '" target="_blank" class="text-info">View</a>';
                }
            })
            ->editColumn('payment_date', function ($data) {
                return formatDateMdY($data?->payment_date);
            })
            ->filter(function($query){
                if (request('searchGlobal')) {
                    $query->where('payment_id', 'like', '%' . request('searchGlobal') . '%')
                        ->orWhereHas('booking', fn($q) => $q->where('booking_id', 'like', '%' . request('searchGlobal') . '%'))
                        ->orWhereHas('hotel', fn($q) => $q->where('name', 'like', '%' . request('searchGlobal') . '%'));
                }

                if( request('hotel_id') ) {
                    $query->where('hotel_id', request('hotel_id'));
                }

                $startDate = request('startDate') ? Carbon::parse(request('startDate'))->startOfDay()->format('Y-m-d') : Carbon::now()->subDays(30)->startOfDay()->format('Y-m-d');
                $endDate = request('endDate') ? Carbon::parse(request('endDate'))->endOfDay()->format('Y-m-d') : Carbon::now()->endOfDay()->format('Y-m-d');
                $query->whereBetween('payment_date', [$startDate, $endDate]);
            })
            ->rawColumns(['booking_id', 'receipt']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(VendorTransaction $model): QueryBuilder
    {
        return $model->newQuery()->with(['booking:id,booking_id', 'hotel:id,name'])->latest();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('global-datatable')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->stateSave(true)
                    ->selectStyleSingle()
                    ->drawCallback('function() {
                        getTotalPaid();
                    }')
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
            Column::make('booking_id'),
            Column::make('hotel'),
            Column::make('payment_id'),
            Column::make('payment_method'),
            Column::make('amount'),
            Column::make('receipt'),
            Column::make('payment_date'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorTransactions_' . date('YmdHis');
    }
}

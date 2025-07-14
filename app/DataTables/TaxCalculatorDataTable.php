<?php

namespace App\DataTables;

use App\Models\TaxCalculator;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TaxCalculatorDataTable extends DataTable
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
                return '<a href="javascript:void(0);" class="btn box-32 btn-clean btn-icon calculatorButton" title="Edit details" data-id="'. encode($row->id) .'">
                    <span class="material-symbols-outlined text-color-secondary fs-2">edit</span>
                </a>
                <a  href ="javascript:void(0)" data-url="' . route('tax-calculator.destroy', encode($row->id)) . '" class="btn box-32 btn-clean btn-icon delete-item" title="Delete Hotel"><span class="material-symbols-outlined text-color-secondary fs-2">delete</span></a>
                ';
            })
            ->editColumn('client_payment', function ($row) {
                return _nf($row->client_payment);
            })
            ->editColumn('vendor_payment', function ($row) {
                return _nf($row->vendor_payment);
            })
            ->editColumn('markup', function ($row) {
                return _nf($row->markup);
            })
            ->editColumn('markup_gst', function ($row) {
                return _nf($row->markup_gst);
            })
            ->editColumn('gross_profit', function ($row) {
                return _nf($row->gross_profit);
            })
            ->editColumn('income_tax', function ($row) {
                return _nf($row->income_tax);
            })
            ->editColumn('net_profit', function ($row) {
                return _nf($row->net_profit);
            })
            ->editColumn('created_by', function ($row) {
                return $row->user ? $row->user->name : '';
            })
            ->editColumn('created_at', function ($row) {
                return formatDateMdY($row->created_at);
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(TaxCalculator $model): QueryBuilder
    {
        return $model->newQuery()->with('user:id,name');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('tax-calculator-datatable')
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
            Column::make('client_payment'),
            Column::make('vendor_payment'),
            Column::make('markup'),
            Column::make('markup_gst'),
            Column::make('gross_profit'),
            Column::make('income_tax'),
            Column::make('net_profit'),
            Column::make('created_by'),
            Column::make('created_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'TaxCalculator_' . date('YmdHis');
    }
}

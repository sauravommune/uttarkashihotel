<?php

namespace App\DataTables;

use App\Models\SearchLog;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;

class SearchLeadsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'searchleads.action')
            ->addColumn('created_at', function($row) {
                // Format the 'created_at' column using Carbon
                return Carbon::parse($row->created_at)->format('M d, Y h:i A');
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(SearchLog $model): QueryBuilder
    {
        return $model->newQuery()
            ->with('city') // Eager load the city relationship
            ->leftJoin('cities', 'cities.id', '=', 'search_logs.city_id') // Join the city table
            ->select('search_logs.*', 'cities.name as city_name'); 
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('searchleads-table')
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
            // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(60)
            //       ->addClass('text-center'),
            Column::make('request_ip'),
            Column::make('city_name'),
            Column::make('checkin_date'),
            Column::make('checkout_date'),
            Column::make('roomCount'),
            Column::make('adultCount'),
            Column::make('childCount'),
            Column::make('device_type'),
            Column::make('country'),
            Column::make('status'),
            Column::make('created_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'SearchLeads_' . date('YmdHis');
    }
}

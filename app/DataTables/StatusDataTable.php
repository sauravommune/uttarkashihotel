<?php

namespace App\DataTables;

use App\Models\Status;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;


class StatusDataTable extends DataTable

{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // ->addColumn('action', 'status.action') // Use the Blade view for the action column
            ->addColumn('action', function ($query) {
                $string = "
                <div class='d-flex align-items-center gap-4'>
                        <a
                            class='box-40'
                            href='" . route('status.edit', $query->id) . "'
                            data-bs-toggle='modal'
                            data-bs-target='#global_modal'
                            data-bs-whatever='Edit Status'>
                            <span class='material-symbols-outlined'>edit</span>
                        </a>
                        <a
                            href='javascript:void(0)'
                            data-url='" . route('status.destroy', $query->id) . "'
                            class='delete-item box-40'>
                            <span class='material-symbols-outlined text-danger'>delete</span>
                        </a>
                    </div>";
                        return $string;
              })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Status $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('status-table')
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

            Column::make('id'),
            Column::make('name'), // Add your columns here
            Column::make('color'),
            Column::make('background'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
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
        return 'Status_' . date('YmdHis');
    }
}

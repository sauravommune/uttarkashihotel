<?php

namespace App\DataTables;

use App\Models\FollowUp;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FollowUpDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($followup){
                $action = '<a href="'. route('followup.create', [encode($followup->booking_id), encode($followup?->id)]) .'" data-bs-target="#global_modal" data-bs-toggle="modal" data-bs-whatever="Modify Followup Details">
                        <span class="material-symbols-outlined fs-5">edit</span>
                    </a>';

                return $action;
            })
            ->addColumn('follow_up', function($followup){
                return formatDateMdY($followup->follow_up_date).'<br/> By '.$followup->user?->name;
            })
            ->editColumn('status', function($followup){
                return '<span class="badge '. match($followup?->status){
                    'Open' => 'bg-success',
                    'Closed' => 'bg-danger',
                } .' text-light">'. ucfirst($followup?->status) .'</span>';
            })
            ->rawColumns(['follow_up','action','status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FollowUp $model): QueryBuilder
    {
        $bookingId = decode(request('bookingId'));
        return $model->newQuery()->with('user')->where('booking_id', $bookingId)->latest();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('followup-table')
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
        return 'FollowUp_' . date('YmdHis');
    }
}

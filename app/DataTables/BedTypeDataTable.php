<?php

namespace App\DataTables;

use App\Models\BedType;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BedTypeDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function ($data) {
            $string = '<div class="d-flex align-items-center gap-2">';
            $string .= '<a href="' . route('add.bedType', $data?->id) . '" data-bs-toggle ="modal" data-bs-target = "#global_modal" data-bs-whatever = "Edit Bed Type" class="btn box-32 btn-clean btn-icon" title="Edit details"><span class="material-symbols-outlined text-color-secondary fs-2">edit</span></a>';
            // $string .= '<a href="' . route('hotel.view.details', $data->id) . '" class="btn box-32 btn-clean btn-icon" title="View details"><span class="material-symbols-outlined text-color-secondary fs-2">visibility</span></a>';
            $string .= '<a  href ="javascript:void(0)" data-url="' . route('bedType.destroy', $data?->id) . '" class="btn box-32 btn-clean btn-icon delete-item" title="Delete Hotel"><span class="material-symbols-outlined text-color-secondary fs-2">delete</span></a>';
            $string .= '</div>';
            return $string;
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(BedType $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('bedtype-table')
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
            Column::make('DT_RowIndex')->title('S.No'),
            Column::make('bed_type'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'BedType_' . date('YmdHis');
    }
}

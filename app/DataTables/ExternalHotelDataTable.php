<?php

namespace App\DataTables;

use App\Models\ExternalHotel;
use App\Models\HotelData;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExternalHotelDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->editColumn('hotel',function($q){
            return ucwords($q->hotel);
        })
        ->editColumn('city',function($q){
            return ucwords($q->city);
        })
        ->editColumn('rating',function($q){
            return ucwords($q->rating);
        })
        ->addColumn('actions', function ($data) {
            $string = '<div class="d-flex align-items-center gap-2">';

               $string .= '<a href="' . route('secret.page', generateSecureHash($data->id)) . '" class="btn box-32 btn-clean btn-icon" title="Edit details">
                        <span class="material-symbols-outlined text-color-secondary fs-2 data-edit">edit</span>
                    </a>';
           
                $string .= '<a  href ="javascript:void(0)" data-url="' . route('remove.external.hotels', generateSecureHash($data->id)) . '" class="btn box-32 btn-clean btn-icon delete-item" title="Delete Hotel" data-datatable ="externalhotel-table">
                    <span class="material-symbols-outlined text-color-secondary fs-2 data-delete">delete</span>
                </a>';
            $string .= '</div>';
            return $string;
        })
        ->addIndexColumn()
        ->rawColumns(['actions'])
        ->setRowId('id');
       
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(HotelData $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('externalhotel-table')
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
            Column::computed('DT_RowIndex')->title('S.No'),
            Column::make('hotel')->title('Hotel Name'),
            Column::make('city'),
            Column::make('rating'),
            Column::computed('actions')
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
        return 'ExternalHotel_' . date('YmdHis');
    }
}

<?php

namespace App\DataTables;

use App\Models\RatePlan;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class RatePlanDataTable extends DataTable
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

            ->editColumn('hotel', function($ratePlan) {
                return ucwords($ratePlan->hotel->name);
            })
            ->editColumn('room_type', function($ratePlan) {
                return ucwords($ratePlan->room->roomType->name);
            })
            ->addColumn('city', function($ratePlan) {
                return ucwords($ratePlan->hotel->cityName->name); // Assuming `city` is a field in the RatePlan model
            })
            ->addColumn('b2b_rate', function ($ratePlan) {
                return 'EP: ₹' . number_format($ratePlan->b2b_rate_ep) . ', CP: ₹' . number_format($ratePlan->b2b_rate_cp) . ', MAP: ₹' . number_format($ratePlan->b2b_rate_map);
            })
            ->addColumn('markup', function ($ratePlan) {
                return '₹' . number_format($ratePlan->markup_ep) . ', ₹' . number_format($ratePlan->markup_cp) . ', ₹' . number_format($ratePlan->markup_map);
            })
            ->addColumn('total_amount', function ($ratePlan) {
                return '₹' . number_format($ratePlan->total_amount_ep) . ', ₹' . number_format($ratePlan->total_amount_cp) . ', ₹' . number_format($ratePlan->total_amount_map);
            })
            ->addColumn('pricing_dates', function ($ratePlan) {
                return $ratePlan->pricing_start_date . ' - ' . $ratePlan->pricing_end_date;
            })
            ->addColumn('created_on', function ($ratePlan) {
                return date('d/m/Y, h:i A', strtotime($ratePlan->created_at));
            })
            ->addColumn('margin_updated_on', function ($ratePlan) {
                return $ratePlan->margin_updated_at ? date('d/m/Y, h:i A', strtotime($ratePlan->margin_updated_at)) : "-";
            })
            ->addColumn('action', function ($ratePlan) {          
                return "
                <div class=''>
                   <span class='btn btn-sm btn-light btn-flex btn-center btn-active-light-primary' data-kt-menu-trigger='click' data-kt-menu-placement='bottom-end' id='table_action'>
                        <span class='material-symbols-outlined fs-3'>more_vert</span>
                   </span>

                    <div id='table-action-show' class='menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4' data-kt-menu='true'>              
                        <div class='menu-item px-3'>
                            <a href='".route('ratePlan.margin',$ratePlan->id)."' class='menu-link px-3 d-flex'>
                            <span class='material-symbols-outlined fs-3 me-2'>task_alt</span>Add Markup</a>
                        </div>          
                        <div class='menu-item px-3'>
                            <a href='javascript:void(0)' class='menu-link px-3 d-flex delete-item' data-url = '".route('ratePlan.remove',$ratePlan->id)."'>
                            <span class='material-symbols-outlined fs-3 me-2 text-danger'>delete</span>Delete Plan</a>
                        </div>          
                    </div>
                </div>";
            })
            ->editColumn('status', function ($query) {
                $checked = $query->status == 'active' ? 'checked' : '';
                return "<div class='form-check form-switch'>
                        <input class='form-check-input changeStatus' type='checkbox' role='switch' data_id='{$query->id}' $checked data-url =".route('ratePlan.changeStatus').">
                        <label class='form-check-label' for='statusSwitch{$query->id}'>
                           
                        </label>
                    </div>";
            })
            ->rawColumns(['b2b_rate', 'markup', 'total_amount', 'action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(RatePlan $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('ratePlan-table')
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
            ])
            ->parameters([
                
                'drawCallback' => 'function(settings) {
                    KTMenu.createInstances();
                    const id = $(this).attr("id").split("-")[2];
                }',
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
                Column::make('hotel')->title('hotel'),
            Column::make('room_type')->title('Room Type'),
            Column::make('city')->title('City'), // Add the City column here
            Column::make('b2b_rate')->title('B2B Rate (₹)'),
            Column::make('markup')->title('Markup (₹)'),
            Column::make('total_amount')->title('Total Amount (₹)'),
            Column::make('status')->title('Status'),
            Column::make('pricing_dates')->title('Pricing Dates'),
            Column::make('created_on')->title('Created On'),
            Column::make('margin_updated_on')->title('Margin Updated On'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-right'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'RatePlan_' . date('YmdHis');
    }
}

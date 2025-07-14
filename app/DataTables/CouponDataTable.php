<?php

namespace App\DataTables;

use App\Models\Coupons;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;


class CouponDataTable extends DataTable
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
                $string = '<div class="d-flex">';
                // if (auth()->user()->can('coupons.update')) {
                    $string .= '<a href="'.Route('coupons.edit', encode($row->id)).'" class="mx-2">
                        <span class="material-symbols-outlined fs-5">
                            edit
                        </span>
                    </a>';
                // }
                
                // if (auth()->user()->can('coupons.delete')) {
                    $string .= '<a href="javaScript:void(0)" data-url="'.Route('coupons.destroy', encode($row->id)).'" class="delete-item" data-datatable="coupon-table">
                        <span class="material-symbols-outlined fs-5">
                            delete
                        </span>
                    </a>';
                // }
                return $string.'</div>';
            })
            ->editColumn('discount', function($data){
                if($data->type == 'amount'){
                    return '₹ '.$data->value;
                }else{
                    return $data->value.'%';
                }
                
            })
            ->editColumn('Status', function($data){
                return '<span class="badge '. ($data->is_active ? 'bg-light-success' : ' bg-light-danger') .' p-1 fw-bold">' . ($data->is_active ? 'Active' :'Inactive') . '</span>';
            })
            ->editColumn('duration', function($data){


                return Carbon::parse($data->start_date)->format('M d, Y').' - '.Carbon::parse($data->expiration_date)->format('M d, Y');

            })
            ->editColumn('date_created', function($data){
                return Carbon::parse($data->created_at)->format('M d, Y');
            })
            ->editColumn('agent', function(){
                return '<div class="d-flex align-items-center gap-2 text-nowrap w-6rem ">
                    <img src="'.asset('/').'assets/images/other/krishana.png" class="img-fluid login-agent rounded-circle" style="filter: invert(0);">
                    <h6 class="mb-0 fw-medium">Ommune</h6>
                </div>';
            })
            ->editColumn('coupon_type', function($data){
                return $data->ticket_type;
            })
            ->editColumn('auto_apply', function($data){
                return '<span class="badge ' . ($data->auto_apply ? 'bg-light-success' : ' bg-light-danger') . ' p-1 fw-bold">'. ($data->auto_apply ? 'On' : 'Off') .'</span>';
            })
            ->editColumn('offer_type', function($data){
                return ucwords($data->type);
            })
            ->editColumn('offer_value', function($data){
                if($data->type == 'amount'){
                    return '₹ '.$data->value;
                }else{
                    return $data->value.'%';
                }
            })
            ->setRowId('id')
            ->filter(function ($query) {
                    $query->where('code', 'like', "%".request('search.value')."%");
            })
            ->rawColumns(['Status','action','agent','auto_apply']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Coupons $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('coupon-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->autoWidth(false)
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
            Column::make('code')->orderable(true),
            Column::make('Status')->orderable(false),
            Column::make('auto_apply')->orderable(false),
            Column::make('offer_type')->title('Unit')->orderable(false),
            Column::make('offer_value')->title('Discount')->orderable(false),
            Column::make('description')->orderable(false),
            Column::make('duration')->orderable(false),
            Column::make('date_created')->orderable(false),
            Column::make('agent')->orderable(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Coupon_' . date('YmdHis');
    }
}

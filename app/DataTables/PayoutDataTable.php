<?php

namespace App\DataTables;

use App\Models\Booking;
use App\Models\Lead;
use App\Models\Payout;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PayoutDataTable extends DataTable
{

    public static $REF_MODEL;

    public function __construct()
    {
        $modelClass = config('referral.referral_models', 'App\Models\User');
        self::$REF_MODEL = app($modelClass);
    }
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('name', function ($query) {
                return $query?->name;
            })
            ->editColumn('email', function ($query) {
                return $query?->email;
            })
            ->editColumn('paid_amount', function ($query) {
                return $query?->payouts->sum('amount');
            })
            ->editColumn('pending_amount', function ($query) {
                
                $total_markup = Booking::withSum(['transactions as total_markup' => function ($query) {
                    $query->whereIn('status', ['captured', 'authorized']);
                }],'markup')
                ->where('referred_by',$query?->id)
                ->where('status', 'successfully_checked_out')->first();
                
                $profit_share = User::find($query->id)?->profit_share;
                $earnings = round(($total_markup?->total_markup * $profit_share) / 100);
                $payouts =  $query?->payouts->sum('amount');
                $pending_amount = $earnings - $payouts;

                return $pending_amount;
            })
            
            ->editColumn('mobile', function ($query) {
                return $query?->mobile;
            })
            ->addColumn('action', function ($query) {
                $addPayoutBtn = '<a href="' . route('payout.form', $query->id) . '" title="Add Payout" data-toggle = "modal" data-target = "#global_modal" data-bs-whatever = "Add Payout" data-load = "true"> 
                                    <div class="box-32  rounded d-flex justify-content-center align-items-center cursor-pointer edit-btn text-dark"> <i class="fa fa-plus" aria-hidden="true"></i> </div>
                                </a>';
                $addPayoutBtn = auth()->user()->can('Payout-Add') ? $addPayoutBtn : '';
               return  '
                <div class="d-flex">
                    <div>
                        '.$addPayoutBtn.'
                    </div>
                    <div class="ms-2">
                        <a href="' . route('payout.transactions', $query->id) . '" title="View Transactions" data-toggle = "modal" data-target = "#global_modal" data-bs-whatever = "View Transactions" class = "mt-1" data-load = "true"> 
                            <div class="box-32  rounded d-flex justify-content-center align-items-center cursor-pointer edit-btn text-dark"> <i class="fa fa-eye" aria-hidden="true"></i> </div>
                        </a>
                    </div>
                </div>';
               
            })
            ->filter(function ($query) {
                $query->when(!empty(request('user')), function ($query) {
                    $query->where('id', request('user'));
                });
                $query->when(!empty(request('from_date')) && !empty(!request('to_date')), function ($query) {
                    $query->whereDate('paid_on','>=', request('from_date'))->whereDate('paid_on','<=', request('to_date'));
                });
            })

            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(): QueryBuilder
    {
        return PayoutDataTable::$REF_MODEL->when(auth()->user()->hasRole('Affiliate'), function($q) {
            $q->where('id', auth()->id());
        })->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('payout-table')
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
            
            Column::make('DT_RowIndex')->title('S.No')->orderable(false)->searchable(false),
            Column::make('name')->orderable(false),
            Column::make('email')->orderable(false),
            Column::make('pending_amount')->orderable(false),
            Column::make('paid_amount')->orderable(false),
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
        return 'Payout_' . date('YmdHis');
    }
}

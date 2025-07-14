<?php

namespace App\DataTables;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ReferralReportDataTable extends DataTable
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
            ->editColumn('total_leads', function ($query) {
                return $query?->leads->count();
            })
            ->editColumn('converted_leads', function ($query) {
                $leadStatus = config('referral.lead_status.completed');
                $leadStatusColumn = config('referral.lead_status.column','lead_status');
                // dd($query?->leads()->where($leadStatusColumn,$leadStatus)->get());
                return $query?->leads()->where($leadStatusColumn,$leadStatus)->count();
            })
            ->editColumn('mobile', function ($query) {
                return $query?->mobile;
            })
            ->editColumn('referral_code', function ($query) {
                return $query?->affiliate_code ? $query?->affiliate_code . '<a href="javascript:void(0)" class="copy ms-2" data-clipboard-text="' .  config('referral.referral_url').$query?->affiliate_code . '"><i class="fa fa-copy"></i></a>':null;
            })
            ->rawColumns(['referral_code'])
            ->filter(function ($query) {
                $query->when(!empty(request('user')), function ($query) {
                    $query->where('id', request('user'));
                });
                $query->when(!empty(request('from_date')), function ($query) {
                    $form_date =request('from_date');
                    $to_date =request('to_date');
                    $query->whereHas('leads',function($q) use($form_date,$to_date){

                        $q->whereDate('created_at','>=' ,$form_date)->whereDate('created_at','<=' ,$to_date);
                    });
                });
               
            })
            ->filter(function ($query) {
                $query->when(!empty(request('user')), function ($query) {
                    $query->where('id', request('user'));
                });
                $query->when(!empty(request('from_date')), function ($query) {
                    $form_date =request('from_date');
                    $to_date =request('to_date');
                    $query->whereHas('leads',function($q) use($form_date,$to_date){

                        $q->whereDate('created_at','>=' ,$form_date)->whereDate('created_at','<=' ,$to_date);
                    });
                });
               
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(): QueryBuilder
    {
        
        return ReferralReportDataTable::$REF_MODEL->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('referralreport-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->searching(false)
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
            Column::make('referral_code')->orderable(false),
            Column::make('total_leads')->orderable(false),
            Column::make('converted_leads')->orderable(false),
            
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ReferralReport_' . date('YmdHis');
    }
}

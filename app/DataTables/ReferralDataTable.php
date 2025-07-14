<?php

namespace App\DataTables;


use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ReferralDataTable extends DataTable
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
            ->editColumn('name', function ($query) {
                return ucwords($query?->name);
            })
            ->editColumn('email', function ($query) {
                return $query?->email;
            })
            ->editColumn('mobile', function ($query) {
                return $query?->phone;
            })
            ->editColumn('referral_code', function ($query) {
                return $query?->affiliate_code ? $query?->affiliate_code . '<a href="javascript:void(0)" class="copy ms-2" data-clipboard-text="' .  $query?->affiliate_code . '"><i class="fa fa-copy"></i></a>':null;
            })

            ->editColumn('total_leads', function ($query) {
                return $query?->leads->count();
            })
            ->editColumn('converted_leads', function ($query) {
                $leadStatus = config('referral.lead_status.completed');
                $leadStatusColumn = config('referral.lead_status.column','lead_status');
                return $query?->leads->where($leadStatusColumn,$leadStatus)->count();
            })
            ->editColumn('company_name', function ($query) {
                return ucwords($query?->userDetails?->company_name);
            })
            ->addColumn('action', function ($data) {
                $string = '<div class="d-flex align-items-center gap-2">';
                
                $string .= '<a href="' . route('referral.register', $data->id) . '" class="btn box-32 btn-clean btn-icon" title="Edit details">
                        <span class="material-symbols-outlined text-color-secondary fs-2">edit</span>
                    </a>';
                
                $string .= '</div>';
                return $string;
            })
            ->rawColumns(['referral_code','referred_by','action'])
           
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->whereHas('roles',function($q){
            
        })->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('referral_table')
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
            Column::make('DT_RowIndex')->title('S.No')->searchable(false)->orderable(false),
            Column::make('name'),
            Column::make('email'),
            Column::make('mobile'),
            Column::make('referral_code'),
            Column::make('total_leads'),
            Column::make('converted_leads'),
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
        return 'Referral_' . date('YmdHis');
    }
}

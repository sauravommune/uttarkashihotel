<?php

namespace App\DataTables;

use App\Models\FollowUp;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FollowUpReportDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('at_time', function($row){
                $string = '<small>'. formatDateMdY($row?->follow_up_date) . '</small>
                    <div class="d-flex align-items-center mt-1">
                        <div>
                            <a href="'. route('followup.create', [encode($row->booking_id), encode($row?->id)]) .'" data-bs-target="#global_modal" data-bs-toggle="modal" data-bs-whatever="Modify Followup Details">
                                <i class="fa fa-pencil text-black"></i>
                            </a>
                        </div>
                        <div class="px-2">
                            '. Carbon::parse($row->follow_up_date)->format('H:i') .'
                        </div>
                        <div>
                            <span class="badge '. ($row->status == 'Closed' ? 'bg-success' : 'bg-danger') .' text-white">'. $row->status .'</span>
                        </div>
                    </div>';
                return $string;
            })
            ->addColumn('booking_ref', function($row){
                $route = route('lead.detail', $row?->booking?->booking_id);
				return "<a class='text-info' href='" . $route . "'>" . ucwords($row?->booking?->booking_id) . "</a> <br/> By ". $row->user?->name;
            })
            ->addColumn('contact', function($row){
                return $row->contact?->name.'<br/>'.$row->contact?->email.'<br/>'.$row->contact?->mobile;
            })
            ->addColumn('remark', function($row){
                return $row->remarks;
            })
            ->rawColumns(['at_time', 'booking_ref', 'contact', 'remark']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FollowUp $model): QueryBuilder
    {
        $feedbackDate = (!empty(request('followup_date')) && request('followup_date') != 'undefined') ? Carbon::parse(request('followup_date')) : now();
        $feedbackTillDate = (!empty(request('followup_date')) && request('followup_date') != 'undefined') ? Carbon::parse(request('followup_date')) : now();

        if ( request('followup_date') ) {
            if (request('type') === 'prev') {
                $feedbackDate->subDay();
                $feedbackTillDate->subDay();
            } elseif (request('type') === 'next') {
                $feedbackDate->addDay();
                $feedbackTillDate->addDay();
            }
            $dateRange = [$feedbackDate->startOfDay(), $feedbackTillDate->endOfDay()];
        } elseif ( request('date') ) {
            [$startDate, $endDate] = explode('to', request('date'));
            $dateRange = [Carbon::parse($startDate)->startOfDay(), Carbon::parse($endDate)->endOfDay()];
        }

        $query = $model->newQuery()
            ->with(['user:id,name', 'booking:id,booking_id', 'contact'])//, 'contact:contact.id,contact.name,contact.mobile,contact.email'
            ->whereBetween('follow_up_date', $dateRange)
            ->where('status', request('followup_status')??'Open');

        if ( !Auth::user()->hasAnyRole(['Admin', 'Super Admin', 'Manager']) ) {
            $query->where('follow_up_by', Auth::user()->id);
        } elseif (!empty(request('user_id'))) {
            $query->where('follow_up_by', request('user_id'));
        }

        return $query->latest('follow_up_date');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('followupreport-table')
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
        return 'FollowUpReport_' . date('YmdHis');
    }
}

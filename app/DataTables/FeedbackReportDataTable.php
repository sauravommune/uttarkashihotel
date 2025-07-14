<?php

namespace App\DataTables;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FeedbackReportDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('contact', function($row){
                return $row->bookingContact?->name.' <br/>'.$row->bookingContact?->email.' <br/>'.$row->bookingContact?->mobile;
            })
            ->addColumn('hotel', function($row){
                return $row->hotel?->name;
            })
            ->addColumn('booking_ref', function($row){
                $route = route('lead.detail', $row->booking_id);
				return "<a class='text-info' href='" . $route . "'>" . ucwords($row?->booking_id) . "</a>";
            })
            ->addColumn('guest', function($row){
                return $row->total_guest;
            })
            ->addColumn('city', function($row){
                return $row->hotel?->cityName?->name??'';
            })
            ->addColumn('checkin', function($row){
                return formatDateMdY($row->check_in_date);
            })
            ->addColumn('checkout', function($row){
                return formatDateMdY($row->check_out_date);
            })
            ->addColumn('employee', function($row){
                return isset($row->feedback->employee->id) ? $row->feedback->employee->name : $row->leadEmployee?->first()?->name;
            })
            ->addColumn('action', function($row){
                $googleColor = !empty($row->feedback->feedback_status) ? ($row->feedback->is_interested?'text-success':'text-danger') : 'text-warning';
                $today = Carbon::today();
                $checkinColor = Carbon::parse($row->check_in_date)->isToday() || Carbon::parse($row->check_in_date)->lt($today)  ? 'text-success' : 'text-warning';
                $checkoutColor = Carbon::parse($row->check_out_date)->isToday() || Carbon::parse($row->check_in_date)->lt($today) ? 'text-success' : 'text-warning';
                return '<div class="d-flex">
                    <div class="pe-3 icon-size">
                        <a href="'. route('feedback.form', encode($row->id)) .'" data-bs-target="#global_modal" data-bs-toggle="modal" data-bs-whatever="Google Review">
                            <span class="bi bi-google '. $googleColor .'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Google Review"></span>
                        </a>
                    </div>
                    <div class="pe-3 icon-size mt-1">
                        <a href="javascript:void(0);" role="button">
                            <span class="fa-solid fa-door-open '. $checkinColor .'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Check-In"></span>
                        </a>
                    </div>
                    <div class="pe-3 icon-size mt-1">
                        <a href="javascript:void(0);" role="button">
                            <span class="fa-solid fa-door-closed '. $checkoutColor .'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Check-Out"></span>
                        </a>
                    </div>
                </div>';
            })
            ->rawColumns(['booking_ref', 'contact', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Booking $model): QueryBuilder
    {
        $feedbackDate = (!empty(request('feedback_date')) && request('feedback_date') != 'undefined') ? Carbon::parse(request('feedback_date')) : now();
        $feedbackTillDate = (!empty(request('feedback_date')) && request('feedback_date') != 'undefined') ? Carbon::parse(request('feedback_date')) : now();
        $feedBackStatus = request('feedback_status');

        if ( request('feedback_date') ) {
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

        $query = $model->newQuery()->with([
            'bookingContact',
            'hotel:id,name,city',
            'feedback',
            'leadEmployee' => function ($query) {
                $query->latest('id')->limit(1);
            }
        ]);
        if ($feedBackStatus === 'checkin') {
            $query->whereBetween('check_in_date', $dateRange)->orderBy('check_in_date', 'ASC');
        } elseif ($feedBackStatus === 'checkout') {
            $query->whereBetween('check_out_date', $dateRange)->orderBy('check_out_date', 'ASC');
        } else {
            $query->where(function ($query) use ($dateRange) {
                $query->whereBetween('check_in_date', $dateRange)
                    ->orWhereBetween('check_out_date', $dateRange);
            })
            ->orderBy('check_in_date', 'ASC')
            ->orderBy('check_out_date', 'ASC');
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('feedbackreport-table')
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
        return 'FeedbackReport_' . date('YmdHis');
    }
}

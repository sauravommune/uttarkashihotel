<?php

namespace App\DataTables;

use App\Models\Hotel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class HotelDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
    */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('name', function ($data) {
                // if( auth()->user()->can('Rooms-View') ) {
                //     return '<a  href ="'. route('rooms',encode($data->id)) . '" class="text-info">
                //             ' . ucwords($data->name) . '
                //         </a>';
                // }

                if($data->room) {
                    return '<a href="' . route('hotel.details', $data?->slug) . '/' . '" target="_blank" class="text-info">'
                    . ucwords($data->name) .
                    '</a>';
                }
                return '<span class="text-info">' . ucwords($data->name) . '</span>';
            })
            ->addColumn('actions', function ($data) {
                $string = '<div class="d-flex align-items-center gap-2">';
                if( auth()->user()->can('Rooms-View') ) {
                    $string .= '<a  href ="'. route('rooms',encode($data->id)) . '" class="btn box-32 btn-clean btn-icon add-room" title="Hotel Rooms">
                            <span class="material-symbols-outlined text-color-secondary fs-2">bed</span>
                        </a>';
                }
                if( auth()->user()->can('Hotel-Edit') ) {
                    $string .= '<a href="'. route('hotelReview',encode($data->id)) .'"class="btn box-32 btn-clean btn-icon google-review" title="Google Review"> 
                                    <span class="material-symbols-outlined text-color-secondary fs-2">rate_review</span>
                            </a>';

                   $string .= '<a href="' . route('hotel.add', $data->id) . '" class="btn box-32 btn-clean btn-icon" title="Edit details">
                            <span class="material-symbols-outlined text-color-secondary fs-2">edit</span>
                        </a>';
                }
                
                if (auth()->user()->can('Hotel-Delete')) {
                    $string .= '<a  href ="javascript:void(0)" data-url="' . route('hotel.remove', $data->id) . '" class="btn box-32 btn-clean btn-icon delete-item" title="Delete Hotel">
                        <span class="material-symbols-outlined text-color-secondary fs-2">delete</span>
                    </a>';
                }
                $string .= '</div>';
                return $string;
            })
            ->editColumn('city', function ($q) {
                return $q?->cityName?->name;
            })

            ->editColumn('google_rating', function ($q) {
                return $q?->google_rating??0.0;
            })->editColumn('google_rating_total', function ($q) {
                return $q?->google_rating_total?? 0;
            })
            ->editColumn('updated_at', function ($q) {
                return Carbon::parse($q?->updated_at)->format('d-M-Y H:i');
            })
          
            ->addColumn('status', function ($q) {
                return $q->status != 'draft' ? '<div class="form-check form-switch">
                                    <input class="form-check-input custom-pointer changeStatus" type="checkbox" role="switch" id="flexSwitchCheckChecked" data_id = "'.$q->id.'" data-url = "'.route('hotel.status.update').'" '.($q->status == "active" ? "checked" : "").'>
                                </div>': '<span class="badge bg-warning text-dark">Draft</span>';
            })
          
            ->addColumn('papular', function ($q) {
                  return '<div class="form-check form-switch">
                          <input class="form-check-input custom-pointer changeStatus" type="checkbox" role="switch" id="flexSwitchCheckChecked" data_id = "'.$q->id.'" data-url = "'.route('hotel.papular.update').'" '.($q->papular ==1 ? "checked" : "").'>
                         </div>';
            })

            ->addColumn('sold_out', function ($q) {
                return '<div class="form-check form-switch">
                        <input class="form-check-input custom-pointer changeStatus" type="checkbox" role="switch" id="flexSwitchCheckChecked" data_id = "'.$q->id.'" data-url = "'.route('hotel.updateSoldOut').'" '.($q->sold_out ==1 ? "checked" : "").'>
                       </div>';
          })
            ->addColumn('recommended', function ($q) {
                return '<div class="form-check form-switch">
                        <input class="form-check-input custom-pointer changeStatus" type="checkbox" role="switch" id="flexSwitchCheckChecked" data_id = "'.$q->id.'" data-url = "'.route('hotel.recommended.update').'" '.($q->recommended == 1 ? "checked" : "").'>
                    </div>';
            })

            ->editColumn('rating', function ($q) {
                $stars = '';
                for ($i = 0; $i < 5; $i++) {
                    if ($i < $q->rating) {
                        $stars .= '<i class="bi bi-star-fill text-warning pe-1 fs-2"></i>';
                    } else {
                        $stars .= '<i class="bi bi-star pe-1 fs-2"></i>';
                    }
                }
                return '<div class="d-flex align-items-center">' . $stars . '<span class="ms-2">(' . $q->rating . ')</span></div>';
            })
            ->filter(function ($query) {
                $request = array_merge(session()->get('hotelSearch')??[], request()->all()) ;
                if( !empty($request['searchTerm']) ){
                    $query->where('name', 'like', '%' . $request['searchTerm'] . '%');
                }
                if( !empty($request['rating']) ){
                    $query->where('rating', $request['rating']);
                }
                if( !empty($request['city']) ){
                    $query->where('city', $request['city']);
                }
                if( !empty($request['status']) ){
                    $query->where('status', $request['status']);
                }
                request()->session()->put('hotelSearch', array_merge($request, request()->all()));
            })
            ->rawColumns(['actions', 'status', 'rating','name','papular','recommended','sold_out']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Hotel $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('updated_at','desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('global-datatable')
            ->addTableClass('custom-header-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
            // ->orderBy(5)
            // ->selectStyleSingle()
            ->searching(true)
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
            Column::make('name')->title('Hotel Name'),
            Column::make('rating')->title('Rating'),
            Column::make('city'),
            Column::make('google_rating')->title('Google Review'),
            Column::make('google_rating_total')->title('Total Reviews'),
            Column::make('status'),
            Column::make('papular')->title('popular'),  
            Column::make('sold_out')->title('Sold Out'),  
            Column::make('recommended'),
            Column::make('updated_at')->title('Last Updated'),
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
        return 'Hotel_' . date('YmdHis');
    }
}

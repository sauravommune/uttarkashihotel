<?php

namespace App\DataTables;

use App\Models\Promotion;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class PromotionsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // Add serial number column
            ->addIndexColumn()
            ->addColumn('title', function ($promotion) {
                return $this->renderPromotionColumn($promotion);
            })
            ->addColumn('action', function ($promotion) {
                $pauseUrl = route('promotion.pause', $promotion?->id); // Modify to the appropriate route for pausing
                $deleteUrl = route('promotion.delete', $promotion?->id); // Modify to the appropriate route for deleting

                return "
                    <div class='d-flex align-items-center gap-4'>
                    <div class='box-40'>
                        <a class='text-color' href='{$pauseUrl}'> 
                            <span class='material-symbols-outlined fs-3 text-color'>pause</span>    
                        </a>                   
                        </div> 
                        <div class='box-40'>
                        <a class='text-color delete-btn' href='{$deleteUrl}' data-id='{$promotion->id}'>
                    <span class='material-symbols-outlined fs-3 text-danger'>delete</span>
                </a>
                        </div> 
                    </div>";    
            })

            ->rawColumns(['title', 'action']) // Add 'title' to rawColumns to render HTML
            ->setRowId('id');
    }

    /**
     * Render the promotion column with an icon, title, and discount.
     *
     * @param Promotion $promotion
     * @return string
     */
    protected function renderPromotionColumn($promotion)
    {
        $iconUrl = asset('assets/media/offer.svg'); // Replace with the correct icon URL
        $discount = "12%"; // Adjust based on your logic

        return "
            <div class='promotion-column d-flex align-items-center'>
                <img src='{$iconUrl}' alt='Deal Icon' class='promotion-icon me-2'>
                <div class='promotion-info'>
                    <span class='promotion-title'>{$promotion->title}</span>
                    <span class='promotion-discount'>{$discount} Discount</span>
                </div>
            </div>
        ";
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Promotion $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('promotion-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'asc')
            ->selectStyleSingle()
            ->language([
                'emptyTable' => '<div class="d-flex justify-content-center align-items-center gap-2 bg-light p-3">
                                    <span class="material-symbols-outlined">sell</span>
                                    No active promotions
                                 </div>'
            ])
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
            Column::computed('DT_RowIndex')
                ->title('S No')
                ->searchable(false)
                ->orderable(false)
                ->width(60),
            Column::make('title')->title('Promotion Title'),
            Column::make('booking_start_date')->title('Promotion Start Dates'),
            Column::make('booking_end_date')->title('Promotion End Dates'),
            Column::make('check_in_date')->title('Checkin date time'),
            Column::make('checkout_date')->title('Checkout date time'),
            Column::make('seen_by')->title('Promotion for'),
            Column::make('applied_on')->title('Applied on'),
            Column::make('created_by')->title('Created by'),
            Column::make('total_bookings')->title('Total Bookings'),
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
        return 'Promotion_' . date('YmdHis');
    }
}

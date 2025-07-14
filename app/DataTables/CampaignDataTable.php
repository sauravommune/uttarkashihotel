<?php

namespace App\DataTables;

use App\Models\Campaign; // Ensure the correct model is imported
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;   
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class CampaignDataTable extends DataTable
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
            ->addColumn('random_id', function ($campaign) {
                // Generate a random number between 100000 and 999999
                $randomNumber = rand(100000, 999999);
                // Return the formatted random ID
                return 'ID' . $randomNumber;
            })
            ->addColumn('title', function ($campaign) {
                // Customize the campaign title column with icon, title, and discount
                return $this->renderCampaignColumn($campaign);
            })
            ->addColumn('action', function ($campaign) {
                $pauseUrl = route('campaigns.pause', $campaign->id); // Modify to the appropriate route for pausing
                $deleteUrl = route('campaigns.delete', $campaign->id); // Modify to the appropriate route for deleting

                return "
                    <div class='d-flex align-items-center gap-4'>
                    <div class='box-40'>
                        <a class='text-color' href='{$pauseUrl}'> 
                            <span class='material-symbols-outlined fs-3 text-color'>pause</span>    
                        </a>                   
                    </div> 
                    <div class='box-40'>
                        <a class='text-color delete-btn' href='{$deleteUrl}' data-id='{$campaign->id}'>
                            <span class='material-symbols-outlined fs-3 text-danger'>delete</span>
                        </a>
                    </div> 
                    </div>";    
            })
            ->rawColumns(['title', 'action']) // Add 'title' to rawColumns to render HTML
            ->setRowId('id');
    }

    /**
     * Render the campaign column with an icon, title, and discount.
     *
     * @param Campaign $campaign
     * @return string
     */
    protected function renderCampaignColumn($campaign)
    {
        $iconUrl = asset('assets/media/offer.svg'); // Replace with the correct icon URL
        $discount = "15%"; // Adjust based on your logic

        return "
            <div class='campaign-column d-flex align-items-center'>
                <img src='{$iconUrl}' alt='Campaign Icon' class='campaign-icon me-2'>
                <div class='campaign-info'>
                    <span class='campaign-title'>{$campaign->title}</span>
                    <span class='campaign-discount'>{$discount} Discount</span>
                </div>
            </div>
        ";
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Campaign $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('campaign-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'asc')
            ->selectStyleSingle()
            ->language([
                'emptyTable' => '<div class="d-flex justify-content-center align-items-center gap-2 bg-light p-3">
                                    <span class="material-symbols-outlined">sell</span>
                                    No active campaigns
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
            Column::make('title')->title('Campaign Title'),
            Column::make('random_id')->title('Campaign ID'),
            Column::make('booking_start_date')->title('Booking Start Dates'),
            Column::make('booking_end_date')->title('Booking End Dates'),
            Column::make('stay_start_date')->title('Stay Start Dates'),
            Column::make('stay_end_date')->title('Stay End Dates'),
            Column::make('seen_by')->title('Seen by/Campaign for'),
            Column::make('applies_on')->title('Applies on'),
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
        return 'Campaign_' . date('YmdHis');
    }
}
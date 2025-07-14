<?php

namespace App\DataTables;

use App\Models\HotelManager;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button; // Make sure this is correct
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class HotelManagerDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                $editUrl = route('hotelmanager.edit', $row->id);
                return '<a href="' . $editUrl . '" class="btn btn-sm btn-light d-flex align-items-center gap-1 fs-7">
                    <span class="material-symbols-outlined fs-1">edit</span>Edit</a>';
            })
            ->editColumn('is_active', function ($query) {
                return '<div class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="" id="flexSwitchChecked" ' . ($query->is_active ? 'checked' : '') . ' />
                    <label class="form-check-label" for="flexSwitchChecked">Active</label>
                </div>';
            })
            ->rawColumns(['action', 'is_active']);
    }

    public function query(HotelManager $model): \Illuminate\Database\Eloquent\Builder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('manager-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
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

    public function getColumns(): array
    {
        return [
            Column::make('id')->title('User ID'),
            Column::make('name')->title('Name'),
            Column::make('email')->title('Email'),
            Column::make('role')->title('Role'),
            Column::make('date_added')->title('Date Added'),
            Column::computed('is_active')->title('Active'),
            Column::computed('action')->title('Action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-left'),
        ];
    }

    protected function filename(): string
    {
        return 'HotelManager_' . date('YmdHis');
    }
}

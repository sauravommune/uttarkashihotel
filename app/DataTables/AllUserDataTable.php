<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AllUserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
{
    return (new EloquentDataTable($query))


        ->addColumn('name', function ($row) {
            // Check if the user has the Super Admin role
            return ucwords($row->name);
        })

        ->addColumn('action', function ($row) {
            // Check if the user has the Super Admin role
            if ($row->roles->contains('name', 'Super Admin')) {
                return "<span class='badge bg-danger text-white'>Not Allowed</span>"; // Return empty if it's a Super Admin
            }

            $editUrl = route('users.edit', $row->id); 
            return '<a href="' . $editUrl . '" class="btn btn-sm gap-1 fs-7 btn-clean">
                <span class="material-symbols-outlined text-color-secondary fs-2">edit</span></a>';
        })

        ->editColumn('status', function ($query) {
            // Check if the user has the Super Admin role

            if ($query->roles->contains('name', 'Super Admin')) {
                return "<span class='badge bg-danger text-white'>Locked</span>"; // Display locked status for Super Admin
            }

            $checked = $query->status ? 'checked' : '';
            // return "<div class='form-check form-switch'>
            //             <input class='form-check-input status-change' type='checkbox' role='switch' id='statusSwitch{$query->id}' data-id='{$query->id}' $checked>
            //             <label class='form-check-label' for='statusSwitch{$query->id}'>
            //                 " . ($query->status ? 'Enabled' : 'Disabled') . "
            //             </label>
            //         </div>";

            return "<div class='form-check form-switch'>
                <input class='form-check-input changeStatus' type='checkbox' role='switch' id='statusSwitch{$query->id}'
                    data_id='{$query->id}'
                data-url='" . route('users.updateStatus') . "' $checked>
                <label class='form-check-label' for='statusSwitch{$query->id}'>
                    " . ($query->status ? 'Enabled' : 'Disabled') . "
                </label>
            </div>";

        })

        ->editColumn('created_at', function ($row) {
            return $row->created_at->format('d-m-Y');
        })

        ->addColumn('role', function ($row) {
            return $row->roles->pluck('name')->implode(', ');
        })
        ->addColumn('referral_code', function ($query) {
            return $query?->affiliate_code ? $query?->affiliate_code . '<a href="javascript:void(0)" class="copy ms-2" data-clipboard-text="' .  $query?->affiliate_code . '"><i class="fa fa-copy"></i></a>':null;
        })
        ->filter(function ($query) {
            $query->when(!empty(request('role')), function ($query) {
                $query->whereHas('roles', function ($query) {
                    $query->where('id', request('role'));
                });
            });

            $query->when(!empty(request('status')), function ($query) {
                $query->where('status', request('status')=='active'?1:0);
            });

            $query->when(!empty(request('search.value')), function ($query) {
                $query->where(function ($query) {
                    $query->where('name', 'like', '%' . request('search.value') . '%')
                        ->orWhere('email', 'like', '%' . request('search.value') . '%')
                        ->orWhere('phone', 'like', '%' . request('search.value') . '%');
                });
            });
        })
        ->rawColumns(['status', 'action','created_at','role','referral_code'])
        ->addIndexColumn()
        ->setRowId('id');
}


    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()
            ->whereDoesntHave('roles', function($query) {
                $query->where('name', 'Super Admin');
            });
    }


    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('global-datatable')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('frtip')
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
            // Column::make('id')->title('ID'),
            Column::make('DT_RowIndex')->title('#')->orderable(false)->searchable(false),
            Column::make('name')->title('Name'),
            Column::make('email')->title('Email'),
            Column::make('created_at')->title('Joining Date')->searchable(false),
            Column::make('role')->title('Role'),
            Column::make('referral_code'),
            Column::make('status')->title('Status')->searchable(false)->orderable(false),
            Column::computed('action')->title('Action')
                ->searchable(false)
                ->orderable(false)
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-left'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}

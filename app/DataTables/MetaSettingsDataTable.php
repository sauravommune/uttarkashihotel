<?php

namespace App\DataTables;

use App\Models\MetaSettings;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MetaSettingsDataTable extends DataTable
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
            ->addColumn('action', function ($data) {
                $string = '<div class="d-flex align-items-center gap-2">';
                $string .= '<a href="' . route('seo.routes.form', $data?->id) . '" data-bs-toggle ="modal" data-bs-target = "#global_modal" data-bs-whatever = "Edit Bed Type" class="btn box-32 btn-clean btn-icon" title="Edit details"><span class="material-symbols-outlined text-color-secondary fs-2">edit</span></a>';

                $string .= '<a  href ="javascript:void(0)" data-url="' . route('seo.routes.delete', $data?->id) . '" class="btn box-32 btn-clean btn-icon delete-item" title="Delete Hotel"><span class="material-symbols-outlined text-color-secondary fs-2">delete</span></a>';
                $string .= '</div>';
                return $string;
            })
            ->editColumn('meta_title', function($data){
                return '<div>'. $data->meta_title .'</div>';
            })
            ->editColumn('meta_description', function($data){
                return '<div>'. $data->meta_description .'</div>';
            })
            ->editColumn('created_at', function($data){
                return Carbon::parse($data->created_at)->format('M d, Y');
            })
            ->rawColumns(['action','meta_title','meta_description']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(MetaSettings $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('metasettings-table')
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
            Column::make('id'),
            Column::make('name'),
            Column::make('meta_title')->width(200),
            Column::make('meta_description')->width(300),
            Column::make('created_at'),
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
        return 'MetaSettings_' . date('YmdHis');
    }
}

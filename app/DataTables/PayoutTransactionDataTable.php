<?php

namespace App\DataTables;

use App\Models\Payout;
use App\Models\PayoutTransaction;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PayoutTransactionDataTable extends DataTable
{
    protected string $dataTableVariable = 'payoutTransactionDataTable';
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->filter(function ($query) {
                
                $query->when(!empty(request('user')), function ($query) {
                    $query->where('id', request('user'));
                });
                
               
                $query->when(!empty(request('from_date')) && !empty(request('to_date')), function ($query) {
                    $query->whereDate('paid_on', '>=', request('from_date'))
                          ->whereDate('paid_on', '<=', request('to_date'));
                });
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Payout $model): QueryBuilder
    {
        return $model->where('user_id',request('user_id'))->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $user_id = request('user_id');
        if(auth()->user()->hasRole('Affiliate')){
            $user_id = auth()->id();
        }
        return $this->builder()
                    ->setTableId('userpayouttransaction-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax(route('payout.transactions',['user_id'=> $user_id]))
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    // ->selectStyleSingle()
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
            
            Column::make('DT_RowIndex')->title('S.No'),
            Column::make('transaction_id'),
            Column::make('paid_on'),
            Column::make('amount'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PayoutTransaction_' . date('YmdHis');
    }
}

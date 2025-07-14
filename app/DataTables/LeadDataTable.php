<?php

namespace App\DataTables;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LeadDataTable extends DataTable
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
			->editColumn('act', function ($row) {
				$action = '';

				if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Manager') || auth()->user()->hasRole('Super Admin')) {
					if( $row->transactions()->whereNotNull('payment_id')->count() <= 0 ){
						$action .= '<a href="javascript:void(0)" data-url="' . route('lead.delete', ['id' => encode($row->id)]) . '" class="delete-item" title="Delete Lead"><span class="material-symbols-outlined fs-4 text-danger">delete</span></a>';
					}
					if( !$row->currentLeadEmployee?->user_id ){
						$btn_title = $row->is_abandoned ? 'Revert' : 'Abandon';
						$action .= '<a href="javascript:void(0)" data-url="' . route('lead.abandon', ['id' => encode($row->id)]) . '"
									class="delete-item" data-bs-toggle="tooltip" 
									data-bs-placement="top" data-bs-title="' . $btn_title . '" data-title="' . $btn_title . '"
									data-warningMessage="Are you sure you want to ' . $btn_title . ' this lead?">
							<span class="material-symbols-outlined fs-5">' . ($row->is_abandoned ? 'swipe_left' : 'swipe_right') . '</span>
						</a>';
					}
				}else{
					$action .= '#';
				}
				return $action;
			})
			->editColumn('work', function ($row) {
				if( $row->currentLeadEmployee?->user_id == auth()->user()->id ){
					return '<a href="'. route('lead.employee', encode($row->id)) .'" class="lock-unlock">
						<i class="bi bi-lock-fill fs-6 cursor-pointer"></i>
					</a>';
				}
				if( $row->currentLeadEmployee?->user_id ){
					return '<i class="bi bi-lock-fill fs-6 cursor-pointer" data-id="116"></i> <br/>'. $row->currentLeadEmployee?->user?->name;
				}
				return '<a href="'. route('lead.employee', encode($row->id)) .'" class="lock-unlock">
					<i class="bi bi-unlock fs-6 cursor-pointer"></i>
				</a>';
			})
			->editColumn('customer_details', function ($row) {
				$usersHtml = '';
				if( !empty($row->remarks) ){
					foreach($row->remarks()->select('booking_id', 'added_by')->distinct()->with('addedBy')->get() as $employee){ 
						$shortName = $this->getInitials($employee->addedBy->name);
						$usersHtml .= "<span class='badge rounded-pill bg-primary mx-1 text-light' 
										role='button'
										data-bs-toggle='tooltip' 
										data-bs-placement='top' 
										data-bs-title='".ucwords($employee->addedBy->name)."'
										title='".ucwords($employee->addedBy->name)."'
										offcanvas-title='".ucwords($employee->addedBy->name)."'
										data-url='".route('lead.remarks', [encode($row->id), encode($employee->addedBy->id)])."'
										onclick='openOffcanvas(this)' >".$shortName.
									"</span>";
					}
				}

				return $row->bookingContact?->name . '&nbsp;'. $usersHtml .'<br /> ' . $row->bookingContact?->email . '<br /> ' . $row->bookingContact?->mobile . '&nbsp;
					<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Initial Amount" class="badge bg-warning cursor-pointer text-dark">₹ '.$row?->transactions->sum('amount').'</span>
					<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Markup Amount" class="badge bg-warning cursor-pointer text-dark">₹ '. ($row?->transactions->sum('markup')-$row?->transactions->sum('gateway_fee')) . '</span>';
			})
			->editColumn('date_and_hotel', function ($row) {
				$formattedDate = Carbon::parse($row->created_at)->format('M d, Y H:i A');
				$hotelName = ucwords($row->hotel?->name ?? 'N/A');
				return $formattedDate . '<br><small>' . $hotelName . '</small>';
			})
			->editColumn('booking_id', function ($row) {
				$specialRequirements = $row->special_requirements == 'consult-now' 
					? "Consult Enquiry" 
					: '';
				$route = route('lead.detail', $row->booking_id);
				return "<a class='text-info' href='" . $route . "'>" . ucwords($row?->booking_id) . "</a> <br/>" . $specialRequirements;
			})			
			->editColumn('check_in', function ($row) {
				return Carbon::parse($row?->check_in_date)->format('M d, Y');
			})
			->editColumn('check_out', function ($row) {
				return Carbon::parse($row?->check_out_date)->format('M d, Y');
			})
			->editColumn('guest', function ($row) {
				return $row?->total_guest;
			})
			->editColumn('children', function ($row) {
				return 0;
			})
			->editColumn('total_rooms', function ($row) {
				return $row?->bookedRooms->sum('quantity');
			})
			->editColumn('city', function ($row) {
				return $row->hotel?->cityDetails?->name;
			})
			->editColumn('country', function ($row) {
				return 'IN';
			})
			->editColumn('payment_status', function ($row) {

				$transaction = $row->transactions()->where('status', 'captured')->orWhere('status', 'authorized')->first();

				$paymentStatus = $transaction?->status??'pending';

				$transaction_status = '';
				if($row?->transactions()->count() != 1){
					$transaction_status = $row?->transactions()->where('status', '!=', 'captured')->pluck('status')->unique()->toArray();
					$transaction_status = implode(' ', array_map(function($status){
						return "<span class='badge badge-warning badge-sm $status' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-title='".ucfirst($status)."' >".ucfirst($status[0])." </span> "; 
					}, $transaction_status));
				}
				$badgeClass = match ($paymentStatus) {
					'captured',    => 'success',
					'authorized',  => 'primary',
					'failed',      => 'danger',
					'refunded',    => 'secondary',
					'pending',     => 'warning',
					'expired',     => 'danger',
					'cancelled'    => 'danger',
					default        => 'warning',
				};
				return '<span class="badge border border-' . $badgeClass . ' bg-light-' . $badgeClass . '">' . ucfirst($paymentStatus) . '</span> <br/>'.$transaction_status;
			})
			->editColumn('booking_status', function ($row) {
				$status = ucfirst($row?->status);
				$badgeClass = match ($status) {
					'Pending', 'Hold' => 'warning',
					'Cancelled By Client', 'Cancelled By Vendor' => 'danger',
					'Completed', 'Confirmed' => 'success',
					'Refunded', 'refund_initiated', 'abandoned' => 'secondary',
					default => 'secondary',
				};
				return '<span class="badge border border-' . $badgeClass . ' bg-light-' . $badgeClass . '">' . $status . '</span>';
			})
			->editColumn('e_ticket', function ($row) {
				if( $row->is_mailed ){
                    return '<i class="bi bi-check-circle fs-6 text-success"></i>';
                }else{
                    return '<i class="bi bi-x-circle fs-6 text-danger"></i>';
                }
			})
			->editColumn('cancel', function ($row) {
				if( $row->is_cancelled ){
                    return '<i class="bi bi-check-circle fs-6"></i>';
                }else{
                    return '<i class="bi bi-x-circle fs-6 text-danger"></i>';
                }
			})
			->setRowClass(function ($data) {
				if($data->status == 'Refund Initiated' || $data->status == 'Refunded' || $data->status == 'Abandoned')
					return 'bg-light-info';
				
				if( $data->is_cancelled || $data->status == 'Cancelled' )
					return 'bg-light-danger';

				if($data->status == 'Confirmed')
					return 'bg-light-success';

				if($data->status == 'Hold')
					return 'bg-light-warning';

			})
			->filter(function ($query) {
				$filterTerm = request('filterTerm');
				$query->when(!empty($filterTerm), function($q) use ($filterTerm) {
					switch($filterTerm) {
						case 'pending':
						case 'confirmed':
						case 'cancelled_by_client':
						case 'cancelled_by_vendor':
						case 'hold':
						case 'abandoned':
							$q->where('status', $filterTerm);
							break;
						case 'authorized':
							$q->whereHas('transactions', function ($qu) {
								$qu->where('status', 'authorized');
							});
							break;
						case 'refunded':
							$q->whereIn('status', ['refund_initiated', 'refunded']);
							break;
						default:
					}
				});

				$searchGlobal = request('searchGlobal');
				$query->when(!empty($searchGlobal), function($subQuery) use ($searchGlobal) {
                    $subQuery->where(function($q) use ($searchGlobal) {
						$q->where('booking_id', 'like', '%' . $searchGlobal . '%');
						$q->orWhereHas('bookingContact', function($qu) use ($searchGlobal) {
							$qu->where('name', 'like', "%{$searchGlobal}%")
								->orWhere('email', 'like', "%{$searchGlobal}%")
								->orWhere('mobile', 'like', "%{$searchGlobal}%");
						});
						$q->orWhereHas('hotel', function($qu) use ($searchGlobal) {
							$qu->where('name', 'like', "%{$searchGlobal}%");
						});
					});
				});

				$query->when(!empty(request('city_id')), function($subquery) {
					$subquery->whereHas('hotel', function($q) {
						$q->where('city', request('city_id'));
					});
				});

				$startDate = request('startDate') ? Carbon::parse(request('startDate'))->startOfDay()->format('Y-m-d H:i:s') : Carbon::now()->subDays(30)->startOfDay()->format('Y-m-d H:i:s');
                $endDate = request('endDate') ? Carbon::parse(request('endDate'))->endOfDay()->format('Y-m-d H:i:s') : Carbon::now()->endOfDay()->format('Y-m-d H:i:s');
                if(empty(request()->bookingDate) ){
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                }

				if(!empty(request()->bookingDate) ){
                    $query->whereDate('check_in_date', request()->bookingDate);
                }
			})
			->rawColumns(['act', 'work', 'customer_details', 'booking_id', 'booking_status', 'date_and_hotel', 'payment_status', 'e_ticket', 'cancel'])
			->setRowId('id');
	}

   /**
    * Get the query source of dataTable.
    */
   public function query(Booking $model): QueryBuilder
   {

      return $model->newQuery()
	  	->with(['bookedRooms', 'payments', 'hotel', 'user', 'transactions','bookingContact', 'currentLeadEmployee', 'leadEmployee.user:id,name'])
		->latest();
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
         //->dom('Bfrtip')
         ->orderBy(1)
         ->selectStyleSingle()
		 ->stateSave(true)
		 ->drawCallback('function() {
			getCurrentAssignedLeads();
		}')
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
         Column::make('act')->title('ACT')->width(35)->orderable(false),
         Column::make('work')->title('WRK')->orderable(false),
         Column::make('DT_RowIndex')->title('#')->orderable(false),
         Column::make('customer_details')->title('Customer Contact')->orderable(false),
         Column::make('booking_id')->orderable(false),
         Column::make('date_and_hotel')->title('HOTEL NAME / Date')->orderable(false),
         Column::make('check_in')->title('CHECK IN')->orderable(false),
         Column::make('check_out')->title('CHECK OUT')->orderable(false),
         Column::make('guest')->title('PAX')->orderable(false),
         Column::make('children')->title('<span title="Children">CH</span>')->orderable(false)->rawColumns(['children']),
         Column::make('total_rooms')->title('<span title="TOTAL ROOMS">TR</span>')->orderable(false)->rawColumns(['total_rooms']),
         Column::make('city')->title('<span title="CURRENT CITY">CC</span>')->orderable(false)->rawColumns(['city']),
         Column::make('country')->title('CON')->orderable(false),
         Column::make('payment_status')->title('PAYMENT')->orderable(false),
         Column::make('booking_status')->title('BKG')->orderable(false),
         Column::make('e_ticket')->title('ETK')->orderable(false),
         Column::make('cancel')->title('CNL')->orderable(false),
      ];
   }

   /**
    * Get the filename for export.
    */
   protected function filename(): string
   {
      return 'Lead_' . date('YmdHis');
   }

   	function getInitials($fullName) {
		// Split the name into parts
		$nameParts = explode(' ', $fullName);
		
		// Initialize an empty string for initials
		$initials = '';
		
		// Loop through each part and get the first letter
		foreach ($nameParts as $part) {
			$initials .= strtoupper($part[0]);
		}
		
		return $initials;
	}
}

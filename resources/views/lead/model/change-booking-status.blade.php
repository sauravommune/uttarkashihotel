<form action = "{{route('save.booking.status')}}" method ="post" class= "change-booking-status" data-modal = "#global_modal">
    <div class="row">
        <div class="col-12">
            <p>Please select the status for this booking:Are you sure you want to change the status?</p>
        </div>
        <div class="col-12">
            <div class="form-group">
                <select class="form-select form-select-solid form-control" data-control="select2" data-placeholder ="Select Booking Status" name="status">
                    <option value="pending" @selected($bookingDetails?->status == 'Pending')>Pending</option>
                    <option value="confirmed" @selected($bookingDetails?->status == 'Confirmed')>Confirmed</option>
                    <option value="successfully_checked_out" @selected($bookingDetails?->status == 'Successfully Checked Out')>Successfully Checked Out</option>
                    <option value="cancelled_by_client" @selected($bookingDetails?->status == 'Cancelled By Client')>Cancelled By Client</option>
                    <option value="cancelled_by_vendor" @selected($bookingDetails?->status == 'Cancelled By Vendor')>Cancelled By Vendor</option>
                    <option value="refund_initiated" @selected($bookingDetails?->status == 'Refund Initiated')>Refund Started</option>
                    <option value="refunded" @selected($bookingDetails?->status == 'Refunded')>Refunded</option>
                    <option value="abandoned" @selected($bookingDetails?->status == 'Abandoned')>Abandon</option>
                    <option value="hold" @selected($bookingDetails?->status == 'hold')>Hold</option>
                </select>

            </div>
            <input type = "hidden" name = "booking_id" value ="{{$bookingDetails?->booking_id}}">
        </div>
      
        <div class="col-12 mt-4">
             <button type="submit" class="btn btn-primary w-100">Update Status</button>
        </div>
    </div>
</form>


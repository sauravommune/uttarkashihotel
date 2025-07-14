<div>
    <p>Are you sure you want to cancel this reservation? This action cannot be undone, and you may lose this booking.</p>
</div>
<form action = "{{route('cancel.booking.save')}}" method ="post" data-icon-text = "Want to cancel this booking? " class ="change-booking-status" data-modal = "#global_modal">
<input type = "hidden" name = "booking_id" value ="{{$booking}}">

 <button type="submit" class="btn btn-danger w-100">Yes, cancel the booking</button>
</form>
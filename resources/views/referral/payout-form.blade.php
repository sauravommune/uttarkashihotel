<form action="{{route('payout.save')}}" method="POST" class="global-ajax-form" data-modal-form="#modal">
    <input type="hidden" name="payout_id" value="">
    <div class="mb-3">
        <label for="followup_date" class="form-label">User Name</label>
        <input type="text" class="form-control" id="user" value="{{$user?->name}}" name="user" disabled>
    </div>
    <div class="mb-3">
        <label for="followup_date" class="form-label">Transaction Id</label>
        <input type="text" class="form-control" id="user" name="transaction_id">
    </div>
    <div class="mb-3">
        <label for="followup_date" class="form-label">Amount</label>
        <input type="text" class="form-control" id="user" value="" name="amount">
    </div>
    <div class="mb-3">
        <label for="followup_date" class="form-label">Payment Date</label>
        <input type="text" class="form-control flatpickr" id="user" value="" name="payment_date">
    </div>
        <input type="hidden" class="form-control" id="user" value="{{$user?->id}}" name="user_id" >
    
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
<script>
$('.flatpickr').flatpickr({
     dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "d M,Y",
});
</script>

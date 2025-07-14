<div class="card shadow-sm mb-4 border">
    <div class="card-body p-2">
        @if($userId == auth()->user()->id)
            <h5 class="mb-0 fw-medium fs-6">Booking Remarks</h5>
            <form action="{{ route('save.remarks') }}" method="post" class="global-ajax-form">
                <input type="hidden" name="booking_id" value={{ encode($bookingDetails?->id) }}>
                <div class="row mt-3 gap-2">
                    <div class="col-md-12">
                        <input type="text" class="form-control form-control-sm" name="remark" placeholder="Enter Remark">
                    </div>
                    <div class="col-md-12">
                        <select class="form-select form-select-sm" name="remark_type">
                            <option value="remark">Remarks</option>
                            <option value="important">Important</option>
                            <option class="payment">Payment</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-sm btn-gradient border-0 text-white text-nowrap fw-medium hover-shadow add_remark_button">Save</button>
                    </div>
                </div>
            </form>
        @endif

        <h6 class="mt-3">Important Update</h6>
        <div class="table-responsive">
            {!! $html['important'] !!}
        </div>

        <h6 class="mt-3">Remark Updates</h6>
        <div class="table-responsive">
            {!! $html['remark'] !!}
        </div>

        <h6 class="mt-3">Payment Updates</h6>
        <div class="table-responsive">
            {!! $html['payment'] !!}
        </div>
    </div>
</div>

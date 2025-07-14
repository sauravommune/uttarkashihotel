<form action="{{ route('lead.vendor.transactions.save') }}" class="global-ajax-form vendor-transaction-form" method="post" data-modal-form="#global_modal">
    @csrf

    <input type="hidden" name="id" value="{{ encode($payment?->id) }}" />
    <input type="hidden" name="booking_id" value="{{ $bookingId }}" />

    <div class="row">

        <!-- Manual Fields -->
        <div class="col-md-6 mb-3 manual-fields">
            <label class="form-label">Payment Method</label>
            <select class="form-select" name="payment_method">
                <option value="upi" @selected($payment?->payment_method === 'upi')>UPI</option>
                <option value="bank_transfer" @selected($payment?->payment_method === 'bank_transfer')>Bank Transfer</option>
                <option value="cash" @selected($payment?->payment_method === 'cash')>Cash</option>
                <option value="other" @selected($payment?->payment_method === 'other')>Other</option>
            </select>
        </div>

        <!-- Payment Date -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Payment Date</label>
            <input type="text" class="form-control modal-date-picker" value="{{ $payment->created_at ? Carbon\Carbon::parse($payment->created_at)->format('Y-m-d') : date('Y-m-d') }}" name="payment_date" placeholder="Payment Date">
        </div>

        <!-- Payment ID -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Payment ID</label>
            <input type="text" class="form-control" value="{{ $payment?->payment_id }}" name="payment_id" placeholder="Payment ID">
        </div>

        <!-- Paid Amount -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Paid Amount</label>
            <input type="number" min="0" class="form-control" value="{{ $payment?->amount ?? 0 }}" name="amount" placeholder="Paid Amount">
        </div>

        {{-- Attachment --}}
        <div class="col-md-6 mb-3">
            <label class="form-label">
                Receipt&nbsp;&nbsp;
                @if( $payment?->receipt )
                    (<a href="{{ asset($payment?->receipt) }}" target="_blank" class="text-info text-end">View Receipt</a>)
                @endif
            </label>
            <input type="file" class="form-control" name="receipt">
        </div>

        <!-- Remarks -->
        <div class="col-md-12 mb-3">
            <label class="form-label">Remarks</label>
            <textarea class="form-control" name="remarks" placeholder="Remark (Optional)">{{ $payment?->remarks ?? '' }}</textarea>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
<form action="{{ route('lead.transactions.save') }}" class="global-ajax-form transaction-form" method="post" data-modal-form="#global_modal">
    @csrf

    <input type="hidden" name="id" value="{{ encode($payment?->id) }}" />
    <input type="hidden" name="bookingId" value="{{ $bookingId }}" />

    <div class="row">
        <!-- Payment Mode -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Payment Mode</label>
            <select class="form-select" name="payment_mode">
                <option value="manual" @selected($payment?->mode === 'manual')>Manual</option>
                <option value="razorpay" @selected($payment?->mode === 'razorpay')>Razorpay</option>
            </select>
        </div>

        <!-- Manual Fields -->
        <div class="col-md-6 mb-3 manual-fields">
            <label class="form-label">Payment Method</label>
            <select class="form-select" name="payment_method">
                <option value="upi" @selected($payment?->payment_method === 'upi')>UPI</option>
                <option value="bank_transfer" @selected($payment?->payment_method === 'bank_transfer')>Bank Transfer</option>
                <option value="card" @selected($payment?->payment_method === 'card')>Card</option>
                <option value="cash" @selected($payment?->payment_method === 'cash')>Cash</option>
            </select>
        </div>

        <!-- Razorpay Fields -->
        <div class="col-md-6 mb-3 razorpay-fields">
            <label class="form-label">Generate Link/Payment Entry</label>
            <select class="form-select" name="is_payment_link">
                <option value="0">Payment Entry</option>
                <option value="1">Generate Link</option>
            </select>
        </div>

        <!-- Payment Date -->
        <div class="col-md-6 mb-3 payment-date">
            <label class="form-label">Payment Date</label>
            <input type="text" class="form-control modal-date-picker" 
                value="{{ $payment->created_at ? Carbon\Carbon::parse($payment->created_at)->format('Y-m-d') : date('Y-m-d') }}" 
                name="payment_date" placeholder="Payment Date">
        </div>

        <!-- Payment ID -->
        <div class="col-md-6 mb-3 payment-id">
            <label class="form-label">Payment ID</label>
            <input type="text" class="form-control" value="{{ $payment?->payment_id }}" name="payment_id" placeholder="Payment ID">
        </div>

        <!-- Paid Amount -->
        <div class="col-md-6 mb-3 manual-fields amount-field">
            <label class="form-label">Paid Amount</label>
            <input type="number" min="0" class="form-control" value="{{ $payment?->amount ?? 0 }}" name="amount" placeholder="Paid Amount">
        </div>

        <!-- Razorpay Link -->
        <div class="col-md-6 mb-3 razorpay-link">
            <label class="form-label">Razorpay Link</label>
            <div class="input-group">
                <input type="text" class="form-control" name="razorpay_link" value="{{ $payment?->razorpay_link }}">
                <span class="input-group-text copy-link" role="button">
                    <span class="material-symbols-outlined">content_copy</span>
                </span>
            </div>
        </div>

        <!-- Remarks -->
        <div class="col-md-12 mb-3">
            <label class="form-label">Remarks</label>
            <textarea class="form-control" name="remarks" placeholder="Remark (Optional)">{{ $payment?->remarks ?? '' }}</textarea>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary generate-razorpay-link" data-url="{{ route('lead.transactions.save') }}">Generate Razorpay Link</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>


<script>
$(document).ready(function () {
    function toggleFields() {
        let mode = $('select[name=payment_mode]').val();
        let isPaymentLink = $('select[name=is_payment_link]').val();
        
        if (mode === 'razorpay') {
            $('.manual-fields, .payment-date').hide();
            $('.razorpay-fields').fadeIn();
            if (isPaymentLink === '1' || isPaymentLink === 1) {
                $('.payment-id').fadeOut();
                $('.razorpay-link').fadeIn();
                $('.amount-field').fadeIn();
                $('.transaction-form').find('button[type=submit]').fadeOut();
                $('.generate-razorpay-link').fadeIn();
            } else {
                $('.razorpay-link').fadeOut();
                $('.amount-field').fadeOut();
                $('.payment-id').fadeIn();
                $('.generate-razorpay-link').fadeOut();
                $('.transaction-form').find('button[type=submit]').fadeIn();
            }
        } else {
            $('.razorpay-fields, .razorpay-link').hide();
            $('.manual-fields, .payment-id, .payment-date').fadeIn();
            $('.generate-razorpay-link').fadeOut();
            $('.transaction-form').find('button[type=submit]').fadeIn();
        }
    }

    // Initialize the field visibility
    toggleFields();

    // Bind change events
    $('body').on('change', 'select[name=payment_mode], select[name=is_payment_link]', toggleFields);

    $('body').off('click', 'button.generate-razorpay-link').on('click', 'button.generate-razorpay-link', function(e){
        e.preventDefault();
        let _this = $(this);
        _this.attr('disabled', true);
        _this.text('Please wait...');
        let url = _this.data('url');
        let formData = $('.transaction-form').serializeArray();
        $.post(url, formData, function(response){
            if(response.status == 200){
                $('input[name=razorpay_link]').val(response.razorpay_link);
                _this.text('Payment Link Generated');
                transactionDatatable.ajax.reload();
            }else{
                _this.text('Generate Razorpay Link');
                _this.attr('disabled', false);
            }
        }).fail(function(error) {
            _this.text('Generate Razorpay Link').attr('disabled', false);
            globalToast({ message: error.responseJSON.message, icon: 'error' }); 
        });
    });

    $('body').off('click', 'span.copy-link').on('click', 'span.copy-link', function(){
        let _this = $(this);
        let copyText = $('input[name=razorpay_link]');
        copyText.select();
        document.execCommand("copy");
        globalToast({ message: 'Link copied to clipboard', icon: 'success' }); 
    });
});

</script>
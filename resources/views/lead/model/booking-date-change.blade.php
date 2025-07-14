
<form method="post" action="{{ route('update.booking.date') }}" class="global-ajax-form">
    @csrf()
    <div class="row">
        <div class="col-12">
            <p>Please select the status for this booking:</p>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="user_name" class="mb-2 text-color-secondary">Check In</label>
                <div class="main-icon">
                    <input type="text" id="check-in" name="check_in"
                        class="form-control form-control-solid available_from"
                        value ="{{ $bookingDetails?->check_in_date }}">
                    <div class="icon-common text-end">
                        <span class="fa fa-calendar"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="user_name" class="mb-2 text-color-secondary">Check Out</label>
                <div class="main-icon">
                    <input type="text" id="check-out" name="check_out"
                        class="form-control form-control-solid available_to"
                        value = "{{ $bookingDetails?->check_out_date }}">
                    <div class="icon-common text-end">
                        <span class="fa fa-calendar"></span>
                    </div>

                     @foreach($bookingDetails?->bookedRooms as $bookedRoom)
                     <input type="hidden" name="booked_room_details[]" value="{{$bookedRoom}}">
                     @endforeach

                     <input type="hidden" id="check-out" name="previous_check_out"
                         value="{{ $bookingDetails?->check_out_date }}">
                        
                    <input type="hidden" name="booking_id" value="{{$bookingDetails?->booking_id}}">

                    <input type="hidden" name ="previous_check_in_date" value="{{$bookingDetails->check_in_date}}">
                    <input type="hidden" name ="previous_check_out_date" value="{{$bookingDetails->check_out_date}}">


                    <div id="booking_id" data-booking-id = "{{ $bookingDetails?->booking_id }}"></div>

                </div>
            </div>

            {{-- {"id":91,"user_id":2,"hotel_id":2,"booking_id":"BKG0000086","search_id":2689,"check_in_date":"2024-12-13","check_out_date":"2024-12-14","total_guest":2,"total_room":0,"status":"Pending","created_at":"2024-12-13T11:16:01.000000Z","updated_at":"2024-12-13T11:16:01.000000Z","adult":2,"child":0,"special_requirements":"","arrival_time":null} --}}
        </div>
        <div class="col-12 mt-4">
            <div class="common-section-part">
                <div class="title-fare mt-xl-5">
                    <div class="d-flex justify-content-between w-100">
                        <div>
                            <h2>New Total Amount</h2>
                        </div>
                        <div class="total-amount">
                            <i class="fa fa-inr pe-1"></i><span id="new_amount">0</span>
                        </div>
                    </div>
                </div>
                <div class="title-fare mt-xl-5">
                    <div class="d-flex justify-content-between w-100">
                        <div>
                            <h2>Previous Total Amount</h2>
                        </div>
                        <div class="total-amount" id="previous_amount" data-previous_amount="{{ $bookingDetails?->bookedRooms->sum('total_price') }}">
                            <i
                                class="fa fa-inr pe-1"></i><span>{{ $bookingDetails?->bookedRooms->sum('total_price') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="balance-payment common-bg rounded">
                <div class="d-flex justify-content-between w-100">
                    <div>
                        <h3 id="payment_head">Balance Payment</h3>
                    </div>
                    <div>
                        <i class="fa fa-inr pe-1"></i><span id ="pay_amount">0</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-4">
            <button type="submit" id="btn"class="btn btn-primary w-100" title="Update Changes" disabled>Update Changes</button>
        </div>
    </div>
</form>

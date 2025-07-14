<form action="{{route('rooms.availability.save')}}" method="POST" class="global-ajax-form" data-modal-form="#global_modal">

    <input type="hidden" name="rate_plan_id" value="{{ encode($ratePlan?->id) }}" />
    <input type="hidden" name="room_type" value="{{ encode($room->id) }}" />
    <input type="hidden" name="hotel_id" value="{{ encode($room->hotel_id) }}" />

    <h3> Room Type : {{ucwords($room?->roomType?->name) }}</h3>
    <h6> Date : {{ formatDateMdY(date('Y-m-d')) }}
    <hr/>
    <h6> Rate Plans : </h6>
    <!-- EP Rates -->
    <div class="row mb-5 py-1">
        <div class="col-sm-3">
            <div class="d-flex flex-column">
                <span class="text-color fs-7 fw-bold">EP Rates & Markup</span>
                <span class="text-color-secondary fw-semibold fs-8">Room only, with no meals.</span>
            </div>
        </div>
        <div class="col-sm-4 mt-4 mt-sm-0">
            <div class="input-group">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                    id="basic-addon3">₹</span>
                <input type="number" class="form-control text-color-secondary" name="b2b_rate_ep" placeholder="Enter EP rate"
                    value="{{ old('b2b_rate_ep', $ratePlan->b2b_rate_ep) }}">
            </div>
        </div>
        <div class="col-sm-4 mt-4 mt-sm-0">
            <div class="input-group">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                    id="basic-addon3">₹</span>
                <input type="number" class="form-control text-color-secondary" name="markup_ep" placeholder="Enter EP Markup"
                    value="{{ old('markup_ep', $ratePlan->markup_ep) }}" />
            </div>
        </div>
    </div>

    <!-- CP Rates -->
    <div class="row mb-5 py-1">
        <div class="col-sm-3">
            <div class="d-flex flex-column">
                <span class="text-color fs-7 fw-bold">CP Rates</span>
                <span class="text-color-secondary fw-semibold fs-8">Breakfast is included along with room.</span>
            </div>
        </div>
        <div class="col-sm-4 mt-4 mt-sm-0">
            <div class="input-group">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                    id="basic-addon3">₹</span>
                <input type="number" class="form-control text-color-secondary"
                    name="b2b_rate_cp" placeholder="Enter CP rate" value="{{ old('b2b_rate_cp', $ratePlan->b2b_rate_cp) }}" />
            </div>
            @error('b2b_rate_cp')
            <span class="text-danger mt-1 d-block">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-sm-4 mt-4 mt-sm-0">
            <div class="input-group">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                    id="basic-addon3">₹</span>
                <input type="number" class="form-control text-color-secondary"
                    name="markup_cp" placeholder="Enter CP Markup" value="{{ old('markup_cp', $ratePlan->markup_cp) }}" />
            </div>
            @error('markup_cp')
            <span class="text-danger mt-1 d-block">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- MAP Rates -->
    <div class="row mb-5 py-1">
        <div class="col-sm-3">
            <div class="d-flex flex-column">
                <span class="text-color fs-7 fw-bold">MAP Rates</span>
                <span class="text-color-secondary fw-semibold fs-8">Includes room, breakfast & dinner</span>
            </div>
        </div>
        <div class="col-sm-4 mt-4 mt-sm-0">
            <div class="input-group">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                    id="basic-addon3">₹</span>
                <input type="number" class="form-control text-color-secondary"
                    name="b2b_rate_map" placeholder="Enter MAP rate" value="{{ old('b2b_rate_map', $ratePlan?->b2b_rate_map) }}" />
            </div>
            @error('b2b_rate_map')
            <span class="text-danger mt-1 d-block">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-sm-4 mt-4 mt-sm-0">
            <div class="input-group">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control text-color-secondary"
                    name="markup_map" placeholder="Enter MAP Markup" value="{{ old('markup_map', $ratePlan?->markup_map) }}" />
            </div>
            @error('markup_map')
            <span class="text-danger mt-1 d-block">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- Non-Refundable Rate -->
    <div class="row mb-5 py-1">
        <div class="col-sm-3">
            <div class="d-flex flex-column">
                <span class="text-color fs-7 fw-bold">Non Refundable Rate</span>
                <span class="text-color-secondary fw-semibold fs-8">Discount when guests book non-refundable option</span>
            </div>
        </div>
        <div class="col-sm-4 mt-4 mt-sm-0">
            <div class="input-group">
                <input type="number" class="form-control text-color-secondary"
                    name="non_refundable_rate" placeholder="% Discount" value="{{ old('non_refundable_rate', $ratePlan?->non_refundable_rate) }}" />
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">%</span>
            </div>
            @error('non_refundable_rate')
            <span class="text-danger mt-1 d-block">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- Weekly Rate -->
    <div class="row mb-5 py-1">
        <div class="col-sm-3">
            <div class="d-flex flex-column">
                <span class="text-color fs-7 fw-bold">Weekly Rates</span>
                <span class="text-color-secondary fw-semibold fs-8">Discount when guests book for a week</span>
            </div>
        </div>
        <div class="col-sm-4 mt-4 mt-sm-0">
            <div class="input-group">
                <input type="number" class="form-control text-color-secondary"
                    name="weekly_rate" placeholder="% Discount" value="{{ old('weekly_rate', $ratePlan?->weekly_rate) }}" />
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">%</span>
            </div>
            @error('weekly_rate')
            <span class="text-danger mt-1 d-block">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <hr/>

    <h3> Room Availability : </h3>
    <div class="row mb-5 py-1">
        <div class="col-sm-6">
            <span class="text-color fs-7 fw-bold">Total Rooms</span>
            <input type="number" class="form-control form-control-solid text-color-secondary" value={{ $room?->total_room }} readonly />
        </div>

        <div class="col-sm-6">
            <span class="text-color fs-7 fw-bold">Room Availability</span>
            <input type="number" class="form-control text-color-secondary" name="availability" value={{ old('availability', $ratePlan->availability) }} />
        </div>
    </div>
    
    <div class="mb-3 text-end">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>
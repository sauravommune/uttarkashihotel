
<form class="global-ajax-form ratePlan-form" action="{{ route('ratePlan.update', $ratePlan) }}" method="post" data-modal-form="#global_modal">
    @csrf
    <input type="hidden" name="hotel_id" value="{{ $hotelId }}">
    <input type="hidden" name="room_type" value="{{ $roomType }}">
    <input type="hidden" name="pricing_date" value="{{ $pricingDate }}">
    <div class="mb-3">
        <label class="form-label">
            EP Rates &nbsp;
            <span class="text-color-secondary fw-semibold fs-8">(Room only, with no meals.)</span>
        </label>
        <div class="d-flex align-items-center gap-2">
            <input type="number" class="form-control" value="{{ $ratePlan->b2b_rate_ep??0 }}" name="b2b_rate_ep" placeholder="EP Rates" min="0" required>
            <input type="number" class="form-control" value="{{ $ratePlan->markup_ep??0 }}" name="markup_ep" placeholder="EP Markup" min="0" required>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">
            CP Rates &nbsp;
            <span class="text-color-secondary fw-semibold fs-8">
                (Breakfast is included along with room.)
            </span>
        </label>
        <div class="d-flex align-items-center gap-2">
            <input type="number" class="form-control" value="{{ $ratePlan->b2b_rate_cp??0 }}" name="b2b_rate_cp" placeholder="EP Rates" min="0" required>
            <input type="number" class="form-control" value="{{ $ratePlan->markup_cp??0 }}" name="markup_cp" placeholder="CP Markup" min="0" required>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">
            MAP Rates &nbsp;
            <span class="text-color-secondary fw-semibold fs-8">(Includes room, breakfast & dinner)</span>
        </label>
        <div class="d-flex align-items-center gap-2">
            <input type="number" class="form-control" value="{{ $ratePlan->b2b_rate_map??0 }}" name="b2b_rate_map" placeholder="EP Rates" min="0" required>
            <input type="number" class="form-control" value="{{ $ratePlan->markup_map??0 }}" name="markup_map" placeholder="MAP Markup" min="0" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">
                Non Refundable Discount &nbsp;
                <span class="text-color-secondary fw-semibold fs-8">
                    (%)
                </span>
            </label>
            <input type="number" class="form-control" value="{{ $ratePlan->non_refundable_rate??0 }}" name="non_refundable_rate" placeholder="EP Rates" min="0" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">
                Weekly Rates Discount &nbsp;
                <span class="text-color-secondary fw-semibold fs-8">
                    (%)
                </span>
            </label>
            <input type="number" class="form-control" value="{{ $ratePlan->weekly_rate??0 }}" name="weekly_rate" placeholder="EP Rates" min="0" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">
                Availability &nbsp;
                <span class="text-color-secondary fw-semibold fs-8">
                   (Rooms)
                </span>
            </label>
            <input type="number" class="form-control" value="{{ $ratePlan->availability??0 }}" name="availability" placeholder="Availability" min="0" required>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

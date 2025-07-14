<form class="global-ajax-form" data-modal-form="#modal" action="{{ route('promotion.save') }}" method="POST"
    enctype="multipart/form-data" data-redirect-url="{{ route('promotion.index') }}">

    <h3 class="d-flex align-items-start flex-column">
        <span class="text-color fw-semibold fs-3 mb-1">Basic Deal</span>
        <span class="text-color-secondary fw-semibold fs-7">Recommended discount of 10-20% . Customize your deal
            according to your need.</span>
    </h3>

    <div class="d-flex flex-column text-center">
        <div class="d-flex align-items-start justify-content-center mb-7">
            <span class="fw-bold fs-3x" id="kt_modal_create_campaign_budget_label"></span>
            <span class="fw-bold fs-3x"></span>
        </div>
        <div id="kt_modal_create_campaign_budget_slider" class="noUi-sm"></div>
        <input type="hidden" name="discount_percent" class="form-control form-control-solid">
    </div>

    <div class="row mt-8">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="required form-label mb-4">Campaign Name</label>
                <input type="text" class="form-control form-control-solid"
                    placeholder="Enter Campaign Name" name="campaign_name"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="required form-label mb-4">Discount Upto</label>
                <input type="text" class="form-control form-control-solid"
                    placeholder="Enter Discount Upto" name="discount_up_to"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="required form-label mb-4">Promotion Start/End Date</label>
                <input type="text" class="form-control form-control-solid kt_date_range_flatpickr"
                    placeholder="Select Promotion Start/End Date" name="offer_start_end_date"/>
            </div>
        </div>

        <div class="col-md-6 mt-4 mt-md-0">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="required form-label mb-4">Check In - Check Out Date</label>
                <input type="text" class="form-control form-control-solid kt_date_range_flatpickr"
                    placeholder="Select Check In - Check Out" name="check_in" />
            </div>
        </div>

        <div class="col-md-6 mt-4">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="required form-label mb-4">Seen by</label>
                <select class="form-select form-select-solid" data-placeholder="Select a User Type" name="seen_by">
                    <option value=""></option>
                    @forelse ($roles as $role)
                        
                    <option value="{{$role?->id}}">{{$role?->name}}</option> 
                    @empty
                    @endforelse
                </select>
            </div>
        </div>

        <div class="col-md-6 mt-4">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="required form-label mb-4">Applied on</label>
                <select class="form-select form-select-solid" data-placeholder="Select a Room Type" name="applied_on">
                    <option value=""></option>
                    @foreach ($room_types as $type)
                        
                    <option value="{{$type?->id}}">{{$type?->name}}</option> 
                    @endforeach
                </select>

            </div>
        </div>
    </div>

    <div class="row mt-8 border-top">
        <div class="col-md-8">
            <button class="btn btn-primary w-100">
                Create {{ ucwords($offerType) }}
            </button>
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-light w-100" data-bs-dismiss="modal">
                Cancel
            </button>
        </div>
    </div>


</form>


<script>
var u = document.querySelector("#kt_modal_create_campaign_budget_slider"),
    m = document.querySelector("#kt_modal_create_campaign_budget_label");

noUiSlider.create(u, {
    start: [0], // Start at 0%
    connect: true,
    range: {
        min: 0, // Minimum percentage
        max: 100 // Maximum percentage
    }
});

// Update the label with the slider's value
u.noUiSlider.on("update", function(e, t) {
    m.innerHTML = Math.round(e[t]) + '%'; // Display the value as a percentage
    $('input[name="discount_percent"]').val(Math.round(e[t]));
});
</script>
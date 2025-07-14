<form class="ajax-form" data-modal-form="#modal" action="{{ route('promotion.index') }}" method="GET"
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
    </div>

    <div class="row mt-8">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="required form-label mb-4">Booking Date</label>
                <input type="email" class="form-control form-control-solid" id="daterange"
                    placeholder="Select Booking Date" />
            </div>
        </div>

        <div class="col-md-6 mt-4 mt-md-0">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="required form-label mb-4">Check In - Check Outl</label>
                <input type="email" class="form-control form-control-solid" id="daterange"
                    placeholder="Select Check In - Check Outl" />
            </div>
        </div>

        <div class="col-md-6 mt-4">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="required form-label mb-4">Seen by</label>
                <select class="form-select form-select-solid" data-placeholder="Select a User Type">
                    <option></option>
                    <option value="admin">Admin</option>
                    <option value="hotel_admin">Hotel Admin</option>
                    <option value="manager">Manager</option>
                    <option value="receptionist">Receptionist</option>
                    <option value="housekeeping">Housekeeping</option>
                    <option value="maintenance">Maintenance</option>
                    <option value="guest_services">Guest Services</option>
                    <option value="reservation_manager">Reservation Manager</option>
                    <option value="event_coordinator">Event Coordinator</option>
                    <option value="finance">Finance</option>
                    <option value="sales_marketing">Sales & Marketing</option>
                </select>
            </div>
        </div>

        <div class="col-md-6 mt-4">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="required form-label mb-4">Applies on</label>
                <select class="form-select form-select-solid" data-placeholder="Select a Room Type">
                    <option></option>
                    <option value="single">Single Room</option>
                    <option value="double">Double Room</option>
                    <option value="suite">Suite</option>
                    <option value="deluxe">Deluxe Room</option>
                    <option value="family">Family Room</option>
                    <option value="studio">Studio Room</option>
                    <option value="twin">Twin Room</option>
                    <option value="king">King Room</option>
                    <option value="queen">Queen Room</option>
                    <option value="presidential">Presidential Suite</option>
                </select>

            </div>
        </div>
    </div>

    <div class="row mt-8 border-top">
        <div class="col-md-8">
            <button class="btn btn-primary w-100">
                Activate Promotion
            </button>
        </div>
        <div class="col-md-4">
            <button class="btn btn-light w-100">
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
});
</script>
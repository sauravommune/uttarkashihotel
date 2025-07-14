<div class="d-flex flex-column gap-8">
    <div class="d-flex align-items-center justify-content-between border-bottom pb-4">
        <h2>Rate Plan</h2>
        <button class="btn btn-sm btn-primary d-flex align-items-center gap-1 fs-7" id="disabled-btn">
            <span class="material-symbols-outlined fs-1">edit</span>Edit
        </button>
    </div>

    <form action="/ratePlan/store" method="POST" class="global-ajax-form" data-redirect-url="/ratePlans">
        <div class="row align-items-end pb-4">
            <div class="col-md-8">
                <div class="row">

                    <div class="col-md-3 col-6">
                        <div class="fv-row fv-plugins-icon-container">
                            <label class="form-label">Hotel</label>
                            <select class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Select hotel" name="hotel" id="hotel" required>
                                <option></option>
                                <option value="1" selected>Hotel A</option>
                                <option value="2">Hotel B</option>
                                <option value="3">Hotel C</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="fv-row fv-plugins-icon-container">
                            <label class="form-label">Room Type</label>
                            <select class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Select room type" name="room_type" id="room" required>
                                <option></option>
                                <option value="1">Single Room</option>
                                <option value="2">Double Room</option>
                                <option value="3">Suite</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 col-6 mt-4 mt-md-0">
                        <div class="fv-row fv-plugins-icon-container">
                            <label class="form-label">From Date</label>
                            <input class="form-control form-control-solid modal-date-picker" placeholder="Pick a date"
                                id="solid-date-one" name="start_date" />
                        </div>
                    </div>

                    <div class="col-md-3 col-6 mt-4 mt-md-0">
                        <div class="fv-row fv-plugins-icon-container">
                            <label class="form-label">To Date</label>
                            <input class="form-control form-control-solid modal-date-picker" placeholder="Pick a date"
                                id="solid-date-second" name="end_date" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="position-relative my-5 pt-1">
            <div class="separator-vertical"></div>
        </div>
        <div class="d-flex flex-column justify-content-end mt-8">
            <!-- EP Rates -->
            <div class="row w-100 mb-5 py-1">
                <div class="col-sm-3">
                    <div class="d-flex flex-column">
                        <span class="text-color fs-7 fw-bold">EP Rates</span>
                        <span class="text-color-secondary fw-semibold fs-8">Room only, with no meals.</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group input-group-solid">
                        <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                        <input type="number" class="form-control form-control-solid text-color-secondary"
                            name="b2b_rate_ep" placeholder="Enter EP rate" value="2000">
                    </div>
                </div>
            </div>

            <!-- CP Rates -->
            <div class="row w-100 mb-5 py-1">
                <div class="col-sm-3">
                    <div class="d-flex flex-column">
                        <span class="text-color fs-7 fw-bold">CP Rates</span>
                        <span class="text-color-secondary fw-semibold fs-8">Breakfast is included along with
                            room.</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group input-group-solid">
                        <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                        <input type="number" class="form-control form-control-solid text-color-secondary"
                            name="b2b_rate_cp" placeholder="Enter CP rate" value="2500">
                    </div>
                </div>
            </div>

            <!-- MAP Rates -->
            <div class="row w-100 mb-5 py-1">
                <div class="col-sm-3">
                    <div class="d-flex flex-column">
                        <span class="text-color fs-7 fw-bold">MAP Rates</span>
                        <span class="text-color-secondary fw-semibold fs-8">Includes room, breakfast & dinner</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group input-group-solid">
                        <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                        <input type="number" class="form-control form-control-solid text-color-secondary"
                            name="b2b_rate_map" placeholder="Enter MAP rate" value="3000">
                    </div>
                </div>
            </div>

            <div class="position-relative my-3 pb-5">
                <div class="separator-vertical"></div>
            </div>
            <!-- Non-Refundable Rate -->
            <div class="row w-100 mb-5 py-1">
                <div class="col-sm-3">
                    <div class="d-flex flex-column">
                        <span class="text-color fs-7 fw-bold">Non Refundable Rate</span>
                        <span class="text-color-secondary fw-semibold fs-8">Discount when guests book non-refundable
                            option</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group input-group-solid">
                        <input type="number" class="form-control form-control-solid text-color-secondary"
                            name="non_refundable_rate" placeholder="% Discount" value="10">
                        <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">%</span>
                    </div>
                </div>
            </div>

            <!-- Weekly Rate -->
            <div class="row w-100 mb-5 py-1">
                <div class="col-sm-3">
                    <div class="d-flex flex-column">
                        <span class="text-color fs-7 fw-bold">Weekly Rates</span>
                        <span class="text-color-secondary fw-semibold fs-8">Discount when guests book for a week</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group input-group-solid">
                        <input type="number" class="form-control form-control-solid text-color-secondary"
                            name="weekly_rate" placeholder="% Discount" value="15">
                        <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">%</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-end">
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Save Rate Plans</button>
            </div>
        </div>
    </form>

    <div class="alert alert-success" style="display: none;">
        Rate plan saved successfully!
    </div>


</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize flatpickr for check-in time field
        flatpickr("#check_in", {
            enableTime: true, // Enable time selection
            noCalendar: true, // Disable calendar, time only
            dateFormat: "H:i", // Set time format to Hours:Minutes
        });

        // Initialize flatpickr for check-out time field
        flatpickr("#check_out", {
            enableTime: true, // Enable time selection
            noCalendar: true, // Disable calendar, time only
            dateFormat: "H:i", // Set time format to Hours:Minutes
        });
    });



    // Function to load checkbox states from localStorage
    function loadCheckboxStates() {
        let checkboxes = document.querySelectorAll('.form-check-input');

        checkboxes.forEach(function(checkbox) {
            let checkboxState = localStorage.getItem(checkbox.id);
            if (checkboxState === 'true') {
                checkbox.checked = true;
            } else if (checkboxState === 'false') {
                checkbox.checked = false;
            }
        });
    }

    // Call the function to load saved checkbox states when the page loads
    window.onload = function() {
        loadCheckboxStates();
    }

    // Toggle enable/disable and show/hide the Save button
    document.getElementById('disabled-btn').addEventListener('click', function() {
        // Get all checkboxes
        let checkboxes = document.querySelectorAll('.form-check-input');

        // Loop through checkboxes and toggle the disabled attribute
        checkboxes.forEach(function(checkbox) {
            checkbox.disabled = !checkbox.disabled;
        });

        // Toggle the Save Breakfast Details button visibility
        let saveBtn = document.getElementById('save_aminites_btn');
        saveBtn.classList.toggle('d-none');
    });

    // Disable checkboxes when save button is clicked, save states to localStorage, and hide the save button
    document.getElementById('save_aminites_btn').addEventListener('click', function() {
        // Get all checkboxes
        let checkboxes = document.querySelectorAll('.form-check-input');

        // Loop through checkboxes, set them to disabled, and save their states in localStorage
        checkboxes.forEach(function(checkbox) {
            checkbox.disabled = true;
            localStorage.setItem(checkbox.id, checkbox.checked);
        });

        // Hide the Save Breakfast Details button again
        let saveBtn = document.getElementById('save_aminites_btn');
        saveBtn.classList.add('d-none');

    });
</script>

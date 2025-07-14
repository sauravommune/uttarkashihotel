<div class="d-flex flex-column gap-8">
    <div class="d-flex align-items-center justify-content-between border-bottom pb-4">
        <h2>House Rules</h2>
        <button class="btn btn-sm btn-primary d-flex align-items-center gap-1 fs-7" id="disabled-btn">
            <span class="material-symbols-outlined fs-1">edit</span>Edit
        </button>
    </div>

    <div class="row">
        <div class="col-md-3">
            <h4>Check In & Check Out Time</h4>
        </div>
        <div class="col-md-9">
            <div class="d-flex align-content-center gap-8">
                <input type="text" class="form-control form-control-solid" id="check_in"
                    placeholder="name@example.com" />
                <input type="text" class="form-control form-control-solid" id="check_out"
                    placeholder="name@example.com" />
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <h4>Do you allow children?</h4>
        </div>
        <div class="col-md-9">
            <div class="d-flex align-content-center gap-8">
                <div class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" name="response" value="yes" id="flexRadioYes" />
                    <label class="form-check-label" for="flexRadioYes">
                        Yes
                    </label>
                </div>

                <div class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" name="response" value="no" id="flexRadioNo" />
                    <label class="form-check-label" for="flexRadioNo">
                        No
                    </label>
                </div>
            </div>


        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <h4>Do you allow pets?</h4>
        </div>
        <div class="col-md-9">
            <div class="d-flex align-content-center gap-8">
                <div class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" name="response" value="yes" id="flexRadioYes" />
                    <label class="form-check-label" for="flexRadioYes">
                        Yes
                    </label>
                </div>

                <!-- Add "Upon request" radio option here -->
                <div class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" name="response" value="upon_request"
                        id="flexRadioUponRequest" />
                    <label class="form-check-label" for="flexRadioUponRequest">
                        Upon request
                    </label>
                </div>

                <div class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" name="response" value="no" id="flexRadioNo" />
                    <label class="form-check-label" for="flexRadioNo">
                        No
                    </label>
                </div>
            </div>


        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <h4>Property Rules</h4>
        </div>
        <div class="col-sm-9">
            <div class="d-flex flex-column gap-8">
                <div>
                    <textarea name="property_rules_general" class="form-control-solid form-control mt-4" id="general">
                            <ul class="editor_hotel">
                                <li>
                                    Couple Friendly.
                                </li>
                                <li>
                                    Unmarried couples/guests with Local IDs are allowed.
                                </li>
                                <li>
                                    Guests below 18 years of age are not allowed at the property.
                                </li>
                                <li>
                                    Passport, Aadhar, Driving License and Govt. ID are accepted as ID proof(s).
                                </li>
                                <li>
                                    Pets are not allowed.
                                </li>
                                <li>
                                    Outside food is not allowed.
                                </li>
                                <li>
                                    Smoking within the premises is not allowed.
                                </li>
                            </ul>
                        </textarea>
                </div>
            </div>
        </div>
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



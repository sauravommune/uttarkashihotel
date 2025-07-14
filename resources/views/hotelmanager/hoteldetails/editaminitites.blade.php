<div class="d-flex flex-column gap-8">
    <div class="d-flex align-items-center justify-content-between border-bottom pb-4">
        <h2>Amenities</h2>
        <button class="btn btn-sm btn-primary d-flex align-items-center gap-1 fs-7" id="disabled-btn">
            <span class="material-symbols-outlined fs-1" >edit</span>Edit
        </button>
    </div>
    <div class="row hotel-Amenities">
        <div class="col-md-3 col-4 mt-2 mt-md-0">
            <h4>Amenities</h4>
        </div>
        <div class="col-md-9 col-8 mt-2 mt-md-0">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-check mt-0 mt-md-0">
                        <input class="form-check-input" type="checkbox" value="" id="restaurant" disabled />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="restaurant">Restaurant</label>
                    </div>
                    <div class="form-check mt-8">
                        <input class="form-check-input" type="checkbox" value="" id="roomService" disabled />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="roomService">Room Service</label>
                    </div>
                    <div class="form-check mt-8">
                        <input class="form-check-input" type="checkbox" value="" id="bar" disabled />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="bar">Bar</label>
                    </div>
                    <div class="form-check mt-8">
                        <input class="form-check-input" type="checkbox" value="" id="frontDesk" disabled />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="frontDesk">24-hour front desk</label>
                    </div>
                    <div class="form-check mt-8">
                        <input class="form-check-input" type="checkbox" value="" id="sauna" disabled />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="sauna">Sauna</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-check mt-8 mt-md-0">
                        <input class="form-check-input" type="checkbox" value="" id="fitnessCenter" disabled />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="fitnessCenter">Fitness Centre</label>
                    </div>
                    <div class="form-check mt-8">
                        <input class="form-check-input" type="checkbox" value="" id="gym" disabled />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="gym">Open air gym</label>
                    </div>
                    <div class="form-check mt-8">
                        <input class="form-check-input" type="checkbox" value="" id="terrace" disabled />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="terrace">Terrace</label>
                    </div>
                    <div class="form-check mt-8">
                        <input class="form-check-input" type="checkbox" value="" id="airportPickup" disabled />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="airportPickup">Airport Pickup/Drop Service</label>
                    </div>
                    <div class="form-check mt-8">
                        <input class="form-check-input" type="checkbox" value="" id="wifi" disabled />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="wifi">Free Wifi</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-check mt-8 mt-md-0">
                        <input class="form-check-input" type="checkbox" value="" id="airConditioner" disabled />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="airConditioner">Air Conditioner</label>
                    </div>
                    <div class="form-check mt-8">
                        <input class="form-check-input" type="checkbox" value="" id="swimmingPool" disabled />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="swimmingPool">Swimming Pool</label>
                    </div>
                    <div class="form-check mt-8">
                        <input class="form-check-input" type="checkbox" value="" id="playArea" disabled />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="playArea">Children's Play Area</label>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end d-none" id="save_aminites_btn">

                <!-- Toggle Button -->
                <button id="disabled-btn" class="btn btn-primary mt-3">Enable Editing</button>

                <!-- Save Amenities Button -->
                <button id="save_aminites_btn" class="btn btn-success mt-3 d-none">Save Amenities</button>

            </div>
        </div>
    </div>
</div>

<script>
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

        // Toggle the Save Amenities button visibility
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

        // Hide the Save Amenities button again
        let saveBtn = document.getElementById('save_aminites_btn');
        saveBtn.classList.add('d-none');
    });
</script>

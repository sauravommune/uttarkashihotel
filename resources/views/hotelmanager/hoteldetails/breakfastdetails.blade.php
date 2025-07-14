<div class="d-flex flex-column gap-8">
    <div class="d-flex align-items-center justify-content-between border-bottom pb-4">
        <h2>Breakfast Details</h2>
        <button class="btn btn-sm btn-primary d-flex align-items-center gap-1 fs-7" id="disabled-btn">
            <span class="material-symbols-outlined fs-1">edit</span>Edit
        </button>
    </div>

    <div class="row">
        <div class="col-md-3">
            <h4>Do you serve guests breakfast?</h4>
        </div>
        <div class="col-md-9 mt-4 mt-md-0">
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
            <h4>Average cost of breakfast per person</h4>
        </div>
        <div class="col-md-4">
            <!--begin::Input group-->
            <div class="input-group input-group-solid mb-5">
                <input type="text" class="form-control form-control-solid" placeholder="Average cost of breakfast"
                    value="600" aria-label="Username" aria-describedby="basic-addon1" />
                <span class="input-group-text" id="basic-addon1">₹</span>
            </div>
            <!--end::Input group-->
        </div>
    </div>

    <div class="row hotel-Amenities">
        <div class="col-md-3">
            <h4>What type of breakfast do you serve</h4>
            <p class="mb-0 text-color-secondary">Select all that apply</p>
        </div>
        <div class="col-md-9 mt-4 mt-md-0">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-check mt-0">
                        <input class="form-check-input" type="checkbox" value="" id="indian" />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="indian">Indian</label>
                    </div>
                    <div class="form-check mt-8">
                        <input class="form-check-input" type="checkbox" value="" id="chinese" />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="chinese">Chinese</label>
                    </div>
                    <div class="form-check mt-8">
                        <input class="form-check-input" type="checkbox" value="" id="italian" />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="italian">Italian</label>
                    </div>
                    <div class="form-check mt-8">
                        <input class="form-check-input" type="checkbox" value="" id="mexican" />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="mexican">Mexican</label>
                    </div>
                    <div class="form-check mt-8">
                        <input class="form-check-input" type="checkbox" value="" id="japanese" />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="japanese">Japanese</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-check mt-8 mt-md-0">
                        <input class="form-check-input" type="checkbox" value="" id="thai" />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="thai">Thai</label>
                    </div>
                    <div class="form-check mt-8">
                        <input class="form-check-input" type="checkbox" value="" id="french" />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="french">French</label>
                    </div>
                    <div class="form-check mt-8">
                        <input class="form-check-input" type="checkbox" value="" id="greek" />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="greek">Greek</label>
                    </div>
                    <div class="form-check mt-8">
                        <input class="form-check-input" type="checkbox" value="" id="spanish" />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="spanish">Spanish</label>
                    </div>
                    <div class="form-check mt-8">
                        <input class="form-check-input" type="checkbox" value="" id="korean" />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="korean">Korean</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-check mt-8 mt-md-0">
                        <input class="form-check-input" type="checkbox" value="" id="vegan" />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="vegan">Vegan</label>
                    </div>
                    <div class="form-check mt-8">
                        <input class="form-check-input" type="checkbox" value="" id="vegetarian" />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="vegetarian">Vegetarian</label>
                    </div>
                    <div class="form-check mt-8">
                        <input class="form-check-input" type="checkbox" value="" id="seafood" />
                        <label class="form-check-label text-color-secondary fw-medium fs-7" for="seafood">Seafood</label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end d-none" id="save_aminites_btn">

                <!-- Toggle Button -->
                <button id="disabled-btn" class="btn btn-primary mt-3">Enable Editing</button>

                <!-- Save Breakfast Details Button -->
                <button id="save_aminites_btn" class="btn btn-success mt-3 d-none">Save Breakfast Details</button>

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

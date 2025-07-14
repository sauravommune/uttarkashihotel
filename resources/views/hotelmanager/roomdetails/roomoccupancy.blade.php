<div class="d-flex flex-column gap-8">
    <div class="d-flex align-items-center justify-content-between border-bottom pb-4">
        <h2>Room Occupancy</h2>
        <button class="btn btn-sm btn-primary d-flex align-items-center gap-1 fs-7" id="disabled-btn">
            <span class="material-symbols-outlined fs-1">edit</span>Edit
        </button>
    </div>

    <div class="row">
        <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3">
            <!--begin::Card widget 4-->
            <div class="card card-flush mb-5 mb-xl-6">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column gap-2">
                    <!--begin::Subtitle-->
                    <span class="text-color-secondary pt-1 fw-semibold fs-6">Total Bookings</span>
                    <!--end::Subtitle-->
                    <!--begin::Labels-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <!--begin::Amount Display-->
                            <div class="position-relative me-2">
                                <span class="fs-2 fw-bold text-color lh-1 ls-n2" id="totalBookings">29,420</span>
                                <!--end::Amount Display-->
                                <!--begin::Edit Icon-->
                                <button class="btn btn-icon btn-sm edit-icon position-absolute" title="Edit"  onclick="editAmount('totalBookings')">
                                    <i class="ki-outline ki-pencil fs-5 text-primary"></i> <!-- Replace with your icon -->
                                </button>
                                <!--end::Edit Icon-->
                            </div>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Labels-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 4-->
        </div>

        <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3">
            <!--begin::Card widget 4-->
            <div class="card card-flush mb-5 mb-xl-6">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column gap-2">
                    <!--begin::Subtitle-->
                    <span class="text-color-secondary pt-1 fw-semibold fs-6">Available</span>
                    <!--end::Subtitle-->
                    <!--begin::Labels-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <!--begin::Amount Display-->
                            <div class="position-relative me-2">
                                <span class="fs-2 fw-bold text-color lh-1 ls-n2" id="available">29,420</span>
                                <!--end::Amount Display-->
                                <!--begin::Edit Icon-->
                                <button class="btn btn-icon btn-sm edit-icon position-absolute" title="Edit"  onclick="editAmount('available')">
                                    <i class="ki-outline ki-pencil fs-5 text-primary"></i>
                                </button>
                                <!--end::Edit Icon-->
                                <!--begin::Badge-->
                                <span class="badge badge-light-success fs-base">
                                    <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>2.2%
                                </span>
                                <!--end::Badge-->
                            </div>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Labels-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 4-->
        </div>

        <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3">
            <!--begin::Card widget 4-->
            <div class="card card-flush mb-5 mb-xl-6">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column gap-2">
                    <!--begin::Subtitle-->
                    <span class="text-color-secondary pt-1 fw-semibold fs-6">Booked</span>
                    <!--end::Subtitle-->
                    <!--begin::Labels-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <!--begin::Amount Display-->
                            <div class="position-relative me-2">
                                <span class="fs-2 fw-bold text-color lh-1 ls-n2" id="booked">29,420</span>
                                <!--end::Amount Display-->
                                <!--begin::Edit Icon-->
                                <button class="btn btn-icon btn-sm edit-icon position-absolute" title="Edit"  onclick="editAmount('booked')">
                                    <i class="ki-outline ki-pencil fs-5 text-primary"></i>
                                </button>
                                <!--end::Edit Icon-->
                                <!--begin::Badge-->
                                <span class="badge badge-light-success fs-base">
                                    <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>2.2%
                                </span>
                                <!--end::Badge-->
                            </div>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Labels-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 4-->
        </div>

        <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3">
            <!--begin::Card widget 4-->
            <div class="card card-flush mb-5 mb-xl-6">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column gap-2">
                    <!--begin::Subtitle-->
                    <span class="text-color-secondary pt-1 fw-semibold fs-6">Out of Order/Service</span>
                    <!--end::Subtitle-->
                    <!--begin::Labels-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <!--begin::Amount Display-->
                            <div class="position-relative me-2">
                                <span class="fs-2 fw-bold text-color lh-1 ls-n2" id="outOfOrder">29,420</span>
                                <!--end::Amount Display-->
                                <!--begin::Edit Icon-->
                                <button class="btn btn-icon btn-sm edit-icon position-absolute" title="Edit"  onclick="editAmount('outOfOrder')">
                                    <i class="ki-outline ki-pencil fs-5 text-primary"></i>
                                </button>
                                <!--end::Edit Icon-->
                                <!--begin::Badge-->
                                <span class="badge badge-light-success fs-base">
                                    <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>2.2%
                                </span>
                                <!--end::Badge-->
                            </div>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Labels-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 4-->
        </div>
    </div>
</div>


<!-- JavaScript to enable input on icon click -->
<script>
    function editAmount(id) {
        const span = document.getElementById(id);
        const currentValue = span.textContent;

        // Create an input element
        const input = document.createElement('input');
        input.type = 'text';
        input.value = currentValue;
        input.className = 'fs-2 fw-bold text-color lh-1 ls-n2 border-0';
        input.style.width = 'fit-content'; // Adjust width if needed

        // Replace the span with the input
        span.parentNode.replaceChild(input, span);

        // Focus the input and select its content
        input.focus();
        input.select();

        // Change the button to save
        const editButton = input.nextElementSibling;
        editButton.innerHTML = '<span class="material-symbols-outlined fs-1 text-success mt-2">check</span>'; // Change icon to check mark

        editButton.setAttribute('onclick', `saveAmount('${id}', this)`); // Update onclick to save
    }

    function saveAmount(id, button) {
        const input = button.previousElementSibling;
        const newValue = input.value;

        // Create a new span to replace the input
        const span = document.createElement('span');
        span.id = id;
        span.className = 'fs-2 fw-bold text-color lh-1 ls-n2';
        span.textContent = newValue;

        // Replace the input with the new span
        input.parentNode.replaceChild(span, input);

        // Change the button back to edit
        button.innerHTML = '<i class="ki-outline ki-pencil fs-5 text-primary"></i>'; // Change icon back to pencil
        button.setAttribute('onclick', `editAmount('${id}')`); // Update onclick to edit
    }
</script>
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

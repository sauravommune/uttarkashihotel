<div class="d-flex flex-column gap-8">
    <div class="d-flex align-items-center justify-content-between border-bottom pb-4">
        <h2>Invoicing & Taxes</h2>
        <button class="btn btn-sm btn-primary d-flex align-items-center gap-1 fs-7" id="disabled-btn">
            <span class="material-symbols-outlined fs-1">edit</span>Edit
        </button>
    </div>

    <div class="d-flex flex-column gap-1">
        <h3 class="mb-0 text-color">Invoicing</h3>
        <p class="mb-0 text-color-secondary fs-7">At the beginning of each month we will send you an invoice for all
            complete bookings in the previous month.</p>
    </div>

    <div class="row">
        <div class="col-md-3">
            <h4>What name should be on the Invoice?</h4>
        </div>
        <div class="col-md-6 mt-2 mt-md-0">
            <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select a hotel">
                <option></option>
                <option value="hotel1">The Grand Hotel</option>
                <option value="hotel2">Sunset Resort</option>
                <option value="hotel3">Mountain View Inn</option>
                <option value="hotel4">Oceanfront Paradise</option>
                <option value="hotel5">Luxury Suites</option>
                <option value="hotel6">City Center Hotel</option>
                <option value="hotel7">Riverside Lodge</option>
                <option value="hotel8">Skyline Towers</option>
            </select>
        </div>
    </div>

    <div class="d-flex flex-column gap-1 border-top pt-8">
        <h3 class="mb-0 text-color">Taxes</h3>
        <p class="mb-0 text-color-secondary fs-7">Due to regulations established by Indian Government, we need the
            following details. By submitting this information, you are confirming that your PAN and state registration
            are accurate.</p>
    </div>

    <div class="row">
        <div class="col-md-3">
            <h4>Are you registered for GST purposes?</h4>
        </div>
        <div class="col-md-6 mt-2 mt-md-0">
            <div class="d-flex align-items-center gap-8">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tax" value="yes" id="flexCheckYes" />
                    <label class="form-check-label" for="flexCheckYes">
                        Yes (Taxes applicable)
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tax" value="no" id="flexCheckNo" />
                    <label class="form-check-label" for="flexCheckNo">
                        No (No taxes)
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <h4>PAN Number</h4>
        </div>
        <div class="col-md-6 mt-2 mt-md-0">
            <input type="text" class="form-control form-control-solid" placeholder="Enter PAN number (e.g., ABCDE1234F)" />
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3">
            <h4>Aadhar Number</h4>
        </div>
        <div class="col-md-6 mt-2 mt-md-0">
            <input type="text" class="form-control form-control-solid" placeholder="Enter Aadhar number (12-digit)" />
        </div>
    </div>



</div>

<script>
    // Get the checkboxes
    const checkYes = document.getElementById('flexCheckYes');
    const checkNo = document.getElementById('flexCheckNo');

    // Add event listeners to uncheck the other when one is checked
    checkYes.addEventListener('change', function() {
        if (checkYes.checked) {
            checkNo.checked = false;
        }
    });

    checkNo.addEventListener('change', function() {
        if (checkNo.checked) {
            checkYes.checked = false;
        }
    });
</script>

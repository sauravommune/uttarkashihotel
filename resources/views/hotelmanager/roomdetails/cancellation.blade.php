<div class="d-flex flex-column gap-8">
    <div class="d-flex align-items-center justify-content-between border-bottom pb-4">
        <h2>Cancellation Policies</h2>
        <button class="btn btn-sm btn-primary d-flex align-items-center gap-1 fs-7" id="disabled-btn">
            <span class="material-symbols-outlined fs-1">edit</span>Edit
        </button>
    </div>
    <div class="row w-100 mb-5 pb-1">
        <div class="col-sm-3">
            <label class="fw-semibold mb-2 mt-5">When can guests cancel their bookings for free?</label>
            <span id="gust_cancel_error" class="text-danger"></span>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="position-relative">
                <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-solid" placeholder="Enter time/day"
                        id="guest_cancel" name="guest_cancel" value="3"> <!-- Example static value -->

                    <div class="position-absolute-select2">
                        <select class="form-select form-select-solid" name="measure_day">
                            <option value="days before arrival" selected>Days before arrival</option>
                            <!-- Static selected value -->
                            <option value="hours before arrival">Hours before arrival</option>
                        </select>
                    </div>
                    <span id="measure_day_error" class="text-danger"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="position-relative mb-5 py-1">
        <div class="separator-vertical"></div>
    </div>

    <div class="row w-100 mb-5 pb-1 position-relative">
        <div class="col-sm-3">
            <label class="fw-semibold mb-2 mt-5">How much are guests charged if they cancel after the free cancellation
                period?</label>
            <span id="cancellation_period_error" style="color:red"></span>
        </div>

        <div class="col-sm-6 col-md-4 mt-5">
            <div class="position-relative">
                <div class="d-flex align-items-center gap-20">
                    <div class="form-check">
                        <input class="form-check-input" name="cancellation_period" type="radio" value="100"
                            id="cancellation_period_100" checked /> <!-- Static checked value -->
                        <label class="form-check-label" for="cancellation_period_100">100%</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="cancellation_period" type="radio" value="75"
                            id="cancellation_period_75" />
                        <label class="form-check-label" for="cancellation_period_75">75%</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="cancellation_period" type="radio" value="50"
                            id="cancellation_period_50" />
                        <label class="form-check-label" for="cancellation_period_50">50%</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="cancellation_period" type="radio" value="25"
                            id="cancellation_period_25" />
                        <label class="form-check-label" for="cancellation_period_25">25%</label>
                    </div>
                </div>
            </div>
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

<style>
.table tbody tr:hover {
    background: none !important;
}

.table tbody tr {
    border-bottom: 0px solid !important;
}
</style>
<x-app-layout>
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-18 m-0">
                        {{ $title }}
                    </h1>

                    <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('superAdmin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('rooms', encode($hotel?->id)) }}" class="text-muted text-hover-primary">{{ $hotel?->name }} Rooms Lists</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{ $title }}</li>
                        <!--end::Item-->
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid create-hotel">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Stepper-->
            <!--begin::Stepper-->
            <div class="stepper stepper-pills" id="create_rooms">
                <!--begin::Nav-->
                <div class="stepper-nav overflow-auto">
                    <!--begin::Step 1-->
                    <div class="stepper-item ms-0 mx-8 my-4 current" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Label-->
                            <div class="stepper-label" data-kt-stepper-action="click">
                                <a class="stepper-title">
                                    Room Details
                                </a>
                            </div>

                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Line-->
                        <div class="stepper-line h-40px"></div>
                        <!--end::Line-->
                    </div>
                    <!--end::Step 1-->

                    <!--begin::Step 3-->
                    <div class="stepper-item mx-8 my-4"  data-kt-stepper-element="nav" data-kt-stepper-action="step">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Label-->
                            <div class="stepper-label" data-kt-stepper-action="click">
                                <a class="stepper-title">
                                    Amenities
                                    
                                </a>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Line-->
                        <div class="stepper-line h-40px"></div>
                        <!--end::Line-->
                    </div>
                    <!--end::Step 3-->

                    <!--begin::Step 5-->
                    <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Label-->
                            <div class="stepper-label" data-kt-stepper-action="click">
                                <a class="stepper-title">
                                    Cancellation Policy
                                </a>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Line-->
                        <div class="stepper-line h-40px"></div>
                        <!--end::Line-->
                    </div>
                    <!--end::Step 5-->

                    <!--begin::Step 6-->
                    <div class="stepper-item mx-8 my-4"  data-kt-stepper-element="nav" data-kt-stepper-action="step">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Label-->
                            <div class="stepper-label" data-kt-stepper-action="click">
                                <a class="stepper-title">

                                    Upload Images
                                </a>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Line-->
                        <div class="stepper-line h-40px"></div>
                        <!--end::Line-->
                    </div>
                    <!--end::Step 6-->
                </div>

                <!--end::Nav-->
                {{-- <div class="progress h-10px mb-8" id="progress_bar_container" role="progressbar"
                    aria-label="Example 20px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: 0%" id="progress_bar_width"></div>
                </div> --}}


                <div class="mb-5">
                    <!--begin::Step 1-->
                    @include('rooms.step1_form')
                    <!--end::Step 1-->

                    <!--begin::Step 2-->
                    @include('rooms.step2_form')
                    <!--end::Step 2-->

                    <!--begin::Step 3-->
                    {{-- @include('rooms.step3_form') --}}
                    <!--end::Step 3-->

                    <!--begin::Step 4-->
                    @include('rooms.step4_form')
                    <!--end::Step 4-->

                    <!--begin::Step 5-->
                    @include('rooms.step5_form')
                    <!--end::Step 5-->

                    <!--begin::Step 6-->
                    <!--end::Step 6-->

                </div>

                <div class="d-flex flex-stack mt-10">
                    <!--begin::Wrapper-->
                    <div class="me-2">
                        <button type="button" id="back_stipper_btn" class="btn btn-light btn-active-light-primary"
                            data-kt-stepper-action="previous">
                            Back
                        </button>
                    </div>
                    <!--end::Wrapper-->

                    <!--begin::Wrapper-->
                    <div>
                        {{-- <button type="submit" id="submit_stipper_btn" class="btn btn-primary"
                            data-kt-stepper-action="submit">
                            <span class="indicator-label">
                                Submit
                            </span>
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>

                        <button type="submit" id="continue_stipper_btn" class="btn btn-primary"
                            data-kt-stepper-action="next">
                            Continue
                        </button> --}}

                        <button type="submit" id="submit_stipper_btn" class="btn btn-primary"
                            data-kt-stepper-action="submit">
                            <span class="indicator-label">
                                Submit
                            </span>
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>

                        <button type="button" id="continue_stipper_btn" class="btn btn-primary"
                            data-kt-stepper-action="next">
                            Continue
                        </button>

                    </div>
                    <!--end::Wrapper-->
                </div>

                <!--end::Form-->
            </div>
            <!--end::Stepper-->
            <!--end::Stepper-->
        </div>
    </div>

    @push('scripts')
    <script>
    $(document).ready(function() {
        // Stepper element
        var element = document.querySelector("#create_rooms");
        
        var stepper = new KTStepper(element);

        stepper.on("kt.stepper.click", function(stepper) {

            if($('#step1form').valid()){

              stepper.goTo(stepper.getClickedStepIndex()); // go to clicked step

            }
        });

        stepper.on("kt.stepper.next", function(stepper) {
            var currentStep = stepper.getCurrentStepIndex();
            $('#step' + currentStep).click();
            if ($('#step' + currentStep + 'form').valid()) {
                stepper.goNext(); // go next step
                // Update progress bar only after validation
                updateProgressBarWidth();
            }
        });

        // Handle previous step
        stepper.on("kt.stepper.previous", function(stepper) {
            stepper.goPrevious(); // go previous step
        });

        // Function to update progress bar width
        function updateProgressBarWidth() {
            var containerWidth = $('#progress_bar_container').width();
            var currentWidth = $('#progress_bar_width').width();
            var newWidth = Math.min(currentWidth + containerWidth * 0.25,
                containerWidth); // Ensure the width doesn't exceed 100%
            $('#progress_bar_width').width(newWidth);
            updateProgressBar(); // Call to update separators
        }

        // Progress bar separator logic
        function updateProgressBar() {
            var containerWidth = $('#progress_bar_container').width();
            var progressWidth = $('#progress_bar_width').width();
            var steps = Math.ceil(progressWidth / (containerWidth * 0.25));
            var separatorWidth = 3;

            $('#progress_bar_container .separator').remove();

            for (var i = 1; i <= steps; i++) {
                $('<div class="separator"></div>').css({
                    left: (i * (containerWidth * 0.25)) + (separatorWidth * (i - 1)) + 'px'
                }).appendTo('#progress_bar_container');
            }
        }

        $('#continue_stipper_btn').click(function() {

            var containerWidth = $('#progress_bar_container').width();
            var currentWidth = $('#progress_bar_width').width();
            var newWidth = Math.min(currentWidth + containerWidth * 0.125,
                containerWidth); // Ensure the width doesn't exceed 100%
            $('#progress_bar_width').width(newWidth);
            updateProgressBar();
        });

        $('#back_stipper_btn').click(function() {
            var containerWidth = $('#progress_bar_container').width();
            var currentWidth = $('#progress_bar_width').width();
            var newWidth = Math.max(currentWidth - containerWidth * 0.25,
                0);
            $('#progress_bar_width').width(newWidth);
            updateProgressBar();
        });

        $('#submit_stipper_btn').click(function() {
            $('#step4').click();
            if ($('#step4form').valid()) {
                $('#progress_bar_width').width('100%');
                updateProgressBar();
            }
        });

        updateProgressBar();
    });
    </script>


    <script>
    $(document).ready(function() {
        var maxField = 100;
        var addButton = $("#add_btn");
        var wrapper = $("#room_bed");
        let bedType = @json($bed_type);
        var x = 1;
        var length1 = 0;

        function ucwords(str) {
            return str.replace(/\b\w/g, function(c) {
                return c.toUpperCase();
            });
        }


        $(addButton).click(function() {
            if (x < maxField) {
                x++;
                ++length1;

                // Generate HTML for new bed type selection
                var fieldHTML = `<div class="d-flex flex-column gap-4"><div class="row mb-3 bed_type">
                <div class="col-md-4">
                    <select name="bed_type[${length1}]" class="form-select form-select-solid select2" data-placeholder="Select bed type" style="width: 100%;" required>
                        <option></option>
                            ${bedType.map(bed => `<option value="${bed.id}">${ucwords(bed.bed_type)}</option>`).join('')}

                    </select>
                </div>
                <div class="col-md-3">
                    <div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="0" data-kt-dialer-max="10" data-kt-dialer-step="1">
                        <button type="button" class="btn btn-icon box-44-end position-absolute translate-middle-y top-50 start-0 bg-light-dark" data-kt-dialer-control="decrease">
                            <span class="material-symbols-outlined text-color-secondary">remove</span>
                        </button>
                        <input type="text" class="form-control form-control-solid border-custom h-44px text-center text-color-secondary" data-kt-dialer-control="input" placeholder="0" name="bed[${length1}]" value="1" required>
                        <button type="button" class="btn btn-icon box-44-start position-absolute translate-middle-y top-50 end-0 bg-light-dark" data-kt-dialer-control="increase">
                            <span class="material-symbols-outlined text-color-secondary">add</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-center">
                    <button type="button" class="btn btn-dark box-40 remove_button">
                        <span class="material-symbols-outlined fs-1">delete</span>
                    </button>
                </div>
            </div></div>`;

                $(wrapper).append(fieldHTML); // Add new field

                updateDropdownOptions();

                $(wrapper).find(`select[name="bed_type[${length1}]"]`).change(updateDropdownOptions);
            }
        });

        function updateDropdownOptions() {
            // Get selected values
            let selectedValues = [];
            $('select[name^="bed_type"]').each(function() {
                let val = $(this).val();
                if (val) {
                    selectedValues.push(val);
                }
            });

            $('select[name^="bed_type"]').each(function() {
                $(this).find('option').each(function() {
                    if (selectedValues.includes($(this).val()) && !$(this).is(':selected')) {
                        $(this).attr('disabled', true);
                    } else {
                        $(this).attr('disabled', false);
                    }
                });
            });
        }
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).closest('.row').remove();
            x--;
            updateDropdownOptions();
        });

        $('#room_bed').on('change', 'select[name^="bed_type"]', updateDropdownOptions);
    });
    </script>



    <script>
    $(document).on('click', '.delete_add_bed', function() {
        var bedId = $(this).data('id');
        var bedDiv = 'bed-' + bedId;

        Swal.fire({
            title: 'Are you sure?',
            text: "Delete this bed?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('delete.roomBed') }}",
                    type: 'get',
                    data: {
                        bedId: bedId,
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            $('#' + bedDiv).remove();
                            Swal.fire(
                                'Deleted!',
                                'The bed has been deleted.',
                                'success'
                            );
                        } else {
                            Swal.fire(
                                'Error!',
                                'Failed to delete the bed. Please try again.',
                                'error'
                            );
                        }
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'Something went wrong. Please try again later.',
                            'error'
                        );
                    }
                });
            }
        });
    });
    </script>
    @endpush
</x-app-layout>

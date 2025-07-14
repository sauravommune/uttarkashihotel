<x-app-layout>
    <style>
    .select2-container--bootstrap5 .select2-selection--single .select2-selection__placeholder {
        color: #4B5675;
    }
    </style>
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
                            <a href="{{ route('hotel') }}" class="text-muted text-hover-primary">Hotels</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{ $title }}</li>
                        <!--end::Item-->
                    </ul>
                </div>

                @if($hotel->rooms->isNotEmpty())
                <div class="button-section">
                    <a href="{{ route('hotel.details', $hotel?->slug) . '/' }}" target="_blank" class="btn btn-primary" title="Preview">
                        <i class="bi bi-eye-fill px-1"></i>Preview
                    </a>
               </div>
              @endif
                
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid create-hotel">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Stepper-->
            <div class="stepper stepper-pills" id="create_hotel">
                <!--begin::Nav-->
                <div class="stepper-nav overflow-auto">
                    <!--begin::Step 1-->
                    <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Label-->
                            <div class="stepper-label" data-kt-stepper-action="click">
                                <a class="stepper-title" id="hotel_step1">
                                    Hotel Details
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

                    <!--begin::Step 2-->
                    <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Label-->
                            <div class="stepper-label" data-kt-stepper-action="click">
                                <a class="stepper-title" id="hotel_step2">
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
                    <!--end::Step 2-->

                    <!--begin::Step 3-->
                    <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Label-->
                            <div class="stepper-label" data-kt-stepper-action="click">
                                <a class="stepper-title" id="hotel_step3">
                                    Parking Facility
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

                    <!--begin::Step 4-->
                    <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Label-->
                            <div class="stepper-label" data-kt-stepper-action="click">
                                <a class="stepper-title" id="hotel_step4">
                                    Breakfast Details
                                </a>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Line-->
                        <div class="stepper-line h-40px"></div>
                        <!--end::Line-->
                    </div>
                    <!--end::Step 4-->

                    <!--begin::Step 5-->
                    <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Label-->
                            <div class="stepper-label" data-kt-stepper-action="click">
                                <a class="stepper-title" id="hotel_step5">
                                    House Rules
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
                    <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Label-->
                            <div class="stepper-label" data-kt-stepper-action="click">
                                <a class="stepper-title" id="hotel_step6">
                                    Banking Details & Invoicing
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

                    <!--begin::Step 7-->
                    <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Label-->
                            <div class="stepper-label" data-kt-stepper-action="click">
                                <a class="stepper-title" id="hotel_step7">
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
                    <!--end::Step 7-->

                    <!--begin::Step 8-->
                    <div class="stepper-item mx-8 my-4" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                        <!--begin::Wrapper-->
                        <div class="stepper-wrapper d-flex align-items-center">
                            <!--begin::Label-->
                            <div class="stepper-label" data-kt-stepper-action="click">
                                <a class="stepper-title" id="hotel_step8">
                                    Owner Details
                                </a>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Line-->
                        <div class="stepper-line h-40px"></div>
                        <!--end::Line-->
                    </div>
                    <!--end::Step 8-->
                </div>
                <!--end::Nav-->
 
                <div class="mb-5">
                    <!--begin::Step 1-->
                    @include('hotelmaster.hotelForm.step1')
                    <!--end::Step 1-->

                    <!--begin::Step 2-->
                    @include('hotelmaster.hotelForm.step2')
                    <!--end::Step 2-->

                    <!--begin::Step 3-->
                    @include('hotelmaster.hotelForm.step3')
                    <!--end::Step 3-->

                    <!--begin::Step 4-->
                    @include('hotelmaster.hotelForm.step4')
                    <!--end::Step 4-->

                    <!--begin::Step 5-->
                    @include('hotelmaster.hotelForm.step5')
                    <!--end::Step 5-->

                    <!--begin::Step 6-->
                    @include('hotelmaster.hotelForm.step6')
                    <!--end::Step 6-->

                    <!--begin::Step 7-->
                    @include('hotelmaster.hotelForm.step7')
                    <!--end::Step 7-->

                    <!--begin::Step 8-->
                    @include('hotelmaster.hotelForm.step8')
                    <!--end::Step 8-->

                </div>
                <!--end::Group-->

                <!--begin::Actions-->
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
                <!--end::Actions-->
            </div>
            <!--end::Stepper-->
        </div>
    </div>

    @push('scripts')
    <script>
    $(document).ready(function() {
        
        $('#places-select2').select2({
            placeholder: 'Search for a place',
            allowClear: true,
            ajax: {
                url: `{{ route('google-places.search-ajax') }}`,
                delay:250,
                dataType: 'json',
                clearCache: true,
                processResults: function (data) {
                    return {
                        results: data.items
                    };
                }
            }
        }).on('select2:select', function (e) {
            let selectedData = e.params.data;
            let placeId = selectedData.place_id;
            let placeName = selectedData.text;
            $('input[name=google_place_text]').val(placeName);
        });
            
        
        $('body').on('input', 'input.character-count', function(){
            let _this = $(this);
            let maxLength = _this.attr('maxlength');
            let _target = _this.attr('data-target');
            let currentLength = _this.val().length;
            let remainingLength = maxLength - currentLength;
            $(_target).text(currentLength + ' of ' + maxLength + ' characters.');
        });

        // Stepper element
        var element = document.querySelector("#create_hotel");
        // Initialize Stepper
        var stepper = new KTStepper(element);

        // Handle navigation click
        stepper.on("kt.stepper.click", function(stepper) {
            if($('#step1form').valid()){
            stepper.goTo(stepper.getClickedStepIndex()); // go to clicked step

            }
        });

        // Handle next step
        stepper.on("kt.stepper.next", function(stepper) {

            let currentStep = stepper.getCurrentStepIndex();

            // Trigger click on the current step to highlight the next step
            $('#step' + currentStep).click();

            // Validate the current step form before moving to the next step
            if ($('#step' + currentStep + 'form').valid()) {
                stepper.goNext(); // Go to the next step if the form is valid
            }
        });

        // Handle previous step
        stepper.on("kt.stepper.previous", function(stepper) {
            stepper.goPrevious(); // Go to the previous step
        });

        // Handle changes for both 'parking_available' and 'breakfast_served' options
        $('input[name="parking_available"], input[name="breakfast_served"]').on('change', function() {
            let _this = $(this);
            let otherField = $('.otherField');
            let type = _this.val();

            // Toggle visibility of the otherField based on selected value
            if (type == 'no') {
                otherField.addClass('d-none');
            } else {
                otherField.removeClass('d-none');
            }
        });

        function updateProgressBar() {
            var containerWidth = $('#progress_bar_container').width();
            var progressWidth = $('#progress_bar_width').width();
            var steps = Math.ceil(progressWidth / (containerWidth * 0.125));
            var separatorWidth = 7;

            $('#progress_bar_container .separator').remove();

            for (var i = 1; i <= steps; i++) {
                $('<div class="separator"></div>').css({
                    left: (i * (containerWidth * 0.125)) + (separatorWidth * (i - 1)) + 'px'
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
            var newWidth = Math.max(currentWidth - containerWidth * 0.125,
                0); // Ensure the width doesn't go below 0%
            $('#progress_bar_width').width(newWidth);
            updateProgressBar();
        });

        $('#submit_stipper_btn').click(function() {
            $('#progress_bar_width').width('100%');
            updateProgressBar();
            $('#step8').click();
        });

        updateProgressBar(); // Initial call to set up separators
    });




    $(document).ready(function() {
        ClassicEditor
            .create(document.querySelector('#general'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#optional'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    });
    </script>

    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
    @endpush
</x-app-layout>

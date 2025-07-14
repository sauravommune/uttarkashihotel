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
                            <a href="index.html" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            Room
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Add Room</li>
                        <!--end::Item-->
                    </ul>
                </div>
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="javascript:void(0);"
                        class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-success bg-body h-40px fs-7 fw-bold"
                        onclick="window.history.back()"> <i class="ki-outline ki-black-left fs-2"></i> Back</a>
                </div>
                <!--end::Actions-->
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid create-hotel">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Stepper-->
            @include('hotelmaster.room_type')
            <!--end::Stepper-->
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {

                var imageInputElement = document.querySelector("#my_image_input_control");
                var imageInput = new KTImageInput(imageInputElement);

                $(".dynamic-select2").select2({
                    tags: true,
                });

                tinymce.init({
                    selector: '#modal-tiny-editor1',
                    height: 300,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table paste wordcount'
                    ],
                    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media',
                    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',

                });

                $('#near_by_add_btn').on('click', function() {
                    let row = `<tr class="f_row">
                             <td>
                <input type="text" name="near_by_place[]" class="form-control mb-3 mb-lg-0" placeholder="Enter Place" value="" />
                    </td>
                    <td>
                        <input type="text" name="near_by_distance[]" class="form-control mb-3 mb-lg-0" placeholder="Enter Distance" value="" />
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger delete-row"><span class="fa fa-trash"></span></button>
                    </td>
                            </tr>`;
                    $('tbody').append(row);

                })

                $('select[name="parking_available"]').on('change', function() {
                    let _this = $(this);
                    let commentBox = $('.comment_box');
                    let type = _this.val();
                    type == 'comment' ? commentBox.removeClass('d-none') : commentBox.addClass('d-none')
                })
                $(document).on('click', '.delete-row', function() {
                    $(this).closest('tr').remove();
                });

                Dropzone.autoDiscover = false;
                var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
                    url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
                    paramName: "hotel_imgs", // The name that will be used to transfer the file
                    maxFiles: 10,
                    maxFilesize: 10, // MB
                    addRemoveLinks: true,
                    acceptedFiles: ".png, .jpg, .jpeg",
                    init: function() {
                        this.on("addedfile", function(file) {
                            updateLabelText();
                        });

                        this.on("removedfile", function(file) {
                            updateLabelText();
                        });
                    }
                });

                function updateLabelText() {
                    var label = document.getElementById("hotel-imgs");
                    if (myDropzone.files.length > 0) {
                        label.textContent = "Selected Image(s)";
                    } else {
                        label.textContent = "Select Image(s)";
                    }
                }
                this.on("queuecomplete", function() {
                    document.getElementById("#create_hotel_form")
                        .submit(); // Submit the form after all files are uploaded
                });

                $('.modify_room_btn').on('click', function() {
                    let room = $(this).data('btn-id');
                    $(`#modify_room_form_${room} input[name="total_room"]`).prop('readonly', false);
                    $(`#modify_room_form_${room} input[name="available_room"]`).prop('readonly', false);
                    let btn = `<button type = "submit" class="form-control btn btn-primary" >Modify</button>`;
                    $(`#modify_room_form_${room} .modify_btn`).empty().append(btn);

                })

                $('.btn-add-row-price').on('click', function() {
                    let index = $('.price_list_row').length;
                    let row = `<tr class = "price_list_row">

                <td>
                    <input type="text" name="price_date_range[${index}]" class="form-control mb-3 mb-lg-0 kt_range_flatpickr" placeholder="Select Date Range"  />
                </td>

                <td>
                <input type="text" name="price_per_night[${index}]" class="form-control mb-3 mb-lg-0" placeholder="Price Per Night"  />
                </td>
                <td>
                <input type="text" name="margin[${index}]" class="form-control mb-3 mb-lg-0" placeholder="Price Per Night" value="{{ old('margin', $room->margin ?? '') }}" />
                </td>
                <td>
                <button type="button" class="btn btn-danger delete-row"><span class="fa fa-trash"></span></button>
                </td>
                </tr>`;

                    $('.price_list').append(row);
                    $('body .kt_range_flatpickr').flatpickr({
                        dateFormat: "Y-m-d",
                        mode: 'range',
                        altInput: true,
                        altFormat: 'd/m/Y'
                    });
                })

                $(document).on('click', '.delete-row', function() {
                    $(this).closest('tr').remove();
                });

                $(document).on('click', '.edit_room', function() {
                    let room = $(this).data('btn-id');
                    let url = $(this).data('url')

                    $.ajax({
                        type: "get",
                        url: url,
                        success: function(response) {
                            if (response.status == 200) {
                                $('body .room_type_form').empty().append(response.html);
                                $('.btn-add').click();

                            }
                        }
                    });
                });
            });
            $(document).ready(function() {
                function updateProgressBar() {
                    var containerWidth = $('#progress_bar_container').width();
                    var progressWidth = $('#progress_bar_width').width();
                    var steps = Math.ceil(progressWidth / (containerWidth * 0.2));
                    var separatorWidth = 4;

                    $('#progress_bar_container .separator').remove(); // Remove existing separators

                    for (var i = 1; i <= steps; i++) {
                        $('<div class="separator"></div>').css({
                            left: (i * (containerWidth * 0.2)) + (separatorWidth * (i - 1)) + 'px'
                        }).appendTo('#progress_bar_container');
                    }
                }

                $('#continue_stipper_btn').click(function() {
                    var containerWidth = $('#progress_bar_container').width();
                    var currentWidth = $('#progress_bar_width').width();
                    var newWidth = Math.min(currentWidth + containerWidth * 0.2,
                        containerWidth); // Ensure the width doesn't exceed 100%
                    $('#progress_bar_width').width(newWidth);
                    updateProgressBar();
                });

                $('#back_stipper_btn').click(function() {
                    var containerWidth = $('#progress_bar_container').width();
                    var currentWidth = $('#progress_bar_width').width();
                    var newWidth = Math.max(currentWidth - containerWidth * 0.2,
                        0); // Ensure the width doesn't go below 0%
                    $('#progress_bar_width').width(newWidth);
                    updateProgressBar();
                });

                $('#submit_stipper_btn').click(function() {
                    $('#progress_bar_width').width('100%');
                    updateProgressBar();
                });

                updateProgressBar(); // Initial call to set up separators
            });
        </script>
    @endpush
</x-app-layout>

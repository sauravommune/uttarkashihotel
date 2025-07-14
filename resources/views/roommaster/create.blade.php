<x-app-layout>
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                        {{ $title }}
                    </h1>
                    <small class="text-muted">{{ $title }} here!</small>
                </div>
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="javascript:void(0);" class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-success bg-body h-40px fs-7 fw-bold" onclick="window.history.back()"> <i class="ki-outline ki-black-left fs-2"></i> Back</a>
                </div>
                <!--end::Actions-->
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">

                    </div>
                </div>
                <div class="card-body pt-0">
                    <form action="{{ route('room.save') }}" class="global-ajax-form" method="POST" enctype="multipart/form-data" data-redirect-url="{{route('room')}}">
                        @csrf

                        <input type="hidden" name="id" value="{{ $room->id }}">
                        <div class="form-group row mb-5">
                            <label class="col-md-3 form-label">Hotels</label>
                            <div class="col-md-9">
                                <select class="form-control datatable-input" data-control="select2" name="hotel_id" data-placeholder="Select an option">
                                    <option></option>
                                    @if(isset($hotel))
                                    <option value="{{ $hotel->id }}"  selected>
                                        {{ $hotel->name }}
                                    </option>
                                    @else
                                    @foreach ($hotels as $hotel)
                                    <option value="{{ $hotel->id }}" @if (isset($room->hotel_id) && $room->hotel_id == $hotel->id) selected @endif>
                                        {{ $hotel->name }}
                                    </option>
                                    @endforeach
                                    @endif

                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-5">
                            <label class="col-md-3 form-label">Room No</label>

                                <div class="col-sm-9">
                                    <input type="text" name="room_no" class="form-control mb-3 mb-lg-0" placeholder="Room No." value="{{ old('room_no', $room->room_no) }}" required />
                            </div>
                        </div>
                        <div class="form-group row mb-5">
                            <label class="col-md-3 form-label">Room Type</label>
                            <div class="col-md-9">
                                <select class="form-control datatable-input" data-control="select2" name="room_type" data-placeholder="Select an option">
                                    <option></option>
                                    @foreach(config('data.roomTypes') as $roomType)
                                        <option value="{{ $roomType }}"
                                            @if (isset($room->room_type) && $room->room_type == $roomType) selected @endif
                                            @if (old('room_type') == $roomType) selected @endif
                                        >{{ $roomType }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <label class="required fw-semibold fs-6 mb-2 col-sm-3">Price Per Night.</label>
                            <div class="col-sm-9">
                                <input type="text" name="price_per_night" class="form-control mb-3 mb-lg-0" placeholder="Price per Night" value="{{ old('price_per_night', $room->price_per_night) }}" required />
                            </div>
                        </div>

                        <div class="row mb-5">
                            <label class="fw-semibold fs-6 mb-2 col-sm-3">Description</label>
                            <div class="col-sm-9">
                                <textarea name="description" class="form-control mb-3 mb-lg-0" id="modal-tiny-editor2" rows="5">{{ old('description', $hotel->description) }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <label class="required fw-semibold fs-6 mb-2 col-sm-3">No of Beds.</label>
                            <div class="col-sm-9">
                                <input type="text" name="number_of_beds" class="form-control mb-3 mb-lg-0" placeholder="No of Beds" value="{{ old('number_of_beds', $room->number_of_beds) }}" required />
                            </div>
                        </div>

                        <div class="row mb-5">
                            <label class="required fw-semibold fs-6 mb-2 col-sm-3">Amenities</label>
                            <div class="col-sm-9">
                                @foreach($amenities as $amenity)
                                    <div class="form-check form-check-custom form-check-success form-check-solid">
                                        <input class="form-check-input mt-1" type="checkbox" name="amenities[]" value="{{ $amenity->id }}" id="amenity-{{ $amenity->id }}" checked />
                                        <label class="form-check-label" for="amenity-{{ $amenity->id }}">
                                        {{ $amenity->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="text-end mt-3">
                            <x-primary-button class="ml-3">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
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



            $('.global-ajax-form').validate({
                rules: {
                    company_name: {
                        required: true,

                    },

                },
                messages: {
                    company_name: {
                        required: "Company Name is required.",
                        remote: "Company name already exists"
                    },
                    category: "Category is required",
                },
                errorPlacement: function(error, element) {
                    var placement = $(element).parents('div.input-group');
                    if (placement.length > 0) {
                        $(placement).after(error);
                    } else if ($(element).hasClass('form-select')) {
                        $(element).parent().append(error);
                    } else if ($(element).attr('name') == 'valuation_range[]') {
                        $('.valuation-range-cover').html(error);
                    } else {
                        error.insertAfter(element);
                    }
                }
            });


        });
    </script>
    @endpush
</x-app-layout>

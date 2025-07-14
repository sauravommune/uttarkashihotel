<form action="{{ route('room.save') }}" class="global-ajax-form" method="POST" enctype="multipart/form-data"
    data-redirect-url = "{{ url()->previous() }}">
    @csrf
    <input type="hidden" name="id" value="{{ $room_type->id ?? '' }}">
    <input type="hidden" name="hotel_id" value="{{ $room_type->hotel_id ?? $details['hotel']?->id }}">
    <div class="form-group row mb-5">
        <label class="col-md-3 form-label">Rooms Type</label>
        <div class="col-md-9">
            <select class="form-control datatable-input" data-control="select2" name="room_type"
                data-placeholder="Select an option">
                <option></option>
                @foreach (config('data.roomTypes') as $roomType)
                    <option value="{{ $roomType }}" @selected($roomType == $room_type->room_type)>{{ $roomType }}</option>
                @endforeach

            </select>
        </div>
    </div>
    <div class="row mb-5">
        <label class="required fw-semibold fs-6 mb-2 col-sm-3">Total Rooms</label>
        <div class="col-sm-9">
            <input type="number" name="total_rooms" class="form-control mb-3 mb-lg-0" placeholder="Total Rooms"
                value="{{ old('total_rooms', $room_type?->total_rooms) }}" />
        </div>
    </div>
    <div class="row mb-5">
        <label class="required fw-semibold fs-6 mb-2 col-sm-3">Available Rooms</label>
        <div class="col-sm-9">
            <input type="number" name="available_rooms" class="form-control mb-3 mb-lg-0" placeholder="Available Rooms"
                value="{{ old('available_rooms', $room_type?->total_rooms) }}" />
        </div>
    </div>
    <div class="row mb-5">
        <label class="required fw-semibold fs-6 mb-2 col-sm-3">Amenities</label>
        <div class="col-sm-9">
            @foreach ($details['amenities'] as $amenity)
                <div class="form-check form-check-custom form-check-success form-check-solid">
                    <input class="form-check-input mt-1" type="checkbox" name="amenities[]" value="{{ $amenity->id }}"
                        id="amenity-{{ $amenity->id }}" @checked(!is_null($room_type->amenities) && in_array($amenity->id, $room_type->amenities)) />
                    <label class="form-check-label" for="amenity-{{ $amenity->id }}">
                        {{ $amenity->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
    @empty($room_type->id)
        {{-- <div class="row mb-5">
        <label class="fw-semibold fs-6 mb-2 col-sm-3">Image</label>
        <div class="col-sm-9">
            <input type="file" name="images[]" class="form-control mb-3 mb-lg-0 dropify" data-height="200" value="" multiple accept="image/*"/>
        </div>
    </div> --}}
        <div class="row mb-5">
            <label class="fw-semibold fs-6 mb-2 col-sm-3" id="room_imgs">Select Room Image(s)</label>
            <div class="col-sm-9">
                <div class="dropzone" id="room_imgs_id">
                    <!--begin::Message-->
                    <input type="file" name="images[]" id="room_imgs" multiple style="display:none;">

                    <div class="dz-message needsclick">
                        <i class="ki-duotone ki-file-up fs-3x text-primary"><span class="path1"></span><span
                                class="path2"></span></i>
                        <!--begin::Info-->
                        <div class="ms-4">
                            <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to
                                upload.</h3>
                            <span class="fs-7 fw-semibold text-gray-500">Upload up to 10 files</span>
                        </div>
                        <!--end::Info-->
                    </div>
                </div>
            </div>
        </div>
    @endempty

    <div class="row mb-5">
        <label class="fw-semibold fs-6 mb-2 col-sm-3">Description</label>
        <div class="col-sm-9">
            <textarea name="description" class="form-control mb-3 mb-lg-0" id="modal-tiny-editor2" rows="5">{{ old('description', $room_type?->description) }}</textarea>
        </div>
    </div>
    <div class="row mb-5">
        <label class="required fw-semibold fs-6 mb-2 col-sm-3">Price Per Night (&#8377;).</label>
        <div class="col-sm-9">
            <div class="row">
                <div class="col-6">
                    <input type="number" name="default_price" class="form-control mb-3 mb-lg-0"
                        placeholder="Default Price Per Night"
                        value="{{ old('default_price', $room_type?->price_per_night) }}" />
                </div>
                <div class="col-6">
                    <input type="number" name="default_margin" class="form-control mb-3 mb-lg-0"
                        placeholder="Default Margin Price Per Night"
                        value="{{ old('default_margin', $room_type?->default_margin) }}" />
                </div>

            </div>


            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Date Range</th>

                        <th scope="col">Price (&#8377;)</th>
                        <th scope="col">Margin (&#8377;)</th>
                        <th scope="col">
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-add-row-price">+</button>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="price_list">

                    @if (!empty($room_type->roomPrice))
                        @foreach ($room_type->roomPrice as $roomPrice)
                            <tr class = 'price_list_row'>
                                <td>
                                    <input type="text" name="price_date_range[{{ $loop->index }}]"
                                        class="form-control mb-3 mb-lg-0 kt_range_flatpickr"
                                        placeholder="Select Date Range"
                                        value="{{ old('price_date_range', $roomPrice->actual_date) }}" />
                                </td>
                                <td>
                                    <input type="text" name="price_per_night[{{ $loop->index }}]"
                                        class="form-control mb-3 mb-lg-0" placeholder="Price Per Night"
                                        value="{{ old('price_per_night', $roomPrice->price) }}" />
                                </td>
                                <td>
                                    <input type="number" name="margin[{{ $loop->index }}]"
                                        class="form-control mb-3 mb-lg-0" placeholder="Price Per Night"
                                        value="{{ old('margin', $roomPrice->margin) }}" />
                                </td>
                                @if ($loop->index > 0)
                                    <td>
                                        <button type="button" class="btn btn-danger delete-row"><span
                                                class="fa fa-trash"></span></button>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr class = 'price_list_row'>
                            <td>
                                <input type="text" name="price_date_range[0]"
                                    class="form-control mb-3 mb-lg-0 kt_range_flatpickr"
                                    placeholder="Select Date Range" value="" />
                            </td>
                            <td>
                                <input type="text" name="price_per_night[0]" class="form-control mb-3 mb-lg-0"
                                    placeholder="Price Per Night" value="{{ old('price_per_night') }}" />
                            </td>
                            <td>
                                <input type="number" name="margin[0]" class="form-control mb-3 mb-lg-0"
                                    placeholder="Price Per Night" value="{{ old('margin') }}" />
                            </td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
    <div class="text-end mt-3">
        <x-primary-button class="ml-3">
            {{ __('Save') }}
        </x-primary-button>
    </div>

</form>

@push('scripts')
    <script>
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

        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#room_imgs_id", {
            url: "http://127.0.0.1:8000", // Set the url for your upload script location
            paramName: "room_imgs", // The name that will be used to transfer the file
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
            var label = document.getElementById("room_imgs");
            if (myDropzone.files.length > 0) {
                label.textContent = "Selected Image(s)";
            } else {
                label.textContent = "Select Image(s)";
            }
        }

        $('.global-ajax-form').on('submit', function(event) {
            var id = $('#room_imgs_id').val();
            var images = $('#images')[0].files;
        });
    </script>
@endpush

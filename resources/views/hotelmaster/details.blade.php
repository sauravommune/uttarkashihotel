<x-app-layout>


    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">

                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="col-sm-12 d-flex justify-content-between">
                        <div class="col-sm-3">

                            <h6>Add Room Type</h6>
                        </div>


                        <div class="col-sm-1 text-end mb-3">
                            {{-- <button type="button" class="btn btn-primary" id="near_by_add_btn">Add +</button> --}}
                            <a class="btn btn-primary btn-add" href="{{route('room.add2')}}">
                                Add +
                            </a>
                        </div>

                    </div>
                    <div class="row mb-5">
                        {{-- <label class="fw-semibold fs-6 mb-2 col-sm-3"></label> --}}
                        <div class="col-sm-12">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">

                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body room_type_form  p-0 pt-5">
                                            @include('hotelmaster.room_type')
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                @foreach ($details['hotel']?->rooms as $room)
                    <div class="col-md-4">
                        <div class="card mt-3">
                            <div class="card-header d-flex justify-content-between"
                                style="min-height: unset; padding:10px 15px;">
                                <div>

                                    <h5 class="card-title">{{ $room?->room_type }}</h5>
                                    <b>Price : INR {{ $room?->price_per_night }}</b>
                                </div>
                                <button class="btn btn-primary edit_room" data-btn-id={{ $room?->id }} data-url = "{{route('modify.room',$room?->id)}}">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row text-end">
                                    <div class="col-sm-12 ">
                                        <span class="modify_room_btn" data-btn-id={{ $room?->id }}>

                                            <i class="fa fa-edit"></i>
                                        </span>

                                    </div>
                                </div>
                                <form action="{{ route('modify.room.availability') }}" method="post"
                                    class="global-ajax-form" id="modify_room_form_{{ $room?->id }}">
                                    @csrf
                                    <div class="row justify-content-between">
                                        <input type="hidden" name="id" value="{{ $room?->id }}">
                                        <div class="col-md-3">
                                            Total Rooms<br>
                                            <input type = "text" class="form-control" value="{{ $room?->total_rooms }}"
                                                name="total_room" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            Available Rooms<br>
                                            <input type = "text" class="form-control"
                                                value="{{ $room?->available_rooms }}" name="available_room" readonly>

                                        </div>

                                    </div>
                                    <div class="col-md-3 mt-2 modify_btn">



                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                @endforeach


            </div>

        </div>



    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
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
                        mode:'range',
                        altInput:true,
                        altFormat:'d/m/Y'
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
                    success: function (response) {
                        if(response.status == 200){
                            $('body .room_type_form').empty().append(response.html);
                            $('.btn-add').click();

                        }
                    }
                   });
                });
            })
        </script>
    @endpush
</x-app-layout>

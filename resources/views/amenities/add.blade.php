<x-app-layout>
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-color fw-bold fs-18 m-0">
                        {{ $data['title'] }}
                    </h1>
                    <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('superAdmin.dashboard') }}" class="text-color-secondary text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('list.amenities') }}" class="text-color-secondary text-hover-primary">Amenities</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-color-secondary">  {{ $data['title'] }}</li>
                    </ul>
                </div>
                <!--end::Page title-->
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card border-0">
                <div class="card-body p-5">
                    <h3 class="mb-4">Add New Amenity</h3>
                    <!--begin::Add Amenity Form-->
                    <form class="global-ajax-form" action="{{ route('amenities.add') }}" method="post" data-redirect-url="{{ route('list.amenities') }}" id="validate-form">
                        @csrf

                        <input type="hidden" value="{{$amenity->id??''}}" name="id">
                        <div class="mb-3">
                            <label for="amenity_type" class="form-label">Select Type{{$amenity->type}}</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="">Select Type</option>
                                <option value="room" @selected($amenity->type == 'room')>Room</option>
                                <option value="hotel" @selected($amenity->type == 'hotel')>Hotel</option>
                            </select>
                        </div>

                        <div class="mb-3" id="amenity_container">
                            @if( $amenity->type == 'room')
                            <label for="room_amenity_type" class="form-label">Room Amenity Type</label>
                            <select class="form-select" id="amenity_type" name="amenity_type">
                                <option value="general_amenities" @selected($amenity->amenity_type=='general_amenities')>General Amenities</option>
                                <option value="outdoor_views" @selected($amenity->amenity_type=='outdoor_views')>Outdoor views</option>
                                <option value="food_and_drinks" @selected($amenity->amenity_type=='food_and_drinks')>Food and Drinks</option>
                                <option value="bathroom_facilities" @selected($amenity->amenity_type=='bathroom_facilities')>Bathroom facilities</option>
                            </select>
                            @endif

                            @if( $amenity->type == 'hotel' )
                            <label for="hotel_amenity_type" class="form-label">Hotel Amenity Type</label>
                            <select class="form-select" id="amenity_type" name="amenity_type">
                                <option value="amenities_facilities" @selected($amenity->amenity_type=='amenities_facilities')>Amenities facilities for guest</option>
                            </select>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="amenity_name" class="form-label">Amenity Name</label>
                            <input type="text" class="form-control" id="amenity_name" value="{{ $amenity->name }}" name="amenity_name" placeholder="Enter amenity name" required>
                        </div>

                        <div class="mb-3" id ="IconDiv">
                            <label for="icode" class="form-label">Icon Code</label>
                            <input type="text" class="form-control" id="icode" value="{{ $amenity->icode }}" name="icode" placeholder="Enter icon code">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')

        <script>
            $(document).ready(function() {
                $('#IconDiv').addClass('d-none');

                $('body').on('change', '#type', function() {
                    var selectedType = $(this).val();

                    if (selectedType === 'hotel') {

                          var html = `<label for="hotel_amenity_type" class="form-label">Hotel Amenity Type</label>
                            <select class="form-select" id="amenity_type" name="amenity_type">
                                <option value="amenities_facilities">Amenities facilities for guest</option>
                            </select>`;
                            $('#IconDiv').removeClass('d-none');

                    } else if (selectedType === 'room') {

                        var html = `<label for="room_amenity_type" class="form-label">Room Amenity Type</label>
                            <select class="form-select" id="amenity_type" name="amenity_type">
                                <option value="general_amenities">General Amenities</option>
                                <option value="outdoor_views">Outdoor views</option>
                                <option value="food_and_drinks">Food and Drinks</option>
                                <option value="bathroom_facilities">Bathroom facilities</option>
                            </select>`;

                            $('#IconDiv').addClass('d-none');

                    }
                    else if (selectedType === '') {
                        var html = ``;
                    }

                    $('#amenity_container').html(html);
                });

               var type = $('#type').val();
               if(type =="hotel"){
                $('#IconDiv').removeClass('d-none');

               }

            });
        </script>




    @endpush
</x-app-layout>

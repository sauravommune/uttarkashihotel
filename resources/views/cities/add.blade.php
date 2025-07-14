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
                        {{ $title }}
                    </h1>
                    <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('superAdmin.dashboard') }}" class="text-color-secondary text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('list.city') }}" class="text-color-secondary text-hover-primary">Cities</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-color-secondary"> {{ $title }}</li>
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
                    <h4 class="mb-4">Add City</h4>
                    <!--begin::Add Amenity Form-->
                    <form class="global-ajax-form" action="{{ route('save.city') }}" method="post" data-redirect-url="{{ route('list.city') }}" id="validate-form">
                        @csrf

                        <input type="hidden" name="id" value="{{$city->id??''}}">
                        <div class="row mb-3 pb-4 align-items-center">
                            <div class="col-md-6 col-lg-3 col-12">
                                <label for="amenity_name" class="form-label mb-0">City Name</label>
                            </div>
                            <div class="col-md-6 col-lg-5 col-12">
                                <input type="text" class="form-control form-control-solid" id="city_name" value="{{$city->name??''}}" name="city_name" placeholder="Enter city name">
                            </div>
                        </div>

                        <div class="row mb-3 pb-4 align-items-center">
                            <div class="col-md-6 col-lg-3 col-12">
                                <label for="amenity_name" class="form-label mb-0">State Name</label>
                            </div>
                            <div class="col-md-6 col-lg-5 col-12">
                                <select name="state_id" aria-label="Select a State" data-control="select2" data-placeholder="Select a state..." class="form-select form-select-lg fw-semibold">
                                    <option></option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state?->id }}" @selected( $state?->id == $city?->state_id )>
                                            {{ ucwords($state?->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 pb-4 align-items-center">
                            <div class="col-md-6 col-lg-3 col-12">
                                <label for="meta_title" class="form-label mb-0">Meta Title <small class="text-danger">(max 70 character allowed)</small></label>
                            </div>
                            <div class="col-md-6 col-lg-5 col-12">
                                <input type="text" class="form-control form-control-solid character-count" value="{{$city->meta_title??''}}" name="meta_title" placeholder="Enter Meta Title" data-target="#character-count-title" maxlength="70">
                                <small id="character-count-title">{{ strlen($city->meta_title) }} of 70 characters.</small>
                            </div>
                        </div>

                        <div class="row mb-3 pb-4 align-items-center">
                            <div class="col-md-6 col-lg-3 col-12">
                                <label for="meta_description" class="form-label mb-0">Meta Description <small class="text-danger">(max 160 character allowed)</small></label>
                            </div>
                            <div class="col-md-6 col-lg-5 col-12">
                                <input type="text" class="form-control form-control-solid character-count" value="{{$city->meta_description??''}}" name="meta_description" placeholder="Enter Meta Description" data-target="#character-count-description" maxlength="160">
                                <small id="character-count-description">{{ strlen($city->meta_description) }} of 160 characters.</small>
                            </div>
                        </div>

                        <h3 class="text-color fw-bold mt-3 border-top pt-4 pb-3">Near By Places</h3>

                        <div class="row mb-3 pb-2 align-items-start" id="entered">
                            <div class="col-md-6 col-lg-2 col-12">
                                <label for="amenity_name" class="form-label pt-3 mb-0">Places in the city*</label>
                            </div>

                            <div class="col-md-6 col-lg-5 col-12">
                            @forelse($city->nearPlaces as $key => $places)
                                <div class="row g-0 align-items-center mt-4">
                                    <div class="col-11 pe-5">
                                        <input type="hidden" name="near_by_places_id[]" value="{{$places->id}}">
                                        <input type="text" class="form-control form-control-solid" placeholder="Enter place name" name="near_by_places[]" value="{{$places?->places}}" />
                                    </div>
                                    <div class="col-1 d-flex justify-content-end">
                                        @if($loop->index == 0)
                                        <div class="btn-40 btn btn-primary border" id="add_city_btn">
                                            <span class="material-symbols-outlined fs-2">
                                                add
                                            </span>
                                        </div>
                                        @else
                                        <div class="col-1 d-flex justify-content-end" id="det_place">
                                        <div class="btn-40 btn btn-dark">
                                            <span class="material-symbols-outlined fs-2">
                                                delete
                                            </span>
                                        </div>
                                        </div>

                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="row g-0 align-items-center">
                                    <div class="col-11 pe-5">
                                        <input type="text" class="form-control form-control-solid" placeholder="Enter place name" name="near_by_places[]" />
                                    </div>
                                    <div class="col-1 d-flex justify-content-end">
                                       
                                        <div class="btn-40 btn btn-primary border" id="add_city_btn">
                                            <span class="material-symbols-outlined fs-2">
                                                add
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            @endforelse
                        </div>

                        <div class="row pb-4 align-items-center d-none" id="new_place">
                            <div class="col-md-6 col-lg-2 col-12">
                            </div>
                            <div class="col-md-6 col-lg-5 col-12">
                                <div class="row g-0 align-items-center">
                                    <div class="col-11 pe-5">
                                        <input type="text" class="form-control form-control-solid" placeholder="Enter place name" name="near_by_places[]" />
                                    </div>
                                    <div class="col-1 d-flex justify-content-end" id="det_place">
                                        <div class="btn-40 btn btn-dark">
                                            <span class="material-symbols-outlined fs-2">
                                                delete
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

            $('body').on('input', 'input.character-count', function(){
                let _this = $(this);
                let maxLength = _this.attr('maxlength');
                let _target = _this.attr('data-target');
                let currentLength = _this.val().length;
                let remainingLength = maxLength - currentLength;
                $(_target).text(currentLength + ' of ' + maxLength + ' characters.');
            });

            // On click of the "add" button
            $('#add_city_btn').click(function() {
                // Clone the #new_place element
                const newPlace = $('#new_place').clone();

                // Remove the ID from the clone to avoid duplicates
                newPlace.removeAttr('id');

                // Remove the 'd-none' class to make it visible
                newPlace.removeClass('d-none');

                // Append the clone after the #entered element
                $('#entered').after(newPlace);
            });

            // On click of the "delete" button
            $(document).on('click', '#det_place', function() {
                // Remove the parent element containing the clicked delete button
                $(this).closest('.row').remove();
            });
        });

    </script>
    @endpush
</x-app-layout>

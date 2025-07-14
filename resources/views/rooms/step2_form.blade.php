<div class="flex-column" data-kt-stepper-element="content" id="step-2">
    <form class="global-ajax-form" action="{{ route('rooms.save') }}" method="post" novalidate="novalidate"
        id="step2form">
        <!--begin::Input group-->
        <div class="card shadow-sm mt-5">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="fw-bold text-color m-0">Room Amenities</h3>
                </div>
            </div>
            <div class="card-body p-5">
                <div class="col-sm-12 d-flex flex-column justify-content-between">

                    @if (!empty($roomDetails->id))
                    <input type="hidden" name="id" value="{{ $roomDetails->id ?? '' }}">
                    @endif
                    <!-- General Amenities -->
                    <div class="row w-100 mb-5 pb-1">
                        <div class="col-sm-3">
                            <label class="fw-semibold mb-2 mt-5">General Amenities</label>
                            <span id="general_amenities_error" class="text-danger"></span>
                        </div>
                        <div class="col-sm-9">
                            <div class="position-relative">
                                <div class="row">
                                    @foreach ($amenity as $item1)
                                    @if ($item1->amenity_type == 'general_amenities' && $item1->type == 'room')
                                    <div class="col-md-4 mt-5">
                                        <!-- Changed mt-5 to mt-2 or remove it completely -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="general_amenities[]"
                                                value="{{ $item1->id }}" id="{{ $item1->name }}"
                                                @checked(isset($roomDetails->addAmenity) && in_array($item1->id, ($roomDetails->addAmenity)->pluck('amenity_id')->toArray()))
                                            />
                                            <label class="form-check-label text-color-secondary"
                                                for="{{ $item1->name }}">
                                                {{ !empty($item1->name) ? $item1->name : '' }}
                                            </label>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Outdoor Views -->
                    <div class="position-relative mb-5">
                        <div class="separator-vertical"></div>
                    </div>
                    <div class="row w-100 mb-5 py-1">
                        <div class="col-sm-3">
                            <label class="fw-semibold mb-2 mt-5">Outdoor views</label>
                            <span id="outdoor_views_error" class="text-danger"></span>
                        </div>
                        <div class="col-sm-9">
                            <div class="row">
                                @foreach ($amenity as $item2)
                                @if ($item2->amenity_type == 'outdoor_views' && $item2->type == 'room')
                                <div class="col-md-4 mt-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="outdoor_views[]"
                                            value="{{ $item2->id }}" id="outdoor_views_{{ $item2->id }}"
                                            @checked(isset($roomDetails->addAmenity) && in_array($item2->id,
                                        ($roomDetails->addAmenity)->pluck('amenity_id')->toArray()))
                                        />
                                        <label class="form-check-label text-color-secondary"
                                            for="outdoor_views_{{ $item2->id }}">
                                            {{ !empty($item2->name) ? $item2->name : '' }}
                                        </label>
                                    </div>
                                </div>

                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Food and Drinks -->
                    <div class="position-relative mb-5">
                        <div class="separator-vertical"></div>
                    </div>
                    <div class="row w-100 mb-5 py-1">
                        <div class="col-sm-3">
                            <label class="fw-semibold mb-2 mt-5">Food and Drinks</label>
                            <span id="food_and_drinks_error" class="text-danger"></span>
                        </div>
                        <div class="col-sm-9">
                            <div class="row">
                                @foreach ($amenity as $item3)
                                @if ($item3->amenity_type == 'food_and_drinks' && $item3->type == 'room')
                                <div class="col-md-4 mt-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="food_and_drinks[]"
                                            value="{{ $item3->id }}" id="food_and_drinks_{{ $item3->id }}"
                                            @checked(isset($roomDetails->addAmenity) && in_array($item3->id,
                                        ($roomDetails->addAmenity)->pluck('amenity_id')->toArray()))
                                        />
                                        <label class="form-check-label text-color-secondary"
                                            for="food_and_drinks_{{ $item3->id }}">
                                            {{ !empty($item3->name) ? $item3->name : '' }}
                                        </label>
                                    </div>
                                </div>

                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Bathroom Facilities -->
                    <div class="position-relative mb-5">
                        <div class="separator-vertical"></div>
                    </div>
                    <div class="row w-100 mb-5">
                        <div class="col-sm-3">
                            <label class="fw-semibold mb-2 mt-5">What bathroom facilities are available to
                                guests?</label>
                            <span id="facility_error" class="text-danger"></span>
                        </div>
                        <div class="col-sm-9">
                            <div class="row">
                                @foreach ($amenity as $item)
                                @if ($item->amenity_type == 'bathroom_facilities' && $item->type == 'room')
                                <div class="col-md-4 mt-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="bathroom_facilities[]"
                                            value="{{ $item->id }}" id="bathroom_facilities"
                                            @checked(isset($roomDetails->addAmenity) && in_array($item->id,
                                        ($roomDetails->addAmenity)->pluck('amenity_id')->toArray()))/>
                                        {{-- {{ in_array($item->id, $roomDetails->addAmenity) ? 'checked' : '' }} />
                                        --}}
                                        <label class="form-check-label text-color-secondary" for="amenity">
                                            {{ !empty($item->name) ? $item->name : '' }}
                                        </label>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--end::Input group-->
        <input type="hidden" name="step" value="2">
        <input type="submit" class="d-none" id="step2">
    </form>
</div>
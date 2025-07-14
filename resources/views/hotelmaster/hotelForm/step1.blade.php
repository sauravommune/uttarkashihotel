<div class="flex-column current" data-kt-stepper-element="content">
    <!--begin::Input group-->
    <form action="{{ route('hotel.save',['step' => 1]) }}" class="global-ajax-form" method="post" enctype="multipart/form-data" id="step1form">
        <div class="card shadow-sm">
            <div class="card-header">
                <div class="card-title">
                    <!--begin::Title-->
                    <h3 class="fw-bold text-gray-900 m-0">
                        Hotel Details
                    </h3>
                    <!--end::Title-->
                </div>  
            </div>
            <div class="card-body p-5">
                <input type="hidden" name="id" value="{{ $hotel->id }}">
                <div class="row mb-5">
                    <label class="required fw-semibold mb-2 col-sm-3">Hotel Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="hotel_name" class="form-control mb-3 mb-lg-0" placeholder="Enter hotel name" value="{{ old('name', $hotel->name) }}" autofocus />
                        <span id="hotel_name_error" class="text-danger"></span>
                    </div>
                </div>

                <div class="row mb-5">
                    <label class="fw-semibold mb-2 col-sm-3 d-flex align-items-center gap-2">Select Location On Google <span class="material-symbols-outlined">share_location</span> </label>
                    <div class="col-sm-9">
                        <select class="form-select places" name="google_place_id" id="places-select2">
                            <option value="">Select Location</option>
                            @if( $hotel->google_place_id )
                            <option value="{{ $hotel->google_place_id }}" @selected(true)>{{ $hotel->google_place_text }}</option>
                            @endif
                        </select>
                        <input type="hidden" name="google_place_text" value="{{$hotel->google_place_text }}" />
                        @if($hotel->google_place_id)
                        <span class="text-success">Already Selected Location Id : {{ $hotel->google_place_id }}</span>
                        @endif
                        <span id="hotel_name_error" class="text-danger"></span>
                    </div>
                </div>

                <div class="row mb-5">
                    <label class="fw-semibold mb-2 col-sm-3">Meta Title <small class="text-danger">(max 70 character allowed)</small></label>
                    <div class="col-sm-9">
                        <input type="text" name="meta_title" class="form-control mb-3 mb-lg-0 character-count" placeholder="Enter Meta Title" value="{{ old('meta_title', $hotel->hotelMeta?->meta_title) }}" maxlength="70" data-target="#character-count-title" />
                        <small id="character-count-title">{{ strlen($hotel->hotelMeta?->meta_title) }} of 70 characters.</small>
                    </div>
                </div>

                <div class="row mb-5">
                    <label class="fw-semibold mb-2 col-sm-3">Meta Description <small class="text-danger">(max 160 character allowed)</small></label>
                    <div class="col-sm-9">
                        <input type="text" name="meta_description" class="form-control mb-3 mb-lg-0 character-count" placeholder="Enter Meta Description" value="{{ old('meta_description', $hotel->hotelMeta?->meta_description) }}" maxlength="160" data-target="#character-count-description" />
                        <small id="character-count-description">{{ strlen($hotel->hotelMeta?->meta_description) }} of 160 characters.</small>
                    </div>
                </div>

                <div class="row mb-5">
                    <label class="required fw-semibold mb-2 col-sm-3">Support Email</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" id="email" class="form-control mb-3 mb-lg-0" placeholder="Enter support email address" value="{{ old('email', $hotel->email) }}" />
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-3">
                        <label class="required fw-semibold ">Support Phone Number</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="phone" maxlength="10" id="hotel_phone_number" class="form-control mb-3 mb-lg-0" placeholder="Enter support phone number" value="{{ old('phone', $hotel->phone) }}" />
                        <span id="hotel_phone_number_error" class="text-danger"></span>

                    </div>
                </div>


                <div class="row mb-5">
                    <label class="required fw-semibold mb-2 col-sm-3">Address</label>
                    <div class="col-sm-9">
                        {{-- <input type="text" name="address" class="form-control mb-3 mb-lg-0"
                        placeholder="Enter Hotel Address"
                        value="{{ old('address', $hotel->address) }}" /> --}}

                        <textarea placeholder="Enter hotel address" class="form-control mb-3 mb-lg-0" data-kt-autosize="true" data-kt-initialized="1" name="address"> {{ old('address', $hotel->address) }}</textarea>
                    </div>
                </div>
                <div class="row w-100 mb-5">
                    <div class="col-sm-3">
                        <label class="fw-semibold mb-2 mt-5">Country*</label>
                    </div>
                    <div class="col-sm-9 col-md-4">
                        <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select country" name="country">
                            <option></option>
                            <option value="india" {{ $hotel->country == 'india' ? 'selected' : '' }}>India</option>
                            <option value="usa" {{ $hotel->country == 'usa' ? 'selected' : '' }}>United States of
                                America</option>
                            <option value="uk" {{ $hotel->country == 'uk' ? 'selected' : '' }}>United Kingdom</option>
                            <option value="australia" {{ $hotel->country == 'australia' ? 'selected' : '' }}>Australia
                            </option>
                            <option value="canada" {{ $hotel->country == 'canada' ? 'selected' : '' }}>Canada</option>
                            <option value="germany" {{ $hotel->country == 'germany' ? 'selected' : '' }}>Germany
                            </option>
                            <option value="france" {{ $hotel->country == 'france' ? 'selected' : '' }}>France</option>
                            <option value="italy" {{ $hotel->country == 'italy' ? 'selected' : '' }}>Italy</option>
                            <option value="china" {{ $hotel->country == 'china' ? 'selected' : '' }}>China</option>
                            <option value="japan" {{ $hotel->country == 'japan' ? 'selected' : '' }}>Japan</option>
                        </select>

                        <span id="country_error" class="text-danger"></span>
                    </div>
                </div>

                <!--begin::Input group-->
                <div class="row mb-5">
                    <!--begin::Label-->
                    <label class="fw-semibold mb-2 col-sm-3">City</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-sm-9">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                                    
                            <div class="col-lg-12 col-12">
                                <select name="city" aria-label="Select a city" data-control="select2" data-placeholder="Select a city..." class="form-select form-select-lg fw-semibold" id="city">
                                    <option></option>
                                    @foreach ($city as $c)
                                    <option value="{{ $c->id }}" @selected(!empty($hotel?->id) && $c->id == $hotel?->city)>
                                        {{ ucwords($c?->name) }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row" id="near_places">
                            @include('hotelmaster.hotelForm.near_by_place')

                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>



                <div class="row mb-5">
                    <label class="fw-semibold mb-2 col-sm-3">Zip Code</label>
                    <div class="col-sm-9">
                        <input type="text" name="zip_code" class="form-control mb-3 mb-lg-0" placeholder="Enter zip code" value="{{ old('zip_code', $hotel->zip_code) }}" />
                    </div>
                </div>

                <div class="row mb-5">
                    <label class="fw-semibold mb-2 col-sm-3">Rating</label>
                    <div class="col-sm-9">
                        <div class="rating">
                            <!--begin::Reset rating-->
                            <!-- <label class="btn btn-light fw-bold btn-sm rating-label me-3" for="kt_rating_2_input_0">
                                Reset
                            </label> -->
                            <input class="rating-input" name="rating2" value="0" type="radio" id="kt_rating_2_input_0" {{ $hotel?->rating == 0 ? 'checked' : '' }} />
                            <!--end::Reset rating-->

                            <!--begin::Stars-->
                            @for ($i = 1; $i <= 5; $i++) <label class="rating-label" for="kt_rating_2_input_{{ $i }}">
                                <i class="ki-duotone ki-star fs-1"></i>
                                </label>
                                <input class="rating-input" name="rating2" value="{{ $i }}" type="radio" id="kt_rating_2_input_{{ $i }}" {{ $hotel?->rating == $i ? 'checked' : '' }} />
                                @endfor
                                <!--end::Stars-->
                        </div>

                    </div>
                </div>

                @if( auth()->user()->getAllPermissions()->pluck('name')->contains('Youtube-Video') || auth()->user()->getRoleNames()->contains('Super Admin'))                
                <div class="row mb-5">
                    <label class="fw-semibold mb-2 col-sm-3">Video Title <small class="text-danger"></small></label>
                    <div class="col-sm-9">
                        <input type="text" name="video_title" class="form-control mb-3 mb-lg-0 character-count" placeholder="Enter Video Title" value="{{ old('video_title', $hotel->video_title??"") }}" />
                    </div>
                </div>
                <input type ="hidden" name="video_permission" value="1">
                @php
                $url = $hotel?->video_url??'';
                $videoId = str_replace("https://www.youtube.com/embed/", "", $url);
                @endphp
                <div class="row mb-5">
                    <label class="fw-semibold mb-2 col-sm-3">Video Id <small class="text-danger"></small></label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <span class="input-group-text" id="short-url-prefix">https://www.youtube.com/embed/</span>
                            <input type="text" name="video_id" class="form-control character-count" placeholder="Enter Video Id" value="{{ old('video_id', $videoId) }}"/>
                        </div>
                    </div>
                </div>
                @endif
            
                <div class="row mb-5">
                    <label class="fw-semibold col-sm-3">Google Map Url</label>
                    <div class="col-sm-9">
                        <input type="url" name="map_url" class="form-control mb-3 mb-lg-0" placeholder="Enter Google Map Url" value="{{$hotel?->map_url}}" />
                    </div>
                </div>
                <div class="row mb-5">
                    <label class="fw-semibold col-sm-3">Google Embed Map Url</label>
                    <div class="col-sm-9">
                        <input type="text" name="embed_map_url" class="form-control mb-3 mb-lg-0" placeholder="Enter Google Embed Map Url" value="{{$hotel?->embed_map_url}}" />
                    </div>
                </div>

                <div class="row mb-5">
                    <label class="fw-semibold mb-2 col-sm-3">Hotel Description</label>
                    <div class="col-sm-9">
                        <textarea name="description" placeholder="Enter hotel description" class="form-control mb-3 mb-lg-0" id="modal-tiny-editor2" rows="5">{{ old('description', $hotel->description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        @empty($hotel)
        <div class="card shadow-sm mt-5">
            <div class="card-header">
                <div class="card-title">
                    <!--begin::Title-->
                    <h3 class="fw-bold text-gray-900 m-0">
                        Hotel Images
                    </h3>
                    <!--end::Title-->
                </div>
            </div>

            <div class="card-body p-5">
                <div class="col-sm-12 d-flex justify-content-between">
                    <div class="col-sm-3">
                        <label class="fw-semibold mb-2 mt-5">Upload Images</label>
                    </div>


                    <div class="col-sm-8">

                        <input type="file" name="hotel_images[]" class="form-control mb-3 mb-lg-0" placeholder="Enter Place" value="" multiple />

                    </div>

                </div>
            </div>

        </div>
        @endempty
        <!--end::Input group-->
        <input type="submit" class="d-none" id="step1">
    </form>
</div>

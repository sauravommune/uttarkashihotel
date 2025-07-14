<div class="flex-column" data-kt-stepper-element="content">
    <!--begin::Input group-->
    <form action="{{ route('hotel.save',['step' => 2]) }}" class="global-ajax-form" method="post" enctype="multipart/form-data" id="step2form">
        <input type="hidden" name="id" value="{{ $hotel->id }}">
    <div class="card shadow-sm mt-5">
        <div class="card-header">
            <div class="card-title">
                <!--begin::Title-->
                <h3 class="fw-bold text-gray-900 m-0">
                    Amenities that guests can use
                </h3>
                <!--end::Title-->
            </div>
        </div>
        <div class="card-body p-5">
            <div class="col-sm-12 d-flex justify-content-between">
                <div class="row w-100 mb-5">
                    <div class="col-sm-3">
                        <label class="fw-semibold mb-2 mt-5">What amenities facilities are
                            available to guests?</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="row">
                            @foreach ($amenities as $amenity)
                                
                            <div class="col-md-4 mt-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="amenity_{{$amenity?->id}}"
                                        name="facility[]" value="{{$amenity?->id}}" @checked(in_array($amenity?->id,$hotel?->amenities->pluck('amenity_id')->toArray()))/>
                                    <label class="form-check-label text-color-secondary" for="amenity_{{$amenity?->id}}">{{$amenity?->name}}</label>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--end::Input group-->
    </div>
    <input type="submit" class="d-none" id="step2">
    </form>
</div>
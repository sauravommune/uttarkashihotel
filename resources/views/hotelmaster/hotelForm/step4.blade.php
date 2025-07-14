<div class="flex-column" data-kt-stepper-element="content">
    <!--begin::Input group-->
    <form action="{{ route('hotel.save',['step' => 4]) }}" class="global-ajax-form" method="post"
        enctype="multipart/form-data" id="step4form">
        <input type="hidden" name="id" value="{{ $hotel->id }}">
        <div class="card shadow-sm mt-5">
            <div class="card-header">
                <div class="card-title">
                    <!--begin::Title-->
                    <h3 class="fw-bold text-gray-900 m-0">
                        Meal Details
                    </h3>
                    <!--end::Title-->
                </div>
            </div>
            <div class="card-body p-5">
                <div class="row w-100 mb-5">
                    <div class="col-sm-3">
                        <label class="fw-semibold mb-2">Do you offer meals for guests?</label>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="position-relative">
                            <div class="d-flex align-content-center gap-8">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" name="breakfast_served" type="radio" value="yes"
                                        id="breakfast_served_yes" @checked($hotel->breakfast_served == 'yes')/>
                                    <label class="form-check-label text-color-secondary" for="breakfast_served_yes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" name="breakfast_served" type="radio" value="no"
                                        id="breakfast_served_no" @checked($hotel->breakfast_served == 'no')/>
                                    <label class="form-check-label text-color-secondary" for="breakfast_served_no">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-5 otherField {{$hotel->breakfast_served == 'no' ? 'd-none' : ''}}" id="b_av_cost">
                    <div class="col-md-3">
                        <label class="fw-semibold mb-2">Average cost of breakfast per person</label>
                    </div>
                    <div class="col-sm-4">
                        <div class="position-relative">
                            <div class="input-group input-group-solid">
                                <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                    id="basic-addon3">₹</span>
                                <input type="text" class="form-control form-control-solid text-color-secondary"
                                    id="text" aria-describedby="basic-addon3" placeholder="Enter amount"
                                    name="enter_amount" value="{{$hotel?->enter_amount}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row w-100 mb-5 otherField {{$hotel->breakfast_served == 'no' ? 'd-none' : ''}}" id="b_type">
                    <div class="col-sm-3">
                        <label class="fw-semibold mb-2 mt-5">What type of breakfast do you
                            serve</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="row">
                            @foreach ($breakfasts as $breakfast)

                            <div class="col-md-4 mt-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="breakfasts[]"
                                        value="{{$breakfast?->id}}"
                                        id="type_{{ $breakfast?->id }}"
                                        @checked(in_array($breakfast?->id,$hotel?->breakfast->pluck('breakfast_id')->toArray()))/>
                                    <label class="form-check-label text-color-secondary" for="type_{{$breakfast?->id}}">
                                        {{$breakfast?->breakfast}}
                                    </label>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" class="d-none" id="step4">
    </form>
    <!--end::Input group-->
</div>
<div class="tab-pane px-7" id="business_address" role="tabpanel">
    <form id="business_address_form">
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Row-->
            <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-7">
                    <div class="my-2">
                        <!--begin::Group-->
                        <div class="form-group row">
                            <label
                                class="col-form-label col-3 text-lg-right text-left">Address
                                Line 1</label>
                            <div class="col-9">
                                <input name="address_1"
                                    class="form-control form-control-lg form-control-solid"
                                    type="text"
                                    value="{{Auth::user()->address_1??''}}">
                            </div>
                        </div>
                        <!--end::Group-->
                        <!--begin::Group-->
                        <div class="form-group row">
                            <label
                                class="col-form-label col-3 text-lg-right text-left">Address
                                Line 2</label>
                            <div class="col-9">
                                <input name="address_2"
                                    class="form-control form-control-lg form-control-solid"
                                    type="text"
                                    value="{{Auth::user()->address_2??''}}">
                            </div>
                        </div>
                        <!--end::Group-->
                        <!--begin::Group-->
                        <div class="form-group row">
                            <label
                                class="col-form-label col-3 text-lg-right text-left">Country</label>
                            <div class="col-9">
                                <select name="country" id="country"
                                    class="form-control form-control-lg form-control-solid">
                                    @foreach($countries as $key => $country)
                                    @if(Auth::user()->country == $key)
                                    <option value="{{ $key }}" selected>
                                        {{ $country }}
                                    </option>
                                    @else
                                    <option value="{{ $key }}">
                                        {{ $country }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--end::Group-->
                        <!--begin::Group-->
                        <div class="form-group row">
                            <label
                                class="col-form-label col-3 text-lg-right text-left">State</label>
                            <div class="col-9" id="state_div">
                                @if(isset(config('data.states')[Auth::user()->country]))
                                <select name="state" id="state"
                                    class="form-control form-control-lg form-control-solid">
                                    @foreach(config('data.states')[Auth::user()->country]
                                    as $state)
                                    @if(Auth::user()->state == $state)
                                    <option value="{{ $state }}" selected>
                                        {{ $state }}
                                    </option>
                                    @else
                                    <option value="{{ $state }}">
                                        {{ $state }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                                @else
                                <input name="state" id="state"
                                    class="form-control form-control-lg form-control-solid"
                                    type="text"
                                    value="{{Auth::user()->state??''}}">
                                @endif
                            </div>
                        </div>
                        <!--end::Group-->
                        <!--begin::Group-->
                        <div class="form-group row">
                            <label
                                class="col-form-label col-3 text-lg-right text-left">City</label>
                            <div class="col-9">
                                <input name="city"
                                    class="form-control form-control-lg form-control-solid"
                                    type="text"
                                    value="{{Auth::user()->city??''}}">
                            </div>
                        </div>
                        <!--end::Group-->
                        <!--begin::Group-->
                        <div class="form-group row">
                            <label
                                class="col-form-label col-3 text-lg-right text-left">Postcode</label>
                            <div class="col-9">
                                <input name="postcode"
                                    value="{{Auth::user()->postcode??''}}"
                                    class="form-control form-control-lg form-control-solid"
                                    type="text">
                            </div>
                        </div>
                        <!--end::Group-->
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--begin::Body-->

        <!--begin::Footer-->
        <div class="card-footer pb-0">
            <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-7">
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-9">
                            <button type="submit"
                                id="business_address_form_submit"
                                class="btn btn-light-primary font-weight-bold">
                                Save Changes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Footer-->
    </form>
</div>
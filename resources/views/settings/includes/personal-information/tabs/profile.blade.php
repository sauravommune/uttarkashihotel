<div class="tab-pane px-7 active" id="user_profile_tab" role="tabpanel">
    <form id="profile_info_form" enctype="multipart/form-data">
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Row-->
            <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-7 my-2">
                    <!--begin::Row-->
                    <div class="row">
                        <label class="col-3"></label>
                        <div class="col-9">
                            <h6 class="text-dark font-weight-bold mb-10">
                                Customer Info:</h6>
                        </div>
                    </div>
                    <!--end::Row-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">Avatar</label>
                        <div class="col-9">
                            <div class="image-input image-input-empty image-input-outline" id="kt_user_edit_avatar"
                                style="background-image: {{!empty(Auth::user()->avatar) ? 'url('.Auth::user()->avatar.')':'none'}}">
                                <div class="image-input-wrapper"></div>
                                <label
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="cancel" data-toggle="tooltip" title=""
                                    data-original-title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">
                            Name</label>
                        <div class="col-9">
                            <input name="name" class="form-control form-control-lg form-control-solid" type="text"
                                value="{{Auth::user()->name}}">
                        </div>
                    </div>
                    <!--end::Group-->


                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">Email
                            Address <i class="flaticon2-information mt-1 cursor-pointer info_send_email"
                                data-html="true" data-placement="top" data-toggle="popover"
                                data-content="You can't change your email address, Please contact Administrator"></i></label>
                        <div class="col-9">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-at"></i>
                                    </span>
                                </div>
                                <input type="text" disabled class="form-control form-control-lg form-control-solid"
                                    value="{{Auth::user()->email}}" placeholder="Email">

                            </div>

                        </div>
                    </div>
                    <!--end::Group-->
                    @if(Auth::user()->role == 'broker')
                    <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">Phone</label>
                        <div class="col-9">
                            <div class="input-group input-group-solid">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-phone"></i>
                                    </span>
                                </div>
                                <input type="text" name="phone" id="phone"
                                    class="form-control " value="{{ Auth::user()->phone ?? '' }}"
                                    placeholder="Phone" />
                            </div>
                        </div>
                    </div>
                    @endif

                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">Time
                            Zone</label>
                        <div class="col-9">
                            <select name="timezone" id="timezone_select"
                                class="form-control form-control-lg form-control-solid">
                                @foreach(config('data.timezones') as $key => $value)
                                <option value="{{$key}}" @if($key==Auth::user()->timezone)
                                    selected
                                    @endif
                                    >{{$value}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <!--end::Group-->
                


                    <div class="separator separator-dashed my-10"></div>
                    <div class="my-5">
                        <h3 class="text-dark font-weight-bold mb-10">Address Details:</h3>
                        <div class="form-group row">
                            <label class="col-3">Country</label>
                            <div class="col-9">
                                <select name="country" id="country" class="form-control ">
                                    {{ $selected_country = $user->country ?? 'IN' }}
                                    @foreach ($countries as $key => $country)
                                        @if ($selected_country == $key)
                                            <option value="{{ $key }}" selected>
                                                {{ $country }}</option>
                                        @else
                                            <option value="{{ $key }}">
                                                {{ $country }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!--begin::Group-->
                        <div class="form-group row">
                            <label class="col-3">State</label>

                            <div class="col-9" id="state_div">
                                @if (isset(config('data.states')[$user->country]))
                                    <select name="state" id="state"
                                        class="form-control form-control-lg ">
                                        @foreach (config('data.states')[$user->country] as $state)
                                            @if ($user->state == $state)
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
                                        class="form-control form-control-lg " type="text"
                                        value="{{ $user->state ?? '' }}">
                                @endif
                            </div>
                        </div>
                        <!--end::Group-->

                        <div class="form-group row">
                            <label class="col-3">Address Line 1</label>
                            <div class="col-9">
                                <input class="form-control " type="text" name="address_1"
                                    value="{{ $user->address_1 ?? '' }}" id="address_1" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Address Line 2</label>
                            <div class="col-9">
                                <input class="form-control " type="text" name="address_2"
                                    value="{{ $user->address_2 ?? '' }}" id="address_2" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">City</label>
                            <div class="col-9">
                                <input class="form-control " type="text" name="city"
                                    value="{{ $user->city ?? '' }}" id="city" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3">Zip / Postal Code</label>
                            <div class="col-9">
                                <input class="form-control " type="text" name="postcode"
                                    value="{{ $user->postcode ?? '' }}" id="postcode" />
                            </div>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>

                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Body-->

        <!--begin::Footer-->
        <div class="card-footer pb-0">
            <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-7">
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-9">
                            <button type="submit" id="profile_info_form_submit"
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
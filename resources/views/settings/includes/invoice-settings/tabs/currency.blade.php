<div class="tab-pane px-7" id="currency_settings" role="tabpanel">
    <form id="currency_form">
        <!--begin::Row-->
        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-7 my-2">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-12">
                        <h6 class="text-dark font-weight-bold mb-10">
                            Currency Settings</h6>
                    </div>
                </div>
                <!--end::Row-->
                <!--begin::Group-->
                <div class="form-group row">
                    <label  class="col-lg-4 col-form-label">Invoice Currency</label>
                    <div class="col-lg-8">
                        <div class="input-group">
                            <select class="form-control" name="currency" >
                                @foreach (config('data.currencies') as $key => $value)
                                @if(isset($adminsetting->invoice_settings['currency']) &&
                                $adminsetting->invoice_settings['currency'] == $key)
                                <option value="{{$key}}" selected>{!!$value['code']!!} {{$value['name']}}</option>
                                @else
                                <option value="{{$key}}">{!!$value['code']!!} {{$value['name']}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!--end::Group-->
            </div>
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10">
                <h6 class="text-dark font-weight-bold mb-10">
                    <button type="submit" id="currency_form_submit" 
                        class="btn btn-light-primary font-weight-bold">
                        Save</button>
                    </h6>
            </div>
        </div>
        <!--end::Row-->
    </form>
</div>
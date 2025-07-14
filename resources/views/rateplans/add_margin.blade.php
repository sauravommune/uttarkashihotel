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
                    <!--end::Title-->
                    <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="index.html" class="text-color-secondary text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-color-secondary"> {{ $title }}</li>
                        <!--end::Item-->
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
                <!--begin::Card header-->
                <div class="card-body p-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title d-flex align-items-start flex-column">
                            <span class="card-label fw-bold text-color">{{$ratePlan?->roomType?->name}}</span>
                            <span class="text-color-secondary mt-1 fw-semibold fs-6">{{$ratePlan?->hotel?->name}}, {{$ratePlan?->hotel?->cityName?->name}}</span>
                        </h3>

                        <div class="card-title d-flex align-items-start flex-column gap-2">
                            <span class="text-color-secondary mt-1 fw-semibold fs-8">Pricing Dates:</span>
                            <span class="card-label fw-bold text-color">{{$ratePlan?->pricingDates}}</span>
                            </h3>
                        </div>
                    </div>
                    <form action="{{ route('ratePlan.update.margin') }}" method="POST" class="global-ajax-form" data-redirect-url = "{{url()->previous()}}">
                        @csrf
                        <div class="table-responsive">
                            <input type="hidden" name="id" value="{{$ratePlan?->id}}">
                            <table id="margin_table border-0" class="table table-row-bordered gy-5  table-hover-none">
                                <thead>
                                    <tr class="fw-semibold fs-6 text-muted">
                                        <th>Rate Plans</th>
                                        <th>B2B Rate</th>
                                        <th>Markup</th>
                                        <th>Amount Payable by Guest</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="text-color fs-7 fw-bold">EP Rates</span>
                                                <span class="text-color-secondary fw-semibold  fs-8">Room
                                                    only, with no meals.</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-solid">
                                                <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                                    id="basic-addon3">₹</span>
                                                <input type="number" class="form-control"  id="floatingPassword"
                                                    value="{{ $ratePlan->b2b_rate_ep ?? 0 }}" name="b2b_rate_ep" readonly/>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="input-group input-group-solid cursor-not-allowed">
                                                <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                                    id="basic-addon3">₹</span>
                                                <input type="number"
                                                    class="form-control form-control-solid text-color-secondary"
                                                    id="cp_gest_pay" aria-describedby="basic-addon3"
                                                    placeholder="Enter amount" name="markup_ep"
                                                    value="{{ $ratePlan->markup_ep ?? 0 }}">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="input-group input-group-solid">
                                                <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                                    id="basic-addon3">₹</span>
                                                <input type="number" class="form-control"  id="floatingPassword"
                                                    value="{{ $ratePlan->total_amount_ep ?? 0 }}" name="guest_pay_ep" readonly/>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="text-color fs-7 fw-bold">CP Rates</span>
                                                <span class="text-color-secondary fw-semibold  fs-8">Breakfast
                                                    is included along with room.</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-solid">
                                                <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                                    id="basic-addon3">₹</span>
                                                <input type="number" class="form-control"  id="floatingPassword"
                                                    value="{{ $ratePlan->b2b_rate_cp ?? 0 }}" name="b2b_rate_cp" readonly/>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="input-group input-group-solid cursor-not-allowed">
                                                <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                                    id="basic-addon3">₹</span>
                                                <input type="number"
                                                    class="form-control form-control-solid text-color-secondary"
                                                    id="cp_gest_pay" aria-describedby="basic-addon3"
                                                    placeholder="Enter amount" name="markup_cp"
                                                    value="{{ $ratePlan->markup_cp ?? 0 }}">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="input-group input-group-solid">
                                                <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                                    id="basic-addon3">₹</span>
                                                <input type="number" class="form-control"  id="floatingPassword"
                                                    value="{{$ratePlan->total_amount_cp ?? 0 }}" name="guest_pay_cp" readonly/>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="text-color fs-7 fw-bold">MAP Rates</span>
                                                <span class="text-color-secondary fw-semibold  fs-8">Includes
                                                    room, breakfast & dinner</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-solid">
                                                <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                                    id="basic-addon3">₹</span>
                                                <input type="number" class="form-control"  id="floatingPassword"
                                                    value="{{ $ratePlan->b2b_rate_map ?? 0 }}" name="b2b_rate_map" readonly/>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="input-group input-group-solid cursor-not-allowed">
                                                <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                                    id="basic-addon3">₹</span>
                                                <input type="number"
                                                    class="form-control form-control-solid text-color-secondary"
                                                    id="cp_gest_pay" aria-describedby="basic-addon3"
                                                    placeholder="Enter amount" name="markup_map"
                                                    value="{{ $ratePlan->markup_map ?? 0 }}">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="input-group input-group-solid">
                                                <span class="input-group-text bg-dark-gray-f2 text-color-secondary"
                                                    id="basic-addon3">₹</span>
                                                <input type="number" class="form-control"  id="floatingPassword"
                                                    value="{{ $ratePlan->total_amount_map ?? 0 }}" name="guest_pay_map" readonly/>
                                            </div>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                            <div class="position-relative my-3 pb-5">
                                <div class="separator-vertical "> </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"> {{ $title }}
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>


        @push('scripts')
        <script>
        $(function() {
            $('input[name=markup_ep]').on('input',function(){
                let base_ep = $('input[name=b2b_rate_ep]').val();
                let amt = $(this).val();
                let total = (base_ep*1 + amt*1)
                $('input[name=guest_pay_ep]').val(total);
            })
            $('input[name=markup_cp]').on('input',function(){
                let base_cp = $('input[name=b2b_rate_cp]').val();
                let amt = $(this).val();
                let total = (base_cp*1 + amt*1)
                $('input[name=guest_pay_cp]').val(total);
            })
            $('input[name=markup_map]').on('input',function(){
                let base_map = $('input[name=b2b_rate_map]').val();
                let amt = $(this).val();
                let total = (base_map*1 + amt*1)
                $('input[name=guest_pay_map]').val(total);
            })
        });
        </script>

        @endpush

</x-app-layout>

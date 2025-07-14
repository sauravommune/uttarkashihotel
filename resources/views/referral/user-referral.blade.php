<x-app-layout>
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex justify-content-between align-items-center me-3 w-100">
                    <div>
                        <!--begin::Title-->
                        <h1 class="page-heading text-color fw-bold fs-18 m-0">
                            Referral
                        </h1>

                    </div>




                </div>

            </div>

        </div>

    </div>



    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card border-0">
                <!--begin::Card header-->
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="custom-referral">
                            <div class="d-flex align-items-center">
                                <div>
                                    <label class="form-label" for="name">Your Referral Code :- </label>
                                </div>
                                <div>
                                    <p> <b class="text-success ms-2 fs-2 justify-content-center">{{auth()->user()?->affiliate_code}}</b> </p>
                                </div>
                            </div>

                            <div>
                                <div>
                                    <label class="form-label" for="name">Enter Referral URL<span class="text-danger">*</span></label>
                                </div>
                                <div class="row pb-4 pt-2">
                                    <div class="col-6 col-md-7">
                                        <input type="text" class="form-control" id="referral_url" name="referral_url">
                                    </div>
                                 
                                    <div class="col-6 col-md-5">
                                        <button class="btn btn-primary create-link w-100 w-md-auto">Create Link</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-8 custom-referral-tab">
                <div class="col-12">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#referrals">Referrals</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#payout">Payouts</a>
                        </li>

                    </ul>

                </div>
                <div class="col-12 mt-0">
                    <div class="tab-content">
                        <div class=" tab-pane active" id="referrals">
                            <div class="row mt-10">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                    <div class="mb-2 fv-plugins-icon-container">
                                        <label class="form-label" for="name">From Date<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control flatpicker" id="from_date" name="from_date">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                    <div class="mb-2 fv-plugins-icon-container">
                                        <label class="form-label" for="name">To Date<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control flatpicker" id="to_date" name="to_date">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                    <div class="fv-plugins-icon-container">
                                        <label class="form-label" for="name">&nbsp;</label>
                                        <input type="button" class="btn btn-primary search_btn w-100" value="Search">
                                    </div>
                                </div>
                            </div>

                            <div class="row pt-3 pt-lg-4 custom-referral-tab mt-5">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                    <div class="lead-box d-flex align-items-center">
                                        <div class="d-flex align-items-center justify-content-between w-100">
                                            <div class="d-flex align-items-center">
                                                <div class="icon">
                                                    <i class="fa fa-users"></i>
                                                </div>
                                                <div class="ps-2">
                                                    <p class="mb-0"><b>Total Leads</b></p>
                                                </div>
                                            </div>
                                            <div>
                                                <b class="total_leads">{{ $total_leads }}</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                    <div class="lead-box d-flex  align-items-center">
                                        <div class="d-flex align-items-center justify-content-between w-100">
                                            <div class="d-flex align-items-center">
                                                <div class="icon icon-1">
                                                    <i class="fa fa-car"></i>
                                                </div>
                                                <div class="ps-2">
                                                    <p class="mb-0"><b>Total Completed</b></p>
                                                </div>
                                            </div>
                                            <div>
                                                <b class="completed_leads">{{ $completed_leads_count }}</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                    <div class="lead-box d-flex  align-items-center">
                                        <div class="d-flex align-items-center justify-content-between w-100">
                                            <div class="d-flex align-items-center">
                                                <div class="icon icon-2">
                                                    <i class="fa fa-bar-chart"></i>
                                                </div>
                                                <div class="ps-2">
                                                    <p class="mb-0"><b>Total Amount</b></p>
                                                </div>
                                            </div>
                                            <div>
                                                &#8377<b class="total_earning"> {{$earnings}}</b>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                    <div class="lead-box d-flex  align-items-center">
                                        <div class="d-flex align-items-center justify-content-between w-100">
                                            <div class="d-flex align-items-center">
                                                <div class="icon icon-3">
                                                    <i class="fa fa-bar-chart"></i>
                                                </div>
                                                <div class="ps-2">
                                                    <p class="mb-0"><b>Paid Amount</b></p>
                                                </div>
                                            </div>
                                            <div>
                                                &#8377 <b class="paid_amount">{{$total_payouts}}</b>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="payout">
                            <div class="table-responsive">
                                {{ $payoutTransactionDataTable->table() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>


    </div>
    @push('scripts')
    {{ $payoutTransactionDataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(document).ready(function() {
            $('.create-link').click(function() {
                var text = $('#referral_url').val();
                $.ajax({
                    url: "{{route('check.domain')}}"
                    , method: 'POST'
                    , data: {
                        url: text
                        , _token: '{{ csrf_token() }}'
                    }
                    , success: function(response) {

                        if (response.success) {
                            debugger;
                            var copyText = response.text;
                            var $temp = $("<input>");
                            $("body").append($temp);
                            $temp.val(copyText).select();
                            document.execCommand("copy");
                            $temp.remove()

                            Swal.fire({
                                text: 'Copied'
                                , toast: true
                                , position: "top-right"
                                , timer: 1500
                                , timerProgressBar: true
                                , icon: "success"
                                , showConfirmButton: false,

                            })

                        }
                    }
                    , error: function(error) {
                        console.log(error);
                        Swal.fire({
                            text: error.responseJSON.message
                            , toast: true
                            , position: "top-right"
                            , timer: 1500
                            , timerProgressBar: true
                            , icon: "error"
                            , showConfirmButton: false,

                        })
                    }
                });
            });

            $('body').on('click', '.search_btn', function(r) {
                r.preventDefault();
                $.ajax({
                    url : "{{url()->current()}}",
                    method : 'get',
                    data:{
                        start_date : $('#from_date').val(),
                        end_date : $('#to_date').val(),
                    },
                    success : function(response){
                        $('.paid_amount').text(response.data.total_payouts);
                        $('.total_earning').text(response.data.earnings);
                        $('.total_leads').text(response.data.total_leads);
                        $('.completed_leads').text(response.data.completed_leads_count);
                    }
                })
                
            })
        });

    </script>
    @endpush
</x-app-layout>

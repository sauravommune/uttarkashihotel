<div class="flex-column" data-kt-stepper-element="content">
    <!--begin::Input group-->
    <form action="{{ route('hotel.save',['step' => 6]) }}" class="global-ajax-form" method="post"
        enctype="multipart/form-data" id="step6form">
        <input type="hidden" name="id" value="{{ $hotel->id }}">
        <div class="card shadow-sm mt-5">
            <div class="card-header">
                <div class="card-title">
                    <!--begin::Title-->
                    <h3 class="fw-bold text-gray-900 m-0">
                        Banking Details & Invoicing
                    </h3>
                    <!--end::Title-->
                </div>
            </div>
            <div class="card-body p-5">
                <div class="row mb-10">
                    <div class="col-md-3">
                        <label class="fw-semibold mb-2 mt-2">Bank Name</label>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="position-relative">
                            <select class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Select a bank" name="bank_name">
                                <option></option>
                                @foreach ($banks as $Bank )
                                <option value="{{ $Bank->code}}" @selected($hotel?->bankDetail?->bank_name ==  $Bank->code)>{{ $Bank->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-3">
                        <label class="fw-semibold mb-2 mt-2">IFSC Code</label>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="position-relative">

                            <input type="text" class="form-control form-control-solid"
                                placeholder="Enter IFSC code of your Bank" name="ifsc"
                                value="{{$hotel?->bankDetail?->ifsc}}" />
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-3">
                        <label class="fw-semibold mb-2 mt-2">Branch Name</label>
                    </div>
                    <div class="col-md-4 col-12">
                        <input type="text" class="form-control form-control-solid"
                            placeholder="Enter branch name of your bank" name="branch_name"
                            value="{{$hotel?->bankDetail?->branch}}" />
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-3">
                        <div class="d-flex flex-column">
                            <label class="fw-semibold">Account Holder Name</label>
                            {{-- <p class="fw-semibold text-muted fs-7">As Per your PAN ID</p> --}}
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <input type="text" class="form-control form-control-solid"
                            placeholder="Enter name as per your pan card" name="account_holder_name"
                            value="{{$hotel?->bankDetail?->account_holder_name}}" />
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-3">
                        <label class="fw-semibold mb-2 mt-2">Account Number</label>
                    </div>
                    <div class="col-md-4 col-12">
                        <input type="number" class="form-control form-control-solid"
                            placeholder="Enter account number of your bank" name="account_number"
                            value="{{$hotel?->bankDetail?->account_number}}" />
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-3">
                        <label class="fw-semibold mb-2 mt-2">UPI ID</label>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="input-group mb-5">
                            <input type="text" id="upi_input" class="form-control form-control-solid"
                                placeholder="Enter upi number of your bank" aria-label="Enter UPI Number of your Bank"
                                name="upi_id" value="{{$hotel?->bankDetail?->upi_id}}" />
                        </div>
                    </div>

                </div>

                <div class="position-relative mb-5">
                    <div class="separator-vertical "></div>
                </div>

                <div class="row w-100 mb-5">
                    <div class="col-sm-9">
                        <div class="d-flex flex-column">
                            <label class="fw-bold mb-2 mt-5 fs-18">Invoicing</label>
                            <span class="fw-semibold text-color-secondary fs-7">At the
                                beginning of each month we will send you an invoice for all complete
                                bookings in the previous month.</span>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-4">
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-3">
                        <label class="fw-semibold mb-2 mt-2">Name on the Invoice</label>
                    </div>
                    <div class="col-sm-4">
                        <input class="form-control form-control-solid" type="text" id="invoice_name"
                            placeholder="Urban Boutique Hotel" name="name_on_invoice"
                            value="{{$hotel?->bankDetail?->name_on_invoice ? $hotel?->bankDetail?->name_on_invoice : strtoupper($hotel->name) }}" />
                    </div>
                </div>

                <div class="position-relative mb-5">
                    <div class="separator-vertical "></div>
                </div>

                <div class="row w-100 mb-5">
                    <div class="col-sm-9">
                        <div class="d-flex flex-column">
                            <label class="fw-bold mb-2 mt-5 fs-18">Taxes</label>
                            <span class="fw-semibold text-color-secondary fs-7">Due to regulations
                                established by Indian Government, we need the following details. By
                                submitting this information, you are confirming that your PAN and
                                state registration are accurate.</span>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-4">
                    </div>
                </div>

                <div class="row w-100 mb-5" id="aadhar_box">
                    <div class="col-sm-3">
                        <label class="fw-semibold mb-2 mt-5">GSTIN</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="gst_no" class="form-control form-control-solid" id="gst"
                            placeholder="Enter GSTIN number" value="{{$hotel?->gst_no}}" />
                    </div>
                </div>

                <div class="row w-100 mb-5">
                    <div class="col-sm-3">
                        <label class="fw-semibold mb-2 mt-5">PAN number</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="pan_no" class="form-control form-control-solid" id="pan_input"
                            placeholder="Enter pan number" value="{{$hotel?->pan_no}}" />
                    </div>
                </div>

            </div>
            <!--end::Input group-->
        </div>
        <input type="submit" class="d-none" id="step6">
    </form>
</div>
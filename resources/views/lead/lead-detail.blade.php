<x-app-layout>
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2 section-30">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-xl-flex align-items-stretch">
            <!--begin::Toolbar wrapper-->
            <div
                class="app-toolbar-wrapper d-flex justify-content-between w-100 d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-color fw-bold fs-18 m-0">
                        {{ $title }}
                    </h1>
                    <!--end::Title-->
                    {{-- <h6 class="text-muted">Manage all your Company here!</h6> --}}
                    <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('superAdmin.dashboard') }}"
                                class="text-color-secondary text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('lead.index') }}"
                                class="text-color-secondary text-hover-primary">Leads</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-color-secondary">{{ $title }}</li>
                        <!--end::Item-->
                    </ul>

                </div>
            </div>
            <div class="left-side-section">
                <div class="d-flex align-items-center">
                    <div class="d-flex text-nowrap">
                        <span>ID:</span>
                        <span>
                            {{ $bookingDetails?->booking_id }}
                        </span>
                    </div>

                    <div class="lock-section ms-2">
                        <div class="d-flex">
                            <div>
                                <img src="https://placehold.co/16x16" width="" height="" alt=""
                                    title="" />
                            </div>
                            <div class="short-name px-3">AS</div>
                            <a href="javascript:void(0);">
                                <div class="lock-icon">
                                    <span class="fa fa-lock"></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2 section-31">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid">
            <input type="hidden" name="booking_id" value={{ encode($bookingDetails?->id) }}>
            <div class="app-toolbar-wrapper">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 mb-xl-0  mb-5">
                        <div class="custom-card">
                            <span class="d-block">Bookings Status</span>
                            <h2 class="text-uppercase badge {{ $bookingDetails?->status=='Confirmed' ? 'badge-light-success' : 'badge-light-danger' }} mt-2 mb-0 current-booking-status">{{ $bookingDetails?->status }}</h2>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 mb-xl-0  mb-5">
                        <div class="custom-card">
                            <span class="d-block">Payment Status</span>
                            @php
                                $transaction = !empty($transactions) ? $transactions?->where('status', 'captured')->first() : [];
                                $transaction = $transaction?->status == 'captured' ? $transaction : $transaction?->transaction;
                                $paymentStatus = $transaction?->status ?? 'pending';
                                $transaction_status = '';
                                if ($transactions->count() != 1) {
                                    $transaction_status = $transactions
                                        ->where('status', '!=', 'captured')
                                        ->pluck('status')
                                        ->unique()
                                        ->toArray();
                                    $transaction_status = implode(
                                        ' ',
                                        array_map(function ($status) {
                                            return "<span class='transactions-status-identifiers $status' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-title='" .
                                                ucfirst($status) .
                                                "' >" .
                                                ucfirst($status[0]) .
                                                ' </span> ';
                                        }, $transaction_status),
                                    );
                                }

                                $badgeClass = match ($paymentStatus) {
                                    'captured' => 'success',
                                    'authorized' => 'primary',
                                    'failed' => 'danger',
                                    'refunded' => 'secondary',
                                    'pending' => 'warning',
                                    'expired' => 'danger',
                                    'cancelled' => 'danger',
                                    default => 'warning',
                                };
                            @endphp
                            <h2 class="text-uppercase badge badge-light-{{ $badgeClass }} mt-2 mb-0">
                                {{ $paymentStatus }}</h2> <br /> {!! $transaction_status !!}
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 mb-xl-0  mb-5">
                        <div class="custom-card">
                            <span class="d-block">Coupon</span>
                            <h2 class="text-uppercase  p-2 px-0  d-inline-block rounded  text-black  mb-0">N/A</h2>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 mb-xl-0  mb-5">
                        <div class="custom-card">
                            {{-- <span class="d-block">Refunds Initiated</span>
                            <h2 class="text-uppercase  p-2 px-0  d-inline-block rounded  text-black  mb-0">
                                <i class="fa fa-inr text-black"></i>0
                                <span class="badge badge-light-success ms-2 ">% 0</span>
                            </h2> --}}
                            <span class="d-block mb-3">Booking Type</span>
                            <span class='text-uppercase text-dark'>{{$bookingDetails->special_requirements == 'consult-now' ? 'Enquiry' : 'Lead'}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid section-32">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9">
                    <section class="section-33">
                        <div class="center-border-section"></div>
                        <div class="main-content-box">
                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-3 mt-xl-0 mt-4 content-repeat">
                                    <div class="check-section">
                                        <div>
                                            <span>Check In</span>
                                            <h2>{{ formatDateMdY($bookingDetails->check_in_date) }}</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-3 mt-xl-0 mt-4 content-repeat">
                                    <div class="check-section">
                                        <div>
                                            <span>Check out</span>
                                            <h2>{{ formatDateMdY($bookingDetails->check_out_date) }}</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-3 mt-xl-0 mt-4 content-repeat">
                                    <div class="check-section">
                                        <div>
                                            <span>Stay</span>
                                            <h2>
                                                @if( $bookingDetails?->bookedRooms->sum('quantity') )
                                                    {{ $bookingDetails?->bookedRooms->sum('quantity') }}
                                                @else
                                                    {{ $bookingDetails?->total_room }}
                                                @endif
                                                Room(s),{{ stayNights($bookingDetails->check_in_date, $bookingDetails->check_out_date) }}
                                                Night(s)
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-3 mt-xl-0 mt-4 content-repeat">
                                    <div class="check-section">
                                        <div>
                                            <span>Total Guests</span>
                                            <h2>
                                                @if( $bookingDetails?->adult )
                                                    {{ $bookingDetails?->adult }} Adult(s)
                                                    {{ $bookingDetails?->child > 0 ? ',' . $bookingDetails?->child . 'Child(s)' : '' }}
                                                @else
                                                    {{ $bookingDetails?->total_guest }} Guest(s)
                                                @endif
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main-content-box px-0 mb-0 pb-0">
                            <div class="d-flex justify-content-between align-items-center w-100 custom-px-15">
                                <div class="main-common-title">
                                    <h2>Guest(s) Details</h2>
                                </div>
                                <div>
                                    <a href="{{ Route('lead.guest', $bookingDetails?->booking_id) }}"
                                        data-bs-toggle="modal" data-bs-target="#global_modal"
                                        data-bs-whatever="Add Guest">
                                        <div class="edit-icon dark-dark-bg">
                                            <span class="fa fa-add text-white"></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @if (!empty($travelers))
                                <div class="table-section">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0" id="guest-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Gender</th>
                                                    <th>Date Of Birth</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <div class="main-content-box px-0 mb-0 pb-0 call-section">
                            <div class="d-flex justify-content-between align-items-center w-100 custom-px-15">
                                <div class="main-common-title">
                                    <h2>Contact Details</h2>
                                </div>
                                <div>
                                    <a href="{{ Route('lead.contact', [$bookingDetails?->booking_id, encode($contactInfo?->id)]) }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#global_modal"data-bs-whatever="Update Contact Information">
                                        <div class="edit-icon dark-dark-bg">
                                            <span class="fa fa-edit text-white"></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="table-section">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $bookingDetails?->contactInfo?->name }}</td>
                                                <td>{{ $bookingDetails?->contactInfo?->email }}</td>
                                                <td>{{ $bookingDetails?->contactInfo?->mobile }}</td>
                                                <td>
                                                    <a href="tel:{{ $bookingDetails?->contactInfo?->mobile }}"
                                                        class="custom-pill">
                                                        <i class="fa fa-phone pe-1"></i>Call Now
                                                    </a>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="main-content-box px-0 mb-0 pb-0 ">
                            <div class="d-flex justify-content-between align-items-center w-100 custom-px-15">
                                <div class="main-common-title">
                                    <h2>Hotel Details</h2>
                                </div>
                            </div>
                            <div
                                class="d-flex justify-content-between align-items-center w-100 custom-px-15 border-top">
                                <div class="main-common-title pt-4">
                                    <div>
                                        <h2>{{ ucwords($bookingDetails->hotel?->name ?? '') }}</h2>
                                        @if ($rating = $bookingDetails->hotel?->rating)
                                            @for ($i = 0; $i < $rating; $i++)
                                                <span class="fa fa-star text-warning"></span>
                                            @endfor
                                        @endif
                                        <span class="location-item">
                                            {{ $bookingDetails->hotel?->cityDetails?->name }}, {{ $bookingDetails->hotel?->cityDetails?->state?->name }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="table-section hotel-detail">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Rooms</th>
                                                <th>Room Type</th>
                                                <th>Meal Preference</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($roomDetails as $key => $value)
                                                <tr>
                                                    <td>{{ $value?->quantity }}</td>
                                                    <td>{{ $value?->roomCategory?->name }}</td>
                                                    <td>{{ $value?->break_fast_type }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="text-danger text-center" colspan="3">Rooms not selected!</td>
                                                </tr>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="w-100 custom-px-15 border-top">
                                <div class="main-common-title pt-4 calamite">
                                    <span class="text-uppercase location-item mt-3">Booking Date & Time: </span> {{ formatDateMdYHiA($bookingDetails->created_at) }}
                                </div>
                            </div>

                        </div>

                        @if($bookingDetails->coupon)
                        <div class="main-content-box px-0 mb-0 pb-0 ">
                            <div class="d-flex justify-content-between align-items-center w-100 custom-px-15">
                                <div class="main-common-title">
                                    <h2>Discount Coupons</h2>
                                </div>
                            </div>
                            <div class="table-section hotel-detail">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>title</th>
                                                <th>description</th>
                                                <th>value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div>
                                                        <div class="d-flex align-items-center mt-2">
                                                            <div>
                                                                <img src="{{ asset('assets/media/basic-deal.png') }}" width="" height="" alt="" />
                                                            </div>
                                                            <div class="ps-3 calamite">
                                                                <h2 class="text-color basic-deal">{{ $bookingDetails->coupon?->code }}</h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mt-3">
                                                        12% Discount
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="w-100 custom-px-15 border-top bg-light-custom">
                                <div class="main-common-title pt-4 calamite">
                                    <div class="text-center center-items-text"><i
                                            class="fa-solid fa-ticket-simple pe-2"></i>No coupons were applied</div>
                                </div>
                            </div>


                        </div>
                        @endif

                        <div class="center-border-section my-5">
                            <div class="border-center"></div>
                        </div>
                        <div class="main-content-box px-0 mb-0 pb-0 ">
                            <div class="d-flex justify-content-between align-items-center w-100 custom-px-15">
                                <div class="main-common-title">
                                    <h2>Special Requests</h2>
                                </div>
                            </div>
                            @if ($bookingDetails?->special_requirements)
                                <div class="table-section content-text border-top">
                                    <p>{{ $bookingDetails?->special_requirements }}</p>
                                </div>
                            @else
                                <div class="w-100 custom-px-15 border-top bg-light-custom">
                                    <div class="main-common-title pt-4 calamite">
                                        <div class="text-center center-items-text"><i
                                                class="fa fa-thumbs-up pe-2"></i>No special request from guest.</div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="main-content-box px-0 mb-0 pb-0 ">
                            <div class="d-flex justify-content-between align-items-center w-100 custom-px-15">
                                <div class="main-common-title">
                                    <h2>Client Payment Details</h2>
                                </div>
                                <div>
                                    <a href="{{ Route('lead.transactions', $bookingDetails?->booking_id) }}"
                                        data-bs-toggle="modal" data-bs-target="#global_modal"
                                        data-bs-whatever="Add Transaction">
                                        <div class="edit-icon dark-dark-bg">
                                            <span class="fa fa-add text-white"></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex gap-2 align-items-center px-5 mb-3">
                                <span>Expected Markup : <strong class="expected-markup">0.00</strong></span> <br/>
                                <span>Coupon Amount : <strong class="coupon_discount">0.00</strong></span> <br/>
                                <span>Current Markup : <strong class="current-markup">0.00</strong></span> <br/>
                            </div>
                            <div class="table-section hotel-detail">
                                <table class="table table-bordered mb-0" id="transaction-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Transaction ID</th>
                                            <th>Payment Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Mode</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td colspan="2">
                                                <strong>Total Captured</strong>
                                            </td>
                                            <td>
                                                <strong
                                                    id="total-amount">{{ _nf($transactions->sum('amount')) }}</strong>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="main-content-box px-0 mb-0 pb-0 ">
                            <div class="d-flex justify-content-between align-items-center w-100 custom-px-15">
                                <div class="main-common-title">
                                    <h2>Vendor Payment Details</h2>
                                </div>
                                <div>
                                    <a href="{{ Route('lead.vendor.transactions', encode($bookingDetails?->id)) }}"
                                        data-bs-toggle="modal" data-bs-target="#global_modal" data-bs-whatever="Add Transaction">
                                        <div class="edit-icon dark-dark-bg">
                                            <span class="fa fa-add text-white"></span>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="table-section hotel-detail">
                                <table class="table table-bordered mb-0" id="vendor-transaction-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Transaction ID</th>
                                            <th>Payment Date</th>
                                            <th>Amount</th>
                                            <th>Mode</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td colspan="2">
                                                <strong>Total Paid</strong>
                                            </td>
                                            <td>
                                                <strong id="total-vendor-paid"></strong>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="center-border-section my-5">
                            <div class="border-center"></div>
                        </div>

                        <div class="main-content-box px-0 mb-0 pb-0 ">
                            <div class="d-flex justify-content-between align-items-center w-100 custom-px-15">
                                <div class="main-common-title">
                                    <h2>Booking Emails</h2>
                                </div>
                            </div>
                            <div class="custom-px-15 border-top">
                                <div class="main-common-title pt-4">
                                    <div class="fv-row fv-plugins-icon-container">
                                        <select class="form-select" name="email_type">
                                            <option value="">-- Select To Preview --</option>
                                            <option value="pending">Booking Pending</option>
                                            <option value="confirm">Booking Confirmed</option>
                                            <option value="invoice">Payment Receipt</option>
                                            <option value="change">Booking Changed</option>
                                            <option value="cancellation">Cancellation & Refund Processed</option>
                                            <option value="cancelled_by_client">Cancelled By Client</option>
                                            <option value="cancelled_by_vendor">Booking Cancelled By Vendor</option>
                                            <option value="rejected">Booking Rejected</option>
                                            <option value="google_review">Google Review</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="table-section hotel-detail pb-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Subject</th>
                                                <th>Send To</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="main-content-box px-0 mb-0 pb-0 ">
                            <div
                                class="d-flex justify-content-between align-items-center w-100 custom-px-15 border-bottom">
                                <div class="main-common-title">
                                    <h2>Booking Remarks</h2>
                                </div>
                            </div>
                            <div class="main-content-box remark-details">
                                <form action ="{{ route('save.remarks') }}" method="post" class="global-ajax-form">
                                    @csrf
                                    <input type="hidden" name="booking_id" value={{ encode($bookingDetails?->id) }}>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-7">
                                            <div class="form-group">
                                                <input type="text" name="remark" class="form-control form-control-solid" placeholder="Enter Remark">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 mt-xl-0 mt-4">
                                            <div class="form-group">
                                                <select class="form-select form-select-solid" data-control="select2" data-placeholder ="Select Type" name="remark_type">
                                                    <option value="important">Important Update</option>
                                                    <option value="remark">Remark Updates</option>
                                                    <option value="payment">Payment Updates</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 mt-xl-0 mt-4">
                                            <button type="submit" class="btn btn-dark w-100"
                                                title="Update">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="main-content-box px-0 mx-4 mb-0 pb-0 pt-0  border-top mb-5 bg-light-danger">
                                <div
                                    class="d-flex justify-content-between align-items-center w-100 custom-px-15-II bg-danger rounded-1">
                                    <div class="main-common-title">
                                        <h2 class="text-white">Important Update</h2>
                                    </div>
                                </div>
                                <div class="table-section hotel-detail">
                                    @if (!empty($bookingRemarks['important']))
                                        <x-remark-component :remarks="$bookingRemarks['important']" />
                                    @else
                                        <div class="w-100 custom-px-15 border-top bg-light-custom">
                                            <div class="main-common-title pt-4 calamite">
                                                <div class="text-center center-items-text"><i class="fa fa-thumbs-up pe-2"></i>No Important Updates.</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="main-content-box px-0 mx-4 mb-0 pb-0 pt-0  border-top mb-5 bg-light-info">
                                <div
                                    class="d-flex justify-content-between align-items-center w-100 custom-px-15-II bg-info rounded-1">
                                    <div class="main-common-title">
                                        <h2 class="text-white">Remark Updates</h2>
                                    </div>
                                </div>
                                <div class="table-section hotel-detail">
                                    @if (!empty($bookingRemarks['remark']))
                                        <x-remark-component :remarks="$bookingRemarks['remark']" />
                                    @else
                                        <div class="w-100 custom-px-15 border-top bg-light-custom">
                                            <div class="main-common-title pt-4 calamite">
                                                <div class="text-center center-items-text"><i class="fa fa-thumbs-up pe-2"></i>No Remark Updates.</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="main-content-box px-0 mx-4 mb-0 pb-0 pt-0  border-top mb-5 bg-light-success">
                                <div
                                    class="d-flex justify-content-between align-items-center w-100 custom-px-15-II bg-success rounded-1">
                                    <div class="main-common-title">
                                        <h2 class="text-white">Payment Updates</h2>
                                    </div>
                                </div>
                                <div class="table-section hotel-detail">
                                    @if (!empty($bookingRemarks['payment']))
                                        <x-remark-component :remarks="$bookingRemarks['payment']" />
                                    @else
                                        <div class="w-100 custom-px-15 border-top bg-light-custom">
                                            <div class="main-common-title pt-4 calamite">
                                                <div class="text-center center-items-text"><i class="fa fa-thumbs-up pe-2"></i>No Payment Updates.</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>

                        {{-- Followup Start --}}
                        <div class="main-content-box px-0 mb-0 pb-0 ">
                            <div class="d-flex justify-content-between align-items-center w-100 custom-px-15">
                                <div class="main-common-title">
                                    <h2>Follow Ups</h2>
                                </div>
                                <div>
                                    <a href="{{ Route('followup.create', encode($bookingDetails?->id)) }}"
                                        data-bs-toggle="modal" data-bs-target="#global_modal" data-bs-whatever="Add Follow Up">
                                        <div class="edit-icon dark-dark-bg">
                                            <span class="fa fa-add text-white"></span>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="table-section hotel-detail">
                                <table class="table table-bordered mb-0" id="followup-datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Follow Up</th>
                                            <th>Status</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- Followup End --}}
                    </section>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 left-part">

                    @php
                        $capturedTransactions = $transactions->whereIn('status', ['captured', 'authorized']);
                    @endphp
                    <div class="left-section">
                        <div class="payment-details">
                            <div class="title-section">
                                <div class="d-flex justify-content-between w-100">
                                    <div class="main-common-title">
                                        <h2>Fare Summary</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="base-fare-section">
                                <div class="common-section-part">
                                    <div class="title-fare mb-xl-3">
                                        <h2>Base Price</h2>
                                    </div>
                                    <div class="calculation-section">
                                        <div class="d-flex justify-content-between w-100">
                                            <div>
                                                @forelse($roomDetails as $room)
                                                    <div class="d-flex mb-xl-2 mb-2">
                                                        <div class="common-text pe-2">
                                                            {{ $room->quantity }} {{ $room->roomCategory?->name }} ({{$room?->plan_name}})
                                                        </div>
                                                        <div class="common-text pe-2">
                                                            X
                                                        </div>
                                                        <div class="common-text">
                                                            <i
                                                                class="fa fa-inr pe-1"></i><span>{{ $room->total_price / $room->quantity }}</span>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <p>No rooms selected!</p>
                                                @endforelse
                                            </div>
                                            <div class="total-amount">
                                                <i
                                                    class="fa fa-inr pe-1"></i><span>{{ $roomDetails->sum('total_price') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="common-section-part">
                                    <div class="title-fare mb-xl-3">
                                        <h2>Total Markup</h2>
                                    </div>
                                    <div class="calculation-section">
                                        <div class="d-flex justify-content-between w-100">
                                            <div>
                                                <div class="d-flex mb-xl-2 mb-2">
                                                    <div class="common-text pe-2">
                                                        Markup
                                                    </div>
                                                    <div class="common-text pe-2">
                                                        :
                                                    </div>
                                                    <div class="common-text">
                                                        <i
                                                            class="fa fa-inr pe-1"></i><span>{{ $capturedTransactions->sum('markup') }}</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex mb-xl-2 mb-2">
                                                    <div class="common-text pe-2">
                                                        Rzp Fee
                                                    </div>
                                                    <div class="common-text pe-2">
                                                        :
                                                    </div>
                                                    <div class="common-text">
                                                        <i
                                                            class="fa fa-inr pe-1"></i><span>{{ $capturedTransactions->sum('gateway_fee') }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="total-amount">
                                                <i
                                                    class="fa fa-inr pe-1"></i><span>{{ $capturedTransactions->sum('markup') - $capturedTransactions->sum('gateway_fee') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="final-price">
                                <div class="d-flex justify-content-between w-100">
                                    <div class="title">
                                        <h2>Guest Pay</h2>
                                    </div>
                                    <div>
                                        <div class="main-amount">
                                            <h2><i class="fa fa-inr pe-1"></i>{{ $transactions->sum('amount') }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="center-border-section">
                            <div class="border-center"></div>
                        </div>

                        {{-- Status from Hotel Side --}}
                        <div class="vendor-status-section">
                            <div class="main-common-title w-100">
                                <div class="title-section">
                                    <div class="d-flex">
                                        <h2>Hotel Vendor Status</h2>
                                        <div class="ps-3 pt-1">
                                            <span class="material-symbols-outlined booking-status-icon {{$bookingDetails->vendorStatus?->status ? 'text-success' : 'text-black'}}">{{$bookingDetails->vendorStatus?->status ? 'check_circle' : 'schedule'}}</span>    
                                        </div>
                                    </div>
                                </div>
                                <div class="mail-section px-5">
                                    <div class="row mb-5">
                                        <p class="mb-3">Contact Person : <strong>{{ $bookingDetails->hotel?->name ?? '' }}</strong></p>
                                        <p class="mb-3">Email : <strong>{{ $bookingDetails->hotel?->email ?? '' }} {{ $bookingDetails->hotel?->owner_email ? ', '.$bookingDetails->hotel?->owner_email : '' }}</strong></p>
                                        <p class="mb-3">Mobile : <strong>{{ $bookingDetails->hotel?->phone ?? '' }} {{ $bookingDetails->hotel?->owner_contact_no ? ', '.$bookingDetails->hotel?->owner_contact_no : '' }}</strong></p>
                                    </div>
                                    <div class="vendor-status-button-container">

                                        @if( $bookingDetails->vendorStatus?->status )
                                        <h3 class="booking-status-text text-info"><strong>Booking Confirmed At Hotel</strong></h3>
                                        @elseif( $bookingDetails->vendorStatus?->is_mailed )
                                        <p class="booking-status-text text-danger"><strong>Booking Pending At Hotel</strong></p>
                                        <div class="btn-section">
                                            <a href="javascript:void(0);" class="btn btn-primary d-block btn-hover confirm-hotel-booking" title="click to Confirm">
                                                Confirm Booking
                                            </a>
                                        </div>
                                        @else
                                            <div class="btn-section send-mail-div">
                                                <a href="javascript:void(0);" class="btn btn-primary d-block btn-hover mail-to-hotel" title="click to send mail">Send Email for Confirmation</a>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Status from Hotel Side --}}

                        <div class="center-border-section">
                            <div class="border-center"></div>
                        </div>

                        <div class="update-booking-section">
                            <div class="main-common-title mb-xl-5 mb-4">
                                <h2>Update Booking</h2>
                            </div>
                            <div class="btn-section">
                                <a href="{{ route('change.booking.date', $bookingDetails?->booking_id) }}"
                                    class="btn btn-primary d-block btn-hover" data-bs-toggle="modal"
                                    data-bs-target="#global_modal" data-bs-whatever="Change Booking date">Change
                                    Booking date</a>
                            </div>
                            <div class="btn-section">
                                <a href="{{ route('change.booking.status', $bookingDetails?->booking_id) }}"
                                    data-bs-toggle="modal" data-bs-target="#global_modal"
                                    class="btn btn-1 d-block btn-hover"
                                    data-bs-whatever="Change Booking Status">Change Booking Status</a>
                            </div>
                        </div>
                        <div class="center-border-section">
                            <div class="border-center"></div>
                        </div>
                        <div class="update-booking-section">
                            <div class="main-common-title mb-xl-5 mb-4">
                                <h2>Update Hotel</h2>
                            </div>
                            <div class="btn-section">
                                <a href="{{ route('leads.change.hotel.rooms', [$bookingDetails?->booking_id, $bookingDetails?->hotel_id]) }}"
                                    data-load="true" class="btn btn-1  d-block btn-hover change-room"
                                    data-target="#global_modal" data-bs-whatever="Change Room"
                                    data-modal-dialog = "modal-xl">Change Room</a>
                            </div>
                            <div class="btn-section">
                                <a href="{{ route('leads.change.hotel', $bookingDetails?->booking_id) }}"
                                    class="btn btn-1 d-block btn-hover change-hotel" data-bs-toggle="modal"
                                    data-bs-whatever="Change Hotel" data-bs-target="#global_modal"
                                    data-bs-modal-dialog = 'modal-xl'>Change Hotel</a>
                            </div>
                        </div>
                        <div class="center-border-section">
                            <div class="border-center"></div>
                        </div>
                        <div class="update-booking-section">
                            <div class="btn-section"> 
                                <a href="{{ route('leads.recommend.hotel', $bookingDetails?->booking_id) }}"
                                    class="btn btn-1 d-block btn-hover recommend-hotel" data-bs-toggle="modal"
                                    data-bs-target="#global_modal" data-bs-whatever="Recommend Hotel"
                                    data-modal-dialog="modal-lg">
                                    Recommend Hotels
                                </a>
                            </div>
                        </div>
                        <div class="center-border-section">
                            <div class="border-center"></div>
                        </div>
                        <div class="update-booking-section">
                            <div class="btn-section">
                                <a href="{{ Route('download.tax.invoice', encode($bookingDetails?->id)) }}" class="btn btn-info d-block btn-hover">
                                    Download Tax Invoice
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
        <script>
            var transactionDatatable, vendorTransactionDatatable, guestDatatable, followUpDatatable;
            const openNewWindow = (emailType) => {
                if (emailType) {
                    let _route =
                        "{{ route('email.preview', ['bookingId' => encode($bookingDetails->id), 'option' => ':option']) }}?new-window=true";
                    _route = _route.replace(':option', emailType);

                    fetch(_route).then(response => {
                            if (!response.ok) {
                                throw new Error("Failed to load the view from the controller");
                            }
                            return response.text();
                        })
                        .then(htmlContent => {
                            const newWindow = window.open(_route, "_blank",
                                "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=500,width=850,height=830");
                            if (newWindow) {
                                newWindow.focus();
                                var windowCheckInterval = setInterval(function() {
                                    if (newWindow.closed) {
                                        clearInterval(windowCheckInterval);
                                        $('select[name=email_type]').val('');
                                        if( emailType === 'vendor-mail' ){
                                            const bookingId = $('input[name=booking_id]').val();
                                            const route = "{{ route('lead.vendor.mail', ':id') }}".replace(':id', bookingId);
                                            setTimeout(function() {
                                                $.get(route, function (response) {
                                                    if( response.status === 200 ){
                                                        $('.vendor-status-button-container').html(response.html);
                                                    }
                                                });
                                            }, 500);
                                        }
                                    }
                                }, 100);
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            alert("Failed to open the view. Please check the console for details.");
                        });
                }
            }

            $(document).ready(function () {
                // Helper function to initialize DataTables
                function initializeDataTable(selector, ajaxUrl, columns, drawCallback = null) {
                    return $(selector).DataTable({
                        aaSorting: [],
                        responsive: false,
                        searchDelay: 500,
                        processing: true,
                        serverSide: true,
                        searching: false,
                        paging: false,
                        ajax: ajaxUrl,
                        columns: columns,
                        language: {
                            lengthMenu: "", // Removes "Show X entries"
                            info: "", // Removes "Showing X to Y of Z entries"
                            infoEmpty: "", // Removes "Showing 0 to 0 of 0 entries"
                            infoFiltered: "", // Removes "filtered from X total entries"
                        },
                        pagingType: "simple",
                        drawCallback: drawCallback,
                    });
                }

                // Helper function for SweetAlert confirmation dialogs
                function confirmAction(title, text, confirmButtonText, route, successCallback) {
                    Swal.fire({
                        title: title,
                        text: text,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: confirmButtonText,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.get(route, function (response) {
                                if (response.status === 200) {
                                    successCallback(response);
                                } else {
                                    globalToast({
                                        message: response.message,
                                        icon: 'error',
                                    });
                                }
                            });
                        }
                    });
                }

                // Guest DataTable Initialization
                guestDatatable = initializeDataTable(
                    '#guest-table',
                    "{{ route('lead.guest.datatable', $bookingDetails?->booking_id) }}",
                    [
                        { data: 'action', name: 'action' },
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'gender', name: 'gender' },
                        { data: 'dob', name: 'dob' },
                    ]
                );

                // Transaction DataTable Initialization
                transactionDatatable = initializeDataTable(
                    '#transaction-table',
                    "{{ route('lead.transactions.datatable', $bookingDetails?->booking_id) }}",
                    [
                        { data: 'action', name: 'action' },
                        { data: 'payment_id', name: 'payment_id' },
                        { data: 'payment_date', name: 'payment_date' },
                        { data: 'amount', name: 'amount' },
                        { data: 'status', name: 'status' },
                        { data: 'medium', name: 'medium' },
                    ],
                    function (settings) {
                        const api = this.api();

                        function calculateTotal(columnIndex) {
                            return api.column(columnIndex, { page: 'current' }).data().reduce((total, value, index) => {
                                const status = $(api.cell(index, 4).data()).text();
                                return (status === 'Captured' || status === 'captured') ? total + (parseFloat(value.replace('₹', '')) || 0) : total;
                            }, 0);
                        }

                        $('#total-amount').html('₹'+calculateTotal(3).toFixed(2));
                        let route = "{{Route('lead.transactions.markup', ':id')}}".replace(':id', $('input[name=booking_id]').val());
                        $.get(route, function (response) {
                            if (response.status === 200) {
                                $('strong.expected-markup').text('₹'+response.expected_markup);
                                $('strong.coupon_discount').text('₹'+response.coupon_discount);
                                $('strong.current-markup').text('₹'+response.current_markup);
                            }
                        })
                    }
                );

                vendorTransactionDatatable = initializeDataTable(
                    '#vendor-transaction-table',
                    "{{ route('lead.vendor.transactions.datatable', encode($bookingDetails?->id)) }}",
                    [
                        { data: 'action', name: 'action' },
                        { data: 'payment_id', name: 'payment_id' },
                        { data: 'payment_date', name: 'payment_date' },
                        { data: 'amount', name: 'amount' },
                        { data: 'payment_method', name: 'payment_method' },
                    ],
                    function (settings) {
                        const api = this.api();
                        function calculateTotal(columnIndex) {
                            return api.column(columnIndex, { page: 'current' }).data().reduce((total, value, index) => {
                                return total + (parseFloat(value.replace('₹', '')) || 0);
                            }, 0);
                        }
                        $('#total-vendor-paid').html('₹'+calculateTotal(3).toFixed(2));
                    }
                );

                followUpDatatable = initializeDataTable(
                    '#followup-datatable',
                    "{{ route('followup.index', encode($bookingDetails?->id)) }}",
                    [
                        { data: 'action', name: 'action' },
                        { data: 'follow_up', name: 'follow_up' },
                        { data: 'status', name: 'status' },
                        { data: 'remarks', name: 'remarks', className: 'text-wrap' },
                    ]
                )

                // Reload DataTable on Form Submission
                function reloadDataTable(formSelector, datatable) {
                    $("body").on("submit", formSelector, function (e) {
                        e.preventDefault();
                        setTimeout(() => datatable.ajax.reload(), 1000);
                    });
                }

                reloadDataTable(".guest-form", guestDatatable);
                reloadDataTable(".transaction-form", transactionDatatable);
                reloadDataTable(".vendor-transaction-form", vendorTransactionDatatable);
                reloadDataTable(".follow-up-form", followUpDatatable);

                $('body').on('click', '#transaction-table .delete-item', function (e) {
                    e.preventDefault();
                    setTimeout(() => transactionDatatable.ajax.reload(), 1000);
                });
                

                $('body').on('change', 'select[name=email_type]', function () {
                    const emailType = $(this).val();
                    openNewWindow(emailType);
                });
                $('body').on('click', 'a.mail-to-hotel', function (e) {
                    openNewWindow('vendor-mail');
                });

                // Confirm Hotel Booking
                $('body').on('click', 'a.confirm-hotel-booking', function (e) {
                    e.preventDefault();
                    const bookingId = $('input[name=booking_id]').val();
                    const route = "{{ route('lead.vendor.status', ':id') }}".replace(':id', bookingId);

                    confirmAction(
                        'Are you sure?',
                        'Do you want to confirm the booking at the vendor?',
                        'Yes, confirm it!',
                        route,
                        (response) => {
                            if( response.status === 200 ){
                                $('.booking-status-icon').removeClass('text-warning').addClass('text-success').text('check_circle');
                                if( response.html ){
                                    $('.vendor-status-button-container').html(response.html);
                                }
                                globalToast({ message: response.message, icon: 'success' });
                            }else{
                                globalToast({ message: response.message, icon: 'error' });
                            }
                        }
                    );
                });

                // Capture authorized Payment
                $('body').on('click', 'a.capture-payment', function (e) {
                    e.preventDefault();
                    const _route = $(this).attr('href');
                    confirmAction(
                        'Are you sure?',
                        'Do you want to capture the payment?',
                        'Yes, capture it!',
                        _route,
                        (response) => {
                            if( response.status === 200 ){
                                transactionDatatable.ajax.reload();
                                globalToast({ message: response.message, icon: 'success' });
                            }else{
                                globalToast({ message: response.message, icon: 'error' });
                            }
                        }
                    );
                });
            });
        </script>
    @endpush

</x-app-layout>
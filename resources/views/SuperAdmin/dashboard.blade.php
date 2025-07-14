<x-app-layout>
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->

                <div class="row row-cols-1 row-cols-sm-2 justify-content-between align-items-center w-100 g-0">
                    <div class="col">
                        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                            <!--begin::Title-->
                            <h1
                                class="page-heading d-flex flex-column justify-content-center text-color fw-bold fs-3 m-0">
                                {{ $title }}</h1>
                            <!--end::Title-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ route('superAdmin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted"> {{ $title }}</li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Breadcrumb-->
                        </div>
                    </div>

                    <div class="col d-flex justify-content-start justify-content-md-end gap-4 mt-4 mt-md-0">
                        <div class="row row-cols-1 row-cols-sm-3 row-cols-md-3 w-100 gx-0 gx-sm-4">
                            <div class="col ">
                                <input type="text" class="form-control form-control-lg form-control-solid filterDate" name="from_date" placeholder="From Date" />
                            </div>
                            <div class="col mt-4 mt-sm-0">
                                <input type="text" class="form-control form-control-lg form-control-solid filterDate" name="to_date" placeholder="To Date" />
                            </div>
                            <div class="col mt-4 mt-sm-0 pe-sm-0">
                                <button type="button" class="btn btn-primary w-100 filter-btn">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar wrapper-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!--begin::Content container-->
            <div class="row gx-5 gx-xl-10 mb-xl-10">
                <!--begin::Col-->
                <div class="col-md-12">
                    <div class="row">

                        @php
                            $analyticsHtml = array(
                                array(
                                    'title' => 'Hotel Searches',
                                    'icon'  => 'fa-search',
                                    'id'    => 'searchCount'
                                ),
                                array(
                                    'title' => 'Details Filled',
                                    'icon'  => 'fa-user',
                                    'id'    => 'detailFilled',
                                ),
                                array(
                                    'title' => 'Payment Completed',
                                    'icon'  => 'fa-inr',
                                    'id'    => 'paymentCompleted',
                                ),
                                array(
                                    'title' => 'Booking Completed',
                                    'icon'  => 'fa-hotel',
                                    'id'    => 'bookingCompleted',
                                ),
                                array(
                                    'title' => 'Refunds',
                                    'icon'  => 'fa-rupee-sign',
                                    'id'    => 'bookingRefunded',
                                )
                            ); 
                        @endphp

                        @foreach ($analyticsHtml as $html)
                            <div class="col">
                                <div class="card card-flush mb-5 mb-xl-6">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="card-title d-flex flex-column">
                                            <div class="d-flex align-items-center">
                                                <span class="fs-2x fw-bold text-color me-2 lh-1 ls-n2 analytic-spinner" id="{{$html['id']}}">
                                                    0
                                                </span>
                                            </div>
                                            <span class="text-color-secondary pt-1 fw-semibold fs-6 mt-2 text-nowrap">
                                                <i class="fa {{$html['icon']}} pe-3"></i>{{$html['title']}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="row superadmin-container mt-4 ">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                            <div>
                                <h1>Booking Time Report</h1>
                            </div>
                            <div>
                                <div class="mt-5 table-height">
                                    <table class="table table-bordered" id="bookingTimeReport">
                                        <thead>
                                            <tr class="fw-bold fs-6 text-gray-800">
                                                <th>#</th>
                                                <th>Time Slot</th>
                                                <th>Booked</th>
                                                <th>Pending</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="4" class="text-center analytic-spinner">Loading...</td>
                                            </tr>
                                        </tbody>
                                        <tfoot class="table-dark ">
                                            <tr>
                                                <td colspan="2">Total</td>
                                                <td id="totalBooked">0</td>
                                                <td id="totalPending">0</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 follow-up">
                            <div class="d-flex flex-wrap justify-content-between w-100 align-items-center">
                                <div>
                                    <h1 class="mb-0">Follow Up</h1>
                                </div>

                                <div class="d-flex align-items-center gap-2">
                                    <a href="javascript:void(0);" title="Prev Day" class="btn btn-primary rounded-1 followup-load" data-type="prev">Prev Day</a>
                                    <a href="javascript:void(0);" title="Next Day" class="btn btn-primary rounded-1 followup-load" data-type="next">Next Day</a>
                                </div>

                                <div class="d-flex align-items-center gap-2">
                                    <div>
                                        <select class="form-select form-select-sm" name="followup_status">
                                            <option value=" ">--All Status--</option>
                                            <option value="Open">Open</option>
                                            <option value="Close">Close</option>
                                        </select>
                                    </div>
                                    <div class="ms-2">
                                        <select class="form-select form-select-sm" name="user_id" data-control="select2"
                                            data-placeholder="Select an option">
                                            <option value=" ">--All Members--</option>
                                            @forelse ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @empty
                                                <option value="">No User Found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div>
                                <div class="mt-3 table-height">
                                    <input type="hidden" name="followup_date" value="{{ date('Y-m-d') }}" />
                                    <center class="fs-6 py-2">Date : <span class="selected-date followup-date">{{ formatDateMdY(date('Y-m-d')) }}</span></center>
                                    <table class="table table-bordered" id="followup-table">
                                        <thead>
                                            <tr class="fw-bold fs-6 text-gray-800">
                                                <th>At Time</th>
                                                <th>Booking ID</th>
                                                <th>Client</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row superadmin-container mt-15">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 follow-up">
                            <div class="d-flex flex-wrap justify-content-between w-100 align-items-center">
                                <div>
                                    <h1>Feedback</h1>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="javascript:void(0);" title="Prev Day" class="btn btn-primary rounded-1 feedback-load" data-type="prev">Prev Day</a>
                                    <a href="javascript:void(0);" title="Next Day" class="btn btn-primary rounded-1 feedback-load" data-type="next">Next Day</a>
                                </div>
                                <div class="d-flex">
                                    <div>
                                        <select class="form-select" name="feedback_status">
                                            <option value="all">All</option>
                                            <option value="checkin">Check-In</option>
                                            <option value="checkout">Check-Out</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="table-responsive mt-3 ">
                                    <input type="hidden" name="feedback_date" value="{{ date('Y-m-d') }}" />
                                    <center class="fs-6 py-2">Date : <span class="selected-date feedback-date">{{ formatDateMdY(date('Y-m-d')) }}</span></center>
                                    <table class="table table-bordered" id="feedback-table">
                                        <thead>
                                            <tr class="fw-bold fs-6 text-gray-800">
                                                <th>Contact</th>
                                                <th>hotel</th>
                                                <th>Booking Ref.</th>
                                                <th>Guest</th>
                                                <th>City</th>
                                                <th>Check-In</th>
                                                <th>Check-Out</th>
                                                <th>Employee</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
    const spinner = `
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>`;

    const getSelectedDate = () => {
        const fromDate = $('input[name=from_date]').val();
        const toDate = $('input[name=to_date]').val();
        return `${fromDate}to${toDate}`;
    };

    const initializeDataTable = (selector, ajaxUrl, columns, filters = {}, drawCallback = null) => {
        return $(selector).DataTable({
            aaSorting: [],
            responsive: false,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            searching: false,
            paging: false,
            ajax: {
                url: ajaxUrl,
                type: 'POST',
                data: d => ({ ...d, ...filters }),
            },
            columns,
            language: {
                lengthMenu: "",
                info: "",
                infoEmpty: "",
                infoFiltered: "",
            },
            pagingType: "simple",
            drawCallback,
        });
    };

    const updateAnalytics = ({ status, searchCount, detailFilled, paymentCompleted, bookingCompleted, bookingRefunded, bookingTimeReport }) => {
        if (status === 200) {
            $('#searchCount').html(searchCount);
            $('#detailFilled').html(detailFilled);
            $('#paymentCompleted').html(paymentCompleted);
            $('#bookingCompleted').html(bookingCompleted);
            $('#bookingRefunded').html(bookingRefunded);

            let bookingTimeReportHtml = '', totalBooked = 0, totalPending = 0;

            bookingTimeReport.forEach(({ time_slot, booked, pending }, index) => {
                totalBooked += parseInt(booked);
                totalPending += parseInt(pending);

                bookingTimeReportHtml += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${time_slot}</td>
                        <td><span class="badge bg-success text-white">${booked}</span></td>
                        <td><span class="badge bg-danger text-white">${pending}</span></td>
                    </tr>`;
            });

            $('#bookingTimeReport tbody').html(bookingTimeReportHtml);
            $('#totalBooked').html(totalBooked);
            $('#totalPending').html(totalPending);
        } else {
            $('.analytic-spinner').html('N/A');
        }
    };

    const fetchAnalytics = () => {
        $('.analytic-spinner').html(spinner);
        $('#bookingTimeReport tbody').html(`<tr><td colspan="4" class="text-center">${spinner}</td></tr>`);

        $.post(`{{Route('dashboard.section', 'analytics')}}`, { date: getSelectedDate() }, updateAnalytics);
    };

    const fetchFeedback = (filterData) => {
        feedbackDatatable = initializeDataTable(
            '#feedback-table',
            `{{Route('dashboard.section', 'feedback')}}`,
            [
                { data: 'contact', name: 'contact' },
                { data: 'hotel', name: 'hotel' },
                { data: 'booking_ref', name: 'booking_ref' },
                { data: 'guest', name: 'guest' },
                { data: 'city', name: 'city' },
                { data: 'checkin', name: 'checkin' },
                { data: 'checkout', name: 'checkout' },
                { data: 'employee', name: 'employee' },
                { data: 'action', name: 'action' },
            ],
            filterData,
            () => $('[data-bs-toggle="tooltip"]').tooltip()
        );
    };

    const fetchFollowup = (filterData) => {
        followupDatatable = initializeDataTable(
            '#followup-table',
            `{{Route('dashboard.section', 'followup')}}`,
            [
                { data: 'at_time', name: 'at_time' },
                { data: 'booking_ref', name: 'booking_ref' },
                { data: 'contact', name: 'contact' },
                { data: 'remark', name: 'remark', className: 'text-wrap' },
            ],
            filterData
        );
    };

    const modifyDate = (date, type) => {
        const modifiedDate = new Date(date);
        modifiedDate.setDate(modifiedDate.getDate() + (type === 'prev' ? -1 : 1));

        return {
            normalize: () => modifiedDate.toISOString().split('T')[0],
            formatted: () => modifiedDate.toLocaleDateString('en-US', {
                month: 'short',
                day: '2-digit',
                year: 'numeric',
            }),
        };
    };

    const reloadDatatables = (datatable, filters) => {
        datatable.settings()[0].ajax.data = d => ({ ...d, ...filters });
        datatable.ajax.reload();
    };

    $(document).ready(() => {
        fetchAnalytics();
        fetchFeedback({ date: getSelectedDate() });
        fetchFollowup({ date: getSelectedDate() });

        $('body').on('click', 'button.filter-btn', function() {
            $(this).append(btnSpinner);

            fetchAnalytics();
            const filters = {
                date: getSelectedDate(),
                feedback_status: $('select[name=feedback_status]').val(),
                followup_status: $('select[name=followup_status]').val(),
                user_id: $('select[name=user_id]').val(),
            };

            $('.selected-date').html(`${$('input[name=from_date]').val()} to ${$('input[name=to_date]').val()}`);

            reloadDatatables(followupDatatable, { date: filters.date, followup_status: filters.followup_status, user_id: filters.user_id });
            reloadDatatables(feedbackDatatable, { date: filters.date, feedback_status: filters.feedback_status });

            setTimeout(() => {
                $(this).find('.spinner-border').remove();
            }, 1000);
        });

        $('body').on('click', '.feedback-load, .followup-load', function () {
            const type = $(this).data('type');
            const isFeedback = $(this).hasClass('feedback-load');
            const inputDateSelector = isFeedback ? 'input[name=feedback_date]' : 'input[name=followup_date]';
            const statusSelector = isFeedback ? 'select[name=feedback_status]' : 'select[name=followup_status]';
            const userSelector = isFeedback ? null : 'select[name=user_id]';

            const filters = {
                type,
                [isFeedback ? 'feedback_date' : 'followup_date']: $(inputDateSelector).val(),
                status: $(statusSelector).val(),
                user_id: userSelector ? $(userSelector).val() : undefined,
            };

            const datatable = isFeedback ? feedbackDatatable : followupDatatable;

            reloadDatatables(datatable, filters);

            const dateKey = isFeedback ? 'feedback_date' : 'followup_date';
            const modifiedDate = modifyDate(filters[dateKey], type);
            $(inputDateSelector).val(modifiedDate.normalize());
            $(`.selected-date.${isFeedback ? 'feedback-date' : 'followup-date'}`).html(modifiedDate.formatted());
        });

        $('body').on('change', 'select[name=feedback_status], select[name=followup_status], select[name=user_id]', function () {
            const isFeedback = $(this).attr('name') === 'feedback_status';
            const statusSelector = isFeedback ? 'select[name=feedback_status]' : 'select[name=followup_status]';
            const filters = {
                date: getSelectedDate(),
                [isFeedback ? 'feedback_status' : 'followup_status']: $(statusSelector).val(),
                user_id: $('select[name=user_id]').val(),
            };

            const datatable = isFeedback ? feedbackDatatable : followupDatatable;
            reloadDatatables(datatable, filters);
        });

        $('body').on('submit', 'form.feedback-form', function () {
            reloadDatatables(feedbackDatatable, { date: getSelectedDate(), feedback_status: $('select[name=feedback_status]').val() });
            setTimeout(() => feedbackDatatable.ajax.reload(null, false), 1000);
        });
    });
</script>

    @endpush

</x-app-layout>
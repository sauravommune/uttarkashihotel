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
                    {{-- <h6 class="text-muted">Manage all your Company here!</h6> --}}
                    <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('superAdmin.dashboard') }}"
                                class="text-color-secondary text-hover-primary">Dashboard</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('reservations.index') }}"
                                class="text-color-secondary text-hover-primary">Reservation Page</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-color-secondary"> {{ $id }}</li>
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
            <div class="row">
                <div class="col-md-9 col-12 pe-10">
                    <div class="d-flex justify-content-between align-items-center border-bottom-custom-line pb-4">
                        <span class="fs-8 text-color-secondary text-uppercase fw-semibold">Booking ID: <span
                                class="fs-7 text-color fw-bold">{{ $id }}</span></span>
                        <div class="d-flex align-items-center gap-4">
                            <span class="badge badge-light-success rounded-pill p-3 px-4">Partially-Paid</span>
                            <span class="badge badge-light-success rounded-pill p-3 px-4">Booked</span>
                        </div>
                    </div>
                    <div class="pt-4">
                        <h3 class="fs-3 text-color">Booking Detail</h3>
                        <div class="row border-bottom-custom-line pb-6">
                            <div class="col-md-3 col-12">
                                <div class="d-flex flex-column gap-24 mt-4 border-right-custom">
                                    <div class="d-flex flex-column gap-1">
                                        <span class="fs-8 text-color-secondary text-uppercase fw-semibold">Check
                                            In</span>
                                        <span class="fs-7 text-color text-uppercase fw-semibold">Aug 12, 2024</span>
                                        <span class="fs-8 text-color-secondary text-uppercase fw-semibold">From:
                                            12:00</span>
                                    </div>
                                    <div class="d-flex flex-column gap-1">
                                        <span class="fs-8 text-color-secondary text-uppercase fw-semibold">Check
                                            Out</span>
                                        <span class="fs-7 text-color text-uppercase fw-semibold">Aug 18, 2024</span>
                                        <span class="fs-8 text-color-secondary text-uppercase fw-semibold">From:
                                            12:00</span>
                                    </div>
                                    <div class="d-flex flex-column gap-1">
                                        <span class="fs-8 text-color-secondary text-uppercase fw-semibold">Length of
                                            Stay</span>
                                        <span class="fs-7 text-color text-uppercase fw-semibold">6 Nights</span>
                                    </div>
                                    <div class="d-flex flex-column gap-1">
                                        <span class="fs-8 text-color-secondary text-uppercase fw-semibold">Total
                                            Guests</span>
                                        <span class="fs-7 text-color fw-semibold">2 Adults, 1
                                            Child</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 col-12">
                                <div class="d-flex flex-column gap-24 mt-4">
                                    <div>
                                        <span class="fs-8 text-color-secondary text-uppercase fw-semibold">Guests</span>
                                        <div class="row mt-2">
                                            <div class="col-md-4 col-12">
                                                <span class="d-flex align-items-center fs-6 text-color">Mr. Amit Ojha
                                                    <span class="box-20 bg-coin text-white ms-3">M</span>
                                                </span>
                                            </div>
                                            <div class="col-md-8 col-12">
                                                <span class="fs-6 text-color">amitojha@gmail.com
                                                </span>
                                            </div>
                                            <div class="col-md-4 col-12 mt-2">
                                                <span class="fs-6 text-color">Mrs. Akansha Ojha
                                                </span>
                                            </div>
                                            <div class="col-md-8 col-12 mt-2">
                                                <span class="fs-6 text-color"> -
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <span class="fs-8 text-color-secondary text-uppercase fw-semibold">Room
                                            Type</span>
                                        <div class="row mt-2">
                                            <div class="col-md-4 col-12">
                                                <span class="d-flex align-items-center fs-6 text-color">1 x
                                                    <span class="fs-5 fw-bold ms-1">AC Standard Room</span>
                                                </span>
                                            </div>
                                            <div class="col-md-8 col-12">
                                                <span class="fs-6 text-success"><span class="fw-bold">Breakfast Included
                                                    </span> (CP) | <span class="fw-bold">Free Cancellation</span> before
                                                    11 August 2024 <span
                                                        class="material-symbols-outlined  text-color-secondary fs-4">
                                                        help
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="col-md-4 col-12 mt-2">
                                                <span class="d-flex align-items-center fs-6 text-color">1 x
                                                    <span class="fs-5 fw-bold ms-1">AC Deluxe Room</span>
                                                </span>
                                            </div>
                                            <div class="col-md-8 col-12 mt-2">
                                                <span class="fs-6 text-success"><span class="fw-bold">Breakfast Included
                                                    </span> (CP) | <span class="fw-bold">Free Cancellation</span> before
                                                    11 August 2024 <span
                                                        class="material-symbols-outlined  text-color-secondary fs-4">
                                                        help
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="row mt-2">
                                            <div class="col-md-4 col-12">
                                                <span class="fs-8 text-color-secondary text-uppercase fw-semibold">
                                                    Booking Date & Time
                                                </span>
                                            </div>
                                            <div class="col-md-8 col-12">
                                                <span
                                                    class="fs-8 text-color-secondary text-uppercase fw-semibold">Traveling
                                                    for Work?
                                                </span>
                                            </div>
                                            <div class="col-md-4 col-12 mt-2">
                                                <span class="fs-7 text-color">
                                                    Jul 28, 2024 10:32AM
                                                </span>
                                            </div>
                                            <div class="col-md-8 col-12 mt-2">
                                                <span class="fs-7 text-color">
                                                    No
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="pt-8 d-flex flex-column gap-6">
                            <h5 class="left-line">Special Requests</h5>
                            <div class="btn btn-light d-flex justify-content-center gap-2 align-items-center">
                                <span class="material-symbols-outlined fs-3">
                                    concierge
                                </span>
                                No special request from guest.
                            </div>
                            <h5 class="left-line">Payment Detail</h5>
                            <div class="table-responsive">
                                {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12"></div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="d-flex flex-column gap-24">
                        <span class="fs-7 text-color fw-bolder">Price Summary</span>

                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex flex-column gap-1">
                                    <span class="text-color fs-7 fw-bold">Original Price</span>
                                    <span class="text-color-secondary fs-8">₹ 4,950 x 6 Nights</span>
                                </div>
                                <span class="fs-7 text-color">₹ 29,700</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex flex-column gap-1">
                                    <span class="text-color fs-7 fw-bold">Hotel Discount</span>
                                    <span class="text-color-secondary fs-8">Basic Deal discount applied on this
                                        booking</span>
                                </div>
                                <span class="fs-7 text-color">-₹ 600</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex flex-column gap-1">
                                    <span class="text-color fs-7 fw-bold">Campaign Discount!</span>
                                    <span class="text-color-secondary fs-8">Coupon - HolidayFire10</span>
                                </div>
                                <!--begin::Dialer-->
                                <span class="fs-7 text-color">-₹ 2,970</span>
                                <!--end::Dialer-->
                            </div>
                        </div>

                        <div class="form-group bg-total-reservation p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex flex-column gap-1">
                                    <span class="text-color fs-7 fw-bolder">Total Amount</span>
                                </div>
                                <!--begin::Dialer-->
                                <span class="fs-7 text-color">₹ <span class="fs-1 fw-bolder">26,130</span></span>
                                <!--end::Dialer-->
                            </div>
                        </div>

                        <span class="fs-7 text-color fw-bolder">Update Reservation</span>

                        <div class="d-flex flex-column gap-4">
                            <div class="col-md-12">
                                <!-- <button type="submit" class="btn btn-primary w-100 text-center">
                                    Confirm Booking
                                </button> -->
                                <button type="button" class="btn btn-primary w-100 text-center" data-bs-toggle="modal"
                                    data-bs-target="#Confirm_booking_modal">
                                    Confirm Booking
                                </button>

                                <div class="modal fade" tabindex="-1" id="Confirm_booking_modal">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Update Reservation</h3>
                                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                                            class="path2"></span></i>
                                                </div>
                                            </div>

                                            <div class="modal-body">
                                                <p class="text-color fs-6">Please select the status for this booking:
                                                </p>

                                                <div class="d-flex flex-column gap-2">
                                                    <label for="" class="text-color-secondary">Check In - Check
                                                        Out</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        id="#kt_datepicker_7" placeholder="Please select Date" />
                                                </div>

                                                <div class="d-flex flex-column gap-2 mt-3">
                                                    <label for="" class="text-color-secondary">Price</label>
                                                    <input type="number" class="form-control form-control-solid"
                                                        value=" 29,700" placeholder="Please Enter Price" />
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary w-100"
                                                    id="confirmBookingButton">Update Changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12">
                                <!-- <button type="button" class="btn btn-light w-100 text-center">
                                    Change booking status
                                </button> -->

                                <button type="button" class="btn btn-light w-100 text-center" data-bs-toggle="modal"
                                    data-bs-target="#Change_booking_status">
                                    Change booking status
                                </button>


                                <div class="modal fade" tabindex="-1" id="Change_booking_status">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Update Booking</h3>

                                                <!--begin::Close-->
                                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                                            class="path2"></span></i>
                                                </div>
                                                <!--end::Close-->
                                            </div>

                                            <div class="modal-body">
                                                <p class="text-color fs-6">Please select the status for this booking:
                                                    Once you change this status</p>

                                                <div class="mt-5">

                                                    <select id="paymentStatusSelect" name="payment_status"
                                                        class="form-select form-select-solid" data-control="select2"
                                                        data-dropdown-parent="#Change_booking_status"
                                                        data-placeholder="Select an Update Booking Status"
                                                        data-allow-clear="true">
                                                        <option value="1">Pending</option>
                                                        <option value="2">Completed</option>
                                                        <option value="3">Failed</option>
                                                        <option value="4">Refunded</option>
                                                        <option value="5">Cancelled</option>
                                                        <option value="6">In Process</option>
                                                        <option value="7">On Hold</option>
                                                        <option value="8">Disputed</option>
                                                        <option value="9">Chargeback</option>
                                                        <option value="10">Successful</option>
                                                    </select>


                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <!-- <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button> -->
                                                <button type="button" class="btn btn-primary w-100">Update Booking
                                                    Status</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="button" class="btn btn-danger-light w-100 text-center"
                                    id="cancelBookingBtn">
                                    Cancel Booking
                                </button>


                            </div>

                            <div class="col-md-12">
                                <button type="button" class="btn btn-light w-100 text-center">
                                    Print Invoice
                                </button>
                            </div>

                            <div class="col-md-12">

                                <!-- <button href="{{ route('reservations.update_payment_status') }}" data-bs-toggle="modal"
                                    data-bs-target="#global_modal" data-bs-whatever="
                                    Update payment status" type="button" class="btn btn-light w-100 text-center">
                                    Update payment status
                                </button> -->
                                <button type="button" class="btn btn-light w-100 text-center" data-bs-toggle="modal"
                                    data-bs-target="#update_payment_status">
                                    Update payment status
                                </button>


                                <div class="modal fade" tabindex="-1" id="update_payment_status">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Update payment status</h3>

                                                <!--begin::Close-->
                                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                                            class="path2"></span></i>
                                                </div>
                                                <!--end::Close-->
                                            </div>

                                            <div class="modal-body">
                                                <p class="text-color fs-6">Are you sure you want to change payment
                                                    status? Once updated, it will
                                                    take 5 minutes before further changes can be made.</p>

                                                <div class="mt-5">
                                                    <label for="updateStatusSelect" class="form-label mb-4">Payment
                                                        status</label>
                                                    <select id="updateStatusSelect" name="payment_status"
                                                        class="form-select form-select-solid" data-control="select2"
                                                        data-dropdown-parent="#update_payment_status"
                                                        data-placeholder="Select a Payment Status"
                                                        data-allow-clear="true">
                                                        <option></option>
                                                        <option value="1">Pending</option>
                                                        <option value="2">Completed</option>
                                                        <option value="3">Failed</option>
                                                        <option value="4">Refunded</option>
                                                        <option value="5">Cancelled</option>
                                                        <option value="6">In Process</option>
                                                        <option value="7">On Hold</option>
                                                        <option value="8">Disputed</option>
                                                        <option value="9">Chargeback</option>
                                                        <option value="10">Successful</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <!-- <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button> -->
                                                <button type="button" class="btn btn-primary w-100">Save
                                                    changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        <!-- SweetAlert2 -->
        <script>
        document.getElementById('cancelBookingBtn').addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            var url = '{{ route('reservations.cancel', ': id ') }}';
            url = url.replace(':id', id);

            Swal.fire({
                title: 'Cancel Reservation',
                text: "Are you sure you want to cancel this reservation? This action cannot be undone, and you may lose this booking.",
                icon: 'warning',
                showCancelButton: false, // Remove the cancel button
                confirmButtonColor: '#FFBEBE', // Background color for the button
                confirmButtonText: '<span style="color: #940B0B">Yes, cancel the reservation</span>', // Custom text and color
                customClass: {
                    confirmButton: 'custom-confirm-button' // Optional custom class for further styling if needed
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            Swal.fire(
                                'Cancelled!',
                                'The booking has been cancelled.',
                                'success'
                            ).then(() => {
                                location.reload(); // Reload the page
                            });
                        })
                        .catch(error => {
                            Swal.fire(
                                'Error!',
                                'There was a problem cancelling the booking.',
                                'error'
                            );
                        });
                }
            });
        });


        $(document).on('click', '#updatePaymentStatusBtn', function() {
            let paymentId = $(this).data('id'); // Get the payment ID
            let url = "{{ route('reservations.update_payment_status', ['id' => 'ID_PLACEHOLDER']) }}".replace(
                'ID_PLACEHOLDER', paymentId);

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    type: 'some_value' // Include other necessary data
                },
                success: function(response) {
                    if (response.success === 200) {
                        // Handle success (e.g., update the view with the returned HTML)
                        $('#someContainer').html(response.html);
                        alert(response.message); // Display success message
                    }
                },
                error: function(xhr) {
                    // Handle errors
                    alert('Error: ' + xhr.responseJSON.message);
                }
            });
        });

        $("#kt_datepicker_7").flatpickr({
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            mode: "range"
        });
        </script>


        @endpush
</x-app-layout>

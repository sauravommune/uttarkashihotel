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


                    <div class="table-responsive mt-4">
                        {{ $dataTable->table() }}
                    </div>

                    <hr>

                    <div class="row justify-content-between">
                        <div class="col-md-3 col-6">
                            <h3 class="text-color fw-bold">Campaigns</h3>
                        </div>
                    </div>

                    <div class="table-responsive mt-6">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="'promotion-column d-flex align-items-center">
                                            <img src="{{ asset('/assets/media/offer.svg') }}" alt='Deal Icon'
                                                class='promotion-icon me-2'>
                                            <div class='promotion-info'>
                                                <span class='promotion-title'>Season Deal</span>
                                                <span class='promotion-discount'>10% Discount</span>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column gap-2">
                                            <span class="text-muted fw-semibold fs-7">Booking Dates</span>
                                            <span class="fw-bold mb-2 text-gray-900">1 August 2024 - 20 August
                                                2024</span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column gap-2">
                                            <span class="text-muted fw-semibold fs-7">Stay Dates</span>
                                            <span class="fw-bold mb-2 text-gray-900">1 August 2024 - 20 August
                                                2024</span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column gap-2">
                                            <span class="text-muted fw-semibold fs-7">Seen by</span>
                                            <span class="fw-bold mb-2 text-gray-900">Members</span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column gap-2">
                                            <span class="text-muted fw-semibold fs-7">Applies on</span>
                                            <span class="fw-bold mb-2 text-gray-900">All Rooms</span>
                                        </div>
                                    </td>

                                    <td>
                                        <a class="btn btn-light fs-4 d-flex align-items-center justify-content-center gap-2 p-2 px-4 w-125px"
                                            href="{{ route('promotion.basic_deal') }}" data-bs-toggle="modal"
                                            data-bs-target="#global_modal" data-bs-whatever="Create Basic Deail">
                                            <span class="material-symbols-outlined">
                                                add
                                            </span>
                                            Activate
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr>

                    <div class="row justify-content-between">
                        <div class="col-md-3 col-6">
                            <h3 class="text-color fw-bold">Hotel Deals</h3>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-row-dashed table-row-gray-300 gy-7 no-hover">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="'promotion-column d-flex align-items-center">
                                                <img src="{{ asset('/assets/media/offer.svg') }}" alt='Deal Icon'
                                                    class='promotion-icon me-2'>
                                                <div class='promotion-info'>
                                                    <span class='promotion-title'>Basic Deal</span>
                                                    <span class='promotion-discount'>Recommended discount of 10-20%
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="text-color-secondary fs-7">Any Dates</span></td>
                                        <td><span class="text-color-secondary fs-7">Customize your deal according to
                                                your need</span></td>
                                        <td>
                                            <a
                                                class="btn btn-light fs-4 d-flex align-items-center justify-content-center gap-2 p-2 px-4 w-125px">
                                                <span class="material-symbols-outlined fs-3">
                                                    add
                                                </span>
                                                Activate
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="'promotion-column d-flex align-items-center">
                                                <img src="{{ asset('/assets/media/offer.svg') }}" alt='Deal Icon'
                                                    class='promotion-icon me-2'>
                                                <div class='promotion-info'>
                                                    <span class='promotion-title'>Basic Deal</span>
                                                    <span class='promotion-discount'>Recommended discount of 10-20%
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="text-color-secondary fs-7">Any Dates</span></td>
                                        <td><span class="text-color-secondary fs-7">Customize your deal according to
                                                your need</span></td>
                                        <td>
                                            <a
                                                class="btn btn-light fs-4 d-flex align-items-center justify-content-center gap-2 p-2 px-4 w-125px">
                                                <span class="material-symbols-outlined fs-3">
                                                    add
                                                </span>
                                                Activate
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        <script>
            function deletePromotion(promotionId) {
                $.ajax({
                    url: '/promotion/delete/' + promotionId, // Update with your actual URL and promotion ID
                    method: 'DELETE', // Or POST depending on your setup
                    success: function(response) {
                        if (response.status === 200) {
                            // Show success message and then redirect
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success'
                            }).then(function() {
                                // Redirect to the URL from the response
                                window.location.href = response.redirect;
                            });
                        } else {
                            // Handle other statuses or errors
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error'
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An unexpected error occurred.',
                            icon: 'error'
                        });
                    }
                });
            }
        </script>
    @endpush

</x-app-layout>

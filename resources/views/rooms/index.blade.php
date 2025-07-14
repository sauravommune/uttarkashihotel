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
                        {{ ucwords($title) }}
                    </h1>
                    <!--end::Title-->
                    {{-- <h6 class="text-muted">Manage all your Company here!</h6> --}}
                    <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('superAdmin.dashboard') }}" class="text-color-secondary text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('hotel') }}" class="text-color-secondary text-hover-primary">Hotels</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-color-secondary"> {{ ucwords($title)}}</li>
                        <!--end::Item-->
                    </ul>
                </div>
                <!--end::Page title-->

                <!--begin::Actions-->
                @can('Rooms-Add')
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('rooms.add', encode($hotel?->id)) }}" class="btn btn-sm btn-flex btn-primary h-40px fs-7 fw-bold">
                        <i class="ki-duotone ki-plus"> </i>Add New Room
                    </a>
                </div>
                @endcan
                <!--end::Actions-->

            </div>
        </div>
    </div>


    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row">

                @forelse($rooms as $room)

                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-12 mt-6 room-container">
                        <div class="card shadow-custom-sm overflow-hidden card-outer-hover">
                            <div class="rounded-8-8-0-0 card-header pb-2 p-0 border-0">
                                <div class="tns room-imgs w-100 mh-75 min-vh-50" style="direction: ltr">
                                    <div data-tns="true" data-tns-nav-position="bottom" data-tns-mouse-drag="true"
                                        data-tns-controls="false">
                                        <!--begin::Item-->
                                        <div class="text-center">
                                            <img   src="{{ $room->images->count() > 0 ? asset('storage/'.$room->images[0]->image) : asset('assets/media/no-hotel-img.svg') }}" class="shadow w-100 fix-height" alt="" />
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-5 mt-0 pt-6">
                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2">

                                    <div class="d-flex flex-column">
                                        <h6>{{ ucwords($room->roomType->name??'')}}</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input change-room-status" type="checkbox" role="switch" data-id="{{$room->id}}" data-url="{{route('rooms.updateStatus')}}" data-status="" @checked($room->status) />
                                            </div>
                                            {{-- <div class="form-check form-switch">
                                                <input class="form-check-input change-room-sold_out" type="checkbox" role="switch" data-id="{{$room->id}}" data-url="{{route('rooms.updateSoldout')}}" data-status="" @checked($room->sold_out) />
                                            </div> --}}
                                        </div>
                                    </div>
                                    

                                    <button class="btn box-32 btn-clean btn-icon bg-light" data-kt-menu-trigger="click"
                                        data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                        <span class="material-symbols-outlined text-color-secondary fs-2">
                                            more_vert
                                        </span>
                                    </button>
                                    <!--begin::Menu 2-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                        data-kt-menu="true">
                                        <div class="menu-item p-3">
                                            @can('Rooms-Edit')
                                            <a href="{{ Route('rooms.add', [encode($hotel?->id), encode($room->id)]) }}"
                                                class="menu-content text-color-secondary d-flex gap-2 align-items-center fw-bold rounded hover-bg-light px-3 py-4">
                                                <span class="material-symbols-outlined text-color fs-3">
                                                    edit
                                                </span>
                                                Edit Room
                                            </a>
                                            @endcan
                                            @can('Promotions-Add')
                                            <a href="{{ route('ratePlan.create', encode($room->id)) }}" class="menu-content text-color-secondary d-flex gap-2 align-items-center fw-bold rounded hover-bg-light px-3 py-4">
                                                <span class="material-symbols-outlined text-color fs-3">
                                                    park
                                                </span>
                                                Rate Plan
                                            </a>
                                            @endcan
                                            @can('Rooms-Delete')
                                            <a href="{{ route('delete.room', encode($room->id)) }}" class="menu-content text-color-secondary d-flex gap-2 align-items-center fw-bold rounded hover-bg-light px-3 py-4 delete-rooms">
                                                <span class="material-symbols-outlined text-color fs-3">
                                                    delete
                                                </span>
                                                Delete Room
                                            </a>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                                {{-- <h5 class="mt-3">{{ucwords($room?->roomType?->name??'')}}</h5> --}}

                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mt-2">Today's Rates :  </h6>
                                    @can('Promotions-Edit')
                                        <a href="{{ Route('rooms.availability.create', ['roomId'=>encode($room?->id), 'ratePlanId'=>encode($room?->ratePlan[0]?->id??'')]) }}" class="text-info" data-bs-toggle="modal" data-bs-target="#global_modal" data-bs-whatever="Update Rate Plan & Room Availability">
                                            <span class="material-symbols-outlined text-color fs-3">edit</span>
                                        </a>
                                    @endcan
                                </div>
                                <div class="d-flex flex-column gap-3 mt-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>EP Rates</div>
                                    <div>₹{{ $room?->ratePlan[0]?->total_amount_ep??'N/A' }}</div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>CP Rates</div>
                                    <div>₹{{ $room?->ratePlan[0]?->total_amount_cp??'N/A' }}</div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>MAP Rates</div>
                                    <div>₹{{ $room?->ratePlan[0]?->total_amount_map??'N/A' }}</div>
                                </div>
                                <hr/>
                                
                                <h6>Today's Availability : </h6>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>Total Rooms</div>
                                    <div>{{ $room?->total_room??0 }}</div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>Available</div>
                                    <div>{{ $room?->ratePlan[0]?->availability??0 }}</div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                @empty
                @endforelse

            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            $("body").on("click", "input.change-room-status", function () {
                let _this = $(this);
                var id = $(this).data("id");
                var url = $(this).data("url");
                console.log('url', url);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: { id },
                    success: function (data) {
                        Swal.fire({
                            icon: "success",
                            position: "top-right",
                            text: data.message,
                            toast: true,
                            timer: 1500,
                            timerProgressBar: true,
                            showConfirmButton: false,
                        });
                        if( _this.hasClass("success-badge") ) {
                            _this.removeClass("success-badge").addClass('danger-badge').text("Inactive");
                        }else{
                            _this.removeClass("danger-badge").addClass('success-badge').text("Active");
                        }
                    },
                    error: function (error) {
                        Swal.fire({
                            icon: "error",
                            position: "top-right",
                            text: error.message,
                            toast: true,
                            timer: 1500,
                            timerProgressBar: true,
                            showConfirmButton: false,
                        });
                    },
                });
            });
            
            $("body").on("click", "input.change-room-sold_out", function () {
                let _this = $(this);
                var id = $(this).data("id");
                var url = $(this).data("url");
                console.log('url', url);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: { id },
                    success: function (data) {
                        Swal.fire({
                            icon: "success",
                            position: "top-right",
                            text: data.message,
                            toast: true,
                            timer: 1500,
                            timerProgressBar: true,
                            showConfirmButton: false,
                        });
                        if( _this.hasClass("success-badge") ) {
                            _this.removeClass("success-badge").addClass('danger-badge').text("Inactive");
                        }else{
                            _this.removeClass("danger-badge").addClass('success-badge').text("Active");
                        }
                    },
                    error: function (error) {
                        Swal.fire({
                            icon: "error",
                            position: "top-right",
                            text: error.message,
                            toast: true,
                            timer: 1500,
                            timerProgressBar: true,
                            showConfirmButton: false,
                        });
                    },
                });
            });

            $("body").on("click", ".delete-rooms", function (e) {
                e.preventDefault();
                let _this = $(this);
                var url = _this.attr("href");

                Swal.fire({
                    title: "Are you sure?",
                    text: "Want to delete this?",
                    icon: "warning",
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Yes, delete it!",
                    customClass: {
                        confirmButton: "btn-danger",
                    },
                    preConfirm: function () {
                        return $.ajax({
                            url: url,
                            type: "DELETE",
                        })
                        .done(function (data) {
                            _this.parents('.room-container').remove();
                            Swal.fire({
                                text: data.message,
                                icon: "success",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                            });
                        })
                        .catch(function (error) {
                            Swal.fire({
                                text: error.responseJSON.message,
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                            });
                        });
                    },
                }).then(function (result) {
                });
            });
        });
    </script>
    @endpush
</x-app-layout>

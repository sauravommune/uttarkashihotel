<x-app-layout>
    @push('styles')
        <style>
            .fc-event {
                cursor: pointer;
            }
        </style>
    @endpush
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
                            <a href="{{ route('superAdmin.dashboard') }}"
                                class="text-color-secondary text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-color-secondary"> {{ ucwords($title) }}</li>
                        <!--end::Item-->
                    </ul>
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                {{-- <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('ratePlan.create') }}"
                        class="btn btn-sm btn-flex btn-primary h-40px fs-7 fw-bold">
                        <span class="material-symbols-outlined fs-1">
                            add
                        </span>
                        <p class="mb-0 d-none d-sm-block">
                            Add {{ $title }}
                        </p>
                    </a>
                </div> --}}
                <!--end::Actions-->
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card border-0">
                <div class="card-body p-0">
                    <div class="row mb-10">
                        <div class="col-12">
                            <small class="text-danger filter-error"></small>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-5 col-xxl-3 mt-4 mt-md-0">
                            <select class="form-select form-select-sm" data-control="select2"
                                data-placeholder="Select Hotel" name="hotel_id">
                                <option value="">Select Hotel</option>
                                @forelse ($hotels as $hotel)
                                    <option value="{{ $hotel->id }}" @selected($hotel->id == ($ratePlanSearch['hotel_id'] ?? ''))>
                                        {{ ucwords($hotel->name) }}</option>
                                @empty
                                    <option value="">No Hotel Found</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-5 col-xxl-3 mt-4 mt-md-0">
                            <select class="form-select form-select-sm" data-control="select2"
                                data-placeholder="Select Hotel First" name="roomType">
                                @forelse ($roomTypes as $roomType)
                                    <option value="{{ $roomType->id }}" @selected($roomType->id == ($ratePlanSearch['roomType'] ?? ''))>
                                        {{ ucwords($roomType->roomType->name) }}</option>
                                @empty
                                    <option value="">Select Hotel First</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-2 col-xxl-1 mt-4 mt-md-0">
                            <button type="button"
                                class="w-100 d-flex align-items-center justify-content-center btn btn-sm btn-flex btn-primary fw-bold text-nowrap"
                                id="get-plan">
                                Get Plan
                            </button>
                        </div>

                        <div class="col-sm-12 col-md-2 col-xxl-5 mt-4 mt-md-0 text-end">
                            <div class="text-end appendBtn">
                            </div>
                        </div>

                    </div>
                    <div id="rate-plan-calendar"></div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            var selectedEventDate = null;
            const getEditableForm = (planId = '') => {
                let dataUrl = `{{ route('ratePlan.edit', ['ratePlan' => ':ratePlan']) }}`;
                dataUrl = dataUrl.replace(':ratePlan', planId);
                let modal = $('#global_modal');
                modal.find(".modal-title").text(`Rate Plan for: ${selectedEventDate}`);
                var selectedHotel = $('select[name=hotel_id]').val();
                var selectedRoom = $('select[name=roomType]').val();

                $.post(dataUrl, {
                    selectedEventDate,
                    selectedHotel,
                    selectedRoom
                }, function(response) {
                    if (response.success == 200) {
                        modal.find(".modal-body").html(response.html);
                        modal.modal("show");
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: "Please Contact to Admin",
                            icon: "error",
                        });
                    }
                });
            }

            $(document).ready(function() {

                $('select[name=hotel_id]').on('change', function() {
                    $.ajax({
                        type: "post",
                        url: "{{ route('get.room.type') }}",
                        data: {
                            id: $(this).val()
                        },
                        success: function(response) {
                            $('select[name=roomType]').empty().html(response.data)
                        }
                    });
                })

                var calendarElem = document.getElementById('rate-plan-calendar');

                // Initialize FullCalendar
                var calendar = new FullCalendar.Calendar(calendarElem, {
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
                    initialView: 'dayGridMonth',
                    eventOrder: 'extendedProps.sortOrder',
                    dateClick: function(info) {
                        let selectedHotel = $('select[name=hotel_id]').val();
                        let selectedRoom = $('select[name=roomType]').val();
                        let priceDate = info.dateStr;
                        selectedEventDate = priceDate;
                        if (selectedHotel && selectedRoom)
                            getEditableForm();
                    },
                    eventContent: function(info) {

                        const event = info.event;
                        const props = event.extendedProps;

                        const wrapper = document.createElement('div');
                        wrapper.classList.add('fc-event-custom', 'ps-3',
                        'fc-dot-wrapper'); // Custom wrapper

                        // Optional styling
                        wrapper.style.borderRadius = '4px';
                        wrapper.style.color = 'black';
                        wrapper.style.fontWeight = '500';
                        wrapper.style.fontSize = '12px';
                        wrapper.style.display = 'flex';
                        wrapper.style.alignItems = 'center';
                        wrapper.style.gap = '5px';

                        // 🔵 Dot span
                        const dot = document.createElement('span');
                        dot.classList.add('fc-dot');
                        wrapper.appendChild(dot);

                        // Event title
                        if (event.title) {
                            const titleDiv = document.createElement('div');
                            titleDiv.textContent = event.title;
                            wrapper.appendChild(titleDiv);
                        }

                        // Optional button
                        if (props.extra_bed_btn) {
                            const btnWrapper = document.createElement('div');
                            btnWrapper.innerHTML = props.extra_bed_btn;
                            wrapper.appendChild(btnWrapper);
                        }

                        return {
                            domNodes: [wrapper]
                        };
                    },
                    eventClick: function(info) {
                        let selectedHotel = $('select[name=hotel_id]').val();
                        let selectedRoom = $('select[name=roomType]').val();
                        let planId = info.event?.extendedProps?.id;
                        console.log(info?.event?.start, new Date(info?.event?.start), 'ss')
                        let priceDate = new Date(info?.event?.start);
                        selectedEventDate =
                            `${priceDate.getFullYear()}-${priceDate.getMonth()+1}-${priceDate.getDate()}`;
                        if (selectedHotel && selectedRoom)
                            getEditableForm(planId);
                    },
                    datesSet: function(info, successCallback, failureCallback) {
                        console.log(info);
                        var selectedHotel = $('select[name=hotel_id]').val();
                        var selectedRoom = $('select[name=roomType]').val();

                        fetchEvents(info.startStr, info.endStr, {
                            roomType: selectedRoom,
                            hotel_id: selectedHotel
                        }, successCallback, failureCallback);
                    }
                });

                // Render the calendar
                calendar.render();
                var initialLoad = 0;
                // Function to fetch events with filters
                function fetchEvents(start, end, filters, successCallback, failureCallback) {

                    if (!filters?.hotel_id || !filters?.roomType) {
                        return [];
                    }
                    $.ajax({
                        url: `{{ route('ratePlan.calendar.events') }}`,
                        method: 'POST',
                        data: {
                            start: start,
                            end: end,
                            ...filters
                        },
                        success: function(response) {
                            if (response.hotelId && response.roomType) {
                                $('.appendBtn').empty();

                                let baseUrl = "{{ route('extra.bed', [':hotelId', ':roomType']) }}"
                                    .replace(':hotelId', response.hotelId).replace(':roomType', response.roomType);
                                      var btn = `<a href="${baseUrl}" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-1"
                                          data-bs-toggle="modal"
                                         data-bs-target="#global_modal"
                                         data-bs-whatever="Add Extra Bed"
                                         title="Add Extra Bed">
                                         <span class="material-symbols-outlined fs-5">add</span>
                                         Add Extra Bed Price
                                    </a>
                                `;
                                $('.appendBtn').append(btn);
                            }

                            if (successCallback) {
                                successCallback(response.events);
                            } else {
                                calendar.getEventSources().forEach(function(eventSource) {
                                    eventSource.remove();
                                });
                                if (initialLoad !== 0) {
                                    if (response.events.length == 0) {
                                        Swal.fire({
                                            title: "Error!",
                                            text: "Rate Plan Not Found!",
                                            icon: "error",
                                        });
                                    }
                                    $('#get-plan').find('.spinner-border').remove();
                                } else {
                                    initialLoad++;
                                }
                                calendar.addEventSource(response.events);
                                calendar.refetchEvents();
                            }
                        },
                        error: function() {
                            if (failureCallback) {
                                failureCallback();
                            }
                        }
                    });
                }

                // Handle event reinitialization on filter change
                $('body').on('click', '#get-plan', function() {
                    var selectedHotel = $('select[name=hotel_id]').val();
                    var selectedRoom = $('select[name=roomType]').val();

                    $('#get-plan').append(btnSpinner);

                    if (!selectedHotel || !selectedRoom) {
                        $('small.filter-error').text('Please select Hotel & Room Type.');
                        return;
                    } else {
                        $('small.filter-error').text('');
                    }
                    fetchEvents(
                        calendar.view.activeStart.toISOString(),
                        calendar.view.activeEnd.toISOString(), {
                            roomType: selectedRoom,
                            hotel_id: selectedHotel
                        }
                    );
                });

                $('body').on('submit', '.ratePlan-form', function(e) {
                    e.preventDefault();
                    let _form = $(this);
                    let date = _form.find('input[name=pricing_date]').val();
                    calendar.getEvents().filter(function(event) {
                        return event.start.toLocaleDateString() == new Date(date).toLocaleDateString();
                    }).forEach(function(event) {
                        event.remove();
                    });

                    let EP = parseFloat(_form.find('input[name=b2b_rate_ep]').val()) + parseFloat(_form.find(
                        'input[name=markup_ep]').val() ?? 0);
                    let CP = parseFloat(_form.find('input[name=b2b_rate_cp]').val()) + parseFloat(_form.find(
                        'input[name=markup_cp]').val());
                    let MAP = parseFloat(_form.find('input[name=b2b_rate_map]').val()) + parseFloat(_form.find(
                        'input[name=markup_map]').val() ?? 0);
                    let availability = parseFloat(_form.find('input[name=availability]').val() ?? 0);
                    var rates = {
                        'EP': EP,
                        'CP': CP,
                        'MAP': MAP
                    };
                    for (var type in rates) {
                        var rate = rates[type];
                        calendar.addEvent({
                            title: `${type}: ₹ ${rate.toFixed(2)}`,
                            start: date,
                            end: null,
                            display: 'list-item',
                            extendedProps: {
                                id: '',
                                ...rates
                            }
                        });
                    }
                });
            });
        </script>
    @endpush

</x-app-layout>

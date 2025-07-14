<x-app-layout>
    <div id="kt_app_toolbar_container" class="app-container container-fluid py-5">
        <div class="page-heading d-flex justify-content-start align-items-center mb-4">
            <h2 class="h2-font">{{ $row->id ? 'Edit' : 'Create' }} Coupon</h2>
        </div>

        <div class="page-content">
            <section class="border-top-custom">
                <form action="{{ $row->id ? route('coupons.update', encode($row->id)) : route('coupons.store') }}" class="global-ajax-form" method="POST">

                    @if ($row->id)
                        @method('PUT')
                    @endif
                    @csrf
                    <div class="row gx-0 mt-2">
                        <div class="col-md-8 col-12 p-2 ps-0">
                            <div class="card mb-0 mt-4 border-custom rounded-10 overflow-hidden shadow pb-4 p-3">
                                <div class="card-header p-1 table-header-bg">
                                    <span class="fs-7 text-color fw-bold ps-2">Enter the following details to {{ $row->id ? 'edit' : 'create' }} coupon</span>
                                </div>
                                <div class="card-body p-0">

                                    <!-- Coupon Code -->
                                    <div class="row gx-0 mt-3">
                                        <div class="col-md-6 col-12 px-3">
                                            <div class="form-group">
                                                <label class="fs-6 text-muted">Coupon Code *</label>
                                                <input type="text" value="{{ old('code', $row->code) }}" required name="code"
                                                    id="coupon_code" class="form-control rounded table-header-bg mt-2"
                                                    placeholder="Enter coupon code">
                                                @error('code') <p class="text-danger">{{ $message }}</p> @enderror
                                                <p class="text-danger duplicate-coupon"></p>
                                            </div>
                                        </div>

                                        <!-- Coupon Type -->
                                        <div class="col-md-6 col-12 px-3">
                                            <div class="form-group">
                                                <label for="ticket_type" class="fs-6 text-muted">Coupon Type</label>
                                                <select class="form-select mt-2" name="ticket_type" id="ticket_type">
                                                    <option value="Ticket Discount" @selected($row->ticket_type == 'Ticket Discount')>Ticket Discount</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Title -->
                                    <div class="row gx-0 mt-3">
                                        <div class="col-md-12 col-12 px-3">
                                            <div class="form-group">
                                                <label class="fs-6 text-muted" for="title">Title</label>
                                                <input type="text" value="{{ old('title', $row->title) }}" name="title" placeholder="Enter title" class="form-control rounded table-header-bg mt-2" id="title">
                                                @error('title') <p class="text-danger">{{ $message }}</p> @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="row gx-0 mt-3">
                                        <div class="col-md-12 col-12 px-3">
                                            <div class="form-group">
                                                <label class="fs-6 text-muted" for="description">Description</label>
                                                    <textarea class="form-control table-header-bg" name="description" id="description" 
                                                            placeholder="Leave a comment here">{{ old('description', $row->description) }}</textarea>
                                                @error('description') <p class="text-danger">{{ $message }}</p> @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Offer Type and Amount -->
                                    <div class="row gx-0 mt-3">
                                        <div class="col-md-6 col-12 px-3">
                                            <div class="form-group">
                                                <label for="offer_type" class="fs-6 text-muted">Offer Type</label>
                                                <select class="form-select mt-2" name="type" id="offer_type">
                                                    <option value="percent" @selected($row->type == 'percent')>% OFF</option>
                                                    <option value="amount" @selected($row->type == 'amount')>Fixed Amount</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 px-3">
                                            <div class="form-group">
                                                <label class="fs-6 text-muted">Offer Amount</label>
                                                <input type="number" name="value" class="form-control rounded table-header-bg mt-2"
                                                    value="{{ old('value', $row->value) }}">
                                                @error('value') <p class="text-danger">{{ $message }}</p> @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Start Date & Time -->
                                    <div class="row gx-0 mt-3">
                                        <div class="col-md-6 col-12 px-3">
                                            <div class="form-group">
                                                <label for="coupon_date" class="fs-6 text-muted">Start Date & Time</label>
                                                <input type="text" class="form-control mb-3 date-time-picker mt-2"
                                                    name="date" placeholder="Select date range" id="coupon_Date"
                                                    value="{{ old('date', \Carbon\Carbon::parse($row->start_date)->format('d M Y') . ' to ' . \Carbon\Carbon::parse($row->expiration_date)->format('d M Y')) }}">
                                                @error('date') <p class="text-danger">{{ $message }}</p> @enderror
                                            </div>
                                        </div>

                                        <!-- Discount Applied On -->
                                        <div class="col-md-6 col-12 px-3">
                                            <div class="form-group">
                                                <label for="discount_applied_on" class="fs-6 text-muted">Discount Applied On</label>
                                                <select class="form-select mt-2" name="discount_applied_on" id="discount_applied_on">
                                                    <option value="overall" @selected($row->discount_applied_on == 'overall')>Overall</option>
                                                    <option value="per_passenger" @selected($row->discount_applied_on == 'per_passenger')>Per Passenger</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Usage Limit -->
                                    <div class="row gx-0 mt-3">
                                        <div class="col-md-12 col-12 px-3">
                                            <div class="form-group">
                                                <label for="usage_limit" class="fs-6 text-muted">Usage Limit (0 for unlimited)</label>
                                                <input type="number" name="usage_limit" class="form-control mb-3 mt-2" 
                                                    value="{{ old('usage_limit', $row->usage_limit) }}" placeholder="Enter usage limit" required>
                                                @error('usage_limit') <p class="text-danger">{{ $message }}</p> @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status, Auto Apply, and Public Visibility -->
                                    <div class="row gx-0 mt-3">
                                        <div class="col-md-2 col-12 px-3">
                                            <div class="form-group">
                                                <label for="status" class="fs-6 text-muted">Status</label>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="status" value="active" {{ old('status', $row->is_active) ? 'checked' : '' }} />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12 px-3">
                                            <div class="form-group">
                                                <label for="auto_apply" class="fs-6 text-muted">Auto Apply</label>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="auto_apply" value="active" {{ old('auto_apply', $row->auto_apply) ? 'checked' : '' }} />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12 px-3">
                                            <div class="form-group">
                                                <label for="is_visible" class="fs-6 text-muted">Visible to Public</label>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="is_visible" value="active" {{ old('is_visible', $row->is_visible) ? 'checked' : '' }} />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="card mb-0 mt-4 border-custom rounded-10 overflow-hidden shadow pb-4">
                                <div class="m-1 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary border-0 text-white fw-medium fs-7 hover-shadow next-step w-fc p-2 px-3 me-2 rounded-4">
                                        {{ $row->id ? 'Update' : 'Create' }} Coupon
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 p-2 pe-0">
                            <div class="card mb-0 mt-4 border-custom rounded-10 overflow-hidden shadow p-3">
                                <div class="card-header p-1 table-header-bg">
                                    <span class="fs-7 text-color fw-bold ps-2">Active Coupons</span>
                                </div>
                                <div class="card-body p-0">
                                    @forelse ($active_coupons as $active_coupon)
                                        <div class="row gx-0 border-top py-4 px-3">
                                            <h6 class="fs-7 mb-0 fw-semibold">Coupon:
                                                <strong class="text-primary">{{ $active_coupon->code }}</strong> |
                                                {{ $active_coupon->description }}</h6>
                                        </div>
                                    @empty
                                        <h6 class="text-center p-5">Active coupon not found!</h6>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
   
    @push('scripts')
        <script>
            $(document).ready(function() {

                $('body').on('click', '.cloning-btn', function() {
                    var html = $(this).closest('.clone-this').clone();
                    if ($('.clone-this').length == 6) {
                        return;
                    }

                    // Replace the clone button with a close button
                    html.find('.repeating-btn').html(function(index, html) {
                        return '<span class="delete-btn"><span class="material-symbols-outlined"> close </span></span>';
                    });
                    html.find('label').eq(1).text('Value');
                    html.find('label').eq(1).next('div').remove();
                    html.find('label').eq(1).next('input').remove();
                    html.find('label').eq(1).next('select').remove();
                    html.find('label').eq(1).after('<input type="text" class="form-control mt-2">');


                    $('.append-form-here').append(html);
                    $('.basic-flatpickr').flatpickr({
                        dateFormat: "d M Y",
                    });
                });

                // Delete form
                $('body').on('click', '.delete-btn', function() {
                    $(this).closest('.clone-this').remove();
                });


                $('.global-ajax-form').validate({

                })

                $('#coupon_Date').flatpickr({
                    dateFormat: "d M Y",
                    mode: 'range'
                });

                var delayTimer;
                @if (empty($row->id))
                    $('body').on('input', '#coupon_code', function() {
                        var code = $(this).val();
                        clearTimeout(delayTimer);
                        delayTimer = setTimeout(function() {
                            $.ajax({
                                url: "{{ route('coupons.check') }}",
                                method: "POST",
                                data: {
                                    code: code
                                },
                                success: function(data) {
                                    $('.duplicate-coupon').text(data);
                                },
                            });
                        }, 1000);
                    });
                @endif

                if ($('#termsAndConditions').is(':checked')) {
                    $('.visibleOrNot').removeClass('d-none');
                }

                $('body').on('change', '#termsAndConditions', function() {
                    if ($('#termsAndConditions').is(':checked')) {
                        $('.visibleOrNot').removeClass('d-none');
                    } else {
                        $('.visibleOrNot').addClass('d-none');
                    }
                });

                let choices = document.querySelectorAll(".choices")
                let initChoice
                for (let i = 0; i < choices.length; i++) {
                    if (choices[i].classList.contains("multiple-remove")) {
                        initChoice = new Choices(choices[i], {
                            delimiter: ",",
                            editItems: true,
                            maxItemCount: -1,
                            removeItemButton: true,
                        })
                    } else {
                        initChoice = new Choices(choices[i])
                    }
                }

                $('body').on('change', '.eligibility_type', function() {
                    var _this = $(this);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('coupons.get_options') }}",
                        data: {
                            type: _this.val()
                        },
                        success: function(response) {
                            _this.closest('.clone-this').find('.append-value-html').html(response);
                            const elm = _this.closest('.clone-this').find('.choices').get();
                            elm.forEach(function(selectElement) {
                                new Choices(selectElement);
                            });
                        }
                    });
                })
            });
        </script>
    @endpush
</x-app-layout>
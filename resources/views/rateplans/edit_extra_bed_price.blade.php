<form class="global-ajax-form ratePlan-form" action="{{ route('extraBedPrice.update') }}" method="post"
    data-modal-form="#global_modal">

    <input type ="hidden" name="hotel_id" value="{{ $hotelId }}">
    <input type ="hidden" name="room_type" value="{{ $roomType }}">

    <h3> Rate Plans : </h3>
    <div class="row my-5">
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-6 mt-xl-0">
            <div class="fv-row fv-plugins-icon-container">
                <label class="form-label">From Date</label>
                <input class="form-control form-control-solid modal-date-picker" placeholder="Pick a date"
                    id="solid-date-one" name="start_date" />
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-6 mt-xl-0">
            <div class="fv-row fv-plugins-icon-container">
                <label class="form-label">To Date</label>
                <input class="form-control form-control-solid modal-date-picker" placeholder="Pick a date"
                    id="solid-date-second" name="end_date" />
            </div>
        </div>
        {{-- <div class="col-12 col-sm-6 col-md-6 col-lg-6 mt-4 mt-xl-4">
            <div class="fv-row fv-plugins-icon-container">
                <label class="form-label">Days</label>
                <select class="form-select form-select-solid select-2" data-control="select2" data-placeholder="Select Days"
                    name="days[]" multiple>
                    <option value="0">Sunday</option>
                    <option value="1">Monday</option>
                    <option value="2">Tuesday</option>
                    <option value="3">Wednesday</option>
                    <option value="4">Thursday</option>
                    <option value="5">Friday</option>
                    <option value="6">Saturday</option>
                </select>
            </div>
        </div> --}}
        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mt-4 mt-xl-4 ">
            <div class="form-check">
                <input class="form-check-input extra_config" type="checkbox" name="is_extra_person_allowed"
                    id="is_extra_person_allowed">
                <label class="form-check-label" for="is_extra_person_allowed">
                    Extra Person Allowed
                </label>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mt-4 mt-xl-4 ">

            <div class="form-check">
                <input class="form-check-input extra_config" type="checkbox" name="child_with_bed" id="child_with_bed">
                <label class="form-check-label" for="child_with_bed">
                    Child With Bed
                </label>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mt-4 mt-xl-4 ">
            <div class="form-check">
                <input class="form-check-input extra_config" type="checkbox" name="child_with_no_bed"
                    id="child_with_no_bed">
                <label class="form-check-label" for="child_with_no_bed">
                    Child With No Bed
                </label>
            </div>
        </div>
    </div>

    <div class="row pb-5" id="extra_bed_config">
        <div class="col-sm-3"></div>
        <div class="col-md-4 no_of_extra_person hidden-div">
            <input type="number" class="form-control text-color-secondary" name="no_of_extra_person"
                placeholder="No of Allowed Persons" value="" />
        </div>
        <div class="col-md-4 child_with_bed hidden-div">
            <input type="number" class="form-control text-color-secondary" name="min_child_age"
                placeholder="Minimum Child Age" value="" />
        </div>
    </div>


    <!-- EP Rates -->
    <div class="row mb-5 py-1 align-items-center" id="ep_rates">
        <div class="col-sm-3">
            <div class="d-flex flex-column">
                <span class="text-color fs-7 fw-bold">EP Rates & Markup</span>
                <span class="text-color-secondary fw-semibold fs-8">Room only, with no
                    meals.</span>
            </div>
        </div>
        <div class="col-sm-4 mt-4 mt-sm-0">
        </div>
        <div class="col-sm-4 mt-4 mt-sm-0">
        </div>

        <div class="col-sm-3 no_of_extra_person hidden-div">
            <span class="text-color text-sm">Extra Person Rates & Markup</span>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 no_of_extra_person hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="extra_person_price[ep]" placeholder="Extra Person Rate" value="">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 no_of_extra_person hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="extra_person_markup[ep]" placeholder="Extra Person Markup" value="" />
            </div>
        </div>

        <div class="col-sm-3 child_with_bed hidden-div">
            <span class="text-color text-sm">Child with Bed Rates & Markup</span>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_bed_price[ep]" placeholder="Child with Bed Rate" value="">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number"class="form-control form-control-solid text-color-secondary"
                    name="child_with_bed_markup[ep]" placeholder="Child with Bed Markup" value="" />

            </div>
        </div>

        <div class="col-sm-3 child_with_no_bed hidden-div">
            <span class="text-color text-sm">Child with No Bed Rates & Markup</span>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_no_bed_price[ep]" placeholder="Child with No Bed Rate" value="">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_no_bed_markup[ep]" placeholder="Child with No Bed Markup" value="" />
            </div>
        </div>

    </div>


    <!-- CP Rates -->
    <div class="row mb-5 py-1 align-items-center" id="cp_rates">
        <div class="col-sm-3">
            <div class="d-flex flex-column">
                <span class="text-color fs-7 fw-bold">CP Rates</span>
                <span class="text-color-secondary fw-semibold fs-8">Breakfast is included along
                    with room.</span>
            </div>
        </div>
        <div class="col-sm-4 mt-4 mt-sm-0">
        </div>
        <div class="col-sm-4 mt-4 mt-sm-0">
        </div>

        <div class="col-sm-3 no_of_extra_person hidden-div">
            <span class="text-color text-sm">Extra Person Rates & Markup</span>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 no_of_extra_person hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="extra_person_price[cp]" placeholder="Extra Person Rate" value="">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 no_of_extra_person hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="extra_person_markup[cp]" placeholder="Extra Person Markup" value="" />
            </div>
        </div>

        <div class="col-sm-3 child_with_bed hidden-div">
            <span class="text-color text-sm">Child with Bed Rates & Markup</span>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_bed_price[cp]" placeholder="Child with Bed Rate" value="">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_bed_markup[cp]" placeholder="Child with Bed Markup" value="" />
            </div>
        </div>

        <div class="col-sm-3 child_with_no_bed hidden-div">
            <span class="text-color text-sm">Child with No Bed Rates & Markup</span>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_no_bed_price[cp]" placeholder="Child with No Bed Rate" value="">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_no_bed_markup[cp]" placeholder="Child with No Bed Markup" value="" />
            </div>
        </div>
    </div>



    <!-- MAP Rates -->
    <div class="row mb-5 py-1 align-items-center" id="map_rates">
        <div class="col-sm-3">
            <div class="d-flex flex-column">
                <span class="text-color fs-7 fw-bold">MAP Rates</span>
                <span class="text-color-secondary fw-semibold fs-8">Includes room, breakfast &
                    dinner</span>
            </div>
        </div>
        <div class="col-sm-4 mt-4 mt-sm-0">
        </div>
        <div class="col-sm-4 mt-4 mt-sm-0">
        </div>

        <div class="col-sm-3 no_of_extra_person hidden-div">
            <span class="text-color text-sm">Extra Person Rates & Markup</span>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 no_of_extra_person hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="extra_person_price[map]" placeholder="Extra Person Rate" value="">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 no_of_extra_person hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="extra_person_markup[map]" placeholder="Extra Person Markup" value="" />
            </div>
        </div>

        <div class="col-sm-3 child_with_bed hidden-div">
            <span class="text-color text-sm">Child with Bed Rates & Markup</span>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_bed_price[map]" placeholder="Child with Bed Rate" value="">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_bed_markup[map]" placeholder="Child with Bed Markup" value="" />
            </div>
        </div>

        <div class="col-sm-3 child_with_no_bed hidden-div">
            <span class="text-color text-sm">Child with No Bed Rates & Markup</span>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_no_bed_price[map]" placeholder="Child with No Bed Rate" value="">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_no_bed_markup[map]" placeholder="Child with No Bed Markup" value=""/>
            </div>
        </div>

    </div>

    <!-- AP Rates -->
    <div class="row mb-5 py-1 align-items-center" id="ap_rates">
        <div class="col-sm-3">
            <div class="d-flex flex-column">
                <span class="text-color fs-7 fw-bold">AP Rates</span>
                <span class="text-color-secondary fw-semibold fs-8">Includes room, breakfast,lunch & dinner</span>
            </div>
        </div>
        <div class="col-sm-4 mt-4 mt-sm-0">
        </div>
        <div class="col-sm-4 mt-4 mt-sm-0">
        </div>

        <div class="col-sm-3 no_of_extra_person hidden-div">
            <span class="text-color text-sm">Extra Person Rates & Markup</span>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 no_of_extra_person hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="extra_person_price[ap]" placeholder="Extra Person Rate" value="">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 no_of_extra_person hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="extra_person_markup[ap]" placeholder="Extra Person Markup" value="" />
            </div>
        </div>

        <div class="col-sm-3 child_with_bed hidden-div">
            <span class="text-color text-sm">Child with Bed Rates & Markup</span>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_bed_price[ap]" placeholder="Child with Bed Rate" value="">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_bed_markup[ap]" placeholder="Child with Bed Markup" value="" />
            </div>
        </div>

        <div class="col-sm-3 child_with_no_bed hidden-div">
            <span class="text-color text-sm">Child with No Bed Rates & Markup</span>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_no_bed_price[ap]" placeholder="Child with No Bed Rate" value="">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_no_bed_markup[ap]" placeholder="Child with No Bed Markup" value=""/>
            </div>
        </div>

    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

<script>

       $(document).ready(function () {
        // Initialize select2 on modal
        $(".select-2").select2({
            dropdownParent: $("#global_modal")
        });
    });


    function handleExtraConfigToggle(field, isChecked) {
        let $targetDiv;

        switch (field) {
            case 'is_extra_person_allowed':
                $targetDiv = $('div.no_of_extra_person');
                break;
            case 'child_with_bed':
                $targetDiv = $('div.child_with_bed');
                break;
            case 'child_with_no_bed':
                $targetDiv = $('div.child_with_no_bed');
                break;
            default:
                return;
        }

        if (isChecked) {
            $targetDiv.removeClass('d-none').fadeIn();
        } else {
            $targetDiv.fadeOut().find('input').val('');
        }
    }

    $(document).ready(function() {
        $('input.extra_config').each(function() {
            const isChecked = $(this).is(':checked');
            const field = $(this).attr('name');
            handleExtraConfigToggle(field, isChecked);
        });

        // Handle state on change
        $('body').on('change', 'input.extra_config', function() {
            const isChecked = $(this).is(':checked');
            const field = $(this).attr('name');
            handleExtraConfigToggle(field, isChecked);
        });
    });


</script>

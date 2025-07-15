<form class="global-ajax-form ratePlan-form" action="{{ route('singleExtraBedPrice.update') }}" method="post"
    data-modal-form="#global_modal">

    <input type ="hidden" name="planId" value="{{$ratePlan->id}}">
    <h3> Rate Plans : </h3>

    @php
        $configs = $ratePlan->RatePlanConfig->keyBy('plan_type');
        $ep = $configs->get('ep') ?? '';
        $cp = $configs->get('cp') ?? '';
        $map = $configs->get('map') ?? '';
        $ap = $configs->get('ap') ?? '';

    @endphp

    <div class="d-flex align-items-center gap-3 my-5">
        <div class="col-sm-3"></div>

        <div class="form-check">
            <input class="form-check-input extra_config" type="checkbox" name="is_extra_person_allowed"
                id="is_extra_person_allowed" {{ $ratePlan->is_extra_person_allowed == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="is_extra_person_allowed">
                Extra Person Allowed
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input extra_config" type="checkbox" name="child_with_bed" id="child_with_bed"
                {{ $ratePlan->child_with_bed == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="child_with_bed">
                Child With Bed
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input extra_config" type="checkbox" name="child_with_no_bed" id="child_with_no_bed"
                {{ $ratePlan->child_with_no_bed == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="child_with_no_bed">
                Child With No Bed
            </label>
        </div>
    </div>

    <div class="row pb-5" id="extra_bed_config">
        <div class="col-sm-3"></div>
        <div class="col-md-4 no_of_extra_person hidden-div">
            <input type="number" class="form-control text-color-secondary" name="no_of_extra_person"
                placeholder="No of Allowed Persons" value="{{ $ratePlan->no_of_extra_person ?? '' }}" />
        </div>
        <div class="col-md-4 child_with_bed hidden-div">
            <input type="number" class="form-control text-color-secondary" name="min_child_age"
                placeholder="Minimum Child Age" value="{{ $ratePlan->min_child_age ?? ''}}" />
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
                    name="extra_person_price[ep]" placeholder="Extra Person Rate"
                    value="{{ $ep->extra_person_price ?? 0 }}">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 no_of_extra_person hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="extra_person_markup[ep]" placeholder="Extra Person Markup"
                    value="{{ $ep->extra_person_markup ?? 0 }}" />
            </div>
        </div>

        <div class="col-sm-3 child_with_bed hidden-div">
           <span class="text-color text-sm">Child with Bed Rates & Markup</span>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_bed_price[ep]" placeholder="Child with Bed Rate"
                    value="{{ $ep->child_with_bed_price ?? 0 }}">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number"class="form-control form-control-solid text-color-secondary"
                    name="child_with_bed_markup[ep]" placeholder="Child with Bed Markup"
                    value="{{ $ep->child_with_bed_markup ?? 0 }}" />

            </div>
        </div>

        <div class="col-sm-3 child_with_no_bed hidden-div">
            <span class="text-color text-sm">Child with No Bed Rates & Markup</span>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary" name="child_with_no_bed_price[ep]" placeholder="Child with No Bed Rate"
                   value="{{ $ep->child_with_no_bed_price ?? 0 }}">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary" name="child_with_no_bed_markup[ep]" placeholder="Child with No Bed Markup" value="{{ $ep->child_with_no_bed_markup ?? 0 }}" />
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
                    name="extra_person_price[cp]" placeholder="Extra Person Rate" value="{{ $cp->extra_person_price ?? 0 }}">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 no_of_extra_person hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="extra_person_markup[cp]" placeholder="Extra Person Markup"
                    value="{{ $cp->extra_person_markup ?? 0 }}" />
            </div>
        </div>

        <div class="col-sm-3 child_with_bed hidden-div">
            <span class="text-color text-sm">Child with Bed Rates & Markup</span>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_bed_price[cp]" placeholder="Child with Bed Rate"
                    value="{{ $cp->child_with_bed_price ?? 0 }}">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_bed_markup[cp]" placeholder="Child with Bed Markup"
                    value="{{ $cp->child_with_bed_markup ?? 0 }}" />
            </div>
        </div>

        <div class="col-sm-3 child_with_no_bed hidden-div">
            <span class="text-color text-sm">Child with No Bed Rates & Markup</span>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_no_bed_price[cp]" placeholder="Child with No Bed Rate"
                    value="{{ $cp->child_with_no_bed_price ?? 0 }}">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_no_bed_markup[cp]" placeholder="Child with No Bed Markup"
                    value="{{ $cp->child_with_no_bed_markup ?? 0 }}" />
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
                    name="extra_person_price[map]" placeholder="Extra Person Rate"
                    value="{{ $map->extra_person_price ?? 0 }}">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 no_of_extra_person hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="extra_person_markup[map]" placeholder="Extra Person Markup"
                    value="{{ $map->extra_person_markup ?? 0 }}" />
            </div>
        </div>

        <div class="col-sm-3 child_with_bed hidden-div">
            <span class="text-color text-sm">Child with Bed Rates & Markup</span>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_bed_price[map]" placeholder="Child with Bed Rate"
                    value="{{ $map->child_with_bed_price ?? 0 }}">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_bed_markup[map]" placeholder="Child with Bed Markup"
                    value="{{ $map->child_with_bed_markup ?? 0 }}" />
            </div>
        </div>

        <div class="col-sm-3 child_with_no_bed hidden-div">
            <span class="text-color text-sm">Child with No Bed Rates & Markup</span>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_no_bed_price[map]" placeholder="Child with No Bed Rate"
                    value="{{ $map->child_with_no_bed_price ?? 0 }}">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_no_bed_markup[map]" placeholder="Child with No Bed Markup"
                    value="{{ $map->child_with_no_bed_markup ?? 0 }}" />
            </div>
        </div>
        
    </div>


        <!-- AP Rates -->
    <div class="row mb-5 py-1 align-items-center" id="map_rates">
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
                    name="extra_person_price[ap]" placeholder="Extra Person Rate"
                    value="{{ $ap->extra_person_price ?? 0 }}">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 no_of_extra_person hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="extra_person_markup[ap]" placeholder="Extra Person Markup"
                    value="{{ $ap->extra_person_markup ?? 0 }}" />
            </div>
        </div>

        <div class="col-sm-3 child_with_bed hidden-div">
            <span class="text-color text-sm">Child with Bed Rates & Markup</span>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_bed_price[ap]" placeholder="Child with Bed Rate"
                    value="{{ $ap->child_with_bed_price ?? 0 }}">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_bed_markup[ap]" placeholder="Child with Bed Markup"
                    value="{{ $ap->child_with_bed_markup ?? 0 }}" />
            </div>
        </div>

        <div class="col-sm-3 child_with_no_bed hidden-div">
            <span class="text-color text-sm">Child with No Bed Rates & Markup</span>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_no_bed_price[ap]" placeholder="Child with No Bed Rate"
                    value="{{ $ap->child_with_no_bed_price ?? 0 }}">
            </div>
        </div>

        <div class="col-sm-4 mt-4 mt-sm-0 child_with_no_bed hidden-div">
            <div class="input-group input-group-solid">
                <span class="input-group-text bg-dark-gray-f2 text-color-secondary" id="basic-addon3">₹</span>
                <input type="number" class="form-control form-control-solid text-color-secondary"
                    name="child_with_no_bed_markup[ap]" placeholder="Child with No Bed Markup"
                    value="{{ $ap->child_with_no_bed_markup ?? 0 }}" />
            </div>
        </div>
        
    </div>



        <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>

<script>
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

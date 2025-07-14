<div class="section-rest-filter">
    @if (!empty($amenityBedTyeData['priceRangeCount']))
    <div class="star-category">
        <h5>Price Range</h5>
        @foreach ($amenityBedTyeData['priceRangeCount'] as $key=>$rangeCount)
        <div class="check-seach">
            <div class="form-check">
                <input class="form-check-input" type="checkbox"
                    value="{{ $rangeCount['start'] }}-{{ $rangeCount['end'] }}" id="price_range_{{$key}}"
                    name="price_range[]">
                    <label class="form-check-label" for="price_range_{{$key}}">
                    @if($key==0)    
                        Upto ₹{{$rangeCount['end'] ?? 0 }}
                    @elseif( count($amenityBedTyeData['priceRangeCount']) == $key+1)
                        More than ₹{{$rangeCount['start'] ?? 0 }}
                    @else
                        ₹ {{ $rangeCount['start'] ?? 0 }} - ₹
                        {{ $rangeCount['end'] ?? 0 }}
                    @endif
                </label>
            </div>
            <span>{{ $rangeCount['count'] ?? 0 }}</span>
        </div>
        @endforeach
    </div>
    @endif

    @if (!empty($amenityBedTyeData['hotelRating']))
    <div class="star-category">
        <h5>Star Category</h5>

        @foreach ($amenityBedTyeData['hotelRating'] as $key=>$rating)
        <div class="check-seach">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ intval($rating['rating']) }}"
                    name="star_category[]" id="star-four_{{$key}}">
                <label class="form-check-label" for="star-four_{{$key}}">
                    {{ intval($rating['rating']) ?? '' }} Star
                </label>
            </div>
            <span>
                {{ $rating['total'] ?? 0 }}
            </span>
        </div>
        @endforeach
    </div>
    @endif

    @if (!empty($amenityBedTyeData['hotelAmenity']) && count($amenityBedTyeData['hotelAmenity'])>0)
    <div class="facilities">
        <h5>Amenity</h5>

        @foreach ($amenityBedTyeData['hotelAmenity'] as $key=>$hotelAmenity)
        <div class="check-seach">
            <div class="form-check">
                <input class="form-check-input" name="hotel_amenity[]" type="checkbox"
                    value="{{ $hotelAmenity['amenity_id'] }}" id="hotel_amenity_{{$key}}">
                <label class="form-check-label" for="hotel_amenity_{{$key}}">
                    {{ ucwords($hotelAmenity['amenityName']['name']) ?? '' }} </label>
            </div>
            <span>
                {{ $hotelAmenity['total_amenity'] ?? 0 }}
            </span>
        </div>
        @endforeach
    </div>
    @endif

    @if (!empty($amenityBedTyeData['bedType']) && count($amenityBedTyeData['bedType'])>0)
    <div class="bed-preference">
        <h5>Bed preference</h5>

        @foreach ($amenityBedTyeData['bedType'] as $key=>$bedType)
        <div class="check-seach">
            <div class="form-check">
                <input class="form-check-input" name="bed_type[]" type="checkbox" value=" {{ $bedType['bed_type_id'] }}"
                    id="bed_type_{{$key}}">
                <label class="form-check-label" for="bed_type_{{$key}}">
                    {{ ucwords($bedType['bedTypeName']['bed_type']) ?? '' }}
                </label>
            </div>
            <span>{{ $bedType['total_bed_type'] ?? 0 }}</span>
            
        </div>
        @endforeach
    </div>
    @endif
</div>
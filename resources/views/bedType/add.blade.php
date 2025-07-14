
<form class="global-ajax-form" action="{{ route('save.bedType') }}" method="post" data-redirect-url="{{ route('bedType') }}">
    @csrf
    <input type="hidden" name="id" value="{{ $bedType->id ?? '' }}">
    <div class="mb-3">
        <label for="amenity_name" class="form-label"> Bed Type</label>
        <input type="text" class="form-control" id="city_name" value="{{ $bedType->bed_type ?? '' }}" name="bed_type"
            placeholder="Enter Bed Type">
    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

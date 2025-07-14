<form action="{{ route('lead.contact.save') }}" class="global-ajax-form guest-form" method="post" data-modal-form="#global_modal">
    @csrf

    {{-- @dd($contact); --}}
    <input type="hidden" name="id" value="{{$contact?->id}}" />
    <input type="hidden" name="bookingId" value="{{ $bookingId }}" />

    <div class="row">

        <div class="col-md-6 mb-3">
            <label class="form-label">Contact Name</label>
            <input type="text" class="form-control" value="{{ $contact?->name }}" name="name" placeholder="Contact Name">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Contact Email</label>
            <input type="email" class="form-control" value="{{ $contact?->email }}" name="email" placeholder="Contact Email">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Contact Mobile</label>
            <input type="number" maxlength="10" class="form-control" value="{{ $contact?->mobile }}" name="mobile" placeholder="Contact Mobile">
        </div>

    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
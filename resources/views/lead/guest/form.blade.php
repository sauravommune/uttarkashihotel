<form action="{{ route('lead.guest.save') }}" class="global-ajax-form guest-form" method="post" data-modal-form="#global_modal">
    @csrf

    <input type="hidden" name="id" value="{{ encode($guest?->id)}}" />
    <input type="hidden" name="bookingId" value="{{ $bookingId }}" />

    <div class="row">

        <div class="col-md-6 mb-3">
            <label class="form-label required">Guest Full Name</label>
            <input type="text" class="form-control" value="{{ $guest?->name }}" name="name" placeholder="Guest Name">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label required">Guest Email</label>
            <input type="email" class="form-control" value="{{ $guest?->email }}" name="email" placeholder="Guest Email">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label required">Gender</label>
            <select class="form-select form-control" name="gender">
                <option value="male" @selected($guest?->gender == 'male')>Male</option>
                <option value="female" @selected($guest?->gender == 'female')>Female</option>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label required">Date Of Birth</label>
            <input type="text" class="form-control modal-date-picker" value="{{ $guest->dob ? Carbon\Carbon::parse($guest->created_at)->format('d/m/Y') : '' }}" name="dob" placeholder="Date Of Birth">
        </div>

    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
<script>
    $('.modal-date-picker').datepicker();
</script>
    

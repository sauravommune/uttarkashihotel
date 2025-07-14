<form action="{{ Route('followup.store') }}" class="global-ajax-form follow-up-form" method="POST" autocomplete="off" data-modal-form="#global_modal" novalidate>
    <input type="hidden" name="booking_id" value="{{encode($booking->id)}}" />
    <input type="hidden" name="follow_up" value="{{encode($followUp?->id)}}" />

    @csrf
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="follow_up_date" class="form-label">Follow Up Date & Time</label>
                <input type="text" class="form-control" id="follow_up_date" name="follow_up_date" value="{{ $followUp?->follow_up_date }}" required placeholder="Follow Up Date" />
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" name="status" id="status" required>
                    <option value="Open" @selected($followUp?->status == 'Open')>Open</option>
                    <option value="Closed" @selected($followUp?->status == 'Closed')>Closed</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="remarks" class="form-label">Remark</label>
        <textarea class="form-control" name="remarks" id="remarks" rows="5" required placeholder="Remarks">{{ $followUp?->remarks }}</textarea>
    </div>


    <div class="d-flex align-items-center justify-content-end gap-2 mt-3">
        <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary">Save</button>
    </div>
</form>
<script>
    $(document).ready(function(){
        $('#follow_up_date').flatpickr({
            enableTime: true,
        });
    })
</script>
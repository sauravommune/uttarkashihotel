<form action="{{Route('feedback.save')}}" class="global-ajax-form feedback-form" method="POST" autocomplete="off" data-modal-form="#global_modal" novalidate>
    <p class="mb-3">Are you interested in providing feedback?</p>
    <input type="hidden" name="booking_id" value="{{encode($booking->id)}}" />  
    
    <!-- Radio buttons for Interested and Not Interested -->
    <div class="d-flex gap-5">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="is_interested" value="1" id="intrested" @checked($feedback?->is_interested) />
            <label class="form-check-label" for="intrested">Interested</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="send_email" value=1 id="send_email"/>
            <label class="form-check-label" for="send_email">Send Email</label>
        </div>
    </div>
    <div class="form-check my-3">
        <input class="form-check-input" type="radio" name="is_interested" value="0" id="not-intrested" @checked(!$feedback?->is_interested) />
        <label class="form-check-label" for="not-intrested">Not Interested</label>
    </div>

    <!-- Comment box appears if "Interested" is selected -->
    <div class="comment-box" id="commentBox">
        <label for="feedback_comment" class="form-label">Please leave your comments:</label>
        <textarea class="form-control" id="feedback_comment" name="feedback_comment" rows="4" placeholder="Type your comments here...">{{$feedback?->feedback_comment}}</textarea>
    </div>

    <div class="d-flex align-items-center justify-content-end gap-2 mt-3">
        <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary">Save</button>
    </div>
</form>

<script>
    $('.global-ajax-form').validate();
</script>
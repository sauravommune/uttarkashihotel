<form class="global-ajax-form" action="{{ route('save.bedType') }}" method="post" data-redirect-url="{{ route('bedType') }}" id="bedType">
    @csrf

    <input type="hidden" name="id" value="{{ $metaSetting->id ?? '' }}">

    <div class="mb-5">
        <label for="title" class="form-label mb-0">Page Title</label>
        <input type="text" class="form-control form-control-solid" value="{{$metaSetting->name??''}}" name="title" placeholder="Enter Page Title" readonly>
    </div>

    <div class="mb-5">
        <label for="meta_title" class="form-label mb-0">Meta Title <small class="text-danger">(max 70 character allowed)</small></label>
        <input type="text" class="form-control form-control-solid character-count" value="{{$metaSetting->meta_title??''}}" name="meta_title" placeholder="Enter Meta Title" data-target="#character-count-title" maxlength="70">
        <small id="character-count-title">{{ strlen($metaSetting->meta_title) }} of 70 characters.</small>
    </div>

    <div class="mb-3">
        <label for="meta_description" class="form-label mb-0">Meta Description <small class="text-danger">(max 160 character allowed)</small></label>
        <textarea class="form-control form-control-solid character-count" name="meta_description" placeholder="Enter Meta Description" rows="5" maxlength="160" data-target="#character-count-description">{{$metaSetting->meta_description??''}}</textarea>
            <small id="character-count-description">{{ strlen($metaSetting->meta_description) }} of 160 characters.</small>
    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>

</form>
<script>
    $(document).ready(function() {
        $('body').off('.character-count').on('input', '.character-count', function(){
            let _this = $(this);
            let maxLength = _this.attr('maxlength');
            let _target = _this.attr('data-target');
            let currentLength = _this.val().length;
            let remainingLength = maxLength - currentLength;
            $(_target).text(currentLength + ' of ' + maxLength + ' characters.');
        });
    });
</script>

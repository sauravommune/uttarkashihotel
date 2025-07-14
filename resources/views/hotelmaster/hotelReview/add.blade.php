
<form class="global-ajax-form" action="{{ route('save.hotelReview') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $hotelId ?? ''}}">
    <input type="hidden" name="hotelReviewId" value="{{ $data->id ?? ''}}">

    <div class="row">
        <div class="col-md-12">
            <label for="author_name" class="form-label">Author name</label>
            <input type="text" class="form-control" id="author_name" value="{{$data?->author_name??''}}" name="author_name"
                placeholder="Enter Author Name">
        </div>
        <div class="col-md-12">
            <label for="review" class="form-label">Review</label>
            <textarea class="form-control" id="review" name="review" rows="5" col="5" placeholder="Enter your review">{{$data?->text??''}}</textarea>
        </div>
        <div class="col-md-12">
            <label for="rating" class="form-label">Rating</label>
            <input type="number" class="form-control" id="rating" value="{{$data?->rating??''}}" name="rating" placeholder="Enter a rating (e.g., 5.0)" 
                   step="0.01" min="0" max="5">
        </div>

        <div class="col-md-12 mt-3">
            <label for="review_date" class="form-label">Review Date</label>
            <input type="date" class="form-control" id="review_date" value="{{$data?->date??''}}" name="review_date" placeholder="Select Review Date">
        </div>
        <div class="col-md-12 mt-3">
            <label for="review_image" class="form-label">Review Image</label>
            <input type="file" class="form-control" id="author_image" name="author_image" accept="image/*">
        </div>
        
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary mt-8">Save</button>
        </div>
    </div>
</form>

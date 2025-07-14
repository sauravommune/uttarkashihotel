<form action="{{ route('room.save') }}" class="global-ajax-form" method="POST" enctype="multipart/form-data" data-redirect-url="{{route('room')}}">
    @csrf
    <input type="hidden" name="id" value="{{ $id ?? '' }}">
    <div class="col-md-12 text-end mb-2">
        <button type="button" class="btn btn-primary" id="add_image_btn"> Add +</button>
    </div>
    <div class="form-group row mb-5">
        <label class="col-md-3 form-label">Image</label>
        <div class="col-md-9">
            <input type="file" name="images[]" class="form-control">
        </div>
    </div>


    <div class="text-end mt-3">
        <x-primary-button class="ml-3">
            {{ __('Save') }}
        </x-primary-button>
    </div>

</form>
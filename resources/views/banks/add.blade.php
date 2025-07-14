
<form class="global-ajax-form" action="{{ route('banks.store') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $banks->id ?? '' }}">
    <div class="row">
        <div class="col-md-6">
            <label for="banks_name" class="form-label">Bank Name</label>
            <input type="text" class="form-control" id="name" value="{{ $banks->name ?? '' }}" name="name"
                placeholder="Enter Bank Name">
        </div>
        <div class="col-md-4">
            <label for="code" class="form-label">Code</label>
            <input type="text" class="form-control" id="code" value="{{ $banks->code ?? '' }}" name="code"
                placeholder="Enter Bank Code">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary mt-8">Save</button>
        </div>
    </div>
</form>

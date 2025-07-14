<form class="ajax-form" data-modal-form="#modal" action="{{ route('status.store') }}"
    method="post" enctype="multipart/form-data"  data-redirect-url="{{ route('status.index') }}">
    <div class="d-flex flex-column gap-8">
        <div class="form-group">
            <label for="name" class="mb-2">Status Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="color" class="mb-2">Color:</label>
            <input type="color" name="color" id="color" class="form-control">
        </div>
        <div class="form-group">
            <label for="background" class="mb-2">Background:</label>
            <input type="color" name="background" id="background" class="form-control">
        </div>
        <div class="d-flex align-items-center justify-content-end gap-2">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Status</button>
        </div>
</form>
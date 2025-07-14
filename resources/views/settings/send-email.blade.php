<x-app-layout>
<div class="container">
    <h2>Send Email via Gmail API</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(!isset($isAuthenticated) || !$isAuthenticated)
        <div class="alert alert-warning">
            You are not authenticated with Gmail API. 
            <a href="{{ route('google.credentials.form') }}" class="btn btn-sm btn-primary">Setup Authentication</a>
        </div>
    @endif

    <form method="POST" action="{{ route('gmail.send') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="to" class="form-label">To</label>
            <input type="email" class="form-control" name="to" required>
        </div>
        <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" class="form-control" name="subject" required>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea class="form-control" name="body" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="attachments" class="form-label">Attachments</label>
            <input type="file" class="form-control" name="attachments[]" multiple>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="is_html" id="is_html" value="1">
            <label class="form-check-label" for="is_html">HTML Content</label>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="queue" id="queue" value="1">
            <label class="form-check-label" for="queue">Queue Email (Send in background)</label>
        </div>
        <button type="submit" class="btn btn-success">Send Email</button>
    </form>
</div>
</x-app-layout>
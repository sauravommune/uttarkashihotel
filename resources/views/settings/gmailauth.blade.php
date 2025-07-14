<x-app-layout>
<div id="kt_app_content_container" class="app-container container-fluid">

    <!--begin::Basic info-->
    <div class="card box-shadow-remove  mb-5 mb-xl-10" data-select2-id="select2-data-134-ozqj">
        <!--begin::Card header-->
        
        <!--begin::Card header-->
        <section class="section">
            <div class="container">
                <h2>Enter Google OAuth Credentials</h2>
                <form method="POST" action="{{ route('google.credentials.save') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="client_id" class="form-label">Client ID</label>
                        <input type="text" class="form-control" name="client_id" value="{{ old('client_id', $creds->client_id ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="client_secret" class="form-label">Client Secret</label>
                        <input type="text" class="form-control" name="client_secret" value="{{ old('client_secret', $creds->client_secret ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="redirect_uri" class="form-label">Redirect URI</label>
                        <input type="url" class="form-control" name="redirect_uri" value="{{ old('redirect_uri', $creds->redirect_uri ?? '') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Authenticate with Google</button>
                </form>
            </div>
        </section>
    </div>

</div>
</x-app-layout>

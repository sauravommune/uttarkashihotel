<x-app-layout>
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex justify-content-between align-items-center me-3 w-100">
                    <div>
                        <!--begin::Title-->
                        <h1 class="page-heading text-color fw-bold fs-18 m-0">
                            API Keys
                        </h1>
                        <!--end::Title-->

                    </div>


                </div>
            </div>
        </div>
    </div>


    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card border-0">
                <!--begin::Card header-->

                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <form action="{{ route('serverKey.store') }}" class="global-ajax-form" method="POST">
                                @csrf
                                <div class="row fv-plugins-icon-container">
                                    <div class="mb-3 col-12" data-select2-id="5">
                                        <label for="apiAccess" class="form-label py-3">Choose the Api key Status you
                                            want to create</label>
                                        <div class="position-relative fv-row" data-select2-id="4">
                                            <select id="apiAccess" class="form-select" name="status">
                                                <option value="">Choose Key Status</option>
                                                <option value="active">Active</option>
                                                <option value="deactive">Deactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-12">
                                        <label for="apiKey" class="form-label">Name</label>
                                        <div class="input-group input-group-merge has-validation fv-row">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-12">
                                        <label for="apiKey" class="form-label">API key</label>
                                        <div class="input-group">
                                            <input type="text" id="apikey" class="form-control" placeholder="Server Key" name="key">
                                            <button type="button" class="input-group-text cursor-pointer" toggle="#currentPassword" id="keygen">Generate
                                                API Key</button>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="source">Source</label>
                                        <input type="text" class="form-control" id="source" name="source" placeholder="Enter Source">
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button type="submit" id="submit_keyForm" class="btn btn-primary me-2 d-grid w-100 waves-effect waves-light">Create
                                            Key</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-lg-6 d-flex align-items-center mt-lg-0 mt-3">
                            <div class="d-flex justify-content-center w-100">
                                <img src="{{ asset('assets/media/girl-with-laptop.png') }}" alt="Api Key Image" width="310">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 mt-5">
                <!--begin::Card header-->

               <div class="d-flex justify-content-between card-section pb-3 align-items-center">
                <div>
                    <h5 class="d-flex align-items-center mb-0">Generated API Keys</h5>
                </div>
                <div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table" id="serverkey-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Key</th>
                                    <th>Source</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->key }}</td>
                                    <td>{{ $item->source }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ formatDateMdYHiA($item->created_at) }}</td>
                                    <td>
                                        <a href="{{ route('serverKey.delete', $item->id) }}" class="box-32 bg-light-gray  rounded d-flex justify-content-center cursor-pointer align-items-center delete-item">
                                            <div class="box-32 bg-light-gray  rounded d-flex justify-content-center align-items-center cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                    <path d="M3.33398 6.00016C3.33398 5.63198 3.63246 5.3335 4.00065 5.3335H12.0007C12.3689 5.3335 12.6673 5.63198 12.6673 6.00016V12.0002C12.6673 13.1048 11.7719 14.0002 10.6673 14.0002H5.33398C4.22942 14.0002 3.33398 13.1048 3.33398 12.0002V6.00016Z" fill="#2C2E33"></path>
                                                    <path opacity="0.5" d="M3.33398 3.33268C3.33398 2.9645 3.63246 2.66602 4.00065 2.66602H12.0007C12.3689 2.66602 12.6673 2.9645 12.6673 3.33268C12.6673 3.70087 12.3689 3.99935 12.0007 3.99935H4.00065C3.63246 3.99935 3.33398 3.70087 3.33398 3.33268Z" fill="#2C2E33"></path>
                                                    <path opacity="0.5" d="M6 2.66667C6 2.29848 6.29848 2 6.66667 2H9.33333C9.70153 2 10 2.29848 10 2.66667H6Z" fill="#2C2E33"></path>
                                                </svg>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr></tr>
                                    <td colspan="6" class="text-center">No Data Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                    </div>
                </div>
                
            </div>
                
            </div>
        </div>



    </div>
        
        </div>

</x-app-layout>

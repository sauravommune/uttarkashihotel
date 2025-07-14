<x-app-layout>
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-color fw-bold fs-18 m-0">
                        {{ $data['title'] }}
                    </h1>
                    <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('superAdmin.dashboard') }}" class="text-color-secondary text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('list.room_category') }}" class="text-color-secondary text-hover-primary">Room Categories</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-color-secondary">  {{ $data['title'] }}</li>
                    </ul>
                </div>
                <!--end::Page title-->
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card border-0">
                <div class="card-body p-5">
                    <h3 class="mb-4">Add Room Category</h3>
                    <!--begin::Add Amenity Form-->
                    <form class="global-ajax-form" action="{{ route('save.room_category') }}" method="post" data-redirect-url="{{ route('list.room_category') }}" id="validate-form">
                        @csrf

                        <input type="hidden" name="id" value="{{$room_category->id??''}}">


                        <div class="mb-3">
                            <label for="amenity_name" class="form-label">Room Category</label>
                            <input type="text" class="form-control" id="category_name" value="{{$room_category->name??''}}" name="category_name" placeholder="Enter room type name">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')


    @endpush
</x-app-layout>

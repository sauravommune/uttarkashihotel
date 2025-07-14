<x-app-layout>
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex justify-content-between gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">API Settings</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ url('/') }}" class="text-muted text-hover-success">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Company Settings</li>
                        <!--end::Item-->

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <div>
                    <a href="{{ route('settings.add-company') }}" title="Add Company" class="btn btn-primary"><i class="ki-outline ki-plus fs-7 fa-4x"></i>Add Company</a>
                </div>

                <!--end::Page title-->
            </div>
            <!--end::Toolbar wrapper-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <section class="section-1 p-9">
            <div class="card p-5">
                <div class="d-flex justify-content-between">
                    <div class="title">
                        <h4>Company List</h4>
                        <p>List of companies listed</p>
                    </div>

                </div>

                <div class="table-section">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="d-flex">
                                            <div class="">
                                                <div class="form-check">

                                                    Company Name
                                                </div>
                                            </div>
                                        </div>
                                    </th>

                                    <th>
                                        Contact Person
                                    </th>
                                    <th>
                                        Contact Email
                                    </th>
                                    <th>
                                        Contact Number
                                    </th>
                                    <th>
                                        Enable For Trade
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($company as $c)
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="">
                                                <div class="form-check">
                                                    {{ $c->company_name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        {{ $c->contact_person}}
                                    </td>
                                    <td>
                                    {{ $c->contact_email }}
                                    </td>
                                    <td>
                                    {{ $c->contact_phone }}
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('settings.add-company', $c->id) }}">
                                                <div class="icon">
                                                    <span class="material-symbols-outlined text-color-secondary fs-2">edit</span>
                                                </div>
                                            </a>
                                            <a href="jaavasirpt:void(0);" class="mx-3">
                                                <div class="icon">
                                                    <i class="la la-trash fs-2"></i>
                                                </div>
                                            </a>
                                            <div class="icon cursor-pointer">
                                                <i class="la la-copy fs-2"></i>
                                            </div>

                                        </div>
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{$company->links()}}

                    </div>
                </div>
            </div>
        </section>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</x-app-layout>

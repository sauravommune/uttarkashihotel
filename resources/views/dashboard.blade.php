<x-app-layout>
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-color fw-bold fs-3 m-0">
                        Hotel Dashboard</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="index.html" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Hotels Dashboard</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <!--end::Actions-->
            </div>
            <!--end::Toolbar wrapper-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Content container-->
            <div class="row gx-5 gx-xl-10 mb-xl-10">
                <!--begin::Col-->

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-4">
                            <!--begin::Card widget 4-->
                            <div class="card card-flush mb-5 mb-xl-6">
                                <!--begin::Card body-->
                                <div class="card-body d-flex align-items-center">

                                    <!--begin::Labels-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Currency-->
                                            {{-- <span class="fs-4 fw-semibold text-color-secondary me-1 align-self-start">$</span> --}}
                                            <!--end::Currency-->
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-color me-2 lh-1 ls-n2">29,420</span>
                                            <!--end::Amount-->
                                            <!--begin::Badge-->
                                            <span class="badge badge-light-success fs-base">
                                                <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>2.2%
                                            </span>
                                            <!--end::Badge-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Subtitle-->
                                        <span class="text-color-secondary pt-1 fw-semibold fs-6">Total Bookings</span>
                                        <!--end::Subtitle-->
                                    </div>
                                    <!--end::Labels-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card widget 4-->
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-4">
                            <!--begin::Card widget 4-->
                            <div class="card card-flush mb-5 mb-xl-6">
                                <!--begin::Card body-->
                                <div class="card-body d-flex align-items-center">

                                    <!--begin::Labels-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Currency-->
                                            <span class="fs-4 fw-semibold text-color-secondary me-1 align-self-start">₹</span>
                                            <!--end::Currency-->
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-color me-2 lh-1 ls-n2">129,420</span>
                                            <!--end::Amount-->
                                            <!--begin::Badge-->
                                            <span class="badge badge-light-success fs-base">
                                                <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>2.2%
                                            </span>
                                            <!--end::Badge-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Subtitle-->
                                        <span class="text-color-secondary pt-1 fw-semibold fs-6">Total Earning</span>
                                        <!--end::Subtitle-->
                                    </div>
                                    <!--end::Labels-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card widget 4-->
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-4">
                            <!--begin::Card widget 4-->
                            <div class="card card-flush mb-5 mb-xl-6">
                                <!--begin::Card body-->
                                <div class="card-body d-flex align-items-center">

                                    <!--begin::Labels-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Currency-->
                                            {{-- <span class="fs-4 fw-semibold text-color-secondary me-1 align-self-start">$</span> --}}
                                            <!--end::Currency-->
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-color me-2 lh-1 ls-n2">1,420</span>
                                            <!--end::Amount-->
                                            <!--begin::Badge-->
                                            <span class="badge badge-light-success fs-base">
                                                <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>2.2%
                                            </span>
                                            <!--end::Badge-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Subtitle-->
                                        <span class="text-color-secondary pt-1 fw-semibold fs-6">Total Guests</span>
                                        <!--end::Subtitle-->
                                    </div>
                                    <!--end::Labels-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card widget 4-->
                        </div>

                        <!--begin::Col-->
                        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <!--begin::Card widget 4-->
                            <div class="card h-xl-100">
                                <!--begin::Header-->
                                <div class="card-header pt-4">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start d-flex flex-column">
                                        <span class="card-label fw-bolder text-color fs-18">Guests</span>
                                        <span class="text-color-secondary mt-1 fw-semibold fs-6">Guests from this week</span>
                                    </h3>
                                    <!--end::Title-->
                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->
                                <div class="card-body p-7 px-9">
                                    <div class="d-flex justify-content-between align-items-center">
                                      <span class="text-color-secondary mt-1 fw-semibold fs-4">Adults (above 12 years)</span>
                                      <span class="text-color-secondary mt-1 fw-semibold fs-4"> <span class="fs-3 text-color fw-bold"> 443 </span>/527</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                      <span class="text-color-secondary mt-1 fw-semibold fs-4">Children (below 12 years)</span>
                                      <span class="text-color-secondary mt-1 fw-semibold fs-4"> <span class="fs-3 text-color fw-bold"> 83 </span>/527</span>
                                    </div>
                                  </div>
                                  <!--end::Body-->
                              </div>
                              <!--end::Card widget 4-->
                         </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                          <!--begin::Card widget 4-->
                          <div class="card h-xl-100">
                              <!--begin::Header-->
                              <div class="card-header pt-4">
                                  <!--begin::Title-->
                                  <h3 class="card-title align-items-start d-flex flex-column">
                                      <span class="card-label fw-bolder text-color fs-18">Bookings Type</span>
                                      <span class="text-color-secondary mt-1 fw-semibold fs-6">Bookings from this week by Booking Type</span>
                                  </h3>
                                  <!--end::Title-->
                              </div>
                              <!--end::Header-->

                              <!--begin::Body-->
                              <div class="card-body p-7 px-9">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex justify-content-start align-items-start flex-column">
                                          <span class="text-color-secondary mt-1 fw-semibold fs-4">Self-Booking</span>
                                          <span class="text-color mt-3 fw-bold fs-4"> 112</span>
                                        </div>
                                        <div class="d-flex justify-content-start align-items-start flex-column">
                                          <span class="text-color-secondary mt-1 fw-semibold fs-4">Group Booking</span>
                                          <span class="text-color mt-3 fw-bold fs-4"> 10</span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card widget 4-->
                        </div>
                       <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                          <!--begin::Card widget 4-->
                          <div class="card h-xl-100">
                              <!--begin::Header-->
                              <div class="card-header pt-4">
                                  <!--begin::Title-->
                                  <h3 class="card-title align-items-start d-flex flex-column">
                                      <span class="card-label fw-bolder text-color fs-18">Bookings Type</span>
                                      <span class="text-color-secondary mt-1 fw-semibold fs-6">Bookings from this week by Booking Type</span>
                                  </h3>
                                  <!--end::Title-->
                              </div>
                              <!--end::Header-->

                              <!--begin::Body-->
                              <div class="card-body p-7 px-9">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex justify-content-start align-items-start flex-column">
                                          <span class="text-color-secondary mt-1 fw-semibold fs-4">Self-Booking</span>
                                          <span class="text-color mt-3 fw-bold fs-4"> 112</span>
                                        </div>
                                        <div class="d-flex justify-content-start align-items-start flex-column">
                                          <span class="text-color-secondary mt-1 fw-semibold fs-4">Group Booking</span>
                                          <span class="text-color mt-3 fw-bold fs-4"> 10</span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card widget 4-->
                        </div>
                       <!--end::Col-->
                    </div>
                </div>
                <!--end::Col-->
                <div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
                    <!--begin::Chart widget 3-->
                    <div class="card card-flush overflow-hidden h-md-100">
                        <!--begin::Header-->
                        <div class="card-header py-5 d-flex">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column d-flex">
                                <span class="card-label fw-bold fs-18 text-color">Fairfield by Marriott Goa calamite</span>
                                <span class="text-color-secondary mt-1 fw-semibold fs-6">Users from all channels</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Menu-->
                                <a href="{{route('hotel')}}" class="btn btn-primary d-flex  justify-content-center align-content-center">
                                    <span class="material-symbols-outlined fs-1">
                                            add
                                    </span>
                                    Add Hotel
                                </a>
                                <!--begin::Menu 2-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                    data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content fs-6 text-color fw-bold px-3 py-4">Quick
                                            Actions</div>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu separator-->
                                    <div class="separator mb-3 opacity-75"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">New Ticket</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">New Customer</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                        data-kt-menu-placement="right-start">
                                        <!--begin::Menu item-->
                                        <a href="#" class="menu-link px-3">
                                            <span class="menu-title">New Group</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <!--end::Menu item-->
                                        <!--begin::Menu sub-->
                                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Admin Group</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Staff Group</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Member Group</a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu sub-->
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">New Contact</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu separator-->
                                    <div class="separator mt-3 opacity-75"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content px-3 py-3">
                                            <a class="btn btn-primary btn-sm px-4" href="#">Generate
                                                Reports</a>
                                        </div>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu 2-->
                                <!--end::Menu-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
                            <!--begin::Statistics-->
                            <div class="px-9 mb-5">
                                <!--begin::Statistics-->
                                <div class="d-flex mb-2">
                                    <span class="fs-4 fw-semibold text-color-secondary me-1">$</span>
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">14,094</span>
                                </div>
                                <!--end::Statistics-->
                                <!--begin::Description-->
                                <span class="fs-6 fw-semibold text-color-secondary">Another $48,346 to Goal</span>
                                <!--end::Description-->
                            </div>
                            <!--end::Statistics-->
                            <!--begin::Chart-->
                            <div id="kt_charts_widget_3" class="min-h-auto ps-4 pe-6" style="height: 300px">
                            </div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Chart widget 3-->
                </div>
            </div>
            <!--begin::Col-->
            <div class="col-xl-12 mb-5 mb-xl-10">
                <!--begin::Table Widget 4-->
                <div class="card card-flush h-xl-100">
                    <!--begin::Card header-->
                    <div class="card-header pt-7">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Product Orders</span>
                            <span class="text-color-secondary mt-1 fw-semibold fs-6">Avg. 57 orders per day</span>
                        </h3>
                        <!--end::Title-->
                        <!--begin::Actions-->
                        <div class="card-toolbar">
                            <!--begin::Filters-->
                            <div class="d-flex flex-stack flex-wrap gap-4">
                                <!--begin::Destination-->
                                <div class="d-flex align-items-center fw-bold">
                                    <!--begin::Label-->
                                    <div class="text-color-secondary fs-7 me-2">Cateogry</div>
                                    <!--end::Label-->
                                    <!--begin::Select-->
                                    <select
                                        class="form-select form-select-transparent text-graY-800 fs-base lh-1 fw-bold py-0 ps-3 w-auto"
                                        data-control="select2" data-hide-search="true"
                                        data-dropdown-css-class="w-150px" data-placeholder="Select an option">
                                        <option></option>
                                        <option value="Show All" selected="selected">Show All</option>
                                        <option value="a">Category A</option>
                                        <option value="b">Category A</option>
                                    </select>
                                    <!--end::Select-->
                                </div>
                                <!--end::Destination-->
                                <!--begin::Status-->
                                <div class="d-flex align-items-center fw-bold">
                                    <!--begin::Label-->
                                    <div class="text-color-secondary fs-7 me-2">Status</div>
                                    <!--end::Label-->
                                    <!--begin::Select-->
                                    <select
                                        class="form-select form-select-transparent text-color fs-7 lh-1 fw-bold py-0 ps-3 w-auto"
                                        data-control="select2" data-hide-search="true"
                                        data-dropdown-css-class="w-150px" data-placeholder="Select an option"
                                        data-kt-table-widget-4="filter_status">
                                        <option></option>
                                        <option value="Show All" selected="selected">Show All</option>
                                        <option value="Shipped">Shipped</option>
                                        <option value="Confirmed">Confirmed</option>
                                        <option value="Rejected">Rejected</option>
                                        <option value="Pending">Pending</option>
                                    </select>
                                    <!--end::Select-->
                                </div>
                                <!--end::Status-->
                                <!--begin::Search-->
                                <div class="position-relative my-1">
                                    <i
                                        class="ki-outline ki-magnifier fs-2 position-absolute top-50 translate-middle-y ms-4"></i>
                                    <input type="text" data-kt-table-widget-4="search"
                                        class="form-control w-150px fs-7 ps-12" placeholder="Search" />
                                </div>
                                <!--end::Search-->
                            </div>
                            <!--begin::Filters-->
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-2">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_4_table">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-color-secondary fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px">Order ID</th>
                                    <th class="text-end min-w-100px">Created</th>
                                    <th class="text-end min-w-125px">Customer</th>
                                    <th class="text-end min-w-100px">Total</th>
                                    <th class="text-end min-w-100px">Profit</th>
                                    <th class="text-end min-w-50px">Status</th>
                                    <th class="text-end"></th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-bold text-gray-600">
                                <tr data-kt-table-widget-4="subtable_template" class="d-none">
                                    <td colspan="2">
                                        <div class="d-flex align-items-center gap-3">
                                            <a href="#"
                                                class="symbol symbol-50px bg-secondary bg-opacity-25 rounded">
                                                <img src="" data-kt-src-path="assets/media/stock/ecommerce/"
                                                    alt="" data-kt-table-widget-4="template_image" />
                                            </a>
                                            <div class="d-flex flex-column text-muted">
                                                <a href="#" class="text-gray-800 text-hover-primary fw-bold"
                                                    data-kt-table-widget-4="template_name">Product name</a>
                                                <div class="fs-7" data-kt-table-widget-4="template_description">
                                                    Product description</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="text-gray-800 fs-7">Cost</div>
                                        <div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_cost">
                                            1 </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="text-gray-800 fs-7">Qty</div>
                                        <div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_qty">1
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="text-gray-800 fs-7">Total</div>
                                        <div class="text-muted fs-7 fw-bold"
                                            data-kt-table-widget-4="template_total"> name</div>
                                    </td>
                                    <td class="text-end">
                                        <div class="text-gray-800 fs-7 me-3">On hand</div>
                                        <div class="text-muted fs-7 fw-bold"
                                            data-kt-table-widget-4="template_stock"> 32</div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                            class="text-gray-800 text-hover-primary">#XGY-346</a>
                                    </td>
                                    <td class="text-end">7 min ago</td>
                                    <td class="text-end">
                                        <a href="#" class="text-gray-600 text-hover-primary">Albert Flores</a>
                                    </td>
                                    <td class="text-end">$630.00</td>
                                    <td class="text-end">
                                        <span class="text-gray-800 fw-bolder">$86.70</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="badge py-3 px-4 fs-7 badge-light-warning">Pending</span>
                                    </td>
                                    <td class="text-end">
                                        <button type="button"
                                            class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                            data-kt-table-widget-4="expand_row">
                                            <i class="ki-outline ki-plus fs-4 m-0 toggle-off"></i>
                                            <i class="ki-outline ki-minus fs-4 m-0 toggle-on"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                            class="text-gray-800 text-hover-primary">#YHD-047</a>
                                    </td>
                                    <td class="text-end">52 min ago</td>
                                    <td class="text-end">
                                        <a href="#" class="text-gray-600 text-hover-primary">Jenny Wilson</a>
                                    </td>
                                    <td class="text-end">$25.00</td>
                                    <td class="text-end">
                                        <span class="text-gray-800 fw-bolder">$4.20</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="badge py-3 px-4 fs-7 badge-light-primary">Confirmed</span>
                                    </td>
                                    <td class="text-end">
                                        <button type="button"
                                            class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                            data-kt-table-widget-4="expand_row">
                                            <i class="ki-outline ki-plus fs-4 m-0 toggle-off"></i>
                                            <i class="ki-outline ki-minus fs-4 m-0 toggle-on"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                            class="text-gray-800 text-hover-primary">#SRR-678</a>
                                    </td>
                                    <td class="text-end">1 hour ago</td>
                                    <td class="text-end">
                                        <a href="#" class="text-gray-600 text-hover-primary">Robert Fox</a>
                                    </td>
                                    <td class="text-end">$1,630.00</td>
                                    <td class="text-end">
                                        <span class="text-gray-800 fw-bolder">$203.90</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="badge py-3 px-4 fs-7 badge-light-warning">Pending</span>
                                    </td>
                                    <td class="text-end">
                                        <button type="button"
                                            class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                            data-kt-table-widget-4="expand_row">
                                            <i class="ki-outline ki-plus fs-4 m-0 toggle-off"></i>
                                            <i class="ki-outline ki-minus fs-4 m-0 toggle-on"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                            class="text-gray-800 text-hover-primary">#PXF-534</a>
                                    </td>
                                    <td class="text-end">3 hour ago</td>
                                    <td class="text-end">
                                        <a href="#" class="text-gray-600 text-hover-primary">Cody Fisher</a>
                                    </td>
                                    <td class="text-end">$119.00</td>
                                    <td class="text-end">
                                        <span class="text-gray-800 fw-bolder">$12.00</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
                                    </td>
                                    <td class="text-end">
                                        <button type="button"
                                            class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                            data-kt-table-widget-4="expand_row">
                                            <i class="ki-outline ki-plus fs-4 m-0 toggle-off"></i>
                                            <i class="ki-outline ki-minus fs-4 m-0 toggle-on"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                            class="text-gray-800 text-hover-primary">#XGD-249</a>
                                    </td>
                                    <td class="text-end">2 day ago</td>
                                    <td class="text-end">
                                        <a href="#" class="text-gray-600 text-hover-primary">Arlene McCoy</a>
                                    </td>
                                    <td class="text-end">$660.00</td>
                                    <td class="text-end">
                                        <span class="text-gray-800 fw-bolder">$52.26</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
                                    </td>
                                    <td class="text-end">
                                        <button type="button"
                                            class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                            data-kt-table-widget-4="expand_row">
                                            <i class="ki-outline ki-plus fs-4 m-0 toggle-off"></i>
                                            <i class="ki-outline ki-minus fs-4 m-0 toggle-on"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                            class="text-gray-800 text-hover-primary">#SKP-035</a>
                                    </td>
                                    <td class="text-end">2 day ago</td>
                                    <td class="text-end">
                                        <a href="#" class="text-gray-600 text-hover-primary">Eleanor Pena</a>
                                    </td>
                                    <td class="text-end">$290.00</td>
                                    <td class="text-end">
                                        <span class="text-gray-800 fw-bolder">$29.00</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="badge py-3 px-4 fs-7 badge-light-danger">Rejected</span>
                                    </td>
                                    <td class="text-end">
                                        <button type="button"
                                            class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                            data-kt-table-widget-4="expand_row">
                                            <i class="ki-outline ki-plus fs-4 m-0 toggle-off"></i>
                                            <i class="ki-outline ki-minus fs-4 m-0 toggle-on"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                            class="text-gray-800 text-hover-primary">#SKP-567</a>
                                    </td>
                                    <td class="text-end">7 min ago</td>
                                    <td class="text-end">
                                        <a href="#" class="text-gray-600 text-hover-primary">Dan Wilson</a>
                                    </td>
                                    <td class="text-end">$590.00</td>
                                    <td class="text-end">
                                        <span class="text-gray-800 fw-bolder">$50.00</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
                                    </td>
                                    <td class="text-end">
                                        <button type="button"
                                            class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                            data-kt-table-widget-4="expand_row">
                                            <i class="ki-outline ki-plus fs-4 m-0 toggle-off"></i>
                                            <i class="ki-outline ki-minus fs-4 m-0 toggle-on"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Table Widget 4-->
            </div>
            <!--end::Col-->
        </div>
    </div>
</x-app-layout>

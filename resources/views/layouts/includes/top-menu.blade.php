<!--begin::Header-->
<div id="kt_header" class="header header-fixed  d-print-none">
    <!--begin::Container-->
    <div class="container d-flex align-items-stretch justify-content-between">
        <!--begin::Left-->
        <div class="d-flex align-items-stretch mr-3">
            <!--begin::Header Logo-->
            <div class="header-logo">
                <a href="{{url('dashboard')}}">
                    <img alt="Logo" src="{{ asset('/image/uz_crm_white.png') }}" class="logo-default max-h-40px" />
                    <img alt="Logo" src="{{ asset('/image/uz_crm.png') }}" class="logo-sticky max-h-40px" />
                </a>
            </div>
            <!--end::Header Logo-->

            @if (Auth::user()->is_admin || Auth::user()->role == 'staff')
                <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                    <!--begin::Header Menu-->
                    <div id="kt_header_menu"
                        class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
                        <!--begin::Header Nav-->
                        <ul class="menu-nav">

                            <li class="menu-item">
                                <a href="{{url('dashboard')}}" class="menu-link">
                                    <span class="menu-text">Dashboard</span>
                                </a>
                            </li>


                            <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click"
                                aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-text">Users</span>
                                    <span class="menu-desc"></span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                    <ul class="menu-subnav">

                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('leads')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Leads</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('client/leads')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Converted Leads</span>
                                            </a>
                                        </li>

                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('follow-up')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Lead follow up</span>
                                            </a>
                                        </li>

                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('clients')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Clients</span>
                                            </a>
                                        </li>

                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('suppliers')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Suppliers</span>
                                            </a>
                                        </li>
                                        @if (Auth::user()->role == 'staff')
                                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                                aria-haspopup="true">
                                                <a href="javascript:;" class="menu-link menu-toggle">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Portfolios</span>
                                                    <i class="menu-arrow"></i>
                                                </a>
                                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                                    <ul class="menu-subnav">
                                                        <li class="menu-item" aria-haspopup="true">
                                                            <a href="{{url('portfolio')}}" class="menu-link">
                                                                <i class="menu-bullet menu-bullet-dot">
                                                                    <span></span>
                                                                </i>
                                                                <span class="menu-text">Portfolio list </span>
                                                            </a>
                                                        </li>

                                                        <li class="menu-item" aria-haspopup="true">
                                                            <a href="{{url('portfolio/clients')}}" class="menu-link">
                                                                <i class="menu-bullet menu-bullet-dot">
                                                                    <span></span>
                                                                </i>
                                                                <span class="menu-text">Client Portfolios</span>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </li>
                                        @else
                                           
                                        @endif
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('corporate-actions')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Corporate Actions</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click"
                                aria-haspopup="true">
                                <a href="#" class="menu-link menu-toggle">
                                    <span class="menu-text">Accounting </span>
                                    <span class="menu-desc"></span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                    <ul class="menu-subnav">
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                <span class="svg-icon menu-icon">
                                                    <!--begin::Svg Icon -->
                                                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo2\dist/../src/media/svg/icons\Communication\Clipboard-check.svg--><svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24" />
                                                                <path
                                                                    d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                                                    fill="#000000" opacity="0.3" />
                                                                <path
                                                                    d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z"
                                                                    fill="#000000" />
                                                                <path
                                                                    d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                                                    fill="#000000" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-text">Invoices</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                                <ul class="menu-subnav">
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="{{url('invoices/create')}}" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Create Invoice</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="{{url('invoices')}}" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">List Invoices</span>
                                                        </a>
                                                    </li>

                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="{{url('items')}}" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Invoice Items</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                <span class="svg-icon menu-icon">
                                                    <!--begin::Svg Icon -->
                                                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo2\dist/../src/media/svg/icons\Communication\Clipboard-check.svg--><svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24" />
                                                                <path
                                                                    d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z"
                                                                    fill="#000000" opacity="0.3"
                                                                    transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) " />
                                                                <path
                                                                    d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z"
                                                                    fill="#000000" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-text">Expenses</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                                <ul class="menu-subnav">
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="{{url('expense/add')}}" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Create Expenses</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="{{url('expense')}}" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">List Expenses</span>
                                                        </a>
                                                    </li>

                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="{{url('expense/categories')}}" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Expense Categories</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                            aria-haspopup="true">
                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                <span class="svg-icon menu-icon">
                                                    <!--begin::Svg Icon -->
                                                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo2\dist/../src/media/svg/icons\Communication\Clipboard-check.svg--><svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24" />
                                                                <rect fill="#000000" opacity="0.3" x="7"
                                                                    y="4" width="10" height="4" />
                                                                <path
                                                                    d="M7,2 L17,2 C18.1045695,2 19,2.8954305 19,4 L19,20 C19,21.1045695 18.1045695,22 17,22 L7,22 C5.8954305,22 5,21.1045695 5,20 L5,4 C5,2.8954305 5.8954305,2 7,2 Z M8,12 C8.55228475,12 9,11.5522847 9,11 C9,10.4477153 8.55228475,10 8,10 C7.44771525,10 7,10.4477153 7,11 C7,11.5522847 7.44771525,12 8,12 Z M8,16 C8.55228475,16 9,15.5522847 9,15 C9,14.4477153 8.55228475,14 8,14 C7.44771525,14 7,14.4477153 7,15 C7,15.5522847 7.44771525,16 8,16 Z M12,12 C12.5522847,12 13,11.5522847 13,11 C13,10.4477153 12.5522847,10 12,10 C11.4477153,10 11,10.4477153 11,11 C11,11.5522847 11.4477153,12 12,12 Z M12,16 C12.5522847,16 13,15.5522847 13,15 C13,14.4477153 12.5522847,14 12,14 C11.4477153,14 11,14.4477153 11,15 C11,15.5522847 11.4477153,16 12,16 Z M16,12 C16.5522847,12 17,11.5522847 17,11 C17,10.4477153 16.5522847,10 16,10 C15.4477153,10 15,10.4477153 15,11 C15,11.5522847 15.4477153,12 16,12 Z M16,16 C16.5522847,16 17,15.5522847 17,15 C17,14.4477153 16.5522847,14 16,14 C15.4477153,14 15,14.4477153 15,15 C15,15.5522847 15.4477153,16 16,16 Z M16,20 C16.5522847,20 17,19.5522847 17,19 C17,18.4477153 16.5522847,18 16,18 C15.4477153,18 15,18.4477153 15,19 C15,19.5522847 15.4477153,20 16,20 Z M8,18 C7.44771525,18 7,18.4477153 7,19 C7,19.5522847 7.44771525,20 8,20 L12,20 C12.5522847,20 13,19.5522847 13,19 C13,18.4477153 12.5522847,18 12,18 L8,18 Z M7,4 L7,8 L17,8 L17,4 L7,4 Z"
                                                                    fill="#000000" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-text">Taxes</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                                <ul class="menu-subnav">
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="{{url('gst-input')}}" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">GST Input</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="{{url('tax-summary')}}" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">GST Output</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="{{url('tds')}}" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">TDS</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="menu-item">
                                <a href="{{url('knowledgecenter')}}" class="menu-link">
                                    <span class="menu-text">Knowledge Center</span>
                                </a>
                            </li>

                            <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click"
                                aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-text">Settings</span>
                                    <span class="menu-desc"></span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                    <ul class="menu-subnav">
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('settings#user_profile_tab')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">General Settings</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('settings#business_info')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Business Settings</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('settings#layout_settings')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Invoice Settings</span>
                                            </a>
                                        </li>

                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('settings#taxes')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Tax Settings</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('settings#payment_gateways_tab')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Payment Gateway
                                                    Settings</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('settings#new_invoice_template')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Email Settings</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>


                            @if (Auth::check() && Auth::user()->is_admin)


                                <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click"
                                    aria-haspopup="true">
                                    <a href="javascript:;" class="menu-link menu-toggle">
                                        <span class="menu-text">Price List</span>
                                        <span class="menu-desc"></span>
                                        <i class="menu-arrow"></i>
                                    </a>
                                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                        <ul class="menu-subnav">
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{url('companies/price-list')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Price</span>
                                                </a>
                                            </li>
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{url('companies/export-prices')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Export Price list</span>
                                                </a>
                                            </li>
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{url('companies/export-dealer-prices')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Export Dealer Price list</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click"
                                    aria-haspopup="true">
                                    <a href="javascript:;" class="menu-link menu-toggle">
                                        <span class="menu-text">Admin</span>
                                        <span class="menu-desc"></span>
                                        <i class="menu-arrow"></i>
                                    </a>
                                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                        <ul class="menu-subnav">
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{url('users')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">User Management</span>
                                                </a>
                                            </li>


                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{url('companies')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Company Management</span>
                                                </a>
                                            </li>

                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{url('partners')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Partners Management</span>
                                                </a>
                                            </li>
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{url('ipo-shares')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">IPO Shares</span>
                                                </a>
                                            </li>
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{url('recommended-stocks')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Value Stocks
                                                    </span>
                                                </a>
                                            </li>

                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{url('inventories')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Inventory Management</span>
                                                </a>
                                            </li>

                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{url('broker')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Brokers Commission</span>
                                                </a>
                                            </li>


                                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                                aria-haspopup="true">
                                                <a href="javascript:;" class="menu-link menu-toggle">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Clients</span>
                                                    <i class="menu-arrow"></i>
                                                </a>
                                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                                    <ul class="menu-subnav">
                                                        <li class="menu-item" aria-haspopup="true">
                                                            <a href="{{url('buyer')}}" class="menu-link">
                                                                <i class="menu-bullet menu-bullet-dot">
                                                                    <span></span>
                                                                </i>
                                                                <span class="menu-text">Buyer</span>
                                                            </a>
                                                        </li>
                                                        <li class="menu-item" aria-haspopup="true">
                                                            <a href="{{url('seller')}}" class="menu-link">
                                                                <i class="menu-bullet menu-bullet-dot">
                                                                    <span></span>
                                                                </i>
                                                                <span class="menu-text">Seller</span>
                                                            </a>
                                                        </li>
                                                        <li class="menu-item" aria-haspopup="true">
                                                            <a href="{{url('premium-clients')}}" class="menu-link">
                                                                <i class="menu-bullet menu-bullet-dot">
                                                                    <span></span>
                                                                </i>
                                                                <span class="menu-text">Premium Clients</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>

                                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                                aria-haspopup="true">
                                                <a href="javascript:;" class="menu-link menu-toggle">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Reports</span>
                                                    <i class="menu-arrow"></i>
                                                </a>
                                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                                    <ul class="menu-subnav">
                                                        <li class="menu-item" aria-haspopup="true">
                                                            <a href="{{url('quantitative-report')}}" class="menu-link">
                                                                <i class="menu-bullet menu-bullet-dot">
                                                                    <span></span>
                                                                </i>
                                                                <span class="menu-text">Quantitative </span>
                                                            </a>
                                                        </li>
                                                        @if (Auth::user()->role != 'account_manager')
                                                            <li class="menu-item" aria-haspopup="true">
                                                                <a href="{{url('qualitative-report')}}" class="menu-link">
                                                                    <i class="menu-bullet menu-bullet-dot">
                                                                        <span></span>
                                                                    </i>
                                                                    <span class="menu-text">Qualitative</span>
                                                                </a>
                                                            </li>
                                                        @endif

                                                    </ul>
                                                </div>
                                            </li>

                                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                                aria-haspopup="true">
                                                <a href="javascript:;" class="menu-link menu-toggle">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">NSE</span>
                                                    <i class="menu-arrow"></i>
                                                </a>
                                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                                    <ul class="menu-subnav">
                                                        <li class="menu-item" aria-haspopup="true">
                                                            <a href="{{url('nse-software/buy')}}" class="menu-link">
                                                                <i class="menu-bullet menu-bullet-dot">
                                                                    <span></span>
                                                                </i>
                                                                <span class="menu-text">Buy </span>
                                                            </a>
                                                        </li>

                                                        <li class="menu-item" aria-haspopup="true">
                                                            <a href="{{url('nse-software/sell')}}" class="menu-link">
                                                                <i class="menu-bullet menu-bullet-dot">
                                                                    <span></span>
                                                                </i>
                                                                <span class="menu-text">Sell</span>
                                                            </a>
                                                        </li>

                                                        <li class="menu-item" aria-haspopup="true">
                                                            <a href="{{url('nse-software/inventory')}}" class="menu-link">
                                                                <i class="menu-bullet menu-bullet-dot">
                                                                    <span></span>
                                                                </i>
                                                                <span class="menu-text">Inventory</span>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </li>

                                            <li class="menu-item menu-item-submenu" data-menu-toggle="hover"
                                                aria-haspopup="true">
                                                <a href="javascript:;" class="menu-link menu-toggle">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">SGI</span>
                                                    <i class="menu-arrow"></i>
                                                </a>
                                                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                                    <ul class="menu-subnav">
                                                        <li class="menu-item" aria-haspopup="true">
                                                            <a href="{{url('sgi-software/buy')}}" class="menu-link">
                                                                <i class="menu-bullet menu-bullet-dot">
                                                                    <span></span>
                                                                </i>
                                                                <span class="menu-text">Buy </span>
                                                            </a>
                                                        </li>

                                                        <li class="menu-item" aria-haspopup="true">
                                                            <a href="{{url('sgi-software/sell')}}" class="menu-link">
                                                                <i class="menu-bullet menu-bullet-dot">
                                                                    <span></span>
                                                                </i>
                                                                <span class="menu-text">Sell</span>
                                                            </a>
                                                        </li>

                                                        <li class="menu-item" aria-haspopup="true">
                                                            <a href="{{url('sgi-software/inventory')}}" class="menu-link">
                                                                <i class="menu-bullet menu-bullet-dot">
                                                                    <span></span>
                                                                </i>
                                                                <span class="menu-text">Inventory</span>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </li>


                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{url('allow-country')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Allow Countries</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>
                            @endif
                        </ul>
                        <!--end::Header Nav-->
                    </div>
                    <!--end::Header Menu-->
                </div>
            @elseif (Auth::user()->role == 'NSE User')
                <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                    <!--begin::Header Menu-->
                    <div id="kt_header_menu"
                        class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
                        <!--begin::Header Nav-->
                        <ul class="menu-nav">
                            <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click"
                                aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-text">NSE</span>
                                    <span class="menu-desc"></span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                    <ul class="menu-subnav">

                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('nse-software/buy')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Buy</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('nse-software/sell')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Sell</span>
                                            </a>
                                        </li>

                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('nse-software/inventory')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Inventory</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <!--end::Header Nav-->
                    </div>
                    <!--end::Header Menu-->
                </div>
            @elseif(Auth::user()->role != 'account_manager')
                <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                    <!--begin::Header Menu-->
                    <div id="kt_header_menu"
                        class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
                        <!--begin::Header Nav-->
                        <ul class="menu-nav">
                            <li class="menu-item">
                                <a href="{{url('dashboard')}}" class="menu-link">
                                    <span class="menu-text">Dashboard</span>
                                </a>
                            </li>
                            @if (Auth::user()->role == 'broker')
                                <li class="menu-item">
                                    <a href="{{url('my-clients')}}" class="menu-link">
                                        <span class="menu-text">Clients</span>
                                    </a>
                                </li>
                            @endif

                            <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click"
                                aria-haspopup="true">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="menu-text">Leads</span>
                                    <span class="menu-desc"></span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                    <ul class="menu-subnav">

                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('leads')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Leads</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{url('client/leads')}}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Converted Leads</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{url('portfolio/clients')}}" class="menu-link">
                                    <span class="menu-text">Client Portfolio</span>
                                </a>
                            </li>

                            <li class="menu-item">
                                <a href="{{url('knowledgecenter')}}" class="menu-link">
                                    <span class="menu-text">Knowledge Center</span>
                                </a>
                            </li>
                            @if (Auth::user()->role == 'broker')
                                <li class="menu-item">
                                    <a href="{{url('dealer-prices')}}" class="menu-link">
                                        <span class="menu-text">Dealer Price</span>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a target="_blank" href="https://www.youtube.com/watch?v=LuresjI4clM"
                                        class="menu-link">
                                        <span class="menu-text">Video Tutorials</span>
                                    </a>
                                </li>
                                @if (Auth::user()->broker_affiliate_code != '')
                                    <li class="menu-item">
                                        <a href="#" class="menu-link">
                                            <span
                                                data-id="https://crm.hottel.in/customer/aff/{{ Auth::user()->broker_affiliate_code }}"
                                                class="copy-affiliate-url-dashboard cursor-pointer label font-weight-bold label-lg  label-light-success label-inline">Affiliate
                                                Link</span>
                                        </a>
                                    </li>
                                @endif
                            @endif

                            @if (Auth::user()->role == 'employee')
                                <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click"
                                    aria-haspopup="true">
                                    <a href="javascript:;" class="menu-link menu-toggle">
                                        <span class="menu-text">Clients</span>
                                        <span class="menu-desc"></span>
                                        <i class="menu-arrow"></i>
                                    </a>
                                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                        <ul class="menu-subnav">
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{url('buyer')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Buyer</span>
                                                </a>
                                            </li>

                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{url('seller')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Seller</span>
                                                </a>
                                            </li>
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{url('premium-clients')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Premium Clients</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>

                                <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click"
                                    aria-haspopup="true">
                                    <a href="javascript:;" class="menu-link menu-toggle">
                                        <span class="menu-text">NSE</span>
                                        <span class="menu-desc"></span>
                                        <i class="menu-arrow"></i>
                                    </a>
                                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                        <ul class="menu-subnav">
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{url('nse-software/buy')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Buy</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click"
                                    aria-haspopup="true">
                                    <a href="javascript:;" class="menu-link menu-toggle">
                                        <span class="menu-text">SGI</span>
                                        <span class="menu-desc"></span>
                                        <i class="menu-arrow"></i>
                                    </a>
                                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                        <ul class="menu-subnav">
                                            <li class="menu-item" aria-haspopup="true">
                                                <a href="{{url('sgi-software/buy')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Buy</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="menu-item">
                                    <a href="{{url('follow-up')}}" class="menu-link">
                                        <span class="menu-text">Follow up</span>
                                    </a>
                                </li>
                            @endif


                        </ul>
                        <!--end::Header Nav-->
                    </div>
                    <!--end::Header Menu-->
                </div>
            @else
                <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                    <!--begin::Header Menu-->
                    <div id="kt_header_menu"
                        class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
                        <!--begin::Header Nav-->
                        <ul class="menu-nav">
                            <li class="menu-item">
                                <a href="{{url('dashboard')}}" class="menu-link">
                                    <span class="menu-text">Dashboard</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{url('client/leads')}}" class="menu-link">
                                    <span class="menu-text">Closed Leads</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{url('broker')}}" class="menu-link">
                                    <span class="menu-text">Brokers Commission</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{url('inventories')}}" class="menu-link">
                                    <span class="menu-text">Inventory Management</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{url('quantitative-report')}}" class="menu-link">
                                    <span class="menu-text">Reports</span>
                                </a>
                            </li>
                        </ul>
                        <!--end::Header Nav-->
                    </div>
                    <!--end::Header Menu-->
                </div>
            @endif

        </div>
        <!--end::Left-->
        <!--begin::Topbar-->
        <div class="topbar">
            <!--begin::Search-->
            <div class="dropdown">
                <!--begin::Dropdown-->
                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                    <div class="quick-search quick-search-dropdown" id="kt_quick_search_dropdown">
                        <!--begin:Form-->
                        <form method="get" class="quick-search-form">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <span class="svg-icon svg-icon-lg">
                                            <!--begin::Svg Icon | path:/assets/media/svg/icons/General/Search.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none"
                                                    fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24"
                                                        height="24" />
                                                    <path
                                                        d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                                        fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                    <path
                                                        d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                                        fill="#000000" fill-rule="nonzero" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Search..." />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="quick-search-close ki ki-close icon-sm text-muted"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                        <!--begin::Scroll-->
                        <div class="quick-search-wrapper scroll" data-scroll="true" data-height="325"
                            data-mobile-height="200"></div>
                        <!--end::Scroll-->
                    </div>
                </div>
                <!--end::Dropdown-->

                <!--begin::Notifications-->


                <!--end::Notifications-->

            </div>


            <!--end::Search-->
            <!--begin::User-->
            @include('layouts.includes.userheader')
            <!--end::User-->
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>
<!--end::Header-->

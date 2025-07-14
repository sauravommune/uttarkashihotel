<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hottel') }}</title>
    
    <meta name="robots" content="noindex, nofollow">


    <meta charset="utf-8" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.svg') }}" />

    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    @foreach (getGlobalAssets('css') as $path)
        {!! sprintf(
            '
            <link rel="stylesheet" href="%s">',
            asset($path),
        ) !!}
    @endforeach
    <!--end::Global Stylesheets Bundle-->

    <!--begin::Vendor Stylesheets(used by this page)-->
    @foreach (getVendors('css') as $path)
        {!! sprintf(
            '
            <link rel="stylesheet" href="%s">',
            asset($path),
        ) !!}
    @endforeach
    <!--end::Vendor Stylesheets-->

    <!--begin::Custom Stylesheets(optional)-->
    @foreach (getCustomCss() as $path)
        {!! sprintf(
            '
            <link rel="stylesheet" href="%s">',
            asset($path),
        ) !!}
    @endforeach
    <!--end::Custom Stylesheets-->

    @stack('styles')


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .flatpickr-monthSelect-month {
            margin: 0;
        }
    </style>

</head>

<body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-aside-enabled="false"
    data-kt-app-aside-fixed="false" data-kt-app-aside-push-toolbar="false" data-kt-app-aside-push-footer="true"
    class="app-default">

    <!--begin::Theme mode setup on page load-->
    <script>
        "use strict";
        var sidebar_collapse = localStorage.getItem("sidebar_collapse") ?? "off";
        if (sidebar_collapse == 'on') {
            document.querySelector('body').setAttribute('data-kt-app-sidebar-minimize', sidebar_collapse);
        }
        var base_url = "{{ url('/') }}";
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <div id="overlay" class="overlay" style="display: none;"></div>
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

            @include('layouts.header')

            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">

                @include('layouts.navigation')

                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">

                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        <!--begin::Content-->
                        {{ $slot }}
                        <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->
                    <x-footer />
                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-outline ki-arrow-up"></i>
    </div>
    <!--end::Scrolltop-->
    <section class="modal-section">
        <div class="modal fade" id="global_modal" data-bs-backdrop="static" data-bs-focus="false" >
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Title</h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-success ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-2x">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    @foreach (getGlobalAssets('js') as $path)
        {!! sprintf('<script src="%s"></script>', asset($path)) !!}
    @endforeach
    <!--end::Global Javascript Bundle-->

    <!--begin::Vendors Javascript(used by this page)-->
    @foreach (getVendors('js') as $path)
        {!! sprintf('<script src="%s"></script>', asset($path)) !!}
    @endforeach
    <!--end::Vendors Javascript-->

    <!--begin::Custom Javascript(optional)-->
    @foreach (getCustomJs() as $path)
        {!! sprintf('<script src="%s"></script>', asset($path)) !!}
    @endforeach

    <!--end::Custom Javascript-->
    @stack('scripts')

    @if (session('success'))
        <script>
            "use strict";
            Swal.fire({
                text: "{{ session('success') }}",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Okay!",
                customClass: {
                    confirmButton: "btn btn-success"
                }
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            sAlert('error', "{{ session('error') }}");
        </script>
    @endif

    <script>

        $('body').on('click', '#kt_app_sidebar_toggle', function() {
            let body_attr = $('body').attr('data-kt-app-sidebar-minimize');
            if (body_attr != 'on') {
                sidebar_collapse = 'off';
                localStorage.setItem("sidebar_collapse", sidebar_collapse);
            } else {
                sidebar_collapse = 'on';
                localStorage.setItem("sidebar_collapse", sidebar_collapse);
            }
        });

        flatpickr(".flatpicker", {
            dateFormat: "Y-m-d",  // Custom date format
            altInput: true,
            altFormat: "d-m-Y",
            // minDate: "today",  // Disable past dates
        });
    </script>

    @include('tax-calculator.calculator')

</body>

</html>

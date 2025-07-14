<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.includes.head')
<!--begin::Body-->

<body id="kt_body" style="background-image: url( {{url('assets/media/header-bg.jpg')}} )"
    class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">
    <!--begin::Main-->
    {{-- <div id="whatsappbutton" class="hide-print"></div> --}}
    <div id="g_id_onload" data-client_id="{{ env('ONE_TAP_GOOGLE_CLIENT_ID') }}" data-login_uri="{{ url('one-tap-login') }}">
    </div>
    @yield('main')
    <!--end::Main-->

    @include('auth.includes.footer')
</body>
<!--end::Body-->

</html>
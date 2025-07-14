<!--begin::Head-->

<head>
    <base href="">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description"
        content="A platform where you can buy and sell unlisted shares of unlisted companies and startups of India." />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->

    <!--begin::Global Theme Styles-->
    <link href="{{ asset('/assets/global/plugins.bundle.css?v=7.0.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/prismjs.bundle.css?v=7.0.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/style.bundle.css?v=7.0.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/floating-whatsapp-master/floating-wpp.css') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!--end::Global Theme Styles-->

    <link rel="shortcut icon" href="{{ asset('/') }}assets/media/favicon.svg" />

    <!--begin::Page Custom Styles(used by this page)-->
    @yield('page_styles')
    <!--end::Page Custom Styles-->
</head>
<!--end::Head-->
<!DOCTYPE html>
<html lang="en">
<head>
    
    <!-- End Google Tag Manager -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="HandheldFriendly" content="True" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.svg') }}" />
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/flatpickr.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/select2.min.css') }}?" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/select2-bootstrap-5-theme.min.css') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet">

    
    <link href="{{ asset('assets/front/css/main-style.css') }}?v={{ filemtime(public_path('assets/front/css/main-style.css')) }}" rel="stylesheet">
</head>

<body data-instant-intensity="mousedown">

    
    @include('front.layouts.header')
     <section class="section-40 py-xl-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <div class="section-title">
                            <h2>External Hotels</h2>
                        </div>
                        <div>
                            <a class="btn btn-outline-primary" href="{{ route('secret.page') }}"><span class="icon-plus"></span> Add New Hotel</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5">
                    <div class="">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('front.layouts.footer')

    <script src="{{ asset('assets/front/js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/front/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js" ></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js" ></script>
    <script src="{{ asset('assets/js/app.custom.js') }}?v={{ filemtime(public_path('assets/js/app.custom.js')) }}"></script>
    

        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        @if(session('error'))
        toastr.error('{{ session('
            error ') }}', {
                positionClass: 'toast-top-right'
                , closeButton: true
                , progressBar: true
            });
        @endif
        @if(session('success'))
        toastr.success('{{ session('
            success ') }}', {
                positionClass: 'toast-top-right'
                , closeButton: true
                , progressBar: true
            });
        @endif

    </script>


    @yield('scripts')
</body>

</html>

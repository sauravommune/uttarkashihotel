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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link href="{{ asset('assets/front/css/main-style.css') }}?v={{ filemtime(public_path('assets/front/css/main-style.css')) }}" rel="stylesheet">
</head>

<body data-instant-intensity="mousedown">

    
    @include('front.layouts.header')
    <main>
        <section class="section-39 py-xl-5 py-4">
            <div class="container">
                <div class="row">
                    @if(session()->has('message'))
                    <div class="alert alert-success mt-2" role="alert">
                        {{session('message')}}
                    </div>
                    @endif
                    @if(session()->has('error'))
                    <div class="alert alert-error mt-2" role="alert">
                        {{session('error')}}
                    </div>
                    @endif
                    <div class="col-12 mt-4">
                        <h5> Enter Password to Unlock Page </h5>
                        <div class="form-section">
                            <form action="{{route('page.unlock')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6  mb-3">
                                        <label for="exampleInputName" class="form-label">Password</label>
                                        <input type="text" class="form-control" id="exampleInputName" aria-describedby="NamelHelp" name="password" >
                                        @error('password')
                                           <p class ="text-sm text-danger"> {{$message}}
                                        @enderror
                                    </div>

                                </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4  mb-3">
                                        <button type="submit" class="btn btn-secondary">Unlock</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
        </section>



    </main>
    @include('front.layouts.footer')

    <script src="{{ asset('assets/front/js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/front/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/instantpages.5.1.0.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/lazyload.17.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/slick.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/custom.js') }}?v={{ filemtime(public_path('assets/front/js/custom.js')) }}"></script>
    <script src="{{ asset('assets/js/app.custom.js') }}?v={{ filemtime(public_path('assets/js/app.custom.js')) }}"></script>
    <script src="{{ asset('assets/front/js/booking.js') }}?v={{ filemtime(public_path('assets/front/js/booking.js')) }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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

    <script>
        $(document).ready(function() {
            $('#getLocation').on('click', function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition, showError);
                } else {
                    $('#location').html("Geolocation is not supported by this browser.");
                }
            });

            function showPosition(position) {
                $('#location').removeClass('d-none');
                $('input[name=latitude]').val(position.coords.latitude);
                $('input[name=longitude]').val(position.coords.longitude);
                $('#location').removeClass('d-none');
                $('#location').html(
                    "Latitude: " + position.coords.latitude +
                    "<br>Longitude: " + position.coords.longitude
                );
            }

            function showError(error) {
                alert("Sorry, no position available.");
            }
        });

    </script>


    @yield('scripts')
</body>

</html>

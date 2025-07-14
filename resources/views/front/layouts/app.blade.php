<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-MXFSRSSH');</script>
		<!-- End Google Tag Manager -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="HandheldFriendly" content="True" />

		@php
			$canonicalUrl = url()->current();
			if (!str_ends_with($canonicalUrl, '/')) {
				$canonicalUrl .= '/';
			}
		@endphp

		<link rel="canonical" href="{{ $canonicalUrl }}" />

		@php
			$currentRouteName = request()->route()->getName();
		@endphp

            @if($currentRouteName =='hotel.addDetails'||$currentRouteName =='add_booking_multiple' || $currentRouteName =='login.request' || $currentRouteName =='password.request')
           <meta name="robots" content="noindex, nofollow">
		   @endif


		@if( $currentRouteName == 'searchResult' )
			<title>{{ !empty($meta['title']) ? $meta['title'] : "Top 10 Hotels in ". request('city')??'' ." for Family and Couples"}}</title>
			<meta name="description" content="{{ !empty($meta['description']) ? $meta['description'] : "Discover the top 10 hotels in ". request('city') ." perfect for family vacations and couples’ getaways. Explore budget and luxury stays near popular places!" }}" />
		@elseif( $currentRouteName == 'hotel.details' )
			<title>{{ !empty($meta['title']) ? $meta['title'] : ""}}</title>
			<meta name="description" content="{{ !empty($meta['description']) ? $meta['description'] : "" }}" />
		@else
			<title>{{ $meta['title']??'Find and Book the Best Uttarkashi Hotels on UttarkashiHotel.in' }}</title>
			<meta name="description" content="{{$meta['description']??'Planning a trip to Uttarkashi? Discover and book top Uttarkashi Hotels online with UttarkashiHotel.in – your one-stop destination for quality stays in Uttarkashi.'}}" />
		@endif

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
		{!! RecaptchaV3::initJs() !!}
	</head>

	<body data-instant-intensity="mousedown">

		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MXFSRSSH"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->

		@include('front.layouts.header')
		<main>
			@yield('content')
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
			var base_url = "{{ url('/') }}";
			$(document).ready(function () {
    
				$(".login-modal").click(function () {
					// Open the login modal
					$("#loginModel").modal('show');
					
					// Adjust navbar styling
					$(".fixed-top").css("transition", "unset");
					
					// Hide the offcanvas menu and its related classes
					$('.offcanvas').removeClass('show');
					$('.offcanvas-backdrop').removeClass('show');
					$('body').removeClass('offcanvas-open'); // Ensure correct class name

					// Check if offcanvas is hidden and unset body overflow
					if (!$('.offcanvas').hasClass('show')) {
						
					}
				});

				// Restore styles when the login modal is closed
				$("#loginModel").on('hidden.bs.modal', function () {
					$(".body").css("overflow", "unnset");
				});

				// Restore styles when the forgot password modal is closed
				$("#forgotPasswordModel").on('hidden.bs.modal', function () {
				});
			});
			
				
			document.getElementById('toggle_password').addEventListener('click', function() {
				const passwordInput = document.getElementById('password');
				const isPassword = passwordInput.getAttribute('type') === 'password';

				passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
				this.textContent = isPassword ? 'visibility' : 'visibility_off';
			});

			document.getElementById('togglePasswordreg').addEventListener('click', function() {
				const passwordInput = document.getElementById('regpassword');
				const isPassword = passwordInput.getAttribute('type') === 'password';

				passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
				this.textContent = isPassword ? 'visibility' : 'visibility_off';
			});

			document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
				const passwordInput = document.getElementById('confirmPassword');
				const isPassword = passwordInput.getAttribute('type') === 'password';

				passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
				this.textContent = isPassword ? 'visibility' : 'visibility_off';
			});
			
			document.addEventListener('DOMContentLoaded', function () {
				const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
				tooltipTriggerList.map(function (tooltipTriggerEl) {
					return new bootstrap.Tooltip(tooltipTriggerEl);
				});
			});

			if( $('.global-select').length > 0 ){
				$('.global-select').select2( {
					theme: "bootstrap-5",
					width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
					placeholder: $( this ).data( 'placeholder' ),
					dropdownCssClass: 'custom-dropdown-class',  // Add custom class to the dropdown
					containerCssClass: 'custom-container-class'
				});
			}

			@if (session('error'))
				toastr.error('{{ session('error') }}',{ 
					positionClass: 'toast-top-right',
					closeButton: true, 
					progressBar: true
				});
			@endif
			@if (session('success'))
				toastr.success('{{ session('success') }}',{ 
					positionClass: 'toast-top-right',
					closeButton: true, 
					progressBar: true
				});
			@endif
		</script>

		@yield('scripts')
	</body>

</html>
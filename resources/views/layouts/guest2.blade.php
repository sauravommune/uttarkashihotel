<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

		<meta name="description" content="A platform where you can buy and sell unlisted shares of unlisted companies and startups of India." />
		<meta name="keywords" content="unlisted shares" />

        <title>{{ config('app.name', 'Hottel') }}</title>

        {{-- favicon --}}
		<link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.png') }}" />

		{{-- fonts & family --}}
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

		{{-- begin::Global Stylesheets Bundle(mandatory for all pages) --}}
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->

		<script>
            var base_url = "{{ url('/') }}";
            var defaultThemeMode = "light";
            var themeMode;
            if ( document.documentElement ) {
                if ( document.documentElement.hasAttribute("data-bs-theme-mode")) {
                    themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
                } else {
                    if ( localStorage.getItem("data-bs-theme") !== null ) {
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
    </head>

    <body id="kt_body" class="app-blank">
        <!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Logo-->
				<a href="../../demo39/dist/index.html" class="d-block d-lg-none mx-auto py-20">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
				</a>
				<!--end::Logo-->
				<!--begin::Aside-->
				<div class="d-flex flex-column flex-column-fluid flex-center w-lg-50 px-10">
					<!--begin::Wrapper-->
					<div class="d-flex justify-content-between flex-column-fluid flex-column w-100 mw-450px">
						<!--begin::Header-->
						<div class="d-flex flex-stack py-2">
							<!--begin::Back link-->
							<div class="me-2"></div>
							<!--end::Back link-->
							<!--begin::Sign Up link-->
							{{-- <div class="m-0">
								<span class="text-gray-400 fw-bold fs-5 me-2" data-kt-translate="sign-in-head-desc">Not a Member yet?</span>
								<a href="../../demo39/dist/authentication/layouts/fancy/sign-up.html" class="link-primary fw-bold fs-5" data-kt-translate="sign-in-head-link">Sign Up</a>
							</div> --}}
							<!--end::Sign Up link=-->
						</div>
						<!--end::Header-->
						<!--begin::Body-->
						<div class="py-10 my-auto">
							<!--begin::Form-->
							{{ $slot }}
							<!--end::Form-->
						</div>
						<!--end::Body-->

					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Aside-->
				<!--begin::Body-->
				<div class="d-none d-lg-flex flex-lg-row-fluid w-50 bgi-size-cover bgi-position-y-center bgi-position-x-start bgi-no-repeat" style="background-image: url({{ asset('assets/media/bg11.jpg') }})"></div>
				<!--begin::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>


        <!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
        <script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('assets/js/custom/authentication/sign-in/sign-in.js') }}"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->

    </body>
</html>

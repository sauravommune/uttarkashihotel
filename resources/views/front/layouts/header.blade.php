<header>
    <nav class="navbar navbar-expand-xl {{ Route::is('home') ? '' : 'dark-bg-back' }} {{ (Route::current()->getName() == 'searchResultCity' || Route::current()->getName() == 'searchResult') ? 'position-class' : '' }}" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{route('home')}}">
                <img decoding="async" class="d-none" src="{{ asset('assets/front/images/Uttarkashi-hotel-Icon-Blk.png') }}" loading="lazy" alt="Logo" style="width:110px !important;" id="black-logo" />
                <img decoding="async" class="" src="{{ asset('assets/front/images/Uttarkashi-hotel-Icon-WH.png') }}" loading="lazy" alt="Logo" style="width:115px !important;" id="white-logo" />
            </a>
            <div class="contact-info contact-info-mobile me-xl-4 mt-xl-0 mt-3 d-xl-none">
                <div class="d-flex align-items-center justify-content-end">
                    <div class="assistance-bg">
                        Live Assistance
                    </div>
                </div>
                <div class="call-num">
                    <div class="d-flex">
                        <div class="icon">
                            <span class="icon-phone"></span>
                        </div>
                        <div>
                            <a href="tel:{{ config('contact-info.mobile_number') }}" title="91 {{ config('contact-info.mobile_number') }}">+91 {{ config('contact-info.mobile_number') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="navbar-toggler" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                @if (auth()->check())
                    <span>{{ substr(ucwords(auth()->user()->name ?? ''), 0, 1) }}</span>
                @else
                    <i class="icon-menu-2"></i>
                @endif
            </button>
            
            <ul class="dropdown-menu mobile-menu" aria-labelledby="dropdownMenuButton2">
                @if (auth()->check())
                    @if( !auth()->user()->hasRole('User') )
                    <li class="nav-item">
                            <a class="nav-link" href="{{route('superAdmin.dashboard')}}" title="Dashboard">
                                <span class="icon-login-flight pe-2"></span>Dashboard
                            </a>
                    </li>
                    @endif
                @endif
                @if (auth()->check())
                <li class="nav-item d-block d-sm-block d-md-block d-lg-block  d-xl-none">
                    <a class="nav-link active" aria-current="page" href="javascript:void(0);" title="{{ucwords(auth()->user()->name)}}"><span class="fa fa-user pe-2"></span> Hi, {{ucwords(auth()->user()->name)}}</a>
                </li>
                <li class="nav-item d-block d-sm-block d-md-block d-lg-block  d-xl-none">
                    <a class="nav-link" aria-current="page" href="{{ Route('user.profile') }}" title="Profile"><span class="fa fa-address-card pe-2"></span> Profile</a>
                </li>
                @endif
                <li class="nav-item d-block d-sm-block d-md-block d-lg-block  d-xl-none">
                    <a class="nav-link" aria-current="page" href="{{route('home')}}" title="Search Hotel"><span class="fa fa-search pe-2"></span>Search Hotel</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" aria-current="page" href="{{route('contact-us')}}" title="Contact Us"><span class="fa fa-phone pe-2"></span>Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('consult-now')}}" title="Consult Now" title="Consult Now"><span class="icon-headset-mic-profile pe-2"></span>Consult Now</a>
                </li>
                {{-- <li class="nav-item ">
                    <a class="nav-link" aria-current="page" href="https://cabsules.com/" title="Book your Cab"><span class="fa fa-cab pe-2"></span>Book your Cab</a>
                </li> --}}
                <li class="nav-item">
                    @if (auth()->check())
                         <a class="nav-link" href="{{route('logout')}}" title="Log out">
                            <span class="icon-login-flight pe-2"></span>Log out
                        </a>
                    @else
                        <a class="nav-link login-modal"  title="Login" href="javascript:void(0);"  title="Login"><span class="fa fa-sign-in pe-2"></span>Login</a>
                    @endif
                </li>
                
            </ul>
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto align-items-xl-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('consult-now') ? 'active' : '' }}" href="{{route('consult-now')}}" title="Consult Now">Consult Now</a>
                    </li>
                </ul>
                {{-- <div class="cabs-info me-3">
                    <div><a href="https://cabsules.com/" class="btn btn-cab" title="Book your Cab">Book your Cab<img src="{{ asset('assets/front/images/cab.png') }}" class="ps-2" alt="Book your Cab"></a></div>
                </div> --}}
                <div class="contact-info me-xl-4 mt-xl-0 mt-3 d-none d-sm-none d-md-none d-lg-none d-xl-block">
                    <div class="d-flex align-items-center justify-content-xl-end">
                        <div class="assistance-bg">
                            Live Assistance
                        </div>
                    </div>
                    <div class="call-num">
                        <div class="d-flex">
                            <div class="icon">
                                <span class="icon-phone"></span>
                            </div>
                            <div>
                                <a href="tel:{{ config('contact-info.mobile_number') }}" title="91 {{ config('contact-info.mobile_number') }}">+91 {{ config('contact-info.mobile_number') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-us" id="login_btn">
                    @if (auth()->check())
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="icon">
                                    <span>{{ucwords(auth()->user()->name)[0]}}</span>
                                </div>
                                <div class="name px-xl-3 px-2">
                                    {{ucwords(auth()->user()->name)}}
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="{{ Route('user.profile') }}">
                                    <span class="icon-account-circle-user-profile pe-2"></span>Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{route('logout')}}" title="Log out">
                                    <span class="icon-login-flight pe-2"></span>Log out
                                </a>
                            </li>
                        </ul>
                    @else
                        <a class="btn {{ Route::is('home') ? 'btn-outline-primary' : 'bg-dark-btn' }} login-modal"  title="Login" href="javascript:void(0);">
                            Login
                        </a>
                    @endif
                </div>
                @if (auth()->check())
                    @if( !auth()->user()->hasRole('User') )
                    <div class="call-num">
                        <a class="btn btn-outline-primary ms-3" href="{{route('superAdmin.dashboard')}}" title="Dashboard">Dashboard
                        </a>
                    </div>
                    @endif
                @endif
                
            </div>
        </div>
    </nav>
</header>

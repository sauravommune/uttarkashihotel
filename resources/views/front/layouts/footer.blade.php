<!-- Login Modal -->
<section class="modal-section">
    <div class="modal fade" id="loginModel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-outer">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="modal-inner">
                                    <div class="logo text-center mb-3">
                                        <img decoding="async"
                                            data-src="{{ asset('assets/front/images/Uttarkashi-hotel-Icon-Blk.png') }}"
                                            class="lazy" alt="logo" height="" width="" title="logo">
                                    </div>
                                    <div class="modal-title text-center">
                                        <p>Login</p>
                                        <span>Please Sign In to your account</span>
                                    </div>
                                    <div class="form-part mt-4">
                                        <form action="{{ route('login') }}" method="post" class="global-ajax-form"
                                            data-modal-form="#loginModel" id="loginM">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter your email" name="email" value="">
                                            </div>
                                            <div class="mb-4">
                                                <label for="Password" class="form-label">Password</label>
                                                <div class="password-icon">
                                                    <input type="password" class="form-control" id="password"
                                                        placeholder="Password" name="password">
                                                    <div class="icon-show">
                                                        <span class="material-symbols-outlined" id="toggle_password">
                                                            visibility_off
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            @if (app()->environment() !== 'local')
                                                {!! RecaptchaV3::field('login') !!}
                                            @endif
                                            <input type="hidden" name="login_type" value="{{ encode('front') }}">
                                            <div class="mb-3">
                                                <div
                                                    class="d-flex justify-content-between align-items-center keep-logged">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Keep me
                                                            logged in</label>
                                                    </div>
                                                    <div>
                                                        <a href="javascript:void(0);" title="Sign In"
                                                            data-bs-target="#forgotPasswordModel" data-bs-toggle="modal"
                                                            data-bs-dismiss="modal">Forgot Password?</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="my-xl-4 my-3">
                                                <div class="login">
                                                    <button class="btn btn-primary">
                                                        Sign In
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="text-center mb-0">
                                                <div class="create-free">
                                                    <p> Don't Have an Account? <a href="javascript:void(0);"
                                                            title="Sign In" data-bs-target="#exampleModalToggle2"
                                                            data-bs-toggle="modal" data-bs-dismiss="modal"> Create
                                                            Account </a> </p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-11 col-md-11 mb-4 my-4">
                        <div class="google-sign-up">
                            <a href="{{ route('google.login') }}" class="btn btn-primary" title="login">
                                <div class="d-flex justify-content-center">

                                    <div class="d-flex align-items-center text-center">
                                        <div>
                                            <img decoding="async"
                                                src="{{ asset('assets/front/images/google-icon.png') }}"
                                                class="lazy mx-2" alt="" height="" width=""
                                                title="">
                                        </div>
                                        <div>
                                            Sign In with Google
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Login Modal -->


<!--  Register Modal -->
<section class="modal-section">
    <div class="modal fade" id="exampleModalToggle2" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-outer">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="modal-inner">
                                    <div class="logo text-center mb-3">
                                        <img decoding="async"
                                            data-src="{{ asset('assets/front/images/Uttarkashi-hotel-Icon-Blk.png') }}"
                                            class="lazy" alt="logo" height="" width=""
                                            title="logo">
                                    </div>
                                    <div class="modal-title text-center">
                                        <p>
                                            Register
                                        </p>
                                        <span>
                                            Please register to create your account
                                        </span>
                                    </div>
                                    <div class="form-part">
                                        <form action="{{ route('register') }}" method="post"
                                            class="global-ajax-form">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Full Name</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter your full name" name="name">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Email
                                                    address</label>
                                                <input type="email" class="form-control"
                                                    placeholder="Enter your email" name="email">
                                            </div>

                                            <div class="row">
                                                <div class="mb-2 col-md-6 col-12">
                                                    <label for="password" class="form-label">Password</label>
                                                    <div class="password-icon">
                                                        <input type="password" class="form-control" id="regpassword"
                                                            placeholder="Password" name="password">
                                                        <div class="icon-show">
                                                            <span toggle="#password-field_reg"
                                                                class="material-symbols-outlined"
                                                                id="togglePasswordreg">
                                                                visibility_off
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-2 col-md-6 col-12">
                                                    <label for="password" class="form-label">Confirm Password</label>
                                                    <div class="password-icon">
                                                        <input type="password" class="form-control"
                                                            id="confirmPassword" placeholder="Confirm Password"
                                                            name="password_confirmation">
                                                        <div class="icon-show">
                                                            <span toggle="#password-field_reg"
                                                                class="material-symbols-outlined"
                                                                id="toggleConfirmPassword">
                                                                visibility_off
                                                            </span>
                                                        </div>

                                                    </div>
                                                </div>

                                                {!! RecaptchaV3::field('register') !!}
                                            </div>

                                            <div class="my-xl-4 my-3">
                                                <div class="login">
                                                    {{-- <button type="submit" class="btn btn-primary" title="Sign In">
                                                        Register
                                                    </button> --}}
                                                    <button type="submit" class="btn btn-primary" title="Sign In"
                                                        data-type="mail">
                                                        <div class="d-flex justify-content-center">
                                                            <div id="loader" class="d-none loader">
                                                                <div class="spinner-border" role="status">
                                                                    <span class="visually-hidden">Loading...</span>
                                                                </div>
                                                            </div>
                                                            <div class="ps-2">
                                                                Register
                                                            </div>
                                                        </div>
                                                    </button>


                                                </div>
                                            </div>
                                            <div class="text-center mb-0">
                                                <div class="create-free">
                                                    <p> Already Have an Account? <a href="{{ route('login') }}"
                                                            data-bs-target="#signup" data-bs-toggle="modal"> Login
                                                        </a> </p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-11 col-md-11 mb-4 my-4">
                        <div class="google-sign-up">
                            <a href="{{ route('google.login') }}" class="btn btn-primary" title="login">
                                <div class="d-flex justify-content-center">
                                    <div class="d-flex align-items-center text-center">
                                        <div>
                                            <img decoding="async"
                                                src="{{ asset('assets/front/images/google-icon.png') }}"
                                                class="lazy mx-2" alt="" height="" width=""
                                                title="">
                                        </div>
                                        <div>
                                            Sign Up with Google
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Register Modal -->



<!--  Forgot Password Modal -->
<section class="modal-section forgotPassword">
    <div class="modal fade" id="forgotPasswordModel" aria-labelledby="forgotPasswordModel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-outer">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="modal-inner">
                                    <div class="logo text-center mb-xl-3 mb-2">
                                        <img decoding="async"
                                            data-src="{{ asset('assets/front/images/Uttarkashi-hotel-Icon-Blk.png') }}"
                                            class="lazy" alt="logo" height="" width=""
                                            title="logo">
                                    </div>
                                    <div class="modal-title text-center mb-xl-3 mb-2">
                                        <p>
                                            Forgot Password
                                        </p>
                                        {{-- <span>
                                            Please register to your account
                                        </span> --}}
                                    </div>
                                    <div class="form-part">
                                        <form action="{{ route('password.email') }}" method="post"
                                            class="global-ajax-form">
                                            @csrf

                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Email
                                                    address</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter your email" name="email">
                                            </div>

                                            <div class="my-xl-4 my-3">
                                                <div class="login text-center">
                                                    {{-- <button type="submit" class="btn btn-primary" title="Sign In">
                                                    Send Link Yor Email    
                                                    </button> --}}
                                                    <button type="submit"
                                                        class="btn btn-primary loader-btn text-center loader-btn"
                                                        data-type="mail">
                                                        <div class="d-flex justify-content-center">
                                                            <div id="loader" class="d-none loader">
                                                                <div class="spinner-border" role="status">
                                                                    <span class="visually-hidden">Loading...</span>
                                                                </div>
                                                            </div>
                                                            <div class="ps-2">
                                                                Send Link Your Email
                                                            </div>
                                                        </div>
                                                    </button>

                                                </div>
                                            </div>


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- End Register Modal -->

<footer class="top-footer dark-bg py-4">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-4 col-lg-6 col-xl-6">
                <div class="d-flex align-items-center">
                    <div class="icon">
                        <span class="icon-phone"></span>
                    </div>
                    <div class="text ps-3">
                        <a href="tel:{{ config('contact-info.mobile_number') }}">+91
                            {{ config('contact-info.mobile_number') }}</a>
                    </div>
                </div>
            </div>
            <div
                class="col-12 col-sm-12 col-md-4 col-lg-6 col-xl-6 d-xl-flex justify-content-xl-end my-md-0 my-xl-0 my-lg-0 my-4">
                <div class="d-flex align-items-center">
                    <div class="icon">
                        <span class="icon-mail"></span>
                    </div>
                    <div class="text ps-3">
                        <a href="mailto:{{ config('contact-info.email') }}">{{ config('contact-info.email') }}</a>
                    </div>
                </div>
            </div>
            {{-- <div class="col-12 col-sm-12 col-md-4 col-lg-6 col-xl-4 d-xl-flex justify-content-xl-end">
                <div class="d-xl-flex align-items-center">

                    <div class="text">
                        <p>Follow us on social media!</p>
                    </div>
                    <div class="d-flex social-icon pt-xl-0 pt-3">
                        <div>
                            <a href="javascript:void(0);" target="_blank" rel="noopener noreferrer" title="Facebook">
                                <span class="icon-facebook"></span>
                            </a>
                        </div>
                        <div>
                            <a href="javascript:void(0);" target="_blank" rel="noopener noreferrer" title="Instagram">
                                <span class="icon-instagram"></span>
                            </a>
                        </div>
                        <div>
                            <a href="javascript:void(0);" target="_blank" rel="noopener noreferrer" title="Youtube">
                                <span class="icon-youtube"></span>
                            </a>
                        </div>
                        <div>
                            <a href="javascript:void(0);" target="_blank" rel="noopener noreferrer" title="Linkedin">
                                <span class="icon-linkedin"></span>
                            </a>
                        </div>

                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <form action="{{ route('logout') }}" method="post" class="d-none" id="logout_frm"
        data-redirect="{{ route('home') }}" class="global-ajax-from">
        @csrf
        <button type="submit"></button>
    </form>
</footer>
<footer class="main-footer py-xl-5 py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-xl-2 mb-4">
                <div class="d-xl-block me-4">
                    <div class="footer-logo pb-4">
                        <img decoding="async" class="lazy"
                            src="{{ asset('assets/front/images/Uttarkashi-hotel-Icon-Blk.png') }}" alt="Footer Logo"
                            width="auto">
                    </div>
                    <div class="container-footer row">
                        <div class="col-6 col-md-4 col-lg-12 col-xl-12">
                            <div class="info">
                                <b class="d-block">Contact:</b>
                                <a href="tel:{{ config('contact-info.mobile_number') }}">+91
                                    {{ config('contact-info.mobile_number') }}</a>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-12 col-xl-12 mt-0 mt-xl-3">
                            <div class="info ps-2 ps-lg-0">
                                <b class="d-block">Email:</b>
                                <a
                                    href="mailto:{{ config('contact-info.email') }}">{{ config('contact-info.email') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-xl-10">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-6 col-xl-4 mb-4 mb-xl-0 d-xl-flex justify-content-xl-center">
                        <div>
                            <h4>Important Link</h4>
                            <ul>
                                <li><a href="https://haridwartourtrip.com/do-dham-yatra-package-from-haridwar/"
                                        target="_blank" title="Varanasi">Do Dham Yatra Package From Haridwar</a></li>
                                <li><a href="https://haridwartourtrip.com/do-dham-yatra-package-from-delhi/"
                                        target="_blank" title="Varanasi">Do Dham Yatra Package From Delhi</a></li>
                                <li><a href="https://haridwartourtrip.com/chardham-yatra-package-from-haridwar/"
                                        target="_blank" title="Varanasi">Chardham Yatra Tour Package From Haridwar</a>
                                </li>
                                <li><a href="https://haridwartourtrip.com/chardham-yatra-package-from-delhi/"
                                        target="_blank" title="Varanasi">Chardham Yatra Tour Package From Delhi</a>
                                </li>
                                <li><a href="https://haridwartourtrip.com/chardham-yatra-tour-package-by-helicopter-5n-6d/"
                                        target="_blank" title="Varanasi">Chardham Yatra Tour Package By Helicopter</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="col-6 col-md-4 col-lg-6 col-xl-3 mb-4 mb-xl-0 d-xl-flex justify-content-xl-center">
                        <div>
                            <h4>Company</h4>
                            <ul>
                                <li><a href="{{ route('terms-and-conditions') }}" title="Terms and Conditions">Terms
                                        and
                                        Conditions</a></li>
                                <li><a href="{{ route('cancellation-policy') }}"
                                        title="Cancellation Policy">Cancellation
                                        Policy</a></li>
                                <li><a href="{{ route('privacy-policy') }}" title="Privacy Policy">Privacy Policy</a>
                                </li>
                                <li><a href="{{ route('contact-us') }}" title="Contact Us">Contact Us</a></li>
                            </ul>
                        </div>

                    </div>
                    <div class="col-6 col-md-4 col-lg-6 col-xl-2 mb-4 mb-xl-0 d-xl-flex justify-content-xl-center">
                        <div>
                            <h4>Quick Links</h4>
                            <ul>
                                <li><a href="{{ route('consult-now') }}" title="Consult Now">Consult Now</a></li>
                                <li><a href="{{ url('faq') }}" title="FAQs">FAQs</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-6 col-xl-3 mb-4 mb-xl-0 d-xl-flex justify-content-xl-end">
                        <div>
                            <div class="images">
                                <!-- <img data-src="{{ asset('assets/front/images/payment-image.svg') }}" class="lazy"
                                    width="" height="" title="Payment" alt=""> -->
                                <svg width="260" height="120" viewBox="0 0 260 116" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_3830_1693)">
                                        <rect x="179.25" y="0.25" width="80.5" height="33.5" rx="2.75"
                                            stroke="#D1D5D5" stroke-width="0.5" />
                                        <path
                                            d="M201.842 27.0053V18.3486H211.132L212.129 19.6311L213.159 18.3486H246.86V26.4083C246.86 26.4083 245.981 26.9943 244.962 27.0053H226.297L225.171 25.64V27.0053H221.492V24.6726C221.492 24.6726 220.988 24.9987 219.902 24.9987H218.647V27.0053H213.075L212.079 25.6952L211.071 27.0053H201.842Z"
                                            fill="white" />
                                        <path
                                            d="M191 11.8203L193.094 7H196.718L197.905 9.69762V7H202.407L203.113 8.95135L203.796 7H224.006V7.97844C224.006 7.97844 225.07 7 226.812 7L233.37 7.02211L234.54 9.68657V7H238.309L239.345 8.53123V7H243.147V15.6622H239.345L238.354 14.1255V15.6622H232.821L232.266 14.2969H230.777L230.228 15.6622H226.476C224.975 15.6622 224.012 14.7004 224.012 14.7004V15.6622H218.345L217.219 14.2969V15.6622H196.18L195.626 14.2969H194.142L193.587 15.6622H191V11.8203Z"
                                            fill="white" />
                                        <path
                                            d="M193.834 8.07227L191.011 14.5565H192.848L193.369 13.2575H196.398L196.919 14.5565H198.801L195.978 8.07227H193.834ZM194.881 9.57586L195.805 11.8423H193.957L194.881 9.57586Z"
                                            fill="#016FD0" />
                                        <path
                                            d="M198.991 14.5507V8.06641L201.606 8.07746L203.124 12.2566L204.608 8.06641H207.201V14.5507H205.56V9.77453L203.818 14.5507H202.379L200.632 9.77453V14.5507H198.991Z"
                                            fill="#016FD0" />
                                        <path
                                            d="M208.326 14.5507V8.06641H213.685V9.51472H209.989V10.6258H213.596V11.9912H209.984V13.141H213.68V14.5507H208.326Z"
                                            fill="#016FD0" />
                                        <path
                                            d="M214.632 8.07227V14.5565H216.273V12.2514H216.961L218.933 14.5565H220.937L218.776 12.1685C219.661 12.0966 220.579 11.3448 220.579 10.1784C220.579 8.81301 219.493 8.07779 218.283 8.07779L214.632 8.07227ZM216.273 9.52058H218.149C218.597 9.52058 218.927 9.86884 218.927 10.2005C218.927 10.6317 218.501 10.8804 218.171 10.8804H216.273V9.52058Z"
                                            fill="#016FD0" />
                                        <path d="M222.925 14.5507H221.251V8.06641H222.925V14.5507Z" fill="#016FD0" />
                                        <path
                                            d="M226.902 14.551H226.538C224.785 14.551 223.727 13.1911 223.727 11.3393C223.727 9.44319 224.779 8.07227 226.986 8.07227H228.8V9.60903H226.924C226.028 9.60903 225.39 10.3 225.39 11.3558C225.39 12.6107 226.118 13.1358 227.159 13.1358H227.591L226.902 14.551Z"
                                            fill="#016FD0" />
                                        <path
                                            d="M230.474 8.07194L227.652 14.5507H229.489L230.009 13.2516H233.039L233.56 14.5507H235.436L232.613 8.06641L230.474 8.07194ZM231.516 9.57553L232.44 11.842H230.592L231.516 9.57553Z"
                                            fill="#016FD0" />
                                        <path
                                            d="M235.626 14.5507V8.06641H237.715L240.381 12.1405V8.06641H242.022V14.5507H240L237.267 10.3716V14.5507H235.626Z"
                                            fill="#016FD0" />
                                        <path
                                            d="M202.967 25.8944V19.4102H208.326V20.8585H204.63V21.9696H208.242V23.335H204.63V24.4848H208.326V25.8944H202.967Z"
                                            fill="#016FD0" />
                                        <path
                                            d="M229.214 25.8944V19.4102H234.574V20.8585H230.878V21.9696H234.473V23.335H230.878V24.4848H234.574V25.8944H229.214Z"
                                            fill="#016FD0" />
                                        <path
                                            d="M208.534 25.8944L211.143 22.6937L208.472 19.4102H210.539L212.129 21.4389L213.725 19.4102H215.713L213.075 22.6495L215.691 25.8889H213.624L212.079 23.8933L210.572 25.8889L208.534 25.8944Z"
                                            fill="#016FD0" />
                                        <path
                                            d="M215.886 19.416V25.9003H217.572V23.8549H219.302C220.764 23.8549 221.873 23.0866 221.873 21.5995C221.873 20.3668 221.005 19.4215 219.515 19.4215H215.886V19.416ZM217.572 20.8809H219.392C219.862 20.8809 220.204 21.1684 220.204 21.6272C220.204 22.0584 219.868 22.3735 219.386 22.3735H217.572V20.8809Z"
                                            fill="#016FD0" />
                                        <path
                                            d="M222.579 19.4102V25.8944H224.219V23.5893H224.908L226.879 25.8944H228.884L226.723 23.5063C227.607 23.4345 228.526 22.6827 228.526 21.5163C228.526 20.1509 227.439 19.4157 226.23 19.4157L222.579 19.4102ZM224.225 20.864H226.101C226.549 20.864 226.879 21.2123 226.879 21.5439C226.879 21.9751 226.454 22.2239 226.123 22.2239H224.225V20.864Z"
                                            fill="#016FD0" />
                                        <path
                                            d="M235.335 25.8947V24.4851H238.622C239.11 24.4851 239.317 24.2253 239.317 23.9434C239.317 23.6725 239.11 23.3961 238.622 23.3961H237.138C235.85 23.3961 235.128 22.6222 235.128 21.4558C235.128 20.4166 235.789 19.416 237.704 19.416H240.902L240.213 20.8754H237.446C236.92 20.8754 236.758 21.1518 236.758 21.4116C236.758 21.6825 236.959 21.9754 237.362 21.9754H238.919C240.358 21.9754 240.98 22.7825 240.98 23.8383C240.98 24.9716 240.286 25.9003 238.841 25.9003H235.335V25.8947Z"
                                            fill="#016FD0" />
                                        <path
                                            d="M241.361 25.8947V24.4851H244.648C245.135 24.4851 245.343 24.2253 245.343 23.9434C245.343 23.6725 245.135 23.3961 244.648 23.3961H243.164C241.876 23.3961 241.154 22.6222 241.154 21.4558C241.154 20.4166 241.815 19.416 243.73 19.416H246.927L246.239 20.8754H243.472C242.946 20.8754 242.783 21.1518 242.783 21.4116C242.783 21.6825 242.985 21.9754 243.388 21.9754H244.945C246.384 21.9754 247.006 22.7825 247.006 23.8383C247.006 24.9716 246.311 25.9003 244.867 25.9003H241.361V25.8947Z"
                                            fill="#016FD0" />
                                    </g>
                                    <g clip-path="url(#clip1_3830_1693)">
                                        <rect x="68.25" y="0.25" width="102.5" height="33.5" rx="2.75"
                                            stroke="#D1D5D5" stroke-width="0.5" />
                                        <g clip-path="url(#clip2_3830_1693)">
                                            <path
                                                d="M113.791 19.1892V16.0117C113.791 14.8042 113.029 13.9993 111.8 13.9993C111.08 13.9569 110.402 14.2958 110.021 14.9102C109.66 14.317 109.025 13.9781 108.347 13.9993C107.754 13.9781 107.182 14.2535 106.864 14.7619V14.1264H105.763V19.1892H106.885V16.393C106.885 15.5033 107.373 15.0373 108.135 15.0373C108.877 15.0373 109.237 15.5245 109.237 16.3718V19.1892H110.359V16.393C110.359 15.5033 110.868 15.0373 111.609 15.0373C112.372 15.0373 112.732 15.5245 112.732 16.3718V19.1892H113.791ZM130.293 14.1264H128.492V12.58H127.37V14.1264H126.332V15.1432H127.37V17.4522C127.37 18.6384 127.836 19.3375 129.128 19.3375C129.615 19.3375 130.102 19.2104 130.505 18.935L130.187 17.9817C129.891 18.1512 129.552 18.2571 129.213 18.2783C128.662 18.2783 128.471 17.9394 128.471 17.431V15.122H130.272V14.1264H130.293ZM139.698 13.9993C139.148 13.9781 138.639 14.2747 138.364 14.7407V14.1264H137.262V19.1892H138.364V16.3506C138.364 15.5033 138.724 15.0373 139.444 15.0373C139.677 15.0373 139.91 15.0796 140.143 15.1644L140.482 14.1264C140.228 14.0416 139.974 13.9993 139.698 13.9993ZM125.463 14.5289C124.849 14.1476 124.129 13.9781 123.387 13.9993C122.095 13.9993 121.269 14.6136 121.269 15.6304C121.269 16.4565 121.883 16.9649 123.027 17.1344L123.557 17.2191C124.171 17.3039 124.446 17.4733 124.446 17.7487C124.446 18.1512 124.044 18.363 123.281 18.363C122.667 18.3842 122.074 18.1936 121.587 17.8335L121.057 18.702C121.693 19.1468 122.476 19.3798 123.26 19.3587C124.722 19.3587 125.569 18.6596 125.569 17.7064C125.569 16.8167 124.891 16.3506 123.79 16.1812L123.26 16.0964C122.773 16.0329 122.392 15.927 122.392 15.588C122.392 15.2067 122.752 14.9949 123.366 14.9949C123.917 14.9949 124.468 15.1432 124.955 15.4397L125.463 14.5289ZM155.035 13.9993C154.484 13.9781 153.976 14.2747 153.701 14.7407V14.1264H152.599V19.1892H153.701V16.3506C153.701 15.5033 154.061 15.0373 154.781 15.0373C155.014 15.0373 155.247 15.0796 155.48 15.1644L155.819 14.1264C155.565 14.0416 155.289 13.9993 155.035 13.9993ZM140.8 16.6684C140.8 18.2148 141.88 19.3375 143.511 19.3375C144.168 19.3798 144.825 19.1468 145.333 18.7232L144.804 17.8335C144.422 18.13 143.956 18.2783 143.469 18.2995C142.579 18.2995 141.944 17.6428 141.944 16.6684C141.944 15.6939 142.601 15.0584 143.469 15.0373C143.956 15.0373 144.422 15.2067 144.804 15.5033L145.333 14.6136C144.825 14.1899 144.168 13.9781 143.511 13.9993C141.88 13.9993 140.8 15.122 140.8 16.6684ZM151.137 16.6684V14.1264H150.036V14.7407C149.655 14.2535 149.061 13.9781 148.426 13.9993C147.007 13.9993 145.884 15.122 145.884 16.6684C145.884 18.2148 147.007 19.3375 148.426 19.3375C149.04 19.3587 149.655 19.0833 150.036 18.5961V19.2104H151.137V16.6684ZM147.028 16.6684C147.028 15.7787 147.621 15.0373 148.574 15.0373C149.485 15.0373 150.099 15.7363 150.099 16.6684C150.099 17.6004 149.485 18.2995 148.574 18.2995C147.621 18.2783 147.028 17.5581 147.028 16.6684ZM133.725 13.9993C132.242 13.9993 131.204 15.0796 131.204 16.6684C131.204 18.2783 132.284 19.3375 133.809 19.3375C134.572 19.3587 135.313 19.1045 135.885 18.6172L135.335 17.7911C134.911 18.13 134.403 18.3207 133.852 18.3207C133.132 18.3207 132.496 17.9817 132.327 17.0709H136.097C136.118 16.9226 136.118 16.7955 136.118 16.6472C136.118 15.0796 135.144 13.9993 133.725 13.9993ZM133.704 14.9737C134.424 14.9737 134.869 15.4186 134.996 16.2023H132.348C132.475 15.4821 132.92 14.9737 133.704 14.9737ZM161.39 16.6684V12.0928H160.289V14.7407C159.907 14.2535 159.314 13.9781 158.679 13.9993C157.259 13.9993 156.137 15.122 156.137 16.6684C156.137 18.2148 157.259 19.3375 158.679 19.3375C159.293 19.3587 159.907 19.0833 160.289 18.5961V19.2104H161.39V16.6684ZM162.682 18.7232C162.725 18.7232 162.767 18.7232 162.809 18.7443C162.852 18.7655 162.873 18.7867 162.915 18.8079C162.937 18.8291 162.979 18.8714 162.979 18.9138C163.021 18.9985 163.021 19.0833 162.979 19.168C162.958 19.2104 162.937 19.2316 162.915 19.2739C162.894 19.2951 162.852 19.3163 162.809 19.3375C162.767 19.3587 162.725 19.3587 162.682 19.3587C162.555 19.3587 162.428 19.2739 162.386 19.168C162.343 19.0833 162.343 18.9985 162.386 18.9138C162.428 18.8291 162.492 18.7655 162.555 18.7443C162.576 18.7443 162.619 18.7232 162.682 18.7232ZM162.682 19.2951C162.725 19.2951 162.746 19.2951 162.788 19.2739C162.809 19.2527 162.852 19.2527 162.873 19.2104C162.979 19.1045 162.979 18.9562 162.873 18.8503C162.852 18.8291 162.831 18.8079 162.788 18.7867C162.767 18.7655 162.725 18.7655 162.682 18.7655C162.64 18.7655 162.619 18.7655 162.576 18.7867C162.449 18.8503 162.386 18.9985 162.449 19.1256C162.471 19.1468 162.471 19.1892 162.492 19.2104C162.513 19.2316 162.534 19.2527 162.576 19.2739C162.598 19.2951 162.64 19.2951 162.682 19.2951ZM162.682 18.8926C162.704 18.8926 162.746 18.8926 162.767 18.9138C162.788 18.935 162.809 18.9562 162.788 18.9774C162.788 18.9985 162.788 19.0197 162.767 19.0409C162.746 19.0621 162.725 19.0621 162.704 19.0621L162.809 19.168H162.725L162.64 19.0621H162.619V19.168H162.555V18.8714L162.682 18.8926ZM162.619 18.9562V19.0409H162.682C162.704 19.0409 162.704 19.0409 162.725 19.0409L162.746 19.0197C162.746 18.9985 162.746 18.9985 162.725 18.9985C162.704 18.9985 162.704 18.9985 162.682 18.9985H162.619V18.9562ZM157.281 16.6684C157.281 15.7787 157.874 15.0373 158.827 15.0373C159.738 15.0373 160.352 15.7363 160.352 16.6684C160.352 17.6004 159.738 18.2995 158.827 18.2995C157.853 18.2783 157.281 17.5581 157.281 16.6684ZM120.019 16.6684V14.1264H118.918V14.7407C118.536 14.2535 117.943 13.9781 117.308 13.9993C115.888 13.9993 114.766 15.122 114.766 16.6684C114.766 18.2148 115.888 19.3375 117.308 19.3375C117.922 19.3587 118.536 19.0833 118.918 18.5961V19.2104H120.019V16.6684ZM115.91 16.6684C115.91 15.7787 116.503 15.0373 117.456 15.0373C118.367 15.0373 118.981 15.7363 118.981 16.6684C118.981 17.6004 118.367 18.2995 117.456 18.2995C116.481 18.2783 115.91 17.5581 115.91 16.6684Z"
                                                fill="#231F20" />
                                            <path d="M91.6762 10.6289H85.0034V22.6187H91.6762V10.6289Z"
                                                fill="#FF5F00" />
                                            <path
                                                d="M85.4269 16.6248C85.4269 14.2947 86.5072 12.0704 88.329 10.63C85.0244 8.0244 80.237 8.59635 77.6314 11.9221C75.0259 15.2267 75.5978 20.0142 78.9236 22.6197C81.6986 24.8016 85.5752 24.8016 88.3502 22.6197C86.5072 21.1793 85.4269 18.955 85.4269 16.6248Z"
                                                fill="#EB001B" />
                                            <path
                                                d="M100.678 16.6248C100.678 20.8403 97.2678 24.2508 93.0523 24.2508C91.3365 24.2508 89.6842 23.6789 88.3496 22.6197C91.6542 20.0142 92.2262 15.2267 89.6206 11.901C89.2393 11.4349 88.8156 10.9901 88.3496 10.63C91.6542 8.0244 96.4628 8.59635 99.0472 11.9221C100.106 13.2567 100.678 14.909 100.678 16.6248Z"
                                                fill="#F79E1B" />
                                            <path
                                                d="M99.9583 21.3493V21.0951H100.064V21.0527H99.8101V21.0951H99.916V21.3493H99.9583ZM100.446 21.3493V21.0527H100.361L100.276 21.2646L100.191 21.0527H100.107V21.3493H100.17V21.1163L100.255 21.3069H100.318L100.403 21.1163V21.3493H100.446Z"
                                                fill="#F79E1B" />
                                        </g>
                                    </g>
                                    <g clip-path="url(#clip3_3830_1693)">
                                        <rect x="0.25" y="0.25" width="60.5" height="33.5" rx="2.75"
                                            stroke="#D1D5D5" stroke-width="0.5" />
                                        <g clip-path="url(#clip4_3830_1693)">
                                            <path d="M27.3358 23.7605H24.0918L26.1198 11.2285H29.3598L27.3358 23.7605Z"
                                                fill="#1434CB" />
                                            <path
                                                d="M39.0799 11.532C38.4399 11.28 37.4279 11 36.1759 11C32.9759 11 30.7239 12.708 30.7079 15.148C30.6799 16.948 32.3199 17.948 33.5479 18.548C34.7999 19.16 35.2279 19.56 35.2279 20.108C35.2159 20.948 34.2159 21.336 33.2839 21.336C31.9919 21.336 31.2959 21.136 30.2439 20.668L29.8159 20.468L29.3599 23.28C30.1199 23.628 31.5199 23.932 32.9719 23.948C36.3719 23.948 38.5839 22.268 38.6119 19.668C38.6239 18.24 37.7599 17.148 35.8919 16.256C34.7599 15.684 34.0639 15.296 34.0639 14.708C34.0759 14.176 34.6519 13.628 35.9319 13.628C36.9839 13.6 37.7599 13.856 38.3439 14.108L38.6399 14.24L39.0799 11.532Z"
                                                fill="#1434CB" />
                                            <path
                                                d="M43.388 19.3205C43.656 18.6005 44.68 15.8125 44.68 15.8125C44.668 15.8405 44.948 15.0805 45.108 14.6125L45.336 15.6925C45.336 15.6925 45.948 18.6925 46.084 19.3205C45.576 19.3205 44.028 19.3205 43.388 19.3205ZM47.388 11.2285H44.88C44.108 11.2285 43.52 11.4565 43.188 12.2685L38.376 23.7605H41.776C41.776 23.7605 42.336 22.2125 42.456 21.8805C42.828 21.8805 46.136 21.8805 46.616 21.8805C46.708 22.3205 47.004 23.7605 47.004 23.7605H50.004L47.388 11.2285Z"
                                                fill="#1434CB" />
                                            <path
                                                d="M21.3882 11.2285L18.2162 19.7725L17.8682 18.0405C17.2802 16.0405 15.4402 13.8685 13.3882 12.7885L16.2962 23.7485H19.7202L24.8122 11.2285H21.3882Z"
                                                fill="#1434CB" />
                                            <path
                                                d="M15.268 11.2285H10.052L10 11.4805C14.068 12.5205 16.76 15.0285 17.868 18.0405L16.732 12.2805C16.548 11.4805 15.972 11.2525 15.268 11.2285Z"
                                                fill="#1434CB" />
                                        </g>
                                    </g>
                                    <g clip-path="url(#clip5_3830_1693)">
                                        <rect x="0.25" y="40.25" width="86.5" height="33.5" rx="2.75"
                                            stroke="#D1D5D5" stroke-width="0.5" />
                                        <path
                                            d="M34.3629 60.2168V60.1896C34.3629 58.9352 33.4556 57.8985 32.1674 57.8985C30.8523 57.8985 30.0122 58.9238 30.0122 60.1623V60.1896C30.0122 61.4304 30.9195 62.467 32.1943 62.467C33.5228 62.467 34.3629 61.4417 34.3629 60.2168ZM28.3723 60.2168V60.1896C28.3723 58.1548 29.9988 56.4694 32.1943 56.4694C34.3897 56.4694 36.0027 58.1276 36.0027 60.1623V60.1896C36.0027 62.2106 34.3763 63.8961 32.1674 63.8961C29.9853 63.8961 28.3723 62.2379 28.3723 60.2168ZM42.643 60.1918V60.1646C42.643 58.7899 41.7088 57.8871 40.5976 57.8871C39.4864 57.8871 38.5097 58.8036 38.5097 60.1646V60.1918C38.5097 61.5528 39.4864 62.4693 40.5975 62.4693C41.7222 62.4693 42.643 61.5937 42.643 60.1918ZM36.91 54.6366C36.91 54.1784 37.2618 53.8267 37.7233 53.8267C38.1848 53.8267 38.55 54.1761 38.55 54.6366V57.8055C39.0787 57.0637 39.8247 56.4717 40.9896 56.4717C42.6699 56.4717 44.3097 57.7919 44.3097 60.1646V60.1918C44.3097 62.551 42.6833 63.8847 40.9896 63.8847C39.7978 63.8847 39.0518 63.2927 38.55 62.6303V62.9956C38.55 63.4401 38.1848 63.8054 37.7233 63.8054C37.2752 63.8054 36.91 63.4424 36.91 62.9955V54.6366ZM45.3403 57.3609C45.3403 56.9027 45.692 56.5397 46.1535 56.5397C46.615 56.5397 46.9802 56.9027 46.9802 57.3609V62.9956C46.9802 63.4538 46.615 63.8054 46.1535 63.8054C45.7054 63.8054 45.3403 63.456 45.3403 62.9955V57.3609ZM45.217 54.7046C45.217 54.2192 45.6225 53.9084 46.1513 53.9084C46.68 53.9084 47.0855 54.2192 47.0855 54.7046V54.7863C47.0855 55.2717 46.68 55.5961 46.1513 55.5961C45.6225 55.5961 45.217 55.2717 45.217 54.7863V54.7046ZM48.5506 55.0539C48.5506 54.5957 48.9158 54.2305 49.3907 54.2305C49.8522 54.2305 50.2174 54.5957 50.2174 55.0539V59.044L54.7159 54.5413C54.9063 54.3394 55.1079 54.2306 55.4059 54.2306C55.8674 54.2306 56.1788 54.5957 56.1788 54.9995C56.1788 55.2559 56.0713 55.4441 55.8808 55.6188L52.9259 58.4497L56.125 62.399C56.2617 62.5736 56.3558 62.7369 56.3558 62.9933C56.3558 63.4515 55.9906 63.8031 55.5156 63.8031C55.1908 63.8031 54.987 63.642 54.81 63.4129L51.761 59.5431L50.2151 61.0266V62.9819C50.2151 63.4401 49.8499 63.8031 49.3885 63.8031C48.9135 63.8031 48.5483 63.4401 48.5483 62.9819V55.0562L48.5506 55.0539ZM58.3093 63.1294L56.3849 57.7102C56.3446 57.6036 56.3042 57.4267 56.3042 57.2928C56.3042 56.9027 56.6156 56.5375 57.104 56.5375C57.5095 56.5375 57.7806 56.8074 57.9038 57.1839L59.286 61.4984L60.6818 57.1839C60.8027 56.8074 61.1007 56.5375 61.5219 56.5375H61.616C62.0371 56.5375 62.3351 56.8074 62.4561 57.1839L63.8652 61.4984L65.2609 57.1703C65.3685 56.8188 65.6261 56.5374 66.0607 56.5374C66.5087 56.5374 66.8336 56.8891 66.8336 57.2928C66.8336 57.413 66.7932 57.5764 66.7664 57.6558L64.815 63.1294C64.6381 63.6284 64.2998 63.8576 63.9077 63.8576H63.8539C63.4484 63.8576 63.1079 63.6284 62.9601 63.1566L61.5644 58.9238L60.1552 63.1566C60.0052 63.6284 59.6669 63.8576 59.2748 63.8576H59.221C58.8155 63.8576 58.475 63.6284 58.3137 63.1294L58.3093 63.1294ZM67.714 57.3609C67.714 56.9027 68.0657 56.5397 68.5272 56.5397C68.9888 56.5397 69.3539 56.9027 69.3539 57.3609V62.9956C69.3539 63.4538 68.9888 63.8054 68.5272 63.8054C68.0792 63.8054 67.714 63.456 67.714 62.9955V57.3609ZM67.5908 54.7046C67.5908 54.2192 67.9963 53.9084 68.525 53.9084C69.0537 53.9084 69.4592 54.2192 69.4592 54.7046V54.7863C69.4592 55.2717 69.0537 55.5961 68.525 55.5961C67.9963 55.5961 67.5908 55.2717 67.5908 54.7863L67.5908 54.7046ZM70.7362 54.6366C70.7362 54.192 71.0879 53.8267 71.5494 53.8267C72.0109 53.8267 72.376 54.1897 72.376 54.6366V59.8947L75.452 56.8891C75.6693 56.6736 75.8731 56.5397 76.1576 56.5397C76.5923 56.5397 76.8768 56.8891 76.8768 57.2815C76.8768 57.5514 76.7401 57.7533 76.5116 57.9688L74.6141 59.7086L76.7827 62.526C76.9328 62.7279 77 62.8776 77 63.0659C77 63.5105 76.6483 63.8076 76.2271 63.8076C75.9023 63.8076 75.7118 63.701 75.508 63.4447L73.4626 60.734L72.3783 61.7593V63.0001C72.3783 63.4583 72.0132 63.8099 71.5516 63.8099C71.1036 63.8099 70.7384 63.4605 70.7384 63.0001V54.6411L70.7362 54.6366ZM28.5628 56.7189C28.1506 56.7189 27.8145 56.3854 27.8145 55.9749C27.8145 55.5643 28.1506 55.2286 28.5628 55.2286C28.9772 55.2286 29.3132 55.5643 29.3132 55.9749C29.3132 56.3854 28.9772 56.7189 28.5628 56.7189ZM29.945 55.5733C29.8017 54.2441 28.4507 54.7772 28.4507 54.7772C27.4919 55.1469 27.2724 54.9904 27.2724 54.9904L27.4516 52.4021C27.3508 51.1931 25.7534 51.6128 25.7534 51.6128C26.6182 52.0097 26.4412 52.4747 26.4412 52.4747C26.4412 52.4747 25.5003 62.0019 25.3927 62.6121C25.2852 63.2223 24.4519 62.9728 24.4519 62.9728V64.0162H25.5361C26.3314 64.0162 26.4031 62.9365 26.4031 62.9365L26.9341 57.878C27.7719 57.7374 28.4283 57.5446 28.4283 57.5446C30.2071 56.9435 29.945 55.5757 29.945 55.5757V55.5733ZM28.9817 55.9749C28.9817 56.204 28.7935 56.39 28.5628 56.39C28.3342 56.39 28.1461 56.2017 28.1461 55.9749C28.1461 55.748 28.3342 55.5575 28.5628 55.5575C28.7935 55.5575 28.9817 55.7435 28.9817 55.9749ZM18.7503 58.1821L21.3737 53.1508C21.3782 53.144 21.3827 53.1372 21.3872 53.1326C21.5104 52.8196 21.7972 52.5927 22.1399 52.5474C21.8016 52.5565 21.4746 52.7379 21.3065 53.06L18.7503 57.9688V58.1843V58.1821ZM11.0348 63.8757C10.571 63.6329 10.3895 63.0545 10.636 62.5963L16.9581 50.6578C17.0925 50.4015 17.3344 50.2359 17.6011 50.1792C17.6167 50.1747 17.6302 50.1724 17.6436 50.1679C17.6794 50.1633 17.722 50.1565 17.7623 50.1565C17.778 50.1565 17.7959 50.152 17.8094 50.152C17.8207 50.1522 17.832 50.1537 17.843 50.1565C17.8721 50.1565 17.899 50.1611 17.9281 50.1656C17.9662 50.1701 18.0043 50.177 18.0446 50.1883C18.0603 50.1905 18.076 50.1974 18.0916 50.2041C18.1387 50.2178 18.1835 50.2359 18.2283 50.2586C18.2328 50.2608 18.2396 50.2608 18.2396 50.2654C18.2455 50.2668 18.251 50.27 18.2552 50.2745C18.3068 50.2994 18.347 50.3289 18.3873 50.3629C18.3963 50.3697 18.4053 50.3743 18.412 50.3811L18.4636 50.4333C18.4479 50.4106 18.4344 50.3833 18.4165 50.3629C18.4094 50.3578 18.404 50.3507 18.4008 50.3425C18.365 50.3017 18.3291 50.2654 18.2843 50.2292C18.2776 50.2245 18.2687 50.2155 18.2597 50.2087C18.2171 50.1792 18.1746 50.1475 18.1275 50.1225C18.123 50.1202 18.1163 50.1134 18.1118 50.1089C18.1051 50.1066 18.0984 50.1066 18.0917 50.1043C18.0491 50.0839 18.0065 50.0635 17.9572 50.0499C17.9393 50.0431 17.9236 50.0385 17.9035 50.0317C17.8676 50.0227 17.8273 50.0182 17.7892 50.0113C17.7603 50.0068 17.7311 50.0046 17.7018 50.0046C17.6884 50.0046 17.6794 50 17.666 50C17.6526 50 17.6369 50.0046 17.6168 50.0046C17.5763 50.0072 17.536 50.011 17.4958 50.0159C17.4801 50.0204 17.4667 50.0227 17.451 50.0272C17.1799 50.0839 16.9335 50.2518 16.7946 50.5149L10.3448 62.6983C10.0938 63.1679 10.2753 63.7577 10.7502 64.0049C11.0773 64.1773 11.4582 64.1387 11.7471 63.9459C11.5164 64.014 11.2566 63.9981 11.028 63.8802L11.0348 63.8757ZM17.8116 62.9139C17.2964 62.9139 16.8707 62.4919 16.8707 61.9793V54.8861L16.7139 55.181V62.0678C16.7139 62.5918 17.1463 63.0228 17.6727 63.0228C17.9326 63.0228 18.1678 62.9185 18.3425 62.7483C18.188 62.8527 18.0065 62.9139 17.8094 62.9139H17.8116ZM22.2609 62.4103C21.7433 62.4103 21.3199 61.9884 21.3199 61.4757V57.3201L21.1698 57.6172V61.6209C21.1698 62.1562 21.6089 62.5986 22.1488 62.5986C22.5722 62.5986 22.9352 62.3218 23.0695 61.943C22.9083 62.222 22.6059 62.4126 22.2608 62.4126L22.2609 62.4103ZM24.9962 50.6057C24.9962 50.6057 21.9875 51.1115 18.7503 51.6491V58.1821L21.3737 53.1508C21.3782 53.144 21.3827 53.1372 21.3872 53.1326C21.5261 52.7856 21.8644 52.5383 22.2587 52.5383C22.7761 52.5383 23.1996 52.9602 23.1996 53.4729V61.4735C23.1996 61.9884 22.7761 62.408 22.2587 62.408C21.7411 62.408 21.3177 61.9861 21.3177 61.4735V57.3178L18.8198 62.1222C18.7842 62.1873 18.7406 62.2476 18.6898 62.3014C18.5555 62.6576 18.2126 62.9139 17.8094 62.9139C17.2941 62.9139 16.8685 62.4919 16.8685 61.9793V54.8861L12.3184 63.4764C12.0764 63.9346 11.494 64.1161 11.0325 63.8734C10.5687 63.6307 10.3873 63.0522 10.6337 62.594L16.2076 52.0665C13.5394 52.5088 11.2252 52.8899 10.925 52.9285C10.179 53.0237 10.011 53.6702 10.011 53.6702C10.011 53.6702 9.98631 63.8529 10.011 64.3588C10.0334 64.8623 10.5665 64.9577 10.5665 64.9577C10.5665 64.9577 23.1413 65.0529 23.7909 64.9577C24.4429 64.8623 24.5616 64.1206 24.5616 64.1206L25.8386 51.2498C25.7915 50.4106 24.9962 50.6011 24.9962 50.6011V50.6057Z"
                                            fill="#0072CF" />
                                    </g>
                                    <g clip-path="url(#clip6_3830_1693)">
                                        <rect x="183.25" y="82.25" width="61.5" height="33.5" rx="2.75"
                                            stroke="#D1D5D5" stroke-width="0.5" />
                                        <g clip-path="url(#clip7_3830_1693)">
                                            <path
                                                d="M212.069 99.2683V104.281H210.491V91.9033H214.676C215.736 91.9033 216.641 92.2596 217.381 92.972C218.137 93.6845 218.515 94.5544 218.515 95.5817C218.515 96.6338 218.137 97.5037 217.381 98.2079C216.649 98.9121 215.744 99.26 214.676 99.26H212.069V99.2683ZM212.069 93.4277V97.744H214.709C215.333 97.744 215.86 97.5286 216.271 97.106C216.69 96.6835 216.904 96.1699 216.904 95.59C216.904 95.0183 216.69 94.513 216.271 94.0905C215.86 93.6514 215.342 93.436 214.709 93.436H212.069V93.4277Z"
                                                fill="#3C4043" />
                                            <path
                                                d="M222.643 95.5322C223.81 95.5322 224.731 95.847 225.405 96.4767C226.079 97.1063 226.416 97.9679 226.416 99.0615V104.281H224.912V103.104H224.846C224.196 104.074 223.325 104.554 222.24 104.554C221.311 104.554 220.538 104.281 219.913 103.726C219.288 103.171 218.976 102.483 218.976 101.655C218.976 100.776 219.304 100.08 219.962 99.5668C220.62 99.0449 221.5 98.7881 222.593 98.7881C223.53 98.7881 224.303 98.9621 224.904 99.31V98.9455C224.904 98.3904 224.69 97.9265 224.254 97.5371C223.818 97.1477 223.308 96.9572 222.725 96.9572C221.845 96.9572 221.146 97.33 220.636 98.0839L219.247 97.2057C220.012 96.0873 221.146 95.5322 222.643 95.5322ZM220.604 101.679C220.604 102.094 220.776 102.442 221.13 102.715C221.475 102.988 221.886 103.129 222.355 103.129C223.021 103.129 223.613 102.881 224.131 102.384C224.649 101.887 224.912 101.307 224.912 100.636C224.418 100.246 223.736 100.047 222.856 100.047C222.215 100.047 221.681 100.205 221.253 100.511C220.817 100.834 220.604 101.224 220.604 101.679Z"
                                                fill="#3C4043" />
                                            <path
                                                d="M235 95.8057L229.738 108.001H228.11L230.067 103.734L226.597 95.8057H228.316L230.815 101.887H230.848L233.281 95.8057H235Z"
                                                fill="#3C4043" />
                                            <path
                                                d="M205.79 98.2577C205.79 97.7391 205.744 97.2428 205.659 96.7656H199.042V99.4995L202.853 99.5004C202.698 100.41 202.201 101.185 201.439 101.702V103.476H203.707C205.032 102.241 205.79 100.415 205.79 98.2577Z"
                                                fill="#4285F4" />
                                            <path
                                                d="M201.439 101.702C200.808 102.132 199.995 102.383 199.044 102.383C197.206 102.383 195.647 101.135 195.089 99.4531H192.749V101.282C193.908 103.6 196.291 105.191 199.044 105.191C200.946 105.191 202.544 104.561 203.708 103.475L201.439 101.702Z"
                                                fill="#34A853" />
                                            <path
                                                d="M194.869 98.0953C194.869 97.6231 194.947 97.1666 195.089 96.7374V94.9082H192.749C192.27 95.8667 192 96.9487 192 98.0953C192 99.2419 192.27 100.324 192.749 101.282L195.089 99.4531C194.947 99.024 194.869 98.5675 194.869 98.0953Z"
                                                fill="#FABB05" />
                                            <path
                                                d="M199.044 93.8085C200.082 93.8085 201.012 94.1689 201.746 94.8731L203.756 92.8491C202.535 91.7034 200.944 91 199.044 91C196.292 91 193.908 92.5906 192.749 94.9087L195.089 96.7379C195.647 95.0561 197.206 93.8085 199.044 93.8085Z"
                                                fill="#E94235" />
                                        </g>
                                    </g>
                                    <g clip-path="url(#clip8_3830_1693)">
                                        <rect x="90.25" y="82.25" width="84.5" height="33.5" rx="2.75"
                                            stroke="#D1D5D5" stroke-width="0.5" />
                                        <g clip-path="url(#clip9_3830_1693)">
                                            <path d="M164.337 91.0217L167.741 97.7153L160.585 104.408L164.337 91.0217Z"
                                                fill="#008C44" />
                                            <path d="M161.951 91.0217L165.352 97.7153L158.193 104.408L161.951 91.0217Z"
                                                fill="#F47920" />
                                            <path
                                                d="M113.517 100.733C113.255 101.277 112.727 101.671 112.097 101.751H111.63H102.483L103.257 99.0132H110.314H112.491H112.963C113.316 99.0998 113.594 99.3764 113.674 99.7269C113.685 99.8061 113.692 99.8852 113.692 99.9674C113.692 100.009 113.69 100.05 113.686 100.091C113.685 100.108 113.685 100.125 113.684 100.142L113.517 100.733ZM104.767 93.6581H111.818H114.027H114.492C114.758 93.7229 114.982 93.8948 115.111 94.1246C115.159 94.2859 115.185 94.4555 115.185 94.6304C115.185 94.7253 115.176 94.8165 115.162 94.9077L115.136 94.9952L115.043 95.3298C114.793 95.9124 114.241 96.3368 113.581 96.4159H113.133H103.989L104.767 93.6581ZM114.896 103.967C115.23 103.713 115.451 103.399 115.556 103.024L116.688 99.0132C116.792 98.6484 116.746 98.3424 116.554 98.0952C116.361 97.8479 116.076 97.7243 115.699 97.7243C116.076 97.7243 116.432 97.5977 116.767 97.3437C117.1 97.0897 117.32 96.7807 117.423 96.4159L118.553 92.41C118.663 92.0203 118.626 91.6992 118.442 91.4437C118.259 91.189 117.971 91.0608 117.58 91.0608H102.815L99.0635 104.349H113.829C114.206 104.349 114.562 104.221 114.896 103.967Z"
                                                fill="#6D6E71" />
                                            <path
                                                d="M134.021 91.0729L132.537 96.4098H121.885L123.37 91.0729H120.722L117.037 104.315H119.685L121.165 99.0018H131.815L130.337 104.315H132.986L136.671 91.0729H134.021Z"
                                                fill="#6D6E71" />
                                            <path d="M137.441 104.357H134.774L138.482 91.1179H141.148L137.441 104.357Z"
                                                fill="#6D6E71" />
                                            <path
                                                d="M159.689 91.1058L148.626 100.376L144.767 94.0354L142.984 91.1058H142.936L142.096 94.1145L139.251 104.307H141.9L143.894 97.1625L148.119 104.324L155.114 97.9856L153.36 104.307H156.009L158.594 95.0416L159.693 91.1058H159.689Z"
                                                fill="#6D6E71" />
                                            <path
                                                d="M98.8666 106.779H98.9969C99.1593 106.779 99.2797 106.758 99.3575 106.717C99.4345 106.675 99.4855 106.606 99.5092 106.508C99.5351 106.4 99.5214 106.325 99.4703 106.282C99.4185 106.238 99.3056 106.217 99.1334 106.217H99.003L98.8666 106.779ZM98.6577 107.644H98.7751C98.894 107.644 98.984 107.641 99.0457 107.632C99.1067 107.622 99.1578 107.607 99.1982 107.584C99.2462 107.558 99.2874 107.523 99.3209 107.48C99.3544 107.436 99.3773 107.389 99.3903 107.335C99.4047 107.273 99.404 107.218 99.388 107.172C99.3712 107.126 99.3407 107.09 99.295 107.064C99.266 107.048 99.2317 107.038 99.1921 107.03C99.1517 107.023 99.0983 107.02 99.0289 107.02H98.926H98.8087L98.6577 107.644ZM98.2583 107.911L98.7324 105.952H99.2622C99.4124 105.952 99.5221 105.959 99.5907 105.975C99.6593 105.989 99.7142 106.015 99.7569 106.049C99.811 106.094 99.8476 106.153 99.8659 106.225C99.8842 106.297 99.8827 106.377 99.8621 106.464C99.8354 106.569 99.7897 106.656 99.7211 106.726C99.6517 106.796 99.5656 106.845 99.4604 106.873C99.5785 106.89 99.6624 106.943 99.7112 107.029C99.7607 107.114 99.7699 107.223 99.7378 107.354C99.7188 107.433 99.6853 107.509 99.6388 107.58C99.5915 107.652 99.5351 107.712 99.468 107.763C99.3979 107.817 99.3178 107.855 99.2271 107.878C99.1364 107.9 98.9908 107.911 98.7904 107.911H98.2583Z"
                                                fill="#414042" />
                                            <path
                                                d="M100.837 107.911L101.311 105.952H101.652L101.477 106.674H102.509L102.684 105.952H103.025L102.551 107.911H102.21L102.441 106.959H101.408L101.178 107.911H100.837Z"
                                                fill="#414042" />
                                            <path
                                                d="M104.548 107.141H105.133L105.026 106.694C105.02 106.665 105.016 106.633 105.011 106.595C105.007 106.559 105.004 106.517 105.001 106.471C104.978 106.514 104.958 106.555 104.936 106.591C104.914 106.628 104.892 106.663 104.872 106.694L104.548 107.141ZM105.305 107.91L105.19 107.406H104.358L103.992 107.91H103.634L105.143 105.874L105.665 107.91H105.305Z"
                                                fill="#414042" />
                                            <path
                                                d="M107.362 106.787H107.424C107.605 106.787 107.729 106.768 107.798 106.729C107.867 106.689 107.913 106.619 107.938 106.52C107.964 106.411 107.95 106.335 107.897 106.291C107.845 106.247 107.732 106.225 107.561 106.225H107.499L107.362 106.787ZM107.282 107.035L107.069 107.911H106.75L107.224 105.952H107.699C107.839 105.952 107.945 105.961 108.018 105.977C108.091 105.994 108.15 106.022 108.195 106.062C108.248 106.109 108.284 106.171 108.301 106.245C108.318 106.32 108.316 106.401 108.295 106.491C108.256 106.648 108.186 106.771 108.083 106.86C107.981 106.949 107.848 107.002 107.685 107.02L108.192 107.911H107.806L107.32 107.035H107.282Z"
                                                fill="#414042" />
                                            <path
                                                d="M109.909 107.141H110.494L110.388 106.694C110.382 106.665 110.376 106.633 110.373 106.595C110.369 106.559 110.365 106.517 110.363 106.471C110.34 106.514 110.318 106.555 110.297 106.591C110.274 106.628 110.253 106.663 110.233 106.694L109.909 107.141ZM110.666 107.91L110.551 107.406H109.719L109.353 107.91H108.995L110.504 105.874L111.026 107.91H110.666Z"
                                                fill="#414042" />
                                            <path
                                                d="M113.037 106.222L112.627 107.911H112.287L112.695 106.222H112.137L112.203 105.952H113.656L113.592 106.222H113.037Z"
                                                fill="#414042" />
                                            <path d="M116.108 107.911L116.583 105.952H116.923L116.449 107.911H116.108Z"
                                                fill="#414042" />
                                            <path
                                                d="M117.826 107.911L118.319 105.875L119.362 107.072C119.39 107.106 119.419 107.142 119.446 107.18C119.474 107.219 119.502 107.262 119.532 107.31L119.861 105.952H120.176L119.684 107.987L118.619 106.768C118.59 106.735 118.564 106.701 118.539 106.664C118.513 106.627 118.49 106.588 118.47 106.548L118.139 107.911H117.826Z"
                                                fill="#414042" />
                                            <path
                                                d="M122.157 106.222L121.748 107.911H121.408L121.816 106.222H121.258L121.324 105.952H122.777L122.713 106.222H122.157Z"
                                                fill="#414042" />
                                            <path
                                                d="M123.451 107.911L123.925 105.952H125.096L125.03 106.222H124.2L124.081 106.713H124.911L124.843 106.993H124.013L123.86 107.626H124.69L124.622 107.911H123.451Z"
                                                fill="#414042" />
                                            <path
                                                d="M126.513 106.787H126.575C126.755 106.787 126.879 106.768 126.949 106.729C127.017 106.689 127.064 106.619 127.088 106.52C127.114 106.411 127.1 106.335 127.048 106.291C126.995 106.247 126.882 106.225 126.711 106.225H126.649L126.513 106.787ZM126.432 107.035L126.219 107.911H125.9L126.374 105.952H126.85C126.989 105.952 127.096 105.961 127.168 105.977C127.241 105.994 127.3 106.022 127.345 106.062C127.399 106.109 127.434 106.171 127.451 106.245C127.469 106.32 127.466 106.401 127.445 106.491C127.407 106.648 127.336 106.771 127.233 106.86C127.131 106.949 126.998 107.002 126.835 107.02L127.342 107.911H126.956L126.47 107.035H126.432Z"
                                                fill="#414042" />
                                            <path
                                                d="M128.43 107.911L128.904 105.952H130.075L130.01 106.222H129.179L129.062 106.71H129.892L129.824 106.99H128.994L128.771 107.911H128.43Z"
                                                fill="#414042" />
                                            <path
                                                d="M131.382 107.141H131.967L131.86 106.694C131.854 106.665 131.85 106.633 131.845 106.595C131.841 106.559 131.838 106.517 131.835 106.471C131.813 106.514 131.792 106.555 131.77 106.591C131.748 106.628 131.726 106.663 131.706 106.694L131.382 107.141ZM132.139 107.91L132.024 107.406H131.192L130.827 107.91H130.468L131.977 105.874L132.499 107.91H132.139Z"
                                                fill="#414042" />
                                            <path
                                                d="M135.575 106.428C135.496 106.351 135.409 106.293 135.31 106.255C135.212 106.217 135.104 106.197 134.986 106.197C134.757 106.197 134.553 106.266 134.376 106.404C134.199 106.541 134.084 106.719 134.031 106.938C133.979 107.149 134.008 107.323 134.114 107.461C134.221 107.599 134.381 107.667 134.594 107.667C134.718 107.667 134.841 107.646 134.963 107.605C135.085 107.564 135.209 107.502 135.332 107.419L135.245 107.78C135.138 107.841 135.027 107.888 134.912 107.918C134.796 107.948 134.675 107.963 134.55 107.963C134.389 107.963 134.247 107.938 134.123 107.889C133.998 107.84 133.896 107.768 133.815 107.672C133.736 107.579 133.685 107.468 133.66 107.341C133.636 107.214 133.642 107.078 133.676 106.935C133.711 106.791 133.771 106.657 133.857 106.53C133.942 106.404 134.049 106.293 134.176 106.197C134.303 106.101 134.441 106.029 134.587 105.978C134.733 105.929 134.886 105.905 135.043 105.905C135.165 105.905 135.279 105.921 135.383 105.955C135.486 105.988 135.582 106.039 135.672 106.107L135.575 106.428Z"
                                                fill="#414042" />
                                            <path
                                                d="M136.525 107.911L137 105.952H138.17L138.105 106.222H137.275L137.157 106.713H137.987L137.919 106.993H137.089L136.935 107.626H137.766L137.696 107.911H136.525Z"
                                                fill="#414042" />
                                            <path
                                                d="M140.747 107.911L141.221 105.952H142.392L142.326 106.222H141.496L141.378 106.71H142.208L142.14 106.99H141.31L141.088 107.911H140.747Z"
                                                fill="#414042" />
                                            <path
                                                d="M145.206 106.935C145.231 106.836 145.234 106.742 145.217 106.653C145.199 106.564 145.163 106.484 145.108 106.415C145.054 106.346 144.984 106.293 144.9 106.257C144.816 106.22 144.722 106.2 144.618 106.2C144.516 106.2 144.413 106.219 144.311 106.256C144.209 106.292 144.113 106.345 144.024 106.415C143.935 106.483 143.86 106.563 143.8 106.651C143.74 106.74 143.698 106.835 143.674 106.935C143.65 107.034 143.647 107.128 143.664 107.216C143.681 107.304 143.717 107.383 143.772 107.453C143.828 107.522 143.898 107.576 143.982 107.612C144.066 107.649 144.16 107.667 144.264 107.667C144.366 107.667 144.467 107.649 144.569 107.612C144.67 107.576 144.766 107.522 144.856 107.453C144.945 107.383 145.021 107.304 145.08 107.215C145.141 107.127 145.183 107.034 145.206 106.935ZM145.562 106.935C145.529 107.074 145.469 107.205 145.382 107.33C145.297 107.453 145.189 107.564 145.058 107.661C144.926 107.759 144.786 107.833 144.638 107.885C144.49 107.937 144.341 107.963 144.192 107.963C144.041 107.963 143.903 107.937 143.779 107.885C143.655 107.832 143.551 107.758 143.47 107.661C143.386 107.564 143.332 107.454 143.306 107.331C143.281 107.208 143.284 107.076 143.319 106.935C143.352 106.795 143.412 106.664 143.498 106.539C143.583 106.415 143.692 106.304 143.823 106.205C143.952 106.108 144.092 106.035 144.24 105.984C144.388 105.932 144.538 105.908 144.689 105.908C144.841 105.908 144.977 105.932 145.101 105.984C145.224 106.035 145.327 106.108 145.41 106.205C145.493 106.305 145.548 106.417 145.574 106.541C145.599 106.666 145.596 106.796 145.562 106.935Z"
                                                fill="#414042" />
                                            <path
                                                d="M147.217 106.787H147.279C147.459 106.787 147.584 106.768 147.652 106.729C147.721 106.689 147.768 106.619 147.792 106.52C147.818 106.411 147.805 106.335 147.751 106.291C147.699 106.247 147.586 106.225 147.415 106.225H147.353L147.217 106.787ZM147.136 107.035L146.923 107.911H146.604L147.078 105.952H147.553C147.693 105.952 147.8 105.961 147.872 105.977C147.945 105.994 148.004 106.022 148.05 106.062C148.102 106.109 148.138 106.171 148.155 106.245C148.172 106.32 148.17 106.401 148.149 106.491C148.111 106.648 148.04 106.771 147.937 106.86C147.835 106.949 147.702 107.002 147.539 107.02L148.046 107.911H147.66L147.174 107.035H147.136Z"
                                                fill="#414042" />
                                            <path
                                                d="M152.852 106.943C152.852 106.928 152.856 106.887 152.865 106.817C152.87 106.761 152.875 106.713 152.878 106.676C152.859 106.72 152.836 106.765 152.81 106.809C152.783 106.854 152.753 106.9 152.717 106.946L151.916 107.99L151.624 106.925C151.611 106.881 151.602 106.839 151.596 106.798C151.589 106.756 151.584 106.716 151.581 106.676C151.57 106.716 151.557 106.76 151.539 106.805C151.522 106.85 151.502 106.897 151.477 106.946L151.019 107.911H150.705L151.694 105.869L152.015 107.105C152.019 107.125 152.026 107.157 152.035 107.203C152.043 107.249 152.054 107.304 152.065 107.371C152.099 107.316 152.147 107.244 152.211 107.157C152.229 107.135 152.241 107.117 152.25 107.104L153.154 105.869L153.167 107.911H152.851L152.852 106.943Z"
                                                fill="#414042" />
                                            <path
                                                d="M156.358 106.935C156.382 106.836 156.386 106.742 156.369 106.653C156.352 106.564 156.315 106.484 156.259 106.415C156.205 106.346 156.136 106.293 156.052 106.257C155.967 106.22 155.874 106.2 155.771 106.2C155.668 106.2 155.565 106.219 155.463 106.256C155.361 106.292 155.265 106.345 155.175 106.415C155.086 106.483 155.011 106.563 154.952 106.651C154.892 106.74 154.85 106.835 154.825 106.935C154.802 107.034 154.798 107.128 154.816 107.216C154.832 107.304 154.868 107.383 154.925 107.453C154.979 107.522 155.05 107.576 155.134 107.612C155.217 107.649 155.312 107.667 155.416 107.667C155.518 107.667 155.619 107.649 155.72 107.612C155.822 107.576 155.917 107.522 156.008 107.453C156.097 107.383 156.172 107.304 156.233 107.215C156.293 107.127 156.335 107.034 156.358 106.935ZM156.714 106.935C156.68 107.074 156.621 107.205 156.534 107.33C156.448 107.453 156.341 107.564 156.21 107.661C156.079 107.759 155.938 107.833 155.79 107.885C155.642 107.937 155.493 107.963 155.344 107.963C155.193 107.963 155.055 107.937 154.931 107.885C154.806 107.832 154.703 107.758 154.622 107.661C154.537 107.564 154.483 107.454 154.458 107.331C154.432 107.208 154.437 107.076 154.47 106.935C154.504 106.795 154.564 106.664 154.649 106.539C154.735 106.415 154.843 106.304 154.974 106.205C155.104 106.108 155.244 106.035 155.392 105.984C155.54 105.932 155.69 105.908 155.842 105.908C155.993 105.908 156.13 105.932 156.252 105.984C156.375 106.035 156.479 106.108 156.563 106.205C156.645 106.305 156.699 106.417 156.725 106.541C156.752 106.666 156.747 106.796 156.714 106.935Z"
                                                fill="#414042" />
                                            <path
                                                d="M157.755 107.911L158.248 105.875L159.292 107.072C159.32 107.106 159.348 107.142 159.376 107.18C159.403 107.219 159.432 107.262 159.461 107.31L159.791 105.952H160.105L159.614 107.987L158.548 106.768C158.519 106.735 158.493 106.701 158.468 106.664C158.442 106.627 158.42 106.588 158.399 106.548L158.069 107.911H157.755Z"
                                                fill="#414042" />
                                            <path
                                                d="M161 107.911L161.475 105.952H162.645L162.58 106.222H161.75L161.631 106.713H162.461L162.393 106.993H161.563L161.41 107.626H162.24L162.171 107.911H161Z"
                                                fill="#414042" />
                                            <path
                                                d="M163.9 107.911L164.118 107.014L163.668 105.952H164.026L164.305 106.616C164.311 106.634 164.32 106.656 164.329 106.683C164.337 106.711 164.346 106.741 164.356 106.773C164.375 106.742 164.397 106.713 164.419 106.685C164.44 106.658 164.461 106.633 164.484 106.608L165.094 105.952H165.436L164.456 107.014L164.238 107.911H163.9Z"
                                                fill="#414042" />
                                        </g>
                                    </g>
                                    <g clip-path="url(#clip10_3830_1693)">
                                        <rect x="0.25" y="82.25" width="81.5" height="33.5" rx="2.75"
                                            stroke="#D1D5D5" stroke-width="0.5" />
                                        <g clip-path="url(#clip11_3830_1693)">
                                            <path
                                                d="M26.0718 101.37C27.1433 96.9959 24.3333 92.6127 19.7955 91.5798C15.2577 90.5469 10.7104 93.2555 9.6389 97.6297C8.56737 102.004 11.3774 106.387 15.9152 107.42C20.453 108.453 25.0003 105.744 26.0718 101.37Z"
                                                fill="#5F259F" />
                                            <path
                                                d="M52.1082 104.15V101.195C52.1082 100.467 51.8252 100.104 51.1177 100.104C50.8347 100.104 50.5046 100.149 50.3159 100.195V104.514C50.3159 104.65 50.1744 104.786 50.0329 104.786H48.9482C48.8067 104.786 48.6652 104.65 48.6652 104.514V99.4673C48.6652 99.2854 48.8067 99.149 48.9482 99.1036C49.6556 98.8762 50.3631 98.7399 51.1177 98.7399C52.8156 98.7399 53.7589 99.6037 53.7589 101.195V104.559C53.7589 104.696 53.6174 104.832 53.4759 104.832H52.8156C52.3912 104.832 52.1082 104.514 52.1082 104.15ZM56.353 102.377L56.3058 102.786C56.3058 103.332 56.6831 103.65 57.2962 103.65C57.7679 103.65 58.1924 103.513 58.664 103.286C58.7112 103.286 58.7583 103.241 58.8055 103.241C58.8998 103.241 58.947 103.286 58.9942 103.332C59.0413 103.377 59.1356 103.513 59.1356 103.513C59.23 103.65 59.3243 103.832 59.3243 103.968C59.3243 104.195 59.1828 104.423 58.9942 104.514C58.4753 104.786 57.8622 104.923 57.2019 104.923C56.4473 104.923 55.8341 104.741 55.3625 104.377C54.8909 103.968 54.6079 103.423 54.6079 102.741V100.968C54.6079 99.5582 55.5512 98.6944 57.1547 98.6944C58.7112 98.6944 59.6073 99.5127 59.6073 100.968V102.059C59.6073 102.195 59.4658 102.331 59.3243 102.331H56.353V102.377ZM56.3058 101.377H58.098V100.922C58.098 100.377 57.7679 100.013 57.2019 100.013C56.6359 100.013 56.3058 100.331 56.3058 100.922V101.377ZM68.3327 102.377L68.2855 102.786C68.2855 103.332 68.6628 103.65 69.276 103.65C69.7476 103.65 70.1721 103.513 70.6437 103.286C70.6909 103.286 70.7381 103.241 70.7852 103.241C70.8796 103.241 70.9267 103.286 70.9739 103.332C71.0211 103.377 71.1154 103.513 71.1154 103.513C71.2097 103.65 71.304 103.832 71.304 103.968C71.304 104.195 71.1625 104.423 70.9739 104.514C70.4551 104.786 69.8419 104.923 69.1816 104.923C68.427 104.923 67.8139 104.741 67.3422 104.377C66.8706 103.968 66.5876 103.423 66.5876 102.741V100.968C66.5876 99.5582 67.5309 98.6944 69.1345 98.6944C70.6909 98.6944 71.587 99.5127 71.587 100.968V102.059C71.587 102.195 71.4455 102.331 71.304 102.331H68.3327V102.377ZM68.2855 101.377H70.0778V100.922C70.0778 100.377 69.7476 100.013 69.1816 100.013C68.6157 100.013 68.2855 100.331 68.2855 100.922V101.377ZM40.5529 104.832H41.2132C41.3547 104.832 41.4962 104.696 41.4962 104.559V101.195C41.4962 99.6491 40.6472 98.7399 39.2323 98.7399C38.8078 98.7399 38.3362 98.8308 38.0532 98.9217V97.2396C38.0532 96.8759 37.723 96.5576 37.3457 96.5576H36.6854C36.5439 96.5576 36.4024 96.694 36.4024 96.8304V104.559C36.4024 104.696 36.5439 104.832 36.6854 104.832H37.7702C37.9117 104.832 38.0532 104.696 38.0532 104.559V100.286C38.289 100.195 38.6192 100.149 38.855 100.149C39.5625 100.149 39.8454 100.467 39.8454 101.24V104.195C39.8926 104.514 40.1756 104.832 40.5529 104.832ZM47.6747 101.013V102.695C47.6747 104.105 46.6843 104.968 45.0335 104.968C43.4299 104.968 42.3923 104.105 42.3923 102.695V101.013C42.3923 99.6037 43.3828 98.7399 45.0335 98.7399C46.6843 98.7399 47.6747 99.6037 47.6747 101.013ZM46.024 101.013C46.024 100.467 45.6938 100.104 45.0807 100.104C44.4675 100.104 44.1374 100.422 44.1374 101.013V102.695C44.1374 103.241 44.4675 103.559 45.0807 103.559C45.6938 103.559 46.024 103.241 46.024 102.695V101.013ZM35.5063 100.24C35.5063 101.695 34.3744 102.695 32.8651 102.695C32.4878 102.695 32.1577 102.65 31.8275 102.513V104.559C31.8275 104.696 31.686 104.832 31.5445 104.832H30.4597C30.3183 104.832 30.1768 104.696 30.1768 104.559V97.3305C30.1768 97.1486 30.3183 97.0122 30.4597 96.9668C31.1672 96.7395 31.8747 96.6031 32.6293 96.6031C34.3272 96.6031 35.5063 97.6033 35.5063 99.149V100.24ZM33.8084 99.0581C33.8084 98.3307 33.2896 97.967 32.5821 97.967C32.1577 97.967 31.8747 98.1034 31.8747 98.1034V101.104C32.1577 101.24 32.2992 101.286 32.6293 101.286C33.3368 101.286 33.8556 100.877 33.8556 100.195V99.0581H33.8084ZM65.9745 100.24C65.9745 101.695 64.8425 102.695 63.3333 102.695C62.956 102.695 62.6258 102.65 62.2957 102.513V104.559C62.2957 104.696 62.1542 104.832 62.0127 104.832H60.9279C60.7864 104.832 60.6449 104.696 60.6449 104.559V97.3305C60.6449 97.1486 60.7864 97.0122 60.9279 96.9668C61.6354 96.7395 62.3428 96.6031 63.0975 96.6031C64.7954 96.6031 65.9745 97.6033 65.9745 99.149V100.24ZM64.2766 99.0581C64.2766 98.3307 63.7577 97.967 63.0503 97.967C62.6258 97.967 62.3428 98.1034 62.3428 98.1034V101.104C62.6258 101.24 62.7673 101.286 63.0975 101.286C63.8049 101.286 64.3237 100.877 64.3237 100.195V99.0581H64.2766Z"
                                                fill="#5F259F" />
                                            <path
                                                d="M21.6869 97.3763C21.6869 97.0581 21.4039 96.7853 21.0737 96.7853H19.9418L17.3478 93.9211C17.1119 93.6484 16.7346 93.5574 16.3573 93.6484L15.4612 93.9211C15.3197 93.9666 15.2725 94.1485 15.3669 94.2394L18.1967 96.8308H13.9048C13.7633 96.8308 13.6689 96.9217 13.6689 97.0581V97.5127C13.6689 97.831 13.9519 98.1038 14.2821 98.1038H14.9424V100.286C14.9424 101.923 15.8385 102.877 17.3478 102.877C17.8194 102.877 18.1967 102.832 18.6684 102.65V104.105C18.6684 104.514 18.9985 104.832 19.423 104.832H20.0833C20.2248 104.832 20.3663 104.696 20.3663 104.56V98.0583H21.4511C21.5925 98.0583 21.6869 97.9674 21.6869 97.831V97.3763ZM18.6684 101.286C18.3854 101.423 18.0081 101.468 17.7251 101.468C16.9704 101.468 16.5931 101.104 16.5931 100.286V98.1038H18.6684V101.286Z"
                                                fill="white" />
                                        </g>
                                    </g>
                                    <g clip-path="url(#clip12_3830_1693)">
                                        <rect x="184.25" y="40.25" width="72.5" height="33.5" rx="2.75"
                                            stroke="#D1D5D5" stroke-width="0.5" />
                                        <g clip-path="url(#clip13_3830_1693)">
                                            <path
                                                d="M246.836 53.9865C246.618 53.3065 246.126 52.6831 245.525 52.2298C244.924 51.7765 244.213 51.5498 243.503 51.5498H243.448C242.957 51.5498 242.52 51.6631 242.082 51.8331C241.645 52.0031 241.263 52.2865 240.935 52.6831C240.607 52.3431 240.225 52.0598 239.788 51.8331C239.351 51.6631 238.859 51.5498 238.422 51.5498H238.367C237.547 51.5498 236.728 51.8331 236.072 52.3998V52.1731C236.072 52.0598 236.018 51.8898 235.908 51.8331C235.799 51.7198 235.69 51.6631 235.58 51.6631H233.231C233.176 51.6631 233.122 51.6631 233.012 51.7198C232.903 51.7765 232.848 51.8331 232.794 51.8331C232.739 51.8898 232.685 51.9465 232.685 52.0031C232.685 52.0598 232.63 52.1165 232.63 52.2298V65.3765C232.63 65.5465 232.685 65.6598 232.794 65.7731C232.903 65.8865 233.012 65.9431 233.176 65.9431H235.526C235.635 65.9431 235.799 65.8865 235.854 65.8298C235.963 65.7731 236.018 65.6031 236.018 65.4898V56.0265C236.018 55.9698 236.018 55.9698 236.018 55.9131C236.018 55.6865 236.127 55.5165 236.291 55.3465C236.455 55.1765 236.619 55.1198 236.837 55.1198H237.274C237.438 55.1198 237.602 55.1765 237.766 55.2898C237.875 55.4031 237.93 55.4598 237.985 55.6298C238.039 55.7431 238.094 55.9131 238.039 56.0265V65.3765C238.039 65.5465 238.094 65.6598 238.203 65.7731C238.312 65.8865 238.422 65.9431 238.586 65.9431H240.99C241.099 65.9431 241.263 65.8865 241.372 65.7731C241.481 65.6598 241.536 65.5465 241.536 65.4331V56.0265C241.536 55.8565 241.591 55.7431 241.645 55.5731C241.7 55.4598 241.809 55.3465 241.919 55.2331C242.028 55.1198 242.192 55.1198 242.356 55.0631H242.793C243.011 55.0631 243.23 55.1765 243.394 55.3465C243.558 55.5165 243.612 55.7431 243.612 55.9698V65.3198C243.612 65.4898 243.667 65.6031 243.776 65.7165C243.886 65.8298 243.995 65.8865 244.159 65.8865H246.454C246.508 65.8865 246.618 65.8865 246.672 65.8298C246.727 65.8298 246.781 65.7731 246.836 65.7165C246.891 65.6598 246.945 65.6031 246.945 65.5465C246.945 65.4898 247 65.4331 247 65.3198V55.2898C247 54.8365 246.945 54.4398 246.836 53.9865Z"
                                                fill="#00BAF2" />
                                            <path
                                                d="M230.827 51.72H229.461V49.4533C229.461 49.3967 229.461 49.34 229.406 49.2833C229.406 49.2267 229.351 49.17 229.297 49.1133C229.242 49.0567 229.187 49.0567 229.133 49C229.133 49 229.078 49 229.024 49C228.969 49 228.969 49 228.914 49C227.439 49.3967 227.712 51.55 224.98 51.72H224.707C224.652 51.72 224.652 51.72 224.598 51.72C224.489 51.72 224.379 51.8333 224.325 51.89C224.27 52.0033 224.215 52.1167 224.215 52.23V54.6667C224.215 54.8367 224.27 54.95 224.379 55.0633C224.489 55.1767 224.598 55.2333 224.762 55.2333H226.182V65.49C226.182 65.5467 226.182 65.6033 226.237 65.7167C226.237 65.7733 226.292 65.83 226.346 65.8867C226.401 65.9433 226.456 66 226.51 66C226.565 66 226.619 66.0567 226.729 66.0567H228.969C229.133 66.0567 229.242 66 229.351 65.8867C229.461 65.7733 229.515 65.66 229.515 65.49V55.2333H230.827C230.881 55.2333 230.936 55.2333 231.045 55.1767C231.1 55.1767 231.155 55.12 231.209 55.0633C231.264 55.0067 231.318 54.95 231.318 54.8933C231.318 54.8367 231.373 54.78 231.373 54.6667V52.2867C231.373 52.1733 231.318 52.0033 231.209 51.89C231.1 51.7767 230.991 51.72 230.827 51.72Z"
                                                fill="#00BAF2" />
                                            <path
                                                d="M222.358 51.7197H220.008C219.844 51.7197 219.735 51.7764 219.626 51.8897C219.517 52.0031 219.462 52.1164 219.462 52.2864V57.2731C219.462 57.4431 219.407 57.5564 219.298 57.6697C219.189 57.7831 219.079 57.8397 218.916 57.8397H217.932C217.877 57.8397 217.768 57.8397 217.713 57.7831C217.659 57.7264 217.604 57.7264 217.55 57.6697C217.495 57.6131 217.44 57.5564 217.44 57.4997C217.44 57.4431 217.386 57.3297 217.386 57.2731V52.2864C217.386 52.1731 217.331 52.0031 217.222 51.8897C217.112 51.7764 217.003 51.7197 216.839 51.7197H214.49C214.435 51.7197 214.38 51.7197 214.271 51.7764C214.217 51.7764 214.162 51.8331 214.107 51.8897C214.053 51.9464 213.998 52.0031 213.998 52.0597C213.998 52.1164 213.943 52.1731 213.943 52.2864V57.7831C213.943 58.2364 213.998 58.7464 214.162 59.1431C214.326 59.5964 214.599 59.9931 214.927 60.3331C215.255 60.6731 215.637 60.9564 216.074 61.1264C216.511 61.2964 216.949 61.3531 217.44 61.3531C217.44 61.3531 218.97 61.3531 219.025 61.3531C219.134 61.3531 219.298 61.4097 219.353 61.5231C219.462 61.6364 219.517 61.7497 219.517 61.9197C219.517 62.0331 219.462 62.2031 219.353 62.3164C219.243 62.4297 219.134 62.4864 219.025 62.4864H218.97H215.528C215.364 62.4864 215.255 62.5431 215.145 62.6564C215.036 62.7697 214.982 62.8831 214.982 63.0531V65.4331C214.982 65.6031 215.036 65.7164 215.145 65.8297C215.255 65.9431 215.364 65.9997 215.528 65.9997H219.407C219.844 65.9997 220.336 65.9431 220.773 65.7731C221.21 65.6031 221.593 65.3197 221.921 64.9797C222.249 64.6397 222.522 64.2431 222.686 63.7897C222.85 63.3364 222.959 62.8831 222.904 62.4297V52.2864C222.904 52.2297 222.904 52.1731 222.85 52.0597C222.85 52.0031 222.795 51.9464 222.74 51.8897C222.686 51.8331 222.631 51.7764 222.576 51.7764C222.467 51.7197 222.412 51.7197 222.358 51.7197Z"
                                                fill="#002970" />
                                            <path
                                                d="M199.682 51.7197H194.492C194.382 51.7197 194.219 51.7764 194.109 51.8897C194.055 52.0031 194 52.1164 194 52.2297V54.6097C194 54.6097 194 54.6097 194 54.6664V65.3764C194 65.4897 194.055 65.6597 194.109 65.7164C194.219 65.8297 194.328 65.8864 194.437 65.8864H196.841C197.005 65.8864 197.114 65.8297 197.224 65.7164C197.333 65.6031 197.388 65.4897 197.388 65.3197V61.6364H199.628C200.065 61.6364 200.502 61.5797 200.885 61.4097C201.267 61.2397 201.649 61.0131 201.923 60.6731C202.251 60.3897 202.469 59.9931 202.633 59.5964C202.797 59.1997 202.852 58.7464 202.852 58.2931V54.8931C202.852 54.4397 202.797 54.0431 202.633 53.5897C202.469 53.1931 202.251 52.7964 201.923 52.5131C201.595 52.2297 201.267 51.9464 200.885 51.7764C200.557 51.7764 200.12 51.7197 199.682 51.7197ZM199.464 56.1397V57.6131C199.464 57.7831 199.409 57.8964 199.3 58.0097C199.191 58.1231 199.081 58.1797 198.918 58.1797H197.442V55.2331H198.918C199.081 55.2331 199.191 55.2897 199.3 55.4031C199.409 55.5164 199.464 55.6297 199.464 55.7997V56.1397Z"
                                                fill="#002970" />
                                            <path
                                                d="M208.916 51.7197H205.638C205.529 51.7197 205.365 51.7764 205.255 51.8331C205.146 51.9464 205.092 52.0597 205.092 52.1731V53.1364V54.4397C205.092 54.6097 205.146 54.7231 205.255 54.8364C205.365 54.9497 205.474 55.0064 205.638 55.0064H208.752C208.862 55.0064 208.971 55.0631 209.08 55.1764C209.19 55.2897 209.244 55.4031 209.244 55.5164V55.7997C209.244 55.9131 209.19 56.0264 209.08 56.1397C208.971 56.2531 208.862 56.3097 208.752 56.3097H207.222C206.785 56.2531 206.294 56.3097 205.911 56.4797C205.474 56.6497 205.092 56.8764 204.764 57.2164C204.436 57.5564 204.163 57.8964 203.999 58.3497C203.835 58.7464 203.726 59.2564 203.726 59.7097V62.5431C203.726 62.9964 203.78 63.4497 203.944 63.8464C204.108 64.2431 204.327 64.6397 204.654 64.9797C204.982 65.3197 205.365 65.5464 205.747 65.7164C206.184 65.8864 206.621 65.9431 207.059 65.8864H211.32C211.703 65.8864 212.031 65.7731 212.304 65.4897C212.577 65.2631 212.741 64.8664 212.741 64.5264V55.4031C212.686 53.1364 211.594 51.7197 208.916 51.7197ZM209.244 61.8631V62.2597C209.244 62.3164 209.244 62.3164 209.244 62.3731V62.4297C209.19 62.5431 209.135 62.6564 209.026 62.7131C208.916 62.7697 208.807 62.8264 208.698 62.8264H207.714C207.55 62.8264 207.441 62.7697 207.332 62.6564C207.222 62.5431 207.168 62.4297 207.168 62.2597V61.8064V60.6164V60.2197C207.168 60.0497 207.222 59.9364 207.332 59.8231C207.441 59.7097 207.55 59.6531 207.714 59.6531H208.698C208.862 59.6531 208.971 59.7097 209.08 59.8231C209.19 59.9364 209.244 60.0497 209.244 60.2197V61.8631Z"
                                                fill="#002970" />
                                        </g>
                                    </g>
                                    <g clip-path="url(#clip14_3830_1693)">
                                        <rect x="94.25" y="40.25" width="82.5" height="33.5" rx="2.75"
                                            stroke="#D1D5D5" stroke-width="0.5" />
                                        <g clip-path="url(#clip15_3830_1693)">
                                            <path d="M164.305 50.2475L167.971 57.4838L160.265 64.7236L164.305 50.2475Z"
                                                fill="#008C44" />
                                            <path d="M161.767 50.2475L165.427 57.4838L157.727 64.7236L161.767 50.2475Z"
                                                fill="#F47920" />
                                            <path
                                                d="M103 62.0908L106.655 49H112.497C114.323 49 115.543 49.2874 116.164 49.8797C116.78 50.4672 116.899 51.4262 116.527 52.7741C116.303 53.5681 115.961 54.2346 115.492 54.7612C115.027 55.2888 114.413 55.7059 113.658 56.0127C114.299 56.1659 114.707 56.4701 114.889 56.9263C115.071 57.3825 115.05 58.0477 114.829 58.9198L114.385 60.7483L114.384 60.7978C114.255 61.3098 114.293 61.5839 114.502 61.6061L114.368 62.0908H110.415C110.429 61.7828 110.453 61.5074 110.479 61.2762C110.508 61.0395 110.543 60.8562 110.579 60.7302L110.947 59.4229C111.133 58.7431 111.144 58.2688 110.972 57.9957C110.798 57.7153 110.409 57.5773 109.794 57.5773H108.133L106.866 62.0908H103ZM108.955 54.6274H110.734C111.358 54.6274 111.818 54.5389 112.101 54.3558C112.386 54.1712 112.598 53.8594 112.722 53.4083C112.851 52.9495 112.819 52.6298 112.635 52.448C112.451 52.2634 112.01 52.1736 111.317 52.1736H109.64L108.955 54.6274Z"
                                                fill="#1B3281" />
                                            <path
                                                d="M127.375 52.4309L124.681 62.0908H121.407L121.809 60.6757C121.233 61.2385 120.643 61.6658 120.049 61.9389C119.459 62.2168 118.837 62.3535 118.182 62.3535C117.64 62.3535 117.176 62.2558 116.801 62.062C116.423 61.8688 116.141 61.575 115.951 61.1877C115.782 60.8486 115.709 60.4298 115.738 59.9296C115.768 59.4372 115.943 58.6067 116.267 57.4438L117.663 52.4309H121.244L119.851 57.4203C119.647 58.1505 119.599 58.6638 119.698 58.9433C119.802 59.2253 120.078 59.3709 120.525 59.3709C120.977 59.3709 121.356 59.2085 121.669 58.877C121.987 58.5483 122.232 58.0582 122.417 57.406L123.799 52.4309H127.375Z"
                                                fill="#1B3281" />
                                            <path
                                                d="M126.076 62.0908L129.726 49H134.749C135.857 49 136.714 49.0651 137.326 49.2078C137.936 49.3445 138.415 49.5666 138.771 49.8797C139.217 50.2893 139.49 50.7962 139.602 51.4043C139.708 52.0124 139.645 52.7208 139.414 53.5526C139.005 55.016 138.288 56.1374 137.266 56.9209C136.241 57.6943 134.973 58.0829 133.46 58.0829H131.11L129.993 62.0908H126.076ZM132 54.8859H133.262C134.079 54.8859 134.653 54.7857 134.989 54.5922C135.315 54.3961 135.546 54.0478 135.687 53.5526C135.828 53.0507 135.792 52.6999 135.579 52.5038C135.373 52.3087 134.849 52.2101 134.01 52.2101H132.75L132 54.8859Z"
                                                fill="#1B3281" />
                                            <path
                                                d="M143.627 62.0912L143.663 61.1738C143.086 61.6037 142.501 61.9285 141.913 62.1315C141.328 62.3384 140.704 62.4434 140.036 62.4434C139.022 62.4434 138.315 62.1693 137.906 61.6389C137.502 61.1075 137.435 60.3446 137.711 59.3713C137.975 58.4107 138.444 57.7036 139.121 57.2516C139.794 56.7941 140.919 56.4668 142.496 56.2574C142.696 56.225 142.964 56.199 143.3 56.1587C144.466 56.0245 145.121 55.7156 145.262 55.2115C145.335 54.9355 145.291 54.7318 145.118 54.6068C144.952 54.4771 144.641 54.4133 144.193 54.4133C143.82 54.4133 143.521 54.4901 143.275 54.6497C143.03 54.8108 142.847 55.0462 142.723 55.3774H139.231C139.546 54.2899 140.19 53.4683 141.157 52.9189C142.121 52.3599 143.392 52.0909 144.965 52.0909C145.705 52.0909 146.368 52.1597 146.954 52.3091C147.54 52.4522 147.969 52.6562 148.248 52.903C148.59 53.211 148.792 53.5622 148.85 53.9505C148.917 54.3378 148.844 54.893 148.64 55.6194L147.138 61.005C147.09 61.1814 147.08 61.3388 147.107 61.4818C147.138 61.6182 147.198 61.735 147.304 61.8184L147.223 62.0912H143.627ZM144.497 57.7779C144.117 57.9298 143.623 58.0754 143.009 58.2353C142.044 58.4926 141.501 58.8358 141.384 59.2606C141.303 59.5337 141.336 59.7441 141.47 59.9039C141.602 60.0559 141.832 60.1327 142.156 60.1327C142.751 60.1327 143.228 59.9832 143.584 59.6882C143.941 59.3894 144.207 58.9202 144.394 58.2731C144.427 58.1354 144.455 58.0364 144.474 57.9625L144.497 57.7779Z"
                                                fill="#1B3281" />
                                            <path
                                                d="M147.25 65.8972L148.045 63.038H149.07C149.412 63.038 149.681 62.9707 149.872 62.8483C150.066 62.7211 150.198 62.5066 150.274 62.218C150.311 62.0907 150.335 61.9569 150.351 61.8049C150.361 61.6438 150.361 61.4734 150.351 61.2761L149.804 52.4308H153.429L153.373 58.2919L156.537 52.4308H159.908L154.314 62.0441C153.679 63.1186 153.217 63.8568 152.924 64.2596C152.635 64.6574 152.361 64.9667 152.094 65.1761C151.749 65.4657 151.364 65.671 150.948 65.7906C150.531 65.9127 149.896 65.9736 149.042 65.9736C148.797 65.9736 148.514 65.9689 148.208 65.953C147.905 65.9413 147.581 65.9232 147.25 65.8972Z"
                                                fill="#1B3281" />
                                        </g>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_3830_1693">
                                            <rect width="81" height="34" fill="white"
                                                transform="translate(179)" />
                                        </clipPath>
                                        <clipPath id="clip1_3830_1693">
                                            <rect width="103" height="34" fill="white"
                                                transform="translate(68)" />
                                        </clipPath>
                                        <clipPath id="clip2_3830_1693">
                                            <rect width="87" height="15.252" fill="white"
                                                transform="translate(76 9)" />
                                        </clipPath>
                                        <clipPath id="clip3_3830_1693">
                                            <rect width="61" height="34" fill="white" />
                                        </clipPath>
                                        <clipPath id="clip4_3830_1693">
                                            <rect width="40" height="12.948" fill="white"
                                                transform="translate(10 11)" />
                                        </clipPath>
                                        <clipPath id="clip5_3830_1693">
                                            <rect width="87" height="34" fill="white"
                                                transform="translate(0 40)" />
                                        </clipPath>
                                        <clipPath id="clip6_3830_1693">
                                            <rect width="62" height="34" fill="white"
                                                transform="translate(183 82)" />
                                        </clipPath>
                                        <clipPath id="clip7_3830_1693">
                                            <rect width="43" height="17" fill="white"
                                                transform="translate(192 91)" />
                                        </clipPath>
                                        <clipPath id="clip8_3830_1693">
                                            <rect width="85" height="34" fill="white"
                                                transform="translate(90 82)" />
                                        </clipPath>
                                        <clipPath id="clip9_3830_1693">
                                            <rect width="70" height="17" fill="white"
                                                transform="translate(98 91)" />
                                        </clipPath>
                                        <clipPath id="clip10_3830_1693">
                                            <rect width="82" height="34" fill="white"
                                                transform="translate(0 82)" />
                                        </clipPath>
                                        <clipPath id="clip11_3830_1693">
                                            <rect width="65" height="19" fill="white"
                                                transform="translate(8 90)" />
                                        </clipPath>
                                        <clipPath id="clip12_3830_1693">
                                            <rect width="73" height="34" fill="white"
                                                transform="translate(184 40)" />
                                        </clipPath>
                                        <clipPath id="clip13_3830_1693">
                                            <rect width="53" height="17" fill="white"
                                                transform="translate(194 49)" />
                                        </clipPath>
                                        <clipPath id="clip14_3830_1693">
                                            <rect width="83" height="34" fill="white"
                                                transform="translate(94 40)" />
                                        </clipPath>
                                        <clipPath id="clip15_3830_1693">
                                            <rect width="65" height="17" fill="white"
                                                transform="translate(103 49)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="payment-btn mt-xl-4">
                                <div class="btn-blue">
                                    <span> <img decoding="async" alt="razorpay"
                                            src="{{ asset('assets/front/images/razorpay-icon.svg') }}" /></span>Pay
                                    with
                                    <small>Razorpay</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<footer class="footer-bottom py-xl-4 py-3">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12 col-xl-4">
                <div class="copy-right">
                    <p>&copy; {{ date('Y') }} UttarkashiHotels.in. All Rights Reserved.</p>
                </div>
            </div>
            <div class="col-12 col-lg-12 col-xl-4 text-center">
                <div class="copy-right">
                    <p>Managed By <a href="https://tourtripx.com/"><img decoding="async" alt="TourTripX"
                                src="{{ asset('assets/front/images/ttx-logo.png') }}" width="120" /></a></p>
                </div>
            </div>
            <div class="col-12 col-lg-12 col-xl-4 d-xl-flex justify-content-xl-end">
                <p>Built with <span class="icon-heart"></span> in India</p>
            </div>
        </div>
    </div>
</footer>

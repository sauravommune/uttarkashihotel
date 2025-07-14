<x-guest-layout>
    <!-- Session Status -->

    <div id="auth-center">
        <form class="form w-100" novalidate="novalidate" id="" data-redirect-url="{{ route('login') }}"
            action="{{ route('login') }}" method="POST">

            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Heading-->
                <a href="{{ route('login') }}" class="logo">
                    <img src="{{ asset('assets/media/logos/logo.svg') }}" alt="">
                </a>

                <div class="logo-bottom">
                    <p>Please Sign-In to your account</p>
                </div>
                <x-input-error :messages="$errors->get('message')" class="mt-2 text-danger" />
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <!--begin::Heading-->
                <!--begin::Input group=-->
                <div class="main-form">
                    <div class="form-container">
                        <div class="form-group ">
                            <!--begin::Email-->
                            {{-- <x-input-label for="email" :value="__('Email')" /> --}}
                            <label for="email" :value="__('Email')" class="required form-label">Email</label>
                            {{-- <x-text-input id="email" class="form-control input-custom" type="email"
                            name="email" :value="old('email')" required autofocus autocomplete="username" /> --}}
                            <input type="text" id="email" class="form-control input-custom" type="email"
                                name="email" :value="old('email')" placeholder="Enter Email" required autofocus
                                autocomplete="username" />
                            <span class="material-symbols-outlined">mail</span>

                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />

                            <!--end::Email-->
                        </div>
                        <!--end::Input group=-->
                        <div class="form-group ">
                            <!--begin::Password-->
                            {{-- <x-input-label for="password" :value="__('Password')" /> --}}
                            <label for="password" :value="__('Password')" class="required form-label">Password</label>

                            <input type="password" id="password" class="form-control input-custom" type="password"
                                name="password" required autocomplete="current-password" :value="old('password')" /
                                placeholder="Enter Password">

                            {{-- <span class="material-icons-outlined" >visibility_off</span> --}}
                            <span class="material-symbols-outlined" id="toggle_password">
                                visibility_off
                            </span>

                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                            <!--end::Password-->
                        </div>
                        @if (app()->environment() !== 'local')
                            {!! RecaptchaV3::field('login') !!}
                        @endif
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="remember_me">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" name="remember">
                                <span>{{ __('Keep me logged in') }}</span>
                            </label>
                        </div>
                        <!--begin::Link-->
                        @if (Route::has('password.request'))
                            <a class="link-primary forgot_password" href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                        <!--end::Link-->
                    </div>
                    <input type="hidden" name="login_type" value="{{ encode('back') }}">
                    <button class="btn btn-primary" type="submit">
                        Sign In
                    </button>

                    <hr>
                    <a href="{{ route('google.login') }}"
                        class="btn btn-dark d-flex align-items-center justify-content-center gap-2">
                        <img src="{{ asset('assets/media/google.svg') }}" alt="">
                        Sign In With Google
                    </a>
                    <p>
                        By signing in or creating an account,
                        you agree with our <a href="javascript:void(0)">Terms & Conditions</a>  and <a
                            href="javascript:void(0)">Privacy Statement</a>
                    </p>
                    <p>
                        All rights reserved.<br>Copyright {{ date('Y') }} – hottel.in</a>
                    </p>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>

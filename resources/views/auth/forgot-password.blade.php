<x-guest-layout>

    <div id="auth-center">
    <form method="POST">
        @csrf
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Heading-->
            <a href="{{route('login')}}" class="logo">
                <img src="{{ asset('assets/media/logos/logo.svg') }}" alt="">
            </a>

            <div class="logo-bottom">
                <p>Please Sign-In to your account</p>
            </div>

            <!-- Session Status -->
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
                    <button type="submit">
                        Email Password Reset Link
                    </button>
             
                </div>          



                <hr>

                <p>
                    By signing in or creating an account,
                    you agree with our <a href="javascript:void(0)">Terms & Conditions</a>  and <a
                        href="javascript:void(0)">Privacy Statement</a>
                </p>

                <p>
                    All rights reserved.<br>Copyright {{date('Y')}} – hottel.in</a>
                </p>
                {{-- <div class="d-flex flex-stack">
                <x-primary-button class="ml-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div --}}
            </div>
        </div>
    </form>
    </div>
</x-guest-layout>

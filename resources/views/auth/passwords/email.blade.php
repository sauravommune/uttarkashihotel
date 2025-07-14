@extends('auth.layout')

@section('page_styles')
<link href="/assets/css/login.css?v=7.0.3" rel="stylesheet" type="text/css" />
@endsection

@section('main')
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="login-aside d-flex flex-column flex-row-auto">
            <!--begin::Aside Top-->
            <div class="d-flex flex-column-auto flex-column pt-5 px-20">
                <!--begin::Aside header-->
                <a href="#" class="login-logo text-center pt-lg-10 pb-10">
                    <img src="{{ asset('image/uz_crm.png') }}" class="max-h-100px" alt="" />
                </a>
                <!--end::Aside header-->
            </div>
            <!--end::Aside Top-->
            <!--begin::Aside Bottom-->
            <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center"
                style="background-position-y: calc(100% + 5rem); background-image: url(/assets/media/login-visual.svg)">
            </div>
            <!--end::Aside Bottom-->
        </div>
        <!--end::Aside-->
        <!--begin::Content-->
        <div class="login-content flex-column-fluid d-flex flex-column p-10">
            <!--begin::Top-->
            <div class="text-right d-flex justify-content-center">
                <div class="top-signup text-right d-flex justify-content-end pt-5 pb-lg-0 pb-10">
                    {{--  <span class="font-weight-bold text-muted font-size-h4">Having issues?</span>
                    <a href="javascript:;" class="font-weight-bold text-primary font-size-h4 ml-2"
                        id="kt_login_signup">Get Help</a>  --}}
                </div>
            </div>
            <!--end::Top-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-row-fluid flex-center">
                <!--begin::Signin-->
                <div class="login-form login-form-signup">
                    <!--begin::Form-->
                    <form class="form fv-plugins-bootstrap fv-plugins-framework" id="kt_login_forgot_form" action="{{ route('password.email') }}"
                        novalidate="novalidate">
                        <!--begin::Title-->
                        <div class="pb-5 pb-lg-15">
                            <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Forgot Password?</h3>
                            <p class="text-muted font-weight-bold font-size-h4">Enter your email to reset your password.
                            </p>
                        </div>
                        <!--end::Title-->
                        <!--begin::Form group-->
                        <div class="form-group fv-plugins-icon-container">
                            <input class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6" type="email"
                                placeholder="Email" name="email" autocomplete="off">
                            <div class="fv-plugins-message-container"></div>
                        </div>
                        <!--end::Form group-->
                        <!--begin::Form group-->
                        <div class="form-group d-flex flex-wrap">
                            <button type="submit" id="kt_login_forgot_form_submit_button"
                                class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
                            <a href="/login" id="kt_login_forgot_cancel"
                                class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</a>
                        </div>


                       <br><br><br> <!-- move form little bit up  -->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Signin-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Login-->
</div>
@endsection


@section('page_scripts')
<script src="/js/login.js?v=7.0.3"></script>
@endsection

@if(Auth::check())
<div class="dropdown">
    <!--begin::Toggle-->
    <div class="topbar-item" data-toggle="dropdown" data-offset="0px,0px">
        <div class="btn btn-icon btn-hover-transparent-white d-flex align-items-center btn-lg px-md-2 w-md-auto">
            <span class="text-white opacity-70 font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
            <span
                class="text-white opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4">{{ Auth::user()->name ?? Auth::user()->email }}</span>
            <span class="symbol symbol-35">
                <span
                    class="symbol-label text-white font-size-h5 font-weight-bold bg-white-o-30">{{ ucfirst(Auth::user()->name)[0] }}</span>
            </span>
        </div>
    </div>
    <!--end::Toggle-->
    <!--begin::Dropdown-->
    <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg p-0">
        <!--begin::Header-->
        <div class="d-flex align-items-center p-8 rounded-top">
            <!--begin::Symbol-->
            <div class="symbol symbol-md bg-light-primary mr-3 flex-shrink-0">
                <img src="{{ Auth::user()->avatar }}" alt="" />
            </div>
            <!--end::Symbol-->
            <!--begin::Text-->
            <div class="text-dark m-0 flex-grow-1 mr-3 font-size-h5">{{ Auth::user()->name }}</div>
            <span class="label label-light-success label-lg font-weight-bold label-inline">Free Plan</span>
            <!--end::Text-->
        </div>
        <div class="separator separator-solid"></div>
        <!--end::Header-->
        <!--begin::Nav-->
        <div class="navi navi-spacer-x-0 pt-5">
            <!--begin::Item-->
            <a href="{{url('settings#user_profile_tab')}}" class="navi-item px-8">
                <div class="navi-link">
                    <div class="navi-icon mr-2">
                        <i class="flaticon2-calendar-3 text-success"></i>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">My Profile</div>
                        <div class="text-muted">Account settings and more
                            <span class="label label-light-danger label-inline font-weight-bold">update</span>
                        </div>
                    </div>
                </div>
            </a>
            <!--end::Item-->
            <!--begin::Footer-->
            <div class="navi-separator mt-3"></div>
            <div class="navi-footer px-8 py-5">
                <a class="btn btn-light-primary font-weight-bold" href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" style="display: none;" target="_blank" class="btn btn-clean font-weight-bold">Upgrade
                    Plan</a>
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Nav-->
    </div>
    <!--end::Dropdown-->
</div>
@endif
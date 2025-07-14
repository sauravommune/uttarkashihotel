<div class="card card-custom sticky" data-sticky="true" data-margin-top="140px" data-sticky-for="1023"
    data-sticky-class="kt-sticky" style="">
    <div class="card-body p-0">
        <ul class="nav navi navi-bold navi-hover my-5 nav-tabs" id="settingsTabSide" role="tablist">
            <li class="nav-item navi-item">
                <a class="nav-link navi-link active" data-toggle="tab" href="#personal_information">
                    <span class="navi-icon">
                        <i class="flaticon-avatar"></i>
                    </span>
                    <span class="navi-text">Personal Information</span>
                </a>
            </li>
            <li class="nav-item navi-item">
                <a class="nav-link navi-link" data-toggle="tab" href="#t2">
                    <span class="navi-icon">
                        <i class="flaticon-lock"></i>
                    </span>
                    <span class="navi-text">Financial Information</span>
                </a>
            </li>
           

            @if(Auth::user()->is_admin)
            <li class="nav-item navi-item">
                <a class="nav-link navi-link" data-toggle="tab" href="#invoice_settings">
                    <span class="navi-icon">
                        <i class="text-dark-50 flaticon-file-1"></i>
                    </span>
                    <span class="navi-text">Invoice Settings</span>
                </a>
            </li>
            <li class="nav-item navi-item">
                <a class="nav-link navi-link" data-toggle="tab" href="#payment_gateways">
                    <span class="navi-icon">
                        <i class="flaticon-piggy-bank"></i>
                    </span>
                    <span class="navi-text">Payment Gateways</span>
                </a>
            </li>
            <li class="nav-item navi-item">
                <a class="nav-link navi-link" data-toggle="tab" href="#email_settings">
                    <span class="navi-icon">
                        <i class="flaticon-email"></i>
                    </span>
                    <span class="navi-text">Email Settings</span>
                </a>
            </li>
            @endif

        </ul>
    </div>
</div>
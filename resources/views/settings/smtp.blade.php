<style>
    .hideAWS {
        display: none;
    }
</style>

<x-app-layout>
    <!--begin::Toolbar-->
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                        {{ $title }}
                    </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('superAdmin.dashboard') }}" class="text-muted text-hover-success">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('settings.index') }}" class="text-muted text-hover-success">Settings</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{ $title }}</li>
                        <!--end::Item-->

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar wrapper-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container  container-xxl mb-10">
            <div class="row mb-5">
                <div class="col-md-3">
                    <label class="form-label">Select Settings</label>
                    <select name="setting" id="setting"
                        class="form-select setSelectedSetting"
                        aria-placeholder="Select an option">
                        <option value="smtp">SMTP Settings</option>
                        <option value="aws">AWS Settings</option>
                    </select>
                </div>
                <div class="col"></div>
                {{-- <div class="col-md-3 my-auto">
                    <div class="d-flex flex-row">
                        <input type="email" class="form-control" id="mail"
                            placeholder="Enter email">
                        <button type="button"
                            class="btn btn-primary testEmail mx-2">Test</button>
                    </div>
                </div> --}}
            </div>
            <span class="hideSMTP">
                <form method="POST" class="global-ajax-form"
                    action="{{ route('settings.updateSmtp') }}" id="smtpForm">
                    @csrf
                    <h4 class="mb-4">SMTP Settings</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="driver" class="form-label"> Driver </label>
                                <input type="text" class="form-control" name="driver"
                                    id="driver" value="{{ $smtpSetting->driver ?? '' }}">
                                <span class="error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="encryption" class="form-label"> Encryption
                                </label>
                                <input type="text" class="form-control" name="encryption"
                                    id="encryption"
                                    value="{{ $smtpSetting->encryption ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="username" class="form-label"> Username </label>
                                <input type="text" class="form-control" name="username"
                                    id="username"
                                    value="{{ $smtpSetting->username ?? '' }}">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="smtp_host" class="form-label"> SMTP Host
                                </label>
                                <input type="text" class="form-control" name="smtp_host"
                                    id="smtp_host"
                                    value="{{ $smtpSetting->smtp_host ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="smtp_port" class="form-label"> SMTP Port
                                </label>
                                <input type="text" class="form-control" name="smtp_port"
                                    id="smtp_port"
                                    value="{{ $smtpSetting->smtp_port ?? '' }}">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="smtp_from_email" class="form-label"> SMTP From
                                    Email </label>
                                <input type="text" class="form-control"
                                    name="smtp_from_email" id="smtp_from_email"
                                    value="{{ $smtpSetting->smtp_from_email ?? '' }}">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="smtp_from_name" class="form-label"> SMTP From
                                    Name </label>
                                <input type="text" class="form-control"
                                    name="smtp_from_name" id="smtp_from_name"
                                    value="{{ $smtpSetting->smtp_from_name ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="smtp_pass" class="form-label"> SMTP Pass
                                </label>
                                <input type="text" class="form-control"
                                    name="smtp_pass" id="smtp_pass"
                                    value="{{ $smtpSetting->smtp_pass ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div>
                        <center><button type="submit"
                                class="btn btn-primary w-md mt-4 smtpUpdate">Update</button>
                        </center>
                    </div>
                </form>
            </span>

            <span class="hideAWS">
                <h4 class="mt-5 mb-4">AWS Settings</h4>
                <form method="POST" class="global-ajax-form"
                    action="{{ route('settings.updateAws') }}" id="awsForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="awsdriver" class="form-label"> Driver </label>
                                <input type="text" class="form-control"
                                    name="awsdriver" id="awsdriver"
                                    value="{{ $smtpSetting->smtp_pass ?? '' }}">


                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="awsAccessKey" class="form-label"> AWS Access
                                    Key </label>
                                <input type="text" class="form-control"
                                    name="awsAccessKey" id="awsAccessKey"
                                    value="{{ $smtpSetting->awsAccessKey ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="awsSecretKey" class="form-label"> AWS Secret
                                    Key </label>
                                <input type="text" class="form-control"
                                    name="awsSecretKey" id="awsSecretKey"
                                    value="{{ $smtpSetting->awsSecretKey ?? '' }}">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="awsDefaultRegion" class="form-label"> AWS
                                    Default Region </label>
                                <input type="text" class="form-control"
                                    name="awsDefaultRegion" id="awsDefaultRegion"
                                    value="{{ $smtpSetting->awsDefaultRegion ?? '' }}">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="awsBucket" class="form-label"> AWS Bucket
                                </label>
                                <input type="text" class="form-control"
                                    name="awsBucket" id="awsBucket"
                                    value="{{ $smtpSetting->awsBucket ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="from_email" class="form-label">From Email
                                </label>
                                <input type="text" class="form-control"
                                    name="from_email" id="from_email"
                                    value="{{ $smtpSetting->smtp_from_email ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="from_name" class="form-label">From Name
                                </label>
                                <input type="text" class="form-control"
                                    name="form_name" id="form_name"
                                    value="{{ $smtpSetting->smtp_from_name ?? '' }}">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="flexSwitchCheckDefault" class="form-label">
                                    Use Path Style Endpoint </label>
                                <div class="form-check form-switch py-1">
                                    <input class="form-check-input" name="awsPathStyle"
                                        id="awsPathStyle" type="checkbox"
                                        id="flexSwitchCheckDefault" value="1" />
                                    <label class="form-check-label"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <center><button type="submit"
                                class="btn btn-primary w-md mt-4 smtpAWSUpdate">Update</button>
                        </center>
                    </div>
                </form>
            </span>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#setting').on('change', function() {
                    var selectedSetting = $(this).val();
                    $('.hideSMTP').hide();
                    $('.hideAWS').hide();

                    if (selectedSetting === 'smtp') {

                        $('.hideSMTP').show();

                    } else if (selectedSetting === 'aws') {
                        $('.hideAWS').show();


                    }
                });
            });
        </script>
        <script>
            $("#smtpForm").validate({
                rules: {
                    driver: {
                        required: true,
                    },
                    encryption: {
                        required: true,
                    },
                    username: {
                        required: true,
                    },
                    smtp_host: {
                        required: true,
                    },
                    smtp_port: {
                        required: true,
                    },
                    smtp_from_email: {
                        required: true,
                        email: true,
                    },
                    smtp_from_name: {
                        required: true,

                    },
                    smtp_pass: {
                        required: true,
                    },

                },
            });
        </script>

        <script>
            $("#awsForm").validate({
                rules: {
                    awsdriver: {
                        required: true,
                    },
                    awsAccessKey: {
                        required: true,
                    },
                    awsSecretKey: {
                        required: true,
                    },
                    awsDefaultRegion: {
                        required: true,
                    },
                    awsBucket: {
                        required: true,
                    },
                    from_email: {
                        required: true,
                        email: true
                    },
                    form_name: {
                        required: true,
                    },

                },
            });
        </script>
    @endpush    
</x-app-layout>

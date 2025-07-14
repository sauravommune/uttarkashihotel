<x-app-layout>
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex justify-content-between gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Add Company Settings</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ url('/') }}" class="text-muted text-hover-success">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted"> Settings</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted"> Company Settings</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted"> Add Company</li>
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
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
           <section class="section-1 px-9">
               <div class="card p-5">
                    <div class="">
                        <div class="title  details-page py-5">
                           <h4>Company Details</h4>
                        </div>
                    </div>
                    <div class="form-section">
                        <form action="" method="POST" class="global-ajax-form">
                        @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1" class="required form-label">Company Name</label>
                                </div>
                                <div class="col-lg-8">
                                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter company name" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="form-label required">Company Email</label>
                                </div>
                                <div class="col-lg-8">
                                      <input type="text" class="form-control" id="company_email" name="company_email" placeholder="Enter company email" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="form-label required">Company Person</label>
                                </div>
                                <div class="col-lg-8">
                                      <input type="text" class="form-control" id="allowip" name="allowip" value="" placeholder="00 00 00 00 / 00">
                                </div>
                            </div>
                            <!-- <div class="row">
                                 <div class="col-lg-4">
                                    <label class="form-label">Frequency</label>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                      <label class="form-check-label" for="inlineCheckbox1">Daily</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                      <label class="form-check-label" for="inlineCheckbox2">Weekly</label>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                 <div class="col-lg-4">
                                    <div class="expiry-date">
                                        <label class="form-label">Expiry Date</label>
                                        <a href="jaavasirpt:void(0);">
                                            <div class="icon">
                                                <span class="la la-info"></span>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                                <div class="col-lg-8">
                                   <input type="date" name="expiry_date" value="" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="form-label">Generate API Credentials</label>
                                </div>
                                <div class="col-lg-8">
                                   <a  class="btn btn-secondary generate-key" title="Generate"><i class="la la-refresh fs-2"></i>Generate</a>
                                </div>
                            </div>
                            <div class="row">
                                 <div class="col-lg-4">
                                    <label class="form-label"></label>
                                </div>
                                <div class="col-lg-8">
                                    <div class="main">
                                        <input type="text" name="apikey" id="apikey" value="" class="form-control">
                                        <div class="icon">
                                            <span class="las la-copy copy-api-key cursor-pointer"></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                 <div class="col-lg-4">
                                    <label class="form-label">Email credentials</label>
                                </div>
                                <div class="col-lg-8">
                                   <div class="form-check form-switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                      <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                    </div>
                                </div>
                            </div>
                           <div class="row">
                                <div class="col-lg-12">
                                    <div class="btn-section d-xl-flex justify-content-xl-end">
                                        <div class="d-xl-flex">
                                            <div>
                                                 <a href="jaavasirpt:void(0);" class="btn btn-secondary mb-4  mb-xl-0" id="subBTn" name="submit" title="Discard" title="Discard">Discard</a>
                                            </div>
                                            <x-primary-button class="ml-3">
                                                {{ __('Save') }}
                                            </x-primary-button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>


               </div>
           </section>
        <!--end::Content container-->
    </div>
    <!--end::Content-->

    @push('scripts')
<script>
    $(document).ready(function() {
        $('.global-ajax-form').validate();
    });
</script>
<script>
        $(function() {
            $('body').on('click', '.generate-key', function() {
                $.ajax({
                    url: "{{ route('settings.api-generate') }}",
                    type: "post",
                    success: function(data) {
                        $('input[name="apikey"]').val(data);
                    }
                })
            });

            $('body').on('click', '.copy-api-key', function() {
                var copyingText = $(this).data('apikey');
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(copyingText).select();
                document.execCommand("copy");
                $temp.remove();
                Toastify({
                    text: 'Key copied successfully',
                    duration: 5000,
                    close:true,
                    backgroundColor: "#4fbe87",
                }).showToast();
            });
        });
    </script>
@endpush
</x-app-layout>


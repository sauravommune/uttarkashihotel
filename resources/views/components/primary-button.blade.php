<button type="submit" class="btn btn-success me-2 flex-shrink-0">
    <!--begin::Indicator label-->
    <span class="indicator-label" data-kt-translate="sign-in-submit">{{ $slot }}</span>
    <!--end::Indicator label-->
    <!--begin::Indicator progress-->
    <span class="indicator-progress">
        <span data-kt-translate="general-progress">Please wait...</span>
        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
    </span>
    <!--end::Indicator progress-->
</button>
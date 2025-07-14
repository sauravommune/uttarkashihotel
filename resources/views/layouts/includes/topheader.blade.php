@if(\Modules\Admin\Entities\NotificationManagement::first())

@php
$notification = \Modules\Admin\Entities\NotificationManagement::first();
@endphp

<div class="alert alert-custom alert-white alert-shadow fade show gutter-b mobile-top-margin-40" role="alert">
    <div class="alert-icon">
        @if($notification->header_icon)
        <div class="alert-icon"> <img src="{{ url($notification->header_icon) }}" width="50" /></div>
        @else
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        @endif

    </div>
    <div class="alert-text">{!! $notification->header_message !!}</div>
</div>

@else
<div class="alert alert-custom alert-white alert-shadow fade show gutter-b mobile-top-margin-40" role="alert">
    <div class="alert-icon">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
    </div>
    <div class="alert-text">We are launching
        <code>FREE CRM SYSTEM</code> for Startups and MSMEs.
        <br>{{ "If you're interested, "}}
        <a class="font-weight-bold" href="https://google.com" target="_blank">Request Early
            Access</a>.</div>
</div>
@endif
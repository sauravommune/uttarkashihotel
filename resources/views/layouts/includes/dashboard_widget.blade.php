<div class="col-xl-4">
    <div class="card card-custom card-stretch gutter-b border-0" style="background: transparent;">

        @if(\App\Models\NotificationManagement::first())

        @php
        $notification = \App\Models\NotificationManagement::first();
        @endphp

        @if($notification->dashboard_box1_title)
        <div class="card-body d-flex p-0 h-300px">
            <div class="flex-grow-1 bg-danger p-12 card-rounded flex-grow-1 bgi-no-repeat" style="background-position: calc(100% + 0.5rem) bottom; background-size: auto 70%; background-image: url(assets/media/svg/humans/custom-3.svg)">
                <h4 class="text-inverse-danger mt-2 font-weight-bolder">{{ $notification->dashboard_box1_title }}</h4>
                <p class="text-inverse-danger my-6">
                <div class="text-inverse-danger my-6 fs-6">{!! $notification->dashboard_box1_message !!}</div>
                </p>
                <a href="{{ $notification->dashboard_box1_link }}" class="btn btn-warning font-weight-bold py-2 px-6">{{ $notification->dashboard_box1_button_name }}</a>
            </div>
        </div>
        <br />
        @endif
        @if($notification->dashboard_box2_title)
        <div class="card-body d-flex p-0 mb-7" style="height: 312px;">
            <div class="flex-grow-1 bg-info p-12 pb-40 card-rounded flex-grow-1 bgi-no-repeat" style="background-position: right bottom; background-size: 55% auto; background-image: url(assets/media/svg/humans/custom-6.svg)">
                <h3 class="text-inverse-info pb-5 font-weight-bolder">{{ $notification->dashboard_box2_title }}</h3>
                <p class="text-inverse-info pb-5 font-size-h6">
                <div class="text-inverse-info pb-5 font-size-h6 fs-6">{!! $notification->dashboard_box2_message !!}</div>
                </p>
                <a href="{{ $notification->dashboard_box2_link }}" class="btn btn-success font-weight-bold py-2 px-6">{{ $notification->dashboard_box2_button_name }}</a>
            </div>
        </div>
        @endif

        @else
        <div class="card-body d-flex p-0 mb-7">
            <div class="flex-grow-1 bg-danger p-8 card-rounded flex-grow-1 bgi-no-repeat" style="background-position: calc(100% + 0.5rem) bottom; background-size: auto 70%; background-image: url(assets/media/svg/humans/custom-3.svg)">
                <h4 class="text-inverse-danger mt-2 font-weight-bolder">User Confidence</h4>
                <p class="text-inverse-danger my-6 fs-6">Boost marketing &amp; sales
                    <br>through product confidence.
                </p>
                <a href="#" class="btn btn-warning font-weight-bold py-2 px-6">Learn</a>
            </div>
        </div>
        <br />
        <div class="card-body d-flex p-0 mb-7">
            <div class="flex-grow-1 bg-info p-12 pb-40 card-rounded flex-grow-1 bgi-no-repeat" style="background-position: right bottom; background-size: 55% auto; background-image: url(assets/media/svg/humans/custom-6.svg)">
                <h3 class="text-inverse-info pb-5 font-weight-bolder">Start Now</h3>
                <p class="text-inverse-info pb-5 font-size-h6 fs-6">Offering discounts for better
                    <br>online a store can loyalty
                    <br>weapon into driving
                </p>
                <a href="#" class="btn btn-success font-weight-bold py-2 px-6">Join Now</a>
            </div>
        </div>
        @endif
    </div>
</div>

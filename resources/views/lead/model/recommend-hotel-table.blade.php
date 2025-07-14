
@if (!empty($searchResult))
<form action="{{ route('save.recommend.hotel') }}" method="post" class="global-ajax-form">
    @csrf
    <table class="table">
        <thead>
            <tr class="fw-bold text-gray-800">
                <th class="ps-5">Hotel Name</th>
                <th>Plan</th>
                <th>Star Rating</th>
                <th>Google Rating</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
           <input type="hidden" name="bookingId" value="{{$bookingDetails->booking_id}}"/>
            @foreach ($searchResult as $key => $result)
                <tr>

                    @php
                        $hotel_id = $result['hotel']->id;
                        $user_id = $bookingDetails->user_id;

                        $isChecked = collect($recommendHotel)->contains(function ($recommend) use (
                            $hotel_id,
                            $user_id,
                        ) {
                            return $recommend['hotel_id'] == $hotel_id &&
                                $recommend['user_id'] == $user_id &&
                                $recommend['status'] == 1;
                        });
                        $class = $isChecked == 1 ? 'recommended' : '';
                        $text = $isChecked == 1 ? 'Recommended' : 'Recommend';
                    @endphp


                    <td>{{ ucWords($result['hotel']->name ?? '') }}</td>
                    <td>
                        <div>
                            Room Only (EP Plan)
                        </div>
                        <div>
                            Per Night: <span class="fw-bold">₹ {{ $result['per_night_price'] }}<span>
                    </td>

                    <td>{{ $result['hotel']->rating ?? 0.0 }}</td>
                    <td>{{ $result['hotel']->google_rating ?? 0.0 }}</td>
                    <td>
                        <input type="hidden" value="{{ $result['hotel']->id }}" name="hotel_id[]">
                        <input type="hidden" value="{{ $bookingDetails->user_id }}" name="user_id[]">
                        <input type="hidden" id="status-{{ $key }}"
                            value="{{ $isChecked == 1 ? $isChecked : 0 }}" name="status[]">
                        <p class="recommend-btn btn btn-1 {{ $class }}"
                            id="recommend-text-{{ $key }}" data-key="{{ $key }}">
                            {{ $text }}</p>
                        <input type="checkbox" id="recommend-checkbox-{{ $key }}"
                            class="hidden-checkbox
                                {{ $isChecked ? 'Recommended' : 'Recommend' }}">
                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary loader-btn" data-type="mail">
            <div class="d-flex">
                <div id="loader" class="d-none loader">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="ps-2">
                    Send
                </div>
            </div>
        </button>
    </div>
</form>
@else
<div class="col-12">
    @include('front.no-data-found')
</div>
@endif            

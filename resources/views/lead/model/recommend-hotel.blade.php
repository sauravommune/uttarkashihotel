@if (!empty($searchResult))
    <style>
        .select2-container {
            z-index: 1055 !important;
            /* Bootstrap modal z-index is 1050 */
        }
    </style>
    <section class="section-35">
        <div class="table-responsive">
            <div class="row pb-4">
                <div class="col-12">
                    <p>Filter:</p>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Please enter hotel name" name="hotel_name"
                        id="hotel_name" value="" />

                    <input type="hidden" class="form-control" name="booking_id" id="booking_id"
                        value="{{ $bookingDetails->booking_id ?? '' }}" />

                </div>
                <div class="col-md-4">
                    {{-- <select class="form-select select-2" data-control="select2" data-placeholder="Select Property Rating" name="hotel_id"> --}}
                    <select class="form-select select-2" data-control="select2" data-placeholder="Select an option"
                        data-allow-clear="true" multiple="multiple" name="hotel_rating" id="hotel_rating">

                        <option></option>
                        <option value="3">3 Star</option>
                        <option value="4">4 Star</option>
                        <option value="5">5 Star</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select select-2" data-control="select2" data-placeholder="Select Google Rating"
                        id="google_rating" name="google_rating">
                        <option></option>
                        <option value="1.0-2.0">1.0 - 2.0</option>
                        <option value="2.0-3.0">2.0 - 3.0</option>
                        <option value="3.0-4.0">3.0 - 4.0</option>
                        <option value="4.0-5.0">4.0 - 5.0</option>
                    </select>
                </div>

                <div id="table-data">
                    @include('lead.model.recommend-hotel-table')
                </div>
            </div>

    </section>
@else
    <div class="col-12">
        @include('front.no-data-found')
    </div>
@endif


<script>
    $(document).ready(function() {
        $(".select-2").select2({
            dropdownParent: $("#global_modal")
        });
    });


    $(document).ready(function() {
        function applyFilters() {
            // Get filter values
            let hotelName = $('#hotel_name').val();
            let hotelRating = $('#hotel_rating').val();
            let googleRating = $('#google_rating').val();
            let bookingId = $('#booking_id').val();
            let url = `{{ route('leads.recommend.hotel', ['bookingId' => ':bookingId']) }}`.replace(
                ':bookingId', bookingId);

            $.ajax({
                url: url,
                method: "GET",
                data: {
                    hotel_name: hotelName,
                    hotel_rating: hotelRating,
                    google_rating: googleRating,
                    type: 'filter',
                },
                // beforeSend: function () {
                //     $('#loader').removeClass('d-none');
                // },
                success: function(response) {

                    $('#table-data').html(response.html);
                },
                error: function(xhr) {
                    // alert("An error occurred: " + xhr.responseText);
                },
                // complete: function () {
                //     // Hide loader
                //     $('#loader').addClass('d-none');
                // },
            });
        }
        $('#hotel_name').on('input', function() {
            applyFilters();
        });
        $('#hotel_rating').on('change', function() {
            applyFilters();
        });
        $('#google_rating').on('change', function() {
            applyFilters();
        });
    });
</script>

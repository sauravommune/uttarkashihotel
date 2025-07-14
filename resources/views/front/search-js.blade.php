@section('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            const $hotelSearch = $('#hotelSearch');
            const $suggestionBox = $('#suggestionBox');
            const $skeletonLoader = $('#skeleton-loader');
            const $searchResults = $('#search-results');
            const $searchForm = $('#searchForm');

            const getFilters = () => ({
                bed_type: $('input[name="bed_type[]"]:checked').map((_, el) => el.value).get(),
                hotel_amenity: $('input[name="hotel_amenity[]"]:checked').map((_, el) => el.value).get(),
                range_price: $('input[name="price_range[]"]:checked').map((_, el) => el.value).get(),
                select_star: $('input[name="star_category[]"]:checked').map((_, el) => el.value).get(),
                checkin_date: $('#checkInDate').val(),
                checkout_date: $('#checkOutDate').val(),
                adultCount: $('input[name=adultCount]').val(),
                childCount: $('input[name=childCount]').val(),
                roomCount: $('input[name=roomCount]').val(),
                cityId: $('#setCityId').val(),
                sort_by: $('#shortBy').val(),
            });

            const fetchResults = (extraData = {}, loader = true) => {
                const cityName = $('#data-city-name').data('city_name')?.toLowerCase();
                const url = `{{ url('hotels-in') }}-${cityName}/`;

                const filterData = { ...getFilters(), ...extraData, city: cityName };
                const searchFormData = $searchForm.serializeArray().reduce((acc, { name, value }) => {
                    acc[name] = value;
                    return acc;
                }, {});
                const finalData = { ...filterData, ...searchFormData };

                if (loader) {
                    $skeletonLoader.show();
                    $searchResults.hide();
                }

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: finalData,
                    success: (response) => {
                        if (response.list) {
                            const html = response.data?.length
                                ? response.data.map(hotel => `
                                    <li>
                                        <a href="javascript:void(0)" class="suggestion-item" data-hotel-id="${hotel.hotel.id}">
                                            <span class="material-symbols-outlined fs-5 text-color">apartment</span>
                                            <span class="hotel-name">${hotel.hotel.name.toLowerCase().replace(/\b\w/g, char => char.toUpperCase())}</span>
                                        </a>
                                    </li>`).join('')
                                : 'No Hotels Found!';
                            $suggestionBox.html(html);
                        } else {
                            $('.result-box').empty().append(response.data || '');
                            $suggestionBox.empty().addClass('d-none');
                            $hotelSearch.val('');
                        }
                    },
                    error: (xhr) => console.error('Error:', xhr.responseText),
                    complete: () => {
                        if (loader) {
                            $skeletonLoader.hide();
                            $searchResults.show();
                        }
                    }
                });
            };

            // Event Listeners
            $(document)
                .on('click', '.sort-button', () => $('.sort-dropdown').toggleClass('active'))
                .on('click', '.sort-options li', function () {
                    const selectedText = $(this).text();
                    const sortType = $(this).data('sort');

                    {{-- $('.sort-button span:first').text(`${selectedText}`); --}}
                    $('.sort-options li').removeClass('text-hottel');
                    $(this).addClass('text-hottel');
                    $('.sort-dropdown').removeClass('active');
                    fetchResults({ sort_by: sortType });
                })
                .on('click', (event) => {
                    if (!$(event.target).closest('.sort-dropdown').length && !$(event.target).is('.sort-button')) {
                        $('.sort-dropdown').removeClass('active');
                    }
                })
                .on('change', 'input[name="price_range[]"], input[name="star_category[]"], input[name="hotel_amenity[]"], input[name="bed_type[]"]', () => {
                    fetchResults();
                })
                .on('click', '.suggestion-item', function () {
                    fetchResults({ hotel_id: $(this).data('hotel-id') });
                });

            $hotelSearch.on('keyup', function () {
                const searchValue = $(this).val().trim();
                $suggestionBox.toggleClass('d-none', searchValue.length === 0);

                if (searchValue.length > 0) {
                    fetchResults({ hotel_name: searchValue }, false);
                } else {
                    $suggestionBox.empty();
                }
            });

            $('#searchBtn').on('click', function () {
                const cityName = $('#data-city-name').data('city_name')?.toLowerCase();
                $searchForm.attr('action', `{{ url('hotels-in') }}-${cityName}/`).submit();
            });

            // Initial Skeleton Loader Handling
            if ($skeletonLoader.length) {
                setTimeout(() => {
                    $skeletonLoader.hide();
                    $searchResults.show();
                }, 2000);
            }
        });

        function loadData() {
        // Show the skeleton loader
        $('.skeleton-loader').removeClass('d-none');
        $('#search-results').addClass('d-none');
        setTimeout(function () {
            $('.skeleton-loader').addClass('d-none');
            $('#search-results').removeClass('d-none');
        }, 2000);
        }
        loadData();

    </script>
@endsection

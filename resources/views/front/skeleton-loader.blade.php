<div id="skeleton-loader" class="pt-3">
    @if (!empty($searchResult))
        @foreach ($searchResult as $hotel)
        <div class="result-box-container">
            <div class="result-box-container-left">
                <div class="hotel-imgs hotel-slider skeleton-img skeleton-circle">
                </div>
            </div>
            <div class="result-box-container-right skeleton-loading">
                <div class="row g-0 w-100">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 col-12 p-0">
                        <div class="content gap-0 pe-xl-2 pe-0">
                            <div class="d-xl-flex gap-4 align-items-center flex-row w-100">
                                <div class="skeleton skeleton-title skeleton-hotel-pic"></div>

                                <div class="skeleton-middle">
                                    <div class="skeleton-hotel-name">
                                        <div class="skeleton skeleton-title skeleton-hotel-name w-100"></div>
                                        <div class="skeleton skeleton-line"></div>
                                    </div>

                                    <!-- Amenities -->
                                    <div class="skeleton-hotel-amenities">
                                        <div class="skeleton skeleton-amenities-container">
                                            <div class="skeleton skeleton-box"></div>
                                            <div class="skeleton skeleton-amenities"></div>
                                        </div>
                                        <div class="skeleton skeleton-amenities-container">
                                            <div class="skeleton skeleton-box"></div>
                                            <div class="skeleton skeleton-amenities"></div>
                                        </div>
                                        <div class="skeleton skeleton-amenities-container">
                                            <div class="skeleton skeleton-box"></div>
                                            <div class="skeleton skeleton-amenities"></div>
                                        </div>

                                    </div>

                                    <!-- Ratings -->
                                    <div class="skeleton-hotel-description">
                                        <div class="skeleton skeleton-line"></div>
                                        <div class="skeleton skeleton-line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12  col-xl-3 p-0">
                        <div class="content-right">
                            <!-- Availability and Price -->
                            <div class="d-flex gap-4">
                                <div class="skeleton skeleton-rating_star"></div>
                                <div class="skeleton skeleton-parking"></div>
                            </div>
                            <div class="skeleton skeleton-badge"></div>
                            <div class="skeleton skeleton-price"></div>
                            <div class="skeleton skeleton-line skeleton-small-text"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @else
        @for ($i = 0; $i < 2; $i++)
        <div class="result-box-container">
            <div class="result-box-container-left">
                <div class="hotel-imgs hotel-slider skeleton-img skeleton-circle">
                </div>
            </div>
            <div class="result-box-container-right skeleton-loading">
                <div class="row g-0 w-100">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 col-12 p-0">
                        <div class="content">
                            <div class="d-xl-flex gap-4 align-items-center flex-row w-100">
                                <div class="skeleton skeleton-title skeleton-hotel-pic"></div>

                                <div class="skeleton-middle">
                                    <div class="skeleton-hotel-name">
                                        <div class="skeleton skeleton-title skeleton-hotel-name"></div>
                                        <div class="skeleton skeleton-line"></div>
                                    </div>

                                    <!-- Amenities -->
                                    <div class="skeleton-hotel-amenities">
                                        <div class="skeleton skeleton-amenities-container">
                                            <div class="skeleton skeleton-box"></div>
                                            <div class="skeleton skeleton-amenities"></div>
                                        </div>
                                        <div class="skeleton skeleton-amenities-container">
                                            <div class="skeleton skeleton-box"></div>
                                            <div class="skeleton skeleton-amenities"></div>
                                        </div>
                                        <div class="skeleton skeleton-amenities-container">
                                            <div class="skeleton skeleton-box"></div>
                                            <div class="skeleton skeleton-amenities"></div>
                                        </div>

                                    </div>

                                    <!-- Ratings -->
                                    <div class="skeleton-hotel-description">
                                        <div class="skeleton skeleton-line"></div>
                                        <div class="skeleton skeleton-line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12  col-xl-3 p-0">
                        <div class="content-right">
                            <!-- Availability and Price -->
                            <div class="d-flex gap-4">
                                <div class="skeleton skeleton-rating_star"></div>
                                <div class="skeleton skeleton-parking"></div>
                            </div>
                            <div class="skeleton skeleton-badge"></div>
                            <div class="skeleton skeleton-price"></div>
                            <div class="skeleton skeleton-line skeleton-small-text"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endfor
    @endif
</div>

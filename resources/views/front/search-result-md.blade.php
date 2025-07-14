@php
    use Carbon\Carbon;
@endphp

@extends('front.layouts.app')
@section('content')
    <style type="text/css">
        a:hover {
            color: #000;
        }
         @media (max-width: 1200px) {
            .flatpickr-calendar.open {
                z-index: 99999999!important;
            }
        }
    </style>
    <section class="top-bg top-bg-II lazy bg-image-style bg-image-style-II d-block"
        data-bg="{{ asset('assets/front/images/m-bg.png') }}"></section>

    <section class="search-section other-page  search-section-II m-device">
        <div class="container">
            <div class="row">
                
                <div class="col-12">


                    <div class="serach-warpper">
                        <div>
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div class="warpper-city">
                                    <div class="city">
                                        {{ ucwords($searchData->city?->name ?? '') }}
                                    </div>
                                    <div class="info">
                                        {{ Carbon::parse($searchData->checkin_date)->format('M d') ?? date('M d') }} -
                                        {{ Carbon::parse($searchData->checkout_date)->format('M d') ?? date('M d') }},
                                        {{ $searchData->roomCount ?? 1 }} Rooms,
                                        {{ $searchData->adultCount + $searchData->childCount ?? 1 }} Guest
                                    </div>
                                </div>
                                <div>
                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                        data-bs-target="#search-modal-section">
                                        <div class="icon">
                                            <span class="icon-search-1"></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-12 mt-4">
                    
                </div>
            </div>
        </div>
    </section>

    <div class="search-details-page " id="detail-page">
        <section class="seach-results pt-0">
            <div class="container">
                <div class="row">
                    @if(count($searchResult)>0)
                     <div class="d-block d-xl-none filter-mobile">
                        <div class="offcanvas offcanvas-start" tabindex="-1" id="all-filters"
                            aria-labelledby="all-filtersLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="all-filtersLabel">All Filters</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body mt-1">
                                <div>
                                    <div class="search-results-left">
                                        <h5>Select Filters</h5>
                                        @include('front.includes.sectionResetFilter')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="search-results-right">
                            <div class="top-box align-items-center">
                                <div class="top-box-left">
                                    <h6>Hotels in {{ ucwords($searchData->city?->name ?? '') }}</h6>
                                </div>
                                <div class="top-box-right">
                                    <div class="form-group d-none d-xl-block position-relative">
                                        <input type="text" id="hotelSearch" value="" class="form-control"
                                            placeholder="Search by hotel name">
                                        <span class="material-symbols-outlined search">search</span>

                                        <div id="suggestionBox" class="d-none list-unstyled">
                                            <ul></ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="sort-dropdown my-2">
                                            <button class="sort-button d-inline-block">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <span>Sort By</span>
                                                    </div>
                                                    <div>
                                                        <i class="bi bi-filter ps-2 mt-1"></i>
                                                    </div>
                                                </div>
                                            </button>
                                            <ul class="sort-options">
                                                <li data-sort="popularity" class="text-hottel">Popularity</li>
                                                <li data-sort="popularity" class="text-hottel">Popularity</li>
                                                <li data-sort="low_to_high_price">Price (lowest first)</li>
                                                <li data-sort="high_to_low_price">Price (highest first)</li>
                                                <li data-sort="high_to_low_rating">Google Rating (highest first)</li>
                                                <li data-sort="low_to_high_rating">Google Rating (lowest first)</li>
                                            </ul>
                                            <input type="hidden" name="shortBy" id="shortBy" value="">
                                        </div>
                                        <div class="ps-2">
                                            <a class="btn d-inline-block d-xl-none btn-mobile" data-bs-toggle="offcanvas" href="#all-filters" role="button" aria-controls="all-filters">
                                                <span class="material-symbols-outlined">tune</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            

                            <!-- Skeleton Loader (This will be displayed initially) -->
                            @include('front.skeleton-loader')
                            <div id="search-results" class="search-results-md">
                                <div class="result-box">
                                    <div class="row">
                                        <x-hotel-list :hotelList="$searchResult" :searchTerms="$searchData" />
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    @else
                    <div class="col-12">
                        @include('front.no-data-found')
                    </div>
                    @endif
                </div>
            </div>
        </section>
        
    </div>

    <section class="search-modal-section search-section search-section-II search-section-mb">
        <div class="modal fade" id="search-modal-section" tabindex="-1" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-header postion-relative border-0">
                            <div class="text-center">
                                <h5 class="modal-title text-center" id="exampleModalLabel">Search Your Hotel</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        @include('front.includes.searchForm')
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@include('front.search-js')

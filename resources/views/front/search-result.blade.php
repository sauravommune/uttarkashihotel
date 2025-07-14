@php
    use Carbon\Carbon;
@endphp

@extends('front.layouts.app')
@section('content')
    <style type="text/css">
        a:hover {
            color: #000;
        }
        .text-hottel{
            color : #ff541e;
        }
    </style>
    <section class="top-bg lazy bg-image-style " data-bg="{{ asset('assets/front/images/search-result.png') }}" id="top-bg-class"></section>
    <section class="search-section other-page search-section other-page  search-section-II m-device" id="search-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('front.includes.searchForm')
                </div>
            </div>
        </div>
    </section>

    <div class="search-details-page" id="detail-page">
        <section class="seach-results">
            <div class="container">
                <div class="row">

                    @if (count($searchResult) > 0)
                        <div class="col-xxl-3  col-lg-3 d-none d-md-block">
                            <div class="search-results-left">
                                <h5>Select Filters</h5>
                                @include('front.includes.sectionResetFilter')
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-9 col-xxl-9">
                            <div class="search-results-right">

                                <div class="top-box">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="top-box-left">
                                                <h1 style="font-size: 18px;">Hotels in {{ ucwords($searchData->city?->name ?? '') }}</h1>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="sort-dropdown">
                                                <button class="sort-button">
                                                    <span>Sort By</span>
                                                    <span class="arrow">↓</span>
                                                </button>
                                                <ul class="sort-options">
                                                    <li data-sort="popularity" class="text-hottel">Popularity</li>
                                                    <li data-sort="low_to_high_price">Price (lowest first)</li>
                                                    <li data-sort="high_to_low_price">Price (highest first)</li>
                                                    <li data-sort="high_to_low_rating">Google Rating (highest first)</li>
                                                    <li data-sort="low_to_high_rating">Google Rating (lowest first)</li>
                                                </ul>
                                            </div>
                                            <input type="hidden" name="shortBy" id="shortBy" value="">

                                        </div>
                                        <div class="col-4">
                                             <div class="top-box-right">
                                                <div class="form-group d-none d-lg-block position-relative">
                                                    <input type="text" id="hotelSearch" value="" class="form-control"
                                                        placeholder="Search by Hotel Name">
                                                    <span class="material-symbols-outlined search">search</span>

                                                    <div id="suggestionBox" class="d-none list-unstyled">
                                                        <ul>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <a class="btn btn-primary d-block d-lg-none" data-bs-toggle="offcanvas"
                                                    href="#all-filters" role="button" aria-controls="all-filters">
                                                    Filter
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>

                                <!-- Skeleton Loader (This will be displayed initially) -->
                                
                                @include('front.skeleton-loader')

                                <div id="search-results" class="d-none">
                                    <div class="result-box">
                                        <x-hotel-list :hotelList="$searchResult" :searchTerms="$searchData"/>
                                    </div>
                                </div>

                            </div>

                        </div>
                    @else
                        <div class="col-12">
                            @include('front.no-data-found')
                        </div>
                    </div>
                @endif

            </div>
        </section>
    </div>
@endsection

@include('front.search-js')

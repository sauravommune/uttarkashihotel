<x-app-layout>
    <div id="kt_app_toolbar" class="app-toolbar pt-10 pt-md-6 pt-lg-3 pb-2">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-color fw-bold fs-18 m-0">
                        {{ ucwords($title) }}
                    </h1>
                    <!--end::Title-->
                    {{-- <h6 class="text-muted">Manage all your Company here!</h6> --}}
                    <ul class="breadcrumb breadcrumb-separator-less fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('superAdmin.dashboard') }}" class="text-color-secondary text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('hotel') }}" class="text-color-secondary text-hover-primary">Hotels</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet text-color-secondary w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-color-secondary"> {{ ucwords($title)}}</li>
                        <!--end::Item-->
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('create.hotelReview',encode($hotel?->id)) }}" data-bs-toggle="modal" data-bs-target="#global_modal"
                       data-bs-whatever="Add Google Review" class="btn btn-sm btn-flex btn-primary h-40px fs-7 fw-bold">
                    <i class="ki-duotone ki-plus"> </i>
                    <p class="mb-0 d-none d-sm-block">
                        Add Hotel Review
                    </p>
                </a>
                </div>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid backend-review">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row">
                @foreach($hotelReview as $review)
                    <div class="col-md-4 review-container mb-5">
                        <div class="review-card">
                            <div class="d-flex justify-content-between">
                                <div class="user-info">
                                    <div class="d-flex align-items-center">
                                        <div class="image">
                                            @if($review->review_profile_photo)
                                            <img src="{{ asset('storage/' . $review->review_profile_photo) }}" alt="User Image" />
                                            @else
                                                <div class="review-area">
                                                    <div class="user-icon">
                                                        <span>
                                                            @php
                                                                $firstInitial = strtoupper(substr(explode(' ', $review->author_name)[0], 0, 1));
                                                            @endphp
                                                        <p class="p-0 m-0">{{ $firstInitial }}</p>
                                                        </span>
                                                    </div>
                                                </div>
                                                
                                            @endif
                                        
                                        </div>
                                        <div class="user-info-text ps-3">
                                            <div class="name">
                                                {{ ucwords($review->author_name??'')}}
                                            </div>
                                            <div class="date-text">
                                               <p class="mb-0">{{ \Carbon\Carbon::parse($review->date ?? '')->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="rating">
                                        <div class="d-flex rating-area">
                                            <div>
                                                <b>{{ ucwords($review->rating??'')}}</b>
                                            </div>
                                            <div class="ps-1">
                                                <span class="fa fa-star text-warning"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ps-3">
                                        <button class="btn  btn-clean btn-icon " data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                            <span class="material-symbols-outlined text-color-secondary fs-2">
                                                more_vert
                                            </span>
                                        </button>
                                    
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                            <div class="menu-item p-3">
                                                <a href="{{ route('create.hotelReview',[encode($hotel?->id), encode($review->id)]) }}" data-bs-toggle="modal" data-bs-target="#global_modal" data-bs-whatever="Add Google Review" class="menu-content text-color-secondary d-flex gap-2 align-items-center fw-bold rounded hover-bg-light px-3 py-4">
                                                    <span class="material-symbols-outlined text-color-secondary fs-2">edit</span>
                                                    <p class="mb-0 d-none d-sm-block">
                                                        Edit 
                                                    </p>
                                                </a>
                                                <a href="{{ route('delete.review', encode($review->id)) }}" class="menu-content text-color-secondary d-flex gap-2 align-items-center fw-bold rounded hover-bg-light px-3 py-4 delete-hotel-review">
                                                    <span class="material-symbols-outlined text-color fs-3">
                                                        delete
                                                    </span>
                                                    Delete  
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="content-area mt-4">
                                {{-- <p class="m-0" id="review-text">
                                    {{ ucwords($review->text??'')}}
                                </p> --}}

                                <p class="m-0" id="review-text" data-full-text="{{ ucwords($review->text ?? '') }}">
                                    {{ \Illuminate\Support\Str::limit($review->text ?? '', 100) }}
                                </p>

                                @if(strlen($review->text ?? '') > 100)
                                    <a href="javascript:void(0);" class="read-more-toggle">Read More</a>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>

            document.addEventListener("DOMContentLoaded", function () {
            const readMoreLinks = document.querySelectorAll('.read-more-toggle');

            readMoreLinks.forEach(link => {
                link.addEventListener('click', function () {
                    const paragraph = this.previousElementSibling; // The paragraph element
                    const fullText = paragraph.getAttribute('data-full-text'); // Full text from the attribute

                    if (paragraph.classList.contains('expanded')) {
                        // Collapse to truncated text
                        paragraph.textContent = fullText.slice(0, 100) + '...';
                        this.textContent = 'Read More';
                    } else {
                        // Expand to full text
                        paragraph.textContent = fullText;
                        this.textContent = 'Read Less';
                    }

                    paragraph.classList.toggle('expanded');
                });
            });
        });
        $(document).ready(function() {
         
            $("body").on("click", ".delete-hotel-review", function (e) {
                e.preventDefault();
                let _this = $(this);
                var url = _this.attr("href");

                Swal.fire({
                    title: "Are you sure?",
                    text: "Want to delete this?",
                    icon: "warning",
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Yes, delete it!",
                    customClass: {
                        confirmButton: "btn-danger",
                    },
                    preConfirm: function () {
                        return $.ajax({
                            url: url,
                            type: "DELETE",
                        })
                        .done(function (data) {
                            _this.parents('.review-container').remove();
                            Swal.fire({
                                text: data.message,
                                icon: "success",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                            });
                        })
                        .catch(function (error) {
                            Swal.fire({
                                text: error.responseJSON.message,
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                            });
                        });
                    },
                }).then(function (result) {
                });
            });
        });
    </script>
    @endpush


</x-app-layout>

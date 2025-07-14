@extends('front.layouts.app')
@section('content')
<style>

</style>
<section class="section-26">
    <div class="top-section">
        <div class="container top-form">
            <div class="row">
                <div class="col-12 z-3">
                    <span class="text-white">Reach out to us Anytime</span>
                    <h1>Contact Us</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-30">
    <div class="container contact-us">
        <div class="row">
            <div class="col-12 page-header d-flex flex-column gap-2 align-items-center pt-4 pb-5">
                <h4>Welcome to the Help Centre</h4>
                <p>We're here to help with all your queries and provide seamless support. Reach out to us using the
                    details below:</p>
            </div>
            <div class="col-12">
                <div class="row email-number mx-0 mx-lg-1">
                    <div class="col-md-6 col-12 inner-section">
                        <div class="d-flex gap-4">
                            <div class="box-54 d-flex align-items-center justify-content-center">
                                <i class="bi bi-envelope-open-fill"></i>
                            </div>
                            <div class="d-flex flex-column gap-1">
                                <h6>
                                    Support Email
                                </h6>
                                <p>
                                    Reach out to our agents for booking inquiries, and we'll respond promptly.
                                </p>
                                <a href="mailto:{{ config('contact-info.email') }}" class="inner-bottom mt-2">
                                    {{ config('contact-info.email') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-12 inner-section">
                        <div class="d-flex gap-4">
                            <div class="box-54 d-flex align-items-center justify-content-center">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div class="d-flex flex-column gap-1">
                                <h6>
                                    Contact Number
                                </h6>
                                <p>
                                    For urgent assistance, feel free to call us anytime, 24/7, on our number.
                                </p>
                                <a href="tel:{{ config('contact-info.mobile_number') }}" class="inner-bottom mt-2">
                                    +91 {{ config('contact-info.mobile_number') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-25 py-xl-5 py-3">
    <div class="container py-xl-4 py-3">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center">
                    <h2>Frequently Asked Questions</h2>
                    <p>Your Top Questions Answered</p>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-10">
                <div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    What are your customer support hours?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Our support team is available from 9:00 AM to 6:00 PM,
                                    Monday to Saturday.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    How can I contact customer support?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    You can contact us via email at <a
                                        href="mailt0:{{ config('contact-info.email') }}">{{ config('contact-info.email') }}</a> or call us at <a
                                        href="tel:{{ config('contact-info.mobile_number') }}">+91 {{ config('contact-info.mobile_number') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    How long does it take to receive a response?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Our team aims to respond to all queries within 24-48 hours. However, during peak
                                    times, it might take a little longer.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    What kind of support does UttarkashiHotels provide?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    We assist with queries related to bookings, cancellations, refunds, and general
                                    questions about our services. If you have an issue, don't hesitate to contact us!
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Is there a dedicated contact for corporate inquiries?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    For corporate bookings or business-related queries, please email us at
                                    {{ config('contact-info.email') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
    $('.testimonial-slider').slick({
        dots: true,
        arrows: true,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        prevArrow: '<button type="button" class="slick-prev"><span class="material-symbols-outlined">chevron_left</span></button>',
        nextArrow: '<button type="button" class="slick-next"><span class="material-symbols-outlined">chevron_right</span></button>'
    });

    document.querySelectorAll('.faq-item').forEach(item => {
        item.addEventListener('click', () => {
            // Close any open FAQ items
            const activeItem = document.querySelector('.faq-item.active');
            if (activeItem && activeItem !== item) {
                activeItem.classList.remove('active');
            }

            // Toggle the clicked item
            item.classList.toggle('active');
        });
    });

});
</script>
@endsection
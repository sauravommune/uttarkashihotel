@extends('front.layouts.app')
@section('content')
<style>
.scroll-anchor {
    display: block;
    position: relative;
    top: -80px;
    /* Adjust based on your fixed header height */
    visibility: hidden;
}

html {
    scroll-behavior: smooth;
}
</style>

<section class="section-26">
    <div class="top-section">
        <div class="container top-form">
            <div class="row">
                <div class="col-12 z-3">
                    <span class="text-white">Flexible Cancellation Terms for a Hassle-Free Experience
                    </span>
                    <h1>Cancellation Policy</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-27">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-12">
                <div class="toc">
                    <h4>Table of Content</h4>
                    <div class="tnc">
                        <h6>Cancellation Policy</h6>
                        <ul>
                            <li>
                                <a href="#general_cancellation_policy">
                                    A. General Cancellation Policy
                                </a>
                            </li>
                            <li>
                                <a href="#refund_policy">
                                    B. Refund Policy
                                </a>
                            </li>
                            <li>
                                <a href="#non_refundable_bookings">
                                    C. Non-Refundable Bookings
                                </a>
                            </li>
                            <li>
                                <a href="#force_majeure_cancellations">
                                    D. Force Majeure Cancellations
                                </a>
                            </li>
                            <li>
                                <a href="#changes_and_amendments">
                                    E. Changes and Amendments
                                </a>
                            </li>
                            <li>
                                <a href="#customer_support">
                                    F. Customer Support
                                </a>
                            </li>
                            <li>
                                <a href="#policy_amendments">
                                    G. Amendments to the Policy
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-12">
                <div class="content mt-4 mt-md-0">
                    <h4>Cancellation & Refund Policy</h4>

                    <div id="general_cancellation_policy" class="scroll-anchor"></div>
                    <h5>A. General Cancellation Policy</h5>
                    <p>
                        <strong>1. Initiating Cancellations:</strong> Cancellations can be requested via the UttarkashiHotel
                        website, mobile application, or by contacting our customer support team. The cancellation
                        request must be submitted before the specified deadline to qualify for a refund.
                    </p>
                    <p>
                        <strong>2. Cancellation Fees:</strong> Cancellations may incur fees as per the policies of the
                        accommodation or service provider. Hottel's service fees are non-refundable.
                    </p>
                    <p>
                        <strong>3. Provider-Specific Terms:</strong> Each provider may have its own cancellation and
                        refund policies, clearly outlined during the booking process. Users are advised to carefully
                        review these terms before confirming a booking.
                    </p>

                    <div id="refund_policy" class="scroll-anchor"></div>
                    <h5>B. Refund Policy</h5>
                    <p>
                        <strong>1. Refund Eligibility:</strong> Refunds are processed for bookings canceled in
                        accordance
                        with the cancellation terms of the service provider. Refunds will not be issued for "No-Show"
                        bookings or cancellations made after the specified deadline.
                    </p>
                    <p>
                        <strong>2. Processing Time:</strong> Refunds will be initiated within 7-10 business days from
                        the
                        date of cancellation confirmation. However, the time for the amount to reflect in your account
                        may vary depending on the payment method or bank processing times.
                    </p>
                    <p>
                        <strong>3. Refund Method:</strong> Refunds will be processed using the same payment method
                        originally used for the booking. If the original payment method is no longer valid, Users must
                        contact customer support for an alternative arrangement.
                    </p>

                    <div id="non_refundable_bookings" class="scroll-anchor"></div>
                    <h5>C. Non-Refundable Bookings</h5>
                    <p>
                        Certain bookings are classified as non-refundable at the time of booking. In such cases, Users
                        will not be eligible for a refund regardless of the cancellation reason. These terms will be
                        clearly communicated before booking confirmation.
                    </p>

                    <div id="force_majeure_cancellations" class="scroll-anchor"></div>
                    <h5>D. Force Majeure Cancellations</h5>
                    <p>
                        In the event of cancellations due to unforeseen circumstances beyond the control of UttarkashiHotel or
                        the service provider (e.g., natural disasters, government restrictions, pandemics), refunds or
                        rescheduling options will be offered at the discretion of the provider.
                    </p>

                    <div id="changes_and_amendments" class="scroll-anchor"></div>
                    <h5>E. Changes and Amendments</h5>
                    <p>
                        <strong>1. Amending a Booking:</strong> Changes to bookings, such as modifications to dates or
                        services, are subject to availability and provider policies. Change fees may apply.
                    </p>
                    <p>
                        <strong>2. Partial Cancellations:</strong> For multi-night or multi-service bookings, partial
                        cancellations may be allowed based on the provider's policy. Refunds for partial cancellations
                        will be calculated accordingly.
                    </p>

                    <div id="customer_support" class="scroll-anchor"></div>
                    <h5>F. Customer Support</h5>
                    <p>
                        For cancellations or refund-related queries, our customer support team is available:
                        <br><strong>Email:</strong> {{ config('contact-info.email') }}
                        <br><strong>Phone:</strong> (+91) {{ config('contact-info.mobile_number') }}
                        <br><strong>Hours:</strong> Monday to Saturday, 9:00 AM to 7:00 PM IST
                    </p>

                    <div id="policy_amendments" class="scroll-anchor"></div>
                    <h5>G. Amendments to the Policy</h5>
                    <p>
                        UttarkashiHotel reserves the right to modify this Cancellation & Refund Policy at any time without prior
                        notice. Users are encouraged to review this policy periodically for updates.
                    </p>
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
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                What personal information does UttarkashiHotes.in collect?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                UttarkashiHotel.in collects personal details such as your name, email address, phone number,
                                mailing address,
                                payment details, and other relevant information required for booking services.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                How does UttarkashiHotel.in use my information?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Your information is used to manage bookings, provide personalized recommendations, send
                                marketing
                                communications (with consent), and enhance website functionality through analytics.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                What are my options for managing privacy preferences on UttarkashiHotel.in?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                You can update your account information through profile settings, opt-out of marketing
                                emails via the
                                unsubscribe link, and modify your browser settings to manage tracking preferences.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                How does UttarkashiHotel.in ensure the security of my data?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                UttarkashiHotel.in implements robust security measures to protect your information. However, as
                                no method of
                                electronic storage is completely secure, absolute protection cannot be guaranteed.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Who can I contact for queries or support regarding privacy or services?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                For any questions, you can contact UttarkashiHotel.in via:
                                <ul class="mt-2">
                                    <li>Email: <strong><a href="mailto:{{ config('contact-info.email') }}">{{ config('contact-info.email') }}</a></strong>
                                    </li>
                                    <li>Phone: <strong><a href="tel:{{ config('contact-info.mobile_number') }}">(+91) {{ config('contact-info.mobile_number') }</a></strong></li>
                                </ul>
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
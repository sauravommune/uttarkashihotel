@extends('front.layouts.app')
@section('content')
<style type="text/css">
    span.select2-dropdown.custom-dropdown-class.select2-dropdown--below{
        top: -45px!important;
    }
    @media (max-width: 1200px) {
        span.select2-dropdown.custom-dropdown-class.select2-dropdown--below{
            top: -36px!important;
        }   
    }
   
</style>
<section class="section-20">
    <div class="top-section">
        <div class="container top-form">
            <div class="row">
                <div class="col-12 col-xl-7 z-3">
                    <span class="text-white">Your Perfect Stay, Tailored to Your Needs</span>
                    <h1>Get the Best Hotels rates for large groups, Weddings or Any Event!</h1>
                </div>

                <div class="consult-form mb-xl-0 mb-4">
                    <form class="global-ajax-form" action="{{ route('add_consult_now.details') }}" method="post" id="validate-form">
                        @csrf
                        <div class="card search-section consult-now">
                            <div class="card-head">
                                <img src="{{asset('assets/front/images/check-consult.svg')}}" alt="">
                                <p class="mb-0"><strong>Send us your enquiry</strong> & our team will get in touch within minutes!</p>
                            </div>
                            <div clas="card-body">
                                <div class="row g-0">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3 repeat-section ">
                                        <div class="search-item">
                                            <label for="hotel_name" class="form-label">Customer Name</label>
                                            <input type="text" class="form-control border-0" name="full_name" placeholder="Enter your name" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3 repeat-section ">
                                        <div class="search-item">
                                            <label for="hotel_name" class="form-label">Email</label>
                                            <input type="text" class="form-control border-0" name="email" placeholder="Enter your email" />

                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3 repeat-section ">
                                        <div class="search-item">
                                            <label for="hotel_name" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control border-0" name="phone" placeholder="Enter your phone number" />

                                        </div>
                                    </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3 repeat-section ">
                                        <div class="search-item">
                                            <label for="hotel_name" class="form-label">Current City</label>
                                            <input type="text" class="form-control border-0" name="city" placeholder="Enter your city name" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3 repeat-section">
                                        <div class="search-item position-relative room-search px-0">
                                            <div class="">
                                                <label for="exampleInputEmail1" class="form-label">Hotel
                                                    Rating</label>
                                            </div>
                                            <select class="form-select global-select" name="rating" id="rating" data-placeholder="Choose one thing">
                                                <option value="3">3 Star</option>
                                                <option value="4">4 Star</option>
                                                <option value="5">5 Star</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3 repeat-section">
                                        <div class="search-item position-relative room-search px-0">
                                            <div class="">
                                                <label for="exampleInputEmail1" class="form-label">City / Location</label>
                                            </div>
                                            <select class="form-select global-select" name="city_id" id="city" data-placeholder="Choose one City">
                                                <option>-- Select --</option>
                                                @foreach ($city as $item)
                                                     <option value="{{$item->id}}">{{$item->name}}</option>                                                    
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3 repeat-section ">
                                        <div class="search-item">
                                            <label for="hotel_name" class="form-label">Preferred Hotel</label>
                                            <select class="form-select global-select" data-placeholder="Choose one thing" id="hotel-list" name="hotel_id">
                                                <option>-- Select --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3 repeat-section ">
                                        <div class="search-item pb-0">
                                            <label for="hotel_name" class="form-label">Price Range
                                                (optional)</label>
                                        </div>
                                        <select class="form-select global-select" name="price_range" data-placeholder="Choose one thing">
                                            <option>₹ 2500 - ₹ 5,000</option>
                                            <option>₹ 5,000 - ₹ 10,000</option>
                                            <option>₹ 10,000 - ₹ 50,000</option>
                                            <option>₹ 50,000 -₹ 100,000</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3 repeat-section">
                                        <div class="search-item position-relative room-search px-0">
                                            <div class="">
                                                <label for="exampleInputEmail1" class="form-label">Number of
                                                    Guests</label>
                                            </div>
                                            <select class="form-select global-select" data-placeholder="Choose one thing" name="total_guest">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3 repeat-section">
                                        <div class="search-item position-relative room-search px-0">
                                            <div class="">
                                                <label for="exampleInputEmail1" class="form-label">Number of Rooms</label>
                                            </div>
                                            <select class="form-select global-select" data-placeholder="Choose one thing" name="total_room">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3 repeat-section ">
                                        <div class="search-item">
                                            <label for="exampleInputEmail1" class="form-label">Check In</label>
                                            <h4 class="section-hotel check-in">----</h4>
                                            <input type="text" class="form-control d-none"
                                                aria-describedby="emailHelp" name="checkin_date">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-3 repeat-section">
                                        <div class="search-item p-0">
                                            <label for="exampleInputEmail1" class="form-label">Check out</label>
                                            <h4 class="section-hotel check-out">----</h4>
                                            <input type="text" class="form-control d-none"
                                                aria-describedby="emailHelp" name="checkout_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-3 mx-2">
                                    <div class="col-12">
                                        <button class="btn btn-outline-primary btn-block w-100" title="Send Enquiry">Send Enquiry</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-21 py-xl-4 py-3">
    <div class="container py-xl-4 py-3">
        <div class="section-heading">
            <div class="section-title">Tailored Hotel Booking Solutions - We’re here to make it effortless.</div>
            <div class="section-para">
                At UttarkashiHotel.in, we specialize in customized hotel booking solutions
            </div>
        </div>

        <div class="row tailored-hotel">
            <div class="col-12" id="discound-slider-II">
                <div class="tailored">
                    <div class="row g-0 align-items-center">
                        <div class="col-7">
                            <div class="tailored-container">
                                <div class="box-36">
                                    <img src="{{asset('assets/front/images/large_group.svg')}}" alt="">
                                </div>
                                <div class="content">Large Group Stays (40+ Guests)</div>
                            </div>
                        </div>
                        <div class="col-5">
                            <img src="{{asset('assets/front/images/tailored1.webp')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="tailored">
                    <div class="row g-0 align-items-center">
                        <div class="col-7">
                            <div class="tailored-container">
                                <div class="box-36">
                                    <img src="{{asset('assets/front/images/wedding.svg')}}" alt="">
                                </div>
                                <div class="content">Weddings & Special Occasions</div>
                            </div>
                        </div>
                        <div class="col-5">
                            <img src="{{asset('assets/front/images/tailored2.webp')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="tailored">
                    <div class="row g-0 align-items-center">
                        <div class="col-7">
                            <div class="tailored-container">
                                <div class="box-36">
                                    <img src="{{asset('assets/front/images/tailored.svg')}}" alt="">
                                </div>
                                <div class="content">Corporate Events & Conferences</div>
                            </div>
                        </div>
                        <div class="col-5">
                            <img src="{{asset('assets/front/images/tailored3.webp')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-22 pb-5">
    <div class="container pb-4">
        <div class="row">
            <div class="col-12">
                <div class="image bg-image-style lazy"
                    data-bg="{{ asset('assets/front/images/consult-section-23.webp') }}">
                    <div class="content">
                        <div>
                            <h4>
                                Ready to check in to your next adventure?
                            </h4>
                            <p>Don’t just book it, crook it with us for a steal of a deal!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <section class="section-23">
    <div class="container">
        <h4 class="section-heading">
            Popular Hotels for Group Stays
        </h4>
        <div class="row pt-4 mt-2">
            <div class="col-12">
                <div class="" id="slider-II">
                    <div class="main-slider">
                        <div class="card-bg bg-image-style lazy"
                            data-bg="{{ asset('assets/front/images/slider-img-1.webp') }}">
                            <div class="off">
                                20% off
                            </div>
                            <div class="hotels-details">
                                <span>NEW DELHI</span>
                                <h3>The Manor</h3>
                                <small>9.0/10 (105 reviews)</small>
                                <div class="price">₹12,000 <b>₹15,000</b> per night</div>
                                <p>₹25,974 total includes taxes & fees</p>
                            </div>
                        </div>
                    </div>
                    <div class="main-slider">
                        <div class="card-bg bg-image-style lazy"
                            data-bg="{{ asset('assets/front/images/mumbai.webp') }}">
                            <div class="off">
                                20% off
                            </div>
                            <div class="hotels-details">
                                <span>Mumbai</span>
                                <h3>Aurika, Mumbai International Airport</h3>
                                <small>9.2/10 (105 reviews)</small>
                                <div class="price">₹9,850 <b>₹12,000</b> per night</div>
                                <p>₹25,974 total includes taxes & fees</p>
                            </div>
                        </div>
                    </div>
                    <div class="main-slider">
                        <div class="card-bg bg-image-style lazy"
                            data-bg="{{ asset('assets/front/images/hamilton.webp') }}">
                            <div class="off">
                                20% off
                            </div>
                            <div class="hotels-details">
                                <span>BENGALURU</span>
                                <h3>Adarsh Hamilton</h3>
                                <small>9.0/10 (105 reviews)</small>
                                <div class="price">₹6,100 <b>₹76,00</b> per night</div>
                                <p>₹13,274 total includes taxes & fees</p>
                            </div>
                        </div>
                    </div>

                    <div class="main-slider">
                        <div class="card-bg bg-image-style lazy" data-bg="{{ asset('assets/front/images/jaipur.webp') }}">
                            <div class="off">
                                20% off
                            </div>
                            <div class="hotels-details">
                                <span>Jaipur</span>
                                <h3>Lemon Tree Premier</h3>
                                <small>8.4/10 (105 reviews)</small>
                                <div class="price">₹5,000 <b>₹7,000</b> per night</div>
                                <p>₹15,974 total includes taxes & fees</p>
                            </div>
                        </div>
                    </div>
                    <div class="main-slider">
                        <div class="card-bg bg-image-style lazy"
                            data-bg="{{ asset('assets/front/images/hamilton.webp') }}">
                            <div class="off">
                                20% off
                            </div>
                            <div class="hotels-details">
                                <span>BENGALURU</span>
                                <h3>Adarsh Hamilton</h3>
                                <small>9.0/10 (105 reviews)</small>
                                <div class="price">₹6,100 <b>₹76,00</b> per night</div>
                                <p>₹13,274 total includes taxes & fees</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<section class="section-24 py-xl-5 py-3">
    <div class="container py-xl-4 py-3">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center">
                    <h2>What Our Clients Say</h2>
                    <p>Your Top Questions Answered</p>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8">
                <div class="bg-white-section" id="testimonial-slider-II">
                    <div>
                        <div class="slider-section">
                            <div class="img">
                                <img src="{{asset('assets/front/images/quote.svg')}}" alt="">

                            </div>
                            <div class="content">
                                <p>UttarkashiHotel.in made finding the perfect hotel so easy! The booking process was smooth, and the rates were unbeatable. My stay was comfortable and hassle-free!</p>
                            </div>
                            <div class="user-section">
                                <div class="d-flex align-items-center">
                                    <div class="image">
                                        <img src="{{asset('assets/front/images/Arjun_Mehta.webp')}}" width="" height="" alt=""
                                            title="">
                                    </div>
                                    <div class="autor ps-xl-3 px-3">
                                        <h3>Arjun Mehta</h3>
                                        {{-- <p>Mining Company</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="slider-section">
                            <div class="img">
                                <img src="{{asset('assets/front/images/quote.svg')}}" alt="">

                            </div>
                            <div class="content">
                                <p>The wide variety of hotel options on UttarkashiHotel.in amazed me. I found a luxurious hotel within my budget, and the customer support team ensured everything went perfectly!</p>
                            </div>
                            <div class="user-section">
                                <div class="d-flex align-items-center">
                                    <div class="image">
                                        <img src="{{asset('assets/front/images/Priya_Sharma.webp')}}" width="" height="" alt=""
                                            title="">
                                    </div>
                                    <div class="autor ps-xl-3 px-3">
                                        <h3>Priya Sharma</h3>
                                        {{-- <p>Mining Company</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="slider-section">
                            <div class="img">
                                <img src="{{asset('assets/front/images/quote.svg')}}" alt="">

                            </div>
                            <div class="content">
                                <p>I always use UttarkashiHotel.in for my business trips. The platform is user-friendly, and the detailed reviews helped me choose the right hotel every time. Highly recommended!</p>
                            </div>
                            <div class="user-section">
                                <div class="d-flex align-items-center">
                                    <div class="image">
                                        <img src="{{asset('assets/front/images/Rahul_Verma.webp')}}" width="" height="" alt=""
                                            title="">
                                    </div>
                                    <div class="autor ps-xl-3 px-3">
                                        <h3>Rahul Verma</h3>
                                        {{-- <p>Mining Company</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="slider-section">
                            <div class="img">
                                <img src="{{asset('assets/front/images/quote.svg')}}" alt="">

                            </div>
                            <div class="content">
                                <p>UttarkashiHotel.in made my vacation planning stress-free. The site provided excellent deals on premium hotels, and I loved how accurate the descriptions and photos were!</p>
                            </div>
                            <div class="user-section">
                                <div class="d-flex align-items-center">
                                    <div class="image">
                                        <img src="{{asset('assets/front/images/Vishal_Gupta.webp')}}" width="" height="" alt=""
                                            title="">
                                    </div>
                                    <div class="autor ps-xl-3 px-3">
                                        <h3>Vishal Gupta</h3>
                                        {{-- <p>Mining Company</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="slider-section">
                            <div class="img">
                                <img src="{{asset('assets/front/images/quote.svg')}}" alt="">

                            </div>
                            <div class="content">
                                <p>UttarkashiHotel.in offers fantastic deals and exceptional customer service. I had a minor issue during check-in, but their team resolved it quickly. Will definitely book again!</p>
                            </div>
                            <div class="user-section">
                                <div class="d-flex align-items-center">
                                    <div class="image">
                                        <img src="{{asset('assets/front/images/Vikram_Singh.webp')}}" width="" height="" alt=""
                                            title="">
                                    </div>
                                    <div class="autor ps-xl-3 px-3">
                                        <h3>Vikram Singh</h3>
                                        {{-- <p>Mining Company</p> --}}
                                    </div>
                                </div>
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
                                    Who can use the Consult Now service?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    This service is ideal for individuals or organizations planning:
                                    <ul class="mt-2">
                                        <li>Long-term stays</li>
                                        <li>Bookings for 20+ guests</li>
                                        <li>Weddings, corporate events, or special functions</li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    How does the consultation process work?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Simply fill out the inquiry form with your requirements. Our team will review your
                                    details and connect with you within minutes to provide tailored options.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Can you help with event-specific bookings like weddings or conferences?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Absolutely! We specialize in helping you find the perfect venue and accommodations
                                    for weddings, corporate events, conferences, and other special occasions.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Do you offer group discounts or special rates?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Yes, we negotiate exclusive group rates and discounts to provide you with the best
                                    value for your booking.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    What details do I need to provide for my inquiry?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    To help us serve you better, please share:
                                    <ul class="mt-2">
                                        <li>Dates and duration of stay</li>
                                        <li>Number of guests</li>
                                        <li>Type of event (if applicable)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    How quickly can I expect a response?
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Our team typically connects with you within a few minutes of receiving your inquiry.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    Is there a fee for using the consultation service?
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    No, our consultation service is completely free!
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingEight">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                    Can I make changes to my booking after confirmation?
                                </button>
                            </h2>
                            <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Yes, our team will assist you with any changes or modifications to your booking,
                                    subject to the hotel's policies.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingNine">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapsgNine" aria-expanded="false" aria-controls="collapsgNine">
                                    What if I need assistance during my stay or event?
                                </button>
                            </h2>
                            <div id="collapsgNine" class="accordion-collapse collapse" aria-labelledby="headingNine"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Our support team is available to assist you at every step, ensuring a hassle-free
                                    experience.
                                    Let me know if you'd like to customize these further!
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
            item.classList.toggle('active');
        });
    });

// document.getElementById('validate-form').addEventListener('submit', async function (event) {
//     event.preventDefault(); // Prevent default form submission

//     const formData = new FormData(this);
//     const response = await fetch(this.action, {
//         method: 'POST',
//         body: formData,
//     });

//     const result = await response.json();
//     if (result.status === 200) {
//         window.location.reload(); // Refresh the page
//     } else {
//         alert('Error: ' + result.message); // Show an error message if needed
//     }
//     });
});


     $(document).ready(function() {
            ajaxCall();
      });

        $('#city, #rating').on('change', function() {
            ajaxCall();
        });

       function ajaxCall() {
        let cityValue = $('#city').val();
        let ratingValue = $('#rating').val();
        $.ajax({
            url: '{{ route("hotel.list.consult.now") }}', 
            method: 'GET',
            data: { 
                city: cityValue, 
                rating: ratingValue 
            },
            success: function(response) {
                var html = '<option value=" ">All Hotels</option>';
                $.each(response.data, function(index, item) {
                      var capitalizedName = item.name.replace(/\b\w/g, function(match) {
                        return match.toUpperCase();
                        });
                    html += '<option value="' + item.id + '">' + capitalizedName + '</option>';
                });
                $('#hotel-list').html(html);

            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }
</script>
@endsection
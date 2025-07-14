<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ticket Pdf</title>
    <link rel="stylesheet" href="{{asset('assets/css/pdf.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex justify-content-center align-items-center h-100 cover-img">
        <div class="max-width">
            <div class="page-header d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column">
                    <p class="fw-bold fs-8 mb-0 text-color">Booking Voucher</p>
                    <p class="fw-normal fs-8 mb-0 text-color-secondary">Booking ID : NH250JHVDBH7656</p>
                    <p class="fw-normal fs-8 mb-0 text-color-secondary">Booked on: 08-June-2024, 04:33 PM</p>
                </div>
                <img src="{{asset('assets/front/images/Logo-b.svg')}}" alt="">
            </div>

            <div class="page-content d-flex flex-column mt-4">
                <div class="d-flex justify-content-between align-items-center border-bottom-custom-dark pb-2">
                    <div class="d-flex gap-2 align-items-start">
                        <div class="d-flex flex-column">
                            <h1 class="fs-6 text-color mb-0 fw-semibold">Fairfield by Marriott Goa Calangute</h1>
                            <p class="text-color-secondry mb-0 fs-8">H No, 1/72C, Gauravaddo, Calangute, Goa 403516</p>
                        </div>
                        <div class="border-custom rounded px-2">
                            <i class="bi bi-star-fill fs-7 text-star"></i>
                            <i class="bi bi-star-fill fs-7 text-star"></i>
                            <i class="bi bi-star-fill fs-7 text-star"></i>
                            <i class="bi bi-star-fill fs-7 text-no-star"></i>
                            <i class="bi bi-star-fill fs-7 text-no-star"></i>
                        </div>
                    </div>
                    <button class="text-success p-4-16 border-custom rounded bg-white fs-8 fw-semibold">
                        Confirmed
                    </button>
                </div>

                <table class="table">
                    <tbody>
                        <tr>
                            <td class="border-bottom-custom pt-18 pb-18 w-25">
                                <div class="d-flex align-items-center gap-1">
                                    <span class="material-symbols-outlined text-color-secondary fs-6">
                                        calendar_month
                                    </span>
                                    <p class="fs-7 text-color-secondary mb-0 fw-semibold">2 Nights(s) stay</p>
                                </div>
                            </td>
                            <td class="border-bottom-custom pt-18 pb-18">
                                <div class="d-flex flex-column align-items-start">
                                    <p class="fs-8 text-color mb-0 fw-regular">Check-In: 01:00PM</p>
                                    <p class="fs-7 text-color-secondary mb-0 fw-semibold">09 Aug. 2024</p>
                                </div>
                            </td>
                            <td class="border-bottom-custom pt-18 pb-18">
                                <div class="d-flex flex-column align-items-start">
                                    <p class="fs-8 text-color mb-0 fw-regular">Check-Out: 03:00PM</p>
                                    <p class="fs-7 text-color-secondary mb-0 fw-semibold">12 Aug. 2024</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-bottom-custom pt-18 pb-18">
                                <div class="d-flex align-items-center gap-1">
                                    <span class="material-symbols-outlined text-color-secondary fs-6">
                                        calendar_month
                                    </span>
                                    <p class="fs-7 text-color-secondary mb-0 fw-semibold">2 Travelers</p>
                                </div>
                            </td>
                            <td class="border-bottom-custom pt-18 pb-18">
                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex flex-column justify-content-between align-items-start">
                                        <p class="fs-7 text-color mb-0 fw-semibold">Mr. Admin Kumar</p>
                                        <p class="fs-8 text-color-secondary mb-0 fw-regular">admin1@gmail.com</p>
                                    </div>
                                    <div class="d-flex flex-column justify-content-between align-items-start">
                                        <p class="fs-7 text-color mb-0 fw-semibold">Mrs. Admini Kumari</p>
                                        <p class="fs-8 text-color-secondary mb-0 fw-regular">admin1@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td class="border-bottom-custom pt-18 pb-18">
                                <div class="d-flex flex-column align-items-start">
                                    <div class="d-flex flex-column gap-2">
                                        <p class="fs-7 text-color mb-0 fw-semibold">M</p>
                                        <p class="fs-7 text-color mb-0 fw-semibold">F</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-0 pt-18 pb-18">
                                <div class="d-flex align-items-center gap-1">
                                    <span class="material-symbols-outlined text-color-secondary fs-6">
                                        door_front
                                    </span>
                                    <p class="fs-7 text-color-secondary mb-0 fw-semibold">2 Room</p>
                                </div>
                            </td>
                            <td colspan="2" class="border-0 pt-15 pb-18">
                                <div class="d-flex flex-column gap-2 align-items-start mt-2">
                                    <div class="d-flex gap-2">
                                        <p class="fs-7 text-color mb-0 fw-semibold">1 x Standard AC Room</p>
                                        <span
                                            class="badge text-whtie rounded non-refund-bg">Non-Refundable</span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <span class="material-symbols-outlined fs-6 text-color-secondary">
                                            concierge
                                        </span>
                                        <p class="fs-8 text-color-secondary mb-0 fw-regular">Room With Free Breakfast
                                        </p>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <span class="material-symbols-outlined fs-6 text-color-secondary">
                                            work_history
                                        </span>
                                        <p class="fs-8 text-color-secondary mb-0 fw-regular">This booking is
                                            non-refundable.
                                            You will not get a refund if you cancel this booking.
                                        </p>
                                    </div>
                                </div>

                                <div class="d-flex flex-column gap-2 align-items-start mt-3">
                                    <div class="d-flex gap-2 ">
                                        <p class="fs-7 text-color mb-0 fw-semibold">1 x Double AC Bedroom</p>
                                        <span class="badge text-whtie rounded refund-bg">Refundable</span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <span class="material-symbols-outlined fs-6 text-color-secondary">
                                            concierge
                                        </span>
                                        <p class="fs-8 text-color-secondary mb-0 fw-regular">Room With Free Breakfast
                                        </p>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <span class="material-symbols-outlined fs-6 text-color-secondary">
                                            work_history
                                        </span>
                                        <p class="fs-8 text-color-secondary mb-0 fw-regular">This booking is refundable.
                                            You will get a refund if you cancel this booking before 12th September 2024.
                                        </p>
                                    </div>

                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="border-custom rounded p-3 mb-4">
                    <div class="d-flex gap-2 align-items-center">
                        <span class="material-symbols-outlined text-important fs-4">
                            chat_info
                        </span>
                        <p class="fs-7 text-important mb-0 fw-semibold">Important</p>
                    </div>
                    <ul class="ps-3 mb-0 mt-2">
                        <li class="text-color-secondary fs-8 pl-2">
                            Passport, Aadhar, Driving License and Govt. ID are accepted as ID proof(s). Local ids are
                            allowed.
                        </li>
                        <li class="text-color-secondary fs-8 pl-2 mt-1">
                            GST invoice can be collected directly from the property.
                        </li>
                    </ul>
                </div>

            </div>
            
            <div class="page-content d-flex flex-column">
                <div class="mt-0">
                    <h6 class="text-color fw-bold border-bottom-custom-dark fs-7 pb-2">Fare & Payment Details</h6>
                </div>

                <table class="table">
                    <tbody>
                        <tr>
                            <td class="border-bottom-custom pt-18 pb-18 px-0">
                                <div class="d-flex flex-column gap-2">
                                    <p class="fs-8 text-color mb-0 fw-regular">Standard Room Price (Inclusive of GST)</p>

                                    <p class="fs-8 text-color mb-0 fw-regular">Total Days</p>
                                </div>
                            </td>
                            <td class="border-bottom-custom pt-18 pb-18 px-0">
                                <div class="d-flex flex-column gap-2">

                                    <p class="fs-8 text-color mb-0 fw-regular text-end">₹ 4500.00</p>

                                    <p class="fs-8 text-color mb-0 fw-regular text-end">x2</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-bottom-custom pt-18 pb-18 px-0">
                                <div class="d-flex flex-column gap-2">
                                    <p class="fs-7 text-color mb-0 fw-semibold">Room Cost</p>
                                </div>
                            </td>
                            <td class="border-bottom-custom pt-18 pb-18 px-0">
                                <div class="d-flex flex-column gap-2">
                                    <p class="fs-7 text-color mb-0 fw-semibold text-end">₹ 9000.00</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-bottom-custom pt-18 pb-18 px-0">
                                <div class="d-flex flex-column gap-2">
                                    <p class="fs-8 text-color mb-0 fw-regular">Hottel Convenience Fees (Inclusive of
                                        GST)</p>

                                    <p class="fs-8 text-color mb-0 fw-regular">Hottel Discount</p>

                                    <p class="fs-8 text-color mb-0 fw-regular">Coupon Discount</p>
                                </div>
                            </td>
                            <td class="border-bottom-custom pt-18 pb-18 px-0">
                                <div class="d-flex flex-column gap-2">
                                    <p class="fs-8 text-color mb-0 fw-regular text-end">₹ 236.00</p>

                                    <p class="fs-8 text-color mb-0 fw-regular text-end">-₹ 2500.00</p>

                                    <p class="fs-8 text-color mb-0 fw-regular text-end">-₹ 500.00</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-bottom-custom-dark pt-18 pb-18 px-0">
                                <div class="d-flex flex-column gap-2">
                                    <p class="fs-7 text-color mb-0 fw-semibold">Total Booking Amount</p>
                                </div>
                            </td>
                            <td class="border-bottom-custom-dark pt-18 pb-18 px-0">
                                <div class="d-flex flex-column gap-2">
                                    <p class="fs-7 text-color mb-0 fw-semibold text-end">₹ 6236.00</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-4 d-flex justify-content-center align-items-center gap-54">
                    <div class="d-flex align-items-center gap-10">
                        <span class="material-symbols-outlined">
                            call_quality
                        </span>
                        <div class="d-flex flex-column">
                            <p class="text-color-secondary fs-10 mb-0">24x7 Flights Helpline</p>
                            <p class="text-color-secondary fs-8 mb-0 fw-semibold">09999 999 999</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-10">
                        <span class="material-symbols-outlined">
                            headset_mic
                        </span>
                        <div class="d-flex flex-column">
                            <p class="text-color-secondary fs-10 mb-0">Hotel Support</p>
                            <p class="text-color-secondary fs-8 mb-0 fw-semibold">70603 06983</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-10">
                        <span class="material-symbols-outlined">
                            favorite
                        </span>
                        <div class="d-flex flex-column">
                            <p class="text-color-secondary fs-10 mb-0">24X7 Care</p>
                            <p class="text-color-secondary fs-8 mb-0 fw-semibold">hottel.in/care</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="page-footer d-flex align-items-center justify-content-between">
                <img src="{{asset('assets/front/images/Logo-b.svg')}}" alt="" class="pe-2">
                <div class="line"></div>
                <p class="text-color-secondary fs-10 mb-0 ps-2">www.hottel.in</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Receipt/Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .sections {
            position: relative;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            text-align: center;
            height: 100%;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
            z-index: 1;
        }
        .sections::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("{{ asset('assets/front/images/bg-cover-ticket.svg') }}");
            background-position: center center;
            background-repeat: no-repeat;
            background-size: 38%;
            opacity: 1;
            z-index: 0;
            pointer-events: none;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 150px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .max-width {
        max-width: 46.2rem;
        /* /* max-height: 52.625rem; */
        height: 100%;
        width: 100%;
        margin: 0 auto;
        background-color: #fff;
        background-image: url('../front/images/bg-cover-ticket.svg');
        background-position: bottom;
        background-repeat: no-repeat;
        background-size: 38%;
    }
    </style>
</head>

<body>
    <div class="sections">
        
        <div class="header">
            <table style="width: 100%; border-collapse: collapse; border:0px;">
                <tr>
                    <td style="width: 30%; text-align: center; border:0px; padding-bottom:1rem;" colspan="2">
                        @php
                            $imageFile = is_file(public_storage_path(Auth::user()->business_logo)) ? storage_asset(Auth::user()->business_logo) : asset('assets/front/images/black-logo.svg');
                        @endphp
                        <img src="{{ !empty($message) ? $message->embed($imageFile) : $imageFile }}#" alt="Logo" style="width: 150px;"> <br/>
                        <strong>Tax Invoice</strong>
                    </td>
                </tr>
                <tr>
                    <td style="border:0px;">
                        <p style="margin: 0;margin-bottom: 0.3rem; font-size: 14px;"><strong>{{ $businessDetails?->business_name }}</strong></p>
                        <p style="margin: 0;margin-bottom: 0.3rem; font-size: 12px;">GSTIN: {{ $businessDetails?->gst_number }}</p>
                        <p style="margin: 0;margin-bottom: 0.3rem; font-size: 12px;">PAN Number: {{ $businessDetails?->pan_number }}</p>
                        <p style="margin: 0;margin-bottom: 0.3rem; font-size: 12px;">Website: <a href="{{ $businessDetails?->business_site }}">{{ $businessDetails?->business_site }}</a></p>
                    </td>
                    <td style="border:0px; text-align: right;">
                        <p style="margin: 0;margin-bottom: 0.3rem; font-weight: bold; font-size: 14px;">Payment Receipt</p>
                        <p style="margin: 0;margin-bottom: 0.3rem; font-size: 12px;">Booking ID: {{ $booking->booking_id }}</p>
                        <p style="margin: 0;margin-bottom: 0.3rem; font-size: 12px;">Invoice No.: {{ $booking->invoice?->invoice_number }}</p>
                        <p style="margin: 0;margin-bottom: 0.3rem; font-size: 12px;">Invoice Date: {{ formatDateMdY($booking->invoice?->invoice_date) }}</p>
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <h2 style="color:#1A1F24; font-size: 16px; font-weight: bold; padding-bottom:5px; padding-top:5px;">Hotel Details</h2>
            <div>
                <div style="width: 100%;">
                    <table>
                        <tr>
                            <th style="border:0px; padding:0px; font-size:14px; font-weight:600; color:#3E4C56; padding-bottom:10px;">Hotel Name</th>
                            <td style="border:0px; padding:0px; font-size:12px; color:#3E4C56; padding-bottom:10px;">
                                : <a href="{{ $booking?->hotel?->map_url }}" target="_blank"><strong>{{ $booking?->hotel?->name }}</strong></a>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:0px; padding:0px; font-size:14px; font-weight:600; color:#3E4C56; padding-bottom:10px;">Address</th>
                            <td style="border:0px; padding:0px; font-size:12px; color:#3E4C56;padding-bottom:10px;">
                                : {{ $booking?->hotel?->address }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div style="clear: both"></div>
        <div style="border-top:1px solid #D9D9D9; margin-top:0px; padding-top: 10px">
            <h2 style="color:#1A1F24; font-size: 16px; font-weight: bold;">Customer Details</h2>
            <div>
                <table>
                    <tr>
                        <th style="font-size:12px; font-weight:600; color:#3E4C56; padding-bottom:10px;">Name</th>
                        <td style="font-size:12px; color:#3E4C56; padding-bottom:10px;">{{ $booking?->bookingContact?->name }}</td>
                        <th style="font-size:12px; font-weight:600; color:#3E4C56; padding-bottom:10px;">Travel Date</th>
                        <td style="font-size:12px; color:#3E4C56; padding-bottom:10px;">
                            {{ formatDateMdY($booking?->check_in_date) }} {{$booking?->hotel?->check_in_time??'' }} - {{ formatDateMdY($booking?->check_out_date) }} {{$booking?->hotel?->check_out_time??'' }}
                        </td>
                    </tr>
                    <tr>
                        <th style="font-size:12px; font-weight:600; color:#3E4C56; padding-bottom:10px;">Email Address</th>
                        <td style="font-size:12px; color:#3E4C56; padding-bottom:10px;">{{ $booking?->bookingContact?->email }}</td>
                        <th style="font-size:12px; font-weight:600; color:#3E4C56; padding-bottom:10px;">Total Rooms</th>
                        <td style="font-size:12px; color:#3E4C56; padding-bottom:10px;">{{ $booking?->total_room }}</td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <th style="font-size:12px; font-weight:600; color:#3E4C56; padding-bottom:10px;">Mobile</th>
                        <td style="font-size:12px; color:#3E4C56; padding-bottom:10px;">{{ $booking->bookingContact?->mobile }}</td>
                        <th style="font-size:12px; font-weight:600; color:#3E4C56; padding-bottom:10px;">Total Guest</th>
                        <td style="font-size:12px; color:#3E4C56; padding-bottom:10px;">{{ $booking?->total_guest }}</td>
                    </tr>
                    <tr>
                        
                </table>
            </div>
        </div>
        <div style="clear: both"></div>
        <div style="border-top:1px solid #D9D9D9; margin-top:0px; padding-top: 20px">
            <h2 style="color:#1A1F24; font-size: 16px; font-weight: bold; border-bottom:1px solid #1A1F24; padding-bottom:10px; margin-bottom:25px;">Payment Breakup</h2>

            <table>
                @if( $booking?->bookedRooms->count() > 0 )
                    @foreach($booking?->bookedRooms as $room)
                <tr>
                    <td style="border:0px; padding:0px; font-size:14px; color:#3E4C56; padding-bottom:15px;">{{ $room?->quantity }} X {{ $room?->roomCategory->name }} ({{ $room?->plan_name }})</td>
                    <td style="border:0px; padding:0px; font-size:14px; color:#3E4C56; padding-bottom:15px; text-align:right;">₹ {{ $room->total_price }}</td>
                </tr>
                    @endforeach
                @endif
            </table>
        </div>
        <div style="clear: both"></div>
        
        <div style="border-bottom:1px solid #D9D9D9; border-top:1px solid #D9D9D9;">
            <table style="margin-bottom:0px;">
                <tr>
                    <td style="color:#1A1F24; font-size: 15px; font-weight: bold;  padding-bottom:20px; padding-top:20px; border:0px; padding-left:0px; ">
                        Total Amount Collected on Behalf of Hotel
                    </td>
                    <td style="border:0px; padding:0px; font-size:16px; color:#3E4C56; padding-top:20px; text-align:right; padding-bottom:20px; font-weight:500;  border:0px; ">₹ {{ $booking?->transactions?->sum('amount') }}</td>
                </tr>
            </table>
        </div>
        <div style="clear: both"></div>

        @php
            $couponAmount = $booking?->transactions?->sum('coupon');
        @endphp
        @if( $couponAmount > 0 )
        <div style="margin-top:0px; padding-top: 20px">
            <table>
                <tr>
                    <td style="border:0px; padding:0px; font-size:14px; color:#3E4C56; padding-bottom:15px;">Discount</td>
                    <td style="border:0px; padding:0px; font-size:14px; color:#3E4C56; padding-bottom:15px; text-align:right;">-₹ {{ _nf($couponAmount) }}</td>
                </tr>
            </table>
        </div>
        <div style="clear: both"></div>
        @endif

        <div style="border-bottom:1px solid #D9D9D9; border-top:1px solid #D9D9D9;">
            <table style="margin-bottom:0px;">
                <tr>
                    <td style="color:#1A1F24; font-size: 15px; font-weight: bold;  padding-bottom:20px; padding-top:20px; border:0px; padding-left:0px; ">
                        GST Collected
                    </td>
                    <td style="border:0px; padding:0px; font-size:16px; color:#3E4C56; padding-top:20px; text-align:right; padding-bottom:20px; font-weight:500;  border:0px; ">
                        @php
                            $markup = $booking?->transactions?->sum('amount') - $booking?->transactions?->sum('cost');
                            $gst = $markup - ($markup * (100 / 118));
                        @endphp
                        ₹ {{ _nf($gst) }}
                    </td>
                </tr>
            </table>
        </div>

        <div style="border-bottom:1px solid #D9D9D9; border-top:1px solid #D9D9D9;">
            <table style="margin-bottom:0px;">
                <tr>
                    <td style="color:#1A1F24; font-size: 18px; font-weight: bold;  padding-bottom:20px; padding-top:20px; border:0px; padding-left:0px;">Total Booking Amount</td>
                    <td style="border:0px; padding:0px; font-size:18px; color:#3E4C56; padding-top:20px; text-align:right; padding-bottom:20px; font-weight:700;  border:0px; ">₹ {{ _nf( $booking?->transactions?->sum('amount') ) }}</td>
                </tr>
            </table>
        </div>
        <p style="color:#000; font-size:12px; padding-top:20px;">This is a computer-generated receipt and does not require a Signature/Stamp.</p>

        <div class="page-footer" style="padding:0px; padding-top:20px; padding-bottom:20px; margin-top:20px;">
            <div style="width:49%; float:left;">
                <div style="text-align:left;">
                    <img src="{{asset('assets/front/images/Logo-b.svg')}}" />
                </div>
            </div>
            
            <div style="width:50%; float:left;">
                <p style="color:#000; font-size:14px; text-align:end;">www.hottel.in</p>
            </div>
        </div>
        <div style="clear: both"></div>
    </div>
</body>

</html>

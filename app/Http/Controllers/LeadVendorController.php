<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Services\LeadRemarkLogger;
use Exception;
use Illuminate\Support\Facades\Log;

class LeadVendorController extends Controller
{

    public function vendorMail($bookingId)
    {
        $booking = Booking::with('vendorStatus')->findOrFail(decode($bookingId));
        $html = '';
        if ($booking->vendorStatus?->status) {
            $html .= '<p class="booking-status-text text-info"><strong>Booking Confirmed At Hotel</strong></p>';
        } else if ($booking->vendorStatus?->is_mailed) {
            $html .= '<p class="booking-status-text text-danger"><strong>Booking Pending At Hotel</strong></p>
                <div class="btn-section">
                    <a href="javascript:void(0);" class="btn btn-primary d-block btn-hover confirm-hotel-booking" title="click to Confirm">
                        Confirm Booking
                    </a>
                </div>';
        } else {
            $html .= '<div class="btn-section send-mail-div">
                <a href="javascript:void(0);" class="btn btn-primary d-block btn-hover mail-to-hotel" title="click to send mail">Send Email for Confirmation</a>
            </div>';
        }
        return response()->json(['status' => 200, 'html' => $html]);
    }


    public function vendorStatus($bookingId)
    {
        try {
            $booking = Booking::with('vendorStatus')->findOrFail(decode($bookingId));
            $vendorStatus = $booking->vendorStatus()->firstOrCreate(
                [
                    'booking_id' => $booking->id,
                    'hotel_id'   => $booking->hotel_id
                ],
                [
                    'hotel_id'      => $booking->hotel_id,
                    'status'        => true,
                    'confirmed_by'  => auth()->user()->id
                ]
            );

            $vendorStatus->update(['status' => true]);
            $booking->refresh();
            $booking->update(['status' => 'Confirmed']);
            $html = '';
            if ($booking->vendorStatus?->status) {
                $html .= '<h3 class="booking-status-text text-info"><strong>Booking Confirmed At Hotel</strong></h3>';
            }

            $remark = 'Booking Confirmed At Hotel';
            LeadRemarkLogger::logChanges([], [], $booking->id, "remark", $remark, true);

            return response()->json(['status' => 200, 'message' => 'Booking Confirmed At Vendor Successfully!', 'html' => $html]);
        } catch (Exception $e) {
            Log::error('Error vendor status: ', ['message' => $e->getMessage()]);
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ], 200);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Jobs\BookingCancellationProcessJob;
use App\Jobs\BookingCancelledByVendorJob;
use App\Jobs\BookingCancelledJob;
use App\Jobs\BookingChangeJob;
use App\Jobs\BookingConfirmationJob;
use App\Jobs\BookingInvoiceJob;
use App\Jobs\BookingPendingJob;
use App\Jobs\BookingRejectedJob;
use App\Jobs\GoogleReviewJob;
use App\Jobs\VendorConfirmationJob;
use App\Models\Booking;
use Illuminate\Http\Request;

class EmailHandlerController extends Controller
{
    public function emailPreview($bookingId, $emailType)
    {
        $booking = Booking::with([
            'bookingContact',
            'hotel:id,name,map_url',
            'transactions' => function ($query) use ($emailType) {
                $query->when($emailType === 'payment-pending', function ($q) {
                    $q->where('status', 'payment-pending');
                }, function ($q) {
                    $q->where('status', 'captured');
                });
            },
        ])->where('id', decode($bookingId))->firstOrFail();

        $views = [
            'pending'           => 'email.hottel.booking-pending',
            'payment-pending'   => 'email.hottel.payment-pending',
            'confirm'           => 'email.hottel.booking-confirmed',
            'invoice'           => 'email.hottel.booking-invoice',
            'change'            => 'email.hottel.booking-change',
            'cancellation'      => 'email.hottel.booking-cancellation',
            'cancelled_by_client'   => 'email.hottel.booking-cancelled',
            'cancelled_by_vendor'   => 'email.hottel.booking-cancelled-by-vendor',
            'rejected'          => 'email.hottel.booking-rejected',
            'google_review'     => 'email.hottel.google_review',
            'vendor-mail'       => 'email.hottel.vendor-confirmation',
        ];
        $preview = true;
        $penaltyAmount = 0;
        // Check if the option exists in the mapping
        if (array_key_exists($emailType, $views)) {
            return view($views[$emailType], compact('preview', 'booking', 'emailType', 'penaltyAmount'));
        }
        return response('View not found', 404);
    }

    public function emailSend(Request $request)
    {

        $bookingId = $request->booking_id;
        $emailType = $request->email_type;

        $booking = Booking::with([
            'bookingContact',
        ])->where('booking_id', $request->booking_id)->firstOrFail();

        $emailHandlers = [
            'pending'           => fn() => BookingPendingJob::dispatch($bookingId, auth()->user()?->id),
            'payment-pending'   => function () {
                return true;
            },
            'confirm'           => fn() => BookingConfirmationJob::dispatch($bookingId,$request->confirmation_number,$request->confirmed_by,auth()->user()?->id),
            'invoice'           => fn() => BookingInvoiceJob::dispatch($bookingId, auth()->user()?->id),
            'change'            => fn() => BookingChangeJob::dispatch($bookingId, auth()->user()?->id),
            'cancellation'      => fn() => BookingCancellationProcessJob::dispatch($bookingId, auth()->user()?->id, $request->penaltyAmount ?? 0),
            'cancelled_by_client' => fn() => BookingCancelledJob::dispatch($bookingId, auth()->user()?->id),
            'cancelled_by_vendor' => fn() => BookingCancelledByVendorJob::dispatch($bookingId, auth()->user()?->id),
            'rejected'          => fn() => BookingRejectedJob::dispatch($bookingId, auth()->user()?->id),
            'google_review'     => fn() => GoogleReviewJob::dispatch($bookingId, auth()->user()?->id),
            'vendor-mail'       => fn() => VendorConfirmationJob::dispatch($bookingId, auth()->user()?->id),
        ];

        if (!array_key_exists($emailType, $emailHandlers)) {
            return response(['status' => 422, 'message' => 'Invalid Status.']);
        }
        $recipientName = $booking?->bookingContact->name;
        $recipientEmail = $booking?->bookingContact->email;
        if ($emailType == 'vendor-mail') {
            $recipientName = $booking?->hotel->name;
            $recipientEmail = $booking?->hotel?->email ?? $booking?->hotel?->owner_email;
        }

        $emailHandlers[$emailType]();
        $message = ucfirst(str_replace('_', ' ', $emailType)) . " sent to {$recipientName} ({$recipientEmail})";

        return response(['status' => 200, 'message' => $message]);
    }
}

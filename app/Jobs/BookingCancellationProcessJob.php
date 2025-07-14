<?php

namespace App\Jobs;

use App\Mail\BookingCancellationMail;
use App\Mail\BookingCancellationProcessMail;
use App\Models\Booking;
use App\Models\BookingEmails;
use App\Traits\ConfiguresDynamicMailSettings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BookingCancellationProcessJob implements ShouldQueue
{
    use Queueable, ConfiguresDynamicMailSettings;
    public $bookingId;
    public $penaltyAmount;
    public $sentBy;

    /**
     * Create a new job instance.
     */
    public function __construct($bookingId, $sentBy, $penaltyAmount = 0)
    {
        $this->bookingId = $bookingId;
        $this->penaltyAmount = $penaltyAmount;
        $this->sentBy = $sentBy;
    }

    /**
     * Execute the job.
    */
    public function handle(): void
    {
        try{
            $this->configureDynamicMailSettings();

            $booking = Booking::with([
                'bookingContact',
                'hotel:id,name',
            ])->where('booking_id', $this->bookingId)->first();

            if ($booking?->bookingContact?->email) {
                Mail::to($booking?->bookingContact?->email)
                    ->send(new BookingCancellationProcessMail($booking, $this->penaltyAmount));

                $bookingEmail               = new BookingEmails();
                $bookingEmail->booking_id   = $booking->id;
                $bookingEmail->email        = $booking->bookingContact->email;
                $bookingEmail->subject      = 'Cancellation & Refund Processed';
                $bookingEmail->sent_by      = $this->sentBy;
                $bookingEmail->save();
            } else {
                Log::warning("BookingRejectedJob: No email found for booking ID {$this->bookingId}");
            }
        }catch(\Exception $e){
            Log::info("BookingCancellationProcessJob Failed: ", $e->getMessage());
        }
    }
}

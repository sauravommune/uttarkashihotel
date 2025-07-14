<?php

namespace App\Jobs;

use App\Mail\BookingCancelledMail;
use App\Models\Booking;
use App\Models\BookingEmails;
use App\Traits\ConfiguresDynamicMailSettings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BookingCancelledJob implements ShouldQueue
{
    use Queueable, ConfiguresDynamicMailSettings;
    public $bookingId;
    public $sentBy;

    /**
     * Create a new job instance.
     */
    public function __construct($bookingId, $sentBy)
    {
        $this->bookingId = $bookingId;
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

            if (!$booking?->bookingContact?->email) {
                Mail::to($booking?->bookingContact?->email)
                    ->send(new BookingCancelledMail($booking));

                $bookingEmail               = new BookingEmails();
                $bookingEmail->booking_id   = $booking->id;
                $bookingEmail->email        = $booking->bookingContact->email;
                $bookingEmail->subject      = 'Booking Cancelled';
                $bookingEmail->sent_by      = $this->sentBy;
                $bookingEmail->save();
            } else {
                Log::warning("BookingRejectedJob: No email found for booking ID {$this->bookingId}");
            }
        }catch(\Exception $e){
            Log::info("BookingRejectedJob Failed: ", $e->getMessage());
        }
    }
}

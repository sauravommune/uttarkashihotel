<?php

namespace App\Jobs;

use App\Mail\BookingConfirmationMail;
use App\Models\Booking;
use App\Models\BookingEmails;
use App\Traits\ConfiguresDynamicMailSettings;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BookingConfirmationJob implements ShouldQueue
{
    use Queueable, ConfiguresDynamicMailSettings;

    public $bookingId;
    public $sentBy;
    public $confirmation_number;
    public $confirmed_by;
    /**
     * Create a new job instance.
     */
    public function __construct($bookingId, $confirmation_number,$confirmed_by,$sentBy=null)
    {
        $this->bookingId = $bookingId;
        $this->sentBy = $sentBy;

        $this->confirmation_number = $confirmation_number;
        $this->confirmed_by = $confirmed_by;
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
                'hotel:id,name,map_url',
                'bookedRooms',
                'transactions' => function ($query) {
                    $query->where('status', 'captured');
                },
            ])->where('booking_id', $this->bookingId)->first();

            if ($booking?->bookingContact?->email) {
                Mail::to($booking->bookingContact->email)->send(
                    new BookingConfirmationMail($booking, $this->confirmation_number, $this->confirmed_by));

                $booking->is_mailed = 1;
                $booking->save();

                $bookingEmail               = new BookingEmails();
                $bookingEmail->booking_id   = $booking->id;
                $bookingEmail->email        = $booking->bookingContact->email;
                $bookingEmail->subject      = 'Booking Confirmation';
                $bookingEmail->sent_by      = $this->sentBy;
                $bookingEmail->save();
            } else {
                Log::warning("BookingConfirmationJob: No email found for booking ID {$this->bookingId}");
            }
        }catch(\Exception $e){
            Log::error("BookingConfirmationJob Failed for {$this->bookingId}: " . $e->getMessage(), ['exception' => $e]);
        }
    }
}

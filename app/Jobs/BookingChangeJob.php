<?php

namespace App\Jobs;

use App\Mail\BookingChangeMail;
use App\Models\Booking;
use App\Models\BookingEmails;
use App\Traits\ConfiguresDynamicMailSettings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BookingChangeJob implements ShouldQueue
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
                'hotel:id,name,map_url',
                'bookedRooms',
                'transactions' => function ($query) {
                    $query->where('status', 'captured');
                },
            ])->where('booking_id', $this->bookingId)->first();

            if ($booking?->bookingContact?->email) {
                Mail::to($booking->bookingContact->email)
                    ->send(new BookingChangeMail($booking));

                $booking->is_mailed = 1;
                $booking->save();

                $bookingEmail               = new BookingEmails();
                $bookingEmail->booking_id   = $booking->id;
                $bookingEmail->email        = $booking->bookingContact->email;
                $bookingEmail->subject      = 'Booking Changed';
                $bookingEmail->sent_by      = $this->sentBy;
                $bookingEmail->save();
            } else {
                Log::warning("BookingChangeJob: No email found for booking ID {$this->bookingId}");
            }
        }catch(\Exception $e){
            Log::error("BookingChangeJob Failed for {$this->bookingId}: " . $e->getMessage(), ['exception' => $e]);
        }
    }
}

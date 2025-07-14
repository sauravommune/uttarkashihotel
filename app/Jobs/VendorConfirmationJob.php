<?php

namespace App\Jobs;

use App\Mail\VendorConfirmationMail;
use App\Models\Booking;
use App\Models\BookingEmails;
use App\Traits\ConfiguresDynamicMailSettings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class VendorConfirmationJob implements ShouldQueue
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
                'hotel:id,name,email,owner_email',
                'bookedRooms',
            ])->where('booking_id', $this->bookingId)->first();
            $vendorEmail = $booking?->hotel?->email ?? $booking?->hotel?->owner_email;
            if ( $vendorEmail ) {
                Mail::to($vendorEmail)
                    ->send(new VendorConfirmationMail($booking));

                $booking->is_mailed = 1;
                $booking->save();

                $vendorStatus = $booking->vendorStatus()->firstOrCreate(
                    [
                        'booking_id' => $booking->id,
                        'hotel_id'   => $booking->hotel_id
                    ],
                    [
                        'hotel_id'   => $booking->hotel_id,
                        'is_mailed'     => true,
                    ]
                );
                $vendorStatus->update(['is_mailed' => true]);

                $bookingEmail               = new BookingEmails();
                $bookingEmail->booking_id   = $booking->id;
                $bookingEmail->email        = $vendorEmail;
                $bookingEmail->subject      = 'Vendor Confirmation';
                $bookingEmail->sent_by      = $this->sentBy;
                $bookingEmail->save();
            } else {
                Log::warning("VendorConfirmationJob: No Vendor email found for booking ID {$this->bookingId}");
            }
        }catch(\Exception $e){
            Log::error("VendorConfirmationJob Failed for {$this->bookingId}: " . $e->getMessage(), ['exception' => $e]);
        }
    }
}

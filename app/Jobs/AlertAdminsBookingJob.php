<?php

namespace App\Jobs;

use App\Mail\AdminBookingAlertMail;
use App\Models\Booking;
use App\Models\User;
use App\Traits\ConfiguresDynamicMailSettings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AlertAdminsBookingJob implements ShouldQueue
{
    use Queueable, ConfiguresDynamicMailSettings;
    public $bookingId;

    /**
     * Create a new job instance.
     */
    public function __construct($bookingId)
    {
        $this->bookingId = $bookingId;
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
            ])->where('booking_id', $this->bookingId)->first();

            if (!$booking) {
                return;
            }

            $adminUsers = User::role('admin')->whereNotNull('email')->get();
            if ($adminUsers->isEmpty()) {
                return;
            }

            // Send email to all admins
            foreach ($adminUsers as $admin) {
                Mail::to($admin->email)->cc('santosh.singh@ommune.com')->send(new AdminBookingAlertMail($booking, $admin));
            }

        }catch(\Exception $e){
            Log::error("AlertAdminsBookingJob Failed: " . $e->getMessage());
        }
    }
}

<?php

namespace App\Jobs;

use App\Mail\BookingInvoiceMail;
use App\Models\Booking;
use App\Models\BookingEmails;
use App\Traits\ConfiguresDynamicMailSettings;
use App\Traits\InvoiceNumber;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Barryvdh\Snappy\Facades\SnappyPdf;

class BookingInvoiceJob implements ShouldQueue
{
    use InvoiceNumber;
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
                'transactions' => function ($query) {
                    $query->where('status', 'captured');
                },
                'invoice',
                'bookedRooms'
            ])->where('booking_id', $this->bookingId)->first();

            if ($booking?->bookingContact?->email) {

                $invoiceData = [
                    'invoice_number' => !empty($booking->invoice?->invoice_number)? $booking->invoice?->invoice_number : $this->generateInvoiceNumber(),
                    'invoice_date'   => now()->toDateString(),
                ];
                $booking->invoice()->updateOrCreate(
                    ['booking_id' => $booking->id],
                    $invoiceData
                );

                // $pdfContent = storage_path('invoices/invoice_' . $booking->booking_id . '.pdf');
                // SnappyPdf::loadView('front.pdf.payment-receipt', compact('booking'))->save($pdfContent);
                $pdf = SnappyPdf::loadView('front.pdf.payment-receipt', compact('booking'));
                $pdfContent = $pdf->output();
                Mail::to($booking->bookingContact->email)
                    ->send(new BookingInvoiceMail($booking, $pdfContent));

                // Optionally delete the PDF after sending the email
                // unlink($pdfPath);

                $booking->is_mailed = 1;
                $booking->save();

                $bookingEmail               = new BookingEmails();
                $bookingEmail->booking_id   = $booking->id;
                $bookingEmail->email        = $booking->bookingContact->email;
                $bookingEmail->subject      = 'Booking Invoice';
                $bookingEmail->sent_by      = $this->sentBy;
                $bookingEmail->save();
            } else {
                Log::warning("BookingInvoiceJob: No email found for booking ID {$this->bookingId}");
            }
        }catch(\Exception $e){
            Log::error("BookingInvoiceJob Failed for {$this->bookingId}: " . $e->getMessage(), ['exception' => $e]);
        }
    }
}

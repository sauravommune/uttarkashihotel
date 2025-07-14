<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class BookingInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $booking;
    public $pdfContent;

    /**
     * Create a new message instance.
     */
    public function __construct($booking, $pdfContent)
    {
        $this->booking = $booking;
        $this->pdfContent = $pdfContent;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $hotelName = $this->booking->hotel?->name;
        return new Envelope(
            subject: "Payment Invoice for Your Booking at $hotelName",
            replyTo: 'support@hottel.in',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.hottel.booking-invoice',
            with: ['booking' => $this->booking]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        if ($this->pdfContent) {
            return [
                Attachment::fromData(fn () => $this->pdfContent, 'receipt_'.$this->booking->booking_id.'.pdf')
                    ->withMime('application/pdf')
            ];
        }
        return [];
    }
}

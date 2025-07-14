<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingCancellationProcessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $penaltyAmount;

    /**
     * Create a new message instance.
     */
    public function __construct($booking, $penaltyAmount = 0)
    {
        $this->booking = $booking;
        $this->penaltyAmount = $penaltyAmount;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $hotelName = $this->booking->hotel?->name;
        return new Envelope(
            subject: "Your Booking Cancellation at $hotelName is Under Process!",
            replyTo: 'support@hottel.in',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.hottel.booking-cancellation',
            with: ['booking' => $this->booking, 'penaltyAmount' => $this->penaltyAmount],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

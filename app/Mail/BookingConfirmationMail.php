<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $booking;
    public $confirmation_number;
    public $confirmed_by;
    /**
     * Create a new message instance.
     */
    public function __construct($booking,$confirmation_number,$confirmed_by)
    {
        $this->booking = $booking;
        $this->confirmation_number = $confirmation_number;
        $this->confirmed_by = $confirmed_by;    
        
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $hotelName = $this->booking->hotel?->name;
        return new Envelope(
            subject: "Your 'Hottel' Booking is Confirmed at $hotelName!",
            replyTo: 'support@hottel.in',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

             
        return new Content(
            view: 'email.hottel.booking-confirmed',
            with: ['booking' => $this->booking,'confirmation_number' => $this->confirmation_number,'confirmed_by' => $this->confirmed_by]);
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

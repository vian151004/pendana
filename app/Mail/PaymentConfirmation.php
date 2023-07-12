<?php

namespace App\Mail;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $campaign;
    public $donation;
    public $bank;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        Campaign $campaign,
        Donation $donation,
        $bank
    )
    {
        $this->campaign = $campaign;
        $this->donation = $donation;
        $this->bank = $bank;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Payment Confirmation',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail.payment_confirmation',
            with: [
                'campaign' => $this->campaign,
                'donation' => $this->donation,
                'bank' => $this->bank
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProPlanInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $invoiceNumber,
        public string $planName = 'QR SaaS Pro',
        public float $amount = 19.00,
        public string $currency = 'USD'
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your QR SaaS Pro invoice',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pro_invoice',
            with: [
                'invoiceNumber' => $this->invoiceNumber,
                'planName' => $this->planName,
                'amount' => $this->amount,
                'currency' => $this->currency,
            ],
        );
    }
}

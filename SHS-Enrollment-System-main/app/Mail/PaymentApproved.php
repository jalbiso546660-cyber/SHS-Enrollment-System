<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class PaymentApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $payment;
    public $registration;
    public $section;
    public $strand;
    public $room;
    public $subjects;

    public function __construct($payment, $registration, $section, $strand, $room, $subjects)
    {
        $this->payment = $payment;
        $this->registration = $registration;
        $this->section = $section;
        $this->strand = $strand;
        $this->room = $room;
        $this->subjects = $subjects;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            subject: 'Payment Approved - Welcome to UM!'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.payment-approved'
        );
    }
}
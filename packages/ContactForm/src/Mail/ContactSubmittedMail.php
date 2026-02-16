<?php

namespace ContactForm\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use ContactForm\Models\ContactSubmission;

class ContactSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $submission;

    public function __construct(ContactSubmission $submission)
    {
        $this->submission = $submission;
    }

    public function build()
    {
        return $this->subject('New Contact Form Submission')
                    ->view('contactform::emails.contact_submitted');
    }
}

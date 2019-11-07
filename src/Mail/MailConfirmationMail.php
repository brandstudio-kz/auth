<?php

namespace BrandStudio\Auth\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use BrandStudio\Auth\Models\VerificationToken;

class MailConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(VerificationToken $token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $view = 'brandstudio::mail.confirm_email';
        return $this->to('nurik9293709@gmail.com')
                    ->subject(trans('brandstudio::auth.confirm_your_mail'))
                    ->view($view)
                    ->with(['token' => $this->token]);
    }

}

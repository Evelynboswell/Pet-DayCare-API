<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resetUrl;

    public function __construct($token)
    {
        $this->resetUrl = url("/api/reset-password/{$token}");
    }

    public function build()
    {
        return $this->subject('Reset Your Password')
                    ->view('emails.reset-password')
                    ->with(['resetUrl' => $this->resetUrl]);
    }
}

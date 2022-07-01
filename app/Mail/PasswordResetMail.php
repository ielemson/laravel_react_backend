<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public  $token;
    public function __construct($token)
    {
        $this->token = $token;
    }

    public function build()
    {
        $address = 'support@hash360.com';
        $subject = 'Password Recovery';
        $name = 'Hash360 Inc.';
        return $this->view('mail.resetpassword')
        ->from($address, $name)
        ->subject($subject)
        ->with(['token' => $this->token]);
    }
}
